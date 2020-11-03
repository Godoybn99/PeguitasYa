<?php
require "db.php";
session_start();
if(isset($_POST['btn_registro'])){
$btn= $_POST['btn_registro'];
$rut = $_POST['txtRut'];
$us = $_POST['txtUsuario'];
$email = $_POST['txtEmail'];
$pas = $_POST['txtPas'];
$cpas = $_POST['txtCpas'];

if($cpas == '' || $cpas =! $pas){
 
$_SESSION['message'] = 'Las contraseñas no coinciden';
$_SESSION['message_type'] = 'danger';

}else{
$query ="INSERT INTO usuarios(rut,usuario,contra,email) VALUES('$rut','$us','$email','$pas')";
$resultado = $mysqli->query($query);
if(!$resultado){
    echo mysqli_error($conn);
}else{

} 
$_SESSION['message'] = 'Se registro el usuario';
$_SESSION['message_type'] = 'success';
}

header("Location: ../inicio.php");
}
?>
