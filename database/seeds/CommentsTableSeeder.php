<?php

use App\Comment;
use App\BlogPost;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = BlogPost::all();
        $users = App\User::all();

        if ($posts->count() < 1 || $users->count() < 1) {
            $this->command->info('Sorry, But there ain\'t no comment');
            return;
        }

        $commentCount = (int)$this->command->ask('Comment Count : ', 150);
        factory(Comment::class, $commentCount)->make()->each(function($comment) use ($posts, $users){
            $comment->commentable_id = $posts->random()->id;
            $comment->commentable_type = 'App\BlogPost';
            $comment->user_id = $users->random()->id;
            $comment->save();
        });

        factory(Comment::class, $commentCount)->make()->each(function($comment) use ($users){
            $comment->commentable_id = $users->random()->id;
            $comment->commentable_type = 'App\User';
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}
