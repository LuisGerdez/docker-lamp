<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<LINK REL=StyleSheet HREF="../../bandejaview/css/btn_modal.css" TYPE="text/css" MEDIA=screen>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php
require_once "../../config/APP.php";
include '../../conexion.php';
$boton = ('<button type="button" class="btn btn-primary btn_valiar" data-bs-toggle="modal" id="nextobj" data-bs-target="#exampleModal2" data-bs-whatever="@getbootstrap" style="background:none;border:none;" ><img style="background:white;border:1px solid #006CD8;border-radius:50%;padding: 5px 5px 5px 5px;"src="../../bandejaview/img/flecha-validar.png"></button>')
?>
<!-- VALIDA MODAL -->
<script>
    function validarCodigo() {
            $.ajax({
              type: "POST",
              url: "../../bandejaview/verificar_code.php",
              data:$('#formulario').serialize(),
              success: function(response) {
                //  alert('otp');
                $("#broken").html(response);
              },
            })
      }
</script>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <div class="panel-parrafo">
        <p>* Por favor ingrese el c&oacute;digo de seguridad</p>
      </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post"  name="formulario" id="formulario">
        <p id="broken"></p>
            <div class="container-validar">
                <div class="validar-panel">
                    <div class="panel-label">
                        <label><b>C&Oacute;DIGO</b></label>
                    </div>
                    <div class="panel-input">
                        <input type="text" id="verificar_codigo" name="verificar_codigo"
                        value="<?php if(isset($_POST['verificar_codigo'])){echo $_POST['verificar_codigo'];}?>" placeholder="C&oacute;digo de activaci&oacute;n" autofocus
                        >
                        <input type="hidden" name="trade_id" id="trade_id">
                    </div>
                    <div id="panel-invalido">
                        <p>Codigo invalido</p>
                    </div>
                    <div class="panel-boton">
                        <button type="button" name="enviar" onclick="validarCodigo2();">Validar</button>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>
<script>
$(document).ready(function() {
  alert("btn-modal-bandejaview");
    $(document).on("click", "#nextobj", function() {
        var id = $(this).next().val();
        var trade_id = $("#trade_id").attr("value", id);

    })
})
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>