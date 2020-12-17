<!-- ############  Verificacion de sesion ############  -->

<?php
session_start();
require "php/db.php";
$us= session_id();
$trabajos_x_pagina = 5;
//$total_articulos_mostrados = 0;
// Redondear hacia arriba
$iniciar = ($_GET['pagina'] - 1) * $trabajos_x_pagina;

if ($_GET['pagina'] < 1) {
  header('location:BuscarUsuario.php?pagina=1');
}


if (!isset($_GET['pBusq'])){
  $pBusq = '';
}else{
  $pBusq = $_GET['pBusq'];
}

if (!isset($_GET['region'])){
  $pRegion = '';
}else{
  $pRegion = $_GET['region'];
}


if (isset($_GET['pBusq']) || isset($_GET['region'])){
  

  $where = "";

  if(!empty($pBusq)){
    $where = "WHERE nombre LIKE '%$pBusq%' OR apellidos LIKE '%$pBusq%' OR trabajo LIKE'%$pBusq%'";
  }else if(empty($pBusq) && !empty($pRegion)){
    $where = "WHERE region.idRegion = '$pRegion'";
  }else if(!empty($pBusq) && !empty($pRegion)){
    $where = "WHERE (nombre LIKE '%$pBusq%' OR apellidos LIKE '%$pBusq%' OR trabajo LIKE'%$pBusq%') AND region.idRegion = '$pRegion'";
  }else if(empty($pRegion) && empty($pBusq)){
    $where = "";
  }

  $queryc = "SELECT count(idUsuario) FROM usuario INNER JOIN direccion ON usuario.direccion = direccion.idDireccion INNER JOIN comuna ON direccion.idComuna = comuna.idComuna INNER JOIN region ON comuna.idRegion = region.idRegion $where ";
  $queryb = "SELECT usuario.idUsuario,usuario.nombre,usuario.trabajo,comuna.nombreComuna,region.nombreRegion from usuario INNER JOIN direccion ON usuario.direccion = direccion.idDireccion INNER JOIN comuna ON direccion.idComuna = comuna.idComuna INNER JOIN region ON comuna.idRegion = region.idRegion $where LIMIT $iniciar,$trabajos_x_pagina";
} else {
  $queryc = "SELECT count(idUsuario) FROM usuario";
  $queryb = "SELECT usuario.idUsuario,usuario.nombre,usuario.trabajo,comuna.nombreComuna,region.nombreRegion from usuario INNER JOIN direccion ON usuario.direccion = direccion.idDireccion INNER JOIN comuna ON direccion.idComuna = comuna.idComuna INNER JOIN region ON comuna.idRegion = region.idRegion LIMIT $iniciar,$trabajos_x_pagina";
}

if(is_numeric(session_id())){
  $us= session_id();
  $estado= "Mi Perfil";
  $query = "SELECT nombre FROM usuario where idUsuario ='$us'";
  $resultado = $mysqli->query($query);
  while ($var = mysqli_fetch_row($resultado)) {
    $nombre = $var[0];
  }
  $ref ='miPerfil.php';
  $mis = true;
  
}else{
  $estado = "Inicio sesion";
  $nombre = ''; 
  $ref ='inicio.php';
  $mis = false;
}

?>

<!doctype html>
<html lang="en">
<!--  ############  Contador de publicaciones  ############ --->
<?php
//$query = "SELECT count(idUsuario) FROM usuario INNER JOIN direccion ON usuario.direccion = direccion.idDireccion INNER JOIN comuna ON direccion.idComuna = comuna.idComuna INNER JOIN region ON comuna.idRegion = region.idRegion $where ";
$resultado = $mysqli->query($queryc);
while ($cant = mysqli_fetch_row($resultado)) {
  $canti = $cant;
} ?>

<head>
  <title>PeguitasYa</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="Free-Template.co" />
  <link rel="shortcut icon" href="ftco-32x32.png">

  <link rel="stylesheet" href="css/custom-bs.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="css/bootstrap-select.min.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="fonts/line-icons/style.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/animate.min.css">

  <!--  ############  MAIN CSS  ############ -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body id="top">

  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>


  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->


    <!-- ############  NAVBAR   ############ -->
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="index.php">PeguitasYa</a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="index.php" class="nav-link active">Inicio</a></li>
              <li><a href="about.php">Sobre Nosotros</a></li>
              <li class="has-children">
                <a>Servicios</a>
                <ul class="dropdown">
                <?php
              if ($mis == true) {
              ?>
               <li><a href="buscarTrabajador.php">Buscar un trabajador</a></li>
                <li><a href="post-job.php">Publicar un trabajo</a></li>
                <li><a href="buscarTrabajador.php">Buscar un usuario</a></li>
              <?php
              } else {
              ?>
                <li><a data-toggle="modal" data-target="#staticBackdrop">Buscar un trabajador</a></li>
                <li><a data-toggle="modal" data-target="#staticBackdrop">Publicar un trabajo</a></li>
              <?php
              }
              ?>
                </ul>
              <li class="d-lg-none"><a href="post-job.php"><span class="mr-2">+</span> Publicar Trabajos</a></li>
              <li class="d-lg-none"><a href="login.html">Log In</a></li>
            </ul>
          </nav>

          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <div class="ml-auto">
              <?php

              if ($mis == true) {
              ?>
                <a href="misPublicaciones.php" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-add"></span>Mis publicaciones</a>
              <?php
              }
              ?>


              <?php

              if ($mis == true) {
              ?>
                <a href="post-job.php" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-add"></span>Publicar Trabajo</a>
              <?php
              } else {
              ?>
                <button type="button" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block" data-toggle="modal" data-target="#staticBackdrop"><span class="mr-2 icon-add"></span>
                  Publicar Trabajo
                </button>

                <!-- ############  Modal  ############ -->
                <div class="modal" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">¿Quieres publicar o ver un trabajo?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" algin="center">
                        Para poder publicar o ver un trabajo se necesita una cuenta "Registrate".
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <a href=<?php echo $ref ?> class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Registrate</a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
              <a href=<?php echo $ref ?> class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span><?php echo $estado ?></a>
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
          </div>

        </div>
      </div>
    </header>

    <!-- ############  HOME  ############ -->
    <section class="home-section section-hero overlay bg-image" style="background-image: url('images/fondo_personas.jpg');" id="home-section">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="mb-5 text-center">
              <h1 class="text-white font-weight-bold">PeguitasYA (Personas)</h1>
              <p>Bienvenido <?php echo $nombre  ?> </p>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" name="ab"  method="GET" class="search-jobs-form">
            <input name="pagina" type="hidden" value="1">
              <div class="row mb-5 align-items-center justify-content-center">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <input for="pBusq" name="pBusq" type="text" class="form-control form-control-lg" placeholder="Nombre, Trabajo...">
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <select class="selectpicker border rounded" name="region" id="region" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Selecione Region">
                <?php
                    $query="SELECT * FROM region";
                    $resultado= $mysqli->query($query);
                    while($var=mysqli_fetch_row($resultado)){
                ?>
                      <option value= <?php echo $var[0]  ?> ><?php echo $var[1]  ?></option>
                    <?php } ?>
                    
              </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <button type="submit" name="buscar" class="btn btn-primary btn-lg btn-block text-white btn-search"><span class="icon-search icon mr-2"></span>Buscar persona</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <a href="#next" class="scroll-button smoothscroll">
        <span class=" icon-keyboard_arrow_down"></span>
      </a>

    </section>



    <!-- ############  Listado de usuarios  ############ -->
    
    <section class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <?php
            $resultado = $mysqli->query($queryc);
            if($resultado != NULL){
              while ($var = mysqli_fetch_row($resultado)) {
              ?>
                <h2 class="section-title mb-2"><?php echo $var[0] ?> Personas Listadas</h2>
              <?php 
              } 
            }else{
              ?>
              <h2 class="section-title mb-2"> No hay personas para listar</h2>
            <?php 
            } 
            ?>
          </div>
        </div>

        <ul class="job-listings mb-5">
          <?php
          $resultado = $mysqli->query($queryb);
            while ($var = mysqli_fetch_row($resultado)) {
              ?>
                 <li type="Button" class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
              <?php
              if ($mis == true) {
                if($us == $var[0]){
                  ?>
                  <a href="miPerfil.php"></a>
                <?php
                }else{
                  ?>
                  <a href="Perfil.php?Dato=<?php echo $var[0] ?>"></a>
                  <?php
                }              
              } else {
              ?>
                <a data-toggle="modal" data-target="#staticBackdrop"></a>
              <?php
              }
              ?>

              <div class="job-listing-logo">
                <img src="images/logo1_PeguitasYa.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid">
              </div>

              <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                  <h2><?php echo $var[1] ?></h2>

                  <strong><?php echo $var[2] ?></strong>
                </div>
                <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                  <span class="icon-room"></span> <?php echo $var[3] ?>, <?php echo $var[4] ?>
                </div>
             
              <?php } ?>
              </div>
        </ul>

        <!-- Mostrar cantidad de usuarios  -->
        <div class="row pagination-wrap">
          <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
            <?php
            $resultado = $mysqli->query($queryc);
            while ($var = mysqli_fetch_row($resultado)) {
              if (sizeof($var) != Null) {
                $total_articulos_mostrados = $var[0];
                $paginas = ceil($total_articulos_mostrados / $trabajos_x_pagina); ?>
                <?php /* <span>Mostrando 1- <?php echo $trabajos_x_pagina ?> de <?php echo $var[0] ?> trabajos</span> */ ?>
              <?php } else { ?>
                <span>No hay trabajos que mostrar</span>
            <?php }
            } ?>
          </div>

          <?php /*<div class="custom-pagination ml-auto">
            <a href="#" class="prev">Atras</a>
            <div class="d-inline-block">
              <a href="#" class="active">1</a>
              <a href="#">2</a>
              <a href="#">3</a>
              <a href="#">4</a>
            </div>
            <a href="#" class="next">Siguente</a>
          </div> */ ?>
        </div>
       
        <nav arial-label="Page navigation example" class="d-inline-block">
          <ul class="pagination">
            <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="BuscarUsuario.php?pagina=<?php echo $_GET['pagina'] - 1 ?>&pBusq=<?php echo urldecode($pBusq)?>&region=<?php echo urldecode($pRegion) ?>">Anterior</a></li>
            <?php for ($i = 0; $i < $paginas; $i++) { ?>
              <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>"><a class="page-link" href="BuscarUsuario.php?pagina=<?php echo $i + 1 ?>&pBusq=<?php echo urldecode($pBusq)?>&region=<?php echo urldecode($pRegion) ?>"><?php echo $i + 1 ?></a></li>
            <?php } ?>

            <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="BuscarUsuario.php?pagina=<?php echo $_GET['pagina'] + 1 ?>&pBusq=<?php echo urldecode($pBusq)?>&region=<?php echo urldecode($pRegion) ?>">Siguiente</a></li>
          </ul>
        </nav>
      </div>

  </div>


  <section class="py-5 bg-image overlay-primary fixed overlay" style="background-image: url('images/hero_1.jpg');">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h2 class="text-white">¿Buscas un trabajo?</h2>
          <p class="mb-0 text-white lead">Registrate en nuestra pagina web .</p>
        </div>
        <div class="col-md-3 ml-auto">
          <a href="inicio.php" class="btn btn-warning btn-block btn-lg">Registrate</a>
        </div>
      </div>
    </div>
    
    </section>


    <footer class="site-footer">

      <a href="#top" class="smoothscroll scroll-top">
        <span class="icon-keyboard_arrow_up"></span>
      </a>


    </footer>

  </div>

  <!-- SCRIPTS -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/stickyfill.min.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>

  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>

  <script src="js/bootstrap-select.min.js"></script>

  <script src="js/custom.js"></script>


</body>

</html>