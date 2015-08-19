<?php session_start(); ?> 
<!DOCTYPE html>
<html>
<head>
<?PHP
include("js/conec.php"); 
$conn=conectarse(); 
$verif = $_SESSION['ver'];
?>
<?php
if($verif == 'admon')
{
echo "<script language=Javascript> document.location = './admin.php';  </script>"; 
}
else if($verif == 'user'){
echo "<script language=Javascript> document.location = './usuario.php';  </script>"; 	
}

?>
<?php if($_SESSION['id'] == '') { ?>
<link media="screen" type="text/css" rel="stylesheet" href="css/bootstrap.css">
<link media="screen" type="text/css" rel="stylesheet" href="css/styleuser.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script>
$(function(){
     var opciones = {
     		//beforeSubmit: validate, //funcion que se ejecuta antes de enviar el form
           	success: function(data)
           {	
	 			if($.trim(data) == "true")
	 			{
			      document.location = './usuario.php'; 
			    }
			   else if ($.trim(data) == "atrue")
			   {
			   	document.location = './admin.php'; 
			   }
			   else
			   {
			   alert('Usuario o Contraseña Incorrectos');
			   }
	 			//$('#rst').click();
			}	//funcion que se ejecuta una vez enviado el formulario

            };
             //asignamos el plugin ajaxForm al formulario myForm y le pasamos las opciones
    $('#login').ajaxForm(opciones) ; 
});
</script>
<title>COOMEB</title>
<meta charset="utf-8">
</head>

<body>

<div class="container efecto3 padding-header cont"> <!--HEADER -->
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-2">
				<img src="img/coomeb.png" class="img-responsive" alt="Logo">
			</div>
			<div class="col-md-10">
				<img src="img/bann.jpg" class="img-responsive" alt="Banner">
			</div>
		</div>
	</div>
</div>
<div class="container wel"> <!-- CONTENIDO -->
	<div class="row">
		<div class="col-md-12">
		<label class="col-md-2">Bienvenido(a)</label>
		</div>
	</div>
</div>
<div class="container  efecto3 cont"> <!-- CONTENIDO -->
	<div class="row">
		<div id="frame" class="col-md-12">
			<form id="login" method="post" action="script/valida.php" class="form-horizontal" role="form">
			<fieldset>
		        <legend>Inicio de Sesión</legend>
			  <div class="form-group">
			    <label for="cedula" class="col-md-2 control-label">Cédula</label>
			    <div class="col-md-10">
			      <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="password" class="col-md-2 control-label">Contraseña</label>
			    <div class="col-md-10">
			      <input type="password" class="form-control" name="clave" id="clave" placeholder="Contraseña">
			    </div>
				    <div class="col-md-10" style="text-align: right;">
			      <a href='coomebsolu.php'>Cambiar Contraseña</a>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-md-offset-2 col-md-10">
			      <button type="submit" class="btn btn-success">Entrar</button>
			    </div>
			  </div>
			</fieldset>
			</form>
		</div>
	</div>
</div>
</body>


</html>
<?php }else { echo "Redireccionando..."; } ?>