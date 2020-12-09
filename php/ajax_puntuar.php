<?php
session_start();
$us = session_id();
require "db.php";
$_SESSION['publicacion'] = $_POST['publicacion'];
$conexion=mysqli_connect('localhost','root','','peguita');
$valor= $_POST['example'];
$id = $_POST['idUsuario'];
$publi = $_POST['publicacion'];
$direc = $_POST['dire'];
$suma = null; 

$query = "SELECT * from valoracion where idPublicador = '$us' and idTrabajo = '$publi'";
$resultado= $mysqli->query($query);
if(mysqli_num_rows($resultado)>0){

    $query = "UPDATE valoracion set valor = '$valor' where idTrabajo = '$publi' and idPublicador = '$us'";
    $resultado2=mysqli_query($conexion,$query);
    echo "Se realizo la actualizacion ";

}
else{
$query = "INSERT INTO valoracion (valor,idUsuario,idTrabajo,idPublicador) values ('$valor','$id','$publi','$us')";
$resultado2=mysqli_query($conexion,$query);
echo "Se ingreso la nueva Valoracion";
}

if($resultado2){
$query = "SELECT valor from valoracion where idUsuario = '$id'";
$result=$mysqli->query($query);
echo ("El id del usuario es: ".$id."<br>");
while ($ver=mysqli_fetch_row($result)){

    $suma = $suma + $ver[0]; 
}
$total = $suma;

echo ("El valor de la Suma es: ".$total."<br>");

$query3="SELECT count(valor) FROM valoracion where idUsuario = '$id'";
$resultado3= $mysqli->query($query3);
$cantidad='';
while($cant = mysqli_fetch_row($resultado3)){ 
    $cantidad = $cant[0];
    echo ("La cantidad de valores son de ".$cant[0]."<br>");     
   }   
#echo ("La cantidad de valores son de ".$cantidad."<br>");
$Res = intdiv($suma , $cantidad);
   echo ("El resultado de la division es: ".$Res."<br>");
$query3="UPDATE usuario set valoracion = '$Res' where idUsuario = '$id'";
$resultado3= $mysqli->query($query3);

$query4="UPDATE postulacion set score = '$Res' where idTrabajo = '$publi' and idUsuario = '$id'";
$resultado3= $mysqli->query($query4);

if($direc == 1){
header("Location: ../busquedaTrabajador.php");
}
if($direc == 2){
   header("Location: ../Perfil.php");
}
echo "Se termino la puntuacion";
}else{
    echo "No se pudo puntuar el usuario";
}



?>