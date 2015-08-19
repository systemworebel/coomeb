<html>
<head><title>COOMEB</title><meta charset="utf-8"></head>
<body>
<?php
session_start();
include("js/conec.php"); 
$conn=conectarse(); 
$cedula1=$_POST['cedula'];
$contraseña=$_POST['contraseña'];
$newpass=$_POST['nueva_contraseña'];
$newpass2=$_POST['nueva_contraseña2'];
$cedula1=str_replace(' ','',$cedula1);
$contraseña=str_replace(' ','',$contraseña);
$newpass=str_replace(' ','',$newpass);
$newpass2=str_replace(' ','',$newpass2);
$i=0;
$sentencia=mysql_query('SELECT codigo,clave1 FROM clientes');
while($fila=mysql_fetch_array($sentencia)){
	$cedula[$i]=$fila['codigo'];
	$clave1[$i]=$fila['clave1'];
	$cedula[$i]=str_replace(' ','',$cedula[$i]);
	$clave1[$i]=str_replace(' ','',$clave1[$i]);

	if($cedula[$i]==$cedula1 and $clave1[$i]==$contraseña){
		$ban1='yes';
		$index_clave=$i;
		break;
	}else{
		$ban1='not';
	
	}
$i++;	

}

if($newpass==$newpass2){

	if($ban1=='yes'){
		$sentencia3='UPDATE clientes SET clave1="'.$newpass.'",clave2="'.$clave1[$index_clave].'" WHERE codigo="'.$cedula[$index_clave].'" and clave1="'.$clave1[$index_clave].'"';
		mysql_query($sentencia3);
		
		echo '<script language="javascript">alert("Todo fue un Exito!");document.location=("index.php");</script>'; 
		//header('Location: index.php');
	}else{
		
		echo '<script language="javascript">alert("Este usuario no existe en la base de datos");document.location=("coomebsolu.php");</script>'; 
		//header('Location: coomebsolu.php');
	}

}else{
	
	echo '<script language="javascript">alert("Por favor, debe ingresar la nueva contraseña correctamente");document.location=("coomebsolu.php");</script>'; 
	//header('Location: coomebsolu.php');
}

?>
</body>
</html>