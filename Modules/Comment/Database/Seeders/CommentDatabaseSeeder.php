<?php

namespace Modules\Comment\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Comment\Entities\Comment;

class CommentDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Model::unguard();

        Comment::factory()->count(50)->create();
    }
}
