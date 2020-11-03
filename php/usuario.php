<?php 
include("db.php");

class usuario{

private $us;
private $con;


public function exUs($us,$con,$conn){
$md5pass = md5($con);

$query = "SELECT * from usuarios where usuario = '$us' and contra = '$con'";
$resultado = mysqli_query($conn, $query);

if(!$resultado){

    return false;

}else
    return true;
}

public function setUs($us,$conn){
    $query = "SELECT * from usuarios where usuario = '$us'";
    $resultado = mysqli_query($conn, $query);
    foreach ($resultado as $currentUser) {
        $this->rut = $currentUser['rut'];
        $this->nombre = $currentUser['nombre'];

    }
}

public function getNom(){
    return $this->nombre;
}

}


?>