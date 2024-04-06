<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->name(),
            'content'=>fake()->text(),
            'status'=>rand(0,1),
            'price' => $this->faker->randomElement([100, 150, 200, 250, 300, 350, 400, 450, 500, 550, 600, 650, 700])
        ];
    }
}
