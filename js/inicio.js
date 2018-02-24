$(document).ready(function(){

$("#ampliar").click(function(){
     window.location='inicio.php?id=add_monumento';

 });

function confirmar(){
  if(confirm("Estás seguro?"))
    window.location.href ="";
  else {
    return false;
  }
}


$(".lugares_sel").change(function () {
  var total = $(".lugares_sel:checked").length;
  $(".info").html(total+" se eliminarán");
 });


$(".checkbox_all").change(function () {
    if ($(this).is(':checked')) {
        //$("input[type=checkbox]").prop('checked', true); //todos los check
        $(".lugares_sel").prop('checked', true); //solo los del objeto #diasHabilitados
    } else {
        //$("input[type=checkbox]").prop('checked', false);//todos los check
        $(".lugares_sel").prop('checked', false);//solo los del objeto #diasHabilitados
    }

    var total = $(".lugares_sel:checked").length;
  $(".info").html(total+" se eliminarán");
});

// Funcines para marcar todos los dias de la semana o desmarcarlos

  $("#t_dias").change(function () {
    if ($(this).is(':checked')) {
        $(".d_semana").prop('checked', true);
    } else {
        $(".d_semana").prop('checked', false);
    }

  });

  $(".d_semana").change(function () {
    if (!$(this).is(':checked')) {
        $("#t_dias").prop('checked', false);
    }

    let num = 0;
    $(".d_semana").each(function() {
      if($(this).is(":checked")){
        num++;
      }
      if(num>=7)
        $("#t_dias").prop('checked', true);
      else
        $("#t_dias").prop('checked', false);
    });
  });

});
