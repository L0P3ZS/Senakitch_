<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description'=> $this->faker->paragraph(3),
            'user_id' => $this->faker->numberBetween(1, 8), //numero entre 1 y 8 
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
