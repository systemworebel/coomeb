<?php session_start(); ?> 
<!DOCTYPE html>
<html>
<head>
<?php
if($_SESSION['id'] == '')
{
echo "<script language=Javascript> document.location = './index.php';  </script>"; 
}
else if($_SESSION['ver'] == 'user'){
echo "<script language=Javascript> document.location = './usuario.php';  </script>"; 	
}
else{
	$n=$_SESSION['nombre'];	
} 
?>
<?php if($_SESSION['ver'] == 'admon') { ?>
<link media="screen" type="text/css" rel="stylesheet" href="css/bootstrap.css">
<link media="screen" type="text/css" rel="stylesheet" href="css/style.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/bootstrap-hover-dropdown.js" type="text/javascript"></script>
<script src="js/main.js"></script>

<title>Administración - COOMEB</title>
<meta charset="utf-8">
</head>

<body>

<div class="container"> <!--HEADER -->
<nav class="navbar navbar-default navbar-default-he navbar-fixed-top" role="navigation">
   <div class="container">
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="javaScript:;" onclick="$('#frame').load('./modulo/inicio.php')"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle drop-hover" data-toggle="dropdown" ><span class="glyphicon glyphicon-glass"></span> Eventos <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="javaScript:;" onclick="$('#frame').load('./modulo/creaevento.php')">Crear Evento</a></li>
            <li><a id="edieven" href="javaScript:;" onclick="$('#frame').load('./modulo/editar_evento.php')">Editar Eventos</a></li>
            <li><a href="javaScript:;" onclick="$('#frame').load('./modulo/ver_evento.php')">Ver Participantes</a></li>
          </ul>
        </li>
        <li><a href="javaScript:;" onclick="$('#frame').load('./modulo/subir_extracto.php')"><span class="glyphicon glyphicon-open"></span> Subir Extractos</a></li>
        <li><a id="admtasas" href="javaScript:;" onclick="$('#frame').load('./modulo/admin_tasas.php')"><span class="glyphicon glyphicon-list-alt"></span> Administrar Tasas</a></li>
        <li><a id="admtasas" href="javaScript:;" onclick="$('#frame').load('./modulo/resetpass.php')"><span class="glyphicon glyphicon-list-alt"></span> Restauracion de Claves</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
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
		<label class="col-md-8">Administrador <a class="cerrar" href="script/cerrar.php"> <span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión </a></label>
		</div>
	</div>
</div>
<div class="container efecto3 cont"> <!-- CONTENIDO -->
	<div class="row">
		<div id="frame" class="col-md-12">

		</div>
	</div>
</div>
</body>


</html>
<?php }else { echo "Permiso Requerido Por favor inicie Sesión"; } ?>