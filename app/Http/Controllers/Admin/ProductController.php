<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\returnSelf;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.products.index')->only('index');
        $this->middleware('can:admin.products.store')->only('store');
        $this->middleware('can:admin.products.update')->only('update');
        $this->middleware('can:admin.products.destroy')->only('destroy');
    }
    public function index()
    {
        $products = Product::all();
        return view('admin.cruds.products',compact('products'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'image'=> 'required|image|mimes:png,jpg',
            'price'=> 'required',
            'description' =>'required',
            // 'category' => 'required',
        ]);
     
        $files = $request->file('image');
        $name = $files->getClientOriginalName();
        $estencion = $files->getClientOriginalExtension();
        
        $rutaImagen = $files->storeAs('products',$name, ['disk' => 'public']);
        $data = $request->only('name','price','description');
        $data['user_id'] = Auth::user()->id; // Recuperar el ID del usuario autenticado
        $data['image']=$rutaImagen;
         Product::create($data);
         return redirect()->route('admin.products.index');
        // dd($data);

    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image|mimes:png,jpg',
            'description' => 'required',
            'price' => 'required',
            // 'category' => 'required',
        ]);
    
        $data = $request->only('name', 'description', 'price');
        $data['user_id'] = Auth::user()->id; // Recuperar el ID del usuario autenticado
    
        if ($request->hasFile('images')) {
            // Eliminar la imagen antigua
            Storage::disk('public')->delete($product->image);
    
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $rutaImagen = $file->storeAs('products', $name, ['disk' => 'public']);
            $data['image'] = $rutaImagen;
        }
    
        $product->update($data);
    
        return redirect()->route('admin.products.index');
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }
    public function export(){
        $productsExport = new ProductExport;
        return $productsExport->download('products.xlsx');
    }
}
