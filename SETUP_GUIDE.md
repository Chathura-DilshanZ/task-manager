# 📖 Setup Guide for Evaluators

This guide helps you set up the Task Manager application for evaluation.

## Prerequisites

- PHP 8.2+
- MySQL 8.0+
- Node.js 16+
- Composer 2.0+
- Git

## ⚙️ Installation Steps

### 1. Clone Repository

```bash
git clone <repository-url>
cd task-manager
```

### 2. Install Dependencies

```bash
# PHP dependencies
composer install

# Node dependencies
npm install
```

### 3. Setup Environment

```bash
# Copy environment template
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Create Database

```bash
# Start MySQL (if not running)
# Windows: Open MySQL Command Line Client or use MySQL Workbench
# macOS/Linux: brew services start mysql

# Create database
mysql -u root -p
> CREATE DATABASE task_manager_db;
> EXIT;
```

### 5. Database Migrations & Seeding

```bash
# Run migrations with seeding
# This creates tables and populates demo data
php artisan migrate --seed

# Output should show:
# ✓ Migrating: 2025_01_01_000000_create_users_table
# ✓ Migrating: 2025_01_01_000001_create_tasks_table
# ... (other migrations)
# ✓ Seeding: AdminSeeder
# ... (other seeders)
```

### 6. Build Frontend Assets

```bash
# Build Tailwind CSS and Vite assets
npm run build

# Or for development with hot reload:
# npm run dev
```

### 7. Start Development Server

```bash
php artisan serve

# Output should show:
# Laravel development server started: http://127.0.0.1:8000
```

### 8. Access Application

Open browser and go to: **http://localhost:8000**

---

## 🔐 Test Credentials

### Admin Account (Full Access)

```
Email: admin@taskmanager.com
Password: admin@123
```

**Admin can:**

- View all users
- Create/assign tasks to users
- Edit tasks
- Delete tasks
- View all assigned tasks

### User Accounts (Limited Access)

```
User 1:
Email: geeth@gmail.com
Password: geeth@123

User 2:
Email: chamodi@gmail.com
Password: chamodi@123

User 3:
Email: milan@gmail.com
Password: milan@123
```

**Users can:**

- View their assigned tasks
- Update task status
- Add notes to tasks
- Search/filter their tasks

---

## 🧪 Testing Workflow

### Test as Admin

1. **Login**
    - Go to http://localhost:8000/login
    - Use admin credentials above

2. **View Users**
    - Click "All Users" in nav
    - See all users in system

3. **Assign Task**
    - Click "Assign Task" on any user
    - Fill task details
    - Click Save

4. **View All Tasks**
    - Click "All Assigned Tasks"
    - See tasks with descriptions
    - Hover over description to see full text

5. **Edit Task**
    - Click "✎ Edit" on any task
    - Modify title/description/user/due date
    - Click "Save Changes"
    - Verify success message

6. **Delete Task**
    - Click "🗑 Delete" on any task
    - Confirmation modal appears
    - Confirm deletion
    - Verify success message

### Test as User

1. **Login**
    - Go to http://localhost:8000/login
    - Use any user credentials above

2. **View My Tasks**
    - See dashboard with assigned tasks
    - Each shows title, description, status, due date

3. **Update Status**
    - Select new status (Pending/Completed)
    - Add optional note
    - Click Update
    - Verify status changed

4. **Search & Filter**
    - Use search box to find task
    - Use status filter
    - Click Filter to apply

---

## 🐛 Troubleshooting

### Issue: "No Application Key"

```bash
php artisan key:generate
```

### Issue: MySQL Connection Error

- Verify MySQL is running
- Check DB_HOST, DB_USERNAME, DB_PASSWORD in .env
- Ensure database exists: `CREATE DATABASE task_manager_db;`

### Issue: "Vite manifest not found"

```bash
npm run build
```

### Issue: Port 8000 Already in Use

```bash
php artisan serve --port=8001
```

### Issue: Permission Denied (storage)

```bash
chmod -R 775 storage bootstrap/cache
```

### Issue: Migrations Failed

```bash
# Rollback and retry
php artisan migrate:rollback
php artisan migrate --seed
```

---

## 📁 Project Structure

```
task-manager/
├── app/Http/Controllers/      # Business logic
├── database/
│   ├── migrations/            # Table definitions
│   ├── seeders/              # Demo data (AdminSeeder, etc)
│   └── factories/            # Model factories
├── resources/
│   ├── views/
│   │   ├── admin/            # Admin pages
│   │   ├── tasks/            # User pages
│   │   └── layouts/          # Layout templates
│   ├── css/app.css           # Tailwind styles
│   └── js/app.js             # Frontend scripts
├── routes/
│   ├── web.php               # Web routes
│   └── auth.php              # Auth routes
├── .env.example              # Environment template
├── README.md                 # Project documentation
└── composer.json             # PHP dependencies
```

---

## 📊 Database Overview

### Users Table

- Admin user (admin@taskmanager.com)
- 3 demo users (geeth, chamodi, milan)

### Tasks Table

- Multiple sample tasks (created via seeders)
- Tasks assigned to demo users
- Various statuses (pending, completed)

All demo data is created fresh with `php artisan migrate --seed`

---

## ✅ Verification Checklist

After setup, verify:

- [ ] Application runs at http://localhost:8000
- [ ] Can login with admin credentials
- [ ] Can login with user credentials
- [ ] Can view task list as admin
- [ ] Can edit a task
- [ ] Can delete a task (with modal)
- [ ] Can logout and login as user
- [ ] Can update task status
- [ ] Can search/filter tasks
- [ ] Success messages appear
- [ ] No console errors in browser

---

## 📝 Notes

- Database is recreated each time you run `php artisan migrate --seed`
- Previous data will be lost after seeding
- For production, update .env with proper configuration
- Email sending requires MAIL\_\* configuration
- All forms are protected with CSRF tokens

---

## 🆘 Need Help?

1. Check the main [README.md](./README.md)
2. Run `php artisan tinker` for debugging
3. Check `storage/logs/laravel.log` for errors
4. Verify .env file has correct database credentials

---

**Happy evaluating! 🎉**
