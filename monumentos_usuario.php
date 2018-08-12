<?php

session_start();
include "funciones_BD.php";
$conexion = conecta();

if($_GET['id_usuario']!="")
{
		$usuario=$_GET['id_usuario'];
		$num_lugares = 0;
		
		$usuario=mysqli_real_escape_string($conexion,$usuario);

		$sentencia=mysqli_query($conexion,"SELECT * FROM usuarios_lugares WHERE id_usuario='$usuario'");

		$response = array();
		//$response["correcto"] = false;  

		if($sentencia){
			while($fila = mysqli_fetch_array($sentencia))
			{
				$num_lugares++;
				$temp = [
					'id_usuario' => $fila['id_usuario'],
					'id_lugar' => $fila['id_lugar'],
					'nombre_lugar' => $fila['nombre_lugar']
				];
				array_push($response, $temp);
			}
		}
		
		echo json_encode($response);
}

?>