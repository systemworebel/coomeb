<?PHP
session_start();
include("../js/conec.php"); 
$conn=conectarse(); 
$res=mysql_query("select * from tasas",$conn);
?>
<script>
$(document).ready( function() {
     var opciones1= {
     		beforeSubmit: validate, //funcion que se ejecuta antes de enviar el form
           success: function()
           {
	 			alert('Tasa de interes creada correctamente');
	 			$('#admtasas').click();
				}	//funcion que se ejecuta una vez enviado el formulario
            };
    var opciones2= {
       success: function()
       {
 			alert('Datos Actualizados correctamente');
 			$('#admtasas').click();
			}	//funcion que se ejecuta una vez enviado el formulario
        };
             //asignamos el plugin ajaxForm al formulario myForm y le pasamos las opciones
    $('#formcreatasa').ajaxForm(opciones1); 
    $('#formeditasa').ajaxForm(opciones2); 
});
function validate(formData, jqForm, options) { 
			if ($('input#ntasa').val() == '') {
         		  alert('Debe especificar el nombre de la Tasa');
				return false; 
			}
			if ($('input#vtasa').val() == '') {
         		alert('Debe especificar el Valor de la Tasa');
				return false; 
			}
}
</script>
<div class="bs-example">
    <form id="formcreatasa" method="post" action="script/agrega_tasas.php" enctype="multipart/form-data" class="form-horizontal">
       	<fieldset>
        <legend>Crear Nueva Tasa de Interes</legend>
        <input type="hidden" id="verif" name="verif" value="1" />
        <div id="n" class="form-group">
	            <label class="control-label col-md-3" for="firstName">Nombre de la Tasa:</label>
	        <div class="col-md-9">
	            <input type="text" class="form-control" name="ntasa" id="ntasa" placeholder="Nombre de la Tasa">
	        </div>
       	</div>
		<div id="n" class="form-group">
            <label class="control-label col-md-3" for="firstName">Valor del Interes:</label>
	        <div class="col-md-9">
	            <input type="text" class="form-control" name="vtasa" id="vtasa" placeholder="Valor del Interes">
	        </div>
		</div>
        <br>
        <div class="form-group">
            <div class="col-md-offset-1 col-md-9">
                <input id="act" type="submit" class="btn btn-success" value="Crear" >
                <input id="rst" type="reset" class="btn btn-danger" value="Restablecer" >
            </div>
        </div>
        </fieldset>
    </form>
</div>

<div class="bs-example">
    <form id="formeditasa" method="post" action="script/agrega_tasas.php" enctype="multipart/form-data" class="form-horizontal">
       	<fieldset>
        <legend>Modificar Tasa de Interes</legend>
		<?php
		$i='0';
		while($fila=mysql_fetch_array($res)){
			$i++;
		?>	<input type="hidden" id="verif" name="verif" value="0" />
			<input type="hidden" id="<?php echo "id".$i;?>" name="<?php echo "id".$fila['id']; ?>" value="<?php echo $fila['id']; ?>" />
			<div id="as" class="form-group">
	            <label class="control-label col-md-3" for="firstName">Nombre de la Tasa:</label>
	        <div class="col-md-3">
	            <input type="text" class="form-control" name="<?php echo "name".$i;?>" id="<?php echo "name".$i;?>" value="<?php echo $fila['nombre']; ?>"> 
	        </div>
	            <label class="control-label col-md-3" for="firstName">Valor del Interes:</label>
		        <div class="col-md-2">
		            <input type="text" class="form-control" name="<?php echo "valor".$i;?>" id="<?php echo "valor".$i;?>" value="<?php echo $fila['interes']; ?>">
		        </div>
			</div>
		<?php } ?>
			<input type="hidden" id="i" name="i" value="<?php echo $i; ?>" />
        <br>
        <div class="form-group">
            <div class="col-md-offset-1 col-md-9">
                <input id="act" type="submit" class="btn btn-success" value="Guardar Cambios" >
                <input id="rst" type="reset" class="btn btn-danger" value="Restablecer" >
            </div>
        </div>
        </fieldset>
    </form>
</div>