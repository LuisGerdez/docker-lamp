function validarCodigo2() {
    $.ajax({
      type: "POST",
      url: "../../bandejaview/verificar_code.php",
      data:$('#formulario').serialize(),
      success: function(response) {
        
        $("#broken").html(response);
      },
    })
}