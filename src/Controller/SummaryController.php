<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;

class SummaryController extends AbstractController
{
    #[Route('/summary', name: 'app_summary')]
    public function index(Request $request, Connection $connection)
    {
        // Query to get distinct summary dates for the filter
        $dateQuery = 'SELECT DISTINCT summary_date FROM summary ORDER BY summary_date DESC';
        $availableDates = $connection->executeQuery($dateQuery)->fetchAllAssociative();

        // Base query to get the summary data
        $query = 'SELECT id, summary_date, category, subcategory, total FROM summary';
        $filter = $request->query->get('filter');

        // Add filter condition if filter is provided
        if ($filter) {
            $query .= ' WHERE summary_date = :filter';
        }

        // Prepare the query
        $statement = $connection->prepare($query);

        // Only bind the filter if it's present
        if ($filter) {
            $results = $statement->executeQuery(['filter' => $filter])->fetchAllAssociative();
        } else {
            $results = $statement->executeQuery()->fetchAllAssociative();
        }

        // Extract labels and data for Chart.js
        $labels = array_column($results, 'subcategory'); // Replace 'category' with your label column
        $data = array_column($results, 'total'); // Replace 'total' with your data column

        // Render the template with the results
        return $this->render('summary/index.html.twig', [
            'data' => $results,
            'available_dates' => $availableDates, // Pass available dates to Twig
            'chart_labels' => json_encode($labels),
            'chart_data' => json_encode($data),
        ]);
    }
}
