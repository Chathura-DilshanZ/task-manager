<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Task::where('user_id', $request->user()->id);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $tasks = $query->paginate(5);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $validated['user_id'] = $request->user()->id;

        Task::create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            abort(403);
        }

        // If the task was assigned by an admin, disallow full edit from the assignee.
        if ($task->assigned_by && !$request->user()->isAdmin()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            abort(403);
        }

        // Prevent assignees from changing full task fields if task was assigned by admin
        if ($task->assigned_by && !$request->user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,completed',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Prevent assignees from deleting tasks that were created/assigned by admins
        if ($task->assigned_by && !request()->user()->isAdmin()) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('tasks.index');
    }

    /**
     * Allow assignee to update only status and an optional short note.
     */
    public function updateStatus(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,completed',
            'status_note' => 'nullable|string|max:255',
        ]);

        $task->status = $validated['status'];
        $task->status_note = $validated['status_note'] ?? null;
        $task->save();

        return redirect()->route('tasks.index')
            ->with('success', 'Status updated successfully.');
    }
}
