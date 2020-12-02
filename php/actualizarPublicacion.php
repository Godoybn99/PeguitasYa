<?php
require "db.php";
session_start();

if($_POST){
    $id=session_id();
    $titulo = $_POST['Atitulo'];
    $comuna = $_POST['comuna'];
    $tipo = $_POST['Atipo'];
    $calle = $_POST['Acalle'];
    $cor = $_POST['Acorreo'];
    $tel = $_POST['Atelefono'];
    $des = $_POST['Ades'];
    $rentMin = $_POST['Arentamin'];
    $rentMax = $_POST['Arentamax'];
    $ia = $_POST['IA'];
    $direccion = $_POST['idDire'];
    $publicacion = $_POST['publicacion'];

    if($tipo=="Full Time"){
        $tipo="1";
    }else if($tipo=="Part Time"){
        $tipo="2";
    }else if($tipo=="Esporadico"){
        $tipo="3";
    }



    $query = "UPDATE direccion set nombreCalle ='$calle', idComuna='$comuna' where idDireccion = '$direccion' ";
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
    $query2 = "UPDATE trabajo set titulo ='$titulo', descripcion='$des' ,idTipo='$tipo',correo='$cor',fono='$tel',rentaMin='$rentMin',rentaMax='$rentMax',ia='$ia' where idTrabajo = $publicacion";
    $resultado2 = $mysqli->query($query2);
    if($resultado2){
       $_SESSION['message'] = 'Se actualizaron los datos de la publicacion';
       $_SESSION['message_type'] = 'success';
       //echo $ia;
       header("Location: ../misPublicaciones.php");
        
    }else{
        $_SESSION['message'] = 'No se pudo';
        $_SESSION['message_type'] = 'danger';
        echo mysqli_error($query2);
       
    }
   
}

 
?>