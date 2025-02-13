<?php

namespace App\Contracts;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function getByBuildingId(string $buildingId, array $filters = []);
    public function exists(string $id): bool;
    public function create(array $data): Task;
}
