<!DOCTYPE html>
<html lang="en">
<head>
	@include('layouts.head')
</head>
<body>
	@include('layouts.nav')
	<div class="container">
		{{Session::get("message")}}
		{{Form::open(array(

		'method'=>"POST",
		 'action'=> "HomeController@recuperarContrasena",
		 'role'=> "form"

		))}}
		<div class="form-group">
			{{Form::label("Email:")}}
			{{Form::input("email","email",null,array("class"=>"form-control"))}}
			<div class="bg-danger">{{$errors->first('email')}}</div>
		</div>
		<div class="form-group">
			{{Form::input("hidden","_token",csrf_token())}}
			{{Form::input("submit",null,"Recuperar Contraseña",array("class"=>"btn btn-success"))}}
			<div class="bg-danger">{{$errors->first('email')}}</div>
		</div>
		{{form::close()}}
	</div>
</body>
</html>