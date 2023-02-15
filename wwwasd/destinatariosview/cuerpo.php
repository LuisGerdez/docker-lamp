<?php
include '../conexion.php';

$nombre_usuario = $_SESSION['nombre_usuario'];
$apellido_usuario = $_SESSION['apellido_usuario'];

if(isset($_POST['ContratoSuntic'])=='ContratoSuntic'){
    echo "<script type='text/javascript'>
    window.location.href='../plantillas/tradein_pronto_pago.php';
    </script>";
}

if (isset($_POST['plantilla'])) {
    $plantillas = $_POST['plantilla']; 

    //vamos a guardar los nombres d e las plantillas
    for ($i = 0; $i < count($plantillas); ++$i) {
        $sql = "SELECT nombre_plantilla FROM plantilla WHERE id_plantilla='" . $plantillas[$i] . "'";
        $result = $link->query($sql);

        foreach ($result as $name) {
            $nombres[] = $name['nombre_plantilla'];
        }
    }

    $namesTemplates=implode(",",$nombres);
}
?>

<link rel=stylesheet href="cuerpo.css" TYPE="text/css" MEDIA=screen>
<link rel=stylesheet href="formulario.css" TYPE="text/css" MEDIA=screen>

<script src="./javascript.js"></script>

<script>
    function enviarFormulario() {
        let nombre = document.getElementById('nombre0').value;
        let correo = document.getElementById('correo0').value;

        if (nombre) {
            if (correo) {
                document.formulario.submit();
            } else {
                alert('Debe ingresar un correo electrónico');
            }
        } else {
            alert('Debe ingresar un nombre');
        }
    }

    function volverAtras() {
        history.go(-1)
    }
</script>

<form action="../ControllerVista/ControllerVista.php" method="post" name="formulario" id="formulario">
    <div class="cuerpo-container">
        <div class="container-contenido">
            <label>A&ntilde;adir firmantes</label>
            <br><br>
            <div class="cuerpo-documento">
                <div class="cuerpo-icono">
                    <i class="fas fa-check"></i>
                </div>
                <div class="cuerpo-label">
                    <div class="cuerpo-label-titulo"><label>Remitente: </label></div>
                    <div class="cuerpo-label-contenido">
                        <label><?php echo $nombre_usuario." ".$apellido_usuario ?></label></div>
                </div>
            </div>

            <div class="cuerpo-separador"></div>

            <div class="cuerpo-documento">
                <div class="cuerpo-icono">
                    <i class="fas fa-check"></i>
                </div>
                <div class="cuerpo-label">
                    <div class="cuerpo-label-titulo"><label>Destinatario: </label></div>
                </div>
            </div>

            <div class="cuerpo-separador"></div>

            <div class="cuerpo-formulario">
                <form action="action">

                    <div id="destinatarios">
                        <?php include './formulario.php'; ?>
                    </div>

                </form>
            </div>
            <div class="cuerpo-botones">
                <button type="button" title="volver" onclick="volverAtras();"><i
                        class="fas fa-arrow-left"></i>Volver</button>
                <button type="button" title="siguiente" onclick="enviarFormulario();">Siguiente<i
                        class="fas fa-arrow-right"></i></button>
            </div>

            <!-- PLANTILLAS DEALAERS -->
            <?php  if (isset($_POST['plantilla'])) {?>
            <input type="hidden" name="accion" value="1">
            <input type="hidden" name="namesTemplates" value="<?php echo $namesTemplates ?>">
            <input type="hidden" name="contador" id="contador" value="0" />
            <?php  foreach ($plantillas as $p){?>
            <input type="hidden" name="id_formulario[]" id="" value='<?php echo $p?>' />
            <?php }}?>

            <!-- PLANTILLAS CONDOMINIOS -->         
            <?php  if (isset($_POST['condominios'])) {?>
            <input type="hidden" name="accion" value="6">
            <?php }?>

        </div>
    </div>
</form>