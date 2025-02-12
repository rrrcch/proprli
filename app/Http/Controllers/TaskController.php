<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService)
    {
    }

    /**
     * Returns a list of tasks for a building.
     *
     * @param string $id The building ID
     * @param Request $request
     * @return JsonResponse
     */
    public function index(string $id, Request $request): JsonResponse
    {
        $filters = $request->only([
            'start_date',
            'end_date',
            'assigned_to',
            'status',
        ]);

        $tasks = $this->taskService->getTasksForBuilding($id, $filters);

        return response()->json($tasks);
    }

    /**
     * Stores a new task for a building.
     *
     * @param string $id The building ID
     * @param StoreTaskRequest $request
     * @return JsonResponse
     */
    public function store(string $id, StoreTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $validated['building_id'] = $id;
        $validated['created_by'] = auth()->user()->id;

        $task = $this->taskService->createTask($validated);

        return response()->json($task, 201);
    }
}
