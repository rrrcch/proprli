<?php

namespace App\Repositories;

use App\Contracts\CommentRepositoryInterface;
use App\Models\Comment;

class EloquentCommentRepository implements CommentRepositoryInterface
{
    /**
     * Creates a new comment for a task.
     *
     * @param array $data
     * @return Task
     */
    public function create(array $data): Comment
    {
        return Comment::create($data);
    }
}
