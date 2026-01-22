
# Service Desk Ticket System

## Description
A Service Desk Ticket System built with Laravel. 
Users can create support tickets, and admins can manage and update ticket statuses.

## Features
- User registration and authentication
- Users can create support tickets
- Admin panel to view and manage all tickets
- Role-based access control for users and admins
- Ability for admins to update ticket statuses

## Installation
Follow the steps below to set up the project locally:

### 1. Clone the repository:
```bash
git clone <your-repository-url>
cd <your-project-directory>
```

### 2. Install dependencies:
```bash
./vendor/bin/sail up -d
./vendor/bin/sail composer install
```

### 3. Set up the environment file:
```bash
cp .env.example .env
```

### 4. Generate the application key:
```bash
./vendor/bin/sail artisan key:generate
```

### 5. Run migrations:
```bash
./vendor/bin/sail artisan migrate
```

### 6. Seed an admin user:
```bash
./vendor/bin/sail artisan db:seed --class=AdminSeeder
```

### 7. Access the app:
Once everything is set up, access the app in your browser:
```
http://localhost
```

You can log in as a regular user or admin (credentials provided in the seeder).

## Tech Stack:
- Laravel 12.x
- PHP 8.5
- MySQL
- Docker (Laravel Sail)
- Blade + Tailwind CSS

## Author:
Kassymkyzy Raikhan
