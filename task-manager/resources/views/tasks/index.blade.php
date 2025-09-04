@extends('layouts.app')

@section('title', '- Tasks')
@section('page-title', 'Tasks')

@section('breadcrumb')
    <li class="breadcrumb-item active">Tasks</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-tasks mr-1"></i>
                {{ auth()->user()->isAdmin() ? 'All Tasks' : 'My Tasks' }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> New Task
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Search and Filter Form -->
            <form method="GET" action="{{ route('tasks.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search tasks..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="priority" class="form-control">
                            <option value="">All Priority</option>
                            <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-secondary btn-block">
                            <i class="fas fa-search"></i> Filter
                        </button>
                    </div>
                </div>
            </form>

            @if($tasks->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                @if(auth()->user()->isAdmin())
                                    <th>Assigned To</th>
                                @endif
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Due Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>
                                        <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none">
                                            {{ $task->title }}
                                        </a>
                                    </td>
                                    @if(auth()->user()->isAdmin())
                                        <td>{{ $task->user->name }}</td>
                                    @endif
                                    <td>
                                        <span class="badge {{ $task->getStatusBadgeClass() }}">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $task->getPriorityBadgeClass() }}">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </td>
                                    <td>{{ $task->due_date ? $task->due_date->format('M d, Y') : '-' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                                  style="display: inline;"
                                                  onsubmit="return confirm('Are you sure you want to delete this task?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $tasks->links() }}
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No tasks found</h4>
                    <p class="text-muted">
                        @if(request()->hasAny(['search', 'status', 'priority']))
                            Try adjusting your search criteria or
                            <a href="{{ route('tasks.index') }}">clear all filters</a>.
                        @else
                            <a href="{{ route('tasks.create') }}">Create your first task</a> to get started.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
