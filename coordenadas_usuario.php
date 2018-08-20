<?php
session_start();
include "funciones_BD.php";
$conexion = conecta();

if($_GET['longitud']!="" && $_GET['latitud']!="")
{

	$longitud_gps = $_GET['longitud'];
	$latitud_gps = $_GET['latitud'];
	
	$punto1 = [$longitud_gps, $latitud_gps];
	

	$response = array();

	$obtener_lugares = mysqli_query($conexion,"SELECT * FROM lugares");

	if($obtener_lugares){

		while($fila = mysqli_fetch_array($obtener_lugares))
		{
			$punto2 = [$fila['longitud'], $fila['latitud']];

			$distancia = distance($punto1[0], $punto1[1], $punto2[0], $punto2[1]);

			//echo $distancia." kilometros <br>";

			if($distancia < 1){ // Si la distancia es menor a 1 kilometro se añade ese monumento al array
				$temp = [
					'id_lugar' => $fila['id_lugar'],
					'nombre_lugar' => $fila['nombre']
				];
				array_push($response, $temp);
			}
		}

		echo json_encode($response);
	}

}


function distance($lat1, $lon1, $lat2, $lon2) {
 
	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;

	$final = $miles * 1.609344;
   
	return $final;
  }

?>