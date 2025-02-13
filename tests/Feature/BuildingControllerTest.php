<?php

namespace Tests\Feature;

use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\FeatureTestCase;

class BuildingControllerTest extends FeatureTestCase
{
    use RefreshDatabase;

    public function test_returns_a_list_of_buildings()
    {
        $buildings = Building::factory()->count(2)->create();

        $response = $this->getJson('/api/buildings');

        $response
            ->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJson($buildings->toArray());
    }
}
