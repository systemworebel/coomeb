<?PHP
session_start();
include("../js/conec.php"); 
$conn=conectarse(); 
$res=mysql_query("select * from evento",$conn);
?>
<script>
function load(str)
{
var xmlhttp;

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("cuerpoeven").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","modulo/edicion_evento.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("q="+str);
}
</script>
<fieldset>
	<legend>Editar Evento</legend>
	<div class="form-group row">
        <label class="control-label col-md-3 selecevento" for="selectevento">Seleccione el evento:</label>
        <div class="col-md-9">
            <select class="form-control"  onchange="load(this.value)">
				<option value="">Seleccione un Evento</option>
				<?php
				while($fila=mysql_fetch_array($res)){
				?>
					<option value="<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></option>
				<?php } ?>
			</select>
        </div>
    </div>	
	<div id="cuerpoeven" class="form-group cuev">

	</div>
</fieldset>