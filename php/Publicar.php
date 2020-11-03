<?php 
include("db.php");

if(isset($_POST['btn_publicar'])|| isset($_POST['job-location'])||isset($_POST['job-region'])||isset($_POST['job-type'])){
    $btn = $_POST['btn_publicar'];
    $titulo = $_POST['job-title'];
    $email = $_POST['email'];
    $ciudad = $_POST['job-location'];
    $region = $_POST['job-region'];
    $tipo = $_POST['job-type'];
    $query = "INSERT INTO trabajo(email,titulo,locacion,region,tipo,descripcion) VALUES ('$email', '$titulo', '$ciudad', '$region', '$tipo', 'a')";
    $resultado = mysqli_query($conn, $query);
    if(!$resultado){
        echo mysqli_error($conn);
    }else{
        echo " Se ingreso la publicacion";
    }
}

?> 