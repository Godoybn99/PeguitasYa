<?php
session_start();
require "db.php";

$trabajo = $_POST['idTrabajo'];
$id=session_id();
$queryV ="SELECT valoracion FROM `usuario` WHERE idUsuario = '$id'";
$var = $mysqli->query($queryV);
if($res=mysqli_fetch_row($var)){
    $valor = $res[0];
}

$queryC ="SELECT idComuna FROM direccion INNER JOIN trabajo ON direccion.idDireccion = trabajo.idDireccion WHERE trabajo.idTrabajo = '$trabajo'";
$direcT = $mysqli->query($queryC);
if($resu=mysqli_fetch_row($direcT)){
    $dirT = $resu[0];
}

if($_POST){       
   
    $ano = $_POST['anos'];
    $com = $_POST['comuna'];
    $cantT = $_POST['cantT'];
    $esp = $_POST['esp'];
    $est = $_POST['study'];

    if($_POST['anos'] == 'Sin experiencia'){
        $ano = 1;
    }else if($_POST['anos'] == '1 año'){
        $ano = 2;
    }else if($_POST['anos'] == '2 años'){
        $ano = 3;
    }else if($_POST['anos'] == '3 o más años'){
        $ano = 4;
    }
    

    if($dirT == $_POST['comuna']){
        $com = 2;
    }elseif($dirT != $_POST['comuna']){
        $com = 1;
    }

    if($cantT == 'Ninguno'){
        $cantT = 1;
    }else if($cantT == '1'){
        $cantT = 2;
    }else if($cantT == '2'){
        $cantT = 3;
    }else if($cantT == '3 o más'){
        $cantT = 4;
    }

    if($_POST['esp'] == 'Full Stack'){
        $esp = 2;
    }else if($_POST['esp'] == 'Front End'){
        $esp = 1;
    }else if($_POST['esp'] == 'Back End'){
        $esp = 3;
    }

    if($_POST['study'] == 'Sin estudios universitarios'){
        $est = 1;
    }else if($_POST['study'] == 'Titulo Tecnico'){
        $est = 2;
    }else if($_POST['study'] == 'Titulo profesional'){
        $est = 3;
    }else if($_POST['study'] == 'Post Grados'){
        $est = 4;
    }

   

    $query ="INSERT INTO postulacion (idTrabajo, idUsuario, years, city, nWorks, specialty, studies, score) VALUES ('$trabajo', '$id', '$ano', '$com', '$cantT', '$esp', '$est', '$valor' )";
    $resultado = $mysqli->query($query);

    if($resultado){
        $_SESSION['message'] = 'Se ingresó postulación';
        $_SESSION['message_type'] = 'success';
        $id=$_SESSION['id'];
    }else{
        $_SESSION['message'] = 'Hubo un error al ingresar postulación';
        $_SESSION['message_type'] = 'danger';
        $id=$_SESSION['id'];
        
    }    
    header("Location: ../misPublicaciones.php");
}
?>