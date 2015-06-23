<!DOCTYPE html>
<html lang="en">
<head>
	@include('layouts.head')
</head>
<body>
	<div class="container" style="margin-top:90px;">
		<h1 class="glyphicon glyphicon-fire">Error 404 : La página solicitada no existe.</h1>
		<p><a href="{{URL::route('index')}}" class="btn btn-primary">Regresar a la pagina inicio</a></p>
	</div>
</body>
</html>