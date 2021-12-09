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
    <title>Últimos registros</title>
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
        $Nombre = $_POST['Nombre'];
        $Codigo = $_POST['Codigo'];
        $Carrera = $_POST['Carrera'];
        $result = '';
        $result2 = '';

        // require_once 'conexion.php';
        //$db = Conexion();

    }

    ?>

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header">
            <div class="inner">

                <!-- Logo -->
                <a href="http://localhost:3000/SS/newindex.php">
                    <span class="symbol" style="bottom-margin: 10em;"><img src="http://148.202.152.33/SS/images/logo1.png" alt="" /></span><span class="text"> SISTEMA DE REGISTRO DE HORAS <br>
                        SERVICO SOCIAL <br>
                        UDG</span>
                </a>

                <!-- Go admin button -->

                <a href="http://localhost:3000/SS/new/admin.php">
                    <img class="img2" src="http://148.202.152.33/SS/images/admin.png" alt="">
                </a>

            </div>
        </header>

        <!-- Main -->

        <div id="main">
            <div class="inner">
                <h1>Últimos registros </h1>

                <!-- Tabla registros -->

                <table class="prestadores">
                    <tr>
                        <th>Registro</th>
                        <th>Nombre</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                    </tr>

                    <?php
                    $hostname = "172.30.0.2";
                    $username = "root";
                    $password = "";
                    $database = "servicio_social";
                    $db = new mysqli($hostname, $username, $password, $database);
                    $registro = 1;

                    $select_table = "SELECT prestadores.nombre, registro.entrada, registro.salida from prestadores, registro where (prestadores.id = registro.id_prestador) order by entrada desc;";

                    $result = $db->query($select_table);
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

                        if ($registro > 50) {
                            break;
                        }

                    ?>
                        <tr>
                            <td><?php

                                echo $registro;
                                $registro = $registro + 1;

                                ?></td>
                            <td class=""><?php printf("%s", $row["nombre"]);   ?></td>
                            <td class=""><?php printf("%s", $row["entrada"]);   ?></td>
                            <td class=""><?php printf("%s", $row["salida"]);  ?></td>
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
    <script src="http://148.202.152.33/SS/sesion.php"></script>
    <script src="http://148.202.152.33/SS/assets/js/skel.min.js"></script>
    <script src="http://148.202.152.33/SS/assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="http://148.202.152.33/SS/assets/js/main.js"></script>


</body>

</html>