<?php
session_start();
$us = session_id();
require "db.php";
$_SESSION['publicacion'] = $_POST['publicacion'];
$conexion = mysqli_connect('localhost', 'root', '', 'peguita');
$valor = $_POST['example'];
$idUsu = $_POST['idUsuario'];
$publi = $_POST['publicacion'];
$idPublic = $_POST['idPublicante'];
$direc = $_POST['dire'];
$suma = 0;
$conteo = 0;
$promedio = 0;

$queryPuntuarRepetido = "SELECT idValoracion from valoracion where idPublicador = '$idPublic' and idTrabajo = '$publi'";
$resultadoRepetido = $mysqli->query($queryPuntuarRepetido);
if (mysqli_num_rows($resultadoRepetido) > 0) {
    $queryUpdateP = "UPDATE valoracion set valor = '$valor' where idTrabajo = '$publi' and idPublicador = '$idPublic'";
    $resultado = mysqli_query($conexion, $queryUpdateP);
    $_SESSION['message'] = 'Se realizo la actualizacion de tu valoracion.';
    $_SESSION['message_type'] = 'success';
} else {
    $queryPuntuar = "INSERT INTO valoracion (valor,idUsuario,idTrabajo,idPublicador) values ('$valor','$idUsu','$publi','$idPublic')";
    $resultador = mysqli_query($conexion, $queryPuntuar);
    $_SESSION['message'] = 'Se valoro la publicacion';
    $_SESSION['message_type'] = 'success';
}

if ($resultado) {
    $queryContador = "SELECT count(valor) FROM valoracion where idUsuario = '$idUsu'";
    $resultadoConteo = $mysqli->query($queryContador);
    while ($contador = mysqli_fetch_row($resultadoConteo)) {
        $conteo = $contador[0];
    }

    $queryValoraciones = "SELECT valor from valoracion where idPublicador = '$idPublic'";
    $resultadoValoraciones = $mysqli->query($queryValoraciones);
    while ($valoraciones = mysqli_fetch_row($resultadoValoraciones)) {
        $suma = $suma + $valoraciones[0];
    }

    $promedio = intdiv($suma, $conteo);
    //echo ('Este es la suma '.$suma.' este es la cantidad '.$conteo.' este deberia ser el promedio: '.$promedio);
    $queryUpdateProm = "UPDATE usuario set valoracion = '$promedio' where idUsuario = '$idPublic'";
    $ResultadoUpdateProm = $mysqli->query($queryUpdateProm);

    $query4 = "UPDATE postulacion set score = '$promedio' where idTrabajo = '$publi' and idUsuario = '$idPublic'";
    $resultado3 = $mysqli->query($query4);
    
}else{
    $_SESSION['message'] = 'No se pudo valorar la publicacion';
    $_SESSION['message_type'] = 'danger';
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
$query = "SELECT * from valoracion where idPublicador = '$us' and idTrabajo = '$publi'";
$resultado = $mysqli->query($query);
if (mysqli_num_rows($resultado) > 0) {

    $query = "UPDATE valoracion set valor = '$valor' where idTrabajo = '$publi' and idPublicador = '$us'";
    $resultado2 = mysqli_query($conexion, $query);
    echo "Se realizo la actualizacion ";
} else {
    $query = "INSERT INTO valoracion (valor,idUsuario,idTrabajo,idPublicador) values ('$valor','$id','$publi','$us')";
    $resultado2 = mysqli_query($conexion, $query);
    echo "Se ingreso la nueva Valoracion";
}

if ($resultado2) {
    $query = "SELECT valor from valoracion where idUsuario = '$id'";
    $result = $mysqli->query($query);
    echo ("El id del usuario es: " . $id . "<br>");
    while ($ver = mysqli_fetch_row($result)) {

        $suma = $suma + $ver[0];
    }
    $total = $suma;

    echo ("El valor de la Suma es: " . $total . "<br>");

    $query3 = "SELECT count(valor) FROM valoracion where idUsuario = '$id'";
    $resultado3 = $mysqli->query($query3);
    $cantidad = '';
    while ($cant = mysqli_fetch_row($resultado3)) {
        $cantidad = $cant[0];
        echo ("La cantidad de valores son de " . $cant[0] . "<br>");
    }
    #echo ("La cantidad de valores son de ".$cantidad."<br>");
    $Res = intdiv($suma, $cantidad);
    echo ("El resultado de la division es: " . $Res . "<br>");
    $query3 = "UPDATE usuario set valoracion = '$Res' where idUsuario = '$id'";
    $resultado3 = $mysqli->query($query3);

    $query4 = "UPDATE postulacion set score = '$Res' where idTrabajo = '$publi' and idUsuario = '$id'";
    $resultado3 = $mysqli->query($query4);
*/
if ($direc == 1) {
    header("Location: ../job-single.php?publicacion=" . $publi);
}
if ($direc == 2) {
    header("Location: ../Perfil.php");
}
    //echo "Se termino la puntuacion";
/*} else {
    echo "No se pudo puntuar el usuario";
} */
