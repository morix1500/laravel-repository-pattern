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

    public function registerTask(int $user_id, string $contents)
    {
        return $this->taskRepository->create($user_id, $contents);
    }

    public function getTasks(int $user_id)
    {
        return $this->taskRepository->list($user_id);
    }
}
