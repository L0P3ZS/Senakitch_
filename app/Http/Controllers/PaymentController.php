<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class PaymentController extends Controller
{
      private $apiContext;
      
      public function __construct(
        private CartService $cartService,

      )

      {
        $paypalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
          new OAuthTokenCredential(
              $paypalConfig['client_id'],     // ClientID
              $paypalConfig['secret']   // ClientSecret
          )
        );

      }

      public function paypalPayment()
      {
       
        $cartData = $this->cartService->DatosCart();
        

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($cartData);
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        // $transaction->setDescription('See your IQ results');

        $callbackUrl = url('/paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
      }

      public function paypalStatus(Request $request)
      {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
          $status = 'Lo sentimos! No se pudo realizar el pago con paypal.';
          return redirect('/paypal/failed')->with(compact('status'));
        }

        
        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        //dd($result);

        if ($result->getState() === 'approved') {
          $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';
          
          $cart = $this->cartService->Cart();
          
          // $venta = new Sale;
          // $venta = $cart->quantity['quantity'];
          // $venta = $cart->price_total['price'];
          // $venta = $cart->product_id['id'];
          // $venta->user_id = auth()->user()->id; 

          // $venta->save();


      
        

          return redirect('cart')->with(compact('status'));
       
      }

      $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
      return redirect('/results')->with(compact('status'));

      


      }

      
}
