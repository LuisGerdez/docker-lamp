<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<LINK REL=StyleSheet HREF="./btn_modal.css" TYPE="text/css" MEDIA=screen>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php
require_once "../config/APP.php";

$boton = ('<button type="button" class="btn btn-primary btn_modal_inicio" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap" > Firmar   <i class="fas fa-arrow-right"></i></button>')
?>
<script>
    function Enviar() {
            $.ajax({
              type: "POST",
              url: "verificar_code.php",
              data:$('#formulario').serialize(),
              success: function(response) {
                //  alert('otp');
                $("#broken").html(response);
              },
            })
      }
      function optenerOtp() {
        $.ajax({
                  type: "POST",
                  url: "envio_otp.php",
                  data:$('#formulario_otp').serialize(),
                  beforeSend:function(){
                    document.getElementById("boton_otp").style.display="none"
                    document.getElementById("load").style.display="block"
                    document.getElementById("load").innerHTML=`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando ......`
                  },
                  success: function(response) {
                    //  alert('otp');
                    document.getElementById("load").style.display="none"
                    $("#broken").html(response);
                    document.getElementById("boton_otp").style.display="block"
                  },            
              });
      }
</script>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="tutilo">
          <p>Ingrese el Codigo de verificacion que se envió a su correo</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" name="formulario" id="formulario">
          <p id="broken"></p>

            <div class="mb-3">
              <input type="number" class="form-control" id="verificar_codigo" name="verificar_codigo"
              value="<?php if(isset($_POST['verificar_codigo'])){echo $_POST['verificar_codigo'];}?>" placeholder="C&oacute;digo de activaci&oacute;n" autofocus>
            </div>
          
                <div class="modal-footer">
                <button class="btn btn-primary" type="button" name="enviar" onclick=" Enviar()" >
                  Validar
                </button>
              </div>
        </form>
        <form method="post" name="formulario_otp" id="formulario_otp">
          <p id="broken"></p>
            <button class="btn btn-primary btn_otp enviar" type="button" name="enviar" id="boton_otp" onclick=" optenerOtp()">
              Obtener codigo de verificacio 
            </button>
            <span id="load" class="btn btn-primary btn_otp col-md-6" style="display: none;" ></span>
         </form>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>