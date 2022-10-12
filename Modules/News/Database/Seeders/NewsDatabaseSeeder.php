<?php

namespace Modules\News\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\News\Entities\News;

class NewsDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Model::unguard();
        News::factory()->count(100)->create();
    }
}
