<?php
session_start();
extract($_POST);
header('Content-Type: text/html; charset=UTF-8'); 
$conn=mysql_connect('db543248245.db.1and1.com:3306', 'dbo543248245', '89rfvcde_') or die('No se pudo conectar: ' . mysql_error()); mysql_select_db('db543248245',$conn) or die('No se pudo seleccionar la base de datos');
$ano=$_POST['anio'];
$mes=$_POST['mes'];
$id=$_SESSION['id'];
require_once("dom/dompdf_config.inc.php");
ob_start();
?>
<?PHP
$tot1='0';
$tot2='0';
$result = mysql_query("show tables like 'aportes".$mes.$ano."'",$conn);
$existe = mysql_num_rows($result);
$sentencia1 = "SELECT * FROM aportes".$mes.$ano." where codigo='$id'";
$sqlbus1 =  mysql_query($sentencia1,$conn);
$sentencia2 = "SELECT * FROM cartera".$mes.$ano." where codigo='$id'";
$sqlbus2 =  mysql_query($sentencia2,$conn);
$sentencia = "SELECT * FROM clientes where codigo='$id'";
$sqlbus =  mysql_query($sentencia,$conn);
$sentencia3="SELECT fecha_corte FROM aportes".$mes.$ano." where codigo='$id'";
$sqlbus3=mysql_query($sentencia3,$conn);
while($row12=mysql_fetch_array($sqlbus3)){
   $var6=$row12['fecha_corte'];
}
    while($row2=mysql_fetch_array($sqlbus))
	{
		$name=$row2['nombre'];	
		$var1=$row2['cargo'];
		$var2=$row2['direccion'];
		$var3=$row2['telefono'];
		$var4=$row2['empresa'];
		$var5=$row2['sueldo'];
	}
$fecha=date("Y-m-d");
?>
<html>
<head>
</head>
<?php if($existe>'0'){ ?>
<body style="font-size: 12px;">
<table style="width:100%;border:0;text-align: center;">
   <tr>
      <td style="font-weight: bold;">COOMEB LTDA</td><td rowspan="3"><img style="width:400%;" src="../img/coomeb.png" alt="Logo"></td>
   </tr>
   <tr>
      <td>EXTRACTO GENERAL DE ASOCIADOS</td>
   </tr>
   <tr>
      <td>Fecha de Corte: <?php echo $var6; ?></td>
   </tr>
</table>
<table style="width:100%;border:0;margin-top: 20px;">
   <tr>
      <td style="width:10%;text-align: right; font-weight: bold;">Cédula:</td><td style="width:35%;text-align: left;"><?php echo $id; ?></td><td style="width:5%;text-align: right;font-weight: bold;">Nombre:</td><td style="width:50%;text-align: left;"><?php echo $name; ?></td>
   </tr>
   <tr>
      <td style="width:10%;text-align: right;font-weight: bold;">Empresa:</td><td style="width:35%;text-align: left;"><?php echo $var4; ?></td><td style="width:5%;text-align: right;font-weight: bold;">Entidad:</td><td style="width:50%;text-align: left;">COOMEB</td>
   </tr>
   <tr>
      <td style="width:10%;text-align: right;font-weight: bold;">Dirección:</td><td style="width:35%;text-align: left;"><?php echo utf8_encode($var2); ?></td><td style="width:5%;text-align: right;font-weight: bold;">Teléfono:</td><td style="width:50%;text-align: left;"><?php echo $var3; ?></td>
   </tr>
   <tr>
      <td style="width:10%;text-align: right;font-weight: bold;">Contrato:</td><td style="width:35%;text-align: left;"><?php echo $var1; ?></td><td style="width:5%;text-align: right;font-weight: bold;">Salario:</td><td style="width:50%;text-align: left;"><?php echo number_format($var5); ?></td>
   </tr>

</table>
<table style="width:100%;border:0;text-align: center; margin: 30px 0 5px 0;">
   <tr>
      <td style="font-weight: bold;font-size: 1.5em;">CARTERA</td>
   </tr>
</table>
<table rules="all"  Border=1  style="width:100%;text-align: center; margin: 20px 0;">
<thead>
   <tr>
      <th style="font-weight: bold;">LINEA</th>
      <th style="font-weight: bold;">DESCRIPCIÓN</th>
      <th style="font-weight: bold;">CÓDIGO</th>
      <th style="font-weight: bold;">CRÉDITO INICIAL</th>
      <th style="font-weight: bold;">FECHA DE DESEMBOLSO</th>
      <th style="font-weight: bold;">CUOTAS PENDIENTES</th>
      <th style="font-weight: bold;">ABONO CAPITAL</th>
      <th style="font-weight: bold;">INTERESES/ OTROS</th>
      <th style="font-weight: bold;">VALOR CUOTA</th>
      <th style="font-weight: bold;">SALDO CAPITAL</th>
   </tr>
</thead>
<tbody>
   <?PHP while($row=mysql_fetch_array($sqlbus2)){ 
   $var7=$row['linea'];
   $var8=$row['descripcion_linea'];
   $var9=$row['numero'];
   $var10=$row['saldo_anterior']/100;
   $var11=$row['fecha_desembolso'];
   $var12=$row['cuotas_pendientes']*1;
   $var13=$row['abono_capital']/100;
   $var14=$row['abono_intereses']/100;
   $var15=$var13+$var14;
   $var16=$row['nuevo_saldo']/100;
   $tot1=$tot1+$var15;
   $tot2=$tot2+$var16;
   ?>
   	  <tr>
      <td style=""><?php echo $var7; ?></td>
      <td style=""><?php echo $var8; ?></td>
      <td style=""><?php echo $var9; ?></td>
      <td style=""><?php echo number_format($var10); ?></td>
      <td style=""><?php echo $var11; ?></td>
      <td style=""><?php echo $var12; ?></td>
      <td style=""><?php echo number_format($var13); ?></td>
      <td style=""><?php echo number_format($var14); ?></td>
      <td style=""><?php echo number_format($var15); ?></td>
      <td style=""><?php echo number_format($var16); ?></td>
   </tr>
   <?php }?>
   
   <tr>
   	  <td colspan="7"></td> 
   	  <td style="font-weight: bold;">Total: </td>
   	  <td style="font-weight: bold;"><?php echo number_format($tot1); ?></td>
   	  <td style="font-weight: bold;"><?php echo number_format($tot2); ?></td>
   </tr>
</tbody>
</table>
<table style="width:100%;border:0;text-align: center; margin: 30px 0 5px 0;">
   <tr>
      <td style="font-weight: bold; font-size: 1.5em;">APORTES</td>
   </tr>
</table>
<table rules="all" border=1 style="width:100%;text-align: center; margin: 20px 0;">
   <thead>
   <tr>
      <th style="font-weight: bold;">FECHA</th>
      <th style="font-weight: bold;">DESCRIPCIÓN</th>
      <th style="font-weight: bold;">APORTE MENSUAL</th>
      <th style="font-weight: bold;">SALDO</th>
   </tr>
   </thead>
   <tbody>
   <?PHP 
   while($row1=mysql_fetch_array($sqlbus1)){ 
   $var17=$row1['fecha_corte'];
   $var18=$row1['nombre_linea'];
   $var19=$row1['consignacion']/100;
   $var20=$row1['nuevo_saldo']/100;
   ?> <tr>
      <td style=""><?php echo $var17; ?></td>
      <td style=""><?php echo $var18; ?></td>
      <td style=""><?php echo number_format($var19); ?></td>
      <td style=""><?php echo number_format($var20); ?></td>
      </tr>
    <?php }?>
   </tbody>
</table>
<?php }else{ ?>
<h1>No existe Información para la fecha elegida.</h1>
<?php } ?>
</body>
</html>
<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->set_paper("A4");
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("Extracto.pdf");
?>
