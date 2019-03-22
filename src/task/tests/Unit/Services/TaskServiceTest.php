<?php

use App\Services\TaskService;
use Tests\TestCase;

class TaskServiceTest extends TestCase
{
    protected $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = new TaskService(
            new StubTaskServiceTaskRepository
        );
        $this->app->bind(
            \App\Repositories\TaskRepositoryInterface::class,
            \StubTaskServiceTaskRepository::class
        );
    }
    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testRegisterTask()
    {
        $result = $this->service->registerTask(1, "test");
        $this->assertSame(1, $result->id);
        $this->assertSame("test", $result->contents);
    }

    public function testGetTasks()
    {
        $result = $this->service->GetTasks(1);
        $this->assertSame(10, count($result));
    }
}

class StubTaskServiceTaskRepository implements \App\Repositories\TaskRepositoryInterface
{
    public function create(int $user_id, string $contents)
    {
        return factory(\App\Models\Task::class)
            ->make([
                'id' => 1,
                'user_id' => $user_id,
                'contents' => $contents,
            ]);
    }

    function list(int $user_id) {
        return factory(\App\Models\Task::class, 10)->make([
            'user_id' => $user_id,
        ]);
    }
}
