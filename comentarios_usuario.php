<?php

session_start();
include "funciones_BD.php";
$conexion = conecta();

if($_GET['id_lugar']!="")
{
		$id_lugar=$_GET['id_lugar'];
		
		$tipo_dato=$_GET['tipo_dato'];

		$comentarios=mysqli_query($conexion,"SELECT * FROM comentarios WHERE id_lugar='$id_lugar'");

		$response = array();

		if($tipo_dato == "comentarios"){

			if($comentarios){
				while($fila = mysqli_fetch_array($comentarios))
				{
					$temp = [
						'comentarios' => $fila['comentario'],
					];
					array_push($response, $temp);
				}
			}

		}
	
		echo json_encode($response);
}

?>