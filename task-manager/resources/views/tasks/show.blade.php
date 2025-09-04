{{-- resources/views/tasks/show.blade.php --}}
@extends('layouts.app')

@section('title', '- View Task')
@section('page-title', 'Task Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
    <li class="breadcrumb-item active">{{ $task->title }}</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-eye mr-1"></i>
                {{ $task->title }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                      style="display: inline;"
                      onsubmit="return confirm('Are you sure you want to delete this task?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h4>Description</h4>
                    <p class="text-muted">
                        {{ $task->description ?: 'No description provided.' }}
                    </p>

                    <h4 class="mt-4">Task Information</h4>
                    <dl class="row">
                        <dt class="col-sm-3">Created:</dt>
                        <dd class="col-sm-9">{{ $task->created_at->format('M d, Y g:i A') }}</dd>

                        <dt class="col-sm-3">Last Updated:</dt>
                        <dd class="col-sm-9">{{ $task->updated_at->format('M d, Y g:i A') }}</dd>

                        @if(auth()->user()->isAdmin())
                            <dt class="col-sm-3">Assigned To:</dt>
                            <dd class="col-sm-9">{{ $task->user->name }}</dd>
                        @endif
                    </dl>
                </div>

                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Task Status</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Status:</strong><br>
                                <span class="badge badge-lg {{ $task->getStatusBadgeClass() }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <strong>Priority:</strong><br>
                                <span class="badge badge-lg {{ $task->getPriorityBadgeClass() }}">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <strong>Due Date:</strong><br>
                                @if($task->due_date)
                                    {{ $task->due_date->format('M d, Y') }}
                                    @if($task->due_date->isPast() && $task->status !== 'completed')
                                        <small class="text-danger d-block">Overdue</small>
                                    @elseif($task->due_date->isToday())
                                        <small class="text-warning d-block">Due Today</small>
                                    @elseif($task->due_date->isTomorrow())
                                        <small class="text-info d-block">Due Tomorrow</small>
                                    @endif
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Tasks
            </a>
        </div>
    </div>
@endsection
