<?php 
session_start();
include "funciones_BD.php";

$conexion = conecta();

if(isset($_SESSION['usuario']) && $_SESSION['tipo'] =="administrador")
{
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>MusicApp</title>
<link rel="shortcut icon" href="./img/favicon.ico" />
<link href="./css/style_perfil.css" rel="stylesheet" type="text/css" />
<link href="./css/style_avisos.css" rel="stylesheet" type="text/css" />
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
  <div id="cuadro_alta">
    <form class="f_alta" action="alta.php" method="post" enctype="multipart/form-data">
        <table class="alta_g">
          <tr><td class="campo">Nombre Grupo: </td><td><input class="cuadro_alta" type="text" name="nombre_grupo" placeholder="Nombre Grupo"/></td></tr>
          <tr><td class="campo">Tipo de música: </td><td><select class="cuadro_alta" name="tipo_musica"><?php obtener_tipo();?></select></td></tr>
          <tr><td class="campo">Edad mínima: </td><td><input class="cuadro_alta" type="number" min=10 max=100 name="e_min" placeholder="Edad mínima"/></td></tr>
          <tr><td class="campo">Edad máxima: </td><td><input class="cuadro_alta" type="number" min=10 max=100 name="e_max" placeholder="Edad máxima"/></td></tr>
          <tr><td class="botones" colspan="2"><input class="b_reg" type="submit" name="Alta" value="Dar de alta"/>
          <input class="b_reg" type="reset" value="Borrar"/></td></tr>
        </table>
    </form>
  </div> 
  </div>
  <div id="content" class="contenido">
  <?php
  if(isset($_POST['Alta']))
    {
      $nombre_grupo = $_POST['nombre_grupo'];
         
      $tipo_musica=$_POST['tipo_musica'];

      $edad_min=$_POST['e_min'];

      $edad_max=$_POST['e_max'];
      
      if($nombre_grupo !="")
      {
        if($tipo_musica !="")
        {
          if($edad_min <= $edad_max){
            if(alta_grupo($nombre_grupo,$tipo_musica,$edad_min,$edad_max,$_SESSION['usuario'],$conexion))
              {
                //header("Location:alta.php");
                echo "<p class='correcto'>El grupo '$nombre_grupo' ha sido dado de alta!</p>";
              }
          }
          else
          {
            echo "<p class='aviso'>La edad mínima debe ser menor o igual a la edad máxima!</p>";
          }
        }
        else
        {
          echo "<p class='aviso'>Indica el tipo de música del grupo!</p>";
        }
      }
      else
      {
        echo "<p class='aviso'>Indica un nombre para el grupo!</p>";
      }
    }
    ?>
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