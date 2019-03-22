<?php

use App\Repositories\TaskRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskRepositoryTest extends TestCase
{
    use RefreshDatabase;
    protected $repo;

    public function setUp(): void
    {
        parent::setUp();

        $model = new \App\Models\Task();
        $this->repo = new TaskRepository($model);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testCreateTask()
    {
        $result = $this->repo->create(1, "test!");

        $this->assertEquals(1, $result->user_id);
        $this->assertEquals("test!", $result->contents);
    }

    public function testListTask()
    {
        $target_user_id = 2;

        // insert test data
        $this->repo->create(999, "test!!!");
        $this->repo->create($target_user_id, "test!");
        $this->repo->create($target_user_id, "test!!");

        // test
        $result = $this->repo->list($target_user_id);

        $this->assertEquals(2, count($result));
        $this->assertEquals("test!", $result[0]->contents);
        $this->assertEquals("test!!", $result[1]->contents);
    }

    public function testUpdateTask()
    {
        $current_user_id = 3;

        // insert test data
        $task1 = $this->repo->create($current_user_id, "test!!!");
        $task2 = $this->repo->create(999, "test!!!");

        // test
        $param = array(
            'contents' => "update",
        );
        $result = $this->repo->update($task1->id, $current_user_id, $param);

        $this->assertEquals($task1->id, $result->id);
        $this->assertEquals($task1->user_id, $result->user_id);
        $this->assertEquals("update", $result->contents);

        // 所有者じゃないユーザが更新しようとしたらNullになる
        $result = $this->repo->update($task2->id, $current_user_id, $param);
        $this->assertNull($result);
    }

    public function testGetTask()
    {
        $current_user_id = 4;

        // insert test data
        $task1 = $this->repo->create($current_user_id, "test!!!");
        $task2 = $this->repo->create(999, "test!!!");

        // test
        $result = $this->repo->get($task1->id, $current_user_id);
        $this->assertEquals($task1->id, $result->id);
        $this->assertEquals($task1->user_id, $result->user_id);
        $this->assertEquals($task1->contents, $result->contents);

        // 所有者じゃないユーザが更新しようとしたらNullになる
        $result = $this->repo->get($task2->id, $current_user_id);
        $this->assertNull($result);
    }
}
