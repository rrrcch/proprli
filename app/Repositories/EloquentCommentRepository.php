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
     * @return array
     */
    public function create(array $data): array
    {
        return Comment::create($data)->toArray();
    }
}
