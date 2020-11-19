<form action="index.php" method="post">
    <?php
    require "db.php";
    session_start();

    if ($_POST) {
        $id = $_SESSION['id'];
        $pb = $_POST['pBusq'];
        //$reg = $_POST['region'];
        //$tipo = $_POST['tipoT'];

        $queryb = "SELECT idTrabajo, titulo, trabajo.descripcion, usuario.nombre, comuna.nombreComuna, region.nombreRegion, tipotrabajo.nombreTipo FROM trabajo INNER JOIN usuario ON trabajo.idUsuario = usuario.idUsuario INNER JOIN tipotrabajo ON trabajo.idTipo = tipotrabajo.idTipo INNER JOIN direccion ON trabajo.idDireccion = direccion.idDireccion INNER JOIN comuna ON direccion.idComuna = comuna.idComuna INNER JOIN region ON comuna.idRegion = region.idRegion WHERE titulo LIKE '%$pb%' OR descripcion LIKE '%$pb%'";
        $resultado = $mysqli->query($queryb);

        if ($resultado) {
            $_SESSION['message'] = 'Se encontraron resultados';
            $_SESSION['message_type'] = 'success';
            /*$_SESSION['ape']=$ape;
            $_SESSION['Cargo']=$car;
            $_SESSION['direccion']=$dir;
            $_SESSION['correo']=$email;
            $_SESSION['nombre']=$nom;   */
            $id = $_SESSION['id'];
        } else {
            $_SESSION['message'] = 'No se encontraron resultados';
            $_SESSION['message_type'] = 'danger';
            $id = $_SESSION['id'];
        }
    }
    header("Location: ../index.php");
    ?>
</form>