$(document).ready(function () {
  enviarPedidoRegistro();
  inputPedido();
  convertirVolumen();
});

function convertirVolumen()
{
  $('#convertirVolumen').click(function () {
    var valorInput = $('#valor1').val();
    var combo1 = $('#unidad1').val();
    var combo2 = $('#unidad2').val();
    $('#respuestaVolumen').addClass('well');
    $('#respuestaVolumen').html(valorInput+combo1+combo2);
  });
}

function primerSwith(unidad1, unidad2)
{
  switch (unidad1) {
    case 1:
      var combo2 = segundoSwith(unidad2);
      break;
    case 2:

      break;
    case 3:

      break;
    case 4:

      break;
    case 5:

      break;
    case 6:

      break;
  }
}

function segundoSwith(unidad2)
{
  var valor = 0;

  switch (unidad2) {
    case 1:
      valor = 1;
      break;
    case 2:

      break;
    case 3:

      break;
    case 4:

      break;
    case 5:

      break;
    case 6:

      break;
  }
  return valor;
}

function reglaDeTres(var1, var2, input1)
{
  var resultado = (var1 * input1) / var2;
  return resultado;
}

function inputPedido()
{
  $('.solo-numero-float').on('input', function () {
    this.value = this.value.replace(/[^._0-9]/g,'');
  });
}

function enviarPedidoRegistro() {
  $('#guardarPedido').click(function (e) {
    e.preventDefault();
    var cantidades = $('.cantidaPedido').serialize();
    var idProducto = $('.idPedido').serialize();
    var idPlato = $('#platoPedido').serialize();
    var data = cantidades + "&" + idPlato + "&" + idProducto;
    console.log(data);
    $.ajax({
      "method" : "POST",
      "url" : "menuNutricionista.php?modo=registrarPedido",
      "data" : data
    }).done(function (info) {
      $('#mensajeRespuesta').html(info);
    });
  });
}
