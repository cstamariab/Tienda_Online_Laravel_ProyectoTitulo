<nav class="navbar navbar-inverse">
      <div class="container-fluid">
        
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{URL::route('index')}}">Tienda Online Laravel</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav pull-right">
            <?php 

             $vista = Route::currentRouteName();

             $current = array (
                'index'=>'',
                'contacto'=>'',
                'login'=>'',
                'registrar'=>'',
                'tienda'=> '',
                'getcarrito'=>''
              ); 
             if ($vista == '' || $vista == 'index') {
               $current['index'] = 'active';
             }
             else if ($vista =='contacto') {
               $current['contacto']= 'active';
             }else if($vista =='login'){
              $current['login']= 'active';
             }else if ($vista =='registrar'){
                $current['registrar']= 'active';
             }else if($vista =='tienda')
             {
              $current['tienda']= 'active';
             }else if($vista == 'getcarrito'){
              $current['getcarrito']='active';
             }

            ?>
            <li class="{{$current['index']}}"><a href="{{URL::route('index')}}"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
          	<li class="{{$current['contacto']}}"><a href="{{URL::route('contacto')}}"><span class="glyphicon glyphicon-earphone"></span> Contacto</a></li>
            @if (Auth::guest())
            
            <li class="{{$current['login']}}"><a href="{{URL::route('login')}}"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesion</a></li>
            <li class="{{$current['registrar']}}"><a href="{{URL::route('registrar')}}"><span class="   glyphicon glyphicon-user"></span> Registrarme</a></li>
            @else
            <li class="{{$current['tienda']}}"><a href="{{URL::route('tienda')}}"><span class="glyphicon glyphicon-shopping-cart"></span> Tienda</a></li>
            <li class="{{$current['getcarrito']}}"><a href="{{URL::route('getcarrito')}}"><span class="glyphicon glyphicon-shopping-cart"></span> Carrito</a></li>
            <nav class="pull-right">
              <ul class="nav navbar-nav">
                <li>
                  <div class="navbar-collapse collapse">
                    {{Form::open(array(
                    'method'=>'POST',
                    'action'=>'HomeController@salir',
                    'role'=>'form',
                    'class'=> 'navbar-form'
                    ))}}
                    
                     <span class="glyphicon glyphicon-user"></span> {{Form::label(Auth::user()->email,null,array("class"=>"label"))}}
                    
                    <span class="glyphicon glyphicon-log-out"></span>
                    {{Form::input("submit","","Salir",array("class"=>"btn btn-danger"))}}
                    {{Form::close()}}
                  </div>
                </li>
              </ul>
            </nav>
            @endif
            
          </ul>
          
        </div><!--/.nav-collapse -->
      </div>
      
</nav>