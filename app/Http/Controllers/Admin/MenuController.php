<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.menus.index')->only('index');
        $this->middleware('can:admin.menus.store')->only('store');
        $this->middleware('can:admin.menus.update')->only('update');
        $this->middleware('can:admin.menus.destroy')->only('destroy');
    }
    public function index()
    {
        $menus = Menu::all();
        return view('admin.cruds.menus',compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'image_path'=> 'required|image|mimes:png,jpg',
            'price'=> 'required',
            // 'shipping_cost' =>'required',
            // 'category' => 'required',
        ]);
     
        $files = $request->file('image_path');
        $name = $files->getClientOriginalName();
        $estencion = $files->getClientOriginalExtension();
        
        $rutaImagen = $files->storeAs('Menus',$name, ['disk' => 'public']);
        $data = $request->only('name','price');
        $data['user_id'] = Auth::user()->id; // Recuperar el ID del usuario autenticado
        $data['image_path']=$rutaImagen;
         Menu::create($data);
         return redirect()->route('admin.menus.index');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $this->validate($request, [
            'name' => 'required',
            'image_path' => 'image|mimes:png,jpg',
            'price' => 'required',
            // 'shipping_cost' => 'required',
            // 'category' => 'required',
        ]);
    
        $data = $request->only('name', 'price');
        $data['user_id'] = Auth::user()->id; // Recuperar el ID del usuario autenticado
    
        if ($request->hasFile('image_path')) {
            // Eliminar la imagen antigua
            Storage::disk('public')->delete($menu->image_path);
    
            $file = $request->file('image_path');
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $rutaImagen = $file->storeAs('Menus', $name, ['disk' => 'public']);
            $data['image_path'] = $rutaImagen;
        }
    
        $menu->update($data);
    
        return redirect()->route('admin.menus.index');
    }  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index');
    }
}
