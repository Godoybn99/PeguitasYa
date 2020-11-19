<?php 
require "db.php";
session_start();
if(isset($_POST)){
    $id=$_SESSION['id'];
    $titulo = $_POST['job-title'];
    $comuna = $_POST['comuna'];
    $tipo = $_POST['job-type'];
    $calle = $_POST['txtCalle'];
    $cor = $_POST['txtCorreo'];
    $tel = $_POST['txtFono'];
    $des = $_POST['txtDes'];
    $rentMin = $_POST['rentamin'];
    $rentMax = $_POST['rentamax'];
    $ia = $_POST['IA'];
    
    if($tipo=="Full Time"){
        $tipo="1";
    }else if($tipo=="Part Time"){
        $tipo="2";
    }else if($tipo=="Esporadico"){
        $tipo="3";
    }
    /* aaas 
    if($ia=="Si"){
        $ia=1;  
    }if($ia=="No"){
        $ia=0;
    }*/

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
        
        //echo mysqli_error($resultado);

    }
    $query2 = "INSERT INTO trabajo (titulo,descripcion,idUsuario,idDireccion,idEstado,idTipo,correo,fono,rentaMin,rentaMax,ia) VALUES ('$titulo', '$des', '$id', '$dir', '1', '$tipo', '$cor', '$tel', '$rentMin', '$rentMax', '$ia')";
    $resultado2 = $mysqli->query($query2);
    if($resultado2){
       $_SESSION['message'] = 'Se realizo la publicacion';
       $_SESSION['message_type'] = 'success';
       //echo $ia;
       
        
    }else{
        $_SESSION['message'] = 'No se pudo realizar la publicacion ';
        $_SESSION['message_type'] = 'danger';
        //echo $ia;
       
    }
    header("Location: ../post-job.php");
}

?> 