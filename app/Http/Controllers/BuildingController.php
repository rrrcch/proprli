<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\BuildingRepositoryInterface;
use App\Models\Building;
use Illuminate\Http\JsonResponse;

class BuildingController extends Controller
{
    public function __construct(protected BuildingRepositoryInterface $buildingRepository)
    {
        //
    }

    /**
     * Returns a list of buildings.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $buildings = $this->buildingRepository->getAll();

        return response()->json($buildings);
    }
}
