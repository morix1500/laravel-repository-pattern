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

    public function get(int $id, int $user_id)
    {
        return $this->model->currentUser($user_id)->find($id);
    }

    public function update(int $id, int $user_id, array $param)
    {
        $task = $this->get($id, $user_id);
        if (!empty($task)) {
            $task->fill($param)->save();
        }
        return $task;
    }

    public function delete(int $id, int $user_id)
    {
        $this->model->currentUser($user_id)->where('id', $id)->delete();
    }
}
