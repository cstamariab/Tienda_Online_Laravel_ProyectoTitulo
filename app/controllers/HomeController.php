<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	

	public function index()
	{	
		
		
		//INSERT!!!

		//$sql ="INSERT INTO articulos(articulo,descripcion,src)values(?,?,?)";
		//$conn->insert($sql,array('Goggle','Google es un buscador web','http://images.forbes.com/media/lists/companies/google_416x416.jpg'));
		//SELECT
		//$sql="select * from articulos where id=?";
		//$resultado=$conn->select($sql,array(1));

	return View::make('HomeController.index');

	}


	public function login()
	{
		return View::make('HomeController.login');
	}
	public function salir()
	{
		Auth::logout();
		return Redirect::to('login');
	}
	public function verCarrito()
	{

		$date = new DateTime();
		$user = User::find(Auth::user()->id);
		
		$carrito = DB::table('users')
							->join('orden','users.id','=','orden.user_id')
							->join('detalle_orden','orden.id','=','detalle_orden.orden_id')
							->join('productos','detalle_orden.producto_id','=','productos.id')
							->select('orden.id','detalle_orden.id as detalle','productos.nombre','productos.precio','detalle_orden.cantidad')
							->where('orden.user_id','=',$user->id)
							->where('orden.created_at','=',$date->format('Y-m-d 00:00:00'))							
							->get();

		
		return $carrito;

	}
	public function getCarrito(){

		$date = new DateTime();
		$user = User::find(Auth::user()->id);
		
		$carrito = DB::table('users')
							->join('orden','users.id','=','orden.user_id')
							->join('detalle_orden','orden.id','=','detalle_orden.orden_id')
							->join('productos','detalle_orden.producto_id','=','productos.id')
							->select('orden.id','detalle_orden.id as detalle','productos.nombre','productos.precio','detalle_orden.cantidad')
							->where('orden.user_id','=',$user->id)
							->where('orden.created_at','=',$date->format('Y-m-d 00:00:00'))							
							->get();

		
		
		
		return View::make('HomeController.carrito')->with('carrito',$carrito);
		
	}

	public function agregarCarrito($id)
	{	
		$this->id = $id;

		$date = new DateTime();

		$user= User::find(Auth::user()->id);
		//reviso si este usuario tiene alguna orden
		$ordenes=Orden::where('user_id','=',$user->id)->first();
		
		//si es la primera orden
		if($ordenes == null){
			//se crea nueva orden con un detalle
			$this->crearOrden();
			//busco la orden de este usuario en este dia
			//un usuario puede generar solo una orden al dia , no asi su detalle

			//busco la orden recientemente creada por la fecha actual
			$ordenes=Orden::where('user_id','=',$user->id )
					->where('created_at','=',$date->format('Y-m-d 00:00:00'))->first();
		// y a esa orden le creo un nuevo detalle
			$detalle = new DetalleOrden();
			$detalle->orden_id = $ordenes->id;
			$detalle->producto_id = $this->id;
			$detalle->cantidad = 1;
			$detalle->save();
			//actualizo stock del producto
			$cantidad = Productos::find($id);
			$cantidad->stock -=1;
			$cantidad->save();

			$carrito = $this->verCarrito();
	
				return View::make('HomeController.carrito')->with('carrito',$carrito);

		}else{
			//si no es la primera orden del usuario , se busca la orden hecha ese dia
			//se busca por id de user y la fecha de creacion tiene que ser igual al dia de HOY
			$orden=Orden::where('user_id','=',$user->id )
			->where('created_at','=',$date->format('Y-m-d 00:00:00'))
			->first();

			//SI no hay ordenes para este dia , se crea otra orden correspondiente al dia en el que estamos
			if($orden == null){

				$this->crearOrden();
			//busco la orden de este usuario en este dia
			//un usuario puede generar solo una orden al dia , no asi su detalle
			$ordenes=Orden::where('user_id','=',$user->id )
					->where('created_at','=',$date->format('Y-m-d 00:00:00'))->first();

			$detalle = new DetalleOrden();
			$detalle->orden_id = $ordenes->id;
			$detalle->producto_id = $this->id;
			$detalle->cantidad = 1;
			$detalle->save();

			$cantidad = Productos::find($id);
			$cantidad->stock -=1;
			$cantidad->save();

			$carrito = $this->verCarrito();

			return View::make('HomeController.carrito')->with('carrito',$carrito);

			}else{
				//SINO , se crea un nuevo detalle para la orden de ESTE DIA
				

				$detalleOrden = DetalleOrden::where('orden_id','=',$orden->id)
						-> where('producto_id','=',$id)->first() ;
				
				//si existe ya el producto en mis detalles, se actualiza la cantidad , si no se crea un nuevo detalle
				

				if(count($detalleOrden)==1){
					$detalle = $detalleOrden;
					$detalle->cantidad +=1;
					$detalle->save();
					$cantidad = Productos::find($id);
					$cantidad->stock -=1;
					$cantidad->save();
					$carrito = $this->verCarrito();
	
					return View::make('HomeController.carrito')->with('carrito',$carrito);
					
				}else{
					$detalle = new DetalleOrden();
					$detalle->orden_id = $orden->id;
					$detalle->producto_id = $this->id;
					$detalle->cantidad = 1 ;
					$detalle->save();
					$cantidad = Productos::find($id);
					$cantidad->stock -=1;
					$cantidad->save();

					$carrito = $this->verCarrito();
		

					return View::make('HomeController.carrito')->with('carrito',$carrito);
				}


			}
			
			
			
			
		}
		 
		
		}
		
	
	

	public function registrar()
	{
		

		$rules = array
				(

				'user' => 'required|min:3|max:50',
				'email'=> 'required|email|unique:users|between:3,80',
				'password'=> 'required|min:8|max:16',
				'repetir_password'=> 'required|same:password',
				'terminos' => 'required'

				);

			$messages= array
				(
					'user.required'=>'El campo usuario es requerido',
					'user.min'=>'Minimo 3 Caracteres',
					'user.max' => 'Maximo 80 Caracteres',
					'email.required'=>'El campo Email es requerido',
					'email.email'=>'El formato de email es incorrecto',
					'email.unique'=>'El email ya existe en nuestros registros',
					'email.between' => 'Entre 3 y 80 Caracteres',
					'password.required'=>'El campo es requerido',
					'password.min'=>'Minimo 8 Caracteres',
					'password.max' => 'Maximo 16 Caracteres',
					'terminos.required'=>'El campo es requerido',
					'repetir_password.required' => 'Campo requerido',
					'repetir_password.same'=>'Las claves no coinciden',	
				);

				$validator= Validator::make(Input::all(),$rules,$messages);

				if($validator->passes())
				{
						$user = input::get('user');
						$email = input::get('email');
						$password =Hash::make(input::get('password'));

					
						$usuario = new User();

						$usuario->user = $user;
						$usuario->email = $email;
						$usuario->password = $password;

						$usuario->save();
					
					//	$conn = DB::connection('mysql');
					//	$sql = "INSERT INTO USERS(user,email,password)values(?,?,?)";
					//	$conn->insert($sql, array($user,$email,$password));
						$key = Str::random(32);
						Cookie::queue('key',$key,60*24);
						Cookie::queue('email',$email,60*24);

						$msg="<a href='".URL::to("/confirmarRegistrar/$email/$key")."'>Confirmar cuenta</a>";
						
						$data = array(
						'user' => $user,
						'msg'=> $msg,
						
						);


						$fromEmail=$email;
						$fromName= 'Administrador';

						Mail::send('emails.registrar',$data,function($message) use ($fromEmail,$fromName){
							
							$message->to($fromEmail,$fromName);
							$message->from($fromEmail,$fromName);
							$message->subject('Confirmar Registro de Nueva Cuenta');

						});

						$message ='<hr><label class="label label-info">'.$user.'le hemos enviado un email de confirmacion de su nueva cuenta</label><hr>';

						return Redirect::route('registrar')->with("message",$message);
				}
				else
				{
					return Redirect::back()->withInput()->withErrors($validator);
				}
	}

	public function crearOrden(){
		
		$date = new DateTime();

		$orden = new Orden();
		$user = User::find(Auth::user()->id);
		$orden->user_id = $user->id ;
		$orden->created_at = $date->format('Y-m-d');
		$orden->updated_at = null;

		$orden->save();

	}

	public function getRegistrar()
	{
		return View::make('HomeController.register');
	}


	public function contacto(){

		$mensaje = null;

		if (isset($_POST['contacto'])) {
			
			$rules = array
				(

				'name' => 'required|min:3|max:80',
				'email'=> 'required|email|between:3,80',
				'subject'=> 'required|min:3|max:80',
				'msg'=> 'required|between:3,500'

				);

			$messages= array
				(
					'name.required'=>'El campo es requerido',
					'name.min'=>'Minimo 3 Caracteres',
					'name.max' => 'Maximo 80 Caracteres',
					'email.required'=>'El campo Email es requerido',
					'email.email'=>'El formato de email es incorrecto',
					'email.between' => 'Entre 3 y 80 Caracteres',
					'subject.required'=>'El campo es requerido',
					'subject.min'=>'Minimo 3 Caracteres',
					'subject.max' => 'Maximo 80 Caracteres',
					'msg.required'=>'El campo es requerido',
					'msg.between' => 'Entre 3 y 500 Caracteres',		
				);

			$validator= Validator::make(Input::all(),$rules,$messages);

			if($validator->passes()){

					$data = array(
						'name' => Input::get('name'),
						'email'=> Input::get('email'),
						'subject'=> Input::get('subject'),
						'msg'=> Input::get('msg')
						);

			$fromEmail='c.stamariab@gmail.com';
			$fromName= 'Administrador';

			Mail::send('emails.contacto',$data,function($message) use ($fromEmail,$fromName){
				
				$message->to($fromEmail,$fromName);
				$message->from($fromEmail,$fromName);
				$message->subject('Nuevo email de contacto');

			});
			$mensaje = 'Mensaje enviado con exito';
		
		}
		else{
			if(Request::ajax())
			{
				return Response::json
				([
					'success' => false,
					'errors' =>$validator->getMessageBag()->toArray()
					]);
			}else
			{
				return Redirect::back()->withInput()->withErrors($validator);
			}
			

		}
	
		}

		return View::make('HomeController.contacto',array('mensaje'=>$mensaje));
	}

	public function confirmarRegistrar($email, $key)
	{
 	    if (urldecode($email) == Cookie::get("email") && urldecode($key) == Cookie::get("key"))
	    {
	        $conn = DB::connection("mysql");
	        $sql = "UPDATE users SET active=1 WHERE email=?";
	        $conn->update($sql, array($email));
	        $message = "<hr><label class='label label-success'>Enhorabuena tu registro se ha llevado a cabo con éxito.</label><hr>";
	        return Redirect::route("login")->with("message", $message);
	    }
	    else
		    {
		        return Redirect::route("registrar");
		    }
    
	}

	
	

	//TIENDA
	public function tienda()
	{
		$conn= DB::connection("mysql");

		if(isset($_GET['buscar']))
		{
			$buscar = htmlspecialchars(Input::get("buscar"));
			$productos = $conn
			->table("productos")
			->where("nombre","LIKE","%".$buscar.'%')
			->orwhere("descripcion","LIKE","%".$buscar.'%')
			->paginate(3);

		}else
		{
			$productos = $conn->table("productos")->paginate(6);
		}
		return View::make('HomeController.tienda',array('productos'=>$productos));
	}


	public function getProducto($id = null)
	{
		$productos = Productos::find($id);

		return View::make('HomeController.producto')->with('productos',$productos);
		
	}

	public function editDetalle()
	{
		
				
			if(isset($_POST['edit'])){

 				$cantidad = $_POST['cantidad'];
       			$detalle = $_POST['detalle'];

       			$orden = DetalleOrden::find($detalle);
       			$orden->cantidad = $cantidad;
       			$orden->save();
    			

       			return Redirect::Route('getcarrito');
	 		
			}elseif (isset($_POST['borrar'])) {
				
				$detalle = $_POST['detalle'];

       			$orden = DetalleOrden::find($detalle);
       			$orden->delete();

       			return Redirect::Route('getcarrito');
			}

	

	}
	public function cat1(){
		
		$productos = DB::table('productos')

							->join('categoria','categoria.id','=','productos.categoria_id')							
							->select('productos.id','productos.nombre','productos.precio','productos.stock','productos.descripcion','productos.imagen')
							->where('productos.categoria_id','=',1)->get()									
							;

			return View::make('HomeController.categorias.cat1')->with('productos',$productos);
	}
	public function cat2(){
		
		$productos = DB::table('productos')

							->join('categoria','categoria.id','=','productos.categoria_id')							
							->select('productos.id','productos.nombre','productos.precio','productos.stock','productos.descripcion','productos.imagen')
							->where('productos.categoria_id','=',2)->get()									
							;

			return View::make('HomeController.categorias.cat2')->with('productos',$productos);
	}
	public function cat3(){
		
		$productos = DB::table('productos')

							->join('categoria','categoria.id','=','productos.categoria_id')							
							->select('productos.id','productos.nombre','productos.precio','productos.stock','productos.descripcion','productos.imagen')
							->where('productos.categoria_id','=',3)->get()									
							;

			return View::make('HomeController.categorias.cat3')->with('productos',$productos);
	}
	public function cat4(){
		
		$productos = DB::table('productos')

							->join('categoria','categoria.id','=','productos.categoria_id')							
							->select('productos.id','productos.nombre','productos.precio','productos.stock','productos.descripcion','productos.imagen')
							->where('productos.categoria_id','=',4)->get()									
							;

			return View::make('HomeController.categorias.cat4')->with('productos',$productos);
	}
}