<?php

session_start();
include "funciones_BD.php";
$conexion = conecta();

if($_GET['id_usuario']!="")
{
		$id_usuario=$_GET['id_usuario'];

		// Hay que obtener el nombre del lugar
		

		$comentarios=mysqli_query($conexion,"SELECT * FROM comentarios WHERE id_usuario='$id_usuario'");

		$response = array();

		if($comentarios){
			while($fila = mysqli_fetch_array($comentarios))
			{

				$lugar=mysqli_query($conexion,"SELECT nombre FROM lugares WHERE id_lugar='$fila[id_lugar]'");

				$fila_lugar = mysqli_fetch_array($lugar);

				$temp = [
					'comentario' => $fila['comentario'],
					'nombre_lugar' => $fila_lugar['nombre']
				];
				array_push($response, $temp);
			}
		}
	
		echo json_encode($response);
}

?>