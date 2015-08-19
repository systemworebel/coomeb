<script>
$(document).ready(function() {
   $("#consul").click(function(event) {
	if($("select#mes").val()== '' || $("select#anio").val()== ''){
  	event.preventDefault();
  	alert('Debes seleccionar una fecha');
  	}

}); 
});
function validate(formData, jqForm, options) { 
			if ($('select#anio').val() == '' || $('select#mes').val() == '') {
         		alert('Debe Seleccionar una fecha correspondiente al extracto');
				return false; 
			}
}
</script>
<form method="post" action="modulo/pdf.php" id="formverextracto"  class="form-horizontal">
	<fieldset>
    <legend>Exportar Extracto</legend>
	<div class="form-group">
        <select name="mes" id="mes" class="form-control">
            <option value="" selected="selected">Seleccione el Mes</option>
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
			</select>
	</div>
	<div class="form-group">
        <select name="anio" id="anio" class="form-control">
            <option value="" selected="selected">Seleccione el Año</option>
            <?php
            for ($i=2010; $i<=2020; $i++) {
			   echo "<option value='$i'>$i</option>";
			} 
			?>
			</select>
	</div>
    <div class="form-group">
        <div class="col-md-offset-1 col-md-9">
        	<input id="consul" type="submit" class="btn btn-success" value="Generar PDF" >
            <input id="rst" type="reset" class="btn btn-danger" value="Restablecer" >
        </div>
    </div>
    </fieldset>
</form>