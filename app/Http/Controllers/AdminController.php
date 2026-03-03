<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show all users for task assignment
     */
    public function users(Request $request)
    {
        if (!Auth::check() || !$request->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $users = User::where('role', 'user')->get();
        return view('admin.users', compact('users'));
    }

    /**
     * Show form to assign task to user
     */
    public function assignTaskForm(Request $request, User $user)
    {
        if (!Auth::check() || !$request->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        return view('admin.assign-task', compact('user'));
    }

    /**
     * Store assigned task
     */
    public function assignTask(Request $request, User $user)
    {
        if (!Auth::check() || !$request->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
            'user_id' => $user->id,
            'assigned_by' => $request->user()->id,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.users')->with('success', 'Task assigned successfully!');
    }

    /**
     * View all assigned tasks
     */
    public function tasks(Request $request)
    {
        if (!Auth::check() || !$request->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $tasks = Task::with('user', 'assignedBy')->get();
        return view('admin.tasks', compact('tasks'));
    }
}
