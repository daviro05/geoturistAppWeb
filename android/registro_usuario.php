<?php
session_start();
include "../funciones_BD.php";
$conexion = conecta();

$usuario = $_POST['id_usuario'];

if($usuario != ""){
    $clave = $_POST['password'];
    $usuario=mysqli_real_escape_string($conexion,$usuario);
    $clave=md5(mysqli_real_escape_string($conexion,$clave));

    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $email=$_POST['email'];

    $comentarios=0;
    $valoraciones=0;
    $response["correcto"] = false;

    $alta_usuario = mysqli_query($conexion,"INSERT INTO usuarios (id_usuario,nombre,apellidos,password,email,comentarios,valoraciones,img_perfil)
		VALUES('$usuario','$nombre','$apellidos','$clave','$email','$comentarios','$valoraciones','vacio.png')");
    
    if($alta_usuario){
        $response = array();
        $response["correcto"] = true;
        echo json_encode($response);
    }

}

?>