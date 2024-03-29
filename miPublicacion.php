<!--Verificacion de sesion -->
<?php
session_start();
require "php/db.php";
$trabajo = $_GET['publicacion'];

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
                <a>Servicios</a>
                <ul class="dropdown">
                  <li><a href="job-single.php">Buscar un trabajador</a></li>
                  <li><a href="post-job.php">Publicar un trabajo</a></li>
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
                <img src="images/logo1_PeguitasYa.jpg" alt="Image">
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
                <a href="#" class="btn btn-block btn-primary btn-md" data-toggle="modal" data-target="#modalPostulacion">CLASIFICAR</a>
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



    <!---   ##############################################     Detalles Postulantes    ##############################################     -->


       
    <section class="site-section">
    <?php
    echo "<table align=center width=80%>";
    echo "<tr>";
    echo "<th>Nombre</th>";
    echo "<th>Apellido</th>";
    echo "<th>Correo</th>";
    echo "<th>Anos de Exp</th>";
    echo "<th>¿Es de la misma comuna?</th>";
    echo "<th>Cantidad de Trabajos</th>";
    echo "<th>Especialidad</th>";
    echo "<th>Nivel de Estudios</th>";
    echo "<th>Valoracion</th>";
    echo "<th>Curriculum</th>";
    
    $queryIA="SELECT usuario.nombre, usuario.apellidos, usuario.correo, years, city, nWorks, specialty, studies, score, usuario.idUsuario FROM postulacion INNER JOIN usuario ON postulacion.idUsuario = usuario.idUsuario WHERE idTrabajo = '$trabajo'";
    $resultadoIA= $mysqli->query($queryIA);
    //fopen('datosIA.txt','a');
    //$file - 'datosIA.txt';
    if(mysqli_num_rows($resultadoIA)){
      $jump = "\r\n";
      $separator = "\t";
      $fp = fopen('datosIA/publicacion'.$trabajo.'.csv', 'w');
      while($var=mysqli_fetch_row($resultadoIA)){
        $registro = array($var[9], $var[3] , $var[4], $var[5], $var[6], $var[7], $var[8]);
        fputcsv($fp,$registro);
      }  
    }
    fclose($fp);
    chmod('datosIA/publicacion'.$trabajo.'.csv', 0777);

    $query="SELECT usuario.nombre, usuario.apellidos, usuario.correo, years, city, nWorks, specialty, studies, score, curriculum FROM postulacion INNER JOIN usuario ON postulacion.idUsuario = usuario.idUsuario WHERE idTrabajo = '$trabajo'";
    $resultado= $mysqli->query($query);
    while($var=mysqli_fetch_row($resultado)){

      $query2= "SELECT * FROM usuario where idUsuario = '$usuario'";
    $resultado2 = $mysqli->query($query2);
    while($dato= mysqli_fetch_row($resultado2)){
      $uNombre = $dato[1];
      $uApellido = $dato[2];
      $uCorreo = $dato[3];
      $uDire = $dato[4];
      $uCargo = $dato[6];
      $uValo = $dato[7];
    }

    if($uCargo == null || $uCargo == ''){
      $uCargo =  'Cargo no definido';
    }

        if($var[3] == 1){
            $ano = 'Sin experiencia';
        }else if($var[3] == 2){
            $ano = '1 año';
        }else if($var[3] == 3){
            $ano = '2 años';
        }else if($var[3] == 4){
            $ano = '3 o más años';
        }
        
    
        if($var[4] == 2){
            $comu = 'Si';
        }else{
            $comu = "No";
        }
    
        if($var[5] == 1){
            $cantT = 'Ninguno';
        }else if($var[5] == 2){
            $cantT = 1;
        }else if($var[5] == 3){
            $cantT = 2;
        }else if($var[5] == 4){
            $cantT = '3 o más';
        }
    
        if($var[6] == 2){
            $esp = 'Full Stack';
        }else if($var[6] == 1){
            $esp = 'Front End';
        }else if($var[6] == 3){
            $esp = 'Back End';
        }
    
        if($var[7] == 2){
            $estud = 'Titulo Tecnico';
        }else if($var[7] == 3){
            $estud = 'Titulo profesional';
        }else if($var[7] == 4){
            $estud = 'Post Grados';
        }else{
            $estud = 'Sin estudios universitarios';
        }

        
        echo "<tr>";
        echo "<td>".$var[0]."</td>";
        echo "<td>".$var[1],"</td>";
        echo "<td>".$var[2],"</td>";
        echo "<td>".$ano,"</td>";
        echo "<td>".$comu,"</td>";
        echo "<td>".$cantT,"</td>";
        echo "<td>".$esp,"</td>";
        echo "<td>".$estud,"</td>";
        echo "<td>".$var[8],"</td>";        
        if($var[9]){
          echo "<td><a href=peguitasYA/$var[9] download = ".$var[0]."".$var[1]."> Curriculum </a></td>";
        }else{
        }
        echo "<tr>";
    }
    echo "</table>" ?>
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

    
    </footer>  
  </div>

                                                        <!-- Modal del Formulario de Postulacion -->

  <div class="modal fade" id="modalPostulacion" tabindex="-1" role="dialog" aria-labelledby="ejemploMOdal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" >
          <h5 class="modal-tittle" center id="tituloLabel">Resultado de PeguitasIA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="php/postula.php" method="POST" class="p-4 border rounded">
          <input name='idTrabajo' type="hidden" value= <?php echo $trabajo ?>></input>
            <div class="form-group">
              <label for="exp" class="cik-fomr-label">Postulantes recomendados por PeguitasIA</label>
              <div>
                <?php
                $p = exec("python datosIA/peguitaia.py $trabajo ");
                echo $p;
                $arrayId = [];
                $count = 0;
                $idList = '';
                for($i=0; $i < strlen($p); $i++){
                  if(is_numeric($p[$i])){
                    $count++;
                    $idList = intval($idList.$p[$i]);
                  }
                  else{
                    if($count > 0){
                      array_push($arrayId, $idList);
                      $count = 0;
                      $idList= '';
                    }
                  }
                }

                #####################################################
    ?>
    <section class="site-section">
    <?php
    echo "<table align=center width=80%>";
    echo "<tr>";
    echo "<th>Nombre</th>";
    echo "<th>Apellido</th>";
    echo "<th>Correo</th>";  

    foreach ($arrayId as $val) {
      
      $queryX="SELECT usuario.nombre, usuario.apellidos, usuario.correo FROM usuario INNER JOIN postulacion ON postulacion.idUsuario = usuario.idUsuario WHERE postulacion.idTrabajo = '$trabajo' AND postulacion.idUsuario = '$val'";
      $resultadoX= $mysqli->query($queryX);
      while($varX=mysqli_fetch_row($resultadoX)){
        

        echo "<tr>";
        echo "<td>".$varX[0]."</td>";
        echo "<td>".$varX[1],"</td>";
        echo "<td>".$varX[2],"</td>";
        echo "<tr>";

    }        
  }    
    echo "</table>"  ?>    
    </section>
    
                <?php########################  #############################?>
                
              </div>
            </div>           
            
            <div class="modal-footer">
              <button type="reset" class="btn btn-secondary">Cancelar</button>
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          
        </div>        
      </div>
    </div>
    </form>
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