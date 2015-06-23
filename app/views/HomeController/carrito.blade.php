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
        function validaPeso(input)
                    {
                    var num = input.value.replace(/\./g,'');
                        if(!isNaN(num)){
                            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                            num = num.split('').reverse().join('').replace(/^[\.]/,'');
                            input.value = num;
                        }
                     
                            else{ alert('Solo se permiten numeros');
                            input.value = input.value.replace(/[^\d\.]*/g,'');
                        }
                    }
    </script>
</head>
<body>
	
	@include('layouts.nav')

	<div class="container">
	   <div class="panel panel-primary">
        <div class="panel-heading text-center">
            <h2>Carrito de compra</h2>
        </div>

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
                        <th>Id_Detalle</th>
                        <th>Nombre Producto</th>                                    
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Sub-Total</th>
                                            
                    </tr>
                </thead>
                <tbody>
                    <?php $sum = 0; ?>
                    @if($carrito != null)
                    
                        @foreach ($carrito as $carro)
                     
                            <tr>
                                <td>                         	
                                    {{$carro->id}}

                                </td>
                                <td>
                                    {{$carro->detalle}}
                                </td>
                                <td>
                                    {{$carro->nombre}}
                                </td>
                                <td>{{$carro->cantidad}}
                                    
                                </td>
                                <td>
                                   <span class="glyphicon glyphicon-usd"></span><input class="text-center" type="text" onmouseover="validaPeso(this)" value="{{$carro->precio}}" readonly>
                                </td>
                                <td>
                                   <span class="glyphicon glyphicon-usd"></span><input class="text-center" type="text"  onmouseover="validaPeso(this)" value="{{$subtotal=$carro->precio * $carro->cantidad}}"
                                     readonly> 
                                     <?php $sum += $subtotal; ?>
                                </td>
                                                        
                             
                            </tr>
                            
                       @endforeach

                    @endif   
                </tbody>
    			</table>
                </div>
               

                </div>
                <div class="row">
                     <div class="col-xs-4 col-xs-offset-8">
                         <table class="table table-bordered table-striped">
                            <tr>
                                 <td class="text-center">Iva: </td>
                                <td><span class="glyphicon glyphicon-usd"></span><input class="text-center" type="text" onmouseover="validaPeso(this)" value="{{$sum * 0.19;}}" readonly> </td>
                            </tr>
                            <tr>
                               <td class="text-center">Total: </td>
                                <td><span class="glyphicon glyphicon-usd"></span><input class="text-center" type="text" onmouseover="validaPeso(this)" value="{{$sum * 1.19;}}" readonly> </td>
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
                        <?php 
                        echo Form::hidden('cart', null, array('id' => 'cart'));
                        echo Form::submit('¡Pagar mi pedido ahora!', array('class' => 'btn btn-primary btn-lg btn-block')); 
                        echo Form::close(); ?>    
                </div>
             </div>   



	</div>

</body>
</html>