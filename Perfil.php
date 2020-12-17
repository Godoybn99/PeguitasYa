<!--Verificacion de sesion -->
<?php
require "php/db.php";
session_start();
$actual = session_id();
$idPublic = 0;
if (is_numeric(session_id())) {
  if (isset($_POST['idUs'])) {
    $idUsuario = $_POST['idUs'];
    if (isset($_POST['publicacion'])) {
      $publicacion = $_POST['publicacion'];
      $_SESSION['publi'] = $publicacion;
      $dire = "1";
    } else {
      $_SESSION['usuario'] = $idUsuario;
      $publicacion = 0;
      $dire = "2";
    }
  }
  if (isset($_GET['Dato'])) {
    $idUsuario = $_GET['Dato'];
    $publicacion = 0;
    $_SESSION['usuario'] = $idUsuario;
    $dire = "2";
  }

  if (!isset($_POST['idUs']) && !isset($_GET['Dato'])) {
    $idUsuario = $_SESSION['usuario'];
    $dire = "2";
  }

  $estado = "Cerrar sesion";
  $query = "SELECT nombre,apellidos,correo,valoracion,trabajo,idUsuario FROM usuario where idUsuario ='$idUsuario'";
  $resultado = $mysqli->query($query);
  while ($var = mysqli_fetch_row($resultado)) {
    $nombre = $var[0];
    $ape = $var[1];
    $correo = $var[2];
    $valo = $var[3];
    $car = $var[4];
    if ($car == '' || $car == null) {
      $car = 'Cargo o profesión no definida';
    }
    $idPublic = $var[5];
  }
  $ref = 'php/Cerrar.php';
  $mis = true;
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

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="css/custom-bs.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="css/bootstrap-select.min.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="fonts/line-icons/style.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/quill.snow.css">
  <link rel="stylesheet" href="css/rating.css">
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
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
            <h1 class="text-white font-weight-bold">Perfil de <?php echo $nombre ?></h1>
            <div class="custom-breadcrumbs">
              <a href="index.php">Inicio</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Perfil de <?php echo $nombre ?></strong></span>
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
      //session_unset();
    }
    ?>
    <!--Datos Perfil-->
    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5">
            <h2 class="mb-4">Mis Datos</h2>

            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="text-black" for="fname">Nombre</label>
                <input type="text" readonly name="txtNom" class="form-control" value=<?php echo $nombre ?>>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="text-black" for="fname">Apellidos</label>
                <input type="text" readonly name="txtApe" class="form-control" value=<?php echo $ape ?>>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="text-black" for="fname">Correo Electronico</label>
                <input type="text" readonly name="txtEmail" class="form-control" value=<?php echo $correo ?>>
              </div>
            </div>
            <div class="row form-group mb-4">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="text-black" for="fname">Profesion</label>
                <input type="text" readonly name="txtCar" class="form-control" placeholder="<?php echo $car ?>">
              </div>
            </div>

            <div class="row form-group mb-4">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="text-black" for="fname">Valoracion</label>
                <input type="Text" readonly name="txtCpas" class="form-control" placeholder="<?php echo $valo ?>">
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <button class="btn btn-primary " data-toggle="modal" data-target="#modalValo">Puntuar</button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
  </div>
  </div>
</body>

<footer class="site-footer">




  <a href="#top" class="smoothscroll scroll-top">
    <span class="icon-keyboard_arrow_up"></span>
  </a>



</footer>


<!-- Modal de puntiacion -->

<div class="modal fade" id="modalValo" tabindex="-1" role="dialog" aria-labelledby="ejemploMOdal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-tittle" center id="tituloLabel">Puntuar al postulante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="php/ajax_puntuar.php">
          <input name='idUsuario' type="hidden" value=<?php echo $idPublic ?>></input>
          <input name='publicacion' type="hidden" value=<?php echo $publicacion ?>></input>
          <input name='dire' type="hidden" value=<?php echo $dire ?>></input>
          <div class="form-group">
            <label for="exp" class="cik-fomr-label">Nombre</label>
            <div>
              <input type="text" readonly name="txtEmail" class="form-control" value=<?php echo "'$nombre' '$ape'" ?>>
            </div>
          </div>
          <div class="form-group">
            <label for="exp" class="cik-fomr-label">Puntuacion</label>
            <div class="valores">
              <input type="radio" name="example" class="rating" value="1" />
              <input type="radio" name="example" class="rating" value="2" />
              <input type="radio" name="example" class="rating" value="3" />
              <input type="radio" name="example" class="rating" value="4" />
              <input type="radio" name="example" class="rating" value="5" />
            </div>
          </div>
          <span class="info"></span>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Puntuar</button>
        </form>
        <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

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
<script src="js/rating.js"></script>
<!---Java Estrellas------>
<script>
  $('.valores').rating(function(vote, event) {
    $.ajax({
      method: "POST",
      url: "php/ajax_puntuar.php",
      data: {
        vote: vote,
        idUsuario: $idUsuario
      }
    }).done(function(info) {
      $('.info').html("Tamo")
    })
  })
</script>



</body>

</html>