<!DOCTYPE HTML>

<html>
	<head>
		<title>Administrador</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="http://localhost/SS/assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
        
        <?PHP
        
           // require_once 'sesion.php';
        
           /* if(!isset($_SESSION[USERKEY])) {
                header('location:index.php');
            }*/
        
        
            $Nombre = '';
            $Codigo = '';
            $Carrera = '';
            $Horas = '';

            if ( $_SERVER["REQUEST_METHOD"] == "POST") 
            {
              $Nombre = $_POST['Nombre'];
              $Codigo = $_POST['Codigo'];
              $Carrera = $_POST['Carrera'];
              $result = '';
              $result2 = '';

              //require_once 'conexion.php';
              //$db = Conexion();

 $username = "root";
       $password = "";
        $database = "servicio_social";
        $db = new mysqli($hostname,$username,$password,$database);
               $select = "select * from prestadores where Codigo = '$Codigo';";

               $result = $db->query($select);

                      if ( $result ) {
                            if ( $result->num_rows > 0  ) {
                                ?><script type="text/javascript"> alert("Código SIIAU repetido");  </script><?php
                                }
                            else { 

                            $sql = "insert into prestadores (Nombre, Codigo, Carrera, Activo) values ( '".$Nombre."', '".$Codigo."', '".$Carrera."', FALSE);";
                            $result2 = $db->query($sql);

                                if ( $result2 ){
                                    
                                }
                                else{
                                    ?><script type="text/javascript"> alert("Error, registrar de nuevo");  </script><?php
                                }
                            }

                       } 

            }
        ?>
        
        
        
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
                                <a href="http://localhost/SS/new/index.php">
								<span class="symbol" style="bottom-margin: 10em;"><img src="http://localhost/SS/images/logo1.png" alt="" /></span><span class="text"> SISTEMA DE REGISTRO DE HORAS <br>
                                    SERVICO SOCIAL <br>
                                    UDG</span>
                                </a>
                            
						</div>
					</header>
                
                <!-- Message window -->
                

				<!-- Main -->
                
					<div id="main">
						<div class="inner">
							<h1>Administrador</h1>
							
                            <!-- Acciones -->
                            
                                <div class="acciones1">

                                    <table class="admin">
                                        <tr>
                                            <td onclick="location.href='reporte_general.php'">Reporte general<td>
                                        </tr>
                                        
                                        <tr>
                                                
                                            <td onclick="location.href='prestadores.php'">Prestadores<td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <td onclick="location.href='ultimos_registros.php'">Últimos registros<td>
                                        </tr>
                                        <tr>
                                            <td onclick="location.href='busqueda.php'">Búsqueda<td>
                                        </tr>
                                    </table>
                                  
                                </div>
                            
                                <div class="acciones2">

                                    <!-- Nuevo Usuario -->
                            
                                    <section class="admin1">

                                        <h2>Nuevo usuario</h2>
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <div class="field half first">
                                                <input type="text" name="Carrera" id="Carrera" placeholder="Carrera (COM,CEL,INFO)" />
                                            </div>
                                            <div class="field half">
                                                <input type="text" name="Codigo" id="Codigo" placeholder="Código" required/>
                                            </div>
                                            <div class="field">
                                                <textarea name="Nombre" id="Nombre" placeholder="Nombre"></textarea>
                                            </div>
                                            <ul class="actions">
                                                <li><input type="submit" value="Registrar" class="special" /></li>
                                            </ul>
                                        </form>
                                    </section>
                                    
                                </div>
                            
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
			<script src="http://localhost/SS/assets/js/jquery.min.js"></script>
			<script src="http://localhost/SS/assets/js/skel.min.js"></script>
			<script src="http://localhost/SS/assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="http://localhost/SS/assets/js/main.js"></script>

        
	</body>
</html>