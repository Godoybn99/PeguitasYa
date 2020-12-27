<?php 
if($_POST['per']==1){
$cadena='<label for="job-location">Perfil de busquda IA</label><br>
<select class="form-control col-sm-2" name="perfil" id="perfil" data-style="btn-black" data-width="20%" data-live-search="true" title="Selecione Perfil">
<option class=selectpicker border rounded">General</option><option class=selectpicker border rounded">Informatico</option>
</select>';
echo  $cadena;
}

?>        