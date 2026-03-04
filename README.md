# Task Manager – Technical Assessment

This project is a simple task management application built using **Laravel and MySQL**.  
It allows an admin user to assign tasks to other users and lets users track and update the tasks assigned to them.

The purpose of this project was to practice building a small but complete Laravel application that includes authentication, role-based access control, and basic CRUD functionality.

---

## Features

### Authentication
- User registration and login
- Role-based access (Admin and User)
- Protected routes using Laravel middleware

### Admin Features
- View all users
- Assign tasks to users
- Edit existing tasks
- Delete tasks (soft delete)
- View all tasks in the system

### User Features
- View tasks assigned to them
- Update task status (Pending / Completed)
- Add notes when updating a task
- Search and filter tasks

### System Features
- Soft deletes for tasks
- Pagination for task lists
- Form validation
- CSRF protection

---

## Tech Stack

- **Framework:** Laravel 11  
- **Database:** MySQL  
- **Frontend:** Blade Templates with Tailwind CSS  
- **ORM:** Eloquent  
- **Build Tool:** Vite  

---

## Requirements

Before running the project, make sure the following are installed:

- PHP 8.2 or higher
- MySQL 8+
- Composer
- Node.js (v16 or higher)

---

## Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/YOUR_GITHUB_USERNAME/task-manager.git
cd task-manager
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Create Environment File

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Create Database

Create a MySQL database called:

```
task_manager_db
```

Update the database section in `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager_db
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Run Migrations and Seed Data

```bash
php artisan migrate --seed
```

This will create the database tables and insert demo users.

### 7. Build Frontend Assets

```bash
npm run build
```

### 8. Start the Development Server

```bash
php artisan serve
```

Open the application in your browser:

```
http://localhost:8000
```

---

## Demo Accounts

You can use these accounts to test the application.

### Admin Account

Email: admin@taskmanager.com  
Password: admin@123

### Demo Users

Email: geeth@gmail.com  
Password: geeth@123  

Email: chamodi@gmail.com  
Password: chamodi@123  

Email: milan@gmail.com  
Password: milan@123  

---

## Database Structure

### Users Table

- id
- name
- email
- password
- role (admin or user)
- timestamps

### Tasks Table

- id
- title
- description
- status (pending or completed)
- status_note
- due_date
- user_id
- assigned_by
- timestamps
- deleted_at (soft delete)

---

## Main Routes

Authentication

```
/login
/register
/logout
```

User Routes

```
/dashboard
/tasks
```

Admin Routes

```
/admin/users
/admin/tasks
```

---

## Assumptions

- Admin users can create, assign, update, and delete tasks.
- Normal users can only view and update tasks assigned to them.
- Tasks use soft deletes so deleted records are not permanently removed.

---

This project was developed as part of a **Software Engineering Internship Technical Assessment**.
