<?php

namespace Tests\Feature;

use App\BlogPost;
use App\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');
        $response->assertSeeText('No Blog Posts Yet !!!');
    }

    public function testSee1BlogPostWhenThereIs1WithNoComments()
    {
        $post = $this->createDummyBlogPost();

        $response = $this->get('/posts');
        $response->assertSeeText('New title from');
        // $response->assertSeeText('0'); // if empty comment return this message in index.blade of post

        $this->assertDatabaseHas('blog_posts',[
            'title' => 'New title from test'
        ]);
    }

    public function testSee1BlogPostWithComments()
    {
        $user = $this->user();
        $post = $this->createDummyBlogPost();
        factory(Comment::class, 4)->create([
            'commentable_id' => $post->id,
            'commentable_type' => 'App\BlogPost',
            'user_id' => $user->id,
        ]);

        $response = $this->get('/posts');

        $response->assertSeeText('4');
    }

    public function testStoreValid()
    {
        $params = [
            'title' => 'Valid Title',
            'content' => 'At least 10 characters', 
        ];

        $this->actingAs($this->user())
            ->post('/posts',$params)
            ->assertStatus(302)
            ->assertSessionHas('success');
        $this->assertEquals(session('success'),'Blog Post Has Been Created Successfuly.');
    }

    public function testStoreFail()
    {
        $params = [
            'title' => 'X',
            'content' => 'xx', 
        ];
        $this->actingAs($this->user())
            ->post('/posts',$params)
            ->assertStatus(302)
            ->assertSessionHas('errors');
        $message = session('errors')->getMessages();
        $this->assertEquals($message['title'][0],'The title must be at least 5 characters.');
        $this->assertEquals($message['content'][0],'The content must be at least 10 characters.');
    }

    public function testUpdateValid()
    {
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);

        $this->assertDatabaseHas('blog_posts',$post->toArray());

        $params = [
            'title' => 'New Update From Test !',
            'content' => 'Content was changed by test update !?!', 
        ];
        $this->actingAs($user)
            ->put("/posts/{$post->id}",$params)
            ->assertStatus(302)
            ->assertSessionHas('success');
        $this->assertEquals(session('success'),'Blog post has been updated.');
        $this->assertDatabaseMissing('blog_posts',$post->toArray());
        $this->assertDatabaseHas('blog_posts',[
            'title' => 'New Update From Test !',
            'content' => 'Content was changed by test update !?!', 
        ]);
    }

    public function testDelete()
    {
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);
        $this->assertDatabaseHas('blog_posts',$post->toArray());

        $this->actingAs($user)
            ->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('danger');
        $this->assertEquals(session('danger'),'Blog post has been deleted!');
        // $this->assertDatabaseMissing('blog_posts',$post->toArray());
        $this->assertSoftDeleted('blog_posts', $post->toArray());
    }

    private function createDummyBlogPost($userId = null): BlogPost
    {
        // $post = new BlogPost();
        // $post->title = 'New title from test';
        // $post->content = 'Content of Post from test';
        // $post->save();

        return factory(BlogPost::class)->states('new-title')->create([
            'user_id' => $userId ?? $this->user()->id,
        ]);

        // return $post;
    }
}
