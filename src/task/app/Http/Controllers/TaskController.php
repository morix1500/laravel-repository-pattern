<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(
        TaskService $taskService
    ) {
        $this->middleware('auth');
        $this->taskService = $taskService;
    }

    public function index(Request $req)
    {
        $tasks = $this->taskService->getTasks($req->user()->id);
        return view('home', [
            'tasks' => $tasks,
        ]);
    }

    public function create(TaskRequest $req)
    {
        $this->taskService->registerTask($req->user()->id, $req->contents);

        return redirect('/');
    }

    public function edit(Request $req, int $task_id)
    {
        $task = $this->taskService->getTask($task_id, $req->user()->id);

        return view('tasks.edit', [
            'contents' => $task->contents,
        ]);
    }

    public function editComplete(TaskRequest $req, int $task_id)
    {
        $param = array(
            'contents' => $req->contents,
        );

        $task = $this->taskService->updateTask($task_id, $req->user()->id, $param);

        return redirect('/');
    }

    public function delete(Request $req, int $task_id)
    {
        $this->taskService->deleteTask($task_id, $req->user()->id);

        return redirect('/');
    }
}
