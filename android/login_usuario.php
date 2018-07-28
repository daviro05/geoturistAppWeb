<?php

session_start();
include "../funciones_BD.php";
$conexion = conecta();

if($_POST['id_usuario']!="")
{
		$usuario=$_POST['id_usuario'];
		$clave=$_POST['password'];
		
			if(validar_clave($clave))
			{
				$usuario=mysqli_real_escape_string($conexion,$usuario);
				$clave=md5(mysqli_real_escape_string($conexion,$clave));

				$sentencia=mysqli_query($conexion,"SELECT * FROM usuarios WHERE id_usuario='$usuario' AND password ='$clave'");

                $response = array();
                $response["correcto"] = false;  

				if(mysqli_num_rows($sentencia)==1)
				{
                    $fila=mysqli_fetch_array($sentencia);
                    
                    $response["correcto"] = true;
                    $response["id_usuario"] = $fila['id_usuario'];
                    $response["nombre"] = $fila['nombre'];
                    $response["apellidos"] = $fila['apellidos'];
                    $response["email"] = $fila['email'];
                }
                
                echo json_encode($response);
				//mysqli_close($conexion);
				
			}
}

?>