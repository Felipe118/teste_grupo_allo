<?php

namespace App\Repository;

use App\Models\Task;

class TaskRepository
{
    public function __construct(
        protected Task $task,
    ){}

    public function storeTask(array $data)
    {
        $status = isset($data['status']) ? $data['status'] : 'created';
        $user = auth()->user();
        $task = $this->task->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $status,
            'user_id' => $user->id,
        ]);

        return $task;
    }
}