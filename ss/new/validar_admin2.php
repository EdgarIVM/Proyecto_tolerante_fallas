<?php
 $user=$_POST['User'];
     $pass=$_POST['Pass'];
   // echo $user;
    //echo "<br>".$pass;
                                   
         $hostname = "localhost";
         $username = "root";
         $password = "";
        $database = "servicio_social";
        $db = new mysqli($hostname,$username,$password,$database);

                                        $select_table = "SELECT * from admin where user = \"".$user."\" ";
                                        
                                        $result = $db->query($select_table);
                                        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                        	$var1 = $row['pass'];
											$var2 = $pass;
											//echo $var1."     ".$var2;
											if (strcmp($var1, $var2) === 0){
    											 header('location:admin.php');

													}else{
														header('location:index.php');
														}
                                        }
                                        	
                                          $result->close();
                                           $db->close();

     
        
?>