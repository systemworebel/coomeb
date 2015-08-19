<?php
				extract($_POST);
				include("../js/conec.php"); 
				$conn=conectarse(); 
				$nom=$_POST['nombre'];
				$veri=$_POST['veri'];
				$can=$_POST['cant'];
				$fecha=$_POST['fecha'];
				$val=$_POST['val'];
				$v=$_POST['v'];
				if($veri =="no")
				{
					$can="0";
				}
				if($val != '')
				{
					if($v == 'no'){
				$sentencia = "UPDATE evento SET nombre='$nom', invitados='$can' WHERE id='$val'";	
					}else{
						$sentencia = "UPDATE evento SET nombre='$nom', invitados='$can',fecha='$fecha' WHERE id='$val'";	
					}
				}
				else
				{
				$sentencia = "INSERT INTO evento (nombre,invitados,fecha) VALUES ('$nom','$can','$fecha')";
				}
				$sqlcrea =  mysql_query($sentencia,$conn);
?>