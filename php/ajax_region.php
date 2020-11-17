<?php 
require_once 'bd.php';

function getListasRep(){
  $mysqli = getConn();
  $query = 'SELECT * FROM `region`';
  $result = $mysqli->query($query);
  $listas = '<option value="0">Elige una region</option>';
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $listas .= "<option value='$row[id]'>$row[nombre]</option>";
  }
  return $listas;
}

echo getListasRep();