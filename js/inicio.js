$(document).ready(function(){

$("#ampliar").click(function(){
  /*$("#content").hide(500).animate("slow");
    $("#sidebar").animate({width: '1160px', opacity: '1'}, "slow");
    $("#mapa").css('display', 'inline');
    $('#ampliar').css('display', 'none');
    $('#reducir').css('display', 'inline');
    $('#add-lugar').attr('id','add-lugar-expand');*/
     window.location='inicio.php?id=add_monumento';

 });
 /*$("#reducir").click(function(){
     $("#sidebar").animate({width: '300px', opacity: '1'}, "slow");
     $("#content").show(1000).animate("slow");
     $("#mapa").css('display', 'none');
     $('#ampliar').css('display', 'inline');
     $('#reducir').css('display', 'none');
     $('#add-lugar-expand').attr('id','add-lugar');
  });*/

function confirmar(){
  if(confirm("Estás seguro?"))
    window.location.href ="";
  else {
    return false;
  }
}


$(".lugares_sel").change(function () {
  var total = $(".lugares_sel:checked").length;
  $(".info").html(total+" lugares serán eliminados");
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
  $(".info").html(total+" lugares serán eliminados");
});

});
