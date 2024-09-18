# Symfony Project

## Overview

This project is a Symfony application designed to show th data that the backend app fetched. It includes a Symfony console command that is scheduled to run daily using a cron job. The fetched data is processed and saved in a file named data_[YYYYMMDD].json.

## Tools and Technologies Used

- **Symfony**: A PHP framework for web applications.
- **PHP**: The programming language used for the backend.
- **Composer**: Dependency manager for PHP.
- **Git**: Version control system.
- **GitHub**: Repository hosting service.
- **Google OAuth**: Used for authentication.

## Installation

### Prerequisites

- PHP 7.4 or higher
- Composer
- A Google Cloud account for OAuth credentials

1. **Clone the Repository**

   ```sh
   git clone https://github.com/Johepdgc/frontend.git
   cd frontend

2. **Clone the Repository**

   ```sh
   composer install

3. **Set Up Environment Variables**

   ```sh
   DATABASE_URL=postgresql://user:password@127.0.0.1:5432/database_name
   GOOGLE_CLIENT_ID=your_google_client_id
   GOOGLE_CLIENT_SECRET=your_google_client_secret

5. **Set Up the database**

   ```sh
   php bin/console doctrine:migrations:migrate

7. **Run the app**

   ```sh
   symfony server:start
