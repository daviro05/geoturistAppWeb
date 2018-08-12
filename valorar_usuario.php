<?php
session_start();
include "funciones_BD.php";
$conexion = conecta();

if($_GET['id_lugar']!="")
{
	$id_lugar = $_GET['id_lugar'];
    $id_usuario = $_GET['id_usuario'];
    $valoracion = $_GET['valoracion'];

    $comentario = $_GET['comentario'];

    if($valoracion != '')
        alta_valoracion($id_usuario,$id_lugar,$valoracion,$conexion);

    alta_comentario($id_usuario,$id_lugar,$comentario,$conexion);

}

?>