<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Building;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    /**
     * Get the tasks for a building with optional filters.
     *
     * @param string $buildingId The ID of the building.
     * @param array $filters
     * @return Collection
     */
    public function getTasksForBuilding(string $buildingId, array $filters = []): Collection
    {
        return Task::query()
            ->forBuilding($buildingId)
            ->createdBetween(
                data_get($filters, 'start_date'),
                data_get($filters, 'end_date')
            )
            ->assignedTo(data_get($filters, 'assigned_to'))
            ->status(data_get($filters, 'status'))
            ->with('comments')
            ->get();
    }

    /**
     * Creates a new task for a building.
     *
     * @param array $data
     * @param string $buildingId
     * @return Task
     */
    public function createTask(array $data, string $buildingId): Task
    {
        $building = Building::findOrFail($buildingId);
        $task = $building->tasks()->create($data);

        return $task;
    }
}
