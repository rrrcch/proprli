<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Stores a new comment for a task.
     *
     * @param Task $task
     * @param StoreCommentRequest $request
     * @return JsonResponse
     */
    public function store(Task $task, StoreCommentRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $comment = $task->comments()->create($validated);

        return response()->json($comment, 201);
    }
}
