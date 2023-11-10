<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Recipe::all();
    }

    public function store(Request $request)
    {
        Recipe::create($request->all());
        return response()->json([
            'respuesta'=> true,
            'mensaje' => 'Receta guardada con exito'
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function show(Recipe $recipe)
    {
        return response()->json([
            'respuesta'=> true,
            'recipe' => $recipe
        ]);
    }

    public function update(Request $request, Recipe $recipe)
    {
        $recipe->update($request->all());
        return response()->json([
             "respuesta" => True,
             "mensaje" => "Receta Actualizada Correctamente"
         ],200);
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return response()->json([
            "respuesta" => True,
            "mensaje" => "Receta Eliminada Exitosamente"
        ],200);
    }
}
