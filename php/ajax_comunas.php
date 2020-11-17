<?php 
require_once 'bd.php';

$prove = mysqli_real_escape_string($mysqli, $_POST["idRegion"]);
$query = "SELECT * FROM inventario WHERE IdProveedor = ".$prove."";
$resultado= $mysqli->query($query);
while($var=mysqli_fetch_row($resultado)){
    ?>
          <option value= <?php echo $var[0]  ?> ><?php echo $var[1]  ?></option>
        <?php } 
        
?>
