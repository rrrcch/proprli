<?php

namespace Tests\Feature;

use App\Models\Building;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_a_new_comment_for_a_task()
    {
        $commentData = Comment::factory()->make()->toArray();

        $response = $this->postJson("/api/tasks/{$commentData['task_id']}/comments", $commentData);

        $expected = [
            'content' => $commentData['content'],
            'task_id' => $commentData['task_id'],
            'user_id' => $commentData['user_id'],
        ];

        $response->assertStatus(201)->assertJson($expected);

        $this->assertDatabaseHas('comments', $expected);
    }
}
