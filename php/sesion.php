
<?php
require "db.php";
if($_POST){
    $us= $_POST['txtUs'];
    $con= $_POST['txtCon'];

    $query ="SELECT * FROM usuario where correo = '$us'";

    $resultado = $mysqli->query($query);
    $num = $resultado->num_rows;

    if($num>0){
         $row = $resultado->fetch_assoc();
         $contra_bd = $row['contra']; 
        if($contra_bd == $con){
            $id =$row['idUsuario'];
            session_id($id);
            session_start();
            $_SESSION['id']= $row['idUsuario'];
            $_SESSION['nombre'] = $row['nombre'];
            header("Location: ../index.php");
        }else{
            session_start();
            $_SESSION['message'] = 'Contraseña incorrecta o el usuario no existe';
            $_SESSION['message_type'] = 'danger';
            header("Location: ../inicio.php");
        }

    }
}
?>