<?php

namespace Database\Factories;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $image = $this->faker->image('public/storage/recipes', 640, 480, 'receta', false);

        return [
            'name' => $this->faker->sentence(3),
            'images' => 'recipes/' . $image,
            'description' => $this->faker->paragraph(3),
            'ingredients' => $this->faker->paragraph(5),
            'preparation' => $this->faker->paragraph(5),
            'user_id' => 1,
            'category_id'=>1,
        ];
    }
}
