<?php
session_start();
include "funciones_BD.php";

$conexion = conecta();

if($conexion == false)
{
	header('Location: index.php?error=bd_noselect');
}
else 
{
	if($_POST['usuario']!=" ")
	{
		$usuario=$_POST['usuario'];

		if (!isset($_SESSION['usuario'])) {
			$_SESSION['usuario']=$usuario;
		}
			$clave=$_POST['password'];
		
			if(validar_clave($clave))
			{
				$usuario=mysqli_real_escape_string($conexion,$usuario);
				$clave=md5(mysqli_real_escape_string($conexion,$clave));

				$sentencia=mysqli_query($conexion,"SELECT * FROM gestion WHERE id_admin ='$usuario' AND password ='$clave'");

				if(mysqli_num_rows($sentencia)==1)
				{
					$fila=mysqli_fetch_array($sentencia);
					$valor=$fila['id_admin'];
					$_SESSION['usuario']=$valor;
					
					header("Location:inicio.php");
				}
				else
				{
					header('Location: index.php?error=error_nickopass');
				}
				mysqli_close($conexion);
				
			}
			else 
			{
				header('Location: index.php?error=error_pass');
			}
	}
	else
	{
		header('Location: index.php?error=no_nick');
	}
}
?>