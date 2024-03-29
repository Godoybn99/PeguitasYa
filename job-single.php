<!--Verificacion de sesion -->
<?php
session_start();
require "php/db.php";
date_default_timezone_set("America/Santiago");
$valor = 0;
if (isset($_GET['publicacion'])) {
  $trabajo = $_GET['publicacion'];
  $_SESSION['publicacion'] = $_GET['publicacion'];
}
if (isset($_POST['publicacion'])) {
  $trabajo = $_POST['publicacion'];
  $_SESSION['publicacion'] = $_GET['publicacion'];
}

if (!isset($_GET['publicacion']) && !isset($_POST['publicacion'])) {
  $trabajo = $_SESSION['publicacion'];
}


if (is_numeric(session_id())) {
  $usu = session_id();
  $estado = "Mi Perfil";
  $query = "SELECT nombre FROM usuario where idUsuario ='$usu'";
  $resultado = $mysqli->query($query);
  while ($var = mysqli_fetch_row($resultado)) {
    $nombre = $var[0];
  }
  $ref = 'miPerfil.php';
  $mis = true;
} else {
  $estado = "Inicio sesion";
  $nombre = '';
  $ref = 'inicio.php';
  $mis = false;
}



//Busqueda del trabajo 
$query = "SELECT titulo,descripcion,trabajo.correo,trabajo.fono,trabajo.idEstado,rentaMin,rentaMax, usuario.nombre, comuna.nombreComuna, region.nombreRegion, tipotrabajo.nombreTipo, trabajo.idUsuario, ia, fecha FROM trabajo INNER JOIN usuario ON trabajo.idUsuario = usuario.idUsuario INNER JOIN tipotrabajo ON trabajo.idTipo = tipotrabajo.idTipo INNER JOIN direccion ON trabajo.idDireccion = direccion.idDireccion INNER JOIN comuna ON direccion.idComuna = comuna.idComuna INNER JOIN region ON comuna.idRegion = region.idRegion where idTrabajo = '$trabajo'";
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
  $usuario = $var[11];
  $ia = $var[12];
  $fecha = $var[13];

  if ($es == 1) {
    $es = "Disponible";
  }
  if ($es == 2) {
    $es = "No Disponible";
  }

  //Promedio trabajo.
  $suma = 0;
  $queryContador = "SELECT count(valor) FROM valoracion where idTrabajo = '$trabajo'";
  $resultadoConteo = $mysqli->query($queryContador);
  while ($contador = mysqli_fetch_row($resultadoConteo)) {
    $conteo = $contador[0];
  }

  $queryValoraciones = "SELECT valor from valoracion where idTrabajo = '$trabajo'";
  $resultadoValoraciones = $mysqli->query($queryValoraciones);
  while ($valoraciones = mysqli_fetch_row($resultadoValoraciones)) {
    $suma = $suma + $valoraciones[0];
  }
  if ($conteo == 0) {
    $promedio = "Sin valoracions";
  } else {
    $promedio = intdiv($suma, $conteo);
  }
  $query2 = "SELECT * FROM usuario where idUsuario = '$usuario'";
  $resultado2 = $mysqli->query($query2);
  while ($dato = mysqli_fetch_row($resultado2)) {
    $uId = $dato[0];
    $uNombre = $dato[1];
    $uApellido = $dato[2];
    $uCorreo = $dato[3];
    $uDire = $dato[4];
    $uCargo = $dato[6];
    $uValo = $dato[7];
  }

  if ($uCargo == null || $uCargo == '') {
    $uCargo =  'Cargo no definido';
  }
}
?>
<!-- Contador de publicaciones --->
<?php
$query = "SELECT count(idTrabajo) FROM trabajo";
$resultado = $mysqli->query($query);
while ($cant = mysqli_fetch_row($resultado)) {
  $canti = $cant;
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


    <!-- NAVBAR -->
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="index.php">PeguitasYa</a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="index.php">Inicio</a></li>
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
            <h1 class="text-white font-weight-bold"><?php echo $titulo ?></h1>
            <div class="custom-breadcrumbs">
              <a href="index.php">Inicio</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Publicacion</strong></span>
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
    <!---Descripcion de la publicacion-->
    <section class="site-section">
      <div class="container">
        <div class="row align-items-center mb-5">
          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div class="border p-2 d-inline-block mr-3 rounded">
                <img src="images/logo1_PeguitasYa.jpg" alt="Image">
              </div>
              <div>
                <h2><?php echo $titulo ?></h2>
                <div>
                  <span class="ml-0 mr-2 mb-2"><span class="icon-briefcase mr-2"></span><?php echo $us ?></span>
                  <span class="m-2"><span class="icon-room mr-2"></span><?php echo $region ?>-<?php echo $comuna ?></span>
                  <span class="m-2"><span class="icon-clock-o mr-2"></span><?php echo $tipo ?></span></span>
                  <span class="m-2"><span class="icon-star mr-2"></span><?php echo $promedio ?> </span></span>
                </div>
              </div>
            </div>
          </div>


          <div class="col-lg-4">
            <div class="row">
              <div class="col-6">
                <?php
                if ($usu != $uId) {
                  $queryPostulacion = "SELECT idPostulacion FROM postulacion where idTrabajo = '$trabajo' AND idUsuario = '$usu'";
                  $resultadoPostulacion = $mysqli->query($queryPostulacion);
                  if (mysqli_fetch_row($resultadoPostulacion) != null) { ?>
                    <a href="#" class="btn btn-block btn-primary btn-md" data-toggle="modal" data-target="#modalPostulacion">Actualiza tu postulacion</a>
                  <?php
                  } else { ?>
                    <a href="#" class="btn btn-block btn-primary btn-md" data-toggle="modal" data-target="#modalPostulacion">Postular</a>
                  <?php
                  }
                  ?>
                <?php
                }
                ?>
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
                <li class="mb-2"><strong class="text-black">Fecha de publicacion:</strong> <?php echo $fecha ?> </li>
                <li class="mb-2"><strong class="text-black">Estado: </strong><?php echo $es ?> </li>
                <li class="mb-2"><strong class="text-black">Tipo de trabajo: </strong> <?php echo $tipo ?></li>
                <li class="mb-2"><strong class="text-black">Direccion del trabajo:</strong> <?php echo $region ?>-<?php echo $comuna ?></li>
                <li class="mb-2"><strong class="text-black">Renta: </strong> $<?php echo $reMin ?> - $<?php echo $reMax ?></li>
                <li class="mb-2"><strong class="text-black">Correo de contacto: </strong><?php echo $mail ?></li>
                <li class="mb-2"><strong class="text-black">Fono de contacto: </strong> <?php echo $fono ?></li>
                <?php
                if ($uId == $usu) {
                ?>
                  <form action="miPerfil.php" method="POST">
                  <?php
                } else {
                  ?>
                    <form action="Perfil.php" method="POST">
                    <?php
                  }
                    ?>
                    <input name='idUs' type="hidden" value=<?php echo $uId ?>></input>
                    <button type="submit" class="btn btn-block btn-primary btn-md">Datos del Ofertante</button>
                    </form>
              </ul>
            </div>


            <?php
            $queryPuntuacion = "SELECT valor FROM valoracion where idTrabajo = '$trabajo' AND idPublicador = '$uId'";
            $resultadoPuntuacion = $mysqli->query($queryPuntuacion);
            while ($res = mysqli_fetch_row($resultadoPuntuacion)) {
              $valor = $res[0];
            }
            ?>
            <form method="POST" action="php/ajax_puntuar_publicacion.php">
              <input name='idUsuario' type="hidden" value=<?php echo $usu ?>></input>
              <input name='publicacion' type="hidden" value=<?php echo $trabajo ?>></input>
              <input name='idPublicante' type="hidden" value=<?php echo $uId ?>></input>
              <input name='dire' type="hidden" value='1'></input>
              <?php if ($usu != $uId) { ?>
                <div class="form-group">
                  <label for="exp" class="cik-fomr-label">Valora esta publicación</label>
                  <div class="valores">
                    <?php for ($i = 1; $i <= 5; $i++) {
                      if ($valor == $i) { ?>
                        <input type="radio" name="example" class="rating" checked value="<?php echo $i ?>" />
                      <?php
                      } else { ?>
                        <input type="radio" name="example" class="rating" value="<?php echo $i ?>" />
                    <?php
                      }
                    } ?>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Puntuar</button>
              <?php } ?>
            </form>

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

    <footer class="site-footer">

      <a href="#top" class="smoothscroll scroll-top">
        <span class="icon-keyboard_arrow_up"></span>
      </a>

    </footer>
  </div>

  <!-- Modal del Formulario de Postulacion -->

  <div class="modal fade" id="modalPostulacion" tabindex="-1" role="dialog" aria-labelledby="ejemploMOdal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-tittle" center id="tituloLabel">Formulario de postulacion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="php/postula.php" method="POST" class="p-4 border rounded" enctype="multipart/form-data">
            <input name='idTrabajo' type="hidden" value=<?php echo $trabajo ?>></input>
            <div class="form-group">
              <label for="exp" class="cik-fomr-label">Años de Experiencia</label>
              <div>
                <select for="tipoT" name="anos" class="selectpicker border rounded" data-style="btn-black" data-width="50%" data-live-search="true" title="Seleccione una opción" required>
                  <option>Sin experiencia</option>
                  <option>1 a 2 años</option>
                  <option>3 o más años</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div>
                <label for="">Region</label>
                <div>
                  <select class="selectpicker border rounded" name="region" id="region" data-style="btn-black" data-width="50%" data-live-search="true" title="Selecione Region">
                    <?php
                    $query = "SELECT * FROM region";
                    $resultado = $mysqli->query($query);
                    while ($var = mysqli_fetch_row($resultado)) {
                    ?>
                      <option value=<?php echo $var[0]  ?>><?php echo $var[1]  ?></option>
                    <?php } ?>

                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="job-location">Comunas</label>
                <div>
                  <select class="form-control col-sm-6" name="comuna" id="comuna" data-style="btn-black" data-width="50%" data-live-search="true" title="Selecione Comuna">
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="exp" class="cik-fomr-label">Cant. de trabajos anteriores</label>
                <div>
                  <select for="tipoT" name="cantT" class="selectpicker border rounded" data-style="btn-white" data-width="50%" data-live-search="true" title="Seleccione una opción" required>
                    <option>Ninguno</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3 o más</option>
                  </select>
                </div>
              </div>
              <?php if ($ia == '2') { ?>
                <div class="form-group">
                  <label for="esp" class="cik-fomr-label">Especialización</label>
                  <div>
                    <select for="espec" name="esp" class="selectpicker border rounded" data-style="btn-black" data-width="58%" data-live-search="true" title="Seleccione una orientación">
                      <option>Back End</option>
                      <option>Full Stack</option>
                      <option>Front End</option>
                    </select>
                  </div>
                </div>
              <?php } ?>
              <div class="form-group">
                <label for="esp" class="cik-fomr-label">Nivel de Estudios</label>
                <div>
                  <select class="selectpicker border rounded" for="espec" name="study" class="selectpicker" data-style="btn-black" data-width="55%" data-live-search="true" required>
                    <option>Sin estudios universitarios</option>
                    <option>Titulo Tecnico</option>
                    <option>Titulo profesional</option>
                    <?php
                    if ($ia == '2') {
                    ?>
                      <option>Estudios Post Grados</option>
                    <?php
                    } ?>
                  </select>
                </div>
              </div>
              <div class="form-group" hidden="true">
                <?php
                $query = "SELECT * FROM usuario";
                $resultado = $mysqli->query($query);
                while ($var = mysqli_fetch_row($resultado)) {
                ?>
                  <option value=<?php echo $var[0]  ?>><?php echo $var[7]  ?></option>
                <?php } ?>
                </select>
              </div>
              <div>
                <?php
                if ($ia == '1' || $ia == '2') {
                ?>
                  <input type="file" name="curriculum" class="form__file" accept="image/png, .jpeg, .jpg, .pdf, .doc" required>
                <?php
                } else { ?>
                  <input type="file" name="curriculum" class="form__file" accept="image/png, .jpeg, .jpg, .pdf, .doc">
                <?php
                }
                ?>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
              </div>

            </div>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Datos del Ofertante -->

  <div class="modal fade" id="modalDatos" tabindex="-1" role="dialog" aria-labelledby="ejemploMOdal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-tittle" center id="tituloLabel">Datos del Ofertante</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input name='idTrabajo' type="hidden" value=<?php echo $trabajo ?>></input>
          <div class="form-group">
            <label for="exp" class="cik-fomr-label">Nombre</label>
            <div>
              <input type="text" readonly name="txtEmail" class="form-control" value=<?php echo $uNombre ?>>
            </div>
          </div>
          <div class="form-group">
            <div>
              <label for="">Apellido</label>
              <div>
                <input type="text" readonly name="txtEmail" class="form-control" value=<?php echo $uApellido ?>>
              </div>
            </div>
            <div class="form-group">
              <label for="job-location">Correo electronico</label>
              <div>
                <input type="text" readonly name="txtEmail" class="form-control" value=<?php echo $uCorreo ?>>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="exp" class="cik-fomr-label">Cargo</label>
              <div>
                <input type="text" readonly name="txtEmail" class="form-control" value=<?php echo $uCargo ?>>
              </div>
            </div>
            <div class="form-group">
              <label for="esp" class="cik-fomr-label">Direccion</label>
              <div>
                <input type="text" readonly name="txtEmail" class="form-control" value=<?php echo $uDire ?>>
              </div>
            </div>
            <div class="form-group">
              <label for="esp" class="cik-fomr-label">Valoracion</label>
              <div>
                <input type="text" readonly name="txtEmail" class="form-control" value=<?php echo $uValo ?>>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
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

  <script src="js/bootstrap-select.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/rating.js"></script>
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