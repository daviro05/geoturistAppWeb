$(document).ready(function() {

    // Llamamos a las funciones la primera vez para que no tarde en cargar   
    actualizarMostrarLugares();
    
    function actualizarMostrarLugares(){
      var tipo="mostrar_lugares";
	
	$.ajax({
		type: 'POST',
        url: "actualizar.php?tipo="+tipo,
		success: function(respuesta) {

			$('#tabla_lugares').html(respuesta);
	   }
	});
	
    }
    setInterval(actualizarMostrarLugares,2000)//Actualizamos cada 2 segundos
});