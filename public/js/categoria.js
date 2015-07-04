$(document).ready(function(){
   
              

               $('#cat1').click(function(e){

                e.preventDefault();
               
                var categoria = $('#categoria1').val();
                

                $.ajax({
                    url : "tienda",
                    type: "POST",
                    cache: false,      
                    data : { 'categoria': categoria },                     
                    success: function(data){
                      
                        
                    },
                     error : function(xhr, status) {
                        alert('Disculpe, existió un problema');
                      }
                },"json");

            });

            
             
                   

   });