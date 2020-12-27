<!--Verificacion de sesion -->
<?php
require "php/db.php";
session_start();

if (is_numeric(session_id())) {
  $us = session_id();
  $estado = "Cerrar sesion";
  $query = "SELECT nombre, apellidos, correo, valoracion, trabajo, fono, postulaciones FROM usuario where idUsuario ='$us'";
  $resultado = $mysqli->query($query);
  while ($var = mysqli_fetch_row($resultado)) {
    $nombre = $var[0];
    $ape = $var[1];
    $correo = $var[2];
    $valo = $var[3];
    $countP = $var[6];

    if ($var[4] != '') {
      $car = $var[4];
    } else {
      $car = '';
    }
    if ($var[5] != '') {
      $fono = $var[5];
    } else {
      $fono = '';
    }
  }
  $ref = 'php/Cerrar.php';
  $mis = true;
  $queryCount = "SELECT count(usuario.idUsuario) FROM usuario INNER JOIN  postulacion ON usuario.idUsuario = postulacion.idUsuario INNER JOIN trabajo ON trabajo.idTrabajo = postulacion.idTrabajo WHERE usuario.idUsuario = '$us' AND trabajo.idEstado = 3";
  $trabElim = $mysqli->query($queryCount);
  $a =  mysqli_fetch_row($trabElim);
  if ($a[0] > $countP) {
    $_SESSION['message'] = 'Se ha cerrado una publicacion recientemente';
    $_SESSION['message_type'] = 'danger';
    $queryUpdatePostulantes = "UPDATE usuario SET postulaciones = '$a[0]' WHERE idUsuario = '$us'";
    $resultadoCont = $mysqli->query($queryUpdatePostulantes);
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
            <h1 class="text-white font-weight-bold">Mi Perfil</h1>
            <div class="custom-breadcrumbs">
              <a href="index.php">Inicio</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Mi Perfil</strong></span>
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
      unset($_SESSION['message']);
    }
    ?>
    <!--Datos Perfil-->
    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5">
            <h2 class="mb-4">Mis Datos</h2>

            <form action="php/Perfil.php" class="p-4 border rounded" method="POST">
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Nombre</label>
                  <input type="text" name="txtNom" class="form-control" pattern="[a-zA-Z]{2,15}" value=<?php echo $nombre ?> required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Apellidos</label>
                  <input type="text" name="txtApe" class="form-control" pattern="[a-zA-Z]{2,15}" value=<?php echo $ape ?> required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Correo Electronico</label>
                  <input type="email" name="txtEmail" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value=<?php echo $correo ?> required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label for="txtFono">Telefono de contacto</label>
                  <input type="text" class="form-control" name="txtFono" pattern="[0-9+]{9,12}" value="<?php echo $fono ?>" required>
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Cargo</label>
                  <input type="text" name="txtCar" class="form-control" pattern="[a-zA-Z]{1,15}" value=<?php echo $car ?>>
                </div>
              </div>

              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Valoracion</label>
                  <input type="Text" readonly name="txtCpas" class="form-control" placeholder=<?php echo $valo ?>>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="btn_registro" value="Guardar Datos" class="btn px-4 btn-primary text-white">
                  <input type="reset" name="btn_registro" value="Cancelar" class="btn px-4 btn-primary text-white">
                </div>
              </div>
            </form>
          </div>

          <!----Cambio de Contraseña---->
          <div class="col-lg-6 mb-5">
            <h2 class="mb-4">¿Quiere cambiar su contraseña?</h2>

            <form action="php/Cambio.php" class="p-4 border rounded" method="POST">
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Contraseña Actual</label>
                  <input type="password" name="txtApas" class="form-control" placeholder="Ingrese su contraseña acutal" pattern="[a-zA-Z0-9._%+-]{6,16}" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Nueva Contraseña</label>
                  <input type="password" name="txtNpas" class="form-control" placeholder="Ingrese su nueva contraseña" pattern="[a-zA-Z0-9._%+-]{6,16}" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Confirme su contraseña</label>
                  <input type="password" name="txtCpas" class="form-control" placeholder="Confirme su contraseña">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="btn_registro" value="Cambiar Contraseña" class="btn px-4 btn-primary text-white">
                  <input type="reset" name="btn_registro" value="Cancelar" class="btn px-4 btn-primary text-white">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="text-center">
        <h2 class="section-title mb-2"> Mis Postulaciones </h2>
      </div>
      <table class="table table-striped">
        <thead class="thead-dark" align="center">
          <tr align="center">
            <th>Titulo del trabajo</th>
            <th>Nombre del publicador</th>
            <th>Estado</th>
            <th>Tipo de trabajo</th>
            <th>Direccion</th>
            <th>Correo</th>
            <th>Fono</th>
            <th>Renta Min</th>
            <th>Renta Max</th>
            <th>Fecha</th>
            <th>Eliminar Publicacion</th>
            <th>Ver Publicacion</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT trabajo.titulo, usuario.nombre, usuario.apellidos, trabajo.idEstado, trabajo.idTipo, region.nombreRegion, comuna.nombreComuna, trabajo.correo, trabajo.fono, trabajo.rentaMin, trabajo.rentaMax, trabajo.fecha, trabajo.idTrabajo FROM postulacion inner join trabajo on postulacion.idTrabajo = trabajo.idTrabajo INNER JOIN usuario ON trabajo.idUsuario = usuario.idUsuario INNER JOIN direccion on trabajo.idDireccion = direccion.idDireccion INNER JOIN comuna on direccion.idComuna = comuna.idComuna INNER JOIN region on comuna.idRegion = region.idRegion WHERE postulacion.idUsuario ='$us'";
          $resultado = $mysqli->query($query);
          while ($var = mysqli_fetch_row($resultado)) {
            $trabajo = $var[12];
            $es = $var[3];
            $tipo = $var[4];

            if ($es == 1) {
              $es = "Disponible";
              $estilo="success";
            }
            if ($es == 2) {
              $es = "No Disponible";
              $estilo="danger";
            }
            if ($es == 3) {
              $es = "Finalizado";
              $estilo="dark";
            }

            if ($tipo == 1) {
              $tipo = "Full time";
            }
            if ($tipo == 2) {
              $tipo = "Part time";
            }
            if ($tipo == 3) {
              $tipo = "Esporadico";
            }


          ?>
            <tr align="center">
              <td><?php echo $var[0] ?></td>
              <td><?php echo $var[1] . ' ' . $var[2] ?></td>
              <td><span class="badge badge-<?php echo $estilo ?> text-white px-4"><?php echo $es ?></span></td>
              <td><?php echo $tipo ?></td>
              <td><?php echo $var[5] . ', ' . $var[6] ?></td>
              <td><?php echo $var[7] ?></td>
              <td><?php echo $var[8] ?></td>
              <td><?php echo $var[9] ?></td>
              <td><?php echo $var[10] ?></td>
              <td><?php echo $var[11] ?></td>
              <td>
                  <form action="php\eliminarPostulacion.php" method="POST">
                    <div class="job-listing-meta">
                      <input type="hidden" name="publicacion" value="<?php echo $trabajo ?>">
                      <input type="hidden" name="usuario" value="<?php echo $us ?>">
                      <button type="submit" class="btn btn-danger border-width-2 d-none d-lg-inline-block">Eliminar</button>
                    </div>
                  </form>
                </td>
              <?php if ($es == "Disponible") { ?>
                <td><a class="btn btn-primary" type="button" href="job-single.php?publicacion=<?php echo $trabajo ?>">Ver Publicacion</a></td>
              <?php }else{ ?>
                <td><a class="btn px-4 btn-danger text-white disabled" type="button" aria-disabled="true">No Disponible</a></td>
            <?php
          }
          } ?>
        </tbody>
      </table>
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



</body>

</html>