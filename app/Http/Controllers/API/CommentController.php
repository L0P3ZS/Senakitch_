<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  
   
    public function index()
    {
        return Comment::all();
    }

  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Comment::create($request->all());
        return response()->json([
            'respuesta'=> true,
            'mensaje' => 'menu guardado con exito'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return response()->json([
            'respuesta'=> true,
            'comment' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->update($request->all());
        return response()->json([
             "respuesta" => True,
             "mensaje" => "Comentario Actualizado Correctamente"
         ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json([
            "respuesta" => True,
            "mensaje" => "Comentario Eliminado Exitosamente"
        ],200);
    }
}
