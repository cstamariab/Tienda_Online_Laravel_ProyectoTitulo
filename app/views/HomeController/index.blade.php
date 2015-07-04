<!DOCTYPE html>
<html lang="en">
  <head>
   @include('layouts.head')
    <link href="/css/cover.css" rel="stylesheet">
       
  </head>

  <body>
	   
        <div id="wrapper">
         
         @include('layouts.nav')
          <section class="define">
            <h1 class="cover-heading">Bienvenidos a Nuestra Tienda Virtual</h1>
            <p class="lead">Estas a tan solo un par de clicks de modificar tu Auto como quieras !!</p>
            <p class="lead">
              <a href="/tienda" class="btn btn-lg btn-danger">Ir a la Tienda <span class="glyphicon glyphicon-shopping-cart"></span></a>
            </p>
         </section>
       
        </div>
        
            <footer>
                <div class='container-fluid'>
                    <h4>Nuestros Proveedores</h4>
                  <div class="row">
                    
                      <div class="col-md-2 col-md-offset-2">
                       
                        <img src="../img/hks.png"  height="70px" width="100%"alt="">
                        
                      </div>
                      <div class="col-md-2">
                        <img src="../img/momo.jpg" style=""  height="70px" width="100%"alt="">
                      </div>
                      
                      <div class="col-md-2">
                        <img src="../img/logosparco.jpg"  height="70px" width="100%"alt="">
                      </div>
                      <div class="col-md-2">
                        <img src="../img/nos.jpg"  height="70px" width="100%"alt="">
                      </div>
                      
                    </div>
                </div>
            </footer>
    
        

    
  </body>
</html>
