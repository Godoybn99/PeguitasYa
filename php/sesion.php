<?php
include("db.php");

include("usuario.php");
include('SesionUser.php');

$Usersesion = new UserSesion();
$usuario = new usuario();


if(isset($_SESSION['usuario'])){
    echo "Hay sesion";
    
}else if (isset($_POST['txtUs']) && isset($_POST['txtCon'])){

    $us = $_POST['txtUs'];
    $contra = $_POST['txtCon'];

    if($usuario->exUs($us,$contra,$conn)){
        echo "Usuario valido";
    }else{
    $errorLogin = "El nobmre de usuario/contraseña son erroneos";
    $errorType = "danger";
    include_once 'location: ../inicio.php';
}

}else{


    
}
//$query = "SELECT * from usuarios where usuario = '$us' and contra = '$pas'";
//$resultado = mysqli_query($conn, $query);

//while($row = mysqli_fetch_array($resultado)){
  //  $_SESSION['message'] = 'Se inicio sesion';
    //$_SESSION['message_type'] = 'success';
    //header("location: ../inicio.php");





?>