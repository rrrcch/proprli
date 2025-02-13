<?php

namespace App\Contracts;

interface TaskRepositoryInterface
{
    public function getByBuildingId(string $buildingId, array $filters = []): array;
    public function exists(string $id): bool;
    public function create(array $data): array;
}
