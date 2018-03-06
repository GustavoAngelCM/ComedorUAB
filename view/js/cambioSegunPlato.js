$(document).ready(function () {
  cambioSelect();
});

function cambioSelect() {
  $('#platoPedido').change(function (e) {
    e.preventDefault();
    var data = $('#platoPedido').serialize();
    $.ajax({
      "method" : "POST",
      "url" : "menuNutricionista.php?modo=cambioProductos",
      "data" : data
    }).done(function (info) {
      $('#tablaRespuesta').html(info);
    });
  });
}
