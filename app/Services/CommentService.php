<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\CommentRepositoryInterface;
use App\Models\Comment;

class CommentService
{
    public function __construct(protected CommentRepositoryInterface $commentRepository)
    {
        //
    }

    /**
     * Creates a new comment for a task.
     *
     * @param array $data
     * @param string $taskId
     * @return Comment
     */
    public function createComment(array $data): Comment
    {
        return $this->commentRepository->create($data);
    }
}
