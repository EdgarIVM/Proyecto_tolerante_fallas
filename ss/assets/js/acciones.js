 
    $(".prestador").click(function(){
        
        document.getElementById('id02').style.display='block';
        
        var letras="abcdefghyjklmnñopqrstuvwxyz";

        function tiene_letras(texto){
           texto = texto.toLowerCase();
           for(i=0; i<texto.length; i++){
              if (letras.indexOf(texto.charAt(i),0)!=-1){
                 return i;
              }
           }
           return 0;
        }
        
        var button_id = document.getElementById("confirm");
        button_id.id = this.id;
        
        n = tiene_letras(button_id.id);
        
        codigo = button_id.id.substring(0,n);
        nombre = button_id.id.substring(n,button_id.id.length);
        
        document.getElementById("id_container").innerHTML = "¿Desea eliminar al prestador " + nombre + " con código: " + codigo + " ?";
        
        button_id.id = codigo;
        
        
        
    })
    
    
    
    $(".confirm").click(function(){
          
        $.post("delete.php",{
            
          codigo: this.id  
            
        })
        .done(function(data, success){   
         
            
        });
        
        //location.reload();
        
        
    })
    
    
