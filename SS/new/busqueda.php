<!DOCTYPE HTML>


<?php

    include 'sesion.php';
    
    if(!isset($_SESSION[USERKEY])) {
        header('location:index.php');
    }
     
?>

<html>
	<head>
		<title>Búsqueda</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
        

                
<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
                                <a href="index.php">
								<span class="symbol" style="bottom-margin: 10em;"><img src="images/logo1.png" alt="" /></span><span class="text"> SISTEMA DE REGISTRO DE HORAS <br>
                                    SERVICO SOCIAL <br>
                                    UDG</span>
                                </a>
                            
                            <!-- Go admin button -->
                
                            <a href="admin.php">
                            <img class="img2" src="images/admin.png" alt="" >
                            </a>
                                
						</div>
                        
                        
                        
					</header>
                
                
                

				<!-- Main -->
                
					<div id="main">
						<div class="inner">
							<h1>Búsqueda</h1>
							
                            <!-- Formulario de búsqueda -->
                            
                            <form method="post" class="buscar" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                               
                                <input type="text" class="busqueda" name="Codigo" placeholder="Código" required>
                                <input type="text" class="code" name="Desde"  placeholder="Desde (YYYY-MM-DD)">
                                <input type="text" class="code" name="Hasta"  placeholder="Hasta (YYYY-MM-DD)">
                                <input type="submit" class="checkin"  value="Buscar">
                              
                                
                                
                            </form>
                            
                            <hr>
                            
                            <!-- Tabla registros -->
                            
                                            <?php  
                            
                                            
                            
                                            $desde = '';
                                            $hasta = '';
                            
                                            if ( $_SERVER["REQUEST_METHOD"] == "POST" ) 
                                            {
                                                
                                               $desde = $_POST['Desde']; 
                                               $hasta = $_POST['Hasta'];
                                              
                                              
                                              if (empty($desde)) {
                                                  $desde = "1900-01-01";
                                              }
                                              
                                              if (empty($hasta)) {
                                                  $hasta = "2030-01-01";
                                              } 
                                                
                                              $codigo = $_POST['Codigo'];
                                              
                                              
                                              $result = '';
                                              $result2 = '';

                                              require_once 'conexion.php';
                                              $db = Conexion();
                                            
                                            /* Obtener id a partir del  código */
                            
                                            $select_codigo = "select id from prestadores where codigo = ". htmlentities($codigo) .";";
                                            $result = $db->query($select_codigo);
                                            $row = $result->fetch_array(MYSQLI_ASSOC);
                                            $row_id = $row["id"];
                                            
                                            /* Obtener prestador a partir del id */
                            
                                            $select_nombre = "select nombre from prestadores where codigo = ". htmlentities($codigo) .";";
                                            
                                            $result_nombre = $db->query($select_nombre);
                                            $row_nombre = $result_nombre->fetch_array(MYSQLI_ASSOC);

                                            /* Obtener horas por día del prestador en formato de segundos */

                                            $total = 0;

                                            $seconds = "SELECT date(entrada), entrada, salida, TIMESTAMPDIFF(SECOND, entrada, salida) AS horas FROM registro where id_prestador = '$row_id' and date(entrada) between '$desde' and '$hasta';";

                                            $add_seconds = $db->query($seconds);
                                            while($row_total = $add_seconds->fetch_array(MYSQLI_ASSOC)) {
                                                $total = $total + $row_total["horas"];
                                            }

                                            /* Conversión de segundos a formato HH:MM:SS */
                            
                                            $added = "SELECT SEC_TO_TIME(".$total.") AS total_horas;";    

                                            $added_result = $db->query($added);
                                            $row_added = $added_result->fetch_array(MYSQLI_ASSOC);

                                            
                                            /* Imprimir el nombre del prestador y su total del horas */
                            
                                            ?>
                                            
                                            <br>
                                            <h1><?php echo $row_nombre["nombre"]; ?></h1>
                                            <h1 style="color:red;"><?php echo $row_added["total_horas"]; ?> </h1>
                                      
                                
                                        <table class="prestadores">
                                            <tr>
                                                <th>Registro</th>
                                                <th>Fecha</th>
                                                <th>Horas por día</th>
                                            </tr>

                                            <?php
                                            $registro = 1;
                                            
                                                    /* Para mostrar en la tabla */
                                                
                                                    
                                                
                                                    $select_table = "SELECT date(entrada), entrada, sec_to_time(TIMESTAMPDIFF(SECOND, entrada, salida)) AS horas from registro where (date(entrada) between '$desde' and '$hasta') and (registro.id_prestador = '$row_id' and salida is not null) order by entrada desc;";    
                                                
                                                    /*
                                                    $select_table = "SELECT date(entrada), entrada, salida, sec_to_time(TIMESTAMPDIFF(SECOND, entrada, salida)) AS horas from registro where (registro.id_prestador = ".$row["id"]." and salida is not null) and entrada between ".htmlentities($desde)." and ".htmlentities($hasta)." order by salida desc;";
                                                    */
                                                
                                                    

                                                    $result = $db->query($select_table);
                                                    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                            ?>
                                            
                                            
                                            
                                            <tr>
                                                <td>
                                                    
                                                    <?php    
                                                
                                                    echo $registro;
                                                    $registro = $registro + 1;
                                                    
                                                    ?></td>
                                                <td class=""><?php echo $row["date(entrada)"];   ?></td>
                                                <td class=""><?php 
                                                
                                                    /* Horas por día */
                                                    
                                                    if ($row['date(entrada)']){

                                                        

                                                        echo $row["horas"];
                                                        
                                                        }

                                                    
                                                    else{
                                                        echo "Aún no tiene horas registradas";
                                                    }
                                                    
                                                    ?></td>
                                            </tr>
                                            <?php   

                                            }
                                            
                                            
                
                                                
                                            /* free result set */
                                            $result->close();

                                            /* close connection */
                                            $db->close();
                
                                            }
                                            
                
                                            ?>

                                        </table>
                            
                            
						</div>
					</div>


                
                
                
				<!-- Footer -->
                
					<footer id="footer">
						<div class="inner">
							<ul class="copyright">
								<li>&copy; UDG All rights reserved</li><li>Powered by CUCEI MOBILE
							</ul>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

        
	</body>
</html>