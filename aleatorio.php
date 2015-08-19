<?php

include("js/conec.php"); 
$conn=conectarse(); 
$archivo=fopen('passwordcoomeb.csv','a+');
$consulta='SELECT codigo,clave1 FROM clientes';
$usuarios=mysql_query($consulta);
$i=0;
$registro1='UPDATE clientes SET clave1="9048" WHERE codigo="1005149048"';
$actulizado=mysql_query($registro1); 
while($fila=mysql_fetch_array($usuarios)){
	$codigo=$fila['codigo'];
	$codigo=$codigo*2/2;
	$codigo=(string)$codigo;
	$clave=$fila['clave1'];
	$clave=($clave/2)*($clave/2);
	$clave=floor($clave);
	$clave=(string)$clave;
	$clave=substr($clave,0,8);
	if(strlen($clave)==4){
		$clave=$clave.'1404';
	}elseif(strlen($clave)==3){
		$clave=$clave.'02308';
	}elseif(strlen($clave)==2){
		$clave=$clave.'930414';
	}elseif(strlen($clave)==1){
		$clave=$clave.'1402308';
	}
	$cadena=$codigo.';'.$clave.PHP_EOL;
	fwrite($archivo,$cadena);

$actualizar='UPDATE clientes SET clave1='.$clave.' WHERE codigo='.$codigo.'';
$actulizado=mysql_query($actualizar);
}


/*$generador="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
$contraseña[0]=hash('md5',$generador);
$i=0;
$j=0;
for($i=0;$i<1306;$i++){
	$contraseña[$i+1]=hash('md5',$contraseña[$i]);
}
$i=0;
for($j=0;$j<count($contraseña);$j++){
	$pass[1]=iconv_substr($contraseña[$j],0,4);
	$pass[2]=iconv_substr($contraseña[$j],4,4);
	$pass[3]=iconv_substr($contraseña[$j],12,4);
	$pass[4]=iconv_substr($contraseña[$j],16,4);
	$pass[5]=iconv_substr($contraseña[$j],20,4);
	$pass[6]=iconv_substr($contraseña[$j],24,4);
	$pass[7]=iconv_substr($contraseña[$j],28,0);

	$clave1['clave1'][$i]=$pass[1];
	$clave1['clave1'][$i+1]=$pass[2];
	$clave1['clave1'][$i+2]=$pass[3];
	$clave1['clave1'][$i+3]=$pass[4];
	$clave1['clave1'][$i+4]=$pass[5];
	$clave1['clave1'][$i+5]=$pass[6];
	$clave1['clave1'][$i+6]=$pass[7];
$actualizar1='UPDATE clientes SET clave1='.$clave1['clave1'][$i].' WHERE codigo='.$cedula['codigo'][$i];
$actualizar2='UPDATE clientes SET clave1='.$clave1['clave1'][$i+1].' WHERE codigo='.$cedula['codigo'][$i+1];
$actualizar3='UPDATE clientes SET clave1='.$clave1['clave1'][$i+2].' WHERE codigo='.$cedula['codigo'][$i+2];
$actualizar4='UPDATE clientes SET clave1='.$clave1['clave1'][$i+3].' WHERE codigo='.$cedula['codigo'][$i+3];
$actualizar5='UPDATE clientes SET clave1='.$clave1['clave1'][$i+4].' WHERE codigo='.$cedula['codigo'][$i+4];
$actualizar6='UPDATE clientes SET clave1='.$clave1['clave1'][$i+5].' WHERE codigo='.$cedula['codigo'][$i+5];
$actualizar7='UPDATE clientes SET clave1='.$clave1['clave1'][$i+6].' WHERE codigo='.$cedula['codigo'][$i+6];

$actualizando1=mysql_query($actualizar1);
$actualizando2=mysql_query($actualizar2);
$actualizando3=mysql_query($actualizar3);
$actualizando4=mysql_query($actualizar4);
$actualizando5=mysql_query($actualizar5);
$actualizando6=mysql_query($actualizar6);
$actualizando7=mysql_query($actualizar7);
echo $clave1['clave1'][$i].'</br>'.$clave1['clave1'][$i+1].'</br>'.$clave1['clave1'][$i+2].'</br>'.$clave1['clave1'][$i+3].'</br>'.$clave1['clave1'][$i+4].'</br>'.$clave1['clave1'][$i+5].'</br>'.$clave1['clave1'][$i+6];
$i+7;

//echo $pass[1].' '.$pass[2].' '.$pass[3].' '.$pass[4].' '.$pass[5].' '.$pass[6].' '.$pass[7].'</br>';

}
*/


?>