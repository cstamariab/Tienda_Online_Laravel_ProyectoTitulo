<!DOCTYPE html>
<html lang="en">
<head>
   @include('layouts.head')
   <link href="/css/login.css" rel="stylesheet">
  
</head>
<body>
    @include('layouts.nav')
    <div class="container" id="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="text-center">Login</h1>
            </div>
            <div class="panel-body">

            {{Session::get("message")}}
                {{Form::open(array(
            "method" => "POST",
            "action" => "HomeController@login",
            "role" => "form"
            ))}}
 
            <div class="form-group">
                {{Form::label("Email:")}}
                {{Form::input("text", "email", null, array("class" => "form-control"))}}
            </div> 
            
            <div class="form-group">
                {{Form::label("Password:")}}
                {{Form::input("password", "password", null, array("class" => "form-control"))}}
            </div>
            
            <div class="form-group">
                {{Form::label("Recordar sesión:")}}
                {{Form::input("checkbox", "remember", "On")}}
            </div>
            
            <div class="form-group">
                {{Form::input("hidden", "_token", csrf_token())}}
                {{Form::input("submit", null, "Iniciar sesión", array("class" => "btn btn-primary"))}}
            </div>
            
{{Form::close()}}
            </div>
        </div>
        
    </div>
</body>
</html>