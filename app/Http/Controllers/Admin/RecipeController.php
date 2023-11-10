<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Recetas;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.recipes.index')->only('index');
        $this->middleware('can:admin.recipes.store')->only('store');
        $this->middleware('can:admin.recipes.update')->only('update');
        $this->middleware('can:admin.recipes.destroy')->only('destroy');
    }
    public function index()
    {
        $recipes = Recipe::all();
        $categories = Category::where('type', 'recipeAndmenu');
        return view('admin.cruds.recipes',compact('recipes','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
         return redirect()->route('admin.recipes.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
{
    $this->validate($request, [
        'name' => 'required',
        'images' => 'image|mimes:png,jpg',
        'description' => 'required',
        'ingredients' => 'required',
        'preparation' => 'required',
        // 'category' => 'required',
    ]);

    $data = $request->only('name', 'description', 'ingredients', 'preparation');
    $data['user_id'] = Auth::user()->id; // Recuperar el ID del usuario autenticado

    if ($request->hasFile('images')) {
        // Eliminar la imagen antigua
        Storage::disk('public')->delete($recipe->images);

        $file = $request->file('images');
        $name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $rutaImagen = $file->storeAs('recipes', $name, ['disk' => 'public']);
        $data['images'] = $rutaImagen;
    }

    $recipe->update($data);

    return redirect()->route('admin.recipes.index');
}

    /**
     * Remove the specified resource from storage.
     */
     
     public function destroy(Recipe $recipe)
     {
        $recipe->delete();
        return redirect()->route('admin.recipes.index');
     }
}
