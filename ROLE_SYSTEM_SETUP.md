# Task Manager - User Role System

## Setup Complete ✅

A two-level user system has been implemented with the following features:

### User Roles

#### Admin

- **Default Credentials:**
    - Email: `admin@taskmanager.com`
    - Password: `admin123`
- Can manage all users
- Can assign tasks to registered users
- Can view all assigned tasks
- Has access to Admin Panel in navigation

#### User

- Can register normally through the registration form
- Assigned role: `user` by default
- Can view their assigned tasks
- Can complete/update their assigned tasks
- Cannot access admin functions

### Features Implemented

1. **User Role System**
    - `role` field added to users table (enum: 'admin', 'user')
    - Default role: 'user' for new registrations

2. **Admin Panel**
    - View all registered users
    - Assign tasks to specific users
    - Track task assignments with `assigned_by` field
    - View all assigned tasks with status

3. **Task Assignment**
    - Admin can create and assign tasks to users
    - Tasks include: title, description, due date, and status
    - Tracks which admin assigned the task

4. **Navigation**
    - Admin users see "Admin Panel" link in navigation
    - Regular users only see standard dashboard links

### Database Changes

**New Migrations:**

- `2026_03_03_150000_add_role_to_users_table.php` - Adds role column to users
- `2026_03_03_150001_add_assigned_by_to_tasks_table.php` - Tracks who assigned tasks

**Model Updates:**

- `User` model: Added `role` field, `isAdmin()` method, and relationship to tasks
- `Task` model: Added `assigned_by` field and relationships

### Accessing the Admin Panel

1. Log in with admin credentials:
    - Email: `admin@taskmanager.com`
    - Password: `admin123`

2. Click "Admin Panel" in the navigation menu

3. Features available:
    - **Manage Users**: View all registered users and assign tasks
    - **Assign Task**: Click "Assign Task" button next to any user
    - **View All Tasks**: See all assigned tasks and their status

### File Structure

**New Controller:**

- `app/Http/Controllers/AdminController.php` - Handles admin operations

**New Policy:**

- `app/Policies/AdminPolicy.php` - Authorization checks

**New Views:**

- `resources/views/admin/users.blade.php` - User management page
- `resources/views/admin/assign-task.blade.php` - Task assignment form
- `resources/views/admin/tasks.blade.php` - View all assigned tasks

**Updated Files:**

- `routes/web.php` - Added admin routes
- `app/Models/User.php` - Added role field and methods
- `app/Models/Task.php` - Added assigned_by relationship
- `database/seeders/AdminSeeder.php` - Creates default admin
- `database/seeders/DatabaseSeeder.php` - Calls AdminSeeder
- `resources/views/layouts/navigation.blade.php` - Added admin panel link

### Testing the System

1. **Register as a regular user**
    - Go to register page
    - Create a new account
    - Role will be automatically set to 'user'

2. **Log in as admin**
    - Log in with admin@taskmanager.com / admin123
    - Navigate to Admin Panel
    - Assign tasks to registered users

3. **Log in as regular user**
    - Tasks assigned by admin will appear in their dashboard
