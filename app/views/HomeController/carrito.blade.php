<!DOCTYPE html>
<html lang="en">
<head>
	@include('layouts.head')
    
     <style>
    body{
          background: url('/img/muscle-car.jpg');
  background-size: cover;
  background-attachment: fixed;
    }
    </style>
    <script>
      
    </script>
    <script>

    </script>
</head>
<body>
	
	@include('layouts.nav')

	<div class="container">
	   <div class="panel panel-primary">
        <div class="panel-heading text-center">
            <h2>Carrito de compra</h2>
        </div>
         @if($carrito != null)
        <div class="panel-body">        
            <div class="alert alert-dismissable alert-success">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    <strong>Revisa Tu Detalle !:</strong>
            </div>
            <div class="row">
            <div class="col-md-12 col-xs-12 col-lg-12">

    			<table class="table table-bordered table-striped">
    				 <thead>
                    <tr>
                        <th>Id_Orden</th>
                        
                        <th>Nombre Producto</th>                                    
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Sub-Total</th>
                        <th>Operaciones</th>
                                            
                    </tr>
                </thead>
                <tbody>
                    <?php $sum = 0;$i=0; ?>

                    
                    
                        @foreach ($carrito as $carro)
                            {{Form::open(array(
                                'id'=> 'form',                                                              
                                 'role'=> "form",
                                 'action'=>"HomeController@editDetalle"
                                 
                                ))}}
                            <tr>
                                <td>                         	
                                    <label  name="orden"> {{$carro->id}}</label>

                                </td>
                                    <input type="hidden" value="{{$i}}" name="indice">
                                    <input type="hidden" value="{{$carro->detalle}}" name="detalle">
                               
                                <td>
                                   <label  name="nombre" >{{$carro->nombre}}</label> 
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="cantidad" value="{{$carro->cantidad}}" min="0" required>
                                </td>
                                <td>
                                   <span class="glyphicon glyphicon-usd"></span><input name="precio" onmouseover="validaPeso(this)" class="text-center precio" type="text"  value="{{$carro->precio}}" readonly>
                                </td>
                                <td>
                                   <span class="glyphicon glyphicon-usd"></span><input name="subtotal" onmouseover="validaPeso(this)" class="text-center precio" type="text"   value="{{$subtotal=$carro->precio * $carro->cantidad}}"
                                     readonly> 
                                     
                                </td>
                                <td>
                                    
                                       <button type="submit" name="edit" class="btn btn-success" id="edit">Editar</button>
                                       <button type="submit" name="borrar" class="btn btn-danger" id="borrar">Borrar</button>
                                       <?php $sum += $subtotal;$i++; ?>
                                </td>
                                                        
                             
                            </tr>
                            {{form::close()}}
                       @endforeach

                    
                </tbody>
    			</table>
                </div>
               

                </div>
                <div class="row">
                     <div class="col-xs-4 col-xs-offset-8">
                         <table class="table table-bordered table-striped">
                            <tr>
                                 <td class="text-center">Iva: </td>
                                <td><span class="glyphicon glyphicon-usd"></span><input onmouseover="validaPeso(this)" class="text-center precio" type="text"  value="{{$sum * 0.19;}}" readonly> </td>
                            </tr>
                            <tr>
                               <td class="text-center">Total: </td>
                                <td><span class="glyphicon glyphicon-usd"></span><input onmouseover="validaPeso(this)" class="text-center precio" type="text"  value="{{$sum * 1.19;}}" readonly> </td>
                           </tr>
                        </table>
                    </div>
			     </div>   
        </div>   
       </div>
		      
              <div class="panel panel-primary">
                 <div class="panel-heading text-center">
                     <h2>Datos de Envio.</h2>
                 </div>
                <div class="panel-body">
                    <div class="alert alert-dismissable alert-success">
                        <strong>2.Ingresa tus datos para el Envio :</strong>
                    </div>

                <div class="form-group">
                                <?php
                                echo Form::label('name', 'Nombre y apellidos:'); 
                                echo Form::text('name', $value = null, array( 'placeholder' => 'Escribe tu nombre y apellidos...',  'class' => 'form-control')); 
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                echo Form::label('email', 'Email:'); 
                                echo Form::email('email', $value = null, array( 'placeholder' => 'Escribe tu dirección de correo electrónico...',  'class' => 'form-control')); 
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                echo Form::label('tel', 'Teléfono:'); 
                                echo Form::text('tel', $value = null, array( 'placeholder' => 'Escribe un número de teléfono válido...',  'class' => 'form-control')); 
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                echo Form::label('address', 'Dirección:'); 
                                echo Form::text('address', $value = null, array( 'placeholder' => 'Escribe tu dirección...',  'class' => 'form-control')); 
                                ?>
                            </div>
                </div>               


                </div>
              
            
            <div class="panel panel-danger">
                <div class="panel-heading text-center">
                     <h2>Metodo de Pago.</h2>
                 </div>
                <div class="panel-body">
                 <div class="alert alert-dismissable alert-success">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    <strong>3. Finalmente selecciona una forma de pago:</strong>
                 </div>
                    <div class="form-group">
                        <?php
                        echo Form::label('payment', 'Forma de pago:'); 
                        echo Form::select('payment', array('PayPal' => 'PayPal'), 'PayPal', array('class' => 'form-control'));
                        ?>
                    </div>   
                    <a class="btn btn-primary btn-lg btn-block" href="/pay_via_paypal">¡Pagar mi pedido ahora!</a>     
                      
                </div>
             </div>   
        
        @else
        
        <h1 class="text-center">No has Agregado nada al carrito Aun !</h1>

        @endif   

	</div>
<script type="text/javascript" src="js/carrito.js"> </script>
</body>
</html>

