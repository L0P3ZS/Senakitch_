<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Menu;
use App\Services\MercadoPagoService;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class CartController extends Controller
{

    public function __construct(

        private MercadoPagoService $mercadoPagoService,
       
    ){}



    public function shop()
    {
        $products = Menu::all();
       //dd($products);
        return view('home.menu', compact('products'));
    }

    public function cart()  {
    
       $client = $this->mercadoPagoService->crearPreferece();
      
       
        $cartCollection = \Cart::getContent();

     
      
        return view('cart',compact('cartCollection', 'client'));
    }
    
    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }

    public function add(Request$request){
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->img,
                'slug' => $request->slug
            )
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Item Agregado a sú Carrito!');
    }

    public function update(Request $request){
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Cart is Updated!');
    }

    public function clear(){
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Car is cleared!');
    }



}
