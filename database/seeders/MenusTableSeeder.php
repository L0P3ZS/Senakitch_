<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::where('type', 'recipeAndmenu')->first();

        Menu::create([
            'name' => 'Bandeja paisa',
            // 'slug' => 'votro-3557',
            // 'details' => '15 pulgadas, 1TB HDD, 8GB RAM',
            'price' => 12.000,
            // 'shipping_cost' => 19.99,
            // 'description' => 'Dell Vosro 35',
            'image_path' => 'bandeja.jpg',
            'user_id' => 2,
            'category_id' => $category->id,
        ]);

         Menu::create([
             'name' => 'Ajiaco',
        //     // 'slug' => 'iphone-1-pro',
        //     // 'details' => '6.1 pulgadas, 64GB 4GB RAM',
             'price' => 8.000,
            //  'shipping_cost' => 14.99,
        //     // 'description' => 'iPhone  Pro',
             'image_path' => 'ajiaco.jpg',
             'user_id' => 3,
             'category_id' => $category->id,
         ]);

         Menu::create([
             'name' => 'Arepas',
             // 'slug' => 'remax-610d',
             // 'details' => '6.1 pulgadas, 64GB 4GB RAM',
             'price' => 7.000,
            //  'shipping_cost' => 1.89,
             // 'description' => 'Remax 610D Headset',
             'image_path' => 'arepa.jpg',
             'user_id' => 4,
             'category_id' => $category->id,
         ]);

         Menu::create([
             'name' => 'Donas',
             // 'slug' => 'samsung-led-24',
             // 'details' => '24 pulgadas, LED Display, Resolución 1366 x 768',
             'price' => 13.000,
            //  'shipping_cost' => 1.59,
             // 'description' => 'Samsung LED TV',
             'image_path' => 'donuts.png',
             'user_id' => 1,
             'category_id' => $category->id,
         ]);

     
         Menu::create([
             'name' => 'Rollo de carne',
             // 'slug' => 'gr5-2017',
             // 'details' => '5.5 pulgadas, 32GB 4GB RAM',
             'price' => 148.99,
            //  'shipping_cost' => 6.79,
             // 'description' => 'Huawei GR 5 2017',
             'image_path' => 'rollo.png',
             'user_id' => 2,
             'category_id' => $category->id,
         ]);

       
         Menu::create([
             'name' => 'Helado',
             // 'slug' => 'grama',
             // 'details' => 'helado de fresa',
             'price' => 20.000,
            //  'shipping_cost' => 5.79,
             // 'description' => 'fresa',
             'image_path' => 'helado.png',
             'user_id' => 3,
             'category_id' => $category->id,
         ]);
        
         Menu::create([
             'name' => 'Picada',
             // 'slug' => 'pollo',
             // 'details' => 'arros de pollo',
             'price' => 20.999,
            //  'shipping_cost' => 4.79,
             // 'description' => 'fresa',
             'image_path' => 'picada.png',
             'user_id' => 3,
             'category_id' => $category->id,
         ]);





    }
}