<?php

namespace App\Repositories;

use App\Contracts\BuildingRepositoryInterface;
use App\Models\Building;
use Illuminate\Database\Eloquent\Collection;

class EloquentBuildingRepository implements BuildingRepositoryInterface
{
    /**
     * Gets all buildings.
     *
     * @return array
     */
    public function getAll(): array
    {
        return Building::all()->toArray();
    }

    /**
     * Check if a building ID exists.
     *
     * @param string $id
     * @return bool
     */
    public function exists(string $id): bool
    {
        return Building::where('id', $id)->exists();
    }
}
