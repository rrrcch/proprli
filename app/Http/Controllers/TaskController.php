<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Building;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * Returns a list of tasks for a building.
     *
     * @param Building $building
     * @return JsonResponse
     */
    public function index(Building $building): JsonResponse
    {
        $tasks = $building->tasks()
            ->with('comments')
            ->get();

        return response()->json($tasks);
    }

    /**
     * Stores a new task for a building.
     *
     * @param Building $building
     * @param StoreTaskRequest $request
     * @return JsonResponse
     */
    public function store(Building $building, StoreTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $task = $building->tasks()->create($validated);

        return response()->json($task, 201);
    }
}
