<?php

session_start();
include "funciones_BD.php";
$conexion = conecta();

if($_GET['id_lugar']!="")
{
		$id_lugar = $_GET['id_lugar'];
		$id_usuario = $_GET['id_usuario'];
		$agregado = false;
		$val_total = 0;
		$num_val = 0;

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
		
		$obtener_valoraciones=mysqli_query($conexion,"SELECT * FROM valoraciones 
		WHERE id_lugar='$id_lugar'");

		if(mysqli_num_rows($obtener_valoraciones) == 1){
			$val_monumento = mysqli_fetch_array($obtener_valoraciones);

			$val_total = $val_monumento['valoracion'];
			$num_val = $val_monumento['num_valoraciones'];

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
				'val_total' => $val_total,
				'num_val' => $num_val,
				];
		array_push($response, $temp);
		}
		
		echo json_encode($response);
}

?>