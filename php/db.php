<?php

//session_start();

//$usuario = $_SESSION['invitado'];
//if(!isset($usuario)){
 // header("location: inicio.php");
//}else{
 //   echo "Hola '$usuario' ";
//}
 $conn = mysqli_connect('localhost','root','','peguita');
 if(isset($conn))
 {
    
 }else{
     echo 'no conectada';
 }
?>