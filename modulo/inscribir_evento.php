<?php
session_start();
?>
<?PHP
include("../js/conec.php"); 
$conn=conectarse(); 
$sentencia = "SELECT * FROM evento";
$sqlbus =  mysql_query($sentencia,$conn);
$name=$_SESSION['nombre'];	
$id=$_SESSION['id'];
$fecha=date("Y-m-d");
$fechaa = strtotime("$fecha");
?>
<meta charset="utf-8">
<script>
$(document).ready( function() {
     var opciones= {
           success: function()
           {
	 			alert('Registro realizado correctamente');
	 			$('#esve').click();
				}	//funcion que se ejecuta una vez enviado el formulario
            };
             //asignamos el plugin ajaxForm al formulario myForm y le pasamos las opciones
    $('#forminsevento').ajaxForm(opciones) ; 
});
function control(){
$("#invitados").empty();
var cant = $('#seleccion option:selected').attr('id');
if(cant != '0')
{
$("#invitados").append("<div class='row as'><div class='col-md-5'><input name='nombre[]' type='text' class='form-control' placeholder='Nombre'></div><div class='col-md-3'><input name='documento[]' type='text' class='form-control' placeholder='Documento'></div><div class='col-md-1'><input name='edad[]' type='text' class='form-control' placeholder='Edad'></div></div>");
for ( var i = 1; i < cant ; i++ ) 
{
$("#invitados").append("<div class='row as'><div class='col-md-5 col-md-offset-3'><input name='nombre[]' type='text' class='form-control' placeholder='Nombre'></div><div class='col-md-3'><input name='documento[]' type='text' class='form-control' placeholder='Documento'></div><div class='col-md-1'><input name='edad[]' type='text' class='form-control' placeholder='Edad'></div></div>");
}
}
else
{
$("#invitados").append("<div class='col-md-5'>Este evento no permite invitados</div>");
}
} 
</script>
<form id="forminsevento" method="post" action="script/inscripcion.php"  class="form-horizontal">
		    	<fieldset>
		        <legend>Inscripción</legend>
		        <div class="form-group">
		        <input name="id" id="id" type="hidden" value="<?php echo $id;?>" />
			        <label class="control-label col-md-3" for="selectevento">Seleccione el evento:</label>
			        <div class="col-md-9">
			            <select name="opt" id="seleccion" class="form-control" onchange="control();">
			            <option selected="selected">Seleccione el evento al cual desea inscribirse</option>
			           <?php
			            while($row=mysql_fetch_array($sqlbus))
						{
						$i = $row['id'];
						$arr= $row['invitados'];
						$fechaeve=$row['fecha'];
						$fechae = strtotime("$fechaeve");
						
						$sentencia2 = "SELECT * FROM asistente where id_usuario='$id' and id_evento='$i'";
						$sqlbus2 =  mysql_query($sentencia2,$conn);
						$afectadas = mysql_num_rows($sqlbus2);
						if($afectadas=='0'){
							if($fechaa<$fechae){
						?>
						<option id="<?php echo $arr?>" value="<?php echo $i?>"><?php echo $row['nombre']?></option>
						<?php }}} ?>
						  
						</select>
			        </div>
			    </div>
		        <div id="n" class="form-group">
		            <label class="control-label col-md-3" for="firstName">Nombre:</label>
		            <div class="col-md-9">
		                <input type="text" class="form-control" value="<?php echo $name;?>" name="nombre" id="nombre" disabled="disabled">
		            </div>
		        </div>
		        <div class="form-group">
		            <label class="control-label col-md-3">Invitados:</label>
					  <div id="invitados" class="row">
							
					  </div>
		        </div>
		
		        <br>
		        <div class="form-group">
		            <div class="col-md-offset-2 col-md-9">
		                <input id="ins" type="submit" class="btn btn-success" value="Inscribirse" >
		                <input id="rst" type="reset" class="btn btn-danger" value="Restablecer" >
		            </div>
		        </div>
		        </fieldset>
	    	</form>