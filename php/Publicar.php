<?php 
require "db.php";
session_start();
if(isset($_POST)){
    $id=$_SESSION['id'];
    $titulo = $_POST['job-title'];
    $comuna = $_POST['comuna'];
    $tipo = $_POST['job-type'];
    $calle = $_POST['txtCalle'];
    $num = $_POST['txtNum'];
    $des = $_POST['txtDes'];
    
    if($tipo=="Full Time"){
        $tipo="1";
    }else if($tipo=="Part Time"){
        $tipo="2";
    }else if($tipo=="Esporadico"){
        $tipo="3";
    }


    $query = "INSERT INTO direccion (nombreCalle,numeroCalle,idComuna) VALUES ('$calle','$num','$comuna')";
    $resultado = $mysqli->query($query);
    if($resultado){
        
        $query= $mysqli->query("SELECT @@identity AS idDireccion");
        if ($row = mysqli_fetch_row($query)) 
        {
          $dir = trim($row[0]);
        }
        $id=$_SESSION['id'];
    }else{
        $_SESSION['message'] = 'No se pudo guardar la direccion ';
        $_SESSION['message_type'] = 'danger';
        $id=$_SESSION['id'];
        echo mysqli_error($resultado);

    }
    $query2 = "INSERT INTO trabajo(titulo,descripcion,idUsuario,idDireccion,idEstado,idTipo) VALUES ('$titulo', '$des', '$id', '$dir', '1', '$tipo')";
    $resultado2 = $mysqli->query($query2);
    if($resultado2){
       $_SESSION['message'] = 'Se realizo la publicacion';
       $_SESSION['message_type'] = 'success';
       $id=$_SESSION['id'];
        
    }else{
        $_SESSION['message'] = 'No se pudo realizar la publicacion ';
        $_SESSION['message_type'] = 'danger';
       $id=$_SESSION['id'];
    }
    header("Location: ../post-job.php");
}

?> 