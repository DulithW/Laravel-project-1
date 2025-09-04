<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalTasks = Task::count();
        $pendingTasks = Task::where('status', 'pending')->count();
        $completedTasks = Task::where('status', 'completed')->count();
        $recentTasks = Task::with('user')->latest()->take(5)->get();

        return view('dashboard.admin', compact(
            'totalUsers', 'totalTasks', 'pendingTasks',
            'completedTasks', 'recentTasks'
        ));
    }

    public function user()
    {
        $user = auth()->user();
        $totalTasks = $user->tasks()->count();
        $pendingTasks = $user->tasks()->where('status', 'pending')->count();
        $inProgressTasks = $user->tasks()->where('status', 'in_progress')->count();
        $completedTasks = $user->tasks()->where('status', 'completed')->count();
        $recentTasks = $user->tasks()->latest()->take(5)->get();

        return view('dashboard.user', compact(
            'totalTasks', 'pendingTasks', 'inProgressTasks',
            'completedTasks', 'recentTasks'
        ));
    }
}
