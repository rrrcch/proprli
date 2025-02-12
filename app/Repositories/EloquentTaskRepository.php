<?php

namespace App\Repositories;

use App\Contracts\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class EloquentTaskRepository implements TaskRepositoryInterface
{
    /**
     * Get the tasks for a building with optional filters.
     *
     * @param string $buildingId
     * @param array $filters
     * @return Collection
     */
    public function getByBuildingId(string $buildingId, array $filters = []): Collection
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
     * @return Task
     */
    public function create(array $data): Task
    {
        return Task::create($data);
    }
}
