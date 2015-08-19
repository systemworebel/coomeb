<?php
				extract($_POST);
				include("../js/conec.php"); 
				$conn=conectarse(); 
				$valor=$_POST['verif'];
				if($valor=='0')
				{
				$f=$_POST['i'];	
				$s1="TRUNCATE TABLE tasas";
				$res10 = mysql_query($s1,$conn)or die ('Error: '.mysql_error ());
				for ($i = 1; $i <= $f; $i++) 
				{
				$nom=$_POST["name".$i];
				$veri=$_POST["valor".$i];
				$sentencia = "INSERT INTO tasas (nombre,interes) VALUES('$nom','$veri')";
				$sqlcrea =  mysql_query($sentencia,$conn);
				}
				}
				else
				{
				$nom=$_POST['ntasa'];
				$veri=$_POST['vtasa'];
				$sentencia = "INSERT INTO tasas (nombre,interes) VALUES ('$nom','$veri')";
				$sqlcrea =  mysql_query($sentencia,$conn);
				}
				
?>