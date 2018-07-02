<?php
session_start();
include "funciones_BD.php";
$conexion = conecta();
if(isset($_SESSION['usuario'])){
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>GeoTuristApp</title>
<link rel="shortcut icon" href="./img/favicon.ico"/>
<link href="./css/style_inicio.css" rel="stylesheet" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="./js/jquery.min.js"></script>
<script src="./js/inicio.js"></script>
<script src="./js/actualizar_datos.js"></script>
<!--<script src="./js/actualizar_lugares.js"></script>-->

</head>
<body>
<div id="header">
<div class="shell">
	<!-- Logo + Top Nav -->
	<div id="top">
		<img src="./img/logo.png"/>
		<div id="top-navigation">
			Bienvenido <a href="#"><strong><?php echo $_SESSION['usuario']?></strong></a>
			<span>|</span>
			<a href="cerrar.php">Salir</a>
		</div>
	</div>
	<!-- End Logo + Top Nav -->
	<!-- Main Nav -->
	<div id="navigation">
		<ul>
		    <li><a href="inicio.php"
		    	<?php if(!isset($_GET['id'])) echo "class='active'";?>><span>Inicio</span></a></li>
		    <li><a href="inicio.php?id=monumentos"
		    	<?php if(isset($_GET['id']) && $_GET['id'] == "monumentos") echo "class='active'";?>><span>Monumentos</span></a></li>
		    <li><a href="inicio.php?id=comentarios"
		    	<?php if(isset($_GET['id']) && $_GET['id'] == "comentarios") echo "class='active'";?>><span>Comentarios</span></a></li>
		    <li><a href="inicio.php?id=estadisticas"
		    	<?php if(isset($_GET['id']) && $_GET['id'] == "estadisticas") echo "class='active'";?>><span>Estadísticas</span></a></li>
		    <li><a href="inicio.php?id=usuarios"
		    	<?php if(isset($_GET['id']) && $_GET['id'] == "usuarios") echo "class='active'";?>><span>Usuarios</span></a></li>
		    <li><a href="inicio.php?id=about"
		    	<?php if(isset($_GET['id']) && $_GET['id'] == "about") echo "class='active'";?>><span>Incidencias</span></a></li>
		</ul>
	</div>
	<!-- End Main Nav -->
</div>
<!-- End Header -->
<!-- Container -->
<div id="container">
	<div class="shell">
		<!-- Small Nav -->
		<div class="small-nav">
			<!--<a href="#">Inicio</a>
			<span> > </span>
			Monumentos-->
		</div>
		<!-- End Small Nav -->
		<br />
		<!-- Main -->
		<?php
			if(isset($_GET['id'])){
				if($_GET['id'] == 'monumentos')
					include 'monumentos.php';
				if($_GET['id'] == 'comentarios')
					include 'comentarios.php';
				if($_GET['id'] == 'estadisticas')
					include 'estadisticas.php';
				if($_GET['id'] == 'usuarios')
					include 'usuarios.php';
				if($_GET['id'] == 'about')
					include 'about.php';
				if($_GET['id'] == 'add_monumento')
						include 'add_monumento.php';
				if($_GET['id'] == 'ver_monumento')
					include 'ver_monumento.php';
				if($_GET['id'] == 'configuracion')
					include 'configuracion.php';
			}
			else{
				include 'principal.php';
			}

		?>
		<!-- Main -->
	</div>
</div>
<!-- End Container -->

<!-- Footer -->
<div id="footer">
	<div class="shell">
	</div>
</div>
<!-- End Footer -->

</body>
</html>
<?php
}
else
{
	header("Location:cerrar.php");
}
?>
