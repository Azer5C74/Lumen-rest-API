<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    public function definition(): array
    {
    	return [
    	    "title"=>$this->faker->unique()->sentence,
            'slug' => $this->faker->sentence,
    	];
    }
}
