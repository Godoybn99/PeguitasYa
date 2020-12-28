<?php
session_start();
require "db.php";
date_default_timezone_set("America/Santiago");

$trabajo = $_POST['idTrabajo'];
$_SESSION['publicacion'] = $trabajo;
$id = session_id();
$queryV = "SELECT valoracion FROM `usuario` WHERE idUsuario = '$id'";
$var = $mysqli->query($queryV);
if ($res = mysqli_fetch_row($var)) {
    $valor = $res[0];
}

$queryC = "SELECT idComuna FROM direccion INNER JOIN trabajo ON direccion.idDireccion = trabajo.idDireccion WHERE trabajo.idTrabajo = '$trabajo'";
$direcT = $mysqli->query($queryC);
if ($resu = mysqli_fetch_row($direcT)) {
    $dirT = $resu[0];
}

if ($_POST) {

    $ano = $_POST['anos'];
    $com = $_POST['comuna'];
    $cantT = $_POST['cantT'];

    if ($_POST['esp'] == 'Back End') {
        $esp = 3;
    }else if($_POST['esp'] == 'Full Stack'){
        $esp = 2;
    }else if($_POST['esp'] == 'Front End'){
        $esp = 1;
    }

    $est = $_POST['study'];

    if ($_POST['anos'] == 'Sin experiencia') {
        $ano = 1;
    } else if ($_POST['anos'] == '1 a 2 años') {
        $ano = 2;
    } else if ($_POST['anos'] == '3 o más años') {
        $ano = 3;
    }


    if ($dirT == $_POST['comuna']) {
        $com = 2;
    } elseif ($dirT != $_POST['comuna']) {
        $com = 1;
    }

    if ($cantT == 'Ninguno') {
        $cantT = 1;
    } else if ($cantT == '1') {
        $cantT = 2;
    } else if ($cantT == '2') {
        $cantT = 3;
    } else if ($cantT == '3 o más') {
        $cantT = 4;
    }

    if ($_POST['study'] == 'Sin estudios universitarios') {
        $est = 1;
    } else if ($_POST['study'] == 'Titulo Tecnico') {
        $est = 2;
    } else if ($_POST['study'] == 'Titulo profesional') {
        $est = 3;
    }else if ($_POST['study'] == 'Estudios Post Grados') {
        $est = 4;
    }

    if ($_FILES["curriculum"]) {
        $nombre_base = basename($_FILES["curriculum"]["name"]);
        $nombre_final = date("m-d-y") . "-" . date("h-i-s") . "-" . $nombre_base;
        $ruta = "../curriculums/" . $nombre_final;
        $subirarchivo = move_uploaded_file($_FILES["curriculum"]["tmp_name"], $ruta);


        if ($esp) {
            $queryValidar = "SELECT idPostulacion FROM postulacion WHERE idUsuario = '$id' AND idTrabajo = '$trabajo'";
            $repetido = $mysqli->query($queryValidar);
            if ($valorRepetido = mysqli_fetch_row($repetido)) {
                $idPostulacion = $valorRepetido[0];
                if ($subirarchivo) {
                    $queryUpdate = "UPDATE postulacion set idTrabajo ='$trabajo', idUsuario='$id', years='$ano', city='$com', nWorks='$cantT', specialty='$esp', studies='$est', score='$valor', curriculum='$ruta' where idPostulacion = $idPostulacion";
                    $resultadoU = $mysqli->query($queryUpdate);
                } else {
                    $queryUpdate = "UPDATE postulacion set idTrabajo ='$trabajo', idUsuario='$id', years='$ano', city='$com', nWorks='$cantT', specialty='$esp', studies='$est', score='$valor', curriculum=Null where idPostulacion = $idPostulacion";
                    $resultadoU = $mysqli->query($queryUpdate);
                }
                //$queryUpdate = "UPDATE postulacion set idTrabajo ='$trabajo', idUsuario='$id', years='$ano', city='$com', nWorks='$cantT', studies='$est', score='$valor', curriculum='$ruta' where idPostulacion = $idPostulacion";
            } else {
                if ($subirarchivo) {
                    $query = "INSERT INTO postulacion (idTrabajo, idUsuario, years, city, nWorks, specialty, studies, score, curriculum) VALUES ('$trabajo', '$id', '$ano', '$com', '$cantT','$esp', '$est', '$valor', '$ruta' )";
                    $resultadoI = $mysqli->query($query);
                } else {
                    $query = "INSERT INTO postulacion (idTrabajo, idUsuario, years, city, nWorks, specialty, studies, score) VALUES ('$trabajo', '$id', '$ano', '$com', '$cantT', '$esp' '$est', '$valor')";
                    $resultadoI = $mysqli->query($query);
                }
            }
        } else {
            $queryValidar = "SELECT idPostulacion FROM postulacion WHERE idUsuario = '$id' AND idTrabajo = '$trabajo'";
            $repetido = $mysqli->query($queryValidar);
            if ($valorRepetido = mysqli_fetch_row($repetido)) {
                $idPostulacion = $valorRepetido[0];
                if ($subirarchivo) {
                    $queryUpdate = "UPDATE postulacion set idTrabajo ='$trabajo', idUsuario='$id', years='$ano', city='$com', nWorks='$cantT', studies='$est', score='$valor', curriculum='$ruta' where idPostulacion = $idPostulacion";
                    $resultadoU = $mysqli->query($queryUpdate);
                } else {
                    $queryUpdate = "UPDATE postulacion set idTrabajo ='$trabajo', idUsuario='$id', years='$ano', city='$com', nWorks='$cantT', studies='$est', score='$valor', curriculum=Null where idPostulacion = $idPostulacion";
                    $resultadoU = $mysqli->query($queryUpdate);
                }
                //$queryUpdate = "UPDATE postulacion set idTrabajo ='$trabajo', idUsuario='$id', years='$ano', city='$com', nWorks='$cantT', studies='$est', score='$valor', curriculum='$ruta' where idPostulacion = $idPostulacion";
            } else {
                if ($subirarchivo) {
                    $query = "INSERT INTO postulacion (idTrabajo, idUsuario, years, city, nWorks, studies, score, curriculum) VALUES ('$trabajo', '$id', '$ano', '$com', '$cantT', '$est', '$valor', '$ruta' )";
                    $resultadoI = $mysqli->query($query);
                } else {
                    $query = "INSERT INTO postulacion (idTrabajo, idUsuario, years, city, nWorks, studies, score) VALUES ('$trabajo', '$id', '$ano', '$com', '$cantT', '$est', '$valor')";
                    $resultadoI = $mysqli->query($query);
                }
            }
        }
    }


    #$query ="INSERT INTO postulacion (idTrabajo, idUsuario, years, city, nWorks, specialty, studies, score) VALUES ('$trabajo', '$id', '$ano', '$com', '$cantT', '$esp', '$est', '$valor' )";
    #$resultado = $mysqli->query($query);

    if ($resultadoI) {
        $_SESSION['message'] = 'Se ingresó postulación';
        $_SESSION['message_type'] = 'success';
        $id = $_SESSION['id'];
    } else if ($resultadoU) {
        $_SESSION['message'] = 'Se ACTUALIZÓ su postulación';
        $_SESSION['message_type'] = 'success';
        $id = $_SESSION['id'];
    } else {
        $_SESSION['message'] = "Hubo un error para ingresar tu publicacion";
        $_SESSION['message_type'] = 'danger';
        $id = $_SESSION['id'];
    }
    header("Location: ../job-single.php");
}
