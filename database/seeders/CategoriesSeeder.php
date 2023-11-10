<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Snack', 'type' => 'recipeAndmenu'],
            ['name' => 'Almuerzo', 'type' => 'recipeAndmenu'],
            ['name' => 'Desayuno', 'type' => 'recipeAndmenu'],
            ['name' => 'Comidas', 'type' => 'product'],
            ['name' => 'Accesorios', 'type' => 'product'],
            ['name' => 'Aseo', 'type' => 'product'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
