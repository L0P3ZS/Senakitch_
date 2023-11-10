<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
            'description' => 'Que Meloooo, Ojala Pudieran Haber Mas Paginas Asi Tan Buenas, Ojala Las Demas Paginas Puedan Tomar Ejemplo De Paginas Asi Como Estas.',
            'user_id' => 1,
            'rating' => 4,
        ]);

        Comment::create([
            'description' => 'Que Buena Web, Puedo Encontrar Todo Lo Que Busco Tanto En Recetas Como En Productos Pero Creo Que Le Falta Algo, Aun Pueden Mejorar Sigan Asi Que Bendicion.',
            'user_id' => 2,
            'rating' => 4,
        ]);

        Comment::create([
            'description' => 'Esta Muy Buena La Pagina Trae Muy Buenas Cosas Pero Le Faltan Algunos Cambios Y Optimizarla Pero De Resto Todo Bello Todo Bonito.',
            'user_id' => 3,
            'rating' => 4,
        ]);
        // Comentario para una receta
        $receta = Recipe::find(1); // Reemplaza el 1 con el ID de la receta deseada
        if ($receta) {
            $receta->comments()->create([
                'description' => 'Este es un comentario para la receta',
                'user_id' => 4,
                'rating' => 4,
            ]);
        }

        // Comentario para un producto
        $producto = Product::find(1); // Reemplaza el 1 con el ID del producto deseado
        if ($producto) {
            $producto->comments()->create([
                'description' => 'Este es un comentario para el producto',
                'user_id' => 3,
                'rating' => 4,
            ]);
        }
    }
}



