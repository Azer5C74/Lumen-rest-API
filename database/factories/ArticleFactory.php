<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->sentence,
            'slug' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'link' => $this->faker->url,
            'category_id' => $this->faker->randomElement([1,2,3]),
            'user_id' => User::all()->random()->id

        ];
        // TODO: Implement definition() method.
    }
}
