<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index(){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'image'=> 'required|image|mimes:png,jpg',
            'price'=> 'required',
            'description' =>'required',
            

        ]);
     
        $files = $request->file('image');
        $name = $files->getClientOriginalName();
        $estencion = $files->getClientOriginalExtension();

        // $files->store('images', ['disk' => 'public']);
        $rutaImagen = $files->storeAs('products',$name, ['disk' => 'public']);
        $data = $request->only('name','price','description');
        $data['image']=$rutaImagen;
        Product::create($data);

        

        return redirect("productos");

       
    }

    public function destroy(Product $productos)
    {

    }

}
