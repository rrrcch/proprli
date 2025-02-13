<?php

namespace App\Contracts;

interface CommentRepositoryInterface
{
    public function create(array $data): array;
}
