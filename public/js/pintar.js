const mp = new MercadoPago("{{config('services.mercadopago.key')}}");
const bricksBuilder = mp.bricks();

mp.bricks().create("wallet", "wallet_container", {
   initialization: {
       preferenceId: preference ,
   },
});
 