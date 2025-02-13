<?php

namespace Tests\Unit;

use App\Contracts\BuildingRepositoryInterface;
use App\Contracts\TaskRepositoryInterface;
use App\Services\TaskService;
use Mockery;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class TaskServiceTest extends TestCase
{
    private TaskService $taskService;
    private $buildingRepository;
    private $taskRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->buildingRepository = Mockery::mock(BuildingRepositoryInterface::class);
        $this->taskRepository = Mockery::mock(TaskRepositoryInterface::class);

        $this->taskService = new TaskService($this->buildingRepository, $this->taskRepository);
    }

    public function test_get_tasks_for_a_building(): void
    {
        $buildingId = '1';

        $filters = ['status' => 'open'];

        $tasks = [
            [
                'id' => 1,
                'name' => 'Test task',
                'description' => 'Task description',
                'building_id' => $buildingId,
                'created_by' => 1,
                'assigned_to' => 2,
                'status' => 'open',
                'comments' => [
                    [
                        'id' => 10,
                        'content' => 'Test comment',
                        'task_id' => 1,
                        'user_id' => 2,
                    ],
                ],
            ],
        ];

        $this->taskRepository
            ->shouldReceive('getByBuildingId')
            ->once()
            ->with($buildingId, $filters)
            ->andReturn($tasks);

        $result = $this->taskService->getTasksForBuilding($buildingId, $filters);

        $this->assertSame($tasks, $result);
    }

    public function test_creates_a_task_for_a_building()
    {
        $createdBy = 1;
        $buildingId = 1;

        $taskData = [
            'name' => 'Test Task',
            'description' => 'Task description',
            'building_id' => $buildingId,
            'created_by' => $createdBy,
            'assigned_to' => 1,
            'status' => 'open',
        ];

        $this->buildingRepository
            ->shouldReceive('exists')
            ->with($buildingId)
            ->andReturn(true);

        $this->taskRepository
            ->shouldReceive('create')
            ->with($taskData)
            ->andReturn($taskData);

        $task = $this->taskService->createTaskForBuilding(
            $taskData,
            $buildingId,
            $createdBy
        );

        $this->assertEquals($taskData, $task);
    }

    public function test_fails_to_create_task_for_nonexistent_building()
    {
        $this->expectException(NotFoundHttpException::class);

        $createdBy = 1;
        $buildingId = 2;

        $taskData = [
            'name' => 'Test task',
            'description' => 'Task description',
            'building_id' => $buildingId,
            'created_by' => $createdBy,
            'assigned_to' => 1,
            'status' => 'open',
        ];

        $this->buildingRepository
            ->shouldReceive('exists')
            ->with($buildingId)
            ->andReturn(false);

        $task = $this->taskService->createTaskForBuilding(
            $taskData,
            $buildingId,
            $createdBy
        );
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}

