<?php 
require "db.php";
session_start();
if($_POST){
   $id=session_id();
   $nom = $_POST['txtNom'];
   $ape = $_POST['txtApe'];
   $email = $_POST['txtEmail'];
   $dir = $_POST['txtDir'];
   $car = $_POST['txtCar'];
   $fon = $_POST['txtFono'];

   $query ="UPDATE usuario SET nombre = '$nom',apellidos ='$ape',correo='$email',direccion='$dir',trabajo='$car', fono='$fon' where idUsuario = '$id'";
   $resultado = $mysqli->query($query);
   if($resultado){
      $_SESSION['message'] = 'Se modifico el usuario';
      $_SESSION['message_type'] = 'success';
      $_SESSION['ape']=$ape;
      $_SESSION['Cargo']=$car;
      $_SESSION['direccion']=$dir;
      $_SESSION['correo']=$email;
      $_SESSION['nombre']=$nom;
   }else{
      $_SESSION['message'] = 'No se pudo modificar el usuario';
      $_SESSION['message_type'] = 'danger';
   }

   header("Location: ../miPerfil.php");
}




?>