<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            'user_id'=> 'required',
            

        ]);
     
        $files = $request->file('image_path');
        $name = $files->getClientOriginalName();
        $estencion = $files->getClientOriginalExtension();

        // $files->store('images', ['disk' => 'public']);
        $rutaImagen = $files->storeAs('Menus',$name, ['disk' => 'public']);
        $data = $request->only('name','price','user_id');
        $data['image_path']=$rutaImagen;
        Menu::create($data);

         return redirect()->route('menu');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function mercadoPago(){
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.token'));

        $client = new PreferenceClient();
        $preference = $client->create([
            "items" => array(
                array(
                    "title" => "Meu produto",
                    "quantity" => 1,
                    "currency_id" => "BRL",
                    "unit_price" => 100
                )
            )
        ]);
    }

}
