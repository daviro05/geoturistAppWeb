<?php

include("./config_conexion.php");

$conexion = conecta();

$tipo = $_GET['tipo'];

##### OBTENEMOS LOS LUGARES DE LA BBDD #####

if($tipo == "lugares"){

	$ver_lugares = mysqli_query($conexion,"SELECT * FROM lugares");
    $lugares_obtenidos ="";

	if($ver_lugares){
		while($fila = mysqli_fetch_array($ver_lugares))
		{
			$lugares_obtenidos.= "<tr>
					<td>$fila[id_lugar]</td>
					<td><a href='inicio.php?id=ver_monumento&id_lugar=$fila[id_lugar]
					&nombre_lugar=$fila[nombre]&lat=$fila[latitud]&lon=$fila[longitud]'>$fila[nombre]</a></td>
				</tr>";
		}
		echo $lugares_obtenidos;
    }
}

##### OBTENEMOS LOS USUARIOS DE LA BBDD #####

else if($tipo=="usuarios"){

	$ver_usuarios = mysqli_query($conexion,"SELECT * FROM usuarios");
    $usuarios_obtenidos ="";

	if($ver_usuarios){
		while($fila = mysqli_fetch_array($ver_usuarios))
		{
			$usuarios_obtenidos.= "<tr>
					<td>$fila[id_usuario]</td>
					<td><a href='inicio.php?id=usuarios'>$fila[nombre]</a></td>
				</tr>";
        }
        echo $usuarios_obtenidos;
	}
}

else if($tipo=="comentarios"){

	$ver_comentarios = mysqli_query($conexion,"SELECT * FROM comentarios");
    $comentarios_obtenidos ="";

	if($ver_comentarios){
		while($fila = mysqli_fetch_array($ver_comentarios))
		{
			$comentarios_obtenidos.= "<tr>
					<td>$fila[id_comentario]</td>
					<td>$fila[id_lugar]</td>
					<td><a href='inicio.php?id=comentarios'>$fila[comentario]</a></td>
				</tr>";
        }
        echo $comentarios_obtenidos;
	}
}

else if($tipo=="valoraciones"){

	$ver_valoraciones = mysqli_query($conexion,"SELECT * FROM valoraciones");
    $valoraciones_obtenidas ="";

	if($ver_valoraciones){
		while($fila = mysqli_fetch_array($ver_valoraciones))
		{
			$valoraciones_obtenidas.= "<tr>
					<td>$fila[id_usuario]</td>
					<td>$fila[id_lugar]</td>
					<td><a href='inicio.php?id=valoraciones'>$fila[valoracion]</a></td>
				</tr>";
        }
        echo $valoraciones_obtenidas;
	}
}



?>