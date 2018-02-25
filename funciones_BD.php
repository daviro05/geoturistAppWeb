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

echo $nombre_img[0];

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
	   //si existe la variable pero se pasa del tama�o permitido
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
				<td><a href='inicio.php?id=monumentos&eliminar=$fila[id_lugar]'	class='ico del'>Eliminar</a>
				<a href='inicio.php?id=ver_monumento&id_lugar=$fila[id_lugar]
				&nombre_lugar=$fila[nombre]&lat=$fila[latitud]&lon=$fila[longitud]' class='ico edit'>Editar</a></td>
			</tr>";
		}
	}
}

function eliminar_lugar($id_lugar,$conexion){
	$eliminar = mysqli_query($conexion,"DELETE FROM lugares WHERE id_lugar='$id_lugar'");
	echo "<script>window.location = './inicio.php?id=monumentos'</script>";
}



function info_comentarios($conexion){
	$ver_comen = mysqli_query($conexion,"SELECT * FROM comentarios");

	if($ver_comen){
		while($fila = mysqli_fetch_array($ver_comen))
		{
			echo "<tr>
					<td><a>$fila[id_lugar]</a></td>
					<td><a>$fila[comentario]</a></td>
				</tr>";
		}
	}
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
					<td><a href='inicio.php?id=ver_monumento&inicio.php?id=ver_monumento&id_lugar=$fila[id_lugar]
					&nombre_lugar=$_GET[nombre_lugar]&lat=$_GET[lat]&lon=$_GET[lon]
					&tipo_archivo=$tipo&url=$fila[$url]&eliminar=true'>Eliminar</a></td>
					<td> - </td>
					<td><a href='./multimedia/$tipo/$fila[$url]'>$fila[$url]</a></td>
				</tr>";
		}
	}


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


function alta_usuario($id_usuario,$nombre,$apellidos,$password,$email,$fechaNacimiento,
	$sexo,$comentarios,$visitas,$conexion)
{
	$alta_usuario = mysqli_query($conexion,"INSERT INTO usuarios (id_usuario,nombre,apellidos,password,email,fechaNacimiento,sexo,comentarios,visitas,img_perfil)
		VALUES('$id_usuario','$nombre','$apellidos','$password','$email','$fechaNacimiento',
	'$sexo','$comentarios','$visitas','vacio.png')");

	if($alta_usuario){
		if($_FILES['imaperfil']['size'] != 0){
			subir_imagenes_perfil($id_usuario,$conexion);
		}
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
				<td><input type='checkbox' name='lug_sel[]' class='lugares_sel' value='$fila[id_usuario]'/></td>
				<td><img class='img_perfil' src='./multimedia/img_perfiles/$fila[img_perfil]'></td>
				<td>$fila[id_usuario]</td>
				<td>$fila[nombre]</td>
				<td>$fila[apellidos]</td>
				<td>$fila[email]</td>
				<td>$fila[fechaNacimiento]</td>
				<td>$fila[sexo]</td>
				<td>$fila[comentarios]</td>
				<td>$fila[visitas]</td>
				<td><a href='inicio.php?id=usuarios&eliminar=$fila[id_usuario]' class='ico del'>Eliminar</a>
				<a href='inicio.php?id=ver_usuario&id_usuario=$fila[id_usuario]' class='ico edit'>Editar</a></td>
			</tr>";
		}
	}
}

#######################################
###### FUNCIONES DE BÚSQUEDA ##########
#######################################


function busqueda($valor){

	$conexion=conecta();

	echo "<div id='hijo'>";
	$consulta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE nick LIKE '%$b%'");
	while($col = mysqli_fetch_array($consulta)){
			// reunir los resultados
		$resultados.= "<h2><a href='/$col[nick]'>$col[nick]</a></h2>\r\n";
	}

	if($resultados){

		$time = number_format($time_end - $time_start,4,'.','');
		echo $resultados;

	}else{

			//echo "<p>No existen resultados</p>";

	}
	echo "</div>";
}


function ver_cuenta($usuario)
{
	$conexion=conecta();

	$consultar_cuenta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE nick='$usuario'");

	$tipo="";
	$abandonar="";
	$existe=false;
	$usuario='';

	if($consultar_cuenta)
	{
		while($fila = mysqli_fetch_array($consultar_cuenta))
		{

			echo "<table class='micuenta' align='center'>
			<tr><td>Nick de usuario: $fila[nick]</td></tr>
			<tr><td>Nombre: $fila[nombre]</td></tr>
			<tr><td>Apellidos: $fila[apellidos]</td></tr>
			<tr><td>E-Mail: $fila[email]</td></tr>
			<tr><td>Edad: $fila[edad]</td></tr>
			<tr><td>Sexo: $fila[sexo]</td></tr>
			<tr><td>Musica Preferida: $fila[musica_preferida]</td></tr>
			<tr><td></td></tr></table>";
		}
	}
}


function meter_grupo($nombre_grupo,$usuario,$tipo_musica,$edad_min,$edad_max,$conexion)
{
	$comprobar_usuario = mysqli_query($conexion,"SELECT nick FROM usuarios WHERE musica_preferida='$tipo_musica' AND '$edad_min'<=edad AND
		'$edad_max' >= edad ");

	if($comprobar_usuario)
	{
		while($fila = mysqli_fetch_array($comprobar_usuario))
		{
			$insertar = mysqli_query($conexion,"INSERT INTO usuario_grupo VALUES('$fila[nick]','$nombre_grupo')");
		}
	}

}

function asignar_grupo($usuario,$edad,$tipo_musica,$conexion){
	$edades = mysqli_query($conexion,"SELECT nombre_grupo FROM grupos WHERE tipo_musica='$tipo_musica' AND edad_min<='$edad'
		AND edad_max>='$edad'");

	if($edades){
		while($fila = mysqli_fetch_array($edades))
		{
			$insertar = mysqli_query($conexion,"INSERT INTO usuario_grupo VALUES('$usuario','$fila[nombre_grupo]')");
		}
	}


}

#######################################
####### FUNCIONES DE MENSAJES #########
#######################################


function enviar_mensaje($emisor,$destinatario,$mensaje,$asunto,$conexion)
{
	$id_mensaje = time();

	$enviar_mensaje = mysqli_query($conexion,"INSERT INTO mensajes VALUES('$id_mensaje','$destinatario','$emisor','$asunto','$mensaje',now(),'-')");

	if($enviar_mensaje)
		echo "<p class='correcto'>Mensaje enviado!</p>";
}

function enviar_mensaje_grupo($emisor,$destinatario,$mensaje,$asunto,$conexion)
{

	$destinatarios = mysqli_query($conexion,"SELECT nick from usuario_grupo where nombre_grupo='$destinatario'");

	if($destinatarios){
		while($fila = mysqli_fetch_array($destinatarios))
		{
			$id_mensaje = $fila['nick'].time();
			$enviar_mensaje = mysqli_query($conexion,"INSERT INTO mensajes VALUES('$id_mensaje','$fila[nick]','$emisor','$asunto','$mensaje',now(),'$destinatario')");
		}
		echo "<p class='correcto'>Mensaje enviado!</p>";
	}

}

function individual_a_todos($emisor,$mensaje,$asunto,$conexion){
	$consultar_destinatarios = mysqli_query($conexion,"SELECT nick from usuarios");

	if($consultar_destinatarios)
	{
		while($fila = mysqli_fetch_array($consultar_destinatarios))
		{
			$id_mensaje = $fila['nick'].time();
			$insertar = mysqli_query($conexion,"INSERT INTO mensajes
				VALUES('$id_mensaje','$fila[nick]','$emisor','$asunto','$mensaje',now(),'-')");
			if(!$insertar)
				echo "".mysqli_error($conexion) ."<br>";
		}
		echo "<p class='correcto'>Mensaje enviado!</p>";
	}

}


function grupo_a_todos($emisor,$mensaje,$asunto,$conexion){

	$consultar_destinatarios = mysqli_query($conexion,"SELECT nombre_grupo from usuario_grupo where nick='$emisor'");

	if($consultar_destinatarios)
	{
		while($grupo = mysqli_fetch_array($consultar_destinatarios))
		{
			$obtener_destinos = mysqli_query($conexion,"SELECT nick from usuario_grupo where nombre_grupo='$grupo[nombre_grupo]'");
			while($grupo_usuario = mysqli_fetch_array($obtener_destinos)){
				$id_mensaje = $grupo_usuario['nick'].$grupo['nombre_grupo'].time();
				$insertar = mysqli_query($conexion,"INSERT INTO mensajes
					VALUES('$id_mensaje','$grupo_usuario[nick]','$emisor','$asunto','$mensaje',now(),'$grupo[nombre_grupo]')");

				if(!$insertar)
					echo "".mysqli_error($conexion) ."<br>";
			}
		}
		echo "<p class='correcto'>Mensaje enviado!</p>";
	}
}


function generar_destinatarios($usuario,$conexion)
{
	//WHERE nick!='$usuario'
	$consultar_destinatarios = mysqli_query($conexion,"SELECT nick from usuarios");

	if($consultar_destinatarios)
	{
		echo "<option value='Todos'>Todos</option>";
		while($destinatario = mysqli_fetch_array($consultar_destinatarios))
		{
			echo "<option value='$destinatario[nick]'>$destinatario[nick]</option>";
		}
	}
	else
	{
		echo "<option>Error BBDD</option>";
	}
}

function generar_grupos($usuario,$conexion)
{
	$consultar_destinatarios = mysqli_query($conexion,"SELECT nombre_grupo from usuario_grupo where nick='$usuario'");

	if($consultar_destinatarios)
	{
		echo "<option value='Todos'>Todos</option>";
		while($destinatario = mysqli_fetch_array($consultar_destinatarios))
		{
			echo "<option value='$destinatario[nombre_grupo]'>$destinatario[nombre_grupo]</option>";
		}
	}
	else
	{
		echo "<option>Error BBDD</option>";
	}
}

function ver_mensajes_recibidos($usuario,$conexion)
{
	$ver_mensajes_r = mysqli_query($conexion,"SELECT * FROM mensajes WHERE nick_usuario_re='$usuario' ORDER BY fecha_hora DESC");
	$i=0;
	if($ver_mensajes_r)
	{
		echo "<p class='recibidos'>MENSAJES RECIBIDOS</p>";

		echo "<table class='mensajes'><tr><td><b>Origen</b></td><td><b>Grupo</b></td><td><b>Asunto</b></td><td><b>Acci&oacute;n</b></td><td><b>Eliminar</b></td></tr></table>";
		echo "<div id='div2'><table class='cuadro_men'>";

		while($mensaje_r = mysqli_fetch_array($ver_mensajes_r))
		{
			$mensacod = base64_encode($mensaje_r['id_mensaje']);
			$i++;
			echo "<tr>
			<td>$mensaje_r[nick_usuario_em]</td><td>$mensaje_r[tipo]</td><td>$mensaje_r[asunto]</td>
			<td><a class='mensa' href='mensajes.php?user=$_SESSION[usuario]&id=$mensacod&action=leer&metodo=entrada'>
			<img class='ico_men' src='./img/mensaje.png'></a></td>
			<td><a class='mensa' href='mensajes.php?user=$_SESSION[usuario]&id=$mensacod&action=eliminar&metodo=entrada'><img class='ico_men' src='./img/error.png'></a></td>
			</tr>";
		}
		if($i==0)
			echo "<b>No hay mensajes</b>";
}
	echo "</table></div>";
}

function ver_mensajes_enviados($usuario,$conexion)
{
	$ver_mensajes_e = mysqli_query($conexion,"SELECT * FROM mensajes WHERE nick_usuario_em='$usuario' ORDER BY fecha_hora DESC");
	$j=0;

	if($ver_mensajes_e)
	{
		echo "<p class='enviados'>MENSAJES ENVIADOS</p>";

		echo "<table class='mensajes'><tr><td><b>Destino</b></td><td><b>Grupo</b></td><td><b>Asunto</b></td><td><b>Acci&oacute;n</b></td><td><b>Eliminar</b></td></tr></table>";
		echo "<div id='div1'><table class='cuadro_men'>";

		while($mensaje_e = mysqli_fetch_array($ver_mensajes_e))
		{
			$mensacod = base64_encode($mensaje_e['id_mensaje']);
			$j++;

			echo "<tr>
			<td>$mensaje_e[nick_usuario_re]</td><td>$mensaje_e[tipo]</td><td>$mensaje_e[asunto]</td>
			<td><a class='mensa' href='mensajes.php?user=$_SESSION[usuario]&id=$mensacod&action=leer&metodo=salida'>
			<img class='ico_men' src='./img/mensaje.png'></a></td>
			<td><a class='mensa' href='mensajes.php?user=$_SESSION[usuario]&id=$mensacod&action=eliminar&metodo=salida'>
			<img class='ico_men' src='./img/error.png'></a></td>
			</tr>";
		}
		if($j==0)
			echo "<b>No hay mensajes</b>";
	}
	echo "</table></div>";
}

function leer_mensaje($usuario,$id_mensaje,$conexion)
{
	$leer_mensaje = mysqli_query($conexion,"SELECT * from mensajes where id_mensaje='$id_mensaje'");

	if($leer_mensaje)
	{
		if($mensaje = mysqli_fetch_array($leer_mensaje))
		{
			echo "<table class='mensajes2' align='center'>
			<textarea class='cuadro_lect' style='resize:none;font-weight:bold' rows='10' cols='50' readonly>--------------------------------------------------\nEnviado el: $mensaje[fecha_hora] \nDe: $mensaje[nick_usuario_em]\nPara: $mensaje[nick_usuario_re]\n--------------------------------------------------\n\n$mensaje[mensaje]</textarea>
		</table>";
	}
}
if(isset($_GET['metodo'])=='entrada')
{
	$bandeja = "Entrada";
}
else
{
	$bandeja = "Salida";
}
echo "<a class='cambiar' href='mensajes.php?metodo=$_GET[metodo]'>Volver a Bandeja de $bandeja</a>";

}

function eliminar_mensaje($usuario,$id_mensaje,$conexion)
{
	$elimina_mensaje = mysqli_query($conexion,"DELETE FROM mensajes WHERE id_mensaje='$id_mensaje'");

	if($elimina_mensaje)
	{
		echo "<p class='correcto'>Se ha eliminado el mensaje.</p>";
	}
	else
	{
		echo "<p class='aviso'>Error al eliminar el mensaje.</p>";
	}
	if(isset($_GET['metodo'])=='entrada'){$bandeja = "Entrada";}else{$bandeja = "Salida";}
	echo "<a class='cambiar' href='mensajes.php?metodo=$_GET[metodo]'>Volver a Bandeja de $bandeja</a>";
}


function generar_usuarios($usuario,$conexion)
{
	$consultar_usuarios = mysqli_query($conexion,"SELECT nick from usuarios");

	if($consultar_usuarios)
	{
		while($usuario_encotrado = mysqli_fetch_array($consultar_usuarios))
		{
			echo "<input type='checkbox' name='usuario_sel[]' value='$usuario_encotrado[nick]'> $usuario_encotrado[nick]";
		}
	}
	else
	{
		echo "Error BBDD";
	}
}

#######################################
####### FUNCIONES DE ELIMINAR #########
#######################################


function confirmar_eliminacion()
{
	echo "<script>confirmar()</script>";
}

?>
