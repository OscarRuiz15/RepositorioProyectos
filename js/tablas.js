$(function(){          
          $("table.tablaBBDD tr").each(function(){
            $(this).click(function(){
              if($(this).attr("class") == 'fila'){
                $(this).removeClass('fila');
                $(this).addClass('selected');   
              }else{
                $(this).removeClass('selected');
                $(this).addClass('fila');
              }   
            })
          });
         $("#pasar").click(function(){
            $("table.tablaBBDD tr").each(function(){
               if($(this).attr("class") == 'selected'){
                  $("#tabla2").append($(this));
               } 
            })
         }) 

         $("#regresar").click(function(){
            $("table.tablaBBDD tr").each(function(){
               if($(this).attr("class") == 'selected'){
                  $("#tabla1").append($(this));
               } 
            })
         }) 
                       
      })

