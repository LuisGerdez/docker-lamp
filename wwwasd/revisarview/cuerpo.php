<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<script>
function enviarFormulario() {
    document.getElementById('boton_enviar').disabled = true;
    document.formulario.submit();
}

function volverAtras() {
    history.go(-1)
}
</script>

<?php 

$nombre_documento = $_POST["nombre"];
$correo_documento = $_POST["correo"];
$id_formulario = $_POST["id_formulario"];

?>

<form action="../ControllerVista/ControllerVista.php" method="post" target="" name="formulario" id="formulario">
    <div class="cuerpo-container">
        <div class="cuerpo-titulo">
            <label>Firmar y enviar</label>
        </div>
        <div class="container-contenido">
            <div class="cuerpo-contenido">
                <div class="cuerpo-asunto">
                    <label>Asunto del correo electrónico*</label>
                    <input class="input-asunto" type="text" name="asunto" />
                </div>
                <div class="cuerpo-mensaje">
                    <label>Mensaje del correo electrónico</label>
                    <textarea style="resize: none;" id="campo_texto_area" name="mensaje" rows="11" cols="10"></textarea>
                </div>
            </div>
            <div class="cuerpo-resumen">
                <div class="resumen-contenido">
                    <div class="resumen-opciones">
                        <label>RESUMEN</label>
                    </div>
                    <div class="resumen-documento">
                        <div class="documento-opciones">
                            <label>Documento</label>
                        </div>
                        <div class="documento-archivo" style="word-wrap: break-word;">
                            <label><?php echo $nombre_documento; ?></label>

                        </div>
                    </div>
                    <div class="resumen-destinatarios">
                        <div class="destinatarios-opciones">
                            <label>Destinatario</label>
                        </div>
                        <div class="destinatarios-destinatarios">

                            <div style="padding-left:10%;" class="destinatarios-bloque2">
                                <label for=""><?php echo $_SESSION['firmante']; ?>.</label>
                                <p><?php echo $correo_documento; ?></p>
                            </div>

                        </div>
                        <?php
                        
                        ?>
                    </div>

                    <div class="resumen-firmantes">
                        <div class="destinatarios-opciones">
                            <label>Firmantes</label>
                        </div>
                    </div>
                    <div style="padding-left:10%;" class="destinatarios-bloque2">
                        <label for=""><?php echo $_SESSION['firmante']; ?>.</label>

                    </div>
                    <?php if(explode('-',$nombre_documento)[0]!='Contract') {?>
                    <div style="padding-left:10%;" class="destinatarios-bloque2">
                        <label><?php echo $_SESSION['nombre_usuario'] ." ". $_SESSION['apellido_usuario'];  ?></label><br>     
                        <!-- //este ation es para dealers -->
                        <input type="hidden" name="accion" value="2">

                        <input type="hidden" name="nombre_documento" value="<?php echo $nombre_documento; ?>">
                        <input type="hidden" name="correo_documento" value="<?php echo $correo_documento; ?>">
                        <input type="hidden" name="id_formulario" value="<?php echo $id_formulario; ?>">

                    </div>
                    <?php } else {?>
                        <input type="hidden" name="accion" value="SendEmailCourstAtKendall">

                        <input type="hidden" name="nombre_documento" value="<?php echo $nombre_documento; ?>">
                        <input type="hidden" name="correo_documento" value="<?php echo $correo_documento; ?>">
                        <?php } ?>
                    
                </div>
            </div>

           
        </div>
    </div>
    </div>
    <div class="container-botones">
        <div class="cuerpo-botones">
            <button type="button" title="volver" onclick="volverAtras();"><i
                    class="fas fa-arrow-left"></i>Volver</button>
            <button id="boton_enviar" title="siguiente" onclick="enviarFormulario();">Enviar<i
                    class="fas fa-arrow-right"></i></button>
        </div>
    </div>
    </div>
</form>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
    $("#boton_enviar").on("click", function() {
        let timerInterval
        Swal.fire({
            title: 'Se está haciendo el envío de documento/s!',
            html: 'Esta ventana se cerrará automáticamente.',
            timer: 5000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
            }
        })
    })
})
</script>