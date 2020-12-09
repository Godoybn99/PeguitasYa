<?php
require "db.php";
session_start();
if(isset($_POST)){
$nom = $_POST['txtNom'];
$ape = $_POST['txtApe'];
$email = $_POST['txtEmail'];
$pas = $_POST['txtPas'];
$cpas = $_POST['txtCpas'];
$calle = $_POST['txtDir'];
$comuna = $_POST['comuna'];

    $query = "INSERT INTO direccion (nombreCalle, idComuna) VALUES ('$calle', '$comuna')";
    $resultado = $mysqli->query($query);
    if($resultado){
        
        $query= $mysqli->query("SELECT @@identity AS idDireccion");
        if ($row = mysqli_fetch_row($query)) 
        {        
          $dir = trim($row[0]);
        }
        
    }else{
        $_SESSION['message'] = 'No se pudo guardar la direccion ';
        $_SESSION['message_type'] = 'danger';
    }




if($cpas == '' || $cpas =! $pas){
 
$_SESSION['message'] = 'Las contraseñas no coinciden';
$_SESSION['message_type'] = 'danger';

}else{
$query ="INSERT INTO usuario(nombre,apellidos,correo,direccion,contra,valoracion) VALUES('$nom','$ape','$email','$dir','$pas','3')";
$resultado = $mysqli->query($query);

$_SESSION['message'] = 'Se registro el usuario';
$_SESSION['message_type'] = 'success';
    
}
header("Location: ../inicio.php");
}
?>
