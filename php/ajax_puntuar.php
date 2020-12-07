<?php
session_start();
$us = session_id();
require "db.php";
$_SESSION['publicacion'] = $_POST['publicacion'];
$conexion=mysqli_connect('localhost','root','','peguita');
$valor= $_POST['example'];
$id = $_POST['idUsuario'];
$publi = $_POST['publicacion'];
$suma = 0; 

$query = "SELECT * from valoracion where idPublicador = '$us' and idTrabajo = '$publi'";
$resultado= $mysqli->query($query);
$num = $resultado->num_rows;
if($num>0){

    $query = "UPDATE valoracion set valor = '$valor' where idTrabajo = '$publi' and idUsuario = '$us'";
    $resultado2=mysqli_query($conexion,$query);
    echo "Se realizo la actualizacion";

}else{

$query = "INSERT INTO valoracion (valor,idUsuario,idTrabajo,idPublicador) values ('$valor','$id','$publi','$us')";
$resultado2=mysqli_query($conexion,$query);
echo "Se ingreso la nueva Valoracion";
}

if($resultado2){
$query = "SELECT valor from valoracion where idUsuario = '$id'";
$result=mysqli_query($conexion,$query);
while ($ver=mysqli_fetch_row($result)){

    $suma = $suma + $ver[0]; 
}


$total = $suma;

    $total =1;



$query3="SELECT count(idValoracion) FROM valoracion where idUsuario = '$id'";
$resultado3= $mysqli->query($query3);
while($cant=mysqli_fetch_row($resultado3)){ 

    $canti = $cant[0]; 

   }

$Res = $total / $canti;
   
$query3="UPDATE usuario set valoracion = '$Res' where idUsuario = '$id'";
$resultado3= $mysqli->query($query3);

$query4="UPDATE postulacion set score = '$Res' where idTrabajo = '$publi' and idUsuario = '$id'";
$resultado3= $mysqli->query($query4);
echo "Termino la valoracion";
//header("Location: ../busquedaTrabajador.php");
}else{
    echo "No se pudo puntuar el usuario";
}



?>