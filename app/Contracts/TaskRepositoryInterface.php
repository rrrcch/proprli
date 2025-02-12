<?php

namespace App\Contracts;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function getByBuildingId(string $buildingId, array $filters = []);
    public function create(array $data): Task;
}
