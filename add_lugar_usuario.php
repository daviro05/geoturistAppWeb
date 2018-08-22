<?php
session_start();
include "funciones_BD.php";
$conexion = conecta();

if($_GET['id_lugar']!="")
{
	$id_lugar = $_GET['id_lugar'];
    $id_usuario = $_GET['id_usuario'];
    $nombre_lugar = $_GET['nombre_lugar'];

    echo $id_lugar." ".$id_usuario." ".$nombre_lugar;

    add_lugar_usuario($id_usuario, $id_lugar, $nombre_lugar,$conexion);

}

?>