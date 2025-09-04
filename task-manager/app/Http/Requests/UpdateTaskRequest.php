<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,in_progress,completed',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
        ];

        // Only admin can reassign tasks
        if (auth()->user()->isAdmin()) {
            $rules['user_id'] = 'required|exists:users,id';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Task title is required.',
            'title.max' => 'Task title cannot exceed 255 characters.',
            'status.in' => 'Please select a valid status.',
            'priority.in' => 'Please select a valid priority.',
            'user_id.exists' => 'Please select a valid user.',
        ];
    }
}
