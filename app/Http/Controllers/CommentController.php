<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Stores a new comment for a task.
     *
     * @param Task $task
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Task $task, Request $request): JsonResponse
    {
        $comment = $task->comments()->create($request->all());

        return response()->json($comment, 201);
    }
}
