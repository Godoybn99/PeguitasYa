<?php 
$conexion=mysqli_connect('localhost','root','','peguita');
$continente=$_POST['idre'];

	$sql="SELECT *
		from comuna 
		where idRegion='$continente'";

	$result=mysqli_query($conexion,$sql);

  $cadena='<label>Comuna (Selecione una region)</label>
  
  <select class="selectpicker border rounded" name="comunas" id="comunas" data-style="btn-black" data-width="100%" data-live-search="true" title="Selecione Comuna">';

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.($ver[1]).'</option>';
	}

	echo  $cadena."</select>";
	

?>        
