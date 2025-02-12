<?php

namespace App\Contracts;

use App\Models\Comment;

interface CommentRepositoryInterface
{
    public function create(array $data): Comment;
}
