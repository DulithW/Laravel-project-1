@extends('layouts.app')

@section('title', '- Profile')
@section('page-title', 'My Profile')

@section('breadcrumb')
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <!-- Profile Info Card -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <i class="fas fa-user-circle fa-5x text-muted mb-3"></i>
                        <h3 class="profile-username">{{ auth()->user()->name }}</h3>
                        <p class="text-muted">
                            <span class="badge badge-{{ auth()->user()->isAdmin() ? 'danger' : 'primary' }}">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </p>
                    </div>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <span class="float-right">{{ auth()->user()->email }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Member Since</b> <span class="float-right">{{ auth()->user()->created_at->format('M Y') }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Total Tasks</b> <span class="float-right">{{ auth()->user()->tasks()->count() }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Completed Tasks</b> <span class="float-right">{{ auth()->user()->tasks()->where('status', 'completed')->count() }}</span>
                        </li>
                    </ul>

                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-block">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Recent Activity -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history mr-1"></i>
                        Recent Tasks Activity
                    </h3>
                </div>
                <div class="card-body">
                    @php
                        $recentTasks = auth()->user()->tasks()->latest()->limit(5)->get();
                    @endphp

                    @if($recentTasks->count() > 0)
                        <div class="timeline">
                            @foreach($recentTasks as $task)
                                <div class="time-label">
                                    <span class="bg-{{ $task->getStatusBadgeClass() == 'badge-success' ? 'success' : ($task->getStatusBadgeClass() == 'badge-warning' ? 'warning' : 'info') }}">
                                        {{ $task->updated_at->format('M d') }}
                                    </span>
                                </div>
                                <div>
                                    <i class="fas fa-tasks bg-blue"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header">
                                            <a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a>
                                            <span class="badge {{ $task->getStatusBadgeClass() }} float-right">
                                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                            </span>
                                        </h3>
                                        <div class="timeline-body">
                                            {{ Str::limit($task->description, 100) }}
                                        </div>
                                        <div class="timeline-footer">
                                            <small class="text-muted">
                                                Priority:
                                                <span class="badge {{ $task->getPriorityBadgeClass() }}">
                                                    {{ ucfirst($task->priority) }}
                                                </span>
                                                @if($task->due_date)
                                                    | Due: {{ $task->due_date->format('M d, Y') }}
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div>
                                <i class="fas fa-clock bg-gray"></i>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No tasks yet</h4>
                            <p class="text-muted">
                                <a href="{{ route('tasks.create') }}">Create your first task</a> to see activity here.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
