<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\BuildingRepositoryInterface;
use App\Contracts\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TaskService
{
    public function __construct(
        protected BuildingRepositoryInterface $buildingRepository,
        protected TaskRepositoryInterface $taskRepository
    ) {
        //
    }

    /**
     * Get the tasks for a building with optional filters.
     *
     * @param string $buildingId
     * @param array $filters
     * @return Collection
     */
    public function getTasksForBuilding(string $buildingId, array $filters = []): array
    {
        return $this->taskRepository->getByBuildingId($buildingId, $filters);
    }

    /**
     * Creates a new task for a building.
     *
     * @param array $data
     * @param string $buildingId
     * @param int $createdBy
     * @return array
     */
    public function createTaskForBuilding(array $data, string $buildingId, int $createdBy): array
    {
        if (!$this->buildingRepository->exists($buildingId)) {
            throw new NotFoundHttpException('Building not found.');
        }

        $data['building_id'] = $buildingId;
        $data['created_by'] = $createdBy;

        return $this->taskRepository->create($data);
    }
}
