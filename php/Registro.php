<?php
require "db.php";
session_start();
if(isset($_POST)){
$nom = $_POST['txtNom'];
$ape = $_POST['txtApe'];
$email = $_POST['txtEmail'];
$pas = $_POST['txtPas'];
$cpas = $_POST['txtCpas'];
$dir = $_POST['txtDir'];

if($cpas == '' || $cpas =! $pas){
 
$_SESSION['message'] = 'Las contraseñas no coinciden';
$_SESSION['message_type'] = 'danger';

}else{
$query ="INSERT INTO usuario(nombre,apellidos,correo,direccion,contra) VALUES('$nom','$ape','$email','$dir','$pas')";
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
