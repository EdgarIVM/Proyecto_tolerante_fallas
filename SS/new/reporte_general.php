<!DOCTYPE HTML>

<style>
    p.fechaI {
        width: 10%;
        float: left;
    }

    p.fechaF {
        float: left;
        width: 10%;

    }

    p.boton {
        float: left;
    }

    div.newFechas {
        border-width: 2px;
    }
</style>

<?php

//include 'sesion.php';

//require_once 'conexion.php';
//$db = Conexion();

/*if(!isset($_SESSION[USERKEY])) {
        header('location:index.php');
    }*/

?>

<html>

<head>
    <title>Reporte general</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="http://148.202.152.33/SS/assets/css/main.css" />
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
                    <span class="symbol" style="bottom-margin: 10em;"><img src="http://148.202.152.33/SS/images/logo1.png" alt="" /></span><span class="text"> SISTEMA DE REGISTRO DE HORAS <br>
                        SERVICO SOCIAL <br>
                        UDG</span>
                </a>

                <!-- Go admin button -->

                <a href="admin.php">
                    <img class="img2" src="http://148.202.152.33/SS/images/admin.png" alt="">
                </a>

            </div>
        </header>

        <!-- Main -->

        <div id="main">
            <div class="inner">
                <h1> Reporte general </h1>
                <form action="" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <form action="reporte_general.php" method="POST">
                        <div>
                            <p class="fechaI">
                                <label for="inicio">Desde:</label>
                                <input type="date" name="desde">
                            </p>
                            <p class="fechaF">
                                <label for="final">Hasta:</label>
                                <input type="date" name="hasta">
                            </p>
                            <p class="boton">
                                <input type="submit" name="saveDates" class="checkin" value="Reporte bimestral">
                            </p>
                        </div>
                    </form>



                </form>



                <!-- Tabla registros -->

                <table>
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Primer registro</th>
                        <th>Último registro</th>
                        <th>Horas (HH:MM:SS)</th>
                        <th>Horas Bimestrales</th>
                    </tr>

                    <?php
                    $hostname = "172.30.0.2";
                    $username = "root";
                    $password = "";
                    $database = "servicio_social";
                    $db = new mysqli($hostname, $username, $password, $database);

                    $n = 0;

                    $select_prestador = "SELECT prestadores.nombre, prestadores.codigo, sec_to_time(120) as total_horas from prestadores;";

                    $show_data = $db->query($select_prestador);
                    while ($row = $show_data->fetch_array(MYSQLI_ASSOC)) {

                    ?>
                        <tr>
                            <td class=""><?php printf("%s", $row["nombre"]);   ?></td>
                            <td class=""><?php printf("%s", $row["codigo"]);   ?></td>
                            <td class=""><?php

                                            /* PRIMERO */

                                            $codigo = $row['codigo'];


                                            /* Obtener id_prestador a partir del codigo */

                                            $id_codigo = "select id from prestadores where Codigo = " . $codigo . ";";
                                            $result_codigo = $db->query($id_codigo);
                                            $row_code = $result_codigo->fetch_array(MYSQLI_ASSOC);

                                            $primer_reg = "select date(entrada) from registro where id_prestador = " . $row_code["id"] . ";";
                                            $result_primer = $db->query($primer_reg);
                                            $row_primer = $result_primer->fetch_array(MYSQLI_ASSOC);


                                            if ($row_primer != NULL) {

                                                echo $row_primer["date(entrada)"];
                                            } else {
                                                echo "N/A";
                                            }

                                            ?></td>
                            <td class=""><?php

                                            /* ULTIMO */

                                            $codigo = $row['codigo'];

                                            /* Obtener id_prestador a partir del codigo */

                                            $id_codigo = "select id from prestadores where Codigo = " . $codigo . ";";
                                            $result_codigo = $db->query($id_codigo);
                                            $row_code = $result_codigo->fetch_array(MYSQLI_ASSOC);

                                            $ultimo_reg = "select date(entrada) from registro where id_prestador = " . $row_code["id"] . " order by entrada desc;";
                                            $result_ultimo = $db->query($ultimo_reg);
                                            $row_ultimo = $result_ultimo->fetch_array(MYSQLI_ASSOC);


                                            if ($row_ultimo != NULL) {

                                                echo $row_ultimo["date(entrada)"];
                                            } else {
                                                echo "N/A";
                                            }

                                            ?></td>
                            <td class=""><?php


                                            /* Conteo de horas totales */
                                            if ($row['codigo']) {
                                                global $codigo;
                                                $codigo = $row['codigo'];
                                                /* Obtener id_prestador a partir del codigo */

                                                $id_codigo = "select id from prestadores where Codigo = " . $codigo . ";";
                                                $result_codigo = $db->query($id_codigo);
                                                $row_code = $result_codigo->fetch_array(MYSQLI_ASSOC);

                                                /* Suma de todos los registros de ese prestador en formato de segundos */

                                                $total = 0;

                                                $seconds = "SELECT entrada, salida, TIMESTAMPDIFF(SECOND, entrada, salida) AS horas FROM registro where id_prestador = " . $row_code["id"] . ";";
                                                $add_seconds = $db->query($seconds);
                                                while ($row = $add_seconds->fetch_array(MYSQLI_ASSOC)) {
                                                    $total = $total + $row["horas"];
                                                }

                                                /* Conversión de segundos a formato HH:MM:SS */

                                                $added = "SELECT SEC_TO_TIME(" . $total . ") AS total_horas;";

                                                $added_result = $db->query($added);
                                                $row_added = $added_result->fetch_array(MYSQLI_ASSOC);

                                                echo $row_added["total_horas"];
                                            } else {
                                                echo "Aún no tiene horas registradas";
                                            }
                                            ?></td>
                            <td class=""><?php
                                            if (isset($_POST['saveDates'])) {
                                                $startDate = $_POST['desde'];
                                                $finishDate = $_POST['hasta'];
                                            }
                                            $id_codigo = "select id from prestadores where Codigo = " . $codigo . ";";
                                            $result_codigo = $db->query($id_codigo);
                                            $row_code = $result_codigo->fetch_array(MYSQLI_ASSOC);

                                            /* Suma de todos los registros de ese prestador en formato de segundos */

                                            $total = 0;

                                            $seconds = "SELECT entrada, salida, TIMESTAMPDIFF(SECOND, entrada, salida) AS horas FROM registro where id_prestador = " . $row_code["id"] . " AND (entrada BETWEEN '" . $startDate . " 00:00:00' AND '" . $finishDate . " 23:59:59');";
                                            //$seconds = "SELECT entrada, salida, TIMESTAMPDIFF(SECOND, entrada, salida) AS horas FROM registro where id_prestador = " . $row_code["id"] . ";";
                                            $add_seconds = $db->query($seconds);
                                            while ($row = $add_seconds->fetch_array(MYSQLI_ASSOC)) {
                                                $total = $total + $row["horas"];
                                            }

                                            /* Conversión de segundos a formato HH:MM:SS */

                                            $added = "SELECT SEC_TO_TIME(" . $total . ") AS total_horas;";

                                            $added_result = $db->query($added);
                                            $row_added = $added_result->fetch_array(MYSQLI_ASSOC);

                                            echo $row_added["total_horas"];






                                            ?></td>
                        </tr>

                    <?php

                    }


                    /* free result set */
                    $show_data->close();

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
    <script src="http://148.202.152.33/SS/assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="http://148.202.152.33/SS/assets/js/main.js"></script>


</body>

</html>