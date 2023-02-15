<?php
include "../Models/CSRFToken.php";

use \Models\Session;

$codigo_usuario = $_SESSION['codigo_usuario'];

$idArchivo = NULL;
$nombreArchivo = NULL;

if(isset($_GET['rutaArchivo'])){
    $rutaArchivo=$_GET['rutaArchivo'];
}else{
    $rutaArchivo = NULL;
}


$prueba_tipoDoc = $_FILES['nombre_archivo']['type'];

// esta variable se crea en el archivo cuerpo destinatario, pero la convertimos en false para no utilizarla en esta vista ya que al devolvernos trae informacion que no nesecitamos
$_SESSION['sin_otp'] = false;

if (isset($_POST['formulario_plantilla'])) {
    $formulario_plantilla = $_POST['formulario_plantilla'];
}

if (!isset($_POST['nombreArchivo']) || !isset($_GET['nombreArchivo'])) {

    // print_r($_FILES['nombre_archivo']['name']);
    $tipo_documento = substr($_FILES['nombre_archivo']['name'], -4);

    $nombre_archivo = $_FILES['nombre_archivo']['name'];

    // Metodo para crear la carpeta de los uausrios si no existe
    $dir_subida = "../bodega/precarga/$codigo_usuario";
    if (!file_exists($dir_subida)) {
        $file_handle =  mkdir("../bodega/precarga/$codigo_usuario", 0774);
        $file_imgfirmafija =  mkdir("../bodega/precarga/$codigo_usuario/imgfirmatmp", 0774);
        $file_imgfirmafija =  mkdir("../bodega/precarga/$codigo_usuario/imgfirmafija", 0774);
        $file_firmadigital =  mkdir("../bodega/precarga/$codigo_usuario/firmadigital", 0774);
        $file_handle =  mkdir("../bodega/firmado/$codigo_usuario", 0774);
        $file_handle =  mkdir("../bodega/eliminado/$codigo_usuario", 0774);
        // print( 'Archivo creado');
    }
    //fin

    $dir_subida = "../bodega/precarga/$codigo_usuario/$nombre_archivo";
    echo $dir_subida;
    move_uploaded_file($_FILES['nombre_archivo']['tmp_name'], $dir_subida);

    if ($tipo_documento == "docx") {
        $nombre_sin_extension = substr($_FILES['nombre_archivo']['name'], 0, -5);
        $nuevo_nombre = $nombre_sin_extension . ".pdf";
        //directorio de las dependencias
        require '../vendor/autoload.php';

        //crear objeto de la case PHPWord
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        //Definimos constante del directorio del proyecto
        define('PHPWORD_BASE_DIR', realpath(__DIR__).'/../');
       
        //ruta donde se encuentra dompdf
        $domPdfPath = realpath(PHPWORD_BASE_DIR.'/vendor/dompdf/dompdf');
        //le pasamos a la configuración de phpword la librería que queremos utilizar para convertir word a pdf
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        //cargar el archivo de word a convertir a pdf
        $phpWord = \PhpOffice\PhpWord\IOFactory::load("../bodega/precarga/$codigo_usuario/$nombre_archivo");

        //convertimos el archivo a pdf
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
        $xmlWriter->save("../bodega/precarga/$codigo_usuario/$nuevo_nombre");

        $nombre_archivo = $nuevo_nombre;
    }
} else {
    if ($formulario_plantilla) {
        if (isset($_POST['nombreArchivo'])) {
            $nombre_archivo = $_POST['nombreArchivo'];
        }else if(isset($_GET['nombreArchivo'])) {
            $nombre_archivo = $_GET['nombreArchivo'];
        }      
    } else {
        $nombre_archivo = $_FILES['nombre_archivo']['name'];
        $idArchivo = $_POST['idArchivo'];
        $nombreArchivo = $_POST['nombreArchivo'];
        $rutaArchivo = $_POST['rutaArchivo'];
        $archivo_p = "../bodega/precarga/$codigo_usuario/$nombreArchivo";
        $dir_subida = "../bodega/precarga/$codigo_usuario/$nombre_archivo";

        if (file_exists($archivo_p)) {
            move_uploaded_file($_FILES['nombre_archivo']['tmp_name'], $dir_subida);
        }
    }
}
?>

<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<div class="cuerpo-container">
    <form action="#" method="post" target="" name="formulario" id="formulario" class="container-contenido">
        <label>A&ntilde;adir documentos</label>
        <div class="cuerpo-documento">
            <div class="cuerpo-detalle" style="word-wrap: break-word;">
                <?php if(isset($_GET['nombreArchivo'])) {$nombre_archivo = $_GET['nombreArchivo'];} echo $nombre_archivo;?>
                <input type="hidden" name="nombre_archivo" value="<?php if(isset($_GET['nombreArchivo'])) {$nombre_archivo = $_GET['nombreArchivo'];}echo $nombre_archivo; ?>" />
                <input type="hidden" name="idArchivo" value="<?php echo $idArchivo; ?>" />
                <input type="hidden" name="nombreArchivo" value="<?php echo $nombreArchivo; ?>" />
                <input type="hidden" name="rutaArchivo" value="<?php echo $rutaArchivo; ?>" />
            </div>
        </div>
        <div class="cuerpo-complemento">
            
            <div class="complemento-items">
                <select name="opciones_firma" id="opciones_firma" class="dropdown">
                    <option value="" name="firma_digital" id="firma_digital">Seleccione los firmantes</option>
                    <option value="no_firmante" name="no_firmante" id="no_firmante" title="Solo firman destinatario/s">Otro/s</option>
                    <option value="unico_firmante" name="unico_firmante" id="unico_firmante" title="Unico firmate">Yo</option>
                    <option value="varios_destinatarios" name="varios_destinatarios" id="varios_destinatarios" title="Remitente uno o varios destinatarios"> Otros y yo</option>
                </select>
                <input type="hidden" name="tokenCSRF" id="tokenCSRF">
                <button class="btn_volver" type="button" title="volver" onclick="volverAtras();"><i class="fas fa-arrow-left"></i>Volver</button>
                <button type="submit">Siguiente<i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
        <!-- Creamos el campo para poder tener la opcion de firmar con o sin otp -->
        <div class="cuerpo-informacion">
            <p>
            <h2>Opciones Firma</h2>
            </p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="firma_otp" value="firma_otp1">
                <label class="form-check-label" for="firma_otp1">
                    Firmar con Token seguridad al email
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="firma_otp" value="firma_otp2" checked>
                <label class="form-check-label" for="firma_otp2">
                    Firmar con biometria facial
                </label>
            </div>
            <p>&#10148; <u>Utilizar Certificado digital</u>: Permite firmar con certificado digital.</p>
            <p>&#10148; <u>No soy firmante</u>: Permite enviar el documento para firmar electr&oacute;nicamente sin firmar el usuario de la plataforma.</p>
            <p>&#10148; <u>Soy el &uacute;nico firmante</u>: Permite firmar electr&oacute;nicamente sin enviar el documento a otras personas.</p>
            <p><em><u>Nota</u>: Si decide no escoger una opci&oacute;n el software firmara electr&oacute;nicamente con su usuario registrado en nuestra plataforma y a los destinatarios que se le env&iacute;a el correo con la solicitud.</em></p>
        </div>
    </form>
</div>

<?= CSRFToken::setToken(); ?>

<script>
    function volverAtras() {
        history.go(-1)
    }
    
    document.getElementById('formulario').addEventListener('submit', (e) => {
        
        e.preventDefault();
        
        let tokenSession = '<?= $_SESSION['csrf'] ?>';
        let tokenCampo = document.getElementById('tokenCSRF').value;
        let option = document.getElementById('opciones_firma').value;

        if (tokenCampo == tokenSession) {
            
            if (option == '') {
                alert('Selecione un tipo de firma');
            } else if (option == 'firma_digital') {
                document.formulario.action = '../firmar_digitalmente/';
                document.formulario.submit();
            } else if (option == 'unico_firmante') {
                document.formulario.action = '../preparar/';
                document.formulario.submit();
            } else {
                document.formulario.action = '../destinatarios/';
                document.formulario.submit();
            }
        }
        else alert("Error");
    });
</script>