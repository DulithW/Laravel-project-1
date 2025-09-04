@extends('layouts.app')

@section('title', '- Dashboard')
@section('page-title', 'My Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalTasks }}</h3>
                    <p>Total Tasks</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <a href="{{ route('tasks.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $pendingTasks }}</h3>
                    <p>Pending</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <a href="{{ route('tasks.index', ['status' => 'pending']) }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $inProgressTasks }}</h3>
                    <p>In Progress</p>
                </div>
                <div class="icon">
                    <i class="fas fa-spinner"></i>
                </div>
                <a href="{{ route('tasks.index', ['status' => 'in_progress']) }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $completedTasks }}</h3>
                    <p>Completed</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <a href="{{ route('tasks.index', ['status' => 'completed']) }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Tasks -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-list mr-1"></i>
                My Recent Tasks
            </h3>
            <div class="card-tools">
                <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> New Task
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            @if($recentTasks->count() > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Due Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentTasks as $task)
                            <tr>
                                <td>
                                    <a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a>
                                </td>
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
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center py-4">You have no tasks yet. <a href="{{ route('tasks.create') }}">Create your first task!</a></p>
            @endif
        </div>
    </div>
@endsection
