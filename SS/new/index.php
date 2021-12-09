<!DOCTYPE HTML>

<html>

<head>
    <title>Horas Servicio Social</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="http://148.202.152.33/SS/assets/css/main.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->

</head>

<body>


    <?PHP



    //require_once 'conexion.php';
    //require_once 'sesion.php';

    //CerrarSesion();

    /* $token = obtenerSessionToken();
        if(!verificarToken($token)){
            header('location:token.php');   
        }*/


    //$db = Conexion();


    ?>



    <!-- Wrapper -->

    <div id="wrapper">

        <!-- Header -->
        <header id="header">
            <div class="inner">

                <!-- Logo -->



                <!-- Logo -->
                <a href="index.php">
                    <span class="symbol" style="bottom-margin: 10em;"><img src="http://148.202.152.33/SS/images/logo1.png" alt="" /></span><span class="text"> SISTEMA DE REGISTRO DE HORAS <br>
                        SERVICO SOCIAL <br>
                        UDG</span>
                </a>


                <!-- Login box -->

                <img onclick="document.getElementById('id01').style.display='block'" class="img2" src="http://148.202.152.33/SS/images/admin.png" alt="">




                <div id="id01" class="modal">

                    <form class="modal-content animate" method="post" action="http://localhost:3000/SS/new/validar_admin2.php">
                        <div class="imgcontainer">
                        </div>

                        <div class="container">
                            <label><b>Username</b></label>
                            <input type="text" placeholder="Enter Username" name="User" required>

                            <label><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="Pass" required>
                        </div>

                        <div class="container2" style="background-color:#f1f1f1">
                            <button type="submit">Login</button>
                        </div>
                    </form>
                </div>


            </div>
        </header>

        <!-- Main -->

        <div id="main">
            <div class="inner">
                <header>
                    <h1>Bienvenido al sistema de registro de horas kkkkk</h1>
                </header>


                <!-- Check in / check out entry -->

                <form action="" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="text" class="code" name="Codigo" placeholder="Código SIIAU">
                    <input type="submit" class="checkin" value="Check in" formaction="Check_in.php">
                    <input type="submit" class="checkout" value="Check out" formaction="Check_out.php">
                </form>

                <!-- Activos -->

                <div class="tabla_activos">
                    <table class="activos">
                        <tr>
                            <th>
                                <center>PRESTADORES EN JORNADA</center>
                            </th>
                        </tr>

                        <?php
                        $hostname = "172.30.0.2";
                        $username = "root";
                        $password = "";
                        $database = "servicio_social";
                        $db = new mysqli($hostname, $username, $password, $database);

                        $select_table = "SELECT nombre from prestadores where (activo = 1);";
                        $result = $db->query($select_table);
                        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

                        ?>
                            <tr>
                                <td class=""><?php printf("%s", $row["nombre"]);   ?></td>
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

                <!-- List -->

                <div class="list">
                    <h3>Puntos a tomar en cuenta:</h3>
                    <ul>
                        <li> Sesiones con más de 8 horas de duración no serán registradas por el sistema.
                        <li> Todos los registros son para uso exclusivo de esta dependencia.
                        <li> Las horas extra no se deben registrar por medio de este sitio.
                    </ul>
                </div>

                <!-- First time slider -->

                <div id="flip">
                    ¿Primera vez registrando horas?
                </div>

                <div id="panel">
                    <table class="steps">
                        <tr>
                            <td>Paso 1
                            <td>
                            <td>Para comenzar a registrar horas debes pedir al titular de la dependencia crearte un usuario.
                            <td>
                        </tr>
                        <tr>
                            <td>Paso 2
                            <td>
                            <td>Una vez creado el usario, debes ingresar tu código SIIAU en el "<i>textbox</i>" y dar click en CHECK IN.
                            <td>
                        </tr>
                        <tr>
                            <td>Paso 3
                            <td>
                            <td>Inicia tu jornada de servicio social.
                            <td>
                        </tr>
                        <tr>
                            <td>Paso 4
                            <td>
                            <td>Al finalizar tu jornada, vuelve a poner tu código SIIAU y da click en CHECK OUT.
                            <td>
                        </tr>
                    </table>
                </div>
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
    <script src="http://148.202.152.33/SS/assets/js/jquery-3.1.1.js"></script>
    <!-- First time slider -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $("#flip").click(function() {
                $("#panel").slideToggle("slow");
            });
        });
    </script>
    <!-- Login box scripts -->
    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>







</body>

</html>