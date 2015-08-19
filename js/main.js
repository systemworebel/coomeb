$(document).ready(function(e){ //Funciones de inicio
$('.drop-hover').dropdownHover();//Crea efecto hover en lista desplegable
});


function cantidad(sel){ //Control de input cantidad de invitados
  if(sel.value=="si") {
      $("#cantidad").show();
   } else {
     $("#cantidad").hide(); 
   }
}
function calendario(sel){ //Control de input cantidad de invitados
  if(sel.value=="si") {
      $("#calen").show();
   } else {
     $("#calen").hide(); 
   }
}
function creaevento(nomb,fecha,invi,cant) //Ajax para enviar datos y crear el evento
{
         	var errors = '';
         	if ($('input#nombre').val() == '') {
         		errors += '- Debe indicar un nombre.n';
				$( "div#n" ).addClass( "has-error has-feedback" );
			}
         	
				if (errors == '') {
         		var parametros = {
         			"nombre":nomb,
         			"fecha":fecha,
         			"veri":invi,
         			"cant":cant,
         		};
         	$.ajax({
         	data: parametros,
	 		url: "script/creaevento.php",
         	type: "POST",
	 		success: function(){
	 			$( "div#n" ).removeClass( "has-error has-feedback" );
	 			alert('Evento creado Correctamente');
	 			$('#rst').click();
				}	
			});
         		}
}
function edita(val,nomb,fecha,invi,cant,v) //Ajax para enviar datos y crear el evento
{
         	var errors = '';
         	if ($('input#nombre').val() == '') {
         		errors += '- Debe indicar un nombre.n';
				$( "div#n" ).addClass( "has-error has-feedback" );
			}
         	
				if (errors == '') {
         		var parametros = {
         			"val":val,
         			"nombre":nomb,
         			"fecha":fecha,
         			"veri":invi,
         			"cant":cant,
         			"v":v,
         		};
         	$.ajax({
         	data: parametros,
	 		url: "script/creaevento.php",
         	type: "POST",
	 		success: function(){
	 			$( "div#n" ).removeClass( "has-error has-feedback" );
	 			alert('Evento Editado Correctamente');
	 			$('#edieven').click();
				}	
			});
         		}
}

