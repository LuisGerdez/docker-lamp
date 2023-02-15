<?php
include "../Models/CSRFToken.php";

use \Models\Session;

$nombre_usuario = $_SESSION['nombre_usuario'];
$apellido_usuario = $_SESSION['apellido_usuario'];

$idArchivo = NULL;
$nombreArchivo = NULL;
$rutaArchivo = NULL;

if (isset($_POST['nombre_archivo'])) {
    $nombre_archivo = $_POST['nombre_archivo'];
    $idArchivo = $_POST['idArchivo'];
    $nombreArchivo = $_POST['nombreArchivo'];
    $rutaArchivo = $_POST['rutaArchivo'];
}

if (isset($_POST['opciones_firma'])) {
    $opciones_firma = $_POST['opciones_firma'];
}

if ($_POST['opciones_firma'] == 'no_firmante') {
    $no_firmante = $_POST['opciones_firma'];
}

//creamos una nueva variable de session para utilizarla en preparar index cuando escojamos la opcion firmar sin otp
$_SESSION['sin_otp'] = false;
if (isset($_POST['firma_otp'])) {
    if ($_POST['firma_otp'] == 'firma_otp2') {
        $_SESSION['sin_otp'] = true;
        $sin_otp = $_SESSION['sin_otp'];
        // var_dump('Nombre del campo seleccionado',$sin_otp);
    }
}
?>

<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<LINK REL=StyleSheet HREF="./formulario.css" TYPE="text/css" MEDIA=screen>
<script src="./javascript.js"></script>

<form action="../preparar/index.php" method="post" name="formulario" id="formulario">
    <div class="cuerpo-container">
        <input type="hidden" name="tokenCSRF" id="tokenCSRF">
        <div class="container-contenido">
            <label>A&ntilde;adir firmantes</label>
            <br><br>
            <div class="cuerpo-documento">
                <div class="cuerpo-icono">
                    <i class="fas fa-check"></i>
                </div>
                <div class="cuerpo-label">
                    <div class="cuerpo-label-titulo"><label>Remitente: </label></div>
                    <div class="cuerpo-label-contenido"><label><?php echo $nombre_usuario . " " . $apellido_usuario ?></label></div>
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
                <div class="a�adir-destinatario">
                    <div class="texto-add" onclick="insertarFila();">A&ntilde;adir firmante</div>
                    <div class="icono-add"><i class="fas fa-user-plus"></i></div>
                </div>
            </div>
            <div class="cuerpo-botones">
                <button type="button" title="volver" onclick="volverAtras();"><i class="fas fa-arrow-left"></i>Volver</button>
                <button type="submit" title="siguiente">Siguiente<i class="fas fa-arrow-right"></i></button>
            </div>
            
            <input type="hidden" name="nombre_archivo" value="<?php echo $nombre_archivo ?>">
            <input type="hidden" name="contador" id="contador" value="0" />
            <input type="hidden" name="idArchivo" value="<?php echo $idArchivo; ?>" />
            <input type="hidden" name="nombreArchivo" value="<?php echo $nombreArchivo; ?>" />
            <input type="hidden" name="rutaArchivo" value="<?php echo $rutaArchivo; ?>" />
            <input type="hidden" name="no_firmante" value="<?php echo $no_firmante; ?>" />
            <input type="hidden" name="opciones_firma" value="<?php echo $opciones_firma; ?>" />
        </div>
    </div>
</form>

<?php CSRFToken::setToken(); ?>

<script>
    const formulario = document.getElementById('formulario');

    function volverAtras() {
        history.go(-1)
    }

    formulario.addEventListener('submit', (e) => {

        e.preventDefault();

        const destinatarios = document.querySelectorAll('.formulario-container');
        const tokenCampo = document.getElementById('tokenCSRF').value;
        const tokenSession = "<?= $_SESSION['csrf']; ?>";
        const camposNoValidos = verificarCampos(destinatarios);

        if(camposNoValidos) alert('Alguno de los campos esta vacio');
        else if(tokenCampo != tokenSession) alert("Error");
        else e.target.submit();
    });
    
    function verificarCampos(campos) {

        let vacio = true;

        for (const form of campos) {

            let nombre = form.children[0].children[1].children[0].value.trim();
            let correo = form.children[0].children[4].children[0].value.trim();

            if (nombre == '' || correo == '') {
                vacio = true;
                break;
            }
            else vacio = false;
        }

        return vacio;
    }
</script>