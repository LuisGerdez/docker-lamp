<?php
@session_start(['name'=>'SITI']);
require_once "../config/APP.php";
/*
*   Software development - Ing. Bernabe Sanchez Lenis
*/

$codigo_usuario = $_SESSION['codigo_usuario'];
$correo_usuario = $_SESSION['correo_usuario'];
$nombre_usuario = $_SESSION['nombre_usuario'];
$apellido_usuario = $_SESSION['apellido_usuario'];

if (isset($_POST['nombre_archivo'])) {

    include 'SED.php';

    include '../conexion.php';
    /*  Nombre del archivo .pdf  */
    $nombre_archivo = $_POST['nombre_archivo'];
    /*  Consulta para obtener la ruta del certificado digital  */
    $sql_certdigital = "select usu_rutafidi from usuario where usu_id = $codigo_usuario";
    $certificado_dig = mysqli_query($link, $sql_certdigital);
    $ruta_firmapfx = $certificado_dig->fetch_row();
    $file = $ruta_firmapfx[0];

    if (!file_exists($file)) {
        echo "Error: No se puede leer el fichero del certificado: <b>".$file."</b>";
        exit;
    } else {
    /*  Clave publica del certificado digital  */
    $llavepublica = $_POST['publica'];
    $almacen_cert = file_get_contents($file);

    if (openssl_pkcs12_read($almacen_cert, $info_cert, $llavepublica)) {
    $certificate=$info_cert['cert'];
    $primaryKey=$info_cert['pkey'];
    $ssl = openssl_x509_parse($certificate);
    $primaryKey=$ssl['name'];

    $porciones = explode("/", $primaryKey);
    $firmadopor = "Firmado digitalmente por: <br>".ltrim($porciones[3],"CN=");

    $ip_add = $_SERVER['REMOTE_ADDR'];

    date_default_timezone_set("America/Bogota");
    $fecha = date("d-m-Y h:i:s A");
    $datedb = explode(" ", $fecha);
    $fechadb1 = $datedb[0];
    $fechadb2 = strtotime($fechadb1);
    $fechadb = date('Y-m-d', $fechadb2);
    $horadb = $datedb[1];

    $user = $nombre_usuario ." ". $apellido_usuario;

    $sql_documento = "insert into documento(doc_nombre, doc_estado, doc_usuari, doc_fechac, doc_horac) values ('$nombre_archivo','Firmado','$codigo_usuario','$fechadb','$horadb')";
    $link->query($sql_documento);
    $codigo_documento = $link->insert_id;

    $hash = SED::encryption($codigo_documento);

    require_once('../vendor/autoload.php');
    require_once('firmadigital/index.php');

    $mpdf = new \Mpdf\Mpdf([
    ]);

    $ruta = '../bodega/precarga';

    $nombrearchivo = $ruta . '/' . $codigo_usuario . '/' . $nombre_archivo;
    $pageCount = $mpdf->setSourceFile($nombrearchivo);

    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $pageId = $mpdf->importPage($pageNo);
        // obtiene el tamaño de la página importada
        $mpdf->AddPage();
        $mpdf->useImportedPage($pageId);
    }

    $mpdf->AddPage();
    $firma = getPlantilla($hash, $fecha, $firmadopor);
    $mpdf->WriteHTML($firma, \Mpdf\HTMLParserMode::HTML_BODY);
    $mpdf->SetProtection(array('print', 'copy'), null, $hash);
    $mpdf->SetAuthor('FirmaDoc');
    $mpdf->SetTitle('firmadocDigital-' . $nombre_archivo);
    $mpdf->SetSubject('firmadocDigital-' . $nombre_archivo);
    $mpdf->SetKeywords($hash);
    $mpdf->Output('../bodega/firmado/' . $codigo_usuario . '/firmadoc-' . $nombre_archivo, 'F');

    unlink('../bodega/precarga/' . $codigo_usuario . '/' . $nombre_archivo);

    $newruta = '/bodega/firmado/' . $codigo_usuario . '/firmadoc-' . $nombre_archivo;

    $codefile = '../bodega/firmado/' . $codigo_usuario . '/firmadoc-' . $nombre_archivo;

    $md5 = md5_file($codefile);

    $sql_documento_udt = "UPDATE documento set doc_ruta = '$newruta', doc_hash = '$hash', doc_fecha_f = '$fechadb', doc_hora_f = '$horadb', doc_md5 = '$md5' where doc_id = '$codigo_documento'";
    $link->query($sql_documento_udt);

    $sql_detalle_documento = "INSERT into detalledocumento(det_docume, det_firma, det_observ, det_nomdes, det_cordes, det_rutafi, det_fechaf, det_horaf, det_ip) values ($codigo_documento,1,'Ninguna','$user','$correo_usuario','$file','$fechadb','$horadb','$ip_add')";
    $link->query($sql_detalle_documento);
    
    header('Refresh: 0.1; URL=../gestionar/?p=firmados');
    echo "<script>alert('El documento fue firmado exitosamente.')</script>"; 

    } else {
        echo "<script>alert('La contraseña no es valida para este certificado.')</script>";
        echo "<script>history.go(-1)</script>";
    }
    }    
}