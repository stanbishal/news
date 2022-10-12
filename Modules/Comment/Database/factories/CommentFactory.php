<?php

namespace Modules\Comment\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = \Modules\Comment\Entities\Comment::class;

    public function definition(): array
    {
        return [
            "news_id" => rand(1,100),
            "content" => fake()->text(50),
            "name" => fake()->name(),
            "email" => fake()->email()
        ];
    }
}

