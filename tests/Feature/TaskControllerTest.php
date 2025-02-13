<?php

namespace Tests\Feature;

use App\Models\Building;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\FeatureTestCase;

class TaskControllerTest extends FeatureTestCase
{
    use RefreshDatabase;

    public function test_returns_a_list_of_tasks_with_comments_for_a_building()
    {
        $building = Building::factory()->create();

        $tasks = Task::factory()
            ->count(2)
            ->for($building)
            ->has(Comment::factory()->count(2))
            ->create();

        $response = $this->getJson("/api/buildings/{$building->id}/tasks");

        $response
            ->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'description',
                    'building_id',
                    'created_by',
                    'assigned_to',
                    'status',
                    'comments' => [
                        '*' => [
                            'id',
                            'content',
                            'task_id',
                            'user_id',
                        ],
                    ],
                ],
            ]);
    }

    public function test_creates_a_new_task_for_a_building()
    {
        $taskData = Task::factory()->make()->toArray();

        $response = $this->postJson("/api/buildings/{$taskData['building_id']}/tasks", $taskData);

        $expected = [
            'name'        => $taskData['name'],
            'description' => $taskData['description'],
            'building_id' => $taskData['building_id'],
            'created_by'  => $this->user->id,
            'assigned_to' => $taskData['assigned_to'],
            'status'      => $taskData['status'],
        ];

        $response->assertStatus(201)->assertJson($expected);

        $this->assertDatabaseHas('tasks', $expected);
    }

    public function test_new_task_fails_validation()
    {
        $taskData = Task::factory([
            'name'        => '',
            'description' => '',
            'status'      => 'foo',
            'assigned_to' => 'bar',
            'status'      => 'baz,'
        ])->make()->toArray();

        $response = $this->postJson("/api/buildings/{$taskData['building_id']}/tasks", $taskData);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
                'description',
                'status',
                'assigned_to',
                'status'
            ]);
    }

    public function test_fails_to_create_task_for_nonexistent_building()
    {
        $taskData = Task::factory()->make()->toArray();

        $response = $this->postJson("/api/buildings/1337/tasks", $taskData);

        $response->assertStatus(404);
    }
}
