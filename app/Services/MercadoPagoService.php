<?php

namespace App\Services;

use MercadoPago\Client\MerchantOrder\MerchantOrderClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\SDK;
use MercadoPago\Resources\Preference as Preference;
use MercadoPago\Resources\Preference\Item as Item;
use MercadoPago;



class MercadoPagoService{


    public function __construct(
        private CartService $cartService,
       
    ){ }

   

    public function crearPreferece(){

      MercadoPagoConfig::setAccessToken(config('services.mercadopago.token'));

    $cart = $this->cartService->DatosCart();

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

    return $preference;



    // dd( $preference);
     
   
 
  }

}
