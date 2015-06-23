<!DOCTYPE html>
<html lang="en">
<head>
@include('layouts.head')
<style>
	body{
    background: url('../img/accesorios.jpg');
    background-size: cover;
    background-attachment: fixed;
    }
	#container{
        max-width: 800px ;
        height: auto;
        margin-top: 50px;
        
        
    }
    .panel{
    	-webkit-border-radius:5px;
        -moz-border-radius:5px;
        border-radius:5px;
        box-shadow: 2px 2px 2px black;
        
    }
    </style>
<script>
	$(function(){
		function send_ajax(){

			$.ajax({
				url:'contacto',
				type:'POST',
				data: $("#form").serialize(),
				success: function(datos)
				{
					$("#_email,#_name,#_subject,#_msg").text('');
					if(datos.success == false)
					{
						$.each(datos.errors,function(index,value){
							$("#_"+index).text(value);
						});
					}
					else
					{
						document.getElementById('form').reset();
						$("#mensaje").text("Mensaje enviado con exito");
					}
				}
			});
		}

		$("#btn").on("click",function(){
			send_ajax();
		});

	});
</script>
</head>
<body>
	@include('layouts.nav')
	<div class="container" id="container">
		<div id="mensaje" class="bg-info">{{$mensaje}}</div>
		<div class="panel panel-primary">
			<div class="panel-heading text-center">
				<h1>Contacto</h1>
			</div>
			<div class="panel-body">
						{{
				Form::open(array
				(
				'action'=>'HomeController@contacto',
				'method' =>'POST',
				'role' => 'form',
				'id'=>'form'
				))
			}}
			<div class="form-group">
				{{Form::label('nombre')}}
				{{Form::input('text','name',Input::old('name'),array('class'=>'form-control'))}}
				<div class="bg-danger" id="_name">{{$errors->first('name')}}</div>
			</div>
			<div class="form-group">
				{{Form::label('email')}}
				{{Form::input('email','email',Input::old('email'),array('class'=>'form-control'))}}
				<div class="bg-danger" id="_email">{{$errors->first('email')}}</div>
			</div>
			<div class="form-group">
				{{Form::label('asunto')}}
				{{Form::input('text','subject',Input::old('subject'),array('class'=>'form-control'))}}
				<div class="bg-danger" id="_subject">{{$errors->first('subject')}}</div>
			</div>
			<div class="form-group">
				{{Form::label('mensaje')}}
				{{Form::textarea('msg',Input::old('msg'),array('class'=>'form-control'))}}
				<div class="bg-danger" id="_msg">{{$errors->first('msg')}}</div>
			</div>
			{{Form::input('hidden','contacto')}}
			{{Form::input('button',null,'Enviar',array('class'=>'btn btn-primary' ,'id'=>'btn'))}}

			{{Form::close()}}	
					</div>
				</div>
		
	
	</div>
	
</body>
</html>