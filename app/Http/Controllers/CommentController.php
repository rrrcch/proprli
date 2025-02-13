<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Services\CommentService;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function __construct(protected CommentService $commentService)
    {
        //
    }

    /**
     * Stores a new comment for a task.
     *
     * @param Task $task
     * @param StoreCommentRequest $request
     * @return JsonResponse
     */
    public function store(string $id, StoreCommentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $comment = $this->commentService->createCommentForTask(
            data: $validated,
            taskId: $id,
            userId: auth()->user()->id,
        );

        return response()->json($comment, 201);
    }
}
