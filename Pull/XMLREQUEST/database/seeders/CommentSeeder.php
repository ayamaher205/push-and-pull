<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::factory()->count(10)->for(
            Post::factory(), 'commentable'
        )->create();
        $users= User::factory()
        ->hasAttached(
            Comment::factory()->count(3),
            ['public' => true]
        )
        ->create();
       
    }
}
