<?php

namespace Modules\News\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
   
    protected $model = \Modules\News\Entities\News::class;

    public function definition()
    {
        return [
            "category_id" => rand(1,10),
            "title" => fake()->name(),
            "content" => fake()->text(500),
            "featured_img" => fake()->text(10),
            "publish_status" => rand(0,1),
            "comment_status" => rand(0,1),
            "author_id" => rand(1,10)
        ];
    }
}

