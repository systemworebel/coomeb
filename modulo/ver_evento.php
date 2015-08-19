<?PHP
session_start();
include("../js/conec.php"); 
$conn=conectarse(); 
$res=mysql_query("select * from evento",$conn);
$_SESSION['evento']='';
?>
<script>
$(document).ready(function(e){ 
$("#ejec").click(function(event) {
	if($("#eventos").val()== ''){
  	event.preventDefault();}
}); 
}); 
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
    document.getElementById("cuerpotable").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","modulo/table.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("q="+str);
}
</script>
<div class="excel "><a id="ejec" href="script/exporta_excel.php"><img src="img/exp.png"/> Exportar </a></div>
<fieldset>
	<legend>Asistentes</legend>
	<div class="form-group">
        <label class="control-label col-md-3" for="selectevento">Seleccione el evento:</label>
        <div class="col-md-9">
            <select id='eventos' name='eventos' class="form-control"  onchange="load(this.value)">
				<option value="">Seleccione un Evento</option>
				<?php
				while($fila=mysql_fetch_array($res)){
				?>
					<option value="<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></option>
				<?php } ?>
			</select>
        </div>
    </div>	
	<div id="tabla_asis" class="tabla_asistentes">
	<table class="table table-hover table-condensed ">
	 	<thead>
	        <tr>
	            <th class="cen">Cédula</th>
	            <th class="cen">Nombre</th>
	            <th class="cen">Correo</th>
	            <th class="cen">Teléfono</th>
	            <th class="cen">Invitados</th>
	        </tr>
	    </thead>
	    <tbody id="cuerpotable">
	    </tbody>
    </table>	
	</div>
</fieldset>