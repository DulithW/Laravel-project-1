<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();

        if ($users->count() === 0) {
            return;
        }

        $tasks = [
            [
                'title' => 'Complete project proposal',
                'description' => 'Write and submit the project proposal for the new client.',
                'status' => 'in_progress',
                'priority' => 'high',
                'due_date' => now()->addDays(3),
            ],
            [
                'title' => 'Review code changes',
                'description' => 'Review the pull request submitted by the development team.',
                'status' => 'pending',
                'priority' => 'medium',
                'due_date' => now()->addDays(2),
            ],
            [
                'title' => 'Update documentation',
                'description' => 'Update the API documentation with the latest changes.',
                'status' => 'completed',
                'priority' => 'low',
                'due_date' => now()->subDays(1),
            ],
            [
                'title' => 'Client meeting preparation',
                'description' => 'Prepare presentation slides for the upcoming client meeting.',
                'status' => 'pending',
                'priority' => 'high',
                'due_date' => now()->addDays(5),
            ],
            [
                'title' => 'Database optimization',
                'description' => 'Optimize database queries to improve application performance.',
                'status' => 'in_progress',
                'priority' => 'medium',
                'due_date' => now()->addWeek(),
            ],
            [
                'title' => 'Security audit',
                'description' => 'Conduct a comprehensive security audit of the application.',
                'status' => 'pending',
                'priority' => 'high',
                'due_date' => now()->addDays(10),
            ],
            [
                'title' => 'Test deployment pipeline',
                'description' => 'Test the CI/CD pipeline for the staging environment.',
                'status' => 'completed',
                'priority' => 'medium',
                'due_date' => now()->subDays(3),
            ],
            [
                'title' => 'User interface improvements',
                'description' => 'Implement UI/UX improvements based on user feedback.',
                'status' => 'in_progress',
                'priority' => 'low',
                'due_date' => now()->addDays(14),
            ],
        ];

        foreach ($tasks as $taskData) {
            $taskData['user_id'] = $users->random()->id;
            Task::create($taskData);
        }
    }
}
