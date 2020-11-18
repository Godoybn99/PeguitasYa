<?php
require "db.php";
session_start();

if($_POST){
    $id=$_SESSION['id'];
    $pb = $_POST['pBusq'];
    $reg = $_POST['region'];
    $tipo = $_POST['tipoT'];
    if($nc == $cc){
    $query ="SELECT * FROM trabajo WHERE titulo =  '$nc' where idUsuario = '$id'";
    $resultado = $mysqli->query($query);

    if($resultado){
        $_SESSION['message'] = 'Se modifico la contraseña';
        $_SESSION['message_type'] = 'success';
        $_SESSION['ape']=$ape;
        $_SESSION['Cargo']=$car;
        $_SESSION['direccion']=$dir;
        $_SESSION['correo']=$email;
        $_SESSION['nombre']=$nom;   
        $id=$_SESSION['id'];
    }else{
        $_SESSION['message'] = 'Las contraseñas no coinciden';
        $_SESSION['message_type'] = 'danger';
        $id=$_SESSION['id'];
        
    }
    }else{
        $_SESSION['message'] = 'Las contraseñas no coinciden';
        $_SESSION['message_type'] = 'danger';
        $id=$_SESSION['id'];
        
    }
    header("Location: ../index.php");
}


?>