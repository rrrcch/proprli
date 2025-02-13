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
     * @return array
     */
    public function getByBuildingId(string $buildingId, array $filters = []): array
    {
        return Task::query()
            ->forBuilding($buildingId)
            ->createdBetween(
                data_get($filters, 'start_date'),
                data_get($filters, 'end_date')
            )
            ->assignedTo(data_get($filters, 'assigned_to'))
            ->status(data_get($filters, 'status'))
            ->with([
                'creator',
                'assignedUser',
                'comments.user',
            ])
            ->get()
            ->toArray();
    }

    /**
     * Check if a task ID exists.
     *
     * @param string $id
     * @return bool
     */
    public function exists(string $id): bool
    {
        return Task::where('id', $id)->exists();
    }

    /**
     * Creates a new task for a building.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return Task::create($data)->toArray();
    }
}
