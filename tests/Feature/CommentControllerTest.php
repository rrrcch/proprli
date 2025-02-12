<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_a_new_comment_for_a_task()
    {
        $commentData = Comment::factory([
            'user_id' => $this->user->id,
        ])->make()->toArray();

        $response = $this->postJson("/api/tasks/{$commentData['task_id']}/comments", $commentData);

        $expected = [
            'content' => $commentData['content'],
            'task_id' => $commentData['task_id'],
            'user_id' => $this->user->id,
        ];

        $response->assertStatus(201)->assertJson($expected);

        $this->assertDatabaseHas('comments', $expected);
    }
}
