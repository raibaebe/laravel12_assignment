# Laravel 12 ServiceDesk Application

A modern, full-featured ServiceDesk web application built with **Laravel 12** as part of a technical assignment.
The application demonstrates user authentication, role-based access control, comprehensive ticket management, and production-ready CI/CD integration.

---

## Features

### User Features
- User registration and authentication with email verification
- Personal dashboard with ticket overview
- Create service tickets with:
  - Title
  - Category
  - Priority (Low, Medium, High)
  - Detailed description
  - Due date
- View all own tickets with pagination
- Edit and update own tickets
- Delete own tickets
- View detailed ticket information

### Admin Features
- Comprehensive admin panel with all tickets
- Advanced filtering by:
  - Status
  - Priority
  - Search by title/description
- Change ticket status:
  - New
  - In Progress
  - Done
  - Rejected
- Assign tickets to admin users
- View all user tickets
- Pagination for better performance

### Roles & Permissions
- **User** — Can create, view, edit, and delete only their own tickets
- **Admin** — Can view and manage all tickets, change statuses, assign tickets

---

## Tech Stack

- **Laravel 12** - Latest Laravel framework
- **PHP 8.3** - Modern PHP version
- **MySQL 8.0** - Relational database
- **Blade Templates** - Server-side templating
- **TailwindCSS** - Modern utility-first CSS
- **Vite** - Fast frontend build tool
- **Docker & Laravel Sail** - Containerized development
- **GitHub Actions** - Comprehensive CI/CD pipeline
- **PHPStan (Larastan)** - Static analysis
- **Laravel Pint** - Code style formatter
- **PHPUnit** - Feature and unit testing

---

## Code Quality Features

### Enums
- `TicketStatus` - Type-safe status management with labels and colors
- `TicketPriority` - Type-safe priority levels with labels and colors

### Form Requests
- `StoreTicketRequest` - Validated ticket creation
- `UpdateTicketStatusRequest` - Validated status updates

### Policies
- `TicketPolicy` - Authorization for ticket operations
- Policy-based access control for view, update, delete actions

### Modern Laravel Features
- Eloquent relationships (BelongsTo, HasMany)
- Route model binding
- Middleware for authentication and authorization
- Database migrations and seeders
- Factory patterns for testing
- Pagination with query string preservation

---

## Project Structure

```
app/
├── Enums/                      # Enums for Status and Priority
├── Http/
│   ├── Controllers/           # Ticket and Admin controllers
│   ├── Middleware/            # Admin authentication middleware
│   ├── Requests/              # Form request validation
│   └── Policies/              # Authorization policies
├── Models/                    # Eloquent models (User, Ticket)
database/
├── factories/                 # Model factories for testing
├── migrations/                # Database schema
└── seeders/                   # Realistic test data
resources/
├── views/
│   ├── admin/tickets/        # Admin panel views
│   ├── tickets/              # Ticket CRUD views
│   └── dashboard.blade.php   # User dashboard
tests/
├── Feature/                   # Feature tests for tickets and admin
.github/
└── workflows/ci.yml          # GitHub Actions CI/CD pipeline
```

---

## Local Setup (Laravel Sail)

### Requirements
- Docker Desktop
- Docker Compose
- Git

### Installation Steps

1. **Clone the repository**
```bash
git clone https://github.com/raibaebe/laravel12_assignment.git
cd laravel12_assignment
```

2. **Install dependencies**
```bash
composer install
```

3. **Configure environment**
```bash
cp .env.example .env
```

4. **Start Docker containers**
```bash
./vendor/bin/sail up -d
```

5. **Generate application key**
```bash
./vendor/bin/sail artisan key:generate
```

6. **Run migrations and seed database**
```bash
./vendor/bin/sail artisan migrate --seed
```

7. **Install and build frontend assets**
```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

**Application URL:** http://localhost

---

## Test Credentials

After running the seeder, you can log in with:

### Admin Account
- **Email:** admin@example.com
- **Password:** password

### Regular Users
- **Email:** john@example.com / jane@example.com
- **Password:** password

The seeder creates:
- 1 Admin user
- 7 Regular users
- 10 Sample tickets with various statuses and priorities

---

## Running Tests

### Run all tests
```bash
./vendor/bin/sail artisan test
```

### Run specific test suite
```bash
./vendor/bin/sail artisan test --testsuite=Feature
```

### With coverage
```bash
./vendor/bin/sail artisan test --coverage
```

### Test Coverage
- User ticket CRUD operations
- Admin panel functionality
- Authorization and policies
- Status updates and assignments
- Filtering and search

---

## Code Quality Tools

### Run code style check
```bash
./vendor/bin/sail exec laravel.test vendor/bin/pint --test
```

### Auto-fix code style
```bash
./vendor/bin/sail exec laravel.test vendor/bin/pint
```

### Run static analysis
```bash
./vendor/bin/sail exec laravel.test vendor/bin/phpstan analyse
```

---

## CI/CD Pipeline

The GitHub Actions workflow automatically:
1. Sets up PHP 8.3 with required extensions
2. Installs Composer dependencies
3. Configures test database (MySQL)
4. Runs PHP syntax checks
5. Executes database migrations
6. Runs all PHPUnit tests
7. Performs code style checks (Pint)
8. Runs static analysis (Larastan)

**Status:** All checks must pass before merging

---

## Improvements Made

### Bug Fixes
- Fixed route naming inconsistencies
- Fixed view file paths
- Removed syntax errors in navigation
- Fixed N+1 query issues

### Code Quality
- Implemented PHP Enums for status and priority
- Created Form Request validation classes
- Added comprehensive Policy-based authorization
- Improved middleware security
- Added proper type hints and return types

### Features Added
- Full CRUD operations for tickets
- Ticket assignment to admins
- Advanced filtering and search
- Pagination for better performance
- Empty state handling
- Detailed ticket view
- Edit ticket functionality

### UI/UX Improvements
- Modern, clean interface with TailwindCSS
- Color-coded status and priority badges
- Responsive design for mobile
- Better form validation and error messages
- Loading states and transitions
- Improved admin dashboard

### Testing
- Feature tests for user operations
- Feature tests for admin operations
- Authorization tests
- Factory patterns for test data
- Database seeding with realistic data

### DevOps
- Enhanced CI/CD pipeline
- Automated testing on push/PR
- Code quality checks
- Database migration verification

---

## API Endpoints

### User Routes (Authenticated)
- `GET /dashboard` - User dashboard
- `POST /tickets` - Create ticket
- `GET /tickets/{ticket}` - View ticket
- `GET /tickets/{ticket}/edit` - Edit ticket form
- `PUT /tickets/{ticket}` - Update ticket
- `DELETE /tickets/{ticket}` - Delete ticket

### Admin Routes (Admin only)
- `GET /admin/tickets` - Admin panel
- `PATCH /admin/tickets/{ticket}/status` - Update status
- `PATCH /admin/tickets/{ticket}/assign` - Assign ticket

---

## Best Practices Followed

- Clean, maintainable code structure
- Laravel coding standards (PSR-12)
- Separation of concerns (Controllers, Requests, Policies)
- Type-safe Enums instead of string constants
- Comprehensive authorization checks
- Input validation at multiple levels
- N+1 query prevention with eager loading
- Database indexing for performance
- Semantic HTML and accessible UI
- Git commit best practices

---

## Security Features

- CSRF protection on all forms
- Policy-based authorization
- Middleware authentication
- SQL injection prevention (Eloquent ORM)
- XSS protection (Blade escaping)
- Password hashing with bcrypt
- Validation on all inputs

---

## Future Enhancements

- Email notifications for ticket updates
- File attachments for tickets
- Comment system for ticket discussions
- Activity log/audit trail
- Dashboard analytics and charts
- Export tickets to PDF/Excel
- Real-time updates with WebSockets
- API endpoints for mobile app

---

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## License

This project is open-sourced for educational purposes.

---

## Author

**Raikhan Kassymkyzy**
Laravel / PHP Developer
[GitHub](https://github.com/raibaebe) | [LinkedIn](#)

---

## Acknowledgments

- Laravel Framework Team
- TailwindCSS Team
- All open-source contributors

