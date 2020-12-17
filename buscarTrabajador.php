<!--Verificacion de sesion -->
<?php
require "php/db.php";
session_start();

if(is_numeric(session_id())){
  $id= session_id();
  $estado= "Mi Perfil";
  $query = "SELECT nombre FROM usuario where idUsuario ='$id'";
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
 <!-- Contador de publicaciones --->
 <?php
          $query="SELECT count(idTrabajo) FROM trabajo where idUsuario = '$id'";
          $resultado= $mysqli->query($query);
          while($cant=mysqli_fetch_row($resultado)){ 
            $canti=$cant ;          
             } ?>  
<!doctype html>
<html lang="en">
  <head>
    <title>PeguitasYa &mdash; Publicar anuncio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/custom-bs.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/line-icons/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/quill.snow.css">
    

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
                <a>Servicios</a>
                <ul class="dropdown">
                  <li><a href="buscarTrabajador.php">Buscar un trabajador</a></li>
                  <li><a href="post-job.php">Publicar un trabajo</a></li>
                  <li><a href="buscarUsuario.php">Buscar un usuario</a></li>
                </ul>
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
              <a href=<?php echo $ref ?> class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span><?php echo $estado?></a>
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
            <h1 class="text-white font-weight-bold">Buscar un trabajador</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Inicio</a> <span class="mx-2 slash">/</span>
              <a href="#">Servicios</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Buscar un trabajador</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--Alerta-->
    <?php
              if(isset($_SESSION['message'])){  
            ?>
            <div class="alert alert-<?= $_SESSION['message_type'];?> alert-dismissible fade show" role="alert">
                   <?= $_SESSION['message']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
            </div>
            <?php
            session_unset();
              }  
            ?> 



    <!---Lista de Mis publicaciones-->
    <section class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
      
            <h2 class="section-title mb-2"> Selecione un Trabajo </h2>
          </div>
        </div>
        
        <ul class="job-listings mb-5">
        <?php
          $query="SELECT idTrabajo,titulo, usuario.nombre, comuna.nombreComuna, region.nombreRegion, tipotrabajo.nombreTipo,trabajo.ia FROM trabajo INNER JOIN usuario ON trabajo.idUsuario = usuario.idUsuario INNER JOIN tipotrabajo ON trabajo.idTipo = tipotrabajo.idTipo INNER JOIN direccion ON trabajo.idDireccion = direccion.idDireccion INNER JOIN comuna ON direccion.idComuna = comuna.idComuna INNER JOIN region ON comuna.idRegion = region.idRegion where trabajo.idUsuario = '$id'";
          $resultado= $mysqli->query($query); 
          while($var=mysqli_fetch_row($resultado)){
            if ($var[5] == 'Full Time') {
              $estilo = 'danger';
            } else if ($var[5] == 'Esporadico') {
              $estilo = 'success';
              } else {
                $estilo = 'info';
              }
          ?>
         <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <?php
            if($mis == true){
              ?>
             
              <?php
            }else{
              ?>
              <a  data-toggle="modal" data-target="#staticBackdrop" ></a>
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
                <span class="badge badge-<?php echo $estilo ?>"><?php echo $var[5] ?></span>
                <?php
              if ($var[6] == '0') {
              ?>
                <span class="badge badge-dark">IA No Disponible</span>
              <?php
              } else if ($var[6] == '1') {
                ?>
                  <span class="badge badge-success">IA Disponible</span>
                <?php
                }
            ?>
              </div>            
              <div class="job-listing-meta">
              <form action="busquedaTrabajador.php" name="ab"  method="POST">
              <input name="idTrabajo" type="hidden" value=<?php echo $var[0] ?>></input>
              <button type="submit" class="btn btn-primary ">Buscar</button>
              </form>
              <?php } ?> 
              </div>   
            </div>            
            </ul>

<!-- Mostrar cantidad de trabajos  -->
        <div class="row pagination-wrap">
          <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
            <?php /* <span>Mostrando 1-<?php echo $canti[0] ?> de <?php echo $canti[0] ?> trabajos</span> 
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
        </div>*/ ?>

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
    <script src="js/quill.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/custom.js"></script>
    <script type="text/javascript">
	$(document).ready(function(){
		$('#region').val(0);
		recargarLista();

		$('#region').change(function(){
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"php/ajax_comunas.php",
			data:"idre=" + $('#region').val(),
			success:function(r){
				$('#comuna').html(r);
			}
		});
	}
</script>
  </body>
</html>