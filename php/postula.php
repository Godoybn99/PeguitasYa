<?php
session_start();
require "db.php";
//require '../php/class/postulante.php';

$trabajo = $_POST['idTrabajo'];
$id=session_id();
$queryV ="SELECT valoracion FROM `usuario` WHERE idUsuario = '$id'";
//$valoracion = $mysqli->query($queryV);
$var = mysqli_fetch_row($queryV);

$queryC ="SELECT idDireccion FROM `trabajo` WHERE idTrabajo = '$trabajo'";
$direcT = mysqli_fetch_row($queryC);

if($_POST){       
   
    $ano = $_POST['anos'];
    $com = $_POST['comuna'];
    $cantT = $_POST['cantT'];
    $esp = $_POST['esp'];
    $est = $_POST['study'];
    echo $id, $ano, $com, $cantT, $esp, $est;

    if($ano == 'Sin Experiencia'){
        $ano = 1;
    }else if($ano == '1 año'){
        $ano = 2;
    }else if($ano == '2 años'){
        $ano = 3;
    }else{
        $ano = 4;
    }

    if($direcT[0] == $com){
        $direcT = 2;
    }else{
        $direcT = 1;
    }

    if($cantT == 'Ninguno'){
        $cantT = 1;
    }else if($cantT == '1'){
        $cantT = 2;
    }else if($cantT == '2'){
        $cantT = 3;
    }else{
        $cantT = 4;
    }

    if($esp == 'Full Stack'){
        $esp = 2;
    }else if($esp == 'Front End'){
        $esp = 1;
    }else if($esp == 'Back End'){
        $esp = 3;
    }

    if($est == 'Sin estudios'){
        $est = 1;
    }else if($est == 'Titulo Tecnico'){
        $est = 2;
    }else if($est == 'Titulo Profesional'){
        $est = 3;
    }else if($est == 'Post Grados'){
        $est = 4;
    }

    //$postulante = new Postulante($trabajo, $id, $ano, $com, $cantT, $esp, $est, $var[0] );
    //$insert = $postulante->insertarPostulante($trabajo, $id, $ano, $com, $cantT, $esp, $est, $var[0]);



    $query ="INSERT INTO postulacion (idTrabajo, idUsuario, years, city, nWorks, specialty, studies, score) VALUES ('$trabajo', '$id', '$ano', '$com', '$cantT', '$esp', '$est', '$var[0]' )";
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