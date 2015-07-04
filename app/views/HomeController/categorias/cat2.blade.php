<!DOCTYPE html>
<html lang="en">
<head>
	@include('layouts.head')
    <style>
    body{
          background: url('../img/muscle-car.jpg');
  background-size: cover;
  background-attachment: fixed;
    }
   
    
    
    </style>
</head>
<body>
	@include('layouts.nav')

	<div class="container">
		<div class="panel panel-default tiendita">
        <div class="panel-body">

        <div class="alert alert-dismissable alert-success text-center">
                
                <h1>Bienvenido a nuestra tienda online: <strong>{{Auth::user()->user}}</strong></h1>

        </div>
		
		<hr>
		
		<div class="row " >

            <div class="col-md-3 ">
                <div class="panel panel-default ">
                   
                <div class="list-group">
                    
                    
                    <a href="/tienda" class=" list-group-item">Todos</a>
                    <a href="/tienda/cat1" class="list-group-item">Accesorios</a>

                    <a href="/tienda/cat2" class="active list-group-item">Modificaciones</a>
                    <a href="/tienda/cat3" class="list-group-item">Motores</a>
                    <a href="/tienda/cat4" class="list-group-item">Llantas</a>

                    
                   
                </div>
                </div>
            </div>
            <div class="col-md-9">

                <div class="panel panel-default ">

                <div class="panel-body ">
                	
                 <div class="row">
				
				@foreach($productos as $producto)
                
                    <div  class="col-sm-4 col-lg-4 col-md-4">
                        <div id="item">
                            <div class="thumbnail">
                                
                                  <div class="caption">
                                    <img src="{{$producto->imagen}}" width="100%" height="200">                                    
                                    <h4><a href="/tienda/producto/{{$producto->id}}">{{$producto->nombre}}</a></h4>
                                    <p>{{$producto->descripcion}}</p>
                                    <div>
                                    <p> {{Form::label('stock','Stock: '.$producto->stock,array("class"=>"text-left pull-right"))}}</p>
                                    <label class="pull-left">${{$producto->precio}}</label>
                                    </div>
                                    
                                </div>
                                
                                <a class="btn btn-success" href="/tienda/producto/{{$producto->id}}" > Comprar <span class="glyphicon glyphicon-shopping-cart" ></span></a>
                            </div>
                        </div>   
                    </div>   
                @endforeach
                 
             	</div>  
                   
                    
                    
                </div>

            </div>
            </div>
			
        </div>

		</div>
    </div>

	</div>
    <script type="text/javascript" src="js/categoria.js"> </script>
</body>
</html>