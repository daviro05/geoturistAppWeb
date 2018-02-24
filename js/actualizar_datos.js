$(document).ready(function() {

    // Llamamos a las funciones la primera vez para que no tarde en cargar   
    actualizar_lugares();
    actualizar_usuarios();
    
    function actualizar_lugares(){
      var tipo="lugares";
	
	$.ajax({
		type: 'POST',
        url: "actualizar.php?tipo="+tipo,
		success: function(respuesta) {

			$('#up_lugares').html(respuesta);
	   }
	});
	
}

function actualizar_usuarios(){
    var tipo="usuarios";
  
  $.ajax({
      type: 'POST',
      url: "actualizar.php?tipo="+tipo,
      beforeSend: function () {
        $("#up_usuarios").html("Procesando, espere por favor...");
        },
      success: function(respuesta) {

          $('#up_usuarios').html(respuesta);
     }
  });
  
}

setInterval(actualizar_lugares,8000)//Actualizamos cada 2 segundos
setInterval(actualizar_usuarios,8000)//Actualizamos cada 2 segundos
});