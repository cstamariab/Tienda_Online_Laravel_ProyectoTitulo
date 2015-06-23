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
   
    .tiendita{
        background: url('../img/Accesorios.jpg');
            background-size: cover;
            background-attachment: scroll;
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
                    <a href="#" class="list-group-item">Accesorios</a>
                    <a href="#" class="list-group-item">Modificaciones</a>
                    <a href="#" class="list-group-item">Motores</a>
                    <a href="#" class="list-group-item">Llantas</a>
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
                                    <h4 class="pull-right">${{$producto->precio}}</h4>
                                    <h4><strong><a href="/tienda/producto/{{$producto->id}}">{{$producto->nombre}}</a></strong></h4>
                                    <p>{{$producto->descripcion}}</p>
                                    <h4>Stock:{{Form::input('text','stock',$producto->stock,array("class"=>"form-control"))}}</h4>
                                    
                                </div>
                                
                                <a class="btn btn-success" href="/tienda/producto/{{$producto->id}}" > Comprar <span class="glyphicon glyphicon-shopping-cart" ></span></a>
                            </div>
                        </div>   
                    </div>   
                @endforeach
             	</div>  
                   
                    
                    <div class="row">
                   <div class="col-md-12 ">
					      {{Form::open(array
				          (
				          'action'=>'HomeController@tienda',
				          'method' => 'GET',
				          'role' => ' form',
				          'class' => 'form-inline'

				          )
				        )
				      }}
				      {{Form::input('text','buscar',Input::get('buscar'),array('class'=>'form-control'))}}
				      {{Form::input('submit',null,'Buscar',array('class'=>'btn btn-primary'))}}
				      {{Form::close()}}
					      {{$productos->appends(array("buscar"=>Input::get("buscar")))->links()}}
					</div>
					
                    </div>
                </div>

            </div>
            </div>
			
        </div>

		</div>
    </div>

	</div>
</body>
</html>