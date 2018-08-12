<?php

session_start();
include "funciones_BD.php";
$conexion = conecta();

if($_GET['id_lugar']!="")
{
		$id_lugar=$_GET['id_lugar'];
		$tipo_multimedia=$_GET['tipo_multimedia'];

		$imagenes=mysqli_query($conexion,"SELECT * FROM imagenes WHERE id_lugar='$id_lugar'");

		$audios=mysqli_query($conexion,"SELECT * FROM audios WHERE id_lugar='$id_lugar'");

		$documentos=mysqli_query($conexion,"SELECT * FROM documentos WHERE id_lugar='$id_lugar'");

		$response = array();

		if($tipo_multimedia == "imagenes"){

			if($imagenes){
				while($fila = mysqli_fetch_array($imagenes))
				{
					$temp = [
						'url_imagen' => $fila['url_imagen'],
					];
					array_push($response, $temp);
				}
			}

		}
		else if($tipo_multimedia == "audios"){

			if($audios){
				while($fila = mysqli_fetch_array($audios))
				{
					$temp = [
						'url_audio' => $fila['url_audio'],
					];
					array_push($response, $temp);
				}
			}

		}
		else if($tipo_multimedia == "documentos"){

			if($documentos){
				while($fila = mysqli_fetch_array($documentos))
				{
					$temp = [
						'url_doc' => $fila['url_doc'],
					];
					array_push($response, $temp);
				}
			}

		}
	
		echo json_encode($response);
}

?>