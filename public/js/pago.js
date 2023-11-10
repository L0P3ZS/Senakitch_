// Obtener la variable 'miVariable' de 'miElemento'
var miElemento = document.getElementById('miElemento');
var miVariable = miElemento.getAttribute('data-mi-variable');

// Obtener la clave de Mercado Pago
var mercadoPagoKey = miElemento.getAttribute('data-mercado-pago-key');

// Configurar Mercado Pago
const mp = new MercadoPago(mercadoPagoKey);
const bricksBuilder = mp.bricks();

mp.bricks().create("wallet", "wallet_container", {
   initialization: {
       preferenceId: miVariable,
   },
});
