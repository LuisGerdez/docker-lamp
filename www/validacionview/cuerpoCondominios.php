<?php
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use iio\libmergepdf\Merger;

require_once "../config/APP.php";
require '../vendor/autoload.php';
include '../Models/Plantilla.php';
use Models\Plantilla;

$nombreArchivo = $_POST['nombreArchivo'];
$accion=$_POST['accion'];

switch ($accion) {
    case 'GeneratePdf':
        $ruta = GeneratePdf();
        break;
    
    default:
        # code...
        break;
}

function GeneratePdf(){

    include '../conexion.php';
        
    $checks_values = [
        isset($_POST['check1']) ? 'X' : '',
        isset($_POST['check2']) ? 'X' : '',
        isset($_POST['check3']) ? 'X' : '',
        isset($_POST['check4']) ? 'X' : '',
        isset($_POST['check5']) ? 'X' : '',
        isset($_POST['check6']) ? 'X' : '',
        isset($_POST['check7']) ? 'X' : '',
        isset($_POST['check8']) ? 'X' : '',
        isset($_POST['check9']) ? 'X' : '',
        isset($_POST['check10']) ? 'X' : ''
    ];
    $datos = [
        'check_box' => $checks_values
    ];
    $valores = $_POST['valores'];
    $contador=count($valores);
    $contador=$contador/9-(1);

    
    ///contador de contenedores 
    
    // array de array para informacion de contenedores del correo
    for ($i=0; $i <$contador ; $i++) { 
        for ($j=0; $j<9;$j++) {
            $matriz[$j]=$valores[$i];//guarda los vlaores por 9 ya que en cada contenedor hay 9 valores
        }   
    }

    if(count($valores) > 11) {
        
        $datos['primeros_11'] = array_splice($valores, 0, 11);
        $vueltas = ceil(count($valores) / 9);
        $tablas_secundarias = [];

        for($i = 0; $i < $vueltas; $i++) {
            array_push($tablas_secundarias, array_splice($valores, 0, 9));
        }

        $datos['tablas_secundatias'] = $tablas_secundarias;
    }
    else $datos['primeros_11'] = $valores;

    $formularios = [
        'datos' => $_POST['datos_form'],
        'check_box' => [
            isset($_POST['check11']) ? 'X' : '',
            isset($_POST['check12']) ? 'X' : '',
            isset($_POST['check13']) ? 'X' : '',
            isset($_POST['check14']) ? 'X' : '',
            isset($_POST['check15']) ? 'X' : '',
            isset($_POST['check16']) ? 'X' : '',
            isset($_POST['check17']) ? 'X' : '',
            isset($_POST['check18']) ? 'X' : '',
            isset($_POST['check19']) ? 'X' : '',
            isset($_POST['check20']) ? 'X' : '',
            isset($_POST['check21']) ? 'X' : '',
            isset($_POST['check22']) ? 'X' : '',
        ]
    ];
    
    ob_start();
    $html=Plantilla::GenerateTemplateCourtsAtKendallDynamicfields($datos, $contador);
    include('../vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('Documento');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);   
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    // remove default header/footer
    $pdf->setPrintHeader(false);
    // -------------------------------------------------------------------
    // add a page
    $pdf->AddPage();
    // set JPEG quality
    $pdf->setJPEGQuality(75);
    TCPDF_FONTS::addTTFfont('Cherolina.ttf',  'TrueTypeUnicode', '', 32);       
    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->AddPage();
    $html2 = Plantilla::GenerateTemplateCourtsAtKendall($formularios);
    $pdf->writeHTML($html2, true, false, true, false, '');
    
    ob_clean();

    include '../conexion.php';

    $sql = "SELECT doc_ruta FROM documento WHERE doc_id = '{$_SESSION['codigo_documento']}'";
    $result = mysqli_fetch_assoc($link->query($sql));
    $ruta = $result["doc_ruta"];
    $pdf->Output(__DIR__.'/'.$ruta, 'F');

    return $ruta;
}


?>
<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<script>
    function enviarFormulario(evento) {
        if(evento === "devolver"){
            document.formulario.action = '../devolver/index.php';
        }else if(evento === "firmar"){
            document.formulario.action = '../firma_destinatario/index.php';
        }
        document.formulario.submit();
    }
</script>
<div class="cuerpo-container">
    <form action="#" method="post" target="" name="formulario" id="formulario">
        <div class="cuerpo-pdf">
            <div>
                <object data="<?= $ruta ?>" type="application/pdf" width="100%" height="600px">
                    <div class="container-object">
                        <h1 class="title">Tu navegador no soporta PDF</h1>
                        <img src="../recursos/imagenes/alerta.png" alt="" class="alert-icon">
                        <a href="<?= $ruta ?>" class="boton-descarga">Descargar Documento</a>
                    </div>
                </object>
            </div>
        </div>       
        <div class="cuerpo-botones">
            <button type="button" name="devolver" onclick="enviarFormulario(this.name);">Devolver</button>
            <button type="button" name="firmar" onclick="enviarFormulario(this.name);">Firmar</button>
        </div>
        <input type="hidden" id="nombre" name="nombre_archivo" value="<?= $nombreArchivo ?>"/>
        <input type="hidden" id="nombre" name="nombreArchivo" value="<?= $nombreArchivo ?>"/>
        <input type="hidden" id="codigo_usuario" name="codigo_usuario" value="<?= $_SESSION['codigo_usuario']?>"/>
        <input type="hidden" id="codigo_documento" name="codigo_documento" value="<?= $_POST['codigo_documento']?>"/>
        <input type="hidden" id="codigo_detalle_documento" name="codigo_detalle_documento" value="<?= $_POST['codigo_detalle_documento']?>"/>
        <input type="hidden" id="correos_destinatarios" name="correos_destinatarios" value="<?=$_SESSION['correo_usuario']?>"/>
    </form>
</div>
