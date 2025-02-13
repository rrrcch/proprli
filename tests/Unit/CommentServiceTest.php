<?php

namespace Tests\Unit;

use App\Contracts\CommentRepositoryInterface;
use App\Contracts\TaskRepositoryInterface;
use App\Services\CommentService;
use Mockery;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class CommentServiceTest extends TestCase
{
    private CommentService $commentService;
    private $commentRepository;
    private $taskRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->commentRepository = Mockery::mock(CommentRepositoryInterface::class);
        $this->taskRepository = Mockery::mock(TaskRepositoryInterface::class);

        $this->commentService = new CommentService($this->commentRepository, $this->taskRepository);
    }

    public function test_creates_a_comment_for_a_task()
    {
        $taskId = 1;
        $userId = 1;

        $commentData = [
            'content' => 'Test comment',
            'task_id' => $taskId,
            'user_id' => $userId,
        ];

        $this->taskRepository
            ->shouldReceive('exists')
            ->with($taskId)
            ->andReturn(true);

        $this->commentRepository
            ->shouldReceive('create')
            ->with($commentData)
            ->andReturn($commentData);

        $comment = $this->commentService->createCommentForTask(
            $commentData,
            $taskId,
            $userId
        );

        $this->assertEquals($commentData, $comment);
    }

    public function test_fails_to_create_comment_for_nonexistent_task()
    {
        $this->expectException(NotFoundHttpException::class);

        $taskId = 2;
        $userId = 1;

        $commentData = [
            'content' => 'Test comment',
            'task_id' => $taskId,
            'user_id' => $userId,
        ];

        $this->taskRepository
            ->shouldReceive('exists')
            ->with($taskId)
            ->andReturn(false);

        $this->commentService->createCommentForTask(
            $commentData,
            $taskId,
            $userId
        );
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}

