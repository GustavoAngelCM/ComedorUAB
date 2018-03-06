$(document).ready(function () {
  contrasenasIguales();
});

function contrasenasIguales() {
  $("#saveUser").click(function(e) {
    var contra = $("#contra").val();
    var contraNew = $("#contraNew").val();
    if (contra != contraNew)
    {
      e.preventDefault();
      $("#mensaje").html("<p style='color:red'>Contraseñas distintas</p>");
    }
  });
}
