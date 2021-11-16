<?PHP

            $hora_entrada = '';
            $prestador_id = '';

            if ( $_SERVER["REQUEST_METHOD"] == "POST" ) 
            {
              $codigo = $_POST['Codigo'];
              $result = '';

             // require_once 'conexion.php';
              //$db = Conexion();
               $username = "root";
       $password = "";
        $database = "servicio_social";
        $db = new mysqli($hostname,$username,$password,$database);
 
               $select_codigo = "select id from prestadores where codigo = ". htmlentities($codigo) .";";
               $select_activo = "select id from prestadores where codigo = ". htmlentities($codigo) ." AND activo = TRUE;";

               $result_codigo = $db->query($select_codigo);
               $result_activo = $db->query($select_activo);
                
               /* Validamos si el código existe en la base de datos */    

                    if ( $result_codigo->num_rows > 0 ) {
                        
                        /* Validamos si el prestador ya está loggeado */
                          
                        if ( $result_activo->num_rows > 0  ) {
                            
                                /* Obtener id del prestador a partir del codigo */
                            
                                $result = $db->query($select_codigo);
                                $row = $result->fetch_array(MYSQLI_ASSOC);
                                echo $row["id"];
                            
                                /* Validar la duración de la jornada: si es mayor a 8 horas, no se asignan las mismas y se hace un ajuste */
                            
                                $ocho = "SELECT entrada, hour(sec_to_time(TIMESTAMPDIFF(SECOND, entrada, now()))) AS dif FROM registro where id_prestador = ".$row["id"]." order by entrada desc;";
                                
                                $result_ocho = $db->query($ocho);
                                $row_ocho = $result_ocho->fetch_array(MYSQLI_ASSOC);
                                echo $row_ocho["dif"];
                                
                                if($row_ocho["dif"] < 8) {
                                    
                                    /* Asignar las horas que registró */
                                    
                                    /* Buscar el id en la tabla registro al cual pertenece la entrada del prestador */
                                    
                                    $result_id_prestador = "select id from registro where id_prestador = ".$row["id"]." order by entrada desc;";
                
                                    $result = $db->query($result_id_prestador);
                                    $row = $result->fetch_array(MYSQLI_ASSOC);
                                    echo $row["id"];
                                    
                                    $update = "update registro set salida = now() where id = ".$row["id"].";";
                                    $db->query($update);

                                    $update2 = "update prestadores set activo = FALSE where codigo = ".$codigo.";";
                                    $db->query($update2);
                                    
                                } 
                                    else {
                                        
                                        /* Asignar ajuste de horas (2hrs) */
                                    
                                        /* Obtener la entrada del prestador y sumarle 2 horas */
                                        
                                        /*
                                        
                                        $ajuste = "select adddate(entrada, interval 2 hour) as ajuste from registro where id_prestador = ".$row["id"]." order by entrada desc;";

                                        $result_ajuste = $db->query($ajuste);
                                        $row_ajuste = $result_ajuste->fetch_array(MYSQLI_ASSOC);
                                        echo $row_ajuste["ajuste"];
                                        
                                        /* Buscar el registro actual para asignar la nueva hora de salida */
                                        
                                        /*

                                        $result_id_prestador = "select id from registro where id_prestador = ".$row["id"]." order by entrada desc;";

                                        $result = $db->query($result_id_prestador);
                                        $row = $result->fetch_array(MYSQLI_ASSOC);
                                        echo $row["id"];

                                        $update = "update registro set salida = ".row_ajuste["ajuste"]." where id = ".$row["id"].";";
                                        $db->query($update);
                                        
                                        */
 
                                        $update2 = "update prestadores set activo = FALSE where codigo = ".$codigo.";";
                                        $db->query($update2);
                                        
                                        
                                    }
                                
                            }
                        
                        else {
                            ?><script type="text/javascript"> alert("Su código no ha iniciado sesión");  </script><?php
                        }
                    }
                            
                    else {

                            ?><script type="text/javascript"> alert("Código no registrado");  </script><?php

                    } 
         }

header("location:index.php");

?>