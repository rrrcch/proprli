<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\CommentRepositoryInterface;
use App\Contracts\TaskRepositoryInterface;
use App\Models\Comment;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentService
{
    public function __construct(
        protected CommentRepositoryInterface $commentRepository,
        protected TaskRepositoryInterface $taskRepository
    ) {
        //
    }

    /**
     * Creates a new comment for a task.
     *
     * @param array $data
     * @param string $taskId
     * @param int $userId
     * @return array
     */
    public function createCommentForTask(array $data, string $taskId, int $userId): array
    {
        if (!$this->taskRepository->exists($taskId)) {
            throw new NotFoundHttpException('Task not found.');
        }

        $data['task_id'] = $taskId;
        $data['user_id'] = $userId;

        return $this->commentRepository->create($data);
    }
}
