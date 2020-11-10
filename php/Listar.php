<?php
require "db.php";
$region=$_POST['comuna'];

$query="SELECT nombreComuna FROM comuna where idRegion='$region'";
$resultado = $mysqli->query($query);

$cadena= "<label for='job-location'>Comuna</label>
<select class='selectpicker border rounded' name='job-region' data-style='btn-black' data-width='100%' data-live-search='true' title='Selecione Region'>";
while($var=mysqli_fetch_row($resultado)){
    $cadena=$cadena.'<option> '.$var[0].'</option>';
}
echo $cadena."</select>";
?>