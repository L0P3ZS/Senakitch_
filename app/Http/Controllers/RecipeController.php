<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    
    public function index()
    {
        //
    }

    public function pdf($id){
        $receta = Recipe::find($id);
        $pdf = Pdf::loadView('home.pdf', compact('receta'));
        return $pdf->stream();
    }

  
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'images'=> 'required|image|mimes:png,jpg',
            'description'=> 'required',
            'ingredients' =>'required',
            'preparation' =>'required',
            // 'category' => 'required',
        ]);
     
        $files = $request->file('images');
        $name = $files->getClientOriginalName();
        $estencion = $files->getClientOriginalExtension();
        
        $rutaImagen = $files->storeAs('recipes',$name, ['disk' => 'public']);
        $data = $request->only('name','description','ingredients','preparation');
        $data['user_id'] = Auth::user()->id; // Recuperar el ID del usuario autenticado
        $data['images']=$rutaImagen;
         Recipe::create($data);
        

        return redirect('recetas');
    }

    public function update(Request $request, Recipe $recetas)
    {
        //
    }

 
    public function destroy(Recipe $recetas)
    {
       //
    }
}
