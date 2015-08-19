<?php
function conectarse() 
{ 
   $conn=mysql_connect('db543248245.db.1and1.com:3306', 'dbo543248245', '89rfvcde_') or die('No se pudo conectar: ' . mysql_error());
		mysql_select_db('db543248245',$conn) or die('No se pudo seleccionar la base de datos');
  return $conn;
} 
?>

