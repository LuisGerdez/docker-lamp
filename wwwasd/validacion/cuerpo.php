<?php
@session_start(['name' => 'SITI']);

// require '../administrar/vendor/autoload.php';
require_once "../config/APP.php";
require '../Models/Bucket.php';
require '../conexion.php';
include "../Models/CSRFToken.php";

// use Aws\S3\S3Client;
// use Aws\S3\Exception\S3Exception;
use Models\Bucket;
use Models\Session;


if (isset($_SESSION['codigo_usuario'])) {
    $codigo_usuario = $_SESSION['codigo_usuario'];
}

if (isset($_POST['nombre_archivo'])) {
    $nombre_archivo = str_replace(";", " ", $_POST['nombre_archivo']);
} else {
    $nombre_archivo = str_replace(";", " ", $_GET['nombre_archivo']);
}

if (isset($_POST['codigo_usuario'])) {
    $codigo_usuario = $_POST['codigo_usuario'];
} else {
    $codigo_usuario = $_GET['codigo_usuario'];
}

if (isset($_POST['codigo_documento'])) {
    $codigo_documento = $_POST['codigo_documento'];
} else {
    $codigo_documento = $_GET['codigo_documento'];
}

if (isset($_POST['codigo_detalle_documento'])) {
    $codigo_detalle_documento = $_POST['codigo_detalle_documento'];
} else {
    $codigo_detalle_documento = $_GET['codigo_detalle_documento'];
}

if (isset($_POST['correos_destinatarios'])) {
    $correos_destinatarios = $_POST['correos_destinatarios'];
} else {
    $correos_destinatarios = $_GET['correos_destinatarios'];
}
//

$S3 = new Bucket();
$sql = "SELECT * FROM documento WHERE doc_id='" . $codigo_documento . "'";
$resultado = $link->query($sql);
foreach ($resultado as $remitente) {
    $pendiente = __DIR__ . '/../bodega/precarga/' . $remitente['doc_usuari'] . '/';
    if (!file_exists($pendiente)) {
        mkdir($pendiente, 0755, true);
        $S3->s3DownloadObjectRoute($nombre_archivo, '../bodega/precarga/' . $remitente['doc_usuari'] . '/' . $nombre_archivo);
    } else {
        $S3->s3DownloadObjectRoute($nombre_archivo, '../bodega/precarga/' . $remitente['doc_usuari'] . '/' . $nombre_archivo);
    }
}
// crear carpeta por sino existe



?>
<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>

<div class="cuerpo-container">
    <form action="#" method="post" target="" name="formulario" id="formulario">
        <input type="hidden" name="tokenCSRF" id="tokenCSRF">
        <div class="cuerpo-pdf">
            <div>
                <object data="../bodega/precarga/<?php echo $codigo_usuario ?>/<?php echo $nombre_archivo ?>" type="application/pdf" width="100%" height="600px">
                    <div class="container-object">
                        <h1 class="title">Tu navegador no soporta PDF</h1>
                        <img src="../recursos/imagenes/alerta.png" alt="" class="alert-icon">
                        <a href="../bodega/precarga/<?php echo $codigo_usuario ?>/<?php echo $nombre_archivo ?>" class="boton-descarga">Descargar Documento</a>
                    </div>
                </object>
            </div>
        </div>
        <div class="cuerpo-botones">
            <button type="button" name="devolver" onclick="enviarFormulario(this.name);">Devolver</button>
            <button type="button" name="firmar" onclick="enviarFormulario(this.name);">Firmar</button>
        </div>
        <input type="hidden" id="nombre" name="nombre_archivo" value="<?php echo $nombre_archivo ?>" />
        <input type="hidden" id="codigo_usuario" name="codigo_usuario" value="<?php echo $codigo_usuario ?>" />
        <input type="hidden" id="codigo_documento" name="codigo_documento" value="<?php echo $codigo_documento ?>" />
        <input type="hidden" id="codigo_detalle_documento" name="codigo_detalle_documento" value="<?php echo $codigo_detalle_documento ?>" />
        <input type="hidden" id="correos_destinatarios" name="correos_destinatarios" value="<?php echo $correos_destinatarios ?>" />
    </form>
</div>
<?= CSRFToken::setToken(); ?>
<script>
    function enviarFormulario(evento) {

        let fieldToken = document.getElementById('tokenCSRF').value
        let sessionToken = '<?= $_SESSION['csrf']; ?>';

        if (sessionToken == fieldToken) {
            if (evento === "devolver") {
                document.formulario.action = '../devolver/index.php';
            } else if (evento === "firmar") {
                document.formulario.action = '../firma_destinatario/index.php';
            }
            document.formulario.submit();
        }
    }
</script>