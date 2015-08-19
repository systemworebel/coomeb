<?php session_start(); ?> 
<!DOCTYPE html>
<html>
<head>
<?PHP
include("js/conec.php"); 
$conn=conectarse(); 
$verif = $_SESSION['ver'];
?>

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
		<label class="col-md-2">Cambiar Contraseña</label>
		</div>
	</div>
</div>
<div class="container  efecto3 cont"> <!-- CONTENIDO -->
	<div class="row">
		<div id="frame" class="col-md-12">
			<form id="login" method="post" action="conf.php" class="form-horizontal" role="form">
			<fieldset>
		        <legend>Ingrese sus datos</legend>
			  <div class="form-group">
			    <label for="cedula" class="col-md-2 control-label">Cédula</label>
			    <div class="col-md-10">
			      <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="password" class="col-md-2 control-label">Contraseña</label>
			    <div class="col-md-10">
			      <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Contraseña">
			    </div>
				     <div class="form-group">
			    <label for="password" class="col-md-2 control-label">Nueva Contraseña</label>
			    <div class="col-md-10">
			      <input type="password" class="form-control" name="nueva_contraseña" id="nueva_contraseña" placeholder="Contraseña">
			    </div>
			     <div class="form-group">
			    <label for="password" class="col-md-2 control-label">Confirmar Contraseña</label>
			    <div class="col-md-10">
			      <input type="password" class="form-control" name="nueva_contraseña2" id="nueva_contraseña2" placeholder="Contraseña">
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

