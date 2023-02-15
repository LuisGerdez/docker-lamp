<?php

include '../conexion.php';
include "../Models/CSRFToken.php";

use \Models\Session;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Codigo del usuario registrado
$codigo_usuario = $_SESSION['codigo_usuario'];

$correo_remitente = $_SESSION['correo_usuario'];

if (isset($_POST['contador'])) {
    $contador = $_POST['contador'];
}

$idArchivo = NULL;
$nombreArchivo = NULL;
$rutaArchivo = NULL;
$unico_firmante=NULL;
$array_correos = "";

//traemos los elementos de la tabla codigo_validacion para trabajar con el estado
$sql = "SELECT 	* FROM codigo_validacion WHERE id_usuario = '$codigo_usuario' AND estado='no_pendiente' ";
$result = $link->query($sql);
$fila = $result->fetch_assoc();

if (isset($fila['estado'])) {
    $estado = $fila['estado'];
}

if (isset($_POST['nombre_archivo'])) {
    $nombre_archivo = $_POST['nombre_archivo'];
    $idArchivo = $_POST['idArchivo'];
    $nombreArchivo = $_POST['nombreArchivo'];
    $rutaArchivo = $_POST['rutaArchivo'];
}

if (isset($_POST['nombre0']) || isset($_POST['correo0'])) {
    $array_nombres = "";
    $array_correos = "";
    for ($i = 0; $i <= $contador; $i++) {
        $nombre = ucwords($_POST['nombre' . $i]);
        $correo = strtolower($_POST['correo' . $i]);
        $array_nombres .= $nombre . "*/*";
        $array_correos .= $correo . "*/*";
    }
}

//Se trabaja por separado con cada una de las opciones de firmantes
if (isset($_POST['opciones_firma'])) {
    $opciones_firma = $_POST['opciones_firma'];
}

//Se trabaja por separado con cada una de las opciones de firmantes
//unico firmante
if ($_POST['opciones_firma'] == 'unico_firmante') {
    $unico_firmante = $_POST['opciones_firma'];
}
//Se trabaja por separado con cada una de las opciones de firmantes
//Soy el unico firmante
if ($_POST['opciones_firma'] == 'no_firmante') {
    $no_firmante = $_POST['opciones_firma'];
}
//Se trabaja por separado con cada una de las opciones de firmantes
//varios_destinatarios
if ($_POST['opciones_firma'] == 'varios_destinatarios') {
    $_SESSION['codigo'] = rand(1000, 99999999);
    $varios_destinatarios = $_POST['opciones_firma'];
}

//Envio el correo desde preparar hasta validar donde por medio de gets llega hasta firma 
//Para usar de parametro al momento de recoger la foto de los usuarios
if (isset($no_firmante) && !empty($no_firmante)) {
    $_SESSION['correos_destinatarios'] = $array_correos;
} else {
    $_SESSION['correos_destinatarios'] = $array_correos . $correo_remitente;
}

//Generamnos el codigo OTP
if (isset($no_firmante)) {

    $_SESSION['codigo'] = rand(1000, 99999999);
    $codigo = $_SESSION['codigo'];
}

//llamos la funcion modal para poder trabajar con el boton  $boton
function modal()
{
    include './btn_modal.php';
    return  $boton;
}
$modal = modal();

// Eliminamos de la tabla codigo_validacion el id del usuario y el codigo para poder trabajar y hacer la condicion de mostrar y no mostrar el boton firmar 
function deleteCode()
{
    include '../conexion.php';
    //Codigo del usuario registrado
    $codigo_usuario = $_SESSION['codigo_usuario'];
    $sql = "DELETE FROM codigo_validacion WHERE id_usuario='$codigo_usuario' AND estado='2'";
    $link->query($sql);
}
?>

<!-- CSS only bosstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<LINK REL=StyleSheet HREF="./btn_modal.css" TYPE="text/css" MEDIA=screen>
<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>

<!-- Ajax -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- sweetalert2 tabajamos con los mensajes de validacion -->
<script src="js/sweetalert2.js"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>
<div class="cuerpo-container">
    <div class="cuerpo-titulo">
        <label>Preparar</label>
    </div>
    <form action="" method="post" id="formulario_envio" name="formulario_envio">
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
            <button class="btn_volver" type="button" title="volver" onclick="volverAtras();"><i class="fas fa-arrow-left"></i>Volver</button>
            <?php if (!empty($unico_firmante)) { ?>
                <button onclick="firmarDocumento();" name="firmar">Firmar<i class="fas fa-arrow-right"></i></button>
            <?php } else { ?>
                <button title="siguiente" onclick="enviarFormulario();" name="siguiente">Siguiente<i class="fas fa-arrow-right"></i></button>
            <?php }; ?>
        </div>
        <input type="hidden" name="nombre_archivo" value="<?php echo $nombre_archivo ?>" />
        <input type="hidden" name="idArchivo" value="<?php echo $idArchivo; ?>" />
        <input type="hidden" name="nombreArchivo" value="<?php echo $nombreArchivo; ?>" />
        <input type="hidden" name="rutaArchivo" value="<?php echo $rutaArchivo; ?>" />
        <input type="hidden" name="array_nombres" value="<?php echo $array_nombres; ?>" />
        <input type="hidden" name="array_correos" value="<?php echo $array_correos; ?>" />
        <input type="hidden" name="contador" value="<?php echo $contador ?>" />
        <input type="hidden" name="unico_firmante" value="<?php echo $unico_firmante ?>" />
        <input type="hidden" name="no_firmante" value="<?php echo $no_firmante ?>" />
        <input type="hidden" name="codigo_usuario" value="<?php echo $codigo_usuario ?>" />
        <input type="hidden" name="opciones_firma" value="<?php echo $opciones_firma ?>" />
        <input type="hidden" name="varios_destinatarios" value="<?php echo $varios_destinatarios ?>" />
    </form>
</div>

<?= CSRFToken::setToken(); ?>



<script>
    //Se maneja cada funcion por separado
    function enviarFormulario() {
        let evento = document.getElementById('formulario_envio')
        evento.action = "../revisar/index.php";
        evento.submit();
    }

    function firmarDocumento() {

        let fieldToken = document.getElementById('tokenCSRF').value;
        let sessionToken = '<?= $_SESSION['csrf']; ?>';

        if(fieldToken == sessionToken) {
            
            let evento = document.getElementById('formulario_envio')
            evento.action = "../firma_destinatario/firmar.php";
            evento.submit();
        }
    }

    function volverAtras() {
        history.go(-1)
    }
</script>
