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

else if($tipo==""){

}


##### ACTUALIZAMOS LOS MONUMENTOS QUE SE MUESTRAN #####

/*if($tipo == "mostrar_lugares"){

	$lugares = mysqli_query($conexion,"SELECT * FROM lugares");
	$lugares_tmp = "";

	if($lugares){
		while($fila = mysqli_fetch_array($lugares))
		{
			$lugares_tmp.= "<tr>
				<td><input type='checkbox' name='lug_sel[]' class='lugares_sel' value='$fila[id_lugar]'/></td>
				<td>$fila[nombre]</td>
				<td>$fila[tipo]</td>
				<td class='long'>$fila[longitud]</td>
				<td clas='lat'>$fila[latitud]</td>
				<td>$fila[visitas]</td>
				<td><a href='inicio.php?id=monumentos&eliminar=$fila[id_lugar]'	class='ico del'>Eliminar</a>
				<a href='inicio.php?id=ver_monumento&id_lugar=$fila[id_lugar]
				&nombre_lugar=$fila[nombre]&lat=$fila[latitud]&lon=$fila[longitud]' class='ico edit'>Editar</a></td>
			</tr>";
		}
		echo $lugares_tmp;
	}
}*/

?>