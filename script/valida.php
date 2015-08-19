<?php
session_start();
include_once '../js/conec.php';
	$conn=conectarse(); 
	extract($_POST);
	$usuario = $_POST['cedula'];
	$clave = $_POST['clave'];
	if($usuario == '1234' || $usuario == '1111')
	{
	$sentencia = "SELECT * FROM admin WHERE codigo = '$usuario' AND clave = '$clave'";
	$val = 'atrue';
	$veri= 'admon';
	}
	else{
	$sentencia = "SELECT * FROM clientes WHERE codigo = '$usuario' AND clave1 = '$clave' ";
	$val = 'true';
	$veri= 'user';
	}
	$result = mysql_query($sentencia,$conn);
				while ($buscar = mysql_fetch_array($result))
				{
				$_SESSION['nombre'] = $buscar['nombre'];
				} 
	$nf = mysql_num_rows($result);
	if ($nf>0) {
		echo $val;
		$_SESSION['id']= $usuario;	
		$_SESSION['ver']= $veri;		
		}
	else{
		echo "false";
	}
	  
?>
