<?php

namespace App\Http\Controllers;

use App\Services\TaskService;

class TaskController extends Controller
{
    protected $taskService;
    public function __construct(
        TaskService $taskService
    ) {
        $this->middleware('auth');
        $this->taskService = $taskService;
    }

    public function index()
    {
        $this->taskService->registerTask(1, "hoge");
        return view('home');
    }
}
