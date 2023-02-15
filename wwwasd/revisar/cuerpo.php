<?php
include "../Models/CSRFToken.php";
use \Models\Session;

$usunom = $_SESSION['nombre_usuario'];
$usuape = $_SESSION['apellido_usuario'];
$usuario = $usunom." ".$usuape;

$idArchivo = NULL;
$nombreArchivo = NULL;
$rutaArchivo = NULL;

if (isset($_POST['nombre_archivo'])) {
    $nombre_archivo = $_POST['nombre_archivo'];
    $idArchivo = $_POST['idArchivo'];
    $nombreArchivo = $_POST['nombreArchivo'];
    $rutaArchivo = $_POST['rutaArchivo'];
} else {
    $nombre_archivo = "Cargando...";
}

if (isset($_POST['array_nombres'])) {
    $array_nombres = $_POST['array_nombres'];
}
if (isset($_POST['array_correos'])) {
    $array_correos = $_POST['array_correos'];
}
if (isset($_POST['no_firmante'])) {
    $no_firmante = $_POST['no_firmante'];
}
if(isset($_POST['opciones_firma'])){
    $opciones_firma = $_POST['opciones_firma'];
}
?>
<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>

<form action="index.php" method="post" target="" name="formulario" id="formulario">
    <div class="cuerpo-container">
        <div class="cuerpo-titulo">
            <label>Firmar y enviar</label>
        </div>
        <div class="container-contenido">
            <input type="hidden" name="tokenCSRF" id="tokenCSRF">
            <div class="cuerpo-contenido">
                <div class="cuerpo-asunto">
                    <label>Asunto del correo electrónico*</label>
                    <input class="input-asunto" type="text" name="asunto" />
                </div>
                <div class="cuerpo-mensaje">
                    <label>Mensaje del correo electrónico</label>
                    <textarea name="mensaje" rows="20" cols="10" class="textArea"></textarea>
                </div>
            </div>
            <div class="cuerpo-resumen">
                <div class="resumen-contenido">
                    <div class="resumen-opciones">
                        <label>RESUMEN</label>
                    </div>
                    <div class="resumen-documento">
                        <div class="documento-opciones">
                            <label>Documentos</label>
                        </div>
                        <div class="documento-archivo">
                            <label style="word-wrap: break-word;"><?php echo $nombre_archivo ?></label>
                        </div>
                    </div>
                    <div class="resumen-destinatarios">
                        <div class="destinatarios-opciones">
                            <label>Destinatarios</label>
                        </div>
                        <?php
                        $nombres = explode("*/*", $array_nombres);
                        $correos = explode("*/*", $array_correos);
                        for ($i = 0; $i < sizeof($nombres) - 1; $i++) {
                            ?>
                            <div class="destinatarios-destinatarios">
                                <div class="destinatarios-bloque1">
                                    <div class="cuerpo-icono">
                                        <?php echo strtoupper($nombres[$i][0]); ?>
                                    </div>
                                </div>
                                <div class="destinatarios-bloque2">

                                    <label><?php echo $nombres[$i] ?></label>
                                    <p><?php echo $correos[$i] ?></p>
                                </div>

                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="resumen-firmantes">
                        <div class="destinatarios-opciones">
                            <label>Firmantes</label>
                        </div>
                        <?php 
                        if($opciones_firma !== "no_firmante"){
                            ?>
                            <div class="destinatarios-destinatarios">
                                <div class="destinatarios-bloque1">
                                    <div class="cuerpo-icono">
                                        <?php echo strtoupper($usuario[0]); ?>
                                    </div>
                                </div>
                                <div class="destinatarios-bloque2">
                                    <label><?php echo $usuario ?></label>
                                </div>
                                <div></div>
                            </div>
                            <?php 
                        }
                        ?>
                        <?php
                        $nombres = explode("*/*", $array_nombres);
                        $correos = explode("*/*", $array_correos);
                        for ($i = 0; $i < sizeof($nombres) - 1; $i++) {
                            ?>
                            <div class="destinatarios-destinatarios">
                                <div class="destinatarios-bloque1">
                                    <div class="cuerpo-icono">
                                        <?php echo strtoupper($nombres[$i][0]); ?>
                                    </div>
                                </div>
                                <div class="destinatarios-bloque2">
                                    <label><?php echo $nombres[$i] ?></label>
                                </div>
                                <div></div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <input type="hidden" name="array_correos" value="<?php echo $array_correos;?>">
                    <input type="hidden" name="array_nombres" value="<?php echo $array_nombres;?>">
                    <input type="hidden" name="nombre_archivo" value="<?php echo $nombre_archivo;?>">
                    <input type="hidden" name="idArchivo" value="<?php echo $idArchivo;?>" />
                    <input type="hidden" name="nombreArchivo" value="<?php echo $nombreArchivo;?>" />
                    <input type="hidden" name="rutaArchivo" value="<?php echo $rutaArchivo;?>" />
                    <input type="hidden" name="no_firmante" value="<?php echo $no_firmante;?>" />
                    <input type="hidden" name="opciones_firma" value="<?php echo $opciones_firma?>" />
                    <input type="hidden" name="metodo" value="enviar">
                </div>
            </div>
        </div>
        <div class="container-botones">
            <div class="cuerpo-botones">
                <button type="button" title="volver" onclick="volverAtras();"><i class="fas fa-arrow-left"></i>Volver</button>
                <button type="button" id="boton_enviar" title="siguiente" onclick="enviarFormulario();">Enviar<i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
</form>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</div>
<?= CSRFToken::setToken(); ?>

<script>
    function enviarFormulario() {

        let tokenCampo= document.getElementById('tokenCSRF').value;
        let tokenSesion = '<?= $_SESSION['csrf']; ?>';

        if(tokenSesion == tokenCampo) {
            document.getElementById('boton_enviar').disabled = true;
            document.formulario.submit();
        }
    }
    
    function volverAtras(){
        history.go(-1)
    }
</script>
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