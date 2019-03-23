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
        \Log::info("get task. user id: " . $user_id);
        return $this->taskRepository->list($user_id);
    }

    public function getTask(int $id, int $user_id)
    {
        return $this->taskRepository->get($id, $user_id);
    }

    public function updateTask(int $id, int $user_id, array $param)
    {
        return $this->taskRepository->update($id, $user_id, $param);
    }

    public function deleteTask(int $id, int $user_id)
    {
        return $this->taskRepository->delete($id, $user_id);
    }
}
