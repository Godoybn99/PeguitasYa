<?php
session_start();
require "db.php";
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
if($_POST){
    $id=session_id();
    $ac = $_POST['txtApas'];
    $nc = $_POST['txtNpas'];
    $cc = $_POST['txtCpas'];
    if($nc == $cc){
    $query ="UPDATE usuario SET contra = '$nc' where idUsuario = '$id'";
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
    header("Location: ../miPerfil.php");
}


?>