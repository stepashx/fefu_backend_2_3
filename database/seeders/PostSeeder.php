<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        Post::query()->truncate();
        Post::factory(random_int(10, 20))->create();
    }
}
