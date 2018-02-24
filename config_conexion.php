<?php

function conecta()
{
	$conexion= mysqli_connect("localhost","root","","geoturistapp");

	return $conexion;
}

?>