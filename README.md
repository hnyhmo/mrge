# Laravel Project

This is a Laravel-based project. Below are the steps to set up and run the application.

## Prerequisites

Before running the Laravel application, ensure that you have the following installed on your system:

- PHP >= 7.3
- Composer
- MySQL or any other supported database

## Installation

1. Clone the repository to your local machine:
    ```bash
    git clone https://github.com/hnyhmo/mrge.git
    cd mrge
    ```

2. Install the required dependencies using Composer:
    ```bash
    composer install
    ```

3. Copy the `.env.example` file to `.env`:
    ```bash
    cp .env.example .env
    ```

4. Generate the application key:
    ```bash
    php artisan key:generate
    ```

5. Configure your `.env` file with the correct database credentials and other necessary settings.

## Running the Application

After setting up the environment, you can run the application with the following commands:

### 1. Run Migrations
To apply the database migrations, run:
```bash
php artisan migrate
```

### 2. Start the Queue Worker
Start the queue worker to process background jobs:
```bash
php artisan queue:work
```

### 3. Start the Scheduled Commands
Start the scheduler to run scheduled tasks:
```bash
php artisan schedule:work
```

### 4. Serve the Application
This will start the Laravel development server, and you can access the application in your browser at http://127.0.0.1:8000
```bash
php artisan serve
```
