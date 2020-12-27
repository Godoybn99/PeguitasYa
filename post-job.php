<!--Verificacion de sesion -->
<?php
session_start();
require "php/db.php";

date_default_timezone_set("America/Santiago");
$fecha = date("Y-m-d");

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
              <li class="d-lg-none"><a href="post-job.php"><span class="mr-2">+</span><span class="text-white"> <strong> Publicar Trabajos</strong></a></li>
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
            <h1 class="text-white font-weight-bold">Publicar trabajo</h1>
            <div class="custom-breadcrumbs">
              <a href="index.php">Inicio</a> <span class="mx-2 slash">/</span>
              <a href="#">trabajo</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Publicar trabajo</strong></span>
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
            unset($_SESSION['message']);
              }  
            ?> 


    <!---Formulario-->

    
    <section class="site-section">
      <div class="container">

        <div class="row align-items-center mb-5">
          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div>
                <h2>Publicar trabajo</h2>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
            </div>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-lg-12">
            <form class="p-4 p-md-5 border rounded" method="post" action="php/Publicar.php" method="POST">
              <h3 class="text-black mb-5 border-bottom pb-2">Detalles del trabajo</h3>
              <div class="form-group">
                <label for="job-title">Titulo del trabajo</label>
                <input type="text" class="form-control" name="job-title" placeholder="Se necesita Ingeniero..." pattern="[a-zA-Z0-9''' ']{3,50}" required>
              </div>

              <div class="form-group">
                <label for="job-location">Region</label>
                <select class="selectpicker border rounded" name="region" id="region" data-style="btn-black" data-width="100%" data-live-search="true" title="Selecione Region">
                <?php
                    $query="SELECT * FROM region";
                    $resultado= $mysqli->query($query);
                    while($var=mysqli_fetch_row($resultado)){
                ?>
                      <option value= <?php echo $var[0]  ?> ><?php echo $var[1]  ?></option>
                    <?php } ?>
                    
              </select>
              </div>

              <div class="form-group">
              <label for="job-location">Comunas</label>
              <select class="form-control col-sm-12" name="comuna" id="comuna" data-style="btn-black" data-width="100%" data-live-search="true" title="Selecione Comuna" >
              </select>
              </div>

              <div class="form-group">
                <label for="job-title">Calle</label>
                <input type="text" class="form-control" name="txtCalle" placeholder="ej. CalleEjemplo 123" pattern="[a-zA-Z0-9''' ']{3,50}" required>
              </div>

              <div class="form-group">
                <label for="txtCorreo">Correo de contacto</label>
                <input type="email" class="form-control" name="txtCorreo" placeholder="ej. correo@ejemplo.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
              </div>

              <div class="form-group">
                <label for="txtFono">Telefono de contacto</label>
                <input type="text" class="form-control" name="txtFono" placeholder="ej. +56987654321" pattern="[0-9+]{9,12}" required>
              </div>

              <div class="form-group">
                <label for="job-type">Tipo de trabajo</label>
                <select class="selectpicker border rounded" name="job-type" data-style="btn-black" data-width="100%" data-live-search="true" title="Selecione tipo de trabajo" >
                  <option>Part Time</option>
                  <option>Full Time</option>
                  <option>Esporadico</option>
                </select>
              </div>

              <div class="form-group">
              <div class="row mb-7">
              <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
              <label for="rentamin">Renta minima</label>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
              <label for="rentamax">Renta maxima</label>
              </div>
              </div>
              <div class="row mb-7">
              <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <input type="number" class="form-control col-sm-10" name="rentamin" placeholder="ej. 200000" min='1' required>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <input type="number" class="form-control col-sm-10" name="rentamax" placeholder="ej. 500000" min='1' required>
                </div>
              </div>
              </div>          
              <div class="form-group">
                <label for="email">Descripcion</label>
              </div>
                <textarea name="txtDes" rows="8" cols="100" placeholder="Descripcion de la publicacion" maxlength="200" required></textarea>
                <div class="form-group">
              </div>

              <input  name = "fechaP" type="hidden" value="<?php echo $fecha ?>"></input>

              <div class="form-group">
                <label>¿Necesita de la IA de PeguitasYa?</label><br>
                <select class="selectpicker border rounded" name="IA" data-style="btn-black" data-width="20%" data-live-search="true">
                  <option value="0">No</option>
                  <option value="1">Si</option>
                </select>
              </div>

        <div class="row align-items-center mb-5">          
          <div class="col-lg-4 ml-auto">
            <div class="row">              
              <div class="col-6">
                <input type="submit" class="btn btn-block btn-primary btn-md" name="btn_publicar" value="Publicar trabajo ">
              </div>
            </div>
          </div>
        </div>
      </div>
                    </form>
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
			success:function(response){
				$('#comuna').html(response);
			}
		});
	}
</script>
  </body>
</html>