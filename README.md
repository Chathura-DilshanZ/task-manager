# Task Manager - Technical Assessment

A comprehensive Task Management System built with Laravel and MySQL, featuring role-based access control, CRUD operations with Basic UI/UX, and a smooth admin dashboard for managing user tasks.

## Overview

This project demonstrates a full-stack web application with:

- Authentication System - User login/registration with role-based access
- Admin Panel - Complete task management with edit, delete, and filtering
- User Dashboard - Personal task viewing with status updates
- Database Management- Structured schema with migrations and seeders

## Features

### Authentication & Authorization

- User registration and login
- Role-based access control (Admin/User roles)
- Protected routes with middleware
- Session management

### Admin Features

- View all assigned tasks with descriptions
- Edit task details (title, description, assigned user, due date)
- Delete tasks with smooth animated confirmation modal
- Task filtering and viewing
- Display task descriptions with smart truncation
- Professional UI with smooth animations and transitions
- Red-accented delete confirmation with keyboard support (ESC)

### User Features

- View personal assigned tasks
- Update task status (Pending/Completed)
- Add status notes to tasks
- Search and filter tasks
- View task descriptions with truncation
- Responsive design

### Technical Features

- Soft deletes for audit trail
- Pagination on task lists
- CSRF protection on all forms
- Form validation with error messages
- Auto-hiding success notifications (5 seconds)
- Keyboard support (ESC to close modals)
- Click-outside to close modals
- Responsive Tailwind CSS design

## Tech Stack

| Layer           | Technology                          |
| --------------- | ----------------------------------- |
| Framework       | Laravel 11                          |
| Database        | MySQL 8.0+                          |
| Frontend        | Blade Templates, Tailwind CSS, Vite |
| Authentication  | Laravel built-in Auth               |
| ORM             | Eloquent                            |
| Package Manager | Composer, NPM                       |

# Requirements

- PHP 8.2 or higher
- MySQL 8.0 or higher
- Node.js 16+ (for Vite)
- Composer 2.0+
- npm or yarn

# Installation & Setup

# 1. Clone Repository

````bash
git clone <repository-url>
cd task-manager

# 2. Install Dependencies

```bash

# Install PHP dependencies

composer install

# Install Node dependencies

npm install

### 3. Environment Configuration

```bash

# Copy environment file

cp .env.example .env

# Generate application key

php artisan key:generate

# 4. Database Setup

```bash

# Create MySQL database

mysql -u root -p

> CREATE DATABASE task_manager;
> EXIT;

# Run migrations with seeding

php artisan migrate --seed

# 5. Build Frontend Assets

```bash

# Development with hot reload

npm run dev

# Production build

npm run build

# 6. Start Development Server

```bash
php artisan serve

Access the application at: http://localhost:8000

# Environment Variables

See `.env.example` for complete template. Key variables:

----env-----
APP_NAME=TaskManager
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager_db
DB_USERNAME=root
DB_PASSWORD=

# Mail (optional)

MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025

# Session

SESSION_DRIVER=database
SESSION_LIFETIME=120

# Database Schema

# Users Table

- id (PK)
- name
- email (UNIQUE)
- password (hashed)
- role (admin|user)
- email_verified_at
- created_at, updated_at

# Tasks Table

- id (PK)
- title
- description
- status (pending|completed)
- status_note
- due_date
- user_id (FK → users.id)
- assigned_by (FK → users.id)
- created_at, updated_at
- deleted_at (soft delete)

# Default Credentials

After running `php artisan migrate --seed`:

# Admin Account

Email: admin@taskmanager.com
Password: admin@123
Role: Admin

# Demo User Accounts

Email: geeth@gmail.com
Password: geeth@123
Role: User

Email: chamodi@gmail.com
Password: chamodi@123
Role: User

Email: milan@gmail.com
Password: milan@123
Role: User


# Routes & Endpoints

# Authentication (Public)

GET /login - Login page
POST /login - Submit login
GET /register - Registration page
POST /register - Submit registration
POST /logout - Logout

# User Routes (Authenticated)

GET /dashboard - User dashboard
GET /tasks - My tasks
PATCH /tasks/{id}/status - Update task status
GET /profile - Profile page
PATCH /profile - Update profile
DELETE /profile - Delete account

# Admin Routes (Admin Only)

GET /admin/users - All users list
GET /admin/tasks - All tasks
GET /admin/users/{user}/assign-task - Assign task form
POST /admin/users/{user}/assign-task - Create task
GET /admin/tasks/{id}/edit - Edit form
PATCH /admin/tasks/{id} - Update task
DELETE /admin/tasks/{id} - Delete task

# Usage Examples

# As Admin

1. Assign Task to User

1. Navigate to `/admin/users`
2. Find user and click "Assign Task"
3. Fill in: Title, Description, Due Date
4. Click "Save"
5. View all tasks at `/admin/tasks`

2. Edit Task

1. Go to `/admin/tasks`
2. Click "Edit" button
3. Modify: Title, Description, Assigned User, Due Date
4. Click "Save Changes"

3. Delete Task

1. Go to `/admin/tasks`
2. Click "Delete" button
3. Professional confirmation modal appears
4. Confirm or cancel
5. Success notification shows

# As User

1. View My Tasks

    1. Login as user
    2. Go to `/dashboard` → "My Tasks"
    3. See all assigned tasks with descriptions

2. Update Task Status

    1. In task list, select status: Pending/Completed
    2. Add optional note
    3. Click "Update"
    4. Status changes immediately

3. Search/Filter

    1. Use search box to find task by name
    2. Filter by status (All/Pending/Completed)
    3. Click "Filter"

# Project Structure


task-manager/
├── app/
│ ├── Http/
│ │ ├── Controllers/
│ │ │ ├── AdminController.php
│ │ │ ├── TaskController.php
│ │ │ └── ProfileController.php
│ │ └── Middleware/
│ ├── Models/
│ │ ├── Task.php
│ │ └── User.php
│ └── Policies/
│ └── AdminPolicy.php
├── resources/
│ ├── views/
│ │ ├── admin/
│ │ │ ├── tasks.blade.php (with delete modal)
│ │ │ ├── edit-task.blade.php
│ │ │ └── users.blade.php
│ │ ├── tasks/
│ │ │ └── index.blade.php (user view)
│ │ └── layouts/
│ ├── css/app.css
│ └── js/app.js
├── database/
│ ├── migrations/
│ └── seeders/
│ ├── AdminSeeder.php
│ └── DatabaseSeeder.php
├── routes/
│ ├── web.php
│ ├── auth.php
│ └── console.php
├── .env.example
├── README.md
├── composer.json
└── package.json



# Testing Workflow

# Manual Testing Steps

1. Admin Access
    - Login with admin credentials
    - Verify access to `/admin/users` and `/admin/tasks`
2. Task Creation
    - Assign task to user
    - Verify task appears in user's list
3. Task Editing
    - Click Edit on any task
    - Modify title/description
    - Save and verify changes
4. Task Deletion
    - Click Delete button
    - Verify confirmation modal appears
    - Confirm deletion and check success message
5. User Task Management
    - Login as user
    - View assigned tasks with descriptions
    - Update status with notes
    - Verify changes saved

6. Filtering & Search
    - Test search by title
    - Filter by status
    - Verify pagination works

# Key Assumptions

1. MySQL Database - Version 8.0+; adjust connection if using different host

2. Email Verification - Uses local file driver by default; configure MAIL\_\* for real SMTP

3. Role System - Only 'admin' and 'user'; admins can manage all tasks

4. Soft Deletes - Tasks retain audit history; modify `AdminSeeder.php` to change defaults

5. Session Timeout - 120 minutes; adjust `SESSION_LIFETIME` in .env

6. Timezone - UTC by default; set `APP_TIMEZONE` in .env

7. Admin User - Created via seeder with hardcoded credentials (see AdminSeeder.php)

# Common Commands

```bash
# Database
php artisan migrate              # Run migrations
php artisan migrate:rollback     # Rollback migrations
php artisan db:seed              # Seed database
php artisan make:seeder SeedName # Create seeder

# Models & Controllers
php artisan make:model Task      # Create model
php artisan make:controller Name # Create controller
php artisan make:migration       # Create migration

# Cache & Config
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Server
php artisan serve                # Start dev server
php artisan serve --port=8001    # Custom port
````

## Troubleshooting

| Issue                       | Solution                                               |
| --------------------------- | ------------------------------------------------------ |
| "No Application Key"        | `php artisan key:generate`                             |
| MySQL connection failed     | Ensure MySQL is running and DB credentials in .env     |
| Port 8000 in use            | `php artisan serve --port=8001`                        |
| Vite manifest not found     | `npm run build`                                        |
| Sessions not persisting     | Run `php artisan session:table && php artisan migrate` |
| Permission denied (storage) | `chmod -R 775 storage bootstrap/cache`                 |

## Resources

- [Laravel Docs](https://laravel.com/docs)
- [Tailwind CSS](https://tailwindcss.com)
- [MySQL Docs](https://dev.mysql.com/doc)
- [Blade Templates](https://laravel.com/docs/blade)
- [Eloquent ORM](https://laravel.com/docs/eloquent)

# License

MIT License - Open source project

---

Created: March 4, 2026  
Version: 1.0.0  
Status: Assessment Submission

## Assumptions

- Admins can create, update, delete, and assign tasks to users.
- Users can view & update only their assigned tasks.
- Task statuses: Pending, Completed.
- Soft deletes are enabled for tasks.
