<?php

namespace Modules\Blog\Database\factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    
    protected $model = \Modules\Blog\Entities\Blog::class;

   
    public function definition() :array 
    {
        return [
            'title' => fake()->name(),
            'desc' => fake()->text(),
            'featured_img'=> Str::random(10)
        ];
    }
}

