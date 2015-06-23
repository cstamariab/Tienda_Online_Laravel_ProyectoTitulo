<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/carrito',array('as'=>'getcarrito','uses'=>'HomeController@getCarrito'));

Route::get('/carrito/{id}',array('as'=>'carrito','uses'=>'HomeController@agregarCarrito'));

Route::get('/tienda/producto/{id}','HomeController@getProducto');

Route::get('/',array('as'=>'index','uses'=>'HomeController@index'));

Route::get('/contacto',array('as'=>'contacto','uses'=>'HomeController@contacto'));

Route::post('/contacto', 'HomeController@contacto');

Route::get('/login',array('as'=>'login','uses'=>'HomeController@login'))->before('guest_user');

Route::get('/tienda',array('as'=>'tienda','uses'=>'HomeController@tienda'))->before('auth_user');

Route::post('/login',array('before'=>'csrf',function(){
	
	$user = array(
			'email' =>Input::get('email'),
			'password'=>Input::get('password'),
			'active'=>1,
		);

	$remember = Input::get("remember");
	
	$remember == 'On' ? $remember = true : $remember = false;
	
	if(Auth::attempt($user,$remember))
	{  
        
		return Redirect::route("tienda");
        
	}else{
		return Redirect::route("login");
	}

}));

Route::post('/salir','HomeController@salir',array('as'=>'salir','uses'=>"HomeController@salir"))->before('auth_user');
Route::get('/salir','HomeController@salir',array('as'=>'salir','uses'=>"HomeController@salir"))->before('auth_user');

Route::get('/registrar',array('as'=>'registrar','uses'=>"HomeController@getRegistrar"))->before('guest_user');


Route::post('/registrar',array('as'=>'registrar','uses'=>'HomeController@registrar'));

Route::get('/confirmarRegistrar/{email}/{key}',array('as'=>'confirmarRegistrar','uses'=>'HomeController@confirmarRegistrar'));


Route::get("/recuperarcontrasena",array("as"=>"recuperarcontrasena","uses"=>"HomeController@recuperarContrasena"))->before("guest_user");

Route::post('/recuperarcontrasena', array('before' => 'csrf', function(){
    
    $rules = array(
        "email" => "required|email|exists:users",
    );
    
    $messages = array(
        "email.required" => "El campo email es requerido",
        "email.email" => "El formato de email es incorrecto",
        "email.exists" => "El email seleccionado no se encuentra registrado",
    );
    
    $validator = Validator::make(Input::All(), $rules, $messages);
    
    if ($validator->passes())
    {
        Password::user()->remind(Input::only("email"), function($message) {
        $message->subject('Recuperar password en Laravel');
        });
        
        $message = '<hr><label class="label label-info">Le hemos enviado un email a su cuenta de correo electrónico para que pueda recuperar su password</label><hr>';
        return Redirect::route('recuperarcontrasena')->with("message", $message);
    }
    else
    {
        return Redirect::back()->withInput()->withErrors($validator); 
    }
    
}));





Route::controller('productos','HomeController');
Route::controller('users','HomeController');
Route::controller('orden','HomeController');

/*Redireccion a pagian de error 404*/

App::missing(function($exception){

	return Response::view('error.error404',array(),404);

});