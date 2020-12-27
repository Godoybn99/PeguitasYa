<!--Verificacion de sesion -->
<?php
require "php/db.php";
session_start();
$publicacion = $_POST['publicacion'];
if (is_numeric(session_id())) {
  $us = session_id();
  $estado = "Mi Perfil";
  $query = "SELECT nombre FROM usuario where idUsuario ='$us'";
  $resultado = $mysqli->query($query);
  while ($var = mysqli_fetch_row($resultado)) {
    $nombre = $var[0];
  }
  $ref = 'miPerfil.php';
  $mis = true;

  $query = "SELECT titulo,descripcion,trabajo.correo,trabajo.fono,trabajo.idEstado,rentaMin,rentaMax, usuario.nombre, comuna.nombreComuna, region.nombreRegion, tipotrabajo.nombreTipo, direccion.nombreCalle,ia,trabajo.idDireccion FROM trabajo INNER JOIN usuario ON trabajo.idUsuario = usuario.idUsuario INNER JOIN tipotrabajo ON trabajo.idTipo = tipotrabajo.idTipo INNER JOIN direccion ON trabajo.idDireccion = direccion.idDireccion INNER JOIN comuna ON direccion.idComuna = comuna.idComuna INNER JOIN region ON comuna.idRegion = region.idRegion where idTrabajo = '$publicacion'";
  $resultado = $mysqli->query($query);
  while ($var = mysqli_fetch_row($resultado)) {
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
    $calle = $var[11];
    $ia = $var[12];
    $idDire = $var[13];

    if ($ia == 2) {
      $ai = "Informatico";
    }
    if ($ia == 1) {
      $ai = "General";
    }
    if ($ia == 0) {
      $ai = "No";
    }
    if ($es == 1) {
      $es = "Disponible";
    }
    if ($es == 2) {
      $es = "No Disponible";
    }
  }
} else {
  $estado = "Inicio sesion";
  $nombre = '';
  $ref = 'inicio.php';
  $mis = false;
}


?>

<!doctype html>
<html lang="en">
<?php


?>

<head>
  <title>PeguitasYa &mdash; Mi Perfil</title>
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
                    <li><a href="buscarUsuario.php">Buscar un usuario</a></li>
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
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Actualizar Publicacion</h1>
            <div class="custom-breadcrumbs">
              <a href="index.php">Inicio</a> <span class="mx-2 slash">/</span>
              <span class="mx-2 slash">Mis Publicaciones</span><span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Actualizar Publicacion</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--Alerta-->
    <?php
    if (isset($_SESSION['message'])) {
    ?>
      <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php
      session_unset();
    }
    ?>
    <!--Datos de la postulacion actual-->
    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5">
            <h2 class="mb-4">Datos de la publicacion actual </h2>

            <form action="" class="p-4 border rounded" method="POST">
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Tiulo del trabajo</label>
                  <input type="text" readonly name="txtNom" class="form-control" value="<?php echo $titulo ?>">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Region</label>
                  <input type="text" readonly name="txtApe" class="form-control" value="<?php echo $region ?>">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Comuna</label>
                  <input type="text" readonly name="txtEmail" class="form-control" value="<?php echo $comuna ?>">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Calle</label>
                  <input type="text" readonly name="txtEmail" class="form-control" value="<?php echo $calle ?>">
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Correo de contacto</label>
                  <input type="text" readonly name="txtCar" class="form-control" placeholder="<?php echo $mail ?>">
                </div>
              </div>

              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Telefono de contacto</label>
                  <input type="text" readonly name="txtDir" class="form-control" placeholder=<?php echo $fono ?>>
                </div>
              </div>

              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Tipo de trabajo</label>
                  <input type="Text" readonly name="txtCpas" class="form-control" placeholder='<?php echo $tipo ?>' required>
                </div>
              </div>

              <div class="row form-group mb-4">
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
                    <input type="text" readonly class="form-control col-sm-20" name="rentamin" placeholder=<?php echo $reMin ?>>
                  </div>

                  <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <input type="text" readonly class="form-control col-sm-20" name="rentamax" placeholder=<?php echo $reMax ?>>
                  </div>
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Servicio de intelgencia Artificial</label>
                  <input type="text" readonly name="txtDir" class="form-control" placeholder=<?php echo $ai ?>>
                </div>
              </div>

              <div class="row form-group mb-4">
                <label for="email">Descripcion</label>
                <textarea name="txtDes" readonly rows="8" cols="100" placeholder="<?php echo $desc ?>"></textarea>
              </div>
            </form>
          </div>

          <!----Actualizar Publicacion---->
          <div class="col-lg-6 mb-5">
            <h2 class="mb-4">Datos nuevos de la publicacion </h2>

            <form action="php/actualizarPublicacion.php" class="p-4 border rounded" method="POST">
              <input type="hidden" name="idDire" value="<?php echo $idDire ?>">
              <input type="hidden" name="publicacion" value="<?php echo $publicacion ?>">
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Tiulo del trabajo</label>
                  <input type="text" name="Atitulo" class="form-control" value="<?php echo $titulo ?>" pattern="[a-zA-Z0-9''' ']{3,50}" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label for="job-location">Region</label>
                  <select class="selectpicker border rounded" name="region" id="region" data-style="btn-black" data-width="100%" data-live-search="true" title="Selecione Region" required>
                    <?php
                    $query = "SELECT * FROM region";
                    $resultado = $mysqli->query($query);
                    while ($var = mysqli_fetch_row($resultado)) {
                      if ($region == ($var[1])) {
                    ?><option selected value=<?php echo $var[0]  ?>><?php echo $var[1]  ?></option>
                      <?php
                      } else {
                      ?>
                        <option value=<?php echo $var[0]  ?>><?php echo $var[1]  ?></option>
                      <?php
                      }
                      ?>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label for="job-location">Comunas</label>
                  <select class="form-control col-sm-12" name="comuna" id="comuna" data-style="btn-black" data-width="100%" data-live-search="true" title="Selecione Comuna" required>
                  </select>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Calle</label>
                  <input type="text" name="Acalle" class="form-control" value="<?php echo $calle ?>" pattern="[a-zA-Z0-9' ']{3,30}" required>
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Correo de contacto</label>
                  <?php if ($mail == '') {
                  ?><input type="email" name="Acorreo" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                  <?php
                  } else { ?>
                    <input type="email" name="Acorreo" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required value=<?php echo $mail ?>>
                  <?php
                  } ?>
                </div>
              </div>

              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Telefono de contacto</label>
                  <input type="text" name="Atelefono" class="form-control" value=<?php echo $fono ?> pattern="[0-9+]{9,12}" required>
                </div>
              </div>

              <div class="form-group">
                <label for="job-type">Tipo de trabajo</label>
                <select class="selectpicker border rounded" name="Atipo" data-style="btn-black" data-width="100%" data-live-search="true" title="Selecione tipo de trabajo" required>
                  <?php
                  if ($tipo == 'Full Time') {
                  ?>
                    <option selected>Full Time</option>
                    <option>Part Time</option>
                    <option>Esporadico</option>
                  <?php
                  } else
                if ($tipo == 'Part Time') {
                  ?>
                    <option selected>Part Time</option>
                    <option>Full Time</option>
                    <option>Esporadico</option>
                  <?php
                  } else { ?>
                    <option selected>Esporadico</option>
                    <option>Part Time</option>
                    <option>Full Time</option>
                  <?php
                  }
                  ?>
                </select>
              </div>

              <div class="row form-group mb-4">
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
                    <input type="text" class="form-control col-sm-10" name="Arentamin" value=<?php echo $reMin ?> min='1' required>
                  </div>

                  <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <input type="text" class="form-control col-sm-10" name="Arentamax" value=<?php echo $reMax ?> min='1' required>
                  </div>
                </div>
              </div>



              <div class="form-group">
                <label>¿Necesita de la IA de PeguitasYa?</label><br>
                <select class="selectpicker border rounded" name="IA" data-style="btn-black" data-width="30%" data-live-search="true">
                  <?php if ($ia == '2') {
                  ?>
                    <option value="2" selected>Informatico</option>
                    <option value="1">General</option>
                    <option value="0">No</option>
                  <?php
                  } ?>
                  <?php if ($ia == '1') {
                  ?>
                    <option value="2">Informatico</option>
                    <option value="1" selected>General</option>
                    <option value="0">No</option>
                  <?php
                  } if ($ia == '0') {
                  ?>
                    <option value="2">Informatico</option>
                    <option value="1">General</option>
                    <option value="0" selected>No</option>
                  <?php
                  } ?>
                </select>
              </div>

              <div class="row form-group mb-4">
                <label for="email">Descripcion</label>
                <textarea name="Ades" rows="8" cols="100" required><?php echo $desc ?></textarea>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="btn_registro" value="Actualizar Datos" class="btn px-4 btn-primary text-white">
                  <input type="reset" name="btn_registro" value="Cancelar" class="btn px-4 btn-primary text-white">
                </div>
              </div>
            </form>
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

  <script src="js/custom.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#region').val(0);
      recargarLista();

      $('#region').change(function() {
        recargarLista();
      });
    })
  </script>
  <script type="text/javascript">
    function recargarLista() {
      $.ajax({
        type: "POST",
        url: "php/ajax_comunas.php",
        data: "idre=" + $('#region').val(),
        success: function(response) {
          $('#comuna').html(response);
        }
      });
    }
  </script>


</body>

</html>