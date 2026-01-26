# Laravel 12 Assignment


This project is a simple ServiceDesk web application built with **Laravel 12** as part of a technical assignment.  
The application demonstrates user authentication, role-based access control, request management, and basic CI/CD integration.

---

## Features

### User Features
- User registration and authentication
- Personal dashboard
- Create service requests with the following fields:
  - Title
  - Category
  - Priority
  - Description
  - Due date
- View a list of own requests and their statuses

### Admin Features
- View all service requests
- Change request status:
  - New
  - In progress
  - Completed
  - Rejected

### Roles
- **User** — can create and view only their own requests
- **Admin** — can view and manage all requests
---
## Tech Stack

- Laravel 12
- PHP 8.x
- MySQL
- Blade templates
- TailwindCSS
- Vite
- Docker & Laravel Sail
- GitHub Actions (CI)

---

## Project Structure Overview

- `app/Http/Controllers` — request and admin controllers
- `app/Models` — Eloquent models
- `database/migrations` — database schema
- `database/seeders` — test users and demo data
- `resources/views` — Blade templates
- `routes/web.php` — web routes
- `.github/workflows` — CI configuration

---
## Local Setup (Laravel Sail)

### Requirements
- Docker
- Docker Compose

### Installation

```bash
git clone https://github.com/raibaebe/laravel12_assignment.git
cd laravel12_assignment

cp .env.example .env
composer install

./vendor/bin/sail up -d --build
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed

./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

Application will be available at:  
 http://localhost

---

## Test Data

The database is populated using seeders and includes:
- One **admin** user
- One or more **regular users**
- Sample service requests

Credentials can be adjusted in the database seeders if needed.

---

## Running Tests

```bash
./vendor/bin/sail artisan test
```

---

## CI/CD

The project includes a basic **GitHub Actions** workflow that:
- Installs dependencies
- Checks PHP syntax
- Runs database migrations
- Executes tests (if available)

This pipeline simulates a minimal production-ready CI setup.

---

## Notes for Reviewers

- Business logic is separated from views
- Validation is handled via Laravel Request validation
- Role-based access control is implemented
- Dockerized environment ensures consistent setup
- Code follows Laravel best practices (KISS, DRY)
---

## Author

**Raikhan Kassymkyzy**  
Laravel / PHP Developer (Junior)

