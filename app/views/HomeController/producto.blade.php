<!DOCTYPE html>
<html lang="es">
<head>
@include('layouts.head')
<link href="css/producto.css" rel="stylesheet">
 <style>
    body{
          background: url('/img/header-bg.jpg');
  background-size: cover;
  background-attachment: fixed;
    }
    </style>
</head>

<body>
	@include('layouts.nav')
	<div class="container">
        <div class="panel panel-default">
        <div class="panel-body">
        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{$productos->nombre}}
                    <small>$</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                <img class="img-responsive center-block" src="{{$productos->imagen}}" alt="">
            </div>

            <div class="col-md-4">
                <h3>{{$productos->nombre}}</h3>
                <p> {{$productos->descripcion}}</p>
                <h3>Detalles del Producto</h3>
                <ul>
                    <li>Precio: <strong>{{$productos->precio}}</strong></li>
                    <li>Stock: <strong>{{$productos->stock}}</strong></li>
           		 </ul>
           		 <a href="/carrito/{{$productos->id}}" class="btn btn-warning">Agregar al Carrito</a>
           		 <a href="/tienda" class="btn btn-success">Volver a la tienda</a>
            </div>

        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Related Projects</h3>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>
            </div>
        </div>
    </div>
</body>
</html>