<?php  
include("db.php");

class UserSesion{

public function __construct()
{
    session_start();
}

public function setCurrentUser($usuario){
    $_SESSION['usuario'] = $usuario;
}

public function getCurrentUser($usuario){
 return $_SESSION['$usuairo'];
}

public function closeSesion(){
    session_unset();
    session_destroy();
}

}



?>