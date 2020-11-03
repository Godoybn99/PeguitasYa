<?php
include("db.php");

if(isset($_POST['btn_registro'])){
$btn= $_POST['btn_registro'];
$rut = $_POST['txtRut'];
$us = $_POST['txtUsuario'];
$email = $_POST['txtEmail'];
$pas = $_POST['txtPas'];
$cpas = $_POST['txtCpas'];

if($cpas == '' || $cpas =! $pas){
 
$_SESSION['message2'] = 'Las contraseñas no coinciden';
$_SESSION['message_type2'] = 'danger';

}else{
$query ="INSERT INTO usuarios(rut,usuario,contra,email) VALUES('$rut','$us','$email','$pas')";
$resultado = mysqli_query($conn, $query);
if(!$resultado){
    echo mysqli_error($conn);
}else{

}

}
$_SESSION['message2'] = 'Se registro el usuario';
$_SESSION['message_type2'] = 'success';
header("Location: ../inicio.php");
}
?>
