<?php 
    define("USERKEY","USER");
    require_once("conexion.php");
    session_start();
    
    class Usuario{
        public $id = 0;
        public $name = "";
    }

    function Autenticar($username, $password) {

        // TODO Consultar en base de datos, insertar el usuario si existe y retornar verdadero o falso si existe o no. 

      //  require_once 'conexion.php';
        //$db = Conexion();
         $username = "root";
       $password = "";
        $database = "servicio_social";
        $db = new mysqli($hostname,$username,$password,$database);
        $autenticar = "select * from admin WHERE user = '$username' and pass = '$password'";

        $result = $db->query($autenticar);

        if($row = $result->fetch_array(MYSQLI_ASSOC)){
            //quiere decir que al menos hay un usuario
            $user = new Usuario;
            $user->id = $row["id"];
            $user->name = $row["user"];
            $_SESSION[USERKEY] = $user;
            return true;

        }else{
             $_SESSION[USERKEY] = null;
            return false;
        }

    }

    function EstaAutenticado($username) {
        // TODO Regresar verdadero o falso si el usuario está guardado en sesión.  
        return  $_SESSION[USERKEY] == null;
    }

    function CerrarSesion() {
        // TODO Eliminar el usuario de la sesión.    
         $_SESSION[USERKEY] = null;
    }

    function establecerToken(){
            
            // Creación del token de seguridad
        
            $date = date("Y/m/l");
            $date2 = date("Y/m/d");


            list($year, $month, $day) = split('/', $date);
            list($year2, $month2, $day2) = split('/', $date2);


            $str1 = $day;
            $arr1 = str_split($str1);

            $str2 = $year;
            $arr2 = str_split($str2);

            $str3 = $month;
            $arr3 = str_split($str3);

            $str4 = $day2;
            $arr4 = str_split($str4);

            switch ($day) {
                case "Monday":
                    $number_day = 1;
                    break;
                case "Tuesday":
                    $number_day = 2;
                    break;
                case "Wednesday":
                    $number_day = 3;
                    break;
                case "Thursday":
                    $number_day = 4;
                    break;
                case "Friday":
                    $number_day = 5;
                    break;
                case "Saturday":
                    $number_day = 6;
                    break;
                case "Sunday":
                    $number_day = 7;
                    break;
                default:
                    echo "Error al crear number_day";
            }


            $token = $arr4[0] . $arr3[0] . $arr2[2] . $arr1[0] . $arr2[3] . $arr3[1] . $arr4[1] . $number_day;
        
            //Insertar token de seguridad en la base de datos
        
            $sql = "INSERT INTO tokens(token) values ('$token')";
            $db = conexion();
            $result = $db->query($sql);            
        }

    function verificarToken($token){
        if($token == null) return false;
        $sql = "SELECT token FROM tokens ORDER BY id DESC LIMIT 1";
        $db = conexion();
        $result = $db->query($sql);
        $lasttoken = null;
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $lasttoken = $row['token'];
        }
        return ($lasttoken != null && $lasttoken == $token);
    }

    function establecerSessionToken($token){
        $_SESSION['token'] = $token;
    }

    function obtenerSessionToken(){
        return $_SESSION['token'];
        }

    function VerificarSiEstaAutenticado(){
        $auth = new Authenticador;
        if(!$auth->EstaAutenticado()){
            header("location:index.php");
        }
    }
    
   
    

?>