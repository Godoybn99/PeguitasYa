<!--Verificacion de sesion -->
<?php
require "php/db.php";
session_start();

$trabajo = $_GET['publicacion'];
if(!isset($_SESSION['nombre'])){
  $estado = "Inicio sesion";
  $nombre = ''; 
  $ref ='inicio.php';
  $mis = false;
}else{
  $estado= "Cerrar sesion";
  $nombre = $_SESSION['nombre'];
  $id=$_SESSION['id'];
  $ape=$_SESSION['ape'];
  $con=$_SESSION['contra'];
  $car=$_SESSION['Cargo'];
  $dir=$_SESSION['direccion'];
  $correo=$_SESSION['correo'];
  $ref ='php/Cerrar.php';
  $mis = true;

//Busqueda del trabajo 
  $query="SELECT titulo,descripcion,trabajo.correo,fono,trabajo.idEstado,rentaMin,rentaMax, usuario.nombre, comuna.nombreComuna, region.nombreRegion, tipotrabajo.nombreTipo FROM trabajo INNER JOIN usuario ON trabajo.idUsuario = usuario.idUsuario INNER JOIN tipotrabajo ON trabajo.idTipo = tipotrabajo.idTipo INNER JOIN direccion ON trabajo.idDireccion = direccion.idDireccion INNER JOIN comuna ON direccion.idComuna = comuna.idComuna INNER JOIN region ON comuna.idRegion = region.idRegion where idTrabajo = '$trabajo'";
  $resultado= $mysqli->query($query); 
  while($var=mysqli_fetch_row($resultado)){
        $titulo = $var[0];
        $desc = $var[1];
        $mail = $var[2];
        $fono = $var[3];
        $es = $var[4];
        $reMin = $var[5];
        $reMax = $var[6];
        $us = $var[7];
        $comuna = $var[8];
        $region = $var[9];
        $tipo = $var[10];

      if($es == 1){
        $es = "Disponible";
      }
      if($es == 2){
        $es = "No Disponible";
      }

  }
}
?> 
  <!-- Contador de publicaciones --->
  <?php
          $query="SELECT count(idTrabajo) FROM trabajo";
          $resultado= $mysqli->query($query);
          while($cant=mysqli_fetch_row($resultado)){ 
            $canti=$cant ;          
             } ?>
    
<!doctype html>
<html lang="en">
  <head>
    <title>PeguitasYa &mdash; Publicacion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    <link rel="stylesheet" href="css/custom-bs.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/line-icons/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/animate.min.css">

    <!-- MAIN CSS -->
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
    

    <!-- NAVBAR -->
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="index.php">PeguitasYa</a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="index.php" class="nav-link active">Inicio</a></li>
              <li><a href="about.php">Sobre Nosotros</a></li>
              <li class="has-children">
                <a href="job-listings.html">Servicios</a>
                <ul class="dropdown">
                  <li><a href="job-single.php">Buscar un trabajador</a></li>
                  <li><a href="post-job.php">Publicar un trabajo</a></li>
                </ul>
              <li><a href="contact.php">Contacto</a></li>
              <li class="d-lg-none"><a href="post-job.php"><span class="mr-2">+</span> Publicar Trabajos</a></li>
              <li class="d-lg-none"><a href="login.html">Log In</a></li>
            </ul>
          </nav>
          
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <div class="ml-auto">
            <?php 
            
            if($mis == true){
              ?>
            <a href="misPublicaciones.php" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-add"></span>Mis publicaciones</a>
            <?php 
                }
              ?>

             
<?php 
            
            if($mis == true){
              ?>
            <a href="post-job.php" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-add"></span>Publicar Trabajo</a>
            <?php 
                }else{
              ?>
             <button type="button" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block" data-toggle="modal" data-target="#staticBackdrop"><span class="mr-2 icon-add"></span>
               Publicar Trabajo
              </button>

              <!-- Modal -->
              <div class="modal" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false" >
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">¿Quieres publicar un trabajo?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" algin="center" >
                      Para poder publicar un trabajo se necesita una cuenta "Registrate".          
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
              <a href=<?php echo $ref ?> class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span> <?php echo $estado?></a>
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
          </div>

        </div>
      </div>
    </header>
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold"><?php echo $titulo ?></h1>
            <div class="custom-breadcrumbs">
              <a href="#">Inicio</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Publicacion</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!---Descripcion de la publicacion-->
    <section class="site-section">
      <div class="container">
        <div class="row align-items-center mb-5">
          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div class="border p-2 d-inline-block mr-3 rounded">
                <img src="images/job_logo_5.jpg" alt="Image">
              </div>
              <div>
                <h2><?php echo $titulo ?></h2>
                <div>
                  <span class="ml-0 mr-2 mb-2"><span class="icon-briefcase mr-2"></span><?php echo $us ?></span>
                  <span class="m-2"><span class="icon-room mr-2"></span><?php echo $region ?>-<?php echo $comuna ?></span>
                  <span class="m-2"><span class="icon-clock-o mr-2"></span><span class="text-primary"><?php echo $tipo ?></span></span>
                </div>
              </div>
            </div>
          </div>


          <div class="col-lg-4">
            <div class="row">
              <div class="col-6">
                <a href="#" class="btn btn-block btn-primary btn-md">Postular</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8">
            <div class="mb-5">
              <figure class="mb-5"><img src="images/job_single_img_1.jpg" alt="Image" class="img-fluid rounded"></figure>
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Descripcion del trabajo</h3>
              <p><?php echo $desc ?></p>
            </div>

          
          </div>
          <!---Detalles del trabajo-->
          <div class="col-lg-4">
            <div class="bg-light p-3 border rounded mb-4">
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Detalles del trabajo</h3>
              <ul class="list-unstyled pl-3 mb-0">
                <li class="mb-2"><strong class="text-black">Fecha de publicacion:</strong> April 14, 2019</li>
                <li class="mb-2"><strong class="text-black">Estado: </strong><?php echo $es ?> </li>
                <li class="mb-2"><strong class="text-black">Tipo de trabajo: </strong> <?php echo $tipo ?></li>
                <li class="mb-2"><strong class="text-black">Direccion del trabajo:</strong> <?php echo $region ?>-<?php echo $comuna ?></li>
                <li class="mb-2"><strong class="text-black">Renta: </strong> $<?php echo $reMin ?> - $<?php echo $reMax ?></li>
                <li class="mb-2"><strong class="text-black">Correo de contacto: </strong><?php echo $correo ?></li>
                <li class="mb-2"><strong class="text-black">Fono de contacto: </strong> <?php echo $fono ?></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
          <form action="job-single.php" method="POST">
          <?php
          $query="SELECT count(idTrabajo) FROM trabajo";
          $resultado= $mysqli->query($query);
          while($var=mysqli_fetch_row($resultado)){            
          ?>
            <h2 class="section-title mb-2"><?php echo $var[0] ?> Trabajos Listados</h2>
          <?php } ?>  
          </div>
        </div>
          
        <ul  class="job-listings mb-5">
        <?php
          $query="SELECT idTrabajo, titulo, usuario.nombre, comuna.nombreComuna, region.nombreRegion, tipotrabajo.nombreTipo FROM trabajo INNER JOIN usuario ON trabajo.idUsuario = usuario.idUsuario INNER JOIN tipotrabajo ON trabajo.idTipo = tipotrabajo.idTipo INNER JOIN direccion ON trabajo.idDireccion = direccion.idDireccion INNER JOIN comuna ON direccion.idComuna = comuna.idComuna INNER JOIN region ON comuna.idRegion = region.idRegion";
          $resultado= $mysqli->query($query); 
          while($var=mysqli_fetch_row($resultado)){
          ?>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
       
            <?php
            if($mis == true){
              ?>
              <input type="hidden" name="idTrabajo" value=<?php echo $var[0] ?>>
              <a href="job-single.php?datos=<?php echo $var[0] ?>"> </a>
              </form>
              <?php
            }else{
              ?>
              <a  data-toggle="modal" data-target="#staticBackdrop" ></a>
              <?php
            }
            ?>
            
            <div class="job-listing-logo">
              <img src="images/job_logo_1.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?php echo $var[1] ?></h2>
                                
                <strong><?php echo $var[2] ?></strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> <?php echo $var[3] ?>, <?php echo $var[4] ?>
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-danger"><?php echo $var[5] ?></span>
              </div>
              <?php } ?>     
            </div>
                      
        </ul>
<!-- Mostrar cantidad de trabajos  -->
        <div class="row pagination-wrap">
          <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span>Mostrando 1-<?php echo $canti[0] ?> de <?php echo $canti[0] ?> trabajos</span>
          </div>
          <div class="col-md-6 text-center text-md-right">
            <div class="custom-pagination ml-auto">
              <a href="#" class="prev">Atras</a>
              <div class="d-inline-block">
              <a href="#" class="active">1</a>
              <a href="#">2</a>
              <a href="#">3</a>
              <a href="#">4</a>
              </div>
              <a href="#" class="next">Siguente</a>
            </div>
          </div>
        </div>

      </div>
    </section>

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

    </section>
    
    <footer class="site-footer">

      <a href="#top" class="smoothscroll scroll-top">
        <span class="icon-keyboard_arrow_up"></span>
      </a>

      <div class="container">
        <div class="row mb-5">
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Search Trending</h3>
            <ul class="list-unstyled">
              <li><a href="#">Web Design</a></li>
              <li><a href="#">Graphic Design</a></li>
              <li><a href="#">Web Developers</a></li>
              <li><a href="#">Python</a></li>
              <li><a href="#">HTML5</a></li>
              <li><a href="#">CSS3</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Company</h3>
            <ul class="list-unstyled">
              <li><a href="#">About Us</a></li>
              <li><a href="#">Career</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Resources</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Support</h3>
            <ul class="list-unstyled">
              <li><a href="#">Support</a></li>
              <li><a href="#">Privacy</a></li>
              <li><a href="#">Terms of Service</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Contact Us</h3>
            <div class="footer-social">
              <a href="#"><span class="icon-facebook"></span></a>
              <a href="#"><span class="icon-twitter"></span></a>
              <a href="#"><span class="icon-instagram"></span></a>
              <a href="#"><span class="icon-linkedin"></span></a>
            </div>
          </div>
        </div>

        <div class="row text-center">
          <div class="col-12">
            <p class="copyright"><small>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></small></p>
          </div>
        </div>
      </div>
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