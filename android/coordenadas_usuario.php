<?php

if(1)
{
		//$usuario=$_POST['id_usuario'];
		$lon1 = -3.6921270999999933;
		$lat1 = 40.4137818;

		$lon2 = -3.694900200;
		$lat2 = 40.4073281;

		$punto1 = [$lon1, $lat1];
		$punto2 = [$lon2, $lat2];

		//para kilómetros
		echo distance($punto1[0], $punto1[1], $punto2[0], $punto2[1], "K") . " Kilómetros";	
}


function distance($lat1, $lon1, $lat2, $lon2, $unit) {
 
	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	$unit = strtoupper($unit);

	$final = $miles * 1.609344;
   
	return $final;
  }

?>