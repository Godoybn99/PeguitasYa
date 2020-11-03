
<?php
require "db.php";
session_start();
if($_POST){
    $us= $_POST['txtUs'];
    $con= $_POST['txtCon'];

    $query ="SELECT * FROM usuarios where usuario = '$us'";

    $resultado = $mysqli->query($query);
    $num = $resultado->num_rows;

    if($num>0){
         $row = $resultado->fetch_assoc();
         $contra_bd = $row['contra'];
        if($contra_bd == $con){

            $_SESSION['nombre'] = $row['usuario'];
            $_SESSION['rut'] = $row['rut'];
            header("Location: ../index.php");
        }else{
            $_SESSION['message'] = 'Contraseña incorrecta';
            $_SESSION['message_type'] = 'danger';
            header("Location: ../inicio.php");
        }

    }else{
        $_SESSION['message'] = 'El usuario no existe';
        $_SESSION['message_type'] = 'danger';
        header("Location: ../inicio.php");
    }
}

?>