<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with('user');

        // Admin can see all tasks, users can only see their own
        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Priority filter
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $tasks = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = auth()->user()->isAdmin() ? User::where('role', 'user')->get() : collect();
        return view('tasks.create', compact('users'));
    }

    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();

        // If user is not admin, set user_id to current user
        if (!auth()->user()->isAdmin()) {
            $data['user_id'] = auth()->id();
        }

        Task::create($data);

        return redirect()->route('tasks.index')
                        ->with('success', 'Task created successfully!');
    }

    public function show(Task $task)
    {
        // Check if user can view this task
        if (!auth()->user()->isAdmin() && $task->user_id !== auth()->id()) {
            abort(403, 'You can only view your own tasks.');
        }

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        // Check if user can edit this task
        if (!auth()->user()->isAdmin() && $task->user_id !== auth()->id()) {
            abort(403, 'You can only edit your own tasks.');
        }

        $users = auth()->user()->isAdmin() ? User::where('role', 'user')->get() : collect();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        // Check if user can update this task
        if (!auth()->user()->isAdmin() && $task->user_id !== auth()->id()) {
            abort(403, 'You can only update your own tasks.');
        }

        $data = $request->validated();

        // If user is not admin, preserve the original user_id
        if (!auth()->user()->isAdmin()) {
            $data['user_id'] = $task->user_id;
        }

        $task->update($data);

        return redirect()->route('tasks.index')
                        ->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        // Check if user can delete this task
        if (!auth()->user()->isAdmin() && $task->user_id !== auth()->id()) {
            abort(403, 'You can only delete your own tasks.');
        }

        $task->delete();

        return redirect()->route('tasks.index')
                        ->with('success', 'Task deleted successfully!');
    }
}
