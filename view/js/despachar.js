$(document).ready(function () {
  despachar();
});

function despachar() {
  $("#despacharPedidos").click(function() {
    var frm = $(".despacho").serialize();
    console.log(frm);
    $.ajax({
      "method" : "POST",
      "url" : "menuAdmin.php?modo=despacharPedidos",
      "data" : frm
    }).done( function(info) {

    $('#mensaje').html(info);

    });

  });
}
