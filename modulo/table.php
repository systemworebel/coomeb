<?php
session_start();
include("../js/conec.php"); 
$q=$_POST['q'];
$_SESSION['evento']=$q;
$conn=conectarse(); 
if($q!=''){
$res1=mysql_query("select * from asistente where id_evento=$q",$conn);
?>

    	<tr>
    	<?php
			while($filas=mysql_fetch_array($res1)){
				$id=$filas['id_usuario'];
				$asis=$filas['id_asistente'];
				$res2=mysql_query("select * from clientes where codigo=$id",$conn);
				while($filas2=mysql_fetch_array($res2)){
					$res3=mysql_query("select * from invitado where id_asistente=$asis",$conn);
		?>
		<tr>
            <td><?php echo $id;?></td>       
            <td><?php echo $filas2['nombre'];?></td>
            <td><?php echo $filas2['correo'];?></td>
            <td><?php echo $filas2['telefono'];?></td>
             <td>
             <?php  while($filas3=mysql_fetch_array($res3)){ ?>
              <div class="invit">
              <?php echo "<e>Nombre: </e>".$filas3['nombre'];?><br> <?php echo "<e>Edad:</e> ".$filas3['edad'];?><br><?php echo "<e>Documento: </e>".$filas3['documento'];?><br>
              </div>
             <?php } ?>
             </td>
        </tr>
        <?php }}} ?>
