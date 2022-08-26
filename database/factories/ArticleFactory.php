<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;
    public function definition(): array
    {
        return [
          'title' => $this->faker->unique()->sentence,
          'slug' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'link'=> $this->faker->url,
            'category_id'=> 2
        ];
        // TODO: Implement definition() method.
    }
}
