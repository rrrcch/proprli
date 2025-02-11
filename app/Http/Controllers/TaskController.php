<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Building $building, Request $request): JsonResponse
    {
        $task = $building->tasks()->create($request->all());

        return response()->json($task, 201);
    }
}
