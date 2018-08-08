<?php

session_start();
include "funciones_BD.php";
$conexion = conecta();

if($_GET['id_lugar']!="")
{
		$id_lugar = $_GET['id_lugar'];
		$id_usuario = $_GET['id_usuario'];
		$agregado = false;

		$sentencia=mysqli_query($conexion,"SELECT * FROM lugares WHERE id_lugar='$id_lugar'");

		$response = array();
		
		/*id_lugar
		nombre
		tipo
		latitud
		longitud
		hora_abre
		hora_cierra
		dias_abre
		descripcion
		visitas*/

		if($sentencia){

		$comprobar_lugar=mysqli_query($conexion,"SELECT * FROM usuarios_lugares 
		WHERE id_lugar='$id_lugar' AND id_usuario='$id_usuario'");

		if(mysqli_num_rows($comprobar_lugar)==1)
		{
			$agregado = true;
		}	

		$fila = mysqli_fetch_array($sentencia);
		$temp = [
				'id_lugar' => $fila['id_lugar'],
				'nombre' => $fila['nombre'],
				'horario' => $fila['hora_abre']." - ".$fila['hora_cierra'],
				'dias_abre' => $fila['dias_abre'],
				'descripcion' =>  $fila['descripcion'],
				'visitas' =>  $fila['visitas'],
				'agregado' => $agregado,
				];
		array_push($response, $temp);
		}
		
		echo json_encode($response);
}

?>