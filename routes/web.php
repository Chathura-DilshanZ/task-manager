<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tasks', TaskController::class);
    Route::patch('tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.update-status');
});

// Admin routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/{user}/assign-task', [AdminController::class, 'assignTaskForm'])->name('admin.assign-task-form');
    Route::post('/users/{user}/assign-task', [AdminController::class, 'assignTask'])->name('admin.assign-task');
    Route::get('/tasks', [AdminController::class, 'tasks'])->name('admin.tasks');
    Route::get('/tasks/{task}/edit', [AdminController::class, 'editTask'])->name('admin.tasks.edit');
    Route::patch('/tasks/{task}', [AdminController::class, 'updateTask'])->name('admin.tasks.update');
    Route::delete('/tasks/{task}', [AdminController::class, 'deleteTask'])->name('admin.tasks.delete');
});

require __DIR__ . '/auth.php';
