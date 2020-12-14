<!--Verificacion de sesion -->
<?php
require "php/db.php";
session_start();


if(isset($_POST['idTrabajo'])){

$trabajo = $_POST['idTrabajo'];
$_SESSION['publi'] = $_POST['idTrabajo'];
}else{
  $trabajo= $_SESSION['publi'];
}

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
  $v=0;
  
if(isset($_POST['busquedaIA'])){
  $v=$_POST['valor'];
}


?>
 <!-- Contador de Postulantes --->
 <?php
          $query="SELECT count(idPostulacion) FROM postulacion  where idTrabajo = '$trabajo'";
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
              <li><a href="contact.php">Contacto</a></li>
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
      
            <h2 class="section-title mb-2"> Publicacion Selecionada </h2>
            
          </div>
        </div>
    <!---Publicacion Selecionada-->
        <ul class="job-listings mb-5">
        <?php
          $query="SELECT idTrabajo,titulo, usuario.nombre, comuna.nombreComuna, region.nombreRegion, tipotrabajo.nombreTipo,trabajo.ia FROM trabajo INNER JOIN usuario ON trabajo.idUsuario = usuario.idUsuario INNER JOIN tipotrabajo ON trabajo.idTipo = tipotrabajo.idTipo INNER JOIN direccion ON trabajo.idDireccion = direccion.idDireccion INNER JOIN comuna ON direccion.idComuna = comuna.idComuna INNER JOIN region ON comuna.idRegion = region.idRegion where idTrabajo = '$trabajo'";
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

              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" name="ab"  method="post" class="search-jobs-form">
              <?php if($v == 1){ ?>
              <input name='valor' type="hidden" value= <?php echo $v=0 ?>></input>
              <button role="button" class="btn btn-primary" name="busquedaIA">Ver Lista de todos Postulante</button>
              <?php }else{ ?>
              <input name='valor' type="hidden" value= <?php echo $v=1 ?>></input>
              <button role="button" class="btn btn-info" data-toggle="modal" data-target="#modalPostulacion" name="busquedaIA">Buscar Postulante con IA</button>
              <?php } ?>
              </form>

              </div>
              <?php } ?>     
            </div>            
            </ul>
      </div>


<?php
  $queryIA="SELECT usuario.nombre, usuario.apellidos, usuario.correo, years, city, nWorks, specialty, studies, score, usuario.idUsuario FROM postulacion INNER JOIN usuario ON postulacion.idUsuario = usuario.idUsuario WHERE idTrabajo = '$trabajo'";
  $resultadoIA= $mysqli->query($queryIA);
  //fopen('datosIA.txt','a');
  //$file - 'datosIA.txt';
  if(mysqli_num_rows($resultadoIA)){
    $jump = "\r\n";
    $separator = "\t";
    $fp = fopen('datosIA/publicacion'.$trabajo.'.csv', 'w');
    while($var=mysqli_fetch_row($resultadoIA)){
      $registro = array($var[9], $var[3] ,  $var[4], $var[5], $var[6], $var[7], $var[8]);
      fputcsv($fp,$registro);
    }
    fclose($fp);  
    chmod('datosIA/publicacion'.$trabajo.'.csv', 0777);
  }
  ?>
      
      <!---Lista de postulantes -->
      <div class="row mb-3 justify-content-center">
          <div class="col-md-7 text-center">
            <?php if(isset($_POST['busquedaIA']) && $v==0){
            ?>
            <h2 class="section-title mb-2"> Lista de recomendados por "PeguitasIA" </h2>
            <?php
            }else{
              ?>
            <h2 class="section-title mb-2"> Lista de Postulantes </h2>
         <?php } ?>
          </div>
        </div>
        <ul class="job-listings mb-5">
        <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
        <table class="table table-striped" width:400px >
        <thead class="thead-dark">
            <tr align="center">
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Años de Exp</th>
            <th>¿Es de la misma comuna?</th>
            <th>Cantidad de Trabajos</th>
            <th>Especialidad</th>
            <th>Nivel de Estudios</th>
            <th>Valoracion</th>
            <th>Datos del Postulante</th>
            <th>Ver Curriculum</th>
            </tr>
         </thead>
  <tbody>
    <?php
    if($v == 0){
          
      $p = exec("python datosIA/peguitaia.py $trabajo");
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
                #echo var_dump($arrayId);
  //Busqueda con IA   
    foreach ($arrayId as $val) {
    $query="SELECT usuario.nombre, usuario.apellidos, usuario.correo, years, city, nWorks, specialty, studies, score,idTrabajo,postulacion.idUsuario,idPostulacion,usuario.direccion,usuario.trabajo,curriculum FROM postulacion INNER JOIN usuario ON postulacion.idUsuario = usuario.idUsuario WHERE idTrabajo = '$trabajo' AND postulacion.idUsuario = '$val'";
    $resultado= $mysqli->query($query);
    while($var=mysqli_fetch_row($resultado)){    
    $idTrabajo= $var[9];
    $idUsuario = $var[10];
    $idPostulacion = $var[11];
    
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

      $uNombre = $var[0];
      $uApellido = $var[1];
      $uCorreo = $var[2];
      $uDire = $var[12];
      $uCargo = $var[13];
      $uValo = $var[8];

      if($uCargo == null || $uCargo == ''){
        $uCargo =  'Cargo no definido';
      }

      ?>
      <tr align="center">
      <td><?php echo$var[0]?></td>
      <td><?php echo$var[1]?></td>
      <td><?php echo$var[2]?></td>
      <td><?php echo$ano?></td>
      <td><?php echo$comu?></td>
      <td><?php echo$cantT?></td>
      <td><?php echo$esp?></td>
      <td><?php echo$estud?></td>
      <td><?php echo$var[8]?></td>
      <form method="post" action="Perfil.php"> 
      <input name='idUs' type="hidden" value= <?php echo $idUsuario?>></input>
      <input name='publicacion' type="hidden" value= <?php echo $trabajo?>></input>
      <td><button class="btn btn-primary" type="submit">Ver Perfil</button></td>
      </form>
      <?php
      if($var[14]){
          echo "<td><button class= 'btn btn-info' href=peguitasYA/$var[14] download = ".$var[0]."".$var[1]."> Descargar Curriculum </button></td>";
        }else{
        }
      ?>
      
      <tr>
      
    <?php }
    }
                
    }else{
    //Busqueda normal
  $query="SELECT usuario.nombre, usuario.apellidos, usuario.correo, years, city, nWorks, specialty, studies, score,idTrabajo,postulacion.idUsuario,idPostulacion,usuario.direccion,usuario.trabajo,curriculum FROM usuario INNER JOIN postulacion ON postulacion.idUsuario = usuario.idUsuario WHERE idTrabajo = '$trabajo'";
  $resultado= $mysqli->query($query);
  while($var=mysqli_fetch_row($resultado)){

    $idTrabajo= $var[9];
    $idUsuario = $var[10];
    $idPostulacion = $var[11];
    
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

      $uNombre = $var[0];
      $uApellido = $var[1];
      $uCorreo = $var[2];
      $uDire = $var[12];
      $uCargo = $var[13];
      $uValo = $var[8];

      if($uCargo == null || $uCargo == ''){
        $uCargo =  'Cargo no definido';
      }

      ?>
      <tr align="center">
      <td><?php echo$var[0]?></td>
      <td><?php echo$var[1]?></td>
      <td><?php echo$var[2]?></td>
      <td><?php echo$ano?></td>
      <td><?php echo$comu?></td>
      <td><?php echo$cantT?></td>
      <td><?php echo$esp?></td>
      <td><?php echo$estud?></td>
      <td><?php echo$var[8]?></td>
      <form method="post" action="Perfil.php"> 
      <input name='idUs' type="hidden" value= <?php echo $idUsuario?>></input>
      <input name='publicacion' type="hidden" value= <?php echo $trabajo?>></input>
      <td><button class="btn btn-primary" type="submit">Ver Perfil</button></td>
      </form>
      <?php
      if($var[14]){
          echo "<td><a role='button' class='btn btn-primary' href=peguitasYA/$var[14] download = ".$var[0]."-".$var[1]."> Descargar Curriculum </a></td>";
        }else{
        }
      ?>      
      <tr>
      
    <?php }
    } ?>
      </tr>
      
    
  </tbody>
</table>
        </div>
        </li>
        </ul>
            <!-- Mostrar cantidad de Postulantes  -->
        <div class="row pagination-wrap">
          <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span>Mostrando 1-<?php echo $canti[0] ?> de <?php echo $canti[0] ?> Postulantes</span>
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

  </body>
   
  

    
    <footer class="site-footer">
      <a href="#top" class="smoothscroll scroll-top"><span class="icon-keyboard_arrow_up"></span></a>

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
      </div>
    </footer>



                                                      <!-- Modal del Formulario de Postulacion -->

   <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="ejemploMOdal">
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
                //$salida= array(); //recogerá los datos que nos muestre el script de Python 
                echo $trabajo;         
                
                //$command = 'python datosIA/peguitaia.py';
                $p = exec("python datosIA/peguitaia.py $trabajo");                
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
                } echo($idList);

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


         <!-- Modal de puntiacion -->

  <div class="modal fade" id="modalValo" tabindex="-1" role="dialog" aria-labelledby="ejemploMOdal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" >
          <h5 class="modal-tittle" center id="tituloLabel">Puntuar al postulante</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="php/ajax_puntuar.php">
          <input name='idUsuario' type="hidden" value= <?php echo $idUsuario?>></input>
          <input name='publicacion' type="hidden" value= <?php echo $publicacion?>></input>
            <div class="form-group">
              <label for="exp" class="cik-fomr-label">Nombre</label>
              <div>
              <input type="text" readonly  name="txtEmail" class="form-control" value= <?php echo "'$uNombre' '$uApellido'"?>>
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
    <!---Java Lista------>
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
<!---Java Estrellas------>
<script>
  $('.valores').rating(function(vote, event){
    $.ajax({
      method:"POST",
      url:"php/ajax_puntuar.php",
      data: {vote:vote,idUsuario:$idUsuario}
    }).done(function(info){
      $('.info').html("Tamo")
    })
  })
   
</script>
  

  </body>
</html>