<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\JsonResponse;

class BuildingController extends Controller
{
    /**
     * Returns a list of buildings.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $buildings = Building::all();

        return response()->json($buildings);
    }
}
