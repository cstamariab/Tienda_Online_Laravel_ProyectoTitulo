<!DOCTYPE html>
<html lang="en">
<head>
	@include('layouts.head')
	<style>
	body{
    background: url('../img/registrar.jpg');
    background-size: cover;
    background-attachment: fixed;
    }
	#container{
        max-width: 500px ;
        height: auto;
        margin-top: 100px;
    
    }
     .panel{
        
        -webkit-border-radius:5px;
        -moz-border-radius:5px;
        border-radius:5px;
        box-shadow: 1px 1px 1px black;
        color:#000;
    }
    </style>
</head>
<body>
	@include('layouts.nav')
	<div class="container" id="container">
		<div class="panel panel-primary">
			<div class="panel-heading text-center">
				<h1>Formulario de Registro</h1>
			</div>
			<div class="panel-body">
				
			
			{{Session::get("message")}}

			{{Form::open(array(
			            "method" => "POST",
			            "action" => "HomeController@registrar",
			            "role" => "form",
			            ))}}
			 
			            <div class="form-group">
			                {{Form::label("Nombre:")}}
			                {{Form::input("text", "user", null, array("class" => "form-control"))}}
			                <div class="bg-danger">{{$errors->first('user')}}</div>
			            </div>           
			            
			            <div class="form-group">
			                {{Form::label("Email:")}}
			                {{Form::input("email", "email", null, array("class" => "form-control"))}}
			                <div class="bg-danger">{{$errors->first('email')}}</div>
			            </div> 
			            
			            <div class="form-group">
			                {{Form::label("Password:")}}
			                {{Form::input("password", "password", null, array("class" => "form-control"))}}
			                <div class="bg-danger">{{$errors->first('password')}}</div>
			            </div>
			            
			            <div class="form-group">
			                {{Form::label("Repetir password:")}}
			                {{Form::input("password", "repetir_password", null, array("class" => "form-control"))}}
			                <div class="bg-danger">{{$errors->first('repetir_password')}}</div>
			            </div>
			            
			            <div class="form-group">
			                {{Form::label("Aceptar los términos:")}}
			                {{Form::input("checkbox", "terminos", "On")}}
			                <div class="bg-danger">{{$errors->first('terminos')}}</div>
			            </div>
			            
			            <div class="form-group">
			                {{Form::input("hidden", "_token", csrf_token())}}
			                {{Form::input("submit", null, "Registrarme", array("class" => "btn btn-primary"))}}
			            </div>
			            
			{{Form::close()}}
			</div>
		</div>
	</div>
</body>
</html>