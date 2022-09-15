<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->title(),
            'slug'=>$this->faker->slug(),
            'shortDescription'=>$this->faker->sentence(),
            'full_description'=>$this->faker->paragraph(),
            'user_id'=>User::first() ?? User::factory(),
        ];
    }
}
