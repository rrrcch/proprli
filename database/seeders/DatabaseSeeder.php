<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Building;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->createMany([
            ['name' => 'Owner'],
            ['name' => 'Team Member 1'],
            ['name' => 'Team Member 2'],
        ]);

        Building::factory()->create([
            'name' => 'Test Building',
        ]);
    }
}
