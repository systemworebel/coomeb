<?php
function conectarse() 
{ 
   $conn=mysql_connect('localhost', 'root', '') or die('No se pudo conectar: ' . mysql_error());
		mysql_select_db('coomeb',$conn) or die('No se pudo seleccionar la base de datos');
  return $conn;
} 
?>

