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
<meta http-equiv="Content-Type" content="text/html"; charset="UTF-8" />
<title>MusicApp</title>
<link rel="shortcut icon" href="./img/favicon.ico" />
<link href="./css/style_mensajes.css" rel="stylesheet" type="text/css" />
<link href="./css/style_avisos.css" rel="stylesheet" type="text/css" />
<script src="./js/script.js"></script>
</head>
<body>  
<div id="container">
<div id="logo"><img class="logotipo" src="./img/logo.png"></div>
  <div id="header"></div>  
 </div>
  <div id="content" class="contenido">

  <div id="menu_inicio">
		<div class="cuadro"><a href="inicio.php"><img class="icon" src="./img/home.png"></a></div>
	  	<div class="cuadro"><a href="perfil.php"><img class="icon" src="./img/perfil.png"></a></div>
	  	<div class="cuadro"><a href="mensajes.php"><img class="icon" src="./img/mensaje.png"></a></div>
	  	<?php if($_SESSION['tipo'] == "administrador"){ ?>
	  	<div class="cuadro"><a href="alta.php"><img class="icon" src="./img/alta.png"></a></div>
	  	<?php } ?>
	  	<div class="cuadro"><a href="cerrar.php"><img class="icon" src="./img/salir.png"></a></div>
  	</div>
  
  <div id="cont_inicio">
  	<p><a class="<?php if(!isset($_GET['metodo'])) echo "cambiar2"; else echo "cambiar"; ?>" href="mensajes.php">Redactar Mensaje</a>
  	 	<a class="<?php if($_GET['metodo'] == "entrada") echo "cambiar2"; else echo "cambiar"; ?>" href="mensajes.php?metodo=entrada">Bandeja de Entrada</a>
	  	<a class="<?php if($_GET['metodo'] == "salida") echo "cambiar2"; else echo "cambiar"; ?>" href="mensajes.php?metodo=salida">Bandeja de Salida</a></p>
		<?php
		if(isset($_GET['metodo']) && !isset($_GET['user']) && !isset($_GET['id']))
		{
			$metodo = $_GET['metodo'];
			
			if($metodo == "entrada")
			{
				ver_mensajes_recibidos($_SESSION['usuario'], $conexion);
			}
			
			if($metodo == "salida")
			{
				ver_mensajes_enviados($_SESSION['usuario'], $conexion);
			}
		}
		if(!isset($_GET['metodo']) && !isset($_GET['user']) && !isset($_GET['id']))
		{
			?>
			<form name=form_mensaje action="mensajes.php" method="post">
			<table class="mensajes" align="center">
				<tr>
					<td colspan='3'><b>¡Envía mensajes a otros usuarios de MusicApp!</b></td>
				</tr>
				<tr>
					<td>
					<input class="barra_men" type="text" name="asunto" size="20" placeholder="Asunto">

					<div id="opcion_destino">
							Individual <input class="op_in" type="radio" name="des" 
							value="individual" checked="checked">
							Grupos <input class="op_gr" type="radio" name="des" value="grupos">
					</div>
					
					<span id="act_destinos">
					Destinatarios: <select class="barra_men" name="destinatario"  size="1">
					<?php generar_destinatarios($_SESSION['usuario'], $conexion);?></select>
					</span>

					<span id="act_grupos">
					Grupos: <select class="barra_men" name="grupos"  size="1">
						<?php generar_grupos($_SESSION['usuario'], $conexion);?>
					</select>
					</span>
					</td>
				</tr>
				<tr>
					<td colspan="2"><textarea rows="7" cols="100" name="mensaje" maxlength="600"></textarea> </td>
				</tr>
				<tr>
					<td colspan="2"><input class="busca" type="submit" value="Enviar Mensaje" name="Enviar"> <input type="reset" value="Borrar" name="Borrar"></td>
				</tr>
			</table>
		</form>
		<?php 	
		}
		if(isset($_GET['user']) && isset($_GET['id']) && $_GET['action'] == "leer")
		{
			$mensajedeco = base64_decode($_GET['id']);
			leer_mensaje($_GET['user'], $mensajedeco, $conexion);
		}
		if(isset($_GET['user']) && isset($_GET['id']) && $_GET['action'] == "eliminar")
		{
			$mensajedeco = base64_decode($_GET['id']);
			eliminar_mensaje($_GET['user'], $mensajedeco, $conexion);
		}
		
		if(isset($_POST['Enviar']))
		{
			$dir = $_POST['des'];

			if( $dir == 'individual')

				$destinatario = $_POST['destinatario'];
			else
				$destinatario = $_POST['grupos'];
			
			if(empty($_POST['asunto']))
			{
				$asunto = "Sin Asunto";
			}
			else 
			{
				$asunto=$_POST['asunto'];
			}
			
			$mensaje=$_POST['mensaje'];
			
			if($destinatario !="")
			{
				if($mensaje !="")
				{
					if($destinatario == "Todos" && $dir == "grupos")
						grupo_a_todos($_SESSION['usuario'],$mensaje,$asunto,$conexion);

					if($destinatario != "Todos" && $dir == "grupos")
						enviar_mensaje_grupo($_SESSION['usuario'],$destinatario,$mensaje,$asunto,$conexion);

					if($destinatario == "Todos" && $dir == "individual")
						individual_a_todos($_SESSION['usuario'],$mensaje,$asunto,$conexion);

					if($destinatario != "Todos" && $dir == "individual")
					{
						if(comprobar_user_registrado($destinatario, $conexion))
						{
							enviar_mensaje($_SESSION['usuario'],$destinatario,$mensaje,$asunto,$conexion);
						}
						else
						{
							echo "<p class='error_1'>El destinatario no existe, o no está registrado en MusicApp.</p>";
						}
					}
				}
				else
				{
					echo "<p class='aviso'>No puedes enviar un mensaje vacío.</p>";
				}
			}
			else
			{
				echo "<p class='aviso'>Debes especificar un destinatario.</p>";
			}
		}
		?>
		</div>
  </div>
</div>
<p class="centrado">Usuario: <b><?php echo $_SESSION['usuario']?></b> - tipo de usuario: <b><?php echo $_SESSION['tipo']?></b></p>
</body>
</html>
<?php 
}
else
{
	header("Location:cerrar.php");
}
?>