<!--Verificacion de sesion -->
<?php
session_start();
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
  <?php 
  require "php/db.php";
  
  ?>
  <head>
    <title>PeguitasYa &mdash; Registro/Inicio de sesion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
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
                <?php
                  if ($mis == true) {
                  ?>
                <li><a href="buscarTrabajador.php">Buscar un trabajador</a></li>
                <li><a href="post-job.php">Publicar un trabajo</a></li>
                <li><a href="buscarUsuario.php">Buscar un usuario</a></li>
                <?php
                  } else {
                  ?>
                <li><a data-toggle="modal" data-target="#staticBackdrop">Buscar un trabajador</a></li>
                <li><a data-toggle="modal" data-target="#staticBackdrop" >Publicar un trabajo</a></li>
                <li><a data-toggle="modal" data-target="#staticBackdrop">Buscar un usuario</a></li>
                </ul>
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
              <div class="modal" id="condiciones" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false" >
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Termino de condiciones</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" algin="center" >
                      Texto de ejemplo        
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>


              <!-- Modal -->
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
            <h1 class="text-white font-weight-bold">Registro/inicio de sesion</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Inicio</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Inicio de sesion</strong></span>
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
 <!--Registro-->
    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5">
            <h2 class="mb-4">Registro</h2>
        
            <form action="php/Registro.php" class="p-4 border rounded" method="POST">
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Nombre</label>
                  <input type="text" name="txtNom" class="form-control" placeholder="Ingrese su nombre" pattern="[a-zA-Z0-9''' ']{3,30}" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Apellidos</label>
                  <input type="text" name="txtApe" class="form-control" placeholder="Ingrese sus apellidos" pattern="[a-zA-Z0-9''' ']{3,30}" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Correo</label>
                  <input type="email" name="txtEmail" class="form-control" placeholder="Ingrese su correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                </div>
              </div>

              <div class="form-group">
                <label for="job-location">Region</label>
                <select class="selectpicker border rounded" name="region" id="region" data-style="btn-black" data-width="100%" data-live-search="true" title="Selecione Region" required>
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
              <select class="form-control col-sm-12" name="comuna" id="comuna" data-style="btn-black" data-width="100%" data-live-search="true" title="Selecione Comuna" required>
              </select>
              </div>

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Calle</label>
                  <input type="text" name="txtDir" class="form-control" placeholder="Ingrese su direccion" pattern="[a-zA-Z0-9''' ']{3,20}" required>
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Contraseña</label>
                  <input type="password" name="txtPas" class="form-control" placeholder="Ingrese su contraseña" pattern="[a-zA-Z0-9._%+-]{6,16}" required>
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Confirme su contraseña</label>
                  <input type="password" name="txtCpas" class="form-control" placeholder="Confirme su contraseña" pattern="[a-zA-Z0-9._%+-]{6,16}" required>
                </div>
                <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <input class="form-check-input" type="checkbox" value="" required >
                  <label class="mx-2 slash" data-toggle="modal" data-target="#condiciones" > Acepta las condiciones de uso</label>
                </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="btn_registro" value="Registro" class="btn px-4 btn-primary text-white" required>
                </div>
              </div>

            </form>

            <!--Inicio de sesion-->
          </div>

        <div class="col-lg-6">
          <?php
              if(isset($errorLogin)){  
            ?>
            <div class="alert alert-<?= $_SESSION['errorType'];?> alert-dismissible fade show" role="alert">
                   <?= $errorLogin; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
            </div>
            <?php
            //session_unset();
              }  
            ?>

            <h2 class="mb-4">Correo electronico</h2>
             
            <form action="php/Sesion.php" class="p-4 border rounded" method="POST">
            <?php
              if(isset($_SESSION['message2'])){  
            ?>
            <div class="alert alert-<?= $_SESSION['message_type2'];?> alert-dismissible fade show" role="alert">
                   <?= $_SESSION['message2']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
            </div>
            <?php
            //session_unset();
              }  
            ?>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Correo electronico</label>
                  <input type="email" name="txtUs" id="fname" class="form-control" placeholder="ejemplo@correo.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Contraseña</label>
                  <input type="password" name="txtCon" id="fname" class="form-control" placeholder="Contraseña" pattern="[a-zA-Z0-9._%+-]{6,16}" required>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Inicio de sesion" class="btn px-4 btn-primary text-white">
                </div>
              </div>

            </form>
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
    <script src="js/quill.min.js"></script>
    
    
    <script src="js/bootstrap-select.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

  </body>
</html>
