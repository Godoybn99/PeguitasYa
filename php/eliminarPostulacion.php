<?php
require "db.php";
session_start();


if (isset($_POST['publicacion'])) {
    $id = session_id();
    $pu = $_POST['publicacion'];
    $us = $_POST['usuario'];

    $query = "DELETE FROM postulacion where idUsuario = '$us' AND idTrabajo = '$pu'";
    $resultado = $mysqli->query($query);
    if ($resultado) {
        $_SESSION['message'] = 'Se eliminó tu postulacion satisfactoriamente.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'No se pudo eliminar tu postulacion. Intenta mas tarde.';
        $_SESSION['message_type'] = 'danger';
    }
    header("Location: ../miPerfil.php");
}