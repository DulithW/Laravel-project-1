<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'due_date' => 'nullable|date|after:today',
        ];

        // Only admin can assign tasks to users
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
            'due_date.after' => 'Due date must be in the future.',
            'user_id.exists' => 'Please select a valid user.',
        ];
    }
}
