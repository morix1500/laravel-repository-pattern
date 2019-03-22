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
}
