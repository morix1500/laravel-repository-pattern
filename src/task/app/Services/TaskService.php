<?php

namespace App\Services;

use App\Repositories\TaskRepositoryInterface;

class TaskService extends Service
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function registerTask(string $user_id, string $contents)
    {
        return $this->taskRepository->create($user_id, $contents);
    }
}
