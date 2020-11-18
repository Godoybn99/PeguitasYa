<?php 
$conexion=mysqli_connect('localhost','root','','peguita');
$continente=$_POST['idre'];

	$sql="SELECT *
		from comuna 
		where idRegion='$continente'";

	$result=mysqli_query($conexion,$sql);

  $cadena="<label>Comuna (Selecione una comuna)</label>

  <select  name='comuna' id='comuna' data-style='btn-black'data-width='100%' data-live-search='true' title='Selecione comuna' placeholder='Selecione una comuna'>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.($ver[1]).'</option>';
	}

	echo  $cadena."</select>";
	

?>        
