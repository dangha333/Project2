<?php

namespace Database\Seeders;

use App\Models\Post_comment;
use App\Models\PostComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            PostComment::factory(5)->create();
    }
}
