<?php
#######################################
### FUNCIONES DE CONEXIÓN A BBDD ######
#######################################

include('./config_conexion.php');

#######################################
###### FUNCIONES DE VALIDACIÓN ########
#######################################

function validar_clave($pass)
{
	$tam=strlen($pass);
	if($tam<16)
	{
		return true;
	}
	else return false;

}

function comprobar_tam_nick($nick)
{
	$tam = strlen($nick);

	if($tam>4 && $tam<16)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function comprobar_nick($nick,$conexion)
{
	$comprobar = mysqli_query($conexion,"SELECT nick from usuarios");

	$bandera = true;

	if($comprobar)
	{
		while($fila=mysqli_fetch_array($comprobar))
		{
			if($fila['nick'] == $nick)
			{
				$bandera = false;
			}
		}
	}

	return $bandera;
}

function comprobar_user_registrado($usuario,$conexion)
{
	$comprobar_user = mysqli_query($conexion,"SELECT nick from usuarios WHERE nick = '$usuario'");

	if($comprobar_user)
	{
		if(mysqli_num_rows($comprobar_user)==1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}

function comprobar_email($email,$conexion)
{
	if(filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		$comprobar = mysqli_query($conexion,"SELECT email from usuarios");

		if($comprobar)
		{
			if(mysqli_num_rows($comprobar)==1)
			{
				while($fila=mysqli_fetch_array($comprobar))
				{
					if($fila['email']==$email)
					{
						return false;
					}
					else
					{
						return true;
					}
				}
			}
			else
			{
				return true;
			}
		}
	}
	else
	{
		return false;
	}
}

function validar_email($email,$conexion)
{
	if(filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		return true;
	}
	else
	{
		return false;
	}

}

#######################################
##### FUNCIONES DE LUGARES ALTA #######
#######################################

function alta_lugar($nombre,$tipo,$latitud,$longitud,$desc,$conexion)
{
	/*
	id_lugar
	nombre
	tipo
	latitud
	longitud
	hora_abre
	hora_cierra
	dias_abre
	descripcion
	visitas
	*/
	$alta = mysqli_query($conexion,"INSERT INTO lugares (nombre,tipo,latitud,longitud,descripcion)
		VALUES('$nombre','$tipo','$latitud','$longitud','$desc')");

	echo "<script>window.location = './inicio.php?id=monumentos'</script>";
}

function alta_lugar_completo($nombre,$tipo,$latitud,$longitud,$hora_abre,$hora_cierra,$dias_abre,$desc,$visitas,$conexion)
{
	

	$alta = mysqli_query($conexion,"INSERT INTO lugares (nombre,tipo,latitud,longitud,hora_abre,hora_cierra,
		dias_abre,descripcion,visitas) 
		VALUES ('$nombre','$tipo','$latitud','$longitud','$hora_abre','$hora_cierra','$dias_abre','$desc','$visitas')");

	if($alta){

		$query=mysqli_query($conexion,"SELECT MAX(id_lugar) as id FROM lugares");
		$id=mysqli_fetch_array($query); //$id["id"] = el ultimo id (mayor)
		//echo "id: ".$id['id'];
		//echo($_FILES['file_img']['size'][0]);

		if($_FILES['file_img']['size'][0] != 0){
			subir_imagenes($id['id'],$conexion);
		}
		if($_FILES['file_audio']['size'][0] != 0){
			subir_audios($id['id'],$conexion);
		}
		if($_FILES['file_doc']['size'][0] != 0){
			subir_docs($id['id'],$conexion);
		}
	}
	else
		echo "<p>Error</p>";

	echo "<script>window.location = './inicio.php?id=monumentos'</script>";

}

function subir_imagenes($id_lugar,$conexion){

// Recibo los datos de la imagen
$nombre_img = $_FILES['file_img']['name'];
$tipo = $_FILES['file_img']['type'];
$tamano = $_FILES['file_img']['size'];
$cantidad= count($_FILES['file_img']['tmp_name']);
$img_tmp=$_FILES['file_img']['tmp_name'];

//echo $nombre_img[0];

for ($i=0; $i<$cantidad; $i++){
 
	//Si existe imagen y tiene un tamaño correcto
	if (($nombre_img == !NULL))  //&& ($_FILES['file_img']['size'] <= 200000)
	{
	   //indicamos los formatos que permitimos subir a nuestro servidor
	   if (($tipo[$i] == 'image/gif')
	   || ($tipo[$i] == 'image/jpeg')
	   || ($tipo[$i] == 'image/jpg')
	   || ($tipo[$i] == 'image/png'))
	   {
	      // Ruta donde se guardarán las imágenes que subamos
	      $directorio = './multimedia/img_lugares/';
	      // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
	      move_uploaded_file($img_tmp[$i],$directorio.$nombre_img[$i]);
	      $subida = mysqli_query($conexion,"INSERT INTO imagenes (id_lugar,url_imagen) 
	      	VALUES ('$id_lugar','$nombre_img[$i]')");
	    } 
	    else 
	    {
	       //si no cumple con el formato
	       echo "No se puede subir una imagen con ese formato ";
	    }
	} 
	else 
	{
	   //si existe la variable pero se pasa del tamanio permitido
	   if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
	}
}
}

function subir_audios($id_lugar,$conexion){

// Recibo los datos del audio
$nombre_audio = $_FILES['file_audio']['name'];
$tipo = $_FILES['file_audio']['type'];
$tamano = $_FILES['file_audio']['size'];
$cantidad= count($_FILES['file_audio']['tmp_name']);
$audio_tmp=$_FILES['file_audio']['tmp_name'];
/*
ini_set('max_execution_time', 1000);
ini_set('max_input_time', 1000);
ini_set('post_max_size', "100M");
ini_set('memory_limit', "100M");
ini_set('upload_max_filesize', "100M");
ini_set('max_file_size', "100M");
*/

for ($i=0; $i<$cantidad; $i++){
 	//echo $nombre_audio[$i];

	//Si existe audio y tiene un tamaño correcto
	if (($nombre_audio == !NULL))
	{
	   //indicamos los formatos que permitimos subir a nuestro servidor
	   if (($tipo[$i] == 'audio/mp3')
	   || ($tipo[$i] == 'audio/mpeg')
	   || ($tipo[$i] == 'audio/mpeg3'))
	   {
	   	if (is_uploaded_file ($_FILES['file_audio']['tmp_name'][$i]))
		{
	      // Ruta donde se guardarán los audios que subamos
	      $directorio = './multimedia/audio_lugares/';
	      // Muevo el audio desde el directorio temporal a nuestra ruta indicada anteriormente
	      move_uploaded_file($audio_tmp[$i],$directorio.$nombre_audio[$i]);
	      $subida = mysqli_query($conexion,"INSERT INTO audios (id_lugar,url_audio) 
	      	VALUES ('$id_lugar','$nombre_audio[$i]')");
	 	 }
	    } 
	    else 
	    {
	       //si no cumple con el formato
	       echo "No se puede subir un audio con ese formato ";
	    }
	} 
	else 
	{
	   //si existe la variable pero se pasa del tama�o permitido
	   if($nombre_audio == !NULL) echo "El audio es demasiado grande "; 
	}
}
}

function subir_docs($id_lugar,$conexion){

// Recibo los datos del documento
$nombre_doc = $_FILES['file_doc']['name'];
$tipo = $_FILES['file_doc']['type'];
$tamano = $_FILES['file_doc']['size'];
$cantidad= count($_FILES['file_doc']['tmp_name']);
$doc_tmp=$_FILES['file_doc']['tmp_name'];

for ($i=0; $i<$cantidad; $i++){
 	//echo $nombre_doc[$i];

	//Si existe doc y tiene un tamaño correcto
	if (($nombre_doc == !NULL))
	{
	   //indicamos los formatos que permitimos subir a nuestro servidor
	   if (($tipo[$i] == 'application/pdf')
	   || ($tipo[$i] == 'application/msword')
	   || ($tipo[$i] == 'text/plain')
	   || ($tipo[$i] == 'application/excel')
	   || ($tipo[$i] == 'application/mspowerpoint')
	   || ($tipo[$i] == 'text/html'))
	   {
	      // Ruta donde se guardaran los audios que subamos
	      $directorio = './multimedia/doc_lugares/';
	      // Muevo el doc desde el directorio temporal a nuestra ruta indicada anteriormente
	      move_uploaded_file($doc_tmp[$i],$directorio.$nombre_doc[$i]);
	      $subida = mysqli_query($conexion,"INSERT INTO documentos (id_lugar,url_doc) 
	      	VALUES ('$id_lugar','$nombre_doc[$i]')");
	    } 
	    else 
	    {
	       //si no cumple con el formato
	       echo "No se puede subir un documento con ese formato ";
	    }
	} 
	else 
	{
	   //si existe la variable pero se pasa del tamaño permitido
	   if($nombre_doc == !NULL) echo "El doc es demasiado grande "; 
	}
}
}

function obtener_lugares($conexion){
	$lugares = mysqli_query($conexion,"SELECT * FROM lugares");

	if($lugares){
		while($fila = mysqli_fetch_array($lugares))
		{
			echo "<tr>
				<td><input type='checkbox' name='lug_sel[]' class='lugares_sel' value='$fila[id_lugar]'/></td>
				<td>$fila[nombre]</td>
				<td>$fila[tipo]</td>
				<td class='long'>$fila[longitud]</td>
				<td clas='lat'>$fila[latitud]</td>
				<td>$fila[visitas]</td>
				<td><a href='inicio.php?id=monumentos&eliminar=$fila[id_lugar]'	class='ico del' onclick='return confirmar()'>Eliminar</a>
				<a href='inicio.php?id=ver_monumento&id_lugar=$fila[id_lugar]
				&nombre_lugar=$fila[nombre]&lat=$fila[latitud]&lon=$fila[longitud]
				&h_abre=$fila[hora_abre]&h_cierra=$fila[hora_cierra]&dias_abre=$fila[dias_abre]
				&descripcion=$fila[descripcion]&visitas=$fila[visitas]' class='ico edit'>Ver</a></td>
			</tr>";
		}
	}
}

function eliminar_lugar($id_lugar,$conexion){
	$eliminar = mysqli_query($conexion,"DELETE FROM lugares WHERE id_lugar='$id_lugar'");
	echo "<script>window.location = './inicio.php?id=monumentos'</script>";
}



function contar_filas($tipo,$conexion){
	if($tipo == "lugares")
		$sql = "SELECT * FROM lugares";
	else if($tipo == "comentarios")
		$sql = "SELECT * FROM comentarios";
	else if($tipo == "valoraciones")
		$sql = "SELECT * FROM valoraciones";
	else if($tipo == "usuarios")
		$sql = "SELECT * FROM usuarios";

	$resultado = mysqli_query($conexion,$sql);
	$numero = mysqli_num_rows($resultado);

	echo $numero;
}


function obtener_archivos($id_lugar,$tipo,$conexion){

	$url="";

	if($tipo == "img_lugares"){
		$sql = "SELECT * FROM imagenes WHERE id_lugar='$id_lugar'";
		$url="url_imagen";
	}
	else if($tipo == "audio_lugares"){
		$sql = "SELECT * FROM audios WHERE id_lugar='$id_lugar'";
		$url="url_audio";
	}
	else if($tipo == "doc_lugares"){
		$sql = "SELECT * FROM documentos WHERE id_lugar='$id_lugar'";
		$url="url_doc";
	}

	$resultado = mysqli_query($conexion,$sql);

	if($resultado){
		while($fila = mysqli_fetch_array($resultado))
		{
			echo "<tr>
					<td><a href='inicio.php?id=ver_monumento&id_lugar=$fila[id_lugar]
					&nombre_lugar=$_GET[nombre_lugar]&lat=$_GET[lat]&lon=$_GET[lon]
					&tipo_archivo=$tipo&url=$fila[$url]&eliminar=true'>Eliminar</a></td>
					<td> - </td>
					<td><a href='./multimedia/$tipo/$fila[$url]'>$fila[$url]</a></td>
				</tr>";
		}
	}


}


function actualizar_multimedia($id_lugar,$conexion){

	// HAY QUE HACER QUE SE PUEDAN SUBIR MÁS IMAGENES

	//echo $id_lugar." - ".$_FILES['file_img']['size'][0];

	if($_FILES['file_img']['size'][0] != 0){
		subir_imagenes($id_lugar,$conexion);
	}
	if($_FILES['file_audio']['size'][0] != 0){
		subir_audios($id_lugar,$conexion);
	}
	if($_FILES['file_doc']['size'][0] != 0){
		subir_docs($id_lugar,$conexion);
	}

}

function actualizar_pagina(){

	echo '<script>window.location = ""</script>';
	
}

function eliminar_archivos($id_lugar,$tipo,$url,$conexion){
	if($tipo == "img_lugares"){
		$sql = "DELETE FROM imagenes WHERE id_lugar='$id_lugar' AND url_imagen='$url'";
	}
	else if($tipo == "audio_lugares"){
		$sql = "DELETE FROM audios WHERE id_lugar='$id_lugar' AND url_audio='$url'";
	}
	else if($tipo == "doc_lugares"){
		$sql = "DELETE FROM documentos WHERE id_lugar='$id_lugar' AND url_doc='$url'";
	}

	$resultado = mysqli_query($conexion,$sql);
}



function eliminar_seleccionados($conexion){
	if(!empty($_POST['lug_sel'])){
		foreach($_POST['lug_sel'] as $lugar)
			eliminar_lugar($lugar,$conexion);
	}
}



#######################################
###### FUNCIONES DE USUARIOS ##########
#######################################


function alta_usuario($id_usuario,$nombre,$apellidos,$password,$email,$comentarios,$valoraciones,$conexion)
{
	$alta_usuario = mysqli_query($conexion,"INSERT INTO usuarios (id_usuario,nombre,apellidos,password,email,comentarios,valoraciones,img_perfil)
		VALUES('$id_usuario','$nombre','$apellidos','$password','$email','$comentarios','$valoraciones','vacio.png')");

	if($alta_usuario){
		echo "<script>window.location = './inicio.php?id=usuarios'</script>";
	}
}

function subir_imagenes_perfil($id_usuario,$conexion){

// Recibo los datos de la imagen
$nombre_img = $_FILES['imaperfil']['name'];
$tipo = $_FILES['imaperfil']['type'];
$tamano = $_FILES['imaperfil']['size'];
$img_tmp=$_FILES['imaperfil']['tmp_name'];

echo $nombre_img[0];

	//Si existe imagen y tiene un tamaño correcto
	if (($nombre_img == !NULL))  //&& ($_FILES['file_img']['size'] <= 200000)
	{
	   //indicamos los formatos que permitimos subir a nuestro servidor
	   if (($tipo == 'image/gif')
	   || ($tipo == 'image/jpeg')
	   || ($tipo == 'image/jpg')
	   || ($tipo == 'image/png'))
	   {
	      // Ruta donde se guardarán las imágenes que subamos
	      $directorio = './multimedia/img_perfiles/';
	      // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
	      move_uploaded_file($img_tmp,$directorio.$nombre_img);

	      $subida = mysqli_query($conexion,"UPDATE usuarios SET img_perfil = '$nombre_img' WHERE id_usuario = '$id_usuario'");
	    } 
	    else 
	    {
	       //si no cumple con el formato
	       echo "No se puede subir una imagen con ese formato ";
	    }
	} 
	else 
	{
	   //si existe la variable pero se pasa del tamaño permitido
	   if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
	}
}


function obtener_usuarios($conexion){
	$usuarios = mysqli_query($conexion,"SELECT * FROM usuarios");

	if($usuarios){
		while($fila = mysqli_fetch_array($usuarios))
		{
			echo "<tr>
				<td><input type='checkbox' name='usu_sel[]' class='lugares_sel' value='$fila[id_usuario]'/></td>
				<td><img class='img_perfil' src='./multimedia/img_perfiles/$fila[img_perfil]'></td>
				<td>$fila[id_usuario]</td>
				<td>$fila[nombre]</td>
				<td>$fila[apellidos]</td>
				<td>$fila[email]</td>
				<td>$fila[comentarios]</td>
				<td>$fila[valoraciones]</td>
				<td><a href='inicio.php?id=usuarios&eliminar=$fila[id_usuario]' class='ico del' onclick='return confirmar()'>Eliminar</a>
			</tr>";
		}
	}
}

function eliminar_usuario($id_usuario,$conexion){
	$eliminar = mysqli_query($conexion,"DELETE FROM usuarios WHERE id_usuario='$id_usuario'");
	echo "<script>window.location = './inicio.php?id=usuarios'</script>";
}

function add_lugar_usuario($id_usuario, $id_lugar, $nombre_lugar,$conexion){
	// Método que conecta un lugar a un usuario en la tabla usuarios_lugares. 
	// Debemos también aumentar el nº de visitas de ese lugar.

	$usuarios_lugares = mysqli_query($conexion,"SELECT * FROM usuarios_lugares WHERE id_lugar='$id_lugar'");

	// Si no existe ese lugar en la lista del usuario lo agregamos.

	if(mysqli_num_rows($usuarios_lugares)==0)
	{
		$add_visita = mysqli_query($conexion,"INSERT INTO usuarios_lugares (id_usuario, id_lugar, nombre_lugar) 
		VALUES ('$id_usuario','$id_lugar', '$nombre_lugar')") or die(mysqli_error($conexion));

		$inc_visita =  mysqli_query($conexion,"UPDATE lugares SET visitas = visitas+1") 
		or die(mysqli_error($conexion));
	}
}

function mostrar_lugares_usuario($id_usuario){

	$mostrar_lugares = mysqli_query($conexion,"SELECT * FROM usuarios_lugares WHERE id_usuario='$id_usuario'");

	if($mostrar_lugares){
		while($fila = mysqli_fetch_array($mostrar_lugares))
		{
			echo "<option value='$fila[id_lugar]'>$fila[nombre_lugar]</option>";
		}
	}

}

#######################################
###### FUNCIONES PARA COMENTARIOS #####
#######################################

function alta_comentario($id_usuario,$id_lugar,$comentario,$conexion)
{
	$alta_comentario = mysqli_query($conexion,"INSERT INTO comentarios (id_usuario,id_lugar,comentario)
		VALUES('$id_usuario','$id_lugar','$comentario')") or die(mysqli_error($conexion));

	$alta_comentario_u =  mysqli_query($conexion,"UPDATE usuarios SET comentarios = comentarios+1 WHERE id_usuario='$id_usuario'" ) 
	or die(mysqli_error($conexion));

	if($alta_comentario)
		echo "<script>window.location = './inicio.php?id=comentarios'</script>";

}


function usuarios_lista($conexion){

	$usuarios = mysqli_query($conexion,"SELECT * FROM usuarios");

	if($usuarios){
		while($fila = mysqli_fetch_array($usuarios))
		{
			echo "<option value='$fila[id_usuario]'>$fila[id_usuario]</option>";
		}
	}
}

function lugares_lista($conexion){

	$lugares = mysqli_query($conexion,"SELECT * FROM lugares");

	if($lugares){
		while($fila = mysqli_fetch_array($lugares))
		{
			echo "<option value='$fila[id_lugar]'>$fila[nombre]</option>";
		}
	}
}

function obtener_comentarios($conexion){
	$comentarios = mysqli_query($conexion,"SELECT * FROM comentarios");

	if($comentarios){
		while($fila = mysqli_fetch_array($comentarios))
		{
			echo "<tr>
				<td><input type='checkbox' name='coment_sel[]' class='lugares_sel' value='$fila[id_comentario]'/></td>
				<td>$fila[id_comentario]</td>
				<td>$fila[id_usuario]</td>
				<td>$fila[id_lugar]</td>
				<td>$fila[comentario]</td>
				<td><a href='inicio.php?id=comentarios&eliminar=$fila[id_comentario]' class='ico del' onclick='return confirmar()'>Eliminar</a>
			</tr>";
		}
	}
}

function eliminar_comentario($id_comentario,$conexion){
	$eliminar = mysqli_query($conexion,"DELETE FROM comentarios WHERE id_comentario='$id_comentario'");
	echo "<script>window.location = './inicio.php?id=comentarios'</script>";
}



#######################################
###### FUNCIONES DE VALORACIONES ######
#######################################

function alta_valoracion($id_usuario,$id_lugar,$valoracion,$conexion)
{
	$valoraciones = mysqli_query($conexion,"SELECT * FROM valoraciones WHERE id_lugar='$id_lugar'");

	if(mysqli_num_rows($valoraciones)==1)
	{
		//echo 'Ya se ha valorado ese lugar';
		$modificar_val = mysqli_query($conexion,"UPDATE valoraciones SET num_valoraciones = num_valoraciones+1 , 
		sum_valoraciones = sum_valoraciones + '$valoracion',
		valoracion = (sum_valoraciones)/(num_valoraciones)
		 WHERE id_lugar = '$id_lugar'");

		echo "<script>window.location = './inicio.php?id=valoraciones'</script>";
	}
	else{
		
		$alta_valoracion = mysqli_query($conexion,"INSERT INTO valoraciones (id_usuario,id_lugar,valoracion, num_valoraciones, sum_valoraciones)
			VALUES('$id_usuario','$id_lugar','$valoracion',1, '$valoracion')") or die(mysqli_error($conexion));

		if($alta_valoracion)
			echo "<script>window.location = './inicio.php?id=valoraciones'</script>";
	}

	$alta_valoracion_u =  mysqli_query($conexion,"UPDATE usuarios SET valoraciones = valoraciones+1  WHERE id_usuario='$id_usuario'" ) 
	or die(mysqli_error($conexion));

}


function obtener_valoraciones($conexion){
	$valoraciones = mysqli_query($conexion,"SELECT * FROM valoraciones");

	if($valoraciones){
		while($fila = mysqli_fetch_array($valoraciones))
		{
			echo "<tr>
				<td><input type='checkbox' name='valor_sel[]' class='lugares_sel' value='$fila[id_valoracion]'/></td>
				<td>$fila[id_usuario]</td>
				<td>$fila[id_lugar]</td>
				<td>$fila[valoracion]</td>
				<td>$fila[num_valoraciones]</td>
				<td><a href='inicio.php?id=valoraciones&eliminar=$fila[id_valoracion]' class='ico del' onclick='return confirmar()'>Eliminar</a>
			</tr>";
		}
	}
}

function eliminar_valoracion($id_valoracion,$conexion){
	$eliminar = mysqli_query($conexion,"DELETE FROM valoraciones WHERE id_valoracion='$id_valoracion'");
	echo "<script>window.location = './inicio.php?id=valoraciones'</script>";
}

#######################################
######  FUNCIONES DE INCIDENCIAS ######
#######################################

function alta_incidencia($id_usuario,$tipo,$incidencia,$conexion)
{
		
		$alta_incidencia = mysqli_query($conexion,"INSERT INTO incidencias (id_usuario,tipo,incidencia)
			VALUES('$id_usuario','$tipo','$incidencia')") or die(mysqli_error($conexion));

		if($alta_incidencia)
			echo "<script>window.location = './inicio.php?id=incidencias'</script>";

}


function obtener_incidencias($conexion){
	$incidencias = mysqli_query($conexion,"SELECT * FROM incidencias");

	if($incidencias){
		while($fila = mysqli_fetch_array($incidencias))
		{
			echo "<tr>
				<td><input type='checkbox' name='incidencia_sel[]' class='lugares_sel' value='$fila[id_incidencia]'/></td>
				<td>$fila[id_usuario]</td>
				<td>$fila[tipo]</td>
				<td>$fila[incidencia]</td>
				<td><a href='inicio.php?id=incidencias&eliminar=$fila[id_incidencia]' class='ico del' onclick='return confirmar()'>Eliminar</a>
			</tr>";
		}
	}
}

function eliminar_incidencia($id_incidencia,$conexion){
	$eliminar = mysqli_query($conexion,"DELETE FROM incidencias WHERE id_incidencia='$id_incidencia'");
	echo "<script>window.location = './inicio.php?id=incidencias'</script>";
}


#######################################
####### FUNCIONES DE ELIMINAR #########
#######################################


function confirmar_eliminacion()
{
	echo "<script>confirmar()</script>";
}

?>
