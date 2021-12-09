<!DOCTYPE HTML>

<?php
/*
include 'sesion.php';

require_once 'conexion.php';
$db = Conexion();

if(!isset($_SESSION[USERKEY])) {
        header('location:index.php');
    }
*/




?>

<html>

<head>
    <title>Prestadores</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="http://148.202.152.33/SS/assets/css/main.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>

<body>

    <?PHP

    $Nombre = '';
    $Codigo = '';
    $Carrera = '';
    $Horas = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        // require_once 'conexion.php';
        //$db = Conexion();
        $hostname = "172.30.0.2";
        $username = "root";
        $password = "";
        $database = "servicio_social";
        $db = new mysqli($hostname, $username, $password, $database);
    }
    ?>



    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header">
            <div class="inner">

                <!-- Logo -->
                <a href="http://localhost:3000/SS/new/index.php">
                    <span class="symbol" style="bottom-margin: 10em;"><img src="http://148.202.152.33/SS/images/logo1.png" alt="" /></span><span class="text"> SISTEMA DE REGISTRO DE HORAS <br>
                        SERVICO SOCIAL <br>
                        UDG</span>
                </a>

                <!-- Go admin button -->

                <a href="http://localhost:3000/SS/new/admin.php">
                    <img class="img2" src="http://localhost:3000/SS/images/admin.png" alt="">
                </a>

            </div>
        </header>

        <!-- Confirmation window -->

        <div id="id02" class="modal">

            <form class="modal-content animate" method="get" action="">
                <div>
                    <center>
                        <h3>Confirmación</h3>

                </div>

                <div id="id_container">


                </div>

                <div class="container2" style="background-color:#f1f1f1">
                    <button type="submit" id="confirm" class="confirm">Eliminar</button>
                </div>
            </form>
        </div>


        <!-- Main -->

        <div id="main">
            <div class="inner">
                <h1>Prestadores en la dependencia</h1>



                <!-- Tabla prestadores-->

                <table class="prestadores">
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Carrera</th>
                        <th></th>
                    </tr>

                    <?php

                    $hostname = "172.30.0.2";
                    $username = "root";
                    $password = "";
                    $database = "servicio_social";
                    $db = new mysqli($hostname, $username, $password, $database);
                    $select_table = "SELECT nombre, codigo, carrera FROM prestadores;";
                    $result = $db->query($select_table);
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

                    ?>
                        <tr>
                            <td class=""><?php printf("%s", $row["nombre"]);   ?></td>
                            <td class=""><?php printf("%s", $row["codigo"]);   ?></td>
                            <td class=""><?php printf("%s", $row["carrera"]);  ?></td>
                            <td>
                                <center><input type="submit" class="prestador" id="<?php echo $row["codigo"];
                                                                                    echo $row["nombre"]; ?>" value="Eliminar"></center>
                            </td>
                        </tr>
                    <?php

                    }
                    /* free result set */
                    $result->close();

                    /* close connection */
                    $db->close();

                    ?>

                </table>

            </div>
        </div>





        <!-- Footer -->

        <footer id="footer">
            <div class="inner">
                <ul class="copyright">
                    <li>&copy; UDG All rights reserved</li>
                    <li>Powered by CUCEI MOBILE
                </ul>
            </div>
        </footer>

    </div>

    <!-- Scripts -->
    <script src="http://148.202.152.33/SS/assets/js/jquery.min.js"></script>
    <script src="http://148.202.152.33/SS/assets/js/skel.min.js"></script>
    <script src="http://148.202.152.33/SS/assets/js/acciones.js"></script>
    <script src="http://148.202.152.33/SS/assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="http://148.202.152.33/SS/assets/js/main.js"></script>

    <!-- Login box scripts -->
    <script>
        // Get the modal
        var modal1 = document.getElementById('confirm');
        var modal = document.getElementById('id02');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                location.reload();
            }
        }
    </script>


</body>

</html>