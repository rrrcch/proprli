<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Comment;
use App\Models\Task;

class CommentService
{
    /**
     * Creates a new comment for a task.
     *
     * @param array $data
     * @param string $taskId
     * @return Comment
     */
    public function createComment(array $data, string $taskId): Comment
    {
        $task = Task::findOrFail($taskId);
        $comment = $task->comments()->create($data);

        return $comment;
    }
}
