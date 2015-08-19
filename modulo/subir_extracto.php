<script>
$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});
$(document).ready( function() {
     var opciones= {
     		beforeSubmit: validate, //funcion que se ejecuta antes de enviar el form
           success: function()
           {
	 			alert('Base de datos Actualizada Correctamente');
	 			$( "span#btn1" ).removeClass( "btn-danger" ).addClass( "btn-primary" );
	         	$( "span#btn2" ).removeClass( "btn-danger" ).addClass( "btn-primary" );
	         	$( "span#btn3" ).removeClass( "btn-danger" ).addClass( "btn-primary" );
	 			$('#rst').click();
	 			$("#act").val("Enviar");
				}	//funcion que se ejecuta una vez enviado el formulario
            };
             //asignamos el plugin ajaxForm al formulario myForm y le pasamos las opciones
    $('#formextracto').ajaxForm(opciones) ; 
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) 
    {
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }    
    });
});
function validate(formData, jqForm, options) { 
         	$("#act").val("Cargando... POR FAVOR ESPERE");
         	if ($('input#archivoclientes').val() == '' && $('input#archivoahorros').val() == '' && $('input#archivocartera').val() == '')
         	{
         	alert('Debe cargar los archivos requeridos antes de continuar');
         	$( "span#btn1" ).removeClass( "btn-primary" ).addClass( "btn-danger" );
         	$( "span#btn2" ).removeClass( "btn-primary" ).addClass( "btn-danger" );
         	$( "span#btn3" ).removeClass( "btn-primary" ).addClass( "btn-danger" );
         	$("#act").val("Enviar");
         	return false; 
         	}
			if ($('input#archivoclientes').val() == '') {
         		  alert('- Debe cargar los archivos requeridos antes de continuar');
				$( "span#btn1" ).removeClass( "btn-primary" ).addClass( "btn-danger" );
				$("#act").val("Enviar");
				return false; 
			}
			if ($('input#archivoahorros').val() == '') {
         		alert('Debe cargar los archivos requeridos antes de continuar');
				$( "span#btn2" ).removeClass( "btn-primary" ).addClass( "btn-danger" );
				$("#act").val("Enviar");
				return false; 
			}
			if ($('input#archivocartera').val() == '') {
         		alert('Debe cargar los archivos requeridos antes de continuar');
				$( "span#btn3" ).removeClass( "btn-primary" ).addClass( "btn-danger" );
				$("#act").val("Enviar");
				return false; 
			}
			if ($('select#anio').val() == '' || $('select#mes').val() == '') {
         		alert('Debe Seleccionar una fecha correspondiente al extracto');
				$("#act").val("Enviar");
				return false; 
			}

}
</script>
</script>
<div class="bs-example">
    <form id="formextracto" method="post" action="script/subir_ext.php" enctype="multipart/form-data" class="form-horizontal">
       	<fieldset>
        <legend>Cargar Información de Extractos</legend>
        <div class="form-group">
            <label class="control-label col-md-2" for="firstName">Fecha:</label>
            <div class="col-md-3">
				<div class="input-group">
	                <select name="mes" id="mes" class="form-control" onchange="control();">
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
       	 	</div>
       	 	<div class="col-md-3">
				<div class="input-group">
	                <select name="anio" id="anio" class="form-control" onchange="control();">
			            <option value="" selected="selected">Seleccione el Año</option>
			            <?php
			            for ($i=2010; $i<=2020; $i++) {
						   echo "<option value='$i'>$i</option>";
						} 
						?>
						</select>
            	</div>
       	 	</div>
		</div>
            <div id="n" class="form-group">
            <label class="control-label col-md-2" for="firstName">Archivo Clientes:</label>
            <div class="col-md-9">
				<div class="input-group">
	                <span class="input-group-btn">
	                    <span id="btn1" class="btn btn-primary btn-file">
	                        Seleccionar Archivo Clientes <input type="file" name="archivoclientes" id="archivoclientes">
	                    </span>
	                </span>
	                <input type="text" class="form-control" readonly>
            	</div>
       	 	</div>
		</div>
		<div id="n" class="form-group">
            <label class="control-label col-md-2" for="firstName">Archivo Ahorros:</label>
            <div class="col-md-9">
				<div class="input-group">
	                <span class="input-group-btn">
	                    <span id="btn2" class="btn btn-primary btn-file">
	                        Seleccionar Archivo Ahorros <input type="file" name="archivoahorros" id="archivoahorros">
	                    </span>
	                </span>
	                <input type="text" class="form-control" readonly>
            	</div>
       	 	</div>
		</div>
		<div id="n" class="form-group">
            <label class="control-label col-md-2" for="firstName">Archivo Cartera:</label>
            <div class="col-md-9">
				<div class="input-group">
	                <span class="input-group-btn">
	                    <span id="btn3" class="btn btn-primary btn-file">
	                        Seleccionar Archivo Cartera <input type="file" name="archivocartera" id="archivocartera">
	                    </span>
	                </span>
	                <input type="text" class="form-control" readonly>
            	</div>
       	 	</div>
		</div>
        <br>
        <div class="form-group">
            <div class="col-md-offset-1 col-md-9">
                <input id="act" type="submit" class="btn btn-success" value="Enviar" >
                <input id="rst" type="reset" class="btn btn-danger" value="Restablecer" >
            </div>
        </div>
        </fieldset>
    </form>
</div>