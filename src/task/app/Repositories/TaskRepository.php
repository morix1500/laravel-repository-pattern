<?php
namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    protected $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function create(int $user_id, string $contents)
    {
        return $this->model->create([
            'user_id' => $user_id,
            'contents' => $contents,
        ]);
    }

    function list(int $user_id) {
        return $this->model->where('user_id', $user_id)->get();
    }
}
