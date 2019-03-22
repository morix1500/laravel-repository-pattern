<?php

namespace App\Http\Controllers;

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

    public function create(Request $req)
    {
        $this->validate($req, [
            'contents' => 'required|max:100',
        ]);

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

    public function editComplete(Request $req, int $task_id)
    {
        $this->validate($req, [
            'contents' => 'required|max:100',
        ]);
        $param = array(
            'contents' => $req->contents,
        );
        $task = $this->taskService->updateTask($task_id, $req->user()->id, $param);

        return redirect('/');
    }
}
