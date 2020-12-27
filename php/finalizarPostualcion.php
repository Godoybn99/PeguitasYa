<?php 
require "db.php";
session_start();


if(isset($_POST['publicacion'])){
    $id=session_id();
    $pu= $_POST['publicacion'];
    $es= $_POST['estado'];

    $query="UPDATE trabajo set idEstado = '$es' where idTrabajo = '$pu'";
    $resultado = $mysqli->query($query);
    if($resultado){ 
    $_SESSION['message'] = 'Se finalizo la publicacion';
    $_SESSION['message_type'] = 'success';
    }else{
        $_SESSION['message'] = 'No se pudo finalizar la publicacion';
        $_SESSION['message_type'] = 'danger';
    }
    header("Location: ../misPublicaciones.php");
}
?>