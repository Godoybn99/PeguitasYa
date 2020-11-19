<?php
require "db.php";
session_start();

if(isset($_POST['publicacion'])){
    $id=$_SESSION['id'];
    $pu= $_POST['publicacion'];
    $query ="DELETE FROM trabajo where idTrabajo='$pu'";
    $resultado = $mysqli->query($query);
    if(!$resultado){
        $_SESSION['message'] = 'No se pudo eliminar la publicacion';
        $_SESSION['message_type'] = 'danger';
    }
    $_SESSION['message'] = 'Se elimino la publicacion';
    $_SESSION['message_type'] = 'success';
        
    header("Location: ../misPublicaciones.php");
}
?>