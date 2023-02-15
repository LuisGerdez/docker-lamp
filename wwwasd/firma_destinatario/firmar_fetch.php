<?php
header('Content-Type: application/json; charset=utf-8');

error_reporting(0);

use Models\Bucket;
use Models\Mail;
use Models\Plantilla;
use Models\FirmaCertificado;

// Start the session
session_start();

require_once '../vendor/autoload.php';
require_once '../Models/Bucket.php';
require_once "../config/APP.php";
require_once "../Models/Mail.php";
require_once "../Models/Plantilla.php";
require_once '../Models/FirmaCertificado.php';
include_once 'SED.php';

// Funcion para crear y almacenar el documento a firmar
// Retorna array con bool file_storaged, bool generar_certificado_firma y string archivoFirmado
function createAndStorageDocument(string $codigo_usuario, int $rol_usuario, string $codigo_documento, string $hash, string $correos_destinatarios, array $array1, string $nombre_archivo): array {
    // Se establece en falso antes de comenzar para luego comprobar si se almaceno el documento y si se debe crear el certificado
    $pdf_storaged = false;
    $generar_certificado_firma = false;
    
    include  '../conexion.php';
    require_once('firmaelectronica/index.php');
    
    //* Configuracion de la fuente para la firma en MPDF 
    $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];

    //*Diferentes instanciaciones ya que su plantilla se ve modificada y necesita diferentes margenes
    if (UBICACION == 'CO') {
        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [
                __DIR__ . '/../recursos/fonts',
            ]),
            'fontdata' => $fontData + [
                'tangarine' => [
                    'R' => 'Tangerine-Bold.ttf',
                    'I' => 'Tangerine-Regular.ttf',
                ]
            ],
            'debug' => true,
            'default_font' => 'Tangerine',
            'margin_top' => 55,
            'margin_bottom' => 0
        ]);
    } else {
        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [
                __DIR__ . '/../recursos/fonts',
            ]),
            'fontdata' => $fontData + [
                'tangarine' => [
                    'R' => 'Tangerine-Bold.ttf',
                    'I' => 'Tangerine-Regular.ttf',
                ]
            ],
            'default_font' => 'Tangerine',
            'debug' => true,
            'margin_top' => 55,
            'margin_bottom' => 45
        ]);
    }

    $ruta = '/../bodega/precarga';
    $archivo = $nombre_archivo;
    $nombrearchivo = $ruta . '/' . $codigo_usuario . '/' . $archivo;
    $pageCount = $mpdf->setSourceFile(__DIR__ . $nombrearchivo);
    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $pageId = $mpdf->importPage($pageNo);
        $mpdf->AddPage();
        $mpdf->useImportedPage($pageId);
    }

    $date = date('Y/m/d');
    $horadb = date('H:i:s');
    $fecha = $date . '/' . $horadb;
    //Inicio de cadena de fecha para indicar un único documento
    $fecha_replace = str_replace("/", "", $date);
    $hora_replace = str_replace(":", "", $horadb);
    $fecha_creacion_documento = $fecha_replace . $hora_replace;
    //Fin de cadena de fecha para indicar un único documento

    $S3 = new Bucket();

    if ($rol_usuario == 4) {
        $datos = traerImagenes($correos_destinatarios, $array1, $S3);
        $firmantes = matrizTridimensional($datos);

        /* $firmantes_null = array(0 => array(
            0 => array(
                'det_rutafi' => null,
                'det_nomdes'=> null,
                'usu_nombre'=> null,
                'usu_apelli' => null,
                'usu_docume'=> null,
                'url_foto' => null,
                'url_foto_doc' => null,
                ),
            ),
        ); */

        $archivoFirmado = 'firmadoc-' . $fecha_creacion_documento . '-' . $archivo;
        $mpdf->AddPage();
        $mpdf->showImageErrors = true;
        $firma = Plantilla::getSignedDocTemplateUS($hash, $fecha, $firmantes);
        $stylesheet = file_get_contents('estiloPlantillaUS.css');
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($firma, \Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->SetProtection(array('print', 'copy'), null, $hash);
        $mpdf->SetAuthor('FirmaDoc');
        $mpdf->SetTitle('firmadoc' . $archivo);
        $mpdf->SetSubject('firmadoc-' . $archivo);
        $mpdf->SetKeywords($hash);
        $mpdf->Output($archivoFirmado);

        $b64doc = base64_encode(file_get_contents($archivoFirmado));
        $md5 = md5_file($archivoFirmado);

        $s3_result = $S3->s3UploadObject($archivoFirmado, $archivoFirmado);
        unlink($archivoFirmado);

        // Se establece en true si el documento se almaceno correctamente
        if($s3_result["@metadata"]["statusCode"] == 200) {
            $pdf_storaged = true;
        }

        //*Querys para cambiar el estado del documento en la base de datos
        $result = $link->query("SELECT SUM(det_firma) FROM detalledocumento WHERE det_docume = '$codigo_documento'");
        $fila = $result->fetch_assoc();
        $contador = $fila['SUM(det_firma)'];

        $bolsa = $link->query("UPDATE producto SET cantidad_firmas = (SELECT SUM(cantidad_firmas) - {$contador} ) WHERE cantidad_firmas <> 0 LIMIT 1");

        $sql = "UPDATE documento SET doc_estado = 'Firmado', doc_hash = '$hash', doc_ruta = '$archivoFirmado', doc_md5 = '$md5', doc_fecha_f = current_date, doc_hora_f = current_time where doc_id = '$codigo_documento'";
        $link->query($sql);
        //*

        // Se establece en true para crear el certificado
        $generar_certificado_firma = true;

        $query = "SELECT callback_url FROM usuarios_apis WHERE id_api_usuarios = (SELECT id_api FROM usuario WHERE usu_id = (SELECT doc_usuari FROM documento WHERE doc_id = {$codigo_documento}))";
        $resultado = $link->query($query);
        $fila = $resultado->fetch_assoc();

        if (!empty($fila)) {
            $call_back_url = $fila['callback_url'];

            /* echo "<form name='formDoc' method='post' action=" . $fila['callback_url'] . " >
                <input id='datos' name='datos' type='text' value='$b64doc' style='display: none'>
            </form>";
            echo "<script>document.formDoc.submit();</script>"; */
        } else {
            $call_back_url = 'https://enroll.portal-id.com/firmadoc1.1/api/usuarios.php';

            /* echo "<form name='formDoc' method='post' action=' . 'https://enroll.portal-id.com/firmadoc1.1/api/usuarios.php' . ' >
                <input id='datos' name='datos' type='text' value='$b64doc' style='display: none'>
            </form>";
            echo "<script>document.formDoc.submit();</script>"; */
        }

    } else {
        $datos = traerImagenes($correos_destinatarios, $array1, $S3);
        $firmantes = matrizTridimensional($datos);

        $archivoFirmado = 'firmadoc-' . $fecha_creacion_documento . '-' . $archivo;
        $mpdf->showImageErrors = true;
        $mpdf->AddPage();
        $firma = Plantilla::getSignedDocTemplate($hash, $fecha, $firmantes);
        $stylesheet = file_get_contents('estiloPlantilla.css');
        $mpdf->SetDefaultBodyCSS('background', "url('background_300dpi.png')");
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($firma, \Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->SetProtection(array('print', 'copy'), null, $hash);
        $mpdf->SetAuthor('FirmaDoc');
        $mpdf->SetTitle('firmadoc' . $archivo);
        $mpdf->SetSubject('firmadoc-' . $archivo);
        $mpdf->SetKeywords($hash);
        $mpdf->Output($archivoFirmado);

        $md5 = md5_file($archivoFirmado);

        $s3_result = $S3->s3UploadObject($archivoFirmado, $archivoFirmado);
        unlink($archivoFirmado);

        // Se establece en true si el documento se almaceno correctamente
        if($s3_result["@metadata"]["statusCode"] == 200) {
            $pdf_storaged = true;
        }

        //*Querys para cambiar el estado del documento en la base de datos
        $result = $link->query("SELECT SUM(det_firma),documento.doc_nombre
         FROM detalledocumento 
         INNER JOIN documento 
         ON detalledocumento.det_docume=documento.doc_id
         WHERE det_docume = '$codigo_documento'");
        $fila = $result->fetch_assoc();
        $template = $fila['doc_nombre'];
        if (explode("-", $template)[0] == "DocumentTemplate") {
            $contador = 1;
        } else {
            $contador = $fila['SUM(det_firma)'];
        }
        $bolsa = $link->query("UPDATE producto SET cantidad_firmas = (SELECT SUM(cantidad_firmas) - {$contador} ) WHERE cantidad_firmas <> 0 LIMIT 1");
        $sql = "UPDATE documento SET doc_estado = 'Firmado', doc_hash = '$hash', doc_ruta = '$archivoFirmado', doc_md5 = '$md5', doc_fecha_f = current_date, doc_hora_f = current_time where doc_id = '$codigo_documento'";
        $link->query($sql);
        //*

        // Se establece en true para crear el certificado
        $generar_certificado_firma = true;
    }

    $query = "DELETE FROM valores_plantilla WHERE doc_id='$codigo_documento'";
    $link->query($query);

    return array(
        "file_storaged" => $pdf_storaged, 
        "generar_certificado_firma" => $generar_certificado_firma, 
        "archivoFirmado" => $archivoFirmado,
        "call_back" => ($rol_usuario == 4),
        "call_back_url" => (isset($call_back_url) ? $call_back_url : ''),
        "call_back_content" => (isset($b64doc) ? $b64doc : '')
    );
}

// Funcion para crear y almacenar el certificado de firma
function createAndStorageCertificate(string $codigo_documento, $codigo_usuario): void {
    include  '../conexion.php';

    $certificado_firma_id = "cert-" . $codigo_documento;
    $hash_certificado = SED::encryption($certificado_firma_id);

    $S3 = new Bucket();

    // Se crea y se almacena el archivo de certificado de la firma
    $firma_certificado = new FirmaCertificado();
    if($firma_certificado->setDocument($codigo_documento, $hash_certificado, 2)) {
        // Si se crea con exito, se actualiza la db, se sube el archivo y se elimina
        $resource = $link->query("SELECT doc_usuari FROM documento WHERE doc_id = '$codigo_documento'");
        $row = $resource->fetch_assoc();
        $codigo_creator = $row['doc_usuari'];
        
        $certificado_file_name = "Firmacertificado-" . $codigo_documento . ".pdf";
        $certificado_file_path = __DIR__ . "/../bodega/precarga/" . $codigo_creator . "/" . $certificado_file_name;
        $certificado_path_key = CLIENT.'/certificados/';

        $certificado_md5 = md5_file($certificado_file_path);

        $sql = "UPDATE documento SET certificadofirma_hash = '$hash_certificado', certificadofirma_md5 = '$certificado_md5' where doc_id = '$codigo_documento'";
        $link->query($sql);

        $S3->s3UploadObject($certificado_file_path, $certificado_file_name, $certificado_path_key);
        unlink($certificado_file_path);
    }
}

// Funcion para enviar correo
function sendEmail(string $archivoFirmado, string $codigo_documento, string $dominio = SERVERURL): void {
    $mail = new Mail();

    include '../conexion.php';

    $resource = $link->query("SELECT doc_usuari FROM documento WHERE doc_id = '$codigo_documento'");
    $row = $resource->fetch_assoc();
    $codigo_creator = $row['doc_usuari'];

    $resource = $link->query("SELECT usu_nombre, usu_apelli FROM usuario WHERE usu_id = '$codigo_creator'");
    $row = $resource->fetch_assoc();
    $remitente = $row['usu_nombre'] . ' ' . $row['usu_apelli'];

    $correo = Plantilla::getSignedEmailTemplate($dominio, $archivoFirmado, "Firmacertificado-" . $codigo_documento . ".pdf", trim($remitente));
    //$_SESSION['ruta_archivo'] = $archivoFirmado;

    $query2 = "SELECT det_cordes FROM detalledocumento WHERE det_docume = '$codigo_documento'";
    $result2 = $link->query($query2);

    while ($row = mysqli_fetch_array($result2)) {
        $mail->enviarCorreo($correo, $row["det_cordes"]);
    }
}

function traerImagenes($array_correos, $array1, $object)
{
    include '../conexion.php';

    $row = "";
    $fila = "";
    $file_images = array();
    $datos_autenticado = array();
    $result = array();
    $array_fotos_usuarios = array();
    $array_fotos = array();

    $correos = explode("*/*", $array_correos);


    //Traer documentos teniendo como parametro los correos que son datos unicos
    $correos_destinatarios = '"' . rtrim(implode('","', $correos), ',') . '"';
    $documentos_destinatarios = $link->query("SELECT usu_docume FROM usuario WHERE usu_email IN($correos_destinatarios)");
    while ($consulta = mysqli_fetch_array($documentos_destinatarios)) {
        if($consulta['usu_docume']) {
            $row .= $consulta['usu_docume'] . ',';
        }
    }
    //Elimino una coma de un registro vacio
    $id_enrolados = substr($row, 0, -1);

    //Traer datos de las personas enroladas y verificadas
    $transaccion =  $link->query("SELECT IdNumber,TransactionId FROM `ado_records` WHERE IdNumber IN ('$id_enrolados') and TransactionTypeName = 'Enroll';");
    while ($consulta = mysqli_fetch_array($transaccion)) {
        $fila .= $consulta['IdNumber'] . ',' . $consulta['TransactionId'] . '/';
    }

    //Como habia hecho una concatenacion lo convierto en array
    $Idtransacciones = explode('/', (substr($fila, 0, -1)));

    //Vuelvo a separar para hacer un array bidimensional
    foreach ($Idtransacciones as $datos) {
        array_push($datos_autenticado, explode(',', $datos));
    }

    // Completar el enlace para traer las imagenes
    foreach ($datos_autenticado as $dato) {
        if (isset($datos[1]) && !empty($dato[1])) {
            $file_images[0] = $dato[0];
            $file_images[1] = !empty($object->s3DownloadObjectB64($dato[0] . '/' . $dato[1] . '/clientFace.png', 'suntic/images/')) ? 'data: ' . 'image/png' . ';base64,' . $object->s3DownloadObjectB64($dato[0] . '/' . $dato[1] . '/clientFace.png', 'suntic/images/') : null;
            $file_images[2] = !empty($object->s3DownloadObjectB64($dato[0] . '/' . $dato[1] . '/frontDocument.png', 'suntic/images/')) ? 'data: ' . 'image/png' . ';base64,' . $object->s3DownloadObjectB64($dato[0] . '/' . $dato[1] . '/frontDocument.png', 'suntic/images/') : null;

            array_push($result, $file_images);
        } else {
            $file_images[0] = $dato[0];
            $file_images[1] =  null;
            $file_images[2] = null;
            array_push($result, $file_images);
        }
    }

    foreach ($result as $usuario_datos) {
        $array_fotos_usuarios["usu_docume"] = $usuario_datos[0];
        unset($usuario_datos[0]);
        $array_fotos_usuarios["url_foto"] = $usuario_datos[1];
        unset($usuario_datos[1]);
        $array_fotos_usuarios["url_foto_doc"] = $usuario_datos[2];
        unset($usuario_datos[2]);
        array_push($array_fotos, $array_fotos_usuarios);
    }


    //Cambia la clave principal del array de los enlaces de las fotos
    foreach ($array_fotos as $valor) {
        $array2[($valor['usu_docume'])] = [
            'url_foto' => $valor['url_foto'],
            'url_foto_doc' => $valor['url_foto_doc'],
        ];
    }
    //Asignar la foto en base64 al array con base en si coincide con la cedula
    foreach ($array1 as $clave => $valor) {
        if (array_key_exists($clave, $array2)) {
            $array1[($clave)]['url_foto'] = $array2[$clave]['url_foto'];
            $array1[($clave)]['url_foto_doc'] = $array2[$clave]['url_foto_doc'];
        }
    }

    $link->close();

    return $array1;
}

function matrizTridimensional(array $array): array
{
    $resultado = [];
    $arrayPost = [];
    $fila = 0;
    foreach ($array as $elemento) {
        $arrayPost[] = [
            'usu_docume' => $elemento['usu_docume'],
            'det_rutafi' => $elemento['det_rutafi'],
            'det_nomdes' => $elemento['det_nomdes'],
            'usu_nombre' => $elemento['usu_nombre'],
            'usu_apelli' => $elemento['usu_apelli'],
            'det_cordes' => $elemento['det_cordes'],
            'url_foto' => ($elemento['url_foto']) ?? null,
            'url_foto_doc' => ($elemento['url_foto_doc']) ?? null,
        ];
    }

    for ($i = 0; $i < count($arrayPost); $i++) {
        if ($i % 2 == 0) {
            $fila++;
        }
        $resultado[$fila - 1][] = [
            'det_rutafi' => $arrayPost[$i]['det_rutafi'],
            'det_nomdes' => $arrayPost[$i]['det_nomdes'],
            'usu_nombre' => $arrayPost[$i]['usu_nombre'],
            'usu_apelli' => $arrayPost[$i]['usu_apelli'],
            'usu_docume' => $arrayPost[$i]['usu_docume'],
            'url_foto' => $arrayPost[$i]['url_foto'],
            'url_foto_doc' => $arrayPost[$i]['url_foto_doc'],
        ];
    }

    return $resultado;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se obtienen los datos pasados por fetch
    $hash_queue = $_POST['hash_queue'];
    $codigo_usuario = $_POST['codigo_usuario'];
    $rol_usuario = $_POST['rol_usuario'];
    $codigo_documento = $_POST['codigo_documento'];
    $hash = $_POST['hash'];
    $correos_destinatarios = $_POST['correos_destinatarios'];
    $array1 = json_decode($_POST['array1'], true);
    $nombre_archivo = $_POST['nombre_archivo'];

    include  '../conexion.php';

    // Se verifica si existe el hash en la tabla queue_hash
    $query = "SELECT hash FROM queue_fetch WHERE hash = '$hash_queue'";
    $resultado = $link->query($query);

    if(mysqli_num_rows($resultado) > 0) {
        $query = "DELETE FROM queue_fetch WHERE hash = '$hash_queue'";
        $resultado = $link->query($query);

        $subir_result = createAndStorageDocument($codigo_usuario, $rol_usuario, $codigo_documento, $hash, $correos_destinatarios, $array1, $nombre_archivo);

        if($subir_result["file_storaged"]) {
            if($rol_usuario == 4) {
                $dominio = SERVERURL;
                sendEmail($subir_result["archivoFirmado"], $codigo_documento, $dominio);
            } else {
                sendEmail($subir_result["archivoFirmado"], $codigo_documento, SERVERURL);
            }
        }

        // Se valida si el documento fue firmado por todos
        if($subir_result["generar_certificado_firma"]) {
            createAndStorageCertificate($codigo_documento, $codigo_usuario);
        }

        echo json_encode(
            array(
                'msg' => 'success', 
                'file_storaged' => $subir_result["file_storaged"],
                'upload_details' => $subir_result,
                'generar_certificado_firma' => $subir_result["generar_certificado_firma"]
            )
        );
    } else {
        echo json_encode(
            array(
                'msg' => 'error',
                'error' => 'queue_not_exists',
                'queue_exists' => false, 
                'file_storaged' => false,
                'generar_certificado_firma' => false
            )
        );
    }
} else {
    echo json_encode(array('msg' => 'error', 'error' => 'invalid method'));
}

?>