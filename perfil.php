<?php 
session_start();
include "funciones_BD.php";

$conexion = conecta();

if(isset($_SESSION['usuario']))
{
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>MusicApp</title>
<link rel="shortcut icon" href="./img/favicon.ico" />
<link href="./css/style_perfil.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
<div id="logo"><img class="logotipo" src="./img/logo.png"></div>
  <div id="header">
  	<div id="menu_inicio">
      <div class="cuadro"><a href="inicio.php"><img class="icon" src="./img/home.png"></a></div>
	  	<div class="cuadro"><a href="perfil.php"><img class="icon" src="./img/perfil.png"></a></div>
	  	<div class="cuadro"><a href="mensajes.php"><img class="icon" src="./img/mensaje.png"></a></div>
      <?php if($_SESSION['tipo'] == "administrador"){ ?>
      <div class="cuadro"><a href="alta.php"><img class="icon" src="./img/alta.png"></a></div>
      <?php } ?>
	  	<div class="cuadro"><a href="cerrar.php"><img class="icon" src="./img/salir.png"></a></div>
  	</div>
  </div>
  </div>
  <div id="content" class="contenido_p">
  <?php ver_cuenta($_SESSION['usuario']);?>
  </div>
  <span class="centrado"><p class="info">Usuario: <b><?php echo $_SESSION['usuario']?></b> - tipo de usuario: <b><?php echo $_SESSION['tipo']?></b></p></span>
</body>
</html>
<?php 
}
else
{
	header("Location:cerrar.php");
}
?>