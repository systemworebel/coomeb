<?PHP
include("js/conec.php"); 
$conn=conectarse(); 
$res=mysql_query("select * from tasas",$conn);
?>
<!DOCTYPE html>
<html>
<head>
<link media="screen" type="text/css" rel="stylesheet" href="css/bootstrap.css">
<link media="screen" type="text/css" rel="stylesheet" href="css/styleuser.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script>
function simular(){
	var linea = $( "#linea option:selected" ).val();
	var cuotas = $( "#cuotas option:selected" ).val();
	var monto = $("#monto").val();
	var res1 = parseFloat(linea) + 1;
	var res2 = Math.pow(res1,cuotas);
	var num = res2 * linea;
	var den = res2 - 1;
	var inter = num / den;
	var total = monto * inter;
	$('#mensual').empty();
	$('#mensual').append(' <input disabled="disabled" type="text" class="form-control" value="'+total+'" name="mensual" >');
}
</script>
<title>COOMEB - Simulador</title>
<meta charset="utf-8">
</head>
<body>  
<div class="container  efecto3 cont"> <!-- CONTENIDO -->
	<div class="row">
		<div id="frame" class="col-md-12">
			  <div class="form-group sim">
		        <label class="control-label col-md-5 col-sm-5" for="selectevento">Líneas de Credito:</label>
		        <div class="col-md-5 col-sm-5">
		            <select id='linea' name='linea' class="form-control" value= "Líneas de Credito">
						
						<?php
						while($fila=mysql_fetch_array($res)){
						?>
							<option value="<?php echo $fila['interes']; ?>"><?php echo $fila['nombre']." "; ?></option>
						<?php } ?>
					</select>
		        </div>
		      </div>	
			  <div class="form-group sim">
			    <label for="cedula" class="col-md-5 col-sm-5 control-label">Monto Solicitado:</label>
			    <div class="col-md-5 col-sm-5">
			      <input  type="text" class="form-control" id="monto" name="monto" placeholder="Monto">
			    </div>
			  </div>
			  <div class="form-group sim">
			    <label for="password" class="col-md-5 col-sm-5 control-label">Cuotas:</label>
			    <div class="col-md-5 col-sm-5">
			      <select id='cuotas' name='cuotas' class="form-control">
						<option value="1">1</option>
						<?php
						for($i='2' ; $i<='36' ; $i++){
						?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
					</select>
			    </div>
			  </div>
			  <div class="form-group sim">
			    <div class="col-md-5 col-sm-5">
			      <input type="button" onclick="simular();" value="Simular Cuota Mensual" class="btn btn-success">
			    </div>
			    <div  id="mensual" class="col-md-5 col-sm-5">
			    </div>
			  </div>
		</div>
	</div>
</div>
</body>
</html>
