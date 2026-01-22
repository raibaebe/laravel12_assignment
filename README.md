# Laravel 12 Assignment

This project is a Laravel 12 application configured to run locally using **Laravel Sail (Docker)** and deployed on **Heroku**.

---

## Requirements
- Docker Desktop (must be running)
- Git
- Composer 

---

## Installation (Local with Laravel Sail)

### 1) Clone the repository
```bash
git clone https://github.com/raibaebe/laravel12_assignment.git
cd laravel12_assignment
```

### 2) Create environment file
```bash
cp .env.example .env
```

### 3) Install PHP dependencies
> This step is required to get the Sail binary.
```bash
composer install
```

### 4) Start Docker containers
```bash
./vendor/bin/sail up -d --build
```

### 5) Generate application key
```bash
./vendor/bin/sail artisan key:generate
```

### 6) Run database migrations and seeders
```bash
./vendor/bin/sail artisan migrate --seed
```

> If you use a specific seeder (e.g. AdminSeeder):
```bash
./vendor/bin/sail artisan db:seed --class=AdminSeeder
```

### 7) Frontend assets
If the project uses Vite/Tailwind:
```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

### 8) Open the application
```
http://localhost
```

---

## Database
The project uses a relational database with migrations and seeders.
A database dump is provided in `dump.sql`.

---

## Deployment
The application is deployed to Heroku using GitHub Actions CI/CD.

---

## Notes
- Session handling in production uses cookies.
- `.env` is not committed; use `.env.example` as reference.

---

## Screenshots
See the `screenshots/` directory for:
- User registration
- User dashboard / requests list
- Admin panel

---
## Author
Kassymkyzy Raikhan
