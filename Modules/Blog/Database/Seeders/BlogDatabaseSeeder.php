<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Blog\Entities\Blog;
use Illuminate\Database\Eloquent\Model;

class BlogDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Model::unguard();
        Blog::factory()->count(200)->create();
    }
}
