<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Post::query()->delete();
    }

    public function test_model_uses_the_posts_table(): void
    {
        $this->assertSame('posts', (new Post)->getTable());
    }

    public function test_store_creates_a_post(): void
    {
        $response = $this->postJson('/api/posts', [
            'title' => 'First post',
            'body' => 'Hello MongoDB',
            'slug' => 'first-post',
        ]);

        $response->assertCreated();
        $response->assertJson(['result' => 'ok']);

        $this->assertSame(1, Post::where('slug', 'first-post')->count());
    }

    public function test_update_changes_an_existing_post(): void
    {
        $post = $this->createPost();

        $response = $this->putJson("/api/posts/{$post->id}", [
            'title' => 'Updated post',
            'body' => 'Hello again',
            'slug' => 'updated-post',
        ]);

        $response->assertOk();
        $response->assertJson(['result' => 'ok']);

        $post->refresh();

        $this->assertSame('Updated post', $post->title);
        $this->assertSame('updated-post', $post->slug);
    }

    public function test_update_returns_not_found_for_an_unknown_post(): void
    {
        $response = $this->putJson('/api/posts/000000000000000000000000', [
            'title' => 'Updated post',
            'body' => 'Hello again',
            'slug' => 'updated-post',
        ]);

        $response->assertNotFound();
    }

    public function test_destroy_deletes_an_existing_post(): void
    {
        $post = $this->createPost();

        $response = $this->deleteJson("/api/posts/{$post->id}");

        $response->assertOk();
        $response->assertJson(['result' => 'ok']);

        $this->assertNull(Post::find($post->id));
    }

    public function test_destroy_returns_not_found_for_an_unknown_post(): void
    {
        $response = $this->deleteJson('/api/posts/000000000000000000000000');

        $response->assertNotFound();
    }

    private function createPost(): Post
    {
        $post = new Post;
        $post->title = 'First post';
        $post->body = 'Hello MongoDB';
        $post->slug = 'first-post';
        $post->save();

        return $post;
    }
}
