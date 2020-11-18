<?php 
$conexion=mysqli_connect('localhost','root','','peguita');
$region=$_POST['idre'];

	$sql="SELECT *
		from comuna 
		where idRegion='$region'";

	$result=mysqli_query($conexion,$sql);

  $cadena="";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option  class=selectpicker border rounded" value='.$ver[0].'>'.($ver[1]).'</option>';
	}

	echo  $cadena;
	

?>        
