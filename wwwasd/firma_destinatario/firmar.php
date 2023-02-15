<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('user_agent', 'Mozilla/5.0');
error_reporting(E_ALL);

use Models\Bucket;

header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
@session_start(['name' => 'SITI']);

require_once '../vendor/autoload.php';
require_once '../Models/Bucket.php';
require_once "../config/APP.php";
include_once 'SED.php';


if (isset($_POST['codigo_usuario'])) {
    $codigo_usuario = $_POST['codigo_usuario'];
}

if (isset($_POST['codigo_documento'])) {
    $codigo_documento = $_POST['codigo_documento'];
}

if (isset($_POST['codigo_detalle_documento'])) {
    $codigo_detalle_documento = $_POST['codigo_detalle_documento'];
}

if (isset($_POST['correos_destinatarios'])) {
    $correos_destinatarios = $_POST['correos_destinatarios'];
} else {
    $correos_destinatarios = $_SESSION['correos_destinatarios'];
}

if (isset($_POST['unico_firmante'])) {
    $unico_firmante = $_POST['unico_firmante'];
}

$S3 = new Bucket();

$ruta_firmatmp = "";
if (isset($_FILES['fichero']['name'])) {

    $nombre_archivo_firma = $_FILES['fichero']['name'];
    $extension_archivo = $_FILES['fichero']['type'];

    if ($nombre_archivo_firma) {
        $extension = explode("/", $extension_archivo);

        $dir_subida = "../bodega/precarga/$codigo_usuario/imgfirmatmp/firma_$codigo_detalle_documento.$extension[1]";
        $ruta_firmatmp = "../bodega/precarga/$codigo_usuario/imgfirmatmp/firma_$codigo_detalle_documento.$extension[1]";

        if (move_uploaded_file($_FILES['fichero']['tmp_name'], $dir_subida)) {
            $ok = "ok";
        } else {
            echo "No se subio la imagen";
        }
    }
}

$unico_firmante = "";
if (isset($_POST['unico_firmante'])) {
    $unico_firmante = $_POST['unico_firmante'];
}

$ip_add = $_SERVER['REMOTE_ADDR'];

include '../conexion.php';

if ($unico_firmante) {
    $nombre_archivo = $_POST['nombre_archivo'];
    $ruta = "/bodega/precarga/$codigo_usuario/$nombre_archivo";

    $sql = "INSERT INTO documento (doc_nombre, doc_ruta, doc_estado, doc_usuari, doc_fechac, doc_horac) values ('$nombre_archivo', '$ruta', 'Pendiente', '$codigo_usuario', current_date, current_time)";
    $link->query($sql);
    $codigo_documento = $link->insert_id;

    $sql = "SELECT * FROM usuario WHERE usu_id = '$codigo_usuario'";
    $result = $link->query($sql);
    $fila = $result->fetch_assoc();
    $usu_nombre = $fila['usu_nombre'];
    $usu_apelli = $fila['usu_apelli'];
    $usu_email = $fila['usu_email'];
    $usu_firma = $fila['usu_rutafi'];

    $sql = "INSERT into detalledocumento (det_docume, det_firma, det_observ, det_nomdes, det_cordes, link_firma, det_rutafi, det_usuari,codigo_verificacion) values ('$codigo_documento', true, 'Ninguna', '$usu_nombre $usu_apelli', '$usu_email', NULL, '$usu_firma','$codigo_usuario',0)";
    $link->query($sql);
    $codigo_detalle_documento = $link->insert_id;
}

$hash = SED::encryption($codigo_documento);

if (!empty($usu_firma)) {
    $sql = "UPDATE detalledocumento set det_firma=TRUE, det_observ='Ninguna', det_fechaf=current_date, det_horaf=current_time, det_ip='$ip_add', det_rutafi = '$usu_firma' where det_docume = $codigo_documento and det_id = $codigo_detalle_documento";
    $result = $link->query($sql);
} else {
    $sql = "UPDATE detalledocumento set det_firma=TRUE, det_observ='Ninguna', det_fechaf=current_date, det_horaf=current_time, det_ip='$ip_add', det_rutafi = '$ruta_firmatmp' where det_docume = $codigo_documento and det_id = $codigo_detalle_documento";
    $result = $link->query($sql);
}
$sql = "SELECT * FROM detalledocumento WHERE det_docume = $codigo_documento and det_firma = 0";
$result = $link->query($sql);
$nr = mysqli_num_rows($result);

if (!$nr) {
    $resource = $link->query("SELECT doc_usuari FROM documento WHERE doc_id = '$codigo_documento'");
    $row = $resource->fetch_assoc();
    $codigo_creator = $row['doc_usuari'];
    
    //Datos firmantes con firma
    $datos_firmantes = array();
    $sql_firma = "SELECT usu_docume, usu_nombre, usu_apelli, det_nomdes, det_cordes, det_rutafi FROM detalledocumento LEFT JOIN usuario ON detalledocumento.det_cordes = usuario.usu_email WHERE det_docume = $codigo_documento and det_firma = 1";
    $firmantes = mysqli_query($link, $sql_firma);

    //El array viene bastante deformado en la consulta, por lo tanto lo organizamos a nuestra necesidad
    while ($consulta = mysqli_fetch_array($firmantes)) {
        $datos_firmante['usu_docume'] = $consulta['usu_docume'];
        $datos_firmante['usu_nombre'] = $consulta['usu_nombre'];
        $datos_firmante['usu_apelli'] = $consulta['usu_apelli'];
        $datos_firmante['det_nomdes'] = $consulta['det_nomdes'];
        $datos_firmante['det_cordes'] = $consulta['det_cordes'];
        $datos_firmante['det_rutafi'] = $consulta['det_rutafi'];
        array_push($datos_firmantes, $datos_firmante);
    }

    foreach ($datos_firmantes as $valor) {
        $array1[($valor['usu_docume'])] = [
            'usu_docume' => $valor['usu_docume'],
            'usu_nombre' => $valor['usu_nombre'],
            'usu_apelli' => $valor['usu_apelli'],
            'det_nomdes' => $valor['det_nomdes'],
            'det_cordes' => $valor['det_cordes'],
            'det_rutafi' => $valor = match (true) {
                empty($valor['det_rutafi']) => '',
                str_contains($valor['det_rutafi'], '/') => $valor['det_rutafi'],
                !str_contains($valor['det_rutafi'], '/') => 'data:' . 'image/png' . ';base64,' . $S3->s3DownloadObjectB64($valor['det_rutafi'], "suntic/images/{$valor['usu_docume']}/")
            }
        ];
    }

    $query = "SELECT rol_usuario FROM usuario WHERE usu_id = (SELECT doc_usuari FROM documento WHERE doc_id = {$codigo_documento})";
    $resultado = $link->query($query);
    $fila = $resultado->fetch_assoc();

    $rol_usuario = $fila['rol_usuario'];

    // Se crea registro con hash en la tabla queue_fetch
    $hash_queue = SED::encryption('queue-' . $codigo_documento);
    $sql = "INSERT INTO queue_fetch (hash) values ('$hash_queue')";
    $link->query($sql);

    // Se envian por medio de sesion todas las variables necesarias para almacenar documento, envio de correo y almacenar certificado
    $_SESSION["hash_queue"] = $hash_queue;
    $_SESSION["fetch_codigo_usuario"] = $codigo_creator;
    $_SESSION["fetch_rol_usuario"] = $rol_usuario;
    $_SESSION["fetch_codigo_documento"] = $codigo_documento;
    $_SESSION["fetch_hash"] = $hash;
    $_SESSION["fetch_correos_destinatarios"] = $correos_destinatarios;
    $_SESSION["fetch_array1"] = json_encode($array1);
    $_SESSION["fetch_nombre_archivo"] = $_POST['nombre_archivo'];
}
if ($unico_firmante) {
    header('Refresh: 0.1; URL=../administrar/');
} else {
    // header('Refresh: 0.1; URL=' . REDIRECCION_FIRMA);
    header('Refresh: 0.1; URL=../administrar/');
}
echo "<script>alert('El documento fue firmado exitosamente.')</script>";
