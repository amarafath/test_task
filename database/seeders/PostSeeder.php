<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::insert([
                ['description' => 'First Post'],
                ['description' => 'Second Post'],
                ['description' => 'Third Post'],
                ['description' => 'Fourth Post'],
                ['description' => 'Fifth Post']]
        );




        $second = Post::find(2);

        $second->comments()->saveMany([
            new Comment(['comment' => 'A new comment.']),
            new Comment(['comment' => 'Another new comment.']),
            new Comment(['comment' => '3rd Comment']),
        ]);

        $third = Post::find(3);

        $third->comments()->saveMany([
            new Comment(['comment' => 'A new comment.']),
            new Comment(['comment' => 'Another new comment.']),
        ]);

        $third = Post::find(5);

        $third->comments()->saveMany([
            new Comment(['comment' => 'A new comment.']),
        ]);
    }
}
