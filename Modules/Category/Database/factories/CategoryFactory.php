<?php

namespace Modules\Category\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = \Modules\Category\Entities\Category::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'image'=> fake()->text()
        ];
    }
}

