<?PHP

            $hora_entrada = '';
            $prestador_id = '';

            if ( $_SERVER["REQUEST_METHOD"] == "POST" ) 
            {
              $codigo = $_POST['Codigo'];
              $result = '';
                  
              //require_once 'conexion.php';
              //$db = Conexion();
             $username = "root";
       $password = "";
        $database = "servicio_social";
        $db = new mysqli($hostname,$username,$password,$database);
                
                    /* Comprobación de codigo y ejecución de queries */
                
                
                    $select_codigo = "select id from prestadores where codigo = ". htmlentities($codigo) .";";
                    $select_activo = "select id from prestadores where codigo = ". htmlentities($codigo) ." AND activo = FALSE;";

                    $result_codigo = $db->query($select_codigo);
                    $result_activo = $db->query($select_activo);
                

                    if ( $result_codigo->num_rows > 0 ) {
                          
                        if ( $result_activo->num_rows > 0 ) {
                            
                                /* Obtener id de la base de datos */
                
                                $result = $db->query($select_codigo);
                                $row = $result->fetch_array(MYSQLI_ASSOC);
                               
                                $insert = "insert into registro (id_prestador, entrada) values (".$row["id"].", now());";
                                $db->query($insert);
                                
                                $update = "update prestadores set activo = TRUE where codigo = ".$codigo.";";
                                $db->query($update);
                            
                                printf ("%s \n", $row["id"]);
                                
                            }
                        
                        else {
                            ?><script type="text/javascript"> alert("Su código ya inició sesión");  </script><?php
                        }
                    }
                            
                    else {

                            ?><script type="text/javascript"> alert("Código no registrado");  </script><?php

                    } 
         }

header("location:index.php");

?>