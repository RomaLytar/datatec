
# Laravel Project Setup

## Introduction

This document provides instructions on how to set up and run the Laravel project, including necessary commands, environment configuration, and accessible URLs.

## Prerequisites

Before starting, ensure that you have the following software installed:

- **PHP** (version 8.0 or higher)
- **Composer** (dependency manager for PHP)
- **MySQL** (or another database supported by Laravel)

## Setup Instructions

### 1. Clone the Repository

First, clone the repository to your local machine:

```bash
git clone https://github.com/RomaLytar/datatec.git
cd datatec
```

### 2. Install Dependencies

Install PHP dependencies using Composer:

```bash
composer install
```

### 3. Environment Configuration

Create a copy of the `.env.example` file and rename it to `.env`:

```bash
cp .env.example .env
```

Open the `.env` file and configure your environment settings, such as database connection, queue driver, and other necessary configurations:

```plaintext
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:YourAppKeyHere
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=database
```

### 4. Generate Application Key

Generate the application encryption key:

```bash
php artisan key:generate
```

### 5. Run Migrations

Run the database migrations to create the necessary tables:

```bash
php artisan migrate
```

### 6. Serve the Application

To start the Laravel development server, run:

```bash
php artisan serve
```

The application will be accessible at:

```plaintext
http://127.0.0.1:8000
```

### 7. Run Queue Worker

If your project uses queues, make sure to run the queue worker:

```bash
php artisan queue:work --queue=SubmissionSend
```

### 8. Access the API

The following API endpoint is available:

- **Submit Data**: `POST http://127.0.0.1:8000/api/submit`

### 9. Logging and Debugging

Logs are stored in the `storage/logs/laravel.log` file. Ensure you have proper write permissions to this directory.

### 10. Running Tests

If the project includes tests, you can run them using:

```bash
php artisan test
```

## Troubleshooting

- **Database Connection Issues**: Ensure your `.env` file is correctly configured with your database credentials.
- **Queue Issues**: If your jobs are not being processed, ensure that the queue worker is running and that you have the correct queue driver set in your `.env` file.

## Conclusion

This README provides the basic steps to set up and run the Laravel project. For further details, please refer to the official Laravel documentation or contact the project maintainer.
