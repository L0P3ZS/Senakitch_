<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $category = Category::where('type', 'product')->first();
        // Product::create([
        //     'name' => 'Cafe Agila Roja',
        //     'price' => 7.000,
        //     'image' => 'cafe.png',
        //     'description' => 'descripcion del producto',
        //     'user_id' => 1,
        //     'category_id' => $category->id
        // ]);

    }
}
