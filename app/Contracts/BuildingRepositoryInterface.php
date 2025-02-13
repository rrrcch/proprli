<?php

namespace App\Contracts;

interface BuildingRepositoryInterface
{
    public function getAll(): array;
    public function exists(string $id): bool;
}
