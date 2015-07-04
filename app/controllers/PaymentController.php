<?php

use Omnipay\Omnipay;


class PaymentController extends BaseController
{
	
	public function verCarrito()
	{

		$date = new DateTime();
		$user = User::find(Auth::user()->id);
		
		$carrito = DB::table('users')
							->join('orden','users.id','=','orden.user_id')
							->join('detalle_orden','orden.id','=','detalle_orden.orden_id')
							->join('productos','detalle_orden.producto_id','=','productos.id')
							->select('orden.id','detalle_orden.id as detalle','productos.nombre','productos.precio','detalle_orden.cantidad')
							->where('orden.user_id','=',$user->id)
							->where('orden.created_at','=',$date->format('Y-m-d 00:00:00'))							
							->get();

		
		return $carrito;

	}

	public function postPayment() 
	{
       	$carrito = $this->verCarrito();
	    
	   	$gateway = Omnipay::create('PayPal_Express');
	   	$gateway->setUsername('c.stamariab-facilitator_api1.gmail.com');
   		$gateway->setPassword('6MXRT7MKYC76HHYK');
   		$gateway->setSignature('ALB3da5vuFVBsZAP71NgtMz3BATGAqYj8xigGZrwHBDNCs-z64JPca9F');
      	$gateway->setTestMode(true);

        $items = new \Omnipay\Common\ItemBag();
        $amount = 0 ;
        foreach ($carrito as $producto) {

        	$dolar = round($producto->precio / 635) ;

        	$items->add(array(
                  'name' => $producto->nombre,
                  'quantity' => $producto->cantidad,
                  'price' => $dolar,
     		 ));

        	$amount += $dolar * $producto->cantidad;
        }
      
     

      $response = $gateway->purchase(
                  array(
                     'cancelUrl'  => 'http://localhost/cancel_order',
                     'returnUrl'   => 'http://localhost/payment_success', 
                     'amount' =>  $amount,
                     'currency' => 'USD',
                  )
      )->setItems($items)->send();
         		
         if ($response->isSuccessful()) {
	      
	      		// payment was successful: update database
	      		print_r($response);

		} elseif ($response->isRedirect()) {
	      		
	      		// redirect to offsite payment gateway
	      		$response->redirect();

	  	} else {

		      // payment failed: display message to customer
		      echo $response->getMessage();

	  	}

	}
	
	public function getSuccessPayment()
  	{
   		$gateway = Omnipay::create('PayPal_Express');
   		$gateway->setUsername('c.stamariab-facilitator_api1.gmail.com');
      $gateway->setPassword('6MXRT7MKYC76HHYK');
      $gateway->setSignature('ALB3da5vuFVBsZAP71NgtMz3BATGAqYj8xigGZrwHBDNCs-z64JPca9F');
   		$gateway->setTestMode(true);
      	
		 $params = Session::all('items');

  		  return Redirect::route("index");
  	}
}
