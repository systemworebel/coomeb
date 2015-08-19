<?php
				extract($_POST);
				include("../js/conec.php"); 
				$conn=conectarse(); 
				$id=$_POST['id'];
				$evento=$_POST['opt'];
				$sentencia = "INSERT INTO asistente (id_usuario,id_evento) VALUES ('$id','$evento')";
				$sqlcrea =  mysql_query($sentencia,$conn);
				$ins = mysql_insert_id();
				$i= '0';
				foreach($_POST['nombre'] as $nom)
				{
				$i++;	
				  $arrn[$i]= $nom;
				}
				$h= '0';
				foreach($_POST['documento'] as $doc)
				{
				$h++;	
				  $arrd[$h]= $doc;
				}
				$j= '0';
				foreach($_POST['edad'] as $ed)
				{
				$j++;	
				  $arre[$j]= $ed;
				}
				for ($k = 1; $k <= $i; $k++) {
					if($arrn[$k] != '' && $arrd[$k] != '' && $arre[$k] != '' ){
				    $sentencia = "INSERT INTO invitado (id_asistente,nombre,edad,documento) VALUES ('$ins','$arrn[$k]','$arre[$k]','$arrd[$k]')";
					$sqlcrea =  mysql_query($sentencia,$conn);
					}
				}
?>