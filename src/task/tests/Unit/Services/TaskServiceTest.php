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
        $result = $this->service->getTasks(1);
        $this->assertSame(10, count($result));
    }

    public function testGetTask()
    {
        $id = 1;
        $user_id = 1;

        $result = $this->service->getTask($id, $user_id);
        $this->assertSame(1, $result->id);
        $this->assertSame(1, $result->user_id);
        $this->assertNotNull($result->contents);
    }

    public function testUpdateTask()
    {
        $id = 1;
        $user_id = 1;
        $param = array(
            'contents' => "hoge!",
        );
        $result = $this->service->updateTask($id, $user_id, $param);
        $this->assertSame(1, $result->id);
        $this->assertSame(1, $result->user_id);
        $this->assertSame($param["contents"], $result->contents);
    }

    public function testDeleteTask()
    {
        $id = 1;
        $user_id = 1;
        $this->service->deleteTask($id, $user_id);
        $this->assertTrue(true);
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

    public function update(int $id, int $user_id, array $param)
    {
        return factory(\App\Models\Task::class)
            ->make([
                'id' => $id,
                'user_id' => $user_id,
                'contents' => $param["contents"],
            ]);
    }

    public function get(int $id, int $user_id)
    {
        return factory(\App\Models\Task::class)
            ->make([
                'id' => $id,
                'user_id' => $user_id,
            ]);
    }

    public function delete(int $id, int $user_id)
    {}
}
