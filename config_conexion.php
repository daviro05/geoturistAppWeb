<?php

function conecta()
{
	$local = true;

	if($local == true)
	{
		$host='localhost';
		$usuario='root';
		$clave='';
		$db='geoturistapp';
	}
	else
	{
		$host='localhost';
		$usuario='id1773399_david';
		$clave='geoturistapp';
		$db='id1773399_geoturistapp';
	}

	$conexion=mysqli_connect($host,$usuario,$clave,$db);

	return $conexion;
}

?>