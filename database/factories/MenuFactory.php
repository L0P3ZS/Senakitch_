<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image = $this->faker->image('public/storage/Menus', 640, 480, 'menu', false);
        $category = Category::where('type', 'recipeAndmenu')->first();
        return [
            'name' => implode(' ', $this->faker->words(3)),// generará una lista de 3 palabras aleatorias, y luego utilizamos  implode()  para unir las palabras con un espacio y obtener una cadena de texto. 
            'price' =>  $this->faker->randomNumber(4),
            'image_path' => 'Menus/' . $image,
            // 'description' => $this->faker->paragraph(3),
            'user_id' => 8,
            'category_id'=>$category->id,
        ];
    }
}
