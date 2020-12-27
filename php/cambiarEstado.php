<?php 
require "db.php";
session_start();
$publicacion = $_POST['publicacion'];
$estado = $_POST['estado'];
if($_POST['estado'] == 1){
    $estado = 2;
} 
if($_POST['estado']== 2){
    $estado = 1;
}
if($_POST['estado']== 3){
    $estado = 1;
}
$query="UPDATE trabajo set idEstado = '$estado' where idTrabajo = '$publicacion'";
$resultado = $mysqli->query($query);
if($resultado){
    $_SESSION['message'] = 'Se cambio el estado de la publicacion';
    $_SESSION['message_type'] = 'success';
    header("Location: ../misPublicaciones.php");
}else{
    $_SESSION['message'] = 'No se pudo cambiar el estado de la publicacion';
    $_SESSION['message_type'] = 'danger';
    header("Location: ../misPublicaciones.php");
}

?>