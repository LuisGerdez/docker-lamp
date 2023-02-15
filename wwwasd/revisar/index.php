<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
@session_start(['name' => 'SITI']);
require '../vendor/autoload.php';
require_once "../config/APP.php";
require_once '../session.php';
require '../Models/Bucket.php';
require '../Models/DB.php';
require '../Models/Mail.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Models\Bucket;
use Models\DB;
use Models\Mail;
$idArchivo = NULL;
$nombreArchivo = NULL;
$rutaArchivo = NULL;
if (isset($_POST['metodo'])) {
    $metodo = $_POST['metodo'];
}
$pdo =  new DB();
$con = $pdo->connect();
//* Funcionalidad para verificar correos registrados y no registrados
$array_correos = $_POST['array_correos'];
$correos_sql = explode("*/*", substr($array_correos, 0, -3));
$correos_noregistrados = explode("*/*", substr($array_correos, 0, -3));
$contador = count($correos_noregistrados);
$correos_usuarios = [];
// if ($result = $link->query("SELECT usu_email FROM usuario WHERE usu_email IN($correos_sql)")) {
$clausula = implode(',', array_fill(0, count($correos_sql), '?'));
$stmt = $con->prepare("SELECT DISTINCT  usu_email FROM usuario WHERE usu_email IN(" . $clausula . ")");
$stmt->execute($correos_sql);

foreach ($stmt->fetchAll(PDO::FETCH_COLUMN) as $row) {
    $correos_usuarios[] = $row;
}

error_reporting(0);

for ($j = 0; $j <= $contador; $j++) {
    for ($i = 0; $i <= $contador; $i++) {
        if ($correos_usuarios[$j] == $correos_noregistrados[$i]) {
            unset($correos_noregistrados[$i]);
        }
    }
}

function enviarCorreo(array $array1, array $array2): void
{
    include '../conexion.php';
    include './correo.php';

    $pdo =  new DB();
    $con = $pdo->connect();
    $codigo = $_SESSION['codigo'] ?? 0;
    $codigo_usuario = (int) $_SESSION['codigo_usuario'];
    $array_correos = $_POST['array_correos'];
    $array_nombres = $_POST['array_nombres'];
    $nombre_archivo = $_POST['nombre_archivo'];
    $opciones_firma = $_POST['opciones_firma'];
    
    if (isset($_POST['asunto'])) {
        $asunto = $_POST['asunto'];
    }
    $ruta = "/bodega/precarga/$codigo_usuario/$nombre_archivo";
    include '../conexion.php';
    
    try {
        
        $stmt = $con->prepare("INSERT INTO documento (doc_nombre, doc_ruta, doc_estado, doc_usuari, doc_fechac, doc_horac) values (?, ?, 'Pendiente', ?, current_date, current_time)");
        $stmt->execute([
            $nombre_archivo,
            $ruta,
            $codigo_usuario
        ]);
        $codigo_documento = $con->lastInsertId();
    } catch (PDOException $e) {
        error_log($e, 0, '../php-error.log');
        // die();
    }
    // $error = $link->error;
    $nombres = explode("*/*", $array_nombres);
    $correos = explode("*/*", $array_correos);

    if ($opciones_firma !== "no_firmante") {
        $sql = "SELECT * FROM usuario WHERE usu_id = '$codigo_usuario'";
        $result = $link->query($sql);
        $fila = $result->fetch_assoc();
        $usu_nombre = $fila['usu_nombre'];
        $usu_apelli = $fila['usu_apelli'];
        $usu_email = $fila['usu_email'];
        $usu_rutafi = $fila['usu_rutafi'];
        $ip_add = $_SERVER['REMOTE_ADDR'];
        
        try {
            $stmt = $con->prepare("INSERT INTO detalledocumento (det_docume, det_firma, det_observ, det_nomdes, det_cordes, det_usuari, det_fechaf, det_horaf, det_ip, det_rutafi,codigo_verificacion) values (?, true, 'Ninguna', ?, ?, ?, current_date, current_time, ?, ?,?)");
            $stmt->execute([
                $codigo_documento,
                $usu_nombre . ' ' . $usu_apelli,
                $usu_email,
                $codigo_usuario,
                $ip_add,
                $usu_rutafi,
                $codigo
            ]);
        } catch (PDOException $e) {
            error_log($e, 0, '../php-error.log');
        }
    }
    $sin_otp = $_SESSION['sin_otp'];
    $cadena_detalle_documento = '';
    
    for ($i = 0; $i < count($nombres) - 1; $i++) {
        if ($sin_otp == true) {
            
            try {
                $stmt = $con->prepare("INSERT INTO detalledocumento (det_docume, det_firma, det_observ, det_nomdes, det_cordes,codigo_verificacion,estado_firma_destinatario_modal) values (?, false, 'Ninguna', ?, ?,0,'Pendiente1')");
                $stmt->execute([
                    $codigo_documento,
                    $nombres[$i],
                    $correos[$i]
                ]);
                $codigo_detalle_documento = $con->lastInsertId();
                $cadena_detalle_documento .= "$codigo_detalle_documento,";
            } catch (\PDOException $e) {
                error_log($e, 0, '../php-error.log');
                $error = $stmt->errorInfo();
            }
        } else {

            try {

                $sql = ("INSERT INTO detalledocumento (det_docume, det_firma, det_observ, det_nomdes, det_cordes,codigo_verificacion,estado_firma_destinatario_modal) values (:codigo_documento, false, 'Ninguna', :nombres, :correos, :codigo ,'Pendiente2')");
                $stm = $con->prepare($sql);
                $stm->bindParam(':codigo_documento', $codigo_documento, PDO::PARAM_STR);
                $stm->bindParam(':nombres', $nombres[$i], PDO::PARAM_STR);
                $stm->bindParam(':correos', $correos[$i], PDO::PARAM_STR);
                $stm->bindParam(':codigo', $codigo, PDO::PARAM_INT);
                $stm->execute();

                $codigo_detalle_documento = $con->lastInsertId();
                $cadena_detalle_documento .= "$codigo_detalle_documento,";
            } catch (\PDOException $e) {
                error_log($e, 0, '../php-error.log');
                $error = $stmt->errorInfo();
            }
        }
    }
    // mysqli_close($link);
    $array_detalle_documento = explode(",", $cadena_detalle_documento);

    for ($i = 0; $i < count($array_detalle_documento) - 1; $i++) {
        $_SESSION['codigo_documento'] = $codigo_documento;
        $_SESSION['codigo_detalle_documento'] = $array_detalle_documento[$i];
        
        $enlace_firma = '../validacion/index.php?nombre_archivo=' . $nombre_archivostr . '&codigo_usuario=' . $codigo_usuario . '&codigo_documento=' . $codigo_documento . '&codigo_detalle_documento=' . $array_detalle_documento[$i] . '&correos_destinatarios=' . $correos_destinatarios;

        try {
            $stmt = $con->prepare("UPDATE detalledocumento SET link_firma = ? WHERE det_id = ?");

            $stmt->execute([
                $enlace_firma,
                $array_detalle_documento[$i]
            ]);
        } catch (\PDOException $e) {
            error_log($e, 0, '../php-error.log');
            die;
        }
    }
    $mail = new Mail();

    if (!empty($array1)) {
        for ($i = 0; $i < count($array1); $i++) {
            if (!empty($array1[$i])) {
                $mail->enviarCorreo($correo_registrado, $array1[$i], $asunto);
            }
        }
    }
    if (!empty($array2)) {
        for ($i = 0; $i < count($array2); $i++) {
            if (!empty($array2[$i])) {
                $mail->enviarCorreo($correo_noregistrado, $array2[$i], $asunto);
            }
        }
    }
    header('Refresh: 0.1; URL=../administrar/index.php');
    echo "<script>alert('El documento se ha enviado correctamente!!!');</script>";
}
switch (isset($metodo)) {

    case "enviar":
        enviarCorreo($correos_usuarios, $correos_noregistrados);

        $S3 = new Bucket();
        $result = $S3->s3UploadObject('../bodega/precarga/' . $_SESSION['codigo_usuario'] . '/' . $_POST['nombre_archivo'], $_POST['nombre_archivo'], CLIENT.'/pendientes/');
        break;
}
?>
<html lang="es">
<head>
    <title><?php echo COMPANY ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo FAVICON ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <LINK REL=StyleSheet HREF="../estilo_principal.css" TYPE="text/css" MEDIA=screen>
</head>
<body style="padding: 0; margin: 0; background-color: #555555">
    <?php include './header.php' ?>
    <?php include './cuerpo.php' ?>
</body>
</html>