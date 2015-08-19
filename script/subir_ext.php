<?php
extract($_POST);
include("../js/conec.php"); 
$coneccion=mysql_connect('db543248245.db.1and1.com:3306', 'dbo543248245', 'M4SS1V4STUD10');
$basedatos=mysql_select_db('db543248245');
$ano=$_POST['anio'];
$mes=$_POST['mes'];
$string=(string) $mes.$ano;
$datte=(string) $ano."-".$mes."-31";
ini_set('max_execution_time',0); //300 seconds = 5 minutes 
$ruta="../../system/cp/";//ruta carpeta donde se carga el archivo
$ruta1="../../system/cp/";//ruta carpeta donde se carga el archivo
$uploadfile_temporal=$_FILES['archivoclientes']['tmp_name']; 
$uploadfile_nombre=$ruta.$_FILES['archivoclientes']['name']; 
$arc = $ruta1.$_FILES['archivoclientes']['name']; 
$uploadfile_temporal1=$_FILES['archivoahorros']['tmp_name']; 
$uploadfile_nombre1=$ruta.$_FILES['archivoahorros']['name']; 
$arc1 = $ruta1.$_FILES['archivoahorros']['name']; 
$uploadfile_temporal2=$_FILES['archivocartera']['tmp_name']; 
$uploadfile_nombre2=$ruta.$_FILES['archivocartera']['name']; 
$arc2 = $ruta1.$_FILES['archivocartera']['name']; 
if (is_uploaded_file($uploadfile_temporal) && is_uploaded_file($uploadfile_temporal1) && is_uploaded_file($uploadfile_temporal2) ) 
{ 
     move_uploaded_file($uploadfile_temporal,$uploadfile_nombre); 
	 move_uploaded_file($uploadfile_temporal1,$uploadfile_nombre1); 
	 move_uploaded_file($uploadfile_temporal2,$uploadfile_nombre2); 
} 
else{
 print ("No se ha podido subir el fichero");}

if($coneccion==TRUE and $basedatos==TRUE){
$linea=file($arc);
$i=0;
$sentencia='SELECT codigo FROM clientes';
$consultalo=mysql_query($sentencia);
while($fila=mysql_fetch_array($consultalo)){
	$cod[$i]=$fila['codigo'];
	$cod[$i]=str_replace(' ','',$cod[$i]);
	$i++;
}
$j=0;
$k=0;
$bandera='Not';
$datte=date('Y-m-d');
if($i>count($linea)){
for($j=0;$j<count($linea);$j++){
	$linea1=explode(',',$linea[$j]);
	for($k=0;$k<$i;$k++){
		$linea1[0]=str_replace(' ','',$linea1[0]);
		if($cod[$k]==$linea1[0]){
			$bandera='break';
		}
	
	}
	if($bandera=='break'){

		$sent1_ch='UPDATE clientes SET empresa="'.$linea1[9].'",direccion="'.$linea1[5].'",cargo="'.$linea1[3].'",telefono="'.$linea1[8].'",sueldo="'.$linea1[11].'" WHERE codigo="'.$linea1[0].'"';
		mysql_query($sent1_ch);
		//echo 'Yes</br>';
	}else{
				$w=0;
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
					$cad_ch = "";
					for($w=0;$w<6;$w++) {
					$cad_ch .= substr($str,rand(0,62),1);
					}
				$passnueva_ch=$cad_ch;
		$sent2_ch='INSERT INTO clientes (codigo,nombre_entidad,nombre,cargo,correo,direccion,expedicion,ciudad_residencia,telefono,empresa,direccion_empresa,sueldo,fecha_nacimiento,
			lugar_nacimiento,clave1,clave2,fecha_ingreso,fecha_corte) VALUES ("'.$linea1[0].'","'.$linea1[1].'","'.$linea1[2].'","'.$linea1[3].'","'.$linea1[4].'","'.$linea1[5].'","'.$linea1[6].'","'.$linea1[7].'",
			"'.$linea1[8].'","'.$linea1[9].'","'.$linea1[10].'","'.$linea1[11].'","'.$linea1[12].'","'.$linea1[13].'","'.$passnueva_ch.'","'.$linea1[15].'","'.$linea1[16].'","'.$datte.'")';

		mysql_query($sent2_ch);
		//echo 'Not</br>';
	}
$bandera='Not';
 }

}
fclose($archivo_ch);
if((int)$mes <10){
	$mes='0'.$mes;
}
$datte=$ano.'-'.$mes.'-31';
$datte=(string) $datte;
$sent1="CREATE TABLE IF NOT EXISTS aportes".$string." "."
(  `codigo` varchar(255) NOT NULL,
  `sucursal` varchar(255) NOT NULL,
  `linea` varchar(255) NOT NULL,
  `numero_cuenta` varchar(255) NOT NULL,
  `nombre_linea` varchar(255) NOT NULL,
  `saldo_inicial` varchar(255) NOT NULL,
  `consignacion` varchar(255) NOT NULL,
  `retiros` varchar(255) NOT NULL,
  `nuevo_saldo` varchar(255) NOT NULL,
  `fecha_corte` varchar(255) NOT NULL)";
$res1 = mysql_query($sent1)or die ('Error: '.mysql_error ());
$s1="TRUNCATE TABLE aportes".$string."";
$res10 = mysql_query($s1)or die ('Error: '.mysql_error ());


$fp2 = fopen($arc1,'r');
if (!$fp2) {echo 'ERROR: No ha sido posible abrir el archivo. Revisa su nombre y sus permisos.'; exit;}
$loop = 0; // contador de líneas
while (!feof($fp2)) { // loop hasta que se llegue al final del archivo
$loop++;
$f=0;
$line = fgets($fp2); // guardamos toda la línea en $line como un string
// dividimos $line en sus celdas, separadas por el caracter |
// e incorporamos la línea a la matriz $field
$field[$loop] = explode (',', $line);
$sentencia2= "INSERT INTO aportes".$string." (`codigo`, `sucursal`, `linea`, `numero_cuenta`, `nombre_linea`, `saldo_inicial`, `consignacion`, `retiros`, `nuevo_saldo`, `fecha_corte`) VALUES
('".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$datte."')";
$result2 = mysql_query($sentencia2)or die ('Error: '.mysql_error ());
$fp2++; // necesitamos llevar el puntero del archivo a la siguiente línea
}
fclose($fp2);

$sent1="CREATE TABLE IF NOT EXISTS cartera".$string." "."
	( `codigo` varchar(255) NOT NULL,
	  `sucursal` varchar(255) NOT NULL,
	  `tipo` varchar(255) NOT NULL,
	  `linea` varchar(255) NOT NULL,
	  `numero` varchar(255) NOT NULL,
	  `fecha_desembolso` date NOT NULL,
	  `fecha_vencimiento` date NOT NULL,
	  `plazo` varchar(255) NOT NULL,
	  `tasa` varchar(255) NOT NULL,
	  `saldo_anterior` varchar(255) NOT NULL,
	  `prestamos_nuevos` varchar(255) NOT NULL,
	  `abono_intereses` varchar(255) NOT NULL,
	  `abono_capital` varchar(255) NOT NULL,
	  `abono_mora` varchar(255) NOT NULL,
	  `abono_otros` varchar(255) NOT NULL,
	  `nuevo_saldo` varchar(255) NOT NULL,
	  `cuotas_pendientes` varchar(255) NOT NULL,
	  `fecha_corte` varchar(255) NOT NULL,
	  `descripcion_linea` varchar(255) NOT NULL)";
$res1 = mysql_query($sent1)or die ('Error: '.mysql_error ());
$s2="TRUNCATE TABLE cartera".$string."";
$res20 = mysql_query($s2)or die ('Error: '.mysql_error ());


$fp3 = fopen($arc2,'r');
if (!$fp3) {echo 'ERROR: No ha sido posible abrir el archivo. Revisa su nombre y sus permisos.'; exit;}
$loop = 0; // contador de líneas
while (!feof($fp3)) { // loop hasta que se llegue al final del archivo
$loop++;
$f=0;
$line = fgets($fp3); // guardamos toda la línea en $line como un string
// dividimos $line en sus celdas, separadas por el caracter |
// e incorporamos la línea a la matriz $field
$field[$loop] = explode (',', $line);
$sentencia3= "INSERT INTO cartera".$string." (`codigo`, `sucursal`, `tipo`, `linea`, `numero`, `fecha_desembolso`, `fecha_vencimiento`, `plazo`, `tasa`, `saldo_anterior`, `prestamos_nuevos`, `abono_intereses`, `abono_capital`, `abono_mora`, `abono_otros`, `nuevo_saldo`, `cuotas_pendientes`, `fecha_corte`, `descripcion_linea`) VALUES
('".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."')";
$result3 = mysql_query($sentencia3)or die ('Error: '.mysql_error ());
$fp3++; // necesitamos llevar el puntero del archivo a la siguiente línea
}
fclose($fp3);

echo "SUS EXTRACTOS HAN SIDO CARGADOS EXITOSAMENTE";
header("refresh:3;www.coomeb/system/admin.php");
}




?>