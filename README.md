# Task Management REST API (Laravel)

A Laravel-based Task Management system with authentication, 
role-based access control, full CRUD operations, filtering, pagination, and soft deletes.

- Laravel 12
- MySQL
- Blade
- Tailwind CSS

- User Registration & Login
- Role-based access (Admin / User)
- Task CRUD
- Soft deletes
- Filtering by status
- Pagination
- REST API endpoints

  ## Setup Instructions

1. Clone the repository
2. Copy .env.example to .env
3. Run composer install
4. Run npm install
5. Run php artisan key:generate
6. Configure database in .env
7. Run php artisan migrate --seed
8. Run php artisan serve

## Environment Variables

APP_NAME=
APP_ENV=
APP_URL=

DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

## Default Admin Login
Email: admin@taskmanager.com
Password: admin@123

## Default User Login
Email: geeth@gmail.com
Password: geeth@123


## Assumptions

- Only admins can assign tasks.
- Users can view & update only their assigned tasks.
- Task statuses: Pending, Completed.
- Soft deletes are enabled for tasks.

  
