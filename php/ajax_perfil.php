<?php 
if($_POST['per']==1){
$cadena='<label for="job-location">Perfil de busquda IA</label><br>
<select class="form-control col-sm-2" name="perfil" id="perfil" data-style="btn-black" data-width="20%" data-live-search="true" title="Selecione Perfil">
<option class=selectpicker border rounded" value="1">General</option>
<option class=selectpicker border rounded value="2">Informatico</option>
</select>';
echo  $cadena;
}

if($_POST['per']==0){
    $cadena='<input type="hidden" name="perfil" id="perfil" value="0">';
    echo  $cadena;
    }

?>        