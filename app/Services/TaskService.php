<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    public function __construct(protected TaskRepositoryInterface $taskRepository)
    {
        //
    }

    /**
     * Get the tasks for a building with optional filters.
     *
     * @param string $buildingId
     * @param array $filters
     * @return Collection
     */
    public function getTasksForBuilding(string $buildingId, array $filters = []): Collection
    {
        return $this->taskRepository->getByBuildingId($buildingId, $filters);
    }

    /**
     * Creates a new task for a building.
     *
     * @param array $data
     * @return Task
     */
    public function createTask(array $data): Task
    {
        return $this->taskRepository->create($data);
    }
}
