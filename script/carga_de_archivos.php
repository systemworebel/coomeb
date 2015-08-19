<?PHP
extract($_POST);
include("../js/conec.php");
ini_set('max_execution_time', 300); //300 seconds = 5 minutes 
$conn=mysql_connect('db543248245.db.1and1.com:3306', 'dbo543248245', 'M4SS1V4STUD10') or die('No se pudo conectar: ' . mysql_error());
		mysql_select_db('db543248245',$conn) or die('No se pudo seleccionar la base de datos');
$ano=$_POST['anio'];
$mes=$_POST['mes'];
$aportes="aportes".$mes.$ano;
$cartera="aportes".$mes.$ano;
$datte=$ano."-".$mes."-31";
$ruta="../cp/";//ruta carpeta donde se carga el archivo
$ruta1="../cp/";//ruta carpeta donde se carga el archivo
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

$sss="truncate table clientes";
$rrrr=mysql_query($sss,$conn)or die ('Error: '.mysql_error ());

$fp = fopen($arc,'r');
if (!$fp) {echo 'ERROR: No ha sido posible abrir el archivo. Revisa su nombre y sus permisos.'; exit;}
$loop = 0; // contador de líneas
while (!feof($fp)) { // loop hasta que se llegue al final del archivo
$loop++;
$f=0;
$line = fgets($fp); // guardamos toda la línea en $line como un string
// dividimos $line en sus celdas, separadas por el caracter |
// e incorporamos la línea a la matriz $field
$field[$loop] = explode (',', $line);
$sentencia1= "INSERT INTO `clientes` (`codigo`, `nombre_entidad`, `nombre`, `cargo`, `correo`, `direccion`, `expedicion`, `ciudad_residencia`, `telefono`, `empresa`, `direccion_empresa`, `sueldo`, `fecha_nacimiento`, `lugar_nacimiento`, `clave1`, `clave2`, `fecha_ingreso`, `fecha_corte`) VALUES
('".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$datte."')";
$result1 = mysql_query($sentencia1,$conn)or die ('Error: '.mysql_error ());
$fp++; // necesitamos llevar el puntero del archivo a la siguiente línea
}
fclose($fp);

$sent1="CREATE TABLE IF NOT EXISTS $aportes
(  `codigo` varchar(255) NOT NULL,
  `sucursal` varchar(255) NOT NULL,
  `linea` varchar(255) NOT NULL,
  `numero_cuenta` varchar(255) NOT NULL,
  `nombre_linea` varchar(255) NOT NULL,
  `saldo_inicial` varchar(255) NOT NULL,
  `consignacion` varchar(255) NOT NULL,
  `retiros` varchar(255) NOT NULL,
  `nuevo_saldo` varchar(255) NOT NULL,
  `fecha_corte` date NOT NULL)";
$res1 = mysql_query($sent1,$conn)or die ('Error: '.mysql_error ());
$s1="TRUNCATE TABLE $aportes";
$res10 = mysql_query($s1,$conn)or die ('Error: '.mysql_error ());


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
$sentencia2= "INSERT INTO $aportes (`codigo`, `sucursal`, `linea`, `numero_cuenta`, `nombre_linea`, `saldo_inicial`, `consignacion`, `retiros`, `nuevo_saldo`, `fecha_corte`) VALUES
('".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$datte."')";
$result2 = mysql_query($sentencia2,$conn)or die ('Error: '.mysql_error ());
$fp2++; // necesitamos llevar el puntero del archivo a la siguiente línea
}
fclose($fp2);

$sent1="CREATE TABLE IF NOT EXISTS $cartera
	( `codigo` varchar(255) NOT NULL,
	  `sucursal` varchar(255) NOT NULL,
	  `tipo` varchar(255) NOT NULL,
	  `linea` varchar(255) NOT NULL,
	  `numero` varchar(255) NOT NULL,
	  `fecha_desembolso` date NOT NULL,
	  `fecha_vencimiento` date NOT NULL,
	  `plazo` varchar(255) NOT NULL,
	  `tasa` int(11) NOT NULL,
	  `saldo_anterior` int(11) NOT NULL,
	  `prestamos_nuevos` int(11) NOT NULL,
	  `abono_intereses` int(11) NOT NULL,
	  `abono_capital` int(11) NOT NULL,
	  `abono_mora` int(11) NOT NULL,
	  `abono_otros` int(11) NOT NULL,
	  `nuevo_saldo` int(11) NOT NULL,
	  `cuotas_pendientes` int(11) NOT NULL,
	  `fecha_corte` date NOT NULL,
	  `descripcion_linea` varchar(255) NOT NULL)";
$res1 = mysql_query($sent1,$conn)or die ('Error: '.mysql_error ());
$s2="TRUNCATE TABLE $cartera";
$res20 = mysql_query($s2,$conn)or die ('Error: '.mysql_error ());


$fp2 = fopen($arc2,'r');
if (!$fp2) {echo 'ERROR: No ha sido posible abrir el archivo. Revisa su nombre y sus permisos.'; exit;}
$loop = 0; // contador de líneas
while (!feof($fp2)) { // loop hasta que se llegue al final del archivo
$loop++;
$f=0;
$line = fgets($fp2); // guardamos toda la línea en $line como un string
// dividimos $line en sus celdas, separadas por el caracter |
// e incorporamos la línea a la matriz $field
$field[$loop] = explode (',', $line);
$sentencia3= "INSERT INTO $cartera (`codigo`, `sucursal`, `tipo`, `linea`, `numero`, `fecha_desembolso`, `fecha_vencimiento`, `plazo`, `tasa`, `saldo_anterior`, `prestamos_nuevos`, `abono_intereses`, `abono_capital`, `abono_mora`, `abono_otros`, `nuevo_saldo`, `cuotas_pendientes`, `fecha_corte`, `descripcion_linea`) VALUES
('".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."', '".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."','".$field[$loop][$f++]."')";
$result3 = mysql_query($sentencia3,$conn)or die ('Error: '.mysql_error ());
$fp2++; // necesitamos llevar el puntero del archivo a la siguiente línea
}
fclose($fp2);

echo "exito!";


?>
