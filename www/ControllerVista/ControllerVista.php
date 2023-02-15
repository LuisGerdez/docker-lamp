<?php
@session_start(['name'=>'SITI']);

require_once "../config/APP.php";
include '../conexion.php';
require_once '../session.php';
include '../dominio.php';
require_once "../Models/Plantilla.php";
require_once '../Models/Bucket.php';
require_once '../Models/Mail.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use iio\libmergepdf\Merger;
use Models\Bucket;
use \Models\Mail;
use \Models\Plantilla;

///VARIABLES QUE VOY A UTILIZAR

$accion = $_POST['accion'];

switch ($accion) {
	case '1':
		error_reporting(0);
		$_SESSION['id_detalle_documento'] = register();
		break;

	case '2':
		error_reporting(0);
		$_SESSION['id_detalle_documento'] = register2();
		enviarcorreo($_SESSION['id_detalle_documento']);
		break;

	case '3':
		error_reporting(0);
		TemplatesData();
		break;
	case '5':
		error_reporting(0);
		generatePdfContrato();
		break;

	case '6':
		error_reporting(0);
		sendCondominios();
		break;

	case 'SendEmailCourstAtKendall':
		error_reporting(0);
		SendEmailCourstAtKendall();
		break;
		
	default:
		# code...
		break;
}

///////////////
function sendCondominios(){
	require_once "../config/APP.php";
	include '../conexion.php';
	require_once '../session.php';
	// recibo del post para poder generar el insert del documento y posteriormente hacer el envio
	$correo_usuario=$_POST['correo'];
	$nombre_usuario=$_POST['nombre'];
	$_SESSION['firmante']= $_POST['nombre'];
	$_SESSION['correofirmante']= $_POST['correo'];

	include('../vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');

	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
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
	$pdf->SetFont('helvetica', '', 8);
	// add a page
	$pdf->AddPage();
	// set JPEG quality
	$pdf->setJPEGQuality(75);
	
	$bodega = '../bodega/precarga/'.$_SESSION['codigo_usuario'].'/Contract-'.rand().'-Date-'.date("Ymd").'.pdf';
	$html=Plantilla::GenerateTemplateCourtsAtKendall(null);
		//FIN DE CREAR HTML
	$pdf->writeHTML($html, true, false, true, false, '');
	$_SESSION['nombreArchivo']=explode("/",$bodega)[4];
	$_SESSION["nameMerge"]=explode("/",$bodega)[4];
	$_SESSION['ruta_doc'] = $bodega;
	$pdf->Output(__DIR__."/".$bodega,'F');

	$_SESSION["nombre"] = $_SESSION["nameMerge"];
	$_SESSION["correo"] = $_SESSION['correofirmante'];

	///AQUI TERMINA LA GENERACION PARA MOSTRARLO
	echo "<script type='text/javascript'>"
	."window.location.href='../prepararview/index.php'"
	."</script>";
}

function SendEmailCourstAtKendall(){
	require_once "../config/APP.php";
	include '../conexion.php';
	require_once '../session.php';
	include '../dominio.php';

	$sql="INSERT INTO documento VALUES(
		NULL,
		'".$_SESSION['nombreArchivo']."',
		'".$_SESSION['ruta_doc']."','Pendiente',
		'".$_SESSION['codigo_usuario']."',
		'".date("Ymd")."',
		CURRENT_TIMESTAMP(),
		NULL,
		NULL,
		NULL,
		NULL,
		NULL,
		NULL,
		NULL,
		NULL,
		NULL
	)";
	$link->query($sql);

	$_SESSION['codigo_documento']=mysqli_insert_id($link);
		
	$S3 = new Bucket();
	$result = $S3->s3UploadObject($_SESSION['ruta_doc'], $_SESSION["nombreArchivo"], CLIENT.'/pendientes/');

	$asunto = $_POST['asunto'];
	$mensaje = $_POST['mensaje'];

	// insertar datos para documentos pendientes y enviar correo	
	$otp=rand(1000, 99999999);
	$sql="INSERT INTO detalledocumento VALUES(NULL,".$_SESSION['codigo_documento'].", 0, 'Ninguna','".$_SESSION['firmante']."','".$_SESSION['correofirmante']."',NULL,NULL,NULL,NULL,'".$_SERVER['REMOTE_ADDR']."','".$_SESSION['codigo_usuario']."','".$otp."',NULL,NULL,'Pendiente2')";
	$link->query($sql);

	//send email
	$sql="SELECT det_nomdes, det_cordes, codigo_verificacion from detalledocumento WHERE det_docume IN (".$_SESSION['codigo_documento'].")";

	$result = $link->query($sql);
	$mail = new Mail();
	
	foreach ($result as $key) {
		$sql="SELECT usu_email FROM usuario WHERE usu_email='".$key['det_cordes']."'";
		$correos = $link->query($sql);
		
		$execute = $correos->num_rows;
		
		if($execute > 0) {
			$url = "http://localhost/firmadoc/login?codigo=OTP";
			$bodyHtmlEmail = Plantilla::getRegisterEmailTemplate($_SESSION['nombre_usuario'], $_SESSION['correo_usuario'], $_SESSION["nameMerge"], $url, 3, $mensaje, $otp);			
			$mail->enviarCorreo($bodyHtmlEmail, $key['det_cordes'], " - ".$asunto);
		} else {	
			$url = "http://localhost/firmadoc/registro_usuario?codigo=OTP";
			$bodyHtmlEmail=Plantilla::getRegisterEmailTemplate($_SESSION['nombre_usuario'],$_SESSION['correo_usuario'],$_SESSION["nameMerge"],$url,2,$mensaje,$otp);
			$mail->enviarCorreo($bodyHtmlEmail, $key['det_cordes']," - ".$asunto);
		}
	}
	///AQUI TERMINA LA GENERACION PARA MOSTRARLO
	
	echo "<script type='text/javascript'>
	window.location.href='../administrar/layout/layout.php?menu=pendientes_entrada';
	</script>";
}

///insert de los correos destinatarios para la plantilla view y aceptacion de clausulas
function register() {
	require_once "../config/APP.php";
	include '../conexion.php';
	require_once '../session.php';

	if (isset($_SESSION['codigo_usuario'])) {
		$codigo_usuario = $_SESSION['codigo_usuario'];
	}
	
    ///Datos del formulario para que la persona lo pueda visualizar
	$_SESSION['firmante'] = $user_name = $_POST['nombre'];
	$_SESSION['correofirmante'] = $usu_correo = $_POST['correo'];
	$nombres_plantillas = $_POST['namesTemplates'];

	//son todos los formularios que elige la persona array()
	$id_formulario = $_POST['id_formulario'];
	$id_detalle = [];

	foreach ($id_formulario as $fId) {
		switch ($fId) {
			case '1':
				$ruta[] = ".".plantilla($fId, 1);
				$array[] = plantilla($fId, 0);
				break;

			case '2':
				$ruta[] = ".".plantilla2($fId, 1);
				$array[] = plantilla2($fId, 0);
				break;

			case '3':
				$ruta[] = ".".plantilla3($fId, 1);
				$array[] = plantilla3($fId, 0);
				break;

			case '4':
				$ruta[] = ".".plantilla4($fId, 1);
				$array[] = plantilla4($fId, 0);
				break;

			case '5':
				$ruta[] = ".".plantilla5($fId, 1);
				$array[] = plantilla5($fId, 0);
				break;

			case '6':
				$ruta[] = ".".plantilla6($fId, 1);
				$array[] = plantilla6($fId, 0);
				break;

			case '7':
				$ruta[] = ".".plantilla7($fId, 1);
				$array[] = plantilla7($fId, 0);
				break;
		}
	}

	# Crear el "combinador"
	$combinador = new Merger;

	# Agregar archivo en cada iteración
	foreach ($ruta as $documento) {
		$combinador->addFile($documento);
	}

	# Y combinar o unir
	$salida = $combinador->merge();
	$nombreArchivo = "../bodega/precarga/" . $_SESSION['codigo_usuario'] . "/DocumentTemplate-".rand()."-".date("Ymd").".pdf";
	$name = explode("/", $nombreArchivo)[4];
	file_put_contents($nombreArchivo, $salida);

	/* // INSERCION EN DOCUMENTOS EN LA BASE DE DATOS
	$sql="INSERT INTO documento VALUES(NULL,'".$name."','".$nombreArchivo."','Pendiente','".$_SESSION['codigo_usuario']."','".date("Ymd")."',CURRENT_TIMESTAMP(),NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)";

	$link->query($sql);
	$id_documento=mysqli_insert_id($link);
	$_SESSION['codigo_documento']=$id_documento;

	//datos por post d ela persona y correo
	// for ($i=0; $i<count($user_name); $i++) {
		$otpremitente=rand(1000, 99999999);
		$otp=rand(1000, 99999999);

		//insert remitente
		$sql="INSERT INTO detalledocumento VALUES(NULL,$id_documento,1,'Ninguna','".$_SESSION['nombre_usuario']." ".$_SESSION['apellido_usuario']."','".$_SESSION['correo_usuario']."',NULL,NULL,CURRENT_DATE,CURRENT_TIMESTAMP,'".$_SERVER['REMOTE_ADDR']."','".$_SESSION['codigo_usuario']."','".$otpremitente."',NULL,NULL,NULL)";

		$result = $link->query($sql);

		///insert del destinatario
		$sql="INSERT INTO detalledocumento VALUES(NULL,$id_documento,0,'Ninguna','".$_SESSION['firmante'][0]."','".$_SESSION['correofirmante'][0]."',NULL,NULL,NULL,NULL,'".$_SERVER['REMOTE_ADDR']."','".$codigo_usuario."','".$otp."',NULL,NULL,NULL)";
		$result = $link->query($sql);
		array_push($id_detalle,mysqli_insert_id($link));
	// }

	//ID PLANTILLAS
	$lastTemplate = $array[count($array)-1];
	$int = $lastTemplate[0];
	$sql = "INSERT INTO valores_plantilla VALUES";
	
	for ($i=0; $i < count($array); $i++) {
		//CAMPOS PLANTILLAS
		if ($int==$array[$i][0]) {
			$lastCampo=count($array[$i]);
			}
			for ($j=0; $j < count($array[$i]); $j++) {
				$id_campos_plantillas=QueryCampos($array[$i][0]);
				switch ($array[$i][0]) {
					case '1':
							if ($lastCampo==1) {
								$sql.="(NULL, '1', '".$id_campos_plantillas[$j]."',
								'".$array[$i][$j]."','".$_SESSION['codigo_usuario']."',
								 '".$id_documento."');" ;
							}else {
								$lastCampo--;
								$sql.="(NULL, '1', '".$id_campos_plantillas[$j]."',
								'".$array[$i][$j]."','".$_SESSION['codigo_usuario']."', '".$id_documento."'),";
							}
						break;
					case '2':
						if ($lastCampo==1) {
							$sql.="(NULL, '2', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."');" ;
						}else {
							$lastCampo--;
							$sql.="(NULL, '2', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."'),";
						}
						break;
					case '3':
						if ($lastCampo==1) {
							$sql.="(NULL, '3', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."');" ;
						}else {
							$lastCampo--;
							$sql.="(NULL, '3', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."'),";

						}
						break;
					case '4':
						if ($lastCampo==1) {
							$sql.="(NULL, '4', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."');" ;
						}else {
							$lastCampo--;
							$sql.="(NULL, '4', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."'),";

						}

						break;
					case '5':
						if ($lastCampo==1) {
							$sql.="(NULL, '5', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."');" ;
						}else {
							$lastCampo--;
							$sql.="(NULL, '5', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."'),";

						}
						break;
					case '6':
						if ($lastCampo==1) {
							$sql.="(NULL, '6', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."');" ;
						}else {
							$lastCampo--;
							$sql.="(NULL, '6', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."'),";
						}

						break;
					case '7':
						if ($lastCampo==1) {
							$sql.="(NULL, '7', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."');" ;
						}else {
							$lastCampo--;
							$sql.="(NULL, '7', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."'),";
						}
						break;
				}
		}
	}

	$link->query($sql); */

	$_SESSION["nameMerge"] = $name;
	$_SESSION["nombreArchivo"] = $nombreArchivo;

	$_SESSION["nombre"] = $_SESSION["nameMerge"];
	$_SESSION["correo"] = $_SESSION['correofirmante'];

	$_SESSION["id_formulario"] = $id_formulario;

	///AQUI TERMINA LA GENERACION PARA MOSTRARLO
	echo "<script type='text/javascript'>" . "window.location.href='../prepararview/index.php'" . "</script>";

	return $id_detalle;
}

///insert de los correos destinatarios para la plantilla view y aceptacion de clausulas
function register2() {
	require_once "../config/APP.php";
	include '../conexion.php';
	require_once '../session.php';
	
    ///Datos del formulario para que la persona lo pueda visualizar
	//$_SESSION['firmante'] = 'test';
	$_SESSION['correofirmante'] = $_POST['correo_documento'];

	$nombres_plantillas = $_POST['namesTemplates'];

	//son todos los formularios que elige la persona array()
	$id_formulario = explode(',', $_POST['id_formulario']);
	$id_detalle = [];

	foreach ($id_formulario as $fId) {
		switch ($fId) {
			case '1':
				$ruta[] = ".".plantilla($fId, 1);
				$array[] = plantilla($fId, 0);
				break;

			case '2':
				$ruta[] = ".".plantilla2($fId, 1);
				$array[] = plantilla2($fId, 0);
				break;

			case '3':
				$ruta[] = ".".plantilla3($fId, 1);
				$array[] = plantilla3($fId, 0);
				break;

			case '4':
				$ruta[] = ".".plantilla4($fId, 1);
				$array[] = plantilla4($fId, 0);
				break;

			case '5':
				$ruta[] = ".".plantilla5($fId, 1);
				$array[] = plantilla5($fId, 0);
				break;

			case '6':
				$ruta[] = ".".plantilla6($fId, 1);
				$array[] = plantilla6($fId, 0);
				break;

			case '7':
				$ruta[] = ".".plantilla7($fId, 1);
				$array[] = plantilla7($fId, 0);
				break;
		}
	}

	# Crear el "combinador"
	$combinador = new Merger;

	# Agregar archivo en cada iteración
	foreach ($ruta as $documento) {
		$combinador->addFile($documento);
	}

	# Y combinar o unir
	$salida = $combinador->merge();
	$nombreArchivo = "../bodega/precarga/" . $_SESSION['codigo_usuario'] . "/DocumentTemplate-".rand()."-".date("Ymd").".pdf";
	$name = explode("/", $nombreArchivo)[4];
	file_put_contents($nombreArchivo, $salida);

	// INSERCION EN DOCUMENTOS EN LA BASE DE DATOS
	$sql="INSERT INTO documento VALUES(NULL,'".$name."','".$nombreArchivo."','Pendiente','".$_SESSION['codigo_usuario']."','".date("Ymd")."',CURRENT_TIMESTAMP(),NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)";

	$link->query($sql);
	$id_documento = mysqli_insert_id($link);
	$_SESSION['codigo_documento'] = $id_documento;

	//datos por post d ela persona y correo
	// for ($i=0; $i<count($user_name); $i++) {
		$otpremitente=rand(1000, 99999999);
		$otp=rand(1000, 99999999);

		//insert remitente
		$sql="INSERT INTO detalledocumento VALUES(NULL,$id_documento,1,'Ninguna','".$_SESSION['nombre_usuario']." ".$_SESSION['apellido_usuario']."','".$_SESSION['correo_usuario']."',NULL,NULL,CURRENT_DATE,CURRENT_TIMESTAMP,'".$_SERVER['REMOTE_ADDR']."','".$_SESSION['codigo_usuario']."','".$otpremitente."',NULL,NULL,NULL)";

		$result = $link->query($sql);

		///insert del destinatario
		$sql="INSERT INTO detalledocumento VALUES(NULL,$id_documento,0,'Ninguna','".$_SESSION['firmante']."','".$_SESSION['correofirmante']."',NULL,NULL,NULL,NULL,'".$_SERVER['REMOTE_ADDR']."','".$codigo_usuario."','".$otp."',NULL,NULL, 'Pendiente2')";
		$result = $link->query($sql);

		array_push($id_detalle,mysqli_insert_id($link));
	// }

	//ID PLANTILLAS
	$lastTemplate = $array[count($array)-1];
	$int = $lastTemplate[0];
	$sql = "INSERT INTO valores_plantilla VALUES";
	
	for ($i=0; $i < count($array); $i++) {
		//CAMPOS PLANTILLAS
		if ($int==$array[$i][0]) {
			$lastCampo=count($array[$i]);
			}
			for ($j=0; $j < count($array[$i]); $j++) {
				$id_campos_plantillas=QueryCampos($array[$i][0]);
				switch ($array[$i][0]) {
					case '1':
							if ($lastCampo==1) {
								$sql.="(NULL, '1', '".$id_campos_plantillas[$j]."',
								'".$array[$i][$j]."','".$_SESSION['codigo_usuario']."',
								 '".$id_documento."');" ;
							}else {
								$lastCampo--;
								$sql.="(NULL, '1', '".$id_campos_plantillas[$j]."',
								'".$array[$i][$j]."','".$_SESSION['codigo_usuario']."', '".$id_documento."'),";
							}
						break;
					case '2':
						if ($lastCampo==1) {
							$sql.="(NULL, '2', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."');" ;
						}else {
							$lastCampo--;
							$sql.="(NULL, '2', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."'),";
						}
						break;
					case '3':
						if ($lastCampo==1) {
							$sql.="(NULL, '3', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."');" ;
						}else {
							$lastCampo--;
							$sql.="(NULL, '3', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."'),";

						}
						break;
					case '4':
						if ($lastCampo==1) {
							$sql.="(NULL, '4', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."');" ;
						}else {
							$lastCampo--;
							$sql.="(NULL, '4', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."'),";

						}

						break;
					case '5':
						if ($lastCampo==1) {
							$sql.="(NULL, '5', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."');" ;
						}else {
							$lastCampo--;
							$sql.="(NULL, '5', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."'),";

						}
						break;
					case '6':
						if ($lastCampo==1) {
							$sql.="(NULL, '6', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."');" ;
						}else {
							$lastCampo--;
							$sql.="(NULL, '6', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."'),";
						}

						break;
					case '7':
						if ($lastCampo==1) {
							$sql.="(NULL, '7', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."');" ;
						}else {
							$lastCampo--;
							$sql.="(NULL, '7', '".$id_campos_plantillas[$j]."','".$array[$i][$j]."',
							'".$_SESSION['codigo_usuario']."', '".$id_documento."'),";
						}
						break;
				}
		}
	}

	$link->query($sql);

	$_SESSION["nameMerge"] = $name;
	$_SESSION["nombreArchivo"] = $nombreArchivo;

	$_SESSION["nombre"] = $_SESSION["nameMerge"];
	$_SESSION["correo"] = $_SESSION['correofirmante'];

	return $id_detalle;
}

//CONSULTOS LOS CAMPOS DE LA PLANTILLA PARA IR INSERTANDO EN EL REGISTER
function QueryCampos($id_plantilla){
	include '../conexion.php';

	$sql = "SELECT id_campos_plantillas FROM campos_plantillas WHERE id_plantilla='".$id_plantilla."'";
	$campos=$link->query($sql);

	foreach ($campos as $key) {
		$value[]=$key['id_campos_plantillas'];
	}

	return $value;
}

// DOCUMENTO: TRADE IN
function plantilla($fId, $ruta){
	include '../conexion.php';

	// Aqui cuento el numero de valores y empiezo la inserción de los datos en la tabla
	$valores = array();

	//campos
	array_push($valores,
		$trade_id = 1,
		$fecha = $_SESSION["DataFill"]['trade_in']['fecha'],
		$yo = $_SESSION["DataFill"]['trade_in']['yo'],
		$marca = $_SESSION["DataFill"]['trade_in']['marca'],
		$modelo = $_SESSION["DataFill"]['trade_in']['modelo'],
		$tablilla = $_SESSION["DataFill"]['trade_in']['tablilla'],
		$num_serie = $_SESSION["DataFill"]['trade_in']['num_serie'],
		$num_cuenta = $_SESSION["DataFill"]['trade_in']['num_cuenta'],
		$banco = $_SESSION["DataFill"]['trade_in']['banco'],
		$balance_pendiente = $_SESSION["DataFill"]['trade_in']['balance_pendiente'],
		$num_poliza = $_SESSION["DataFill"]['trade_in']['num_poliza'],
		$contrato_servicio = $_SESSION["DataFill"]['trade_in']['contrato_servicio'],
	);

	include('../recursos/tcpdf/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
	$pdf->SetFont('helvetica', '', 8);

	// -------------------------------------------------------------------

	// add a page
	$pdf->AddPage();

	// set JPEG quality
	$pdf->setJPEGQuality(75);

	// ---------------------------------------------------------
	// Image example with resizing
	$pdf->Image('../documentos/images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'C',false, false, false, false, false, false);
	
	// crear html
	$html="
		<style>
			small { text-align:center;}
		</style>
					
		<div class='col-md-12 text-center'>
			<small><b>Auto1pr.com</b></small>
			<p></p>
			<small><b>ACUERDO SUPLEMENTARIO<br>SOBRE VEHÍCULO TOMADO COMO PRONTO PAGO (TRADE IN)</b></small>
		</div>
		
		<p></p>
		
		<div class='col-md-12'>
			<label for=''>Fecha: </label>
			<b>".$fecha."</b>

			<br>

			<label style='padding-right:5px;'>Yo,
				<b>".$yo."</b> hago constar que le he entregado a <b>Auto1pr.com</b>, en
				calidad de pronto pago (trade in) el vehículo de motor, marca
				<b>".$marca."</b>,
				modelo
				<b>".$modelo."</b> con tablilla
				<b>".$tablilla."</b> y número de serie
				<b>".$num_serie."</b> (el 'Vehículo'), por lo que autorizo a <b>Auto1pr.com</b> a
				efectuar el traspaso de la titularidad de este a nombre de cuales quiera de sus
				subsiguientes adquirientes.
			</label>

			<br>
			<br>

			<label style='padding-right:5px;'>INICIALES ____________</label>
			<input style='border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;' type='text' name='usu_name'>

			<p></p>

			<p>
				Represento que la unidad descrita no tiene gravamen de hipoteca, o algún otro gravamen que no
				sea el correspondiente a la cuenta #<b>".$num_cuenta." </b>mantenida con el banco
				<b>".$banco."</b> (el 'Financiamiento'). En la eventualidad que esta
				representación resulte incorrecta, me comprometo a tomar, dentro de los diez (10) días
				requerido, a aquellas medidas necesarias para liberar el vehículo de todos y cada uno de
				los gravámentes que tenga, con la única excepción del Financiamiento.
			</p>

			<label style='padding-right:5px;'>INICIALES ____________</label>
			<input style='border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;' type='text' name='usu_name'>

			<p></p>

			<p>
				Por este medio AUTORIZO a <b>Auto1pr.com</b> a liquidar el balance pendiente de pago del
				Financimiento, balance que represento asciende a $<b>".$balance_pendiente."</b>
				y CEDO a favor de éste cualquier diferencial que pueda
				surgir por concepto de primas de seguros no devengadas y/o por concepto de un balance de
				cancelación inferior al aquí informado, número de Póliza
				<b>".$num_poliza."</b>, o Contrato de Servicio <b>".$contrato_servicio."</b>. Revelo a <b>Auto1.PR.com</b> de toda obligación que
				pudiera tener de traspasar el Vehículo a nombre suyo antes de venderlo al adquiriente
				subsiguiente.
			</p>

			<label style='padding-right:5px;'>INICIALES ____________</label>
			<input style='border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;' type='text' name='usu_name'>

			<p>
				Al momento de la transacción se ha estimado que el balance a pagar para el saldo de
				financiamiento del Vehículo es el arriba
				indicado; También me comprometo a entregar balance de cancelación de la institución en la
				cual tiene deuda. No obstante,
				si al momento de liquidar dicho financiamiento, se encuentra que el balance de saldo fuera
				mayor al aquí informado, o si el vehículo
				tuviese otras deudas o gravámenes no informados al presente, o de estar alguna multa
				pendiente de pago o registro ante cualquier agencia pública de deficiencia y/o a pagar
				dichas cantidades dentro de diez (10)
				días desde que se me notifique la existencia de estas. En todo caso, REVELO a <b>Auto1pr.com</b> de
				toda la responsabilidad u obligación asociada
				con y me comprometo a indemnizarle (reembolsarle), cualquier pago que realice por dichos
				conceptos.
			</p>

			<label style='padding-right:5px;'>INICIALES ____________</label>
			<input style='border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;' type='text' name='usu_name'>"
	;
		
	//FIN DE CREAR HTML
	$pdf->writeHTML($html, true, false, true, false, '');

	$codigo_usuario = $_SESSION['codigo_usuario'];
	$bodega = '/../bodega/precarga/'.$codigo_usuario.'/pdfs+remitente='.$codigo_usuario.'+idForm='.$fId.'.pdf';
	$_SESSION['nombreArchivo'] = explode("/",$bodega)[5];
	
	if (!file_exists($bodega)) {
		mkdir($bodega, 0777, true);
	}

	$pdf->Output(__DIR__.$bodega, 'F');

	// para mandar el nombre de la bodega y el array de los valores de la plantilla
	if ($ruta == 1) {
		return $bodega;
	} else {
		return $valores;
	}
}

// DOCUMENTO : FACTURA VENTA
function plantilla2($fId, $ruta) {
	// create new PDF document
	$valores=array();

	array_push($valores,
		$id_factura = 2,

		$nombre_comprador = $_SESSION["DataFill"]['factura_venta']['comprador_nombre'],
		$direccion_residencial = $_SESSION["DataFill"]['factura_venta']['direccion_residencial'],
		$direccion_postal = $_SESSION["DataFill"]['factura_venta']['direccion_postal'],
		$fecha_entrega = $_SESSION["DataFill"]['factura_venta']['fecha_entrega'],
		$seguro_social = $_SESSION["DataFill"]['factura_venta']['seguro_social'],
		$fecha_nacimiento = $_SESSION["DataFill"]['factura_venta']['fecha_nacimiento'],
		$num_licencia = $_SESSION["DataFill"]['factura_venta']['num_licencia'],
		$telefono = $_SESSION["DataFill"]['factura_venta']['telefono'],
		$celular = $_SESSION["DataFill"]['factura_venta']['celular'],
		$email = $_SESSION["DataFill"]['factura_venta']['email'],

		///array de checkbox : 1 nuevo - 2 usado
		$vehiculo_vendido_estado = $_SESSION["DataFill"]['factura_venta']['vehiculo_vendido_estado'],
		//////

		$vehiculo_vendido_num_stock = $_SESSION["DataFill"]['factura_venta']['vehiculo_vendido_num_stock'],
		$vehiculo_vendido_anio = $_SESSION["DataFill"]['factura_venta']['vehiculo_vendido_anio'],
		$vehiculo_vendido_marca = $_SESSION["DataFill"]['factura_venta']['vehiculo_vendido_marca'],
		$vehiculo_vendido_modelo = $_SESSION["DataFill"]['factura_venta']['vehiculo_vendido_modelo'],
		$vehiculo_vendido_vin = $_SESSION["DataFill"]['factura_venta']['vehiculo_vendido_vin'],
		$vehiculo_vendido_color = $_SESSION["DataFill"]['factura_venta']['vehiculo_vendido_color'],
		$vehiculo_vendido_millaje = $_SESSION["DataFill"]['factura_venta']['vehiculo_vendido_millaje'],
		$vehiculo_vendido_tablilla = $_SESSION["DataFill"]['factura_venta']['vehiculo_vendido_tablilla'],
		$vehiculo_vendido_marbete = $_SESSION["DataFill"]['factura_venta']['vehiculo_vendido_marbete'],
		$vehiculo_vendido_vence = $_SESSION["DataFill"]['factura_venta']['vehiculo_vendido_vence'],

		$vehiculo_usado_tomado_marca = $_SESSION["DataFill"]['factura_venta']['vehiculo_usado_tomado_marca'],
		$vehiculo_usado_tomado_modelo = $_SESSION["DataFill"]['factura_venta']['vehiculo_usado_tomado_modelo'],
		$vehiculo_usado_tomado_anio = $_SESSION["DataFill"]['factura_venta']['vehiculo_usado_tomado_anio'],
		$vehiculo_usado_tomado_vin = $_SESSION["DataFill"]['factura_venta']['vehiculo_usado_tomado_vin'],
		$vehiculo_usado_tomado_tablilla = $_SESSION["DataFill"]['factura_venta']['vehiculo_usado_tomado_tablilla'],
		$vehiculo_usado_tomado_millaje = $_SESSION["DataFill"]['factura_venta']['vehiculo_usado_tomado_millaje'],
		$vehiculo_usado_tomado_color = $_SESSION["DataFill"]['factura_venta']['vehiculo_usado_tomado_color'],
		$balance_adeudado_a = $_SESSION["DataFill"]['factura_venta']['balance_adeudado_a'],
		$marbete = $_SESSION["DataFill"]['factura_venta']['marbete'],
		$vence = $_SESSION["DataFill"]['factura_venta']['vence'],

		//array2
		$cliente_entrego = $_SESSION["DataFill"]['factura_venta']['cliente_entrego'],
		/////

		$credito_por_carro_usado = $_SESSION["DataFill"]['factura_venta']['credito_por_carro_usado'],
		$balance_adeudado = $_SESSION["DataFill"]['factura_venta']['balance_adeudado'],
		$credito_neto = $_SESSION["DataFill"]['factura_venta']['credito_neto'],
		$pago_contado = $_SESSION["DataFill"]['factura_venta']['pago_contado'],
		$credito_favor = $_SESSION["DataFill"]['factura_venta']['credito_favor'],
		$otros_pagos = $_SESSION["DataFill"]['factura_venta']['otros_pagos'],

		$credito_total = $_SESSION["DataFill"]['factura_venta']['credito_total'],
		$pronto_recibido = $_SESSION["DataFill"]['factura_venta']['pronto_recibido'],
		$num_recibido = $_SESSION["DataFill"]['factura_venta']['num_recibido'],
		$precio_unidad = $_SESSION["DataFill"]['factura_venta']['precio_unidad'],
		$puertas = $_SESSION["DataFill"]['factura_venta']['puertas'],
		$cilindros = $_SESSION["DataFill"]['factura_venta']['cilindros'],
		$transmision = $_SESSION["DataFill"]['factura_venta']['transmision'],
		$caballaje = $_SESSION["DataFill"]['factura_venta']['caballaje'],

		$vehi_total = '0.00',
		$gap = $_SESSION["DataFill"]['factura_venta']['gap'],
		$seguro_doble = $_SESSION["DataFill"]['factura_venta']['seguro_doble'],
		$seguro_vida = $_SESSION["DataFill"]['factura_venta']['seguro_vida'],
		$contrato_servicio = $_SESSION["DataFill"]['factura_venta']['contrato_servicio'],
		$tablillas = $_SESSION["DataFill"]['factura_venta']['tablillas'],
		$seguro_acaa = $_SESSION["DataFill"]['factura_venta']['seguro_acaa'],
		$precio_total = $_SESSION["DataFill"]['factura_venta']['precio_total'],

		$balance_a_pagar = $_SESSION["DataFill"]['factura_venta']['balance_a_pagar'],

		$cantidad_plazos_1 = $_SESSION["DataFill"]['factura_venta']['cantidad_plazos_1'],
		$monto_plazos_1 = $_SESSION["DataFill"]['factura_venta']['monto_plazos_1'],
		$fecha_plazos_1 = $_SESSION["DataFill"]['factura_venta']['fecha_plazos_1'],

		$cantidad_plazos_2 = $_SESSION["DataFill"]['factura_venta']['cantidad_plazos_2'],
		$monto_plazos_2 = $_SESSION["DataFill"]['factura_venta']['monto_plazos_2'],
		$fecha_plazos_2 = $_SESSION["DataFill"]['factura_venta']['fecha_plazos_2'],

		$first_bank = $_SESSION["DataFill"]['factura_venta']['first_bank'],
		$observaciones = $_SESSION["DataFill"]['factura_venta']['observaciones'],
	);

	$vehi_credito_total2 = 0;

	include('../recursos/tcpdf/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
	$pdf->AddPage('P', 'A4');

	// set JPEG quality
	$pdf->setJPEGQuality(75);

	// ---------------------------------------------------------
	// Image example with resizing
	$pdf->Image('../documentos/images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'L',false,
	false, false, false, false, false);
	
	/////////INPUTS DEL FORMULARIA VENTA VEHICULAR (NUEVO) O (USADO)
	$input1=<<<EOD
		<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
		EOD;
	$input2=<<<EOD
		<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
		EOD;

	switch ($vehiculo_vendido_estado) {
		case '1':
			$input1=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;
		case '2':
			$input2=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		default:
			# code...
			break;
	}

	////inputs de abajo
	$licencia=<<<EOD
	<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
	EOD;

	$titulo=<<<EOD
	<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
	EOD;

	$certificacion=<<<EOD
	<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
	EOD;

	switch ($cliente_entrego) {
		case '1':
			$licencia=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;
		case '2':
			$titulo=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;
		case '3':
			$certificacion=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		default:
			# code...
			break;
	}

	// crear html
	$html=<<<EOD
		<style>
			* { font-family: Arial, Helvetica, sans-serif; font-size:10px; }
			b { text-align:center; }
			h5 { border-bottom:1px solid black; }
			th { cellpadding:10px; padding: 5px; border:1px solid black; }
			td { cellpadding:10px; }
			table { cellpadding:10px; }
		</style>

		<table>
			<tr>
				<td colspan="4">
					NOMBRE DEL COMPRADOR: <b>$nombre_comprador</b>
					
					<br>

					<small>Dirección Residencial:</small>
					<h5>$direccion_residencial</h5>
					
					<br>
					
					<small>Dirección Postal:</small>
					<h5>$direccion_postal</h5>
				</td>
				
				<td>
					<small>
						Fecha Entrega:<br>
						Seg. Social:<br>
						Fecha de Nacimiento:<br>
						No. licencia:<br>
						Teléfono:<br>
						Celular:<br>
						Correo Electrónico:
					</small>
				</td>

				<td width="200px">
					<small>
						$fecha_entrega<br>
						$seguro_social<br>
						$fecha_nacimiento<br>
						$telefono<br>
						$celular<br>
						$num_licencia<br>
						$email
					</small>
				</td>
			</tr>
		</table>

		<table>
			<tr>
				<th style="background-color:black;color:white;border:3px solid black;" colspan="3">
					<b>VEHÍCULO VENDIDO</b>
				</th>

				<th style="border-right:3px solid black;border-top:3px solid black;"colspan="2">
					PRECIO UNIDAD
				</th>

				<th style="border-right:3px solid black;border-top:3px solid black;">
					$<b>$precio_unidad</b>
				</th>
			</tr>

			<tr>
				<th style="border:3px solid black;" rowspan="2" colspan="3">
					Nuevo ($input1) Usado ($input2) Stock # <b>$vehiculo_vendido_num_stock</b>  Año: <b>$vehiculo_vendido_anio</b>
					<br>
					Marca: <b>$vehiculo_vendido_marca</b> Modelo: <b>$vehiculo_vendido_modelo</b>
					<br>
					VIN:<b>$vehiculo_vendido_vin</b> Color: <b>$vehiculo_vendido_color</b> Millaje:<b>$vehiculo_vendido_millaje</b>
					<br>
					Tablilla:<b>$vehiculo_vendido_tablilla</b> Marbete: <b>$vehiculo_vendido_marbete</b> Vence: <b>$vehiculo_vendido_vence</b>
				</th>

				<th style="border-right:3px solid black;" rowspan="2" colspan="2">
					Puertas:<b>$puertas</b> Cilindros: <b>$cilindros</b>
					<br><br>
					Transmisión: <b>$transmision</b>
					<br>
					Caballaje: <b>$caballaje</b>
				</th>

				<th style="border-right:3px solid black;"rowspan="2"></th>
			</tr>

			<tr>
				<td></td>
			</tr>

			<tr>
				<th colspan="5" style="border-right:3px solid black;border-left:3px solid black;"></th>
				<th style="border-right:3px solid black;">
					$<b>$vehi_total</b>
				</th>
			</tr>

			<tr>
				<th colspan="3" style="background-color:black;color:white;border:3px solid black;">
					<b>VEHICULO USADO TOMADO A CAMBIO</b>
				</th>

				<th colspan="2" style="border-right:3px solid black;">
					Gap
				</th>
				
				<th style="border-right:3px solid black;">
					$<b>$gap</b>
				</th>
			</tr>

			<tr>
				<th style="border-left:3px solid black;border-right:3px solid black;" colspan="3">
					Marca: <b>$vehiculo_usado_tomado_marca</b> Modelo: <b>$vehiculo_usado_tomado_modelo </b> Año: <b>$vehiculo_usado_tomado_anio</b>
				</th>

				<th colspan="2" style="border-right:3px solid black;">
					Seguro Doble()
				</th>

				<th style="border-right:3px solid black;">
					$<b>$seguro_doble</b>
				</th>
			</tr>

			<tr>
				<th style="border-left:3px solid black;border-right:3px solid black;" colspan="3">
					VIN: #<b>$vehiculo_usado_tomado_vin</b> Tablilla: <b>$vehiculo_usado_tomado_tablilla</b>
				</th>
				<th colspan="2"style="border-right:3px solid black;">Seguro de vida</th>
				<th style="border-right:3px solid black;">$<b>$seguro_vida</b></th>
			</tr>

			<tr>
				<th style="border-left:3px solid black;border-right:3px solid black;" colspan="3">Millaje: <b>$vehiculo_usado_tomado_millaje</b> Color: <b>$vehiculo_usado_tomado_color</b></th>
				<th colspan="2"style="border-right:3px solid black;">Contrato de servicio:</th>
				<th style="border-right:3px solid black;">$<b>$contrato_servicio</b></th>
			</tr>

			<tr>
				<th style="border-left:3px solid black;border-right:3px solid black;"colspan="3">Balance Adeudado A: <b>$balance_adeudado_a</b></th>
				<th colspan="2"style="border-right:3px solid black;">Tablillas:</th>
				<th style="border-right:3px solid black;">$<b>$tablillas</b></th>
			</tr>

			<tr>
				<th style="border-left:3px solid black;border:3px solid black;" rowspan="3" colspan="3">
					Marbete: <b>$marbete</b>  Vence: <b>$vence</b>
					<br>
					Cliente entregó: ($licencia) Licencia   ($titulo) Título  _______________
					<br>
					($certificacion) Certificación Multas AutoExpreso
				</th>

				<th colspan="2" style="border-right:3px solid black;">Seguro ACAA</th>
				<th style="border-right:3px solid black;">
					$<b>$seguro_acaa</b>
				</th>
			</tr>

			<tr>
				<th colspan="2"style="border-right:3px solid black;">Precio Total</th>
				<th style="border-right:3px solid black;">$<b>$precio_total</b></th>
			</tr>

			<tr>
				<th colspan="2"style="border-right:3px solid black;">Crèdito Total</th>
				<th style="border-right:3px solid black;">$<b>$credito_total</b></th>
			</tr>

			<tr>
				<th colspan="2" style="border-right:3px solid black;border-left:3px solid black;">Credito por Carro Usado</th>
				<th style="border-right:3px solid black;">$<b>$credito_por_carro_usado</b></th>
				<th colspan="2"style="border-right:3px solid black;">Balance a Pagar</th>
				<th style="border-right:3px solid black;">$<b>$balance_a_pagar</b></th>
			</tr>

			<tr>
				<th style="border-right:3px solid black;border-left:3px solid black;" colspan="2">Balance Adeudado</th>
				<td style="border-right:3px solid black;">$<b>$balance_adeudado</b></td>
				<th colspan="3" style="border:3px solid black;background-color:black;color:white;" ><b>BALANCE-CONTRATO A PAGARSE DE ACUERDO CON</b></th>
			</tr>

			<tr>
				<th style="border-right:3px solid black;border-left:3px solid black;" colspan="2">Crédito Neto</th>
				<th style="border-right:3px solid black;">$<b>$credito_neto</b></th>
				<th style="border:3px solid black;"colspan="3" >
					En <b>$cantidad_plazos_1</b> plazos mensuales de $<b>$monto_plazos_1</b> con fecha de <b>$fecha_plazos_1</b>
					
					<br>

					En <b>$cantidad_plazos_2</b> plazos mensuales de $ <b>$monto_plazos_2</b> con fecha de <b>$fecha_plazos_2</b>
					
					<br>
					
					First Bank al <b>$first_bank</b>
				</th>
			</tr>

			<tr>
				<th style="border-right:3px solid black;border-left:3px solid black;"colspan="2">Pago de Contado</th>
				<th style="border-right:3px solid black;">$<b>$pago_contado</b></th>
				<th style="border:3px solid black;"colspan="3">
					Observaciones:
					<label><br> <b>$observaciones</b></label>
				</th>
			</tr>

			<tr>
				<th style="border-right:3px solid black;border-left:3px solid black;"colspan="2">Crédito a su favor</th>
				<td style="border-right:3px solid black;">$<b>$credito_favor</b></td>
				<th style="border:3px solid black;" rowspan="4"colspan="3"><b><u>NO ACEPTAMOS DEVOLUCIONES</u></b><br><small>De devolver su unidad o cancelación de contrato de razon justificada. Auto 1
				LLC, le cobrara $95.00 diarios
				por el uso del vehículo. En adición, se cobrará millaje y deprociación según
				establece la ley. Los "Documents Fees"
				o "Gastos de cierre" <b>NO</b> son reembolsables una vez firmado la factura y el
				contrato.</small></th>
			</tr>

			<tr>
				<th style="border-right:3px solid black;border-left:3px solid black;"colspan="2">Otros Pagos</th>
				<th style="border-right:3px solid black;">$<b>$otros_pagos</b></th>
			</tr>

			<tr>
				<th style="border-right:3px solid black;border-left:3px solid black;" colspan="2">Crédito Total</th>
				<th style="border-right:3px solid black;">$<b>$vehi_credito_total2</b></th>
			</tr>

			<tr>
				<th style="border:3px solid black;"colspan="3">Pronto Recibido $<b>$pronto_recibido</b> <label>                         Recibo # <b>$num_recibido</b></label></th>
			</tr>

			<tr>
				<th colspan="6" style="border:3px solid black;">
				<p> NOTA: El comprador expresamente garantiza que el automóvil usado entregado a cuenta, si alguno, esta libre de todo gravámen o contrrato de venta consicional y qu ela licencia del mismo
				debidamente endosada sera entregada a la vendeddora con el vehículo. Se entiende que toda compra a plazos mediante contrato de venta condicional y/o hipoteca sobre bienes. En casede que el comprador exprese su opción por cierta financiadora particular para el financiamiento del balance de esta venta, sele conceden 10 días de esta fecha para trae a la vendedora el aporte
				de este balance y en caso de transcurrir decho termino sin que haya pagado dicho balance la vendedora quedara en libertad de utilizar cualquier entidad financiadora para cobrarse dicho balance. En tal caso se entenderá que tal actuación de la vendedora tiene autorización expresa del comprador.
				El comprador ha representado a la vendedora ser mayor de edad, todo vehículo usado se cende de acuerdo a la garantia estipualada por la ley. En caso de tratarse de la compra de un vehículo nuevo, la vendedora expresamente concede al
				comprador la garantía normal en carros nuevos que concedo la casa manucfacturora cuya garantía es de conocimiento del comprador. Aunque esta orden este firmada por un vendedor no obligara en forma alguna a la vendedora, hasta tanto haya sido aprobada y firmada por uno de los oficiales del la casa. Esta orden de compra y el contrato de venta condicional correspondiente y/o el contrato de hipoteca sobre iones muebles, si la venta es a plazos , cointieno por escrito todas las condiciones
				del negocio.</p></th>
			</tr>
		</table>
	EOD;
	
	$pdf->writeHTML($html, true, false, true, false, '');

	$codigo_usuario = $_SESSION['codigo_usuario'];
	$bodega = '/../bodega/precarga/'.$codigo_usuario.'/pdfs2+remitente='.$codigo_usuario.'+idForm='.$fId.'.pdf';
	$_SESSION['nombreArchivo'] = explode("/", $bodega)[5];
	
	if (!file_exists($bodega)) {
		mkdir($bodega, 0777, true);
	}

	$pdf->Output(__DIR__.$bodega,'F');
	
	if ($ruta==1) {
		return $bodega;
	} else {
		return $valores;
	}
}

// DOCUMENTO : PAGO DE VEHICULO
function plantilla3($fId, $ruta) {
	//datos recibidos
	$valores=array();

	array_push($valores,
		$id_pago = 3,
		$pagofecha1 = $_SESSION["DataFill"]['pago_vehiculo']['fecha_dia'],
		$pagofecha2 = $_SESSION["DataFill"]['pago_vehiculo']['fecha_mes'],
		$pagofecha3 = $_SESSION["DataFill"]['pago_vehiculo']['fecha_anio'],
		$pagoname = $_SESSION["DataFill"]['pago_vehiculo']['yo'],
		$pagomodelo = $_SESSION["DataFill"]['pago_vehiculo']['modelo'],
		$pagoaño = $_SESSION["DataFill"]['pago_vehiculo']['anio'],
		$pagocuenta = $_SESSION["DataFill"]['pago_vehiculo']['num_cuenta'],
		$pagofinancia = $_SESSION["DataFill"]['pago_vehiculo']['institucion_financiera'],
		$pagopoliza = $_SESSION["DataFill"]['pago_vehiculo']['compania_seguro_poliza'],
		$pagocontrato = $_SESSION["DataFill"]['pago_vehiculo']['contrato_servicio'],
		$pagopolizacontrato = $_SESSION["DataFill"]['pago_vehiculo']['contrato_servicio_poliza'],
		$pagogap = $_SESSION["DataFill"]['pago_vehiculo']['gap'],
		$pagopolizagap = $_SESSION["DataFill"]['pago_vehiculo']['gap_poliza'],
		$pagocompañia = $_SESSION["DataFill"]['pago_vehiculo']['compania_seguro']
	);

	// create new PDF document
	include('../recursos/tcpdf/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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

	// ---------------------------------------------------------
	// Image example with resizing
	$pdf->Image('../documentos/images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'C',false, false, false, false, false, false);

	// crear html
	$html = "
		<style>
			small {
				text-align:center;
			}
		</style>

		<div class='col-md-12 text-center'>
			<small><b>Auto1pr.com</b></small>
			<br>
			<small><b>Po Box 8458 Ponce PR 00732</b></small>
			<br>
			<small><b>Tel. 787-843-1111</b></small>
		</div>

		<br>
		<br>

		<div class='col-md-12'>
			<b>".$pagofecha1."</b>
			<label for=''> de </label>
			<b>".$pagofecha2."</b>
			<label for=''> de </label>
			<b>".$pagofecha3."</b>
			
			<br>

			<label style='padding-right:5px;'><b>Liquidación de Trade In Reclamo de Prima No devengada</b></label>
			
			<br>
		
			<label style='padding-right:5px;'>A quien puede interesar:</label>
		
			<br>
		
			<label style='padding-right:5px;'>Por este medio yo, <b>".$pagoname."</b>
			autorizo <b>Auto1pr.com</b> a realizar gestiones de liquidar el financiamiento y/o balance
			de cancelación del vehículo que se describe a continuación:</label>
		
			<br>
		
			<label style='padding-right:5px;'>Modelo: <b>".$pagomodelo."</b> Año: <b>".$pagoaño."</b></label>
		
			<br>
			<br>
		
			<label style='padding-right:5px;'>El mismo está a mi nombre, con el número de cuenta # </label> <b>".$pagocuenta."</b>
		
			<br>
		
			<label style='padding-right:5px;'>Y con la institución financiera <b>".$pagofinancia."</b>. Entiendo también que al saldar la cuenta y cancelar la
			póliza de seguro y/o contrato de servicio, el importe de la prima no
			devengada le corresponderá <b>Auto1pr.com</b> como responsable de la liquidación de la
			misma.</label>
		
			<div style='padding-bottom:300px;'>
				<br>
				<br>
			
				<label style='padding-right:5px;'>Compañía de seguro:</label> <b>".$pagocompañia."</b>
				<label>Póliza:</label>
				<b>".$pagopoliza."</b>
			
				<br>
				<br>
			
				<label style='padding-right:5px;'>Contrato de servicio:</label> <b>".$pagocontrato."</b> Póliza: </label><b> ".$pagopolizacontrato."</b>
				<br>
				<br>
			
				<label style='padding-right:5px;'>Gap:</label><b> ".$pagogap."</b>
				<label>Póliza: </label><b> ".$pagopolizagap."</b>
			</div>
		</div>"
	;

	$pdf->writeHTML($html, true, false, true, false, '');

	$codigo_usuario = $_SESSION['codigo_usuario'];
	$bodega = '/../bodega/precarga/'.$codigo_usuario.'/pdfs3+remitente='.$codigo_usuario.'+idForm='.$fId.'.pdf';
	$_SESSION['nombreArchivo'] = explode("/",$bodega)[5];

	if (!file_exists($bodega)) {
		mkdir($bodega,0777,true);
	}

	$pdf->Output(__DIR__.$bodega, 'F');

	if ($ruta==1) {
		return $bodega;
	} else {
		return $valores;
	}
}

// DOCUMENTO ESTIMADO/QUOTE
function plantilla4($fId, $ruta){
	$valores=array();

	array_push($valores,
		$id_quote = 4,
		$namequote = $_SESSION["DataFill"]['estimado_quote']['estimado'],
		$fechaquote = $_SESSION["DataFill"]['estimado_quote']['fecha_hora'],
		$vendedorquote = $_SESSION["DataFill"]['estimado_quote']['vendedor'],
		$precioquote = $_SESSION["DataFill"]['estimado_quote']['precio_venta'],
		$gastosquote = $_SESSION["DataFill"]['estimado_quote']['gastos_traspaso'],
		$totalquote = $_SESSION["DataFill"]['estimado_quote']['total'],
		$prontoquote = $_SESSION["DataFill"]['estimado_quote']['pronto'],
		$balancequote = $_SESSION["DataFill"]['estimado_quote']['balance_a_financiar'],
		$tradequote = $_SESSION["DataFill"]['estimado_quote']['trade_in'],
		$entidadquote = $_SESSION["DataFill"]['estimado_quote']['entidad_financiera'],
		$terminoquote = $_SESSION["DataFill"]['estimado_quote']['termino'],
		$pagoquote = $_SESSION["DataFill"]['estimado_quote']['pago_mensual'],
		$marcaquote = $_SESSION["DataFill"]['estimado_quote']['marca'],
		$modeloquote = $_SESSION["DataFill"]['estimado_quote']['modelo'],
		$versionquote = $_SESSION["DataFill"]['estimado_quote']['version'],
		$añoquote = $_SESSION["DataFill"]['estimado_quote']['anio'],
		$millajequote = $_SESSION["DataFill"]['estimado_quote']['millaje'],
		$tablillaquote = $_SESSION["DataFill"]['estimado_quote']['tablilla']
	);

	// create new PDF document
	include('../recursos/tcpdf/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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

	// ---------------------------------------------------------
	// Image example with resizing
	$pdf->Image('../documentos/images/Logo.jpg', 15, 14, 70, 15, 'JPG', '', '', true, 150, 'L',false, false, false, false, false, false);

	// crear html
	$html="
		<p></p>
		<p></p>
		
		<p>
			Estimado/a: <b> ".$namequote."</b>
			<br>
			A continuación le brindamos los números para su análisis
		</p>

		<p>
			<b style='float:left;'>Fecha:</b> <b>".$fechaquote."</b>
		</p>

		<p>
			<b style='float:left;'>Vendedor:</b> <b>".$vendedorquote."</b>
		</p>

		<br>

		<p>
			<small><b>Precio de Venta:</b></small>
		</p>

		<label for=''>$ <b>".$precioquote."</b></label>

		<br>
		<br>

		<b>Gastos de traspaso: </b>
		<label>$ <b>".$gastosquote."</b></label>

		<br>

		<b>Total: </b><label>$ <b>".$totalquote."</b></label>

		<br>
		<br>

		<label for=''><small>
		<b>Forma de pago:</b></small></label>

		<br>

		<b>Pronto: </b><b>".$prontoquote."</b>

		<br>
		<br>

		<b>Balance a financiar: </b><label>$ <b>".$balancequote."</b></label>

		<br>
		<br>

		<b>Trade in: </b><label>$ <b>".$tradequote."</b></label>

		<br>
		<br>
		<br>

		<small><b>Balance a financiar: </b></small><label></label>

		<br>
		<br>

		<b>Entidad financiera: </b><label> <b>".$entidadquote."</b></label>

		<br>

		<b>Término: </b><label> <b>".$terminoquote."</b></label>

		<br>

		<b>Pago mensual: </b><label>$ <b>".$pagoquote."</b></label>

		<br>
		<br>
		<br>

		<small><b>Auto a cambio: </b></small><label></label>

		<br>
		<br>

		<b>Marca: </b><label> <b>".$marcaquote."</b></label>

		<br>

		<b>Modelo: </b><label> <b>".$modeloquote."</b></label>

		<br>

		<b>Versión: </b><label> <b>".$versionquote."</b></label>

		<br>

		<b>Año: </b><label> <b>".$añoquote."</b></label>

		<br>

		<b>Millaje: </b><label> <b>".$millajequote."</b></label>

		<br>

		<b>Tablilla: </b><label> <b>".$tablillaquote."</b></label>
	</div>";

	$pdf->writeHTML($html, true, false, true, false, '');

	$codigo_usuario = $_SESSION['codigo_usuario'];
	$bodega = '/../bodega/precarga/'.$codigo_usuario.'/pdfs4+remitente='.$codigo_usuario.'+idForm='.$fId.'.pdf';
	$_SESSION['nombreArchivo'] = explode("/", $bodega)[5];
	
	if (!file_exists($bodega)) {
		mkdir($bodega,0777,true);
	}

	$pdf->Output(__DIR__.$bodega, 'F');

	if ($ruta==1) {
		return $bodega;
	} else {
		return $valores;
	}
}

// COMPROMISO DE PAGO DE MULTAS
function plantilla5($fId, $ruta){
	$valores=array();

	array_push($valores,
		$id_multa = 5,
		$mul_name = $_SESSION["DataFill"]['pago_multas']['yo'],
		$mul_marca = $_SESSION["DataFill"]['pago_multas']['marca'],
		$mul_modelo = $_SESSION["DataFill"]['pago_multas']['modelo'],
		$mul_año = $_SESSION["DataFill"]['pago_multas']['anio'],
		$mul_tablilla = $_SESSION["DataFill"]['pago_multas']['tablilla'],
		$mul_serie = $_SESSION["DataFill"]['pago_multas']['num_serie'],
		$mul_trade = $_SESSION["DataFill"]['pago_multas']['dia_dejado']
	);

	// create new PDF document
	include('../recursos/tcpdf/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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

	// ---------------------------------------------------------
	// Image example with resizing
	$pdf->Image('../documentos/images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'C',false, false, false, false, false, false);

	// crear html
	$html="
		<style>/* ESTILOS DE LOS LOGOS DE CADA PLANTILLA */

			h5{
				text-align:center;
			}

		</style>

		<div class='datos-container-formulario'>

			<div id='divcolor' class='x_panel col-md-8'>
				<div style='text-align:center;margin:auto;' class='col-md-12 text-center'>
					<h5><u><b>COMPROMISO DE PAGO DE MULTAS AUTO TOMADO EN TRADE IN</b></u></h5>
				</div>

				<br>
				<br>

				<div class='col-md-12'>
					<label style='padding-right:5px;'>Yo, </label><input
						style='border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;' type='text' name='mul_name'
						id='mul_name'><label id='a'for=''><b>".$mul_name."</b>, dueño del vehiculo.</label>
					
					<br>

					<label style='padding-right:5px;'>Marca:</label> <b>".$mul_marca."</b>

					<br>

					<label style='padding-right:5px;'>Modelo:</label><b> ".$mul_modelo."</b>

					<br>

					<label style='padding-right:5px;'>Año:</label> <b>".$mul_año."</b>

					<br>

					<label style='padding-right:5px;'>Tablilla:</label> <b>".$mul_tablilla."</b>

					<br>

					<label style='padding-right:5px;'>Núm. de serie:</label> <b>".$mul_serie."</b>

					<br>
					<br>

					<label style='padding-right:5px;'>Dejado en trade-in el día: <b>".$mul_trade."</b>, soy responsable de toda la multa que aparezca en el auto antes de la entre del mismo al Dealer como trade-in.</label>
						<div style='padding-bottom:300px;'>

				</div>
			</div>
		</div>"
	;

	$pdf->writeHTML($html, true, false, true, false, '');

	$codigo_usuario = $_SESSION['codigo_usuario'];
	$bodega = '/../bodega/precarga/'.$codigo_usuario.'/pdfs5+remitente='.$codigo_usuario.'+idForm='.$fId.'.pdf';
	$_SESSION['nombreArchivo'] = explode("/", $bodega)[5];

	if (!file_exists($bodega)) {
		mkdir($bodega, 0777, true);
	}

	$pdf->Output(__DIR__.$bodega, 'F');

	if ($ruta==1) {
		return $bodega;
	} else {
		return $valores;
	}
}

// DOCUMENTO: RECIBO DE PRONTO/PAGO
function plantilla6($fId, $ruta){
	$valores=array();

	array_push($valores,
		$id_pronto_pago = 6,
		$rec_control = $_SESSION["DataFill"]['recibo_pago_pronto']['num_control'],
		$rec_fecha = $_SESSION["DataFill"]['recibo_pago_pronto']['fecha'],
		$rec_stock = $_SESSION["DataFill"]['recibo_pago_pronto']['num_stock'],
		$rec_vin = $_SESSION["DataFill"]['recibo_pago_pronto']['vin'],
		$rec_de = $_SESSION["DataFill"]['recibo_pago_pronto']['recibido_de'],
		$rec_cantidad = $_SESSION["DataFill"]['recibo_pago_pronto']['cantidad'],
		$rec_vehiculo = $_SESSION["DataFill"]['recibo_pago_pronto']['compra_del'],
		$rec_concepto = $_SESSION["DataFill"]['recibo_pago_pronto']['concepto'],

		// Esto es para el input:checbox
		$inputs = $_SESSION["DataFill"]['recibo_pago_pronto']['tipo_pago'],
		
		$rec_num = $_SESSION["DataFill"]['recibo_pago_pronto']['num_cheque']
	);

	// create new PDF document
	include('../recursos/tcpdf/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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

	// ---------------------------------------------------------
	// Image example with resizing
	$pdf->Image('../documentos/images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'C', false, false, false, false, false, false);
	
	//inputs de recibo (3)
	$efectivo=<<<EOD
	<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
	EOD;
	$transferencia=<<<EOD
	<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
	EOD;
	$cheque=<<<EOD
	<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
	EOD;

	switch ($inputs) {
		case '1':
			$efectivo=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		case '2':
			$transferencia=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		case '3':
			$cheque=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		default:
			# code...
			break;
	}

	// crear html
	$html=<<<EOD
		<style>
			h4 { text-align:center;}
			small { text-align:right; position:absolute; margin-top:100px; }
			table { border:1px solid black; }
		</style>

		<table>
			<tr>
				<td></td>
				<td><br><h4 class='text-center'>RECIBO</h4></td>
				<td></td>
			</tr>

			<tr>
				<td>
					<p><b>Auto1</b>
					<br>
					Marginal San Rafael, PR-2km 229.2,
					<br>
					Ponce PR 00716</p>
				</td>

				<td>
				</td>

				<td>
					<p><small>Nùm. Control: <b>$rec_control</b></small>
					<br>
					<small>Fecha: <b>$rec_fecha</b></small>
					<br>
					<small>Stock#: <b>$rec_stock</b></small>
					<br>
					<small>VIN: <b>$rec_vin</b></small>
					</p>
				</td>
			</tr>
			
			<tr>
				<td colspan="3">
					<p></p>
					<label for=''>Recibido de: $rec_de</label>

					<label for=''>la cantidad de $ <b>$rec_cantidad</b></label>
					
					<br>
					
					Para aplicar a la compra del <b>$rec_vehiculo</b>
					
					<br>

					Concepto: <b>$rec_concepto</b>
					<p></p>
				</td>
			</tr>
		
			<tr>
				<td colspan="3">
					<label><b>$efectivo </b>EFECTIVO</label>
					<label><b>$transferencia</b> TRANSFERENCIA</label>
					<label>$cheque CHEQUE</label>
					<label>NUM.CHEQUE:<b>  $rec_num</b></label>
				</td>
			</tr>

			<tr>
				<td>
					<p></p>
				</td>
				<td>
					<p></p>
				</td>
				<td>
					<p></p>
				</td>
			</tr>

		</table>
	EOD;

	$pdf->writeHTML($html, true, false, true, false, '');

	$codigo_usuario = $_SESSION['codigo_usuario'];
	$bodega = '/../bodega/precarga/'.$codigo_usuario.'/pdfs6+remitente='.$codigo_usuario.'+idForm='.$fId.'.pdf';
	$_SESSION['nombreArchivo']=explode("/",$bodega)[5];
	$_SESSION['bodega'] = $bodega;

	if (!file_exists($bodega)) {
		mkdir($bodega,0777,true);
	}

	$pdf->Output(__DIR__.$bodega, 'F');
	
	if ($ruta==1) {
		return $bodega;
	} else {
		return $valores;
	}
}

// DOCUMENTO : GARANTIA
function plantilla7($fId, $ruta){
	//datos recibidos
	$valores=array();

	array_push($valores,
		$id_garantia = 7,
		$garamarca = $_SESSION["DataFill"]['garantia']['marca'],
		$garamodelo = $_SESSION["DataFill"]['garantia']['modelo'],
		$garaaño = $_SESSION["DataFill"]['garantia']['anio'],
		$garaserie = $_SESSION["DataFill"]['garantia']['num_serie'],
		$garainventario = $_SESSION["DataFill"]['garantia']['num_inventario'],
		$garamillaje = $_SESSION["DataFill"]['garantia']['millaje'],
		$garatablilla = $_SESSION["DataFill"]['garantia']['tablilla'],
		$garaprecio = $_SESSION["DataFill"]['garantia']['precio'],
		$check = $_SESSION["DataFill"]['garantia']['tipo_garantia'],
		$confirmacion=0
	);

	//Estos es para los input:checkbox
	$confirmacion=1;

	// create new PDF document
	include('../recursos/tcpdf/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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

	// ---------------------------------------------------------
	// Image example with resizing
	$pdf->Image('../documentos/images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'L',false, false, false, false, false, false);

	///CONDICIONALES PARA CHECKEAR Y NO CHECK
	switch ($check) {
		case '1':
			$input1=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			$input2=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input3=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input4=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			break;

		case '2':
			$input2=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			$input1=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input3=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input4=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			break;

		case '3':
			$input1=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input2=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input4=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input3=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		case '4':
			$input1=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input2=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input3=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input4=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		default:
			break;
	}

	///inputs de confirmacion
	switch ($confirmacion) {
		case '1':
			$si=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			$no=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			break;
		case '2':
			$si=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$no=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		default:
			break;
	}
	// crear html
	$html="
	<style>
	*{
		font-family: Arial, Helvetica, sans-serif;

	}
	h4{
		border-top:1px solid black;
		text-align:center;
	}
	td{
		border-bottom:1px solid black;
		border-collapse: separate;

	}
	table{

		border-spacing:  10px 2px;

	}
	h5{
		border-top:1px solid black;
	}
	label{
		font-size:14px;
	}
	h3{
		text-align:center;
	}
	</style>
	
		<h3>Auto 1 PR</h3>
	<h4>INFORMACIÓN SOBRE GARANTIA Y CONDICIONES PARA EL VEHICULO</h4>

	<table>
		<tr>
			<td><b>".$garamarca."</b></td>
			<td><b>".$garamodelo."</b></td>
			<td><b>".$garaaño."</b></td>
			<td><b>".$garaserie."</b></td>
		</tr>
		<tr>
		<th style=''>Marca:</th>
		<th style=''>Modelo:</th>
		<th style=''>Año:</th>
		<th style=''>Número serie</th>
		</tr>
		<tr>
		<td style=''><b>".$garainventario."</b></td>
		<td style=''><b>".$garamillaje."</b></td>
		<td style=''><b>".$garatablilla."</b></td>
		</tr>
		<tr>
		<th style=''>Número inventario:</th>
		<th style=''>Millaje:</th>
		<th style=''>Tablilla:</th>
		<th style=''><h2>Precio: <br>$".$garaprecio."</h2></th>
		</tr>
	</table>";


	$html.="<h5>GARANTIAS PARA ESTE VEHÍCULO</h5>
	".$input1."<label for=''> 2 meses o dos mil millas, lo
		primero que ocurra. (Mas de 50,000 millas y ____________<br> hasta 100,000 millas) </label>

	<br>
	".$input2."<label for=''> 3 meses o tres mil millas, lo
		primero que ocurra. (Mas de 36,000 millas y ____________<br> hasta 50,000 millas) </label>

	<br>
	".$input3."<label for=''> 4 meses o cuatro mil millas, lo
		primero que ocurra. (Hasta 36,000 millas) ____________</label>
	<br>
	<br>

	".$input4."<label for=''> 100,000 mil millas  en  adelante  no
		tiene garantìa. (     No tiene garantìa              )_______________</label>


	<h5>PARTES INCLUIDAS SEGÙN REGLAMIENTO DE D.A.C.O</h5>
	<p><small><b>A) MOTOR</b> -incluye todas las piezas internas del motor incluyendo bomba de
			agua, bomba de gasolina (mecánica eléctrica), multiple adminisión y escape, bloque y
			volanta. En motores rotativos incluye las cajas de los rotores. Se excluyen piezas de
			servicio normal de mantenimiento que requieran cambios periodicos y su respectiva mano
			de obra.
			<br>
			<b>B) TRANSMISIÓN</b> -incluye caja de transmisión, todas las piezas internas de las
			transmisión y el convertidor de torsión.
			<br>
			<b>C) SISTEMA ELECTRICO</b> -Alternador, generador, motor de arranque y sistema de
			ignición. No incluye batería, bombillas ni piezas de cambio periódico.
			<br>
			<b>D) SISTEMA ELECTRÓNICO</b> -incluye computadora y sus accesorios.
			<br>
			<b>E) EJE IMPULSOR</b> -Caja de tracción trasera y/o delantera, según aplique, con sus
			partes internas, ejes impulsores,
			eje del cardan y uniones transversales.
			<br>
			<b>F) FRENOS</b> -cilindros traseros, bomba de frenos, servo asistencia de vacio, líneas
			y acoplamientos hidraulicos y calibrados de discos. Se excluyen piezas de servicios
			normal de mantenimiento que requieran cambios periódicos y su respectiva mano de obra.
			<br>
			<b>G) RADIADOR Y ABANICO DEL RADIADOR</b>
			<br>
			<b>H) DIRECCIÓN -La caja de guía y sus partes internas (rack & pinion)</b>
			<br>
			<b>I) ODOMETRO FUNCIONANDO</b>
		</small>
		<h5></h5>
		<small>-Para obtener servicio: El consumidor se comunicará a (área de servicio) en horas
			laborales de requerir servicios por conceptos de garantía.
			-Será el proveedor del servicio y será la entidad responsable de honrar la garantía
			y/o coordinar cualquier otro recurso técnico
			<br>
			-Circunstancias bajo las cuales el consumidor puede perder el derecho a reclamar la
			garantía (a) Podría perder su derecho si el vehiculo de referencia sufrió un impacto
			el cual ocasionará daño a la unidad, (b) Alteraciones al vehículo posterior a la
			compra
			, (c) Que la unidad sea intervenida mécanicamente previo a la evaluación profesional
			a la cual usted tiene derecho a recibir de nuestro departamento de servicio.
			<br>
			-Proveerá una unidad sustituida; si la reparación de la unidad vendida y en
			garantía permaneceriera más de (5) días calendario, sin incluir Domingo.
			<br>
			-La garantía de su vehículo será transferida a cualquier consumidor subsiguiente
			sin costo alguno por el tiempo o millaje restante.</small>
	<h5>NOTAS IMPORTANTES AL CONSUMIDOR</h5>
	<small>1. Leo y certifico que he sido responsablemente orientado y se me han mostrado los labels o etiquetas de las partes del vehículo de esta transacción.</small>
	<br>
	<small>2. Certifico haber sido orientado; que este vehículo pudo haber requerido trabajos de hojalateria y pintura con la intención de optimizarlo.
	</small>
	<br>
	<small>3. Certifico que he recibido copia del REGLAMENTO DE GARANTIAS DE VEHCULOS DE MOTOR el cual servirá con guía informativa.</small>
	<input
		readonly style='border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;'
			type='text' name='usu_name'>
	<br>
	<small>4. Certifico que he sido informado que el vehículo aquí vendido proviene del uso anteriores en carácter de (Rental Car). Si".$si." No ".$no."
				</small>
	<input
		readonly style='border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;'
			type='text' name='usu_name'>";
		//FIN DE CREAR HTML
		$pdf->writeHTML($html, true, false, true, false, '');
		$codigo_usuario = $_SESSION['codigo_usuario'];
		$bodega = '/../bodega/precarga/'.$codigo_usuario.'/pdfs7+remitente='.$codigo_usuario.'+idForm='.$fId.'.pdf';
		$_SESSION['nombreArchivo']=explode("/",$bodega)[5];
		if (!file_exists($bodega)){
			mkdir($bodega,0777,true);
		}
		$pdf->Output(__DIR__.$bodega,'F');
		if ($ruta==1) {
			return $bodega;
		}else {
			return $valores;
		}
}

///aqui genero el envio de correos para mandarle el asunto y el mensaje a los destinatarios
////para que puedan visualizar las vistas del rtemitente
function enviarcorreo($id_2) {
	require_once "../config/APP.php";
	include '../conexion.php';
	require_once '../session.php';
	include '../dominio.php';

	////////VALORES QUE UTILIZARE
	// $id=$_SESSION['IdForm'];
	$asunto = $_POST['asunto'];
	$mensaje = $_POST['mensaje'];

	///VALOR DE SESION REMITENTE
	$codigo_usuario = $_SESSION['codigo_usuario'];
	$nombre_usuario = $_SESSION['nombre_usuario'];
	$apellido_usuario = $_SESSION['apellido_usuario'];
	$correo_usuario = $_SESSION['correo_usuario'];

	$S3 = new Bucket();
	$S3->s3UploadObject($_SESSION["nombreArchivo"], $_SESSION["nameMerge"], "suntic/pendientes/");

	$sql = "SELECT det_nomdes, det_cordes, codigo_verificacion from detalledocumento WHERE det_id IN (".implode(",",$id_2).")";
	$result = $link->query($sql);
	
	//consultando todos los corre4os que estan aliados a mi vista para mandarles correo
	foreach ($result as $key) {
		$sql = "SELECT usu_email FROM usuario WHERE usu_email='".$key['det_cordes']."'";
		$correos = $link->query($sql);
		$execute = $correos->num_rows;

		if($execute > 0) {
			//$correo_content = Plantilla::getRegisteredUserEmail($nombre_usuario, $apellido_usuario, $link_verificacion_plantillas_otp, $mensaje, $mensaje_otp);
			$correo_content = Plantilla::getRegisterEmailTemplate($nombre_usuario . ' ' . $apellido_usuario, $correo_usuario, $_SESSION["nameMerge"], $link_verificacion_plantillas_otp, 3, $mensaje, $key['codigo_verificacion']);
			///////////////aqui empieza lo de los correos
			///////////// ENVIO PARA USUARIOS QUE ESTAN REGISTRADOS EN EL SISTEMA
			$mail = new PHPMailer(true);
			try {
				//Server settings
				$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
				$mail->isSMTP();                                            //Send using SMTP
				$mail->Host       = Host;                     //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = Username;                     //SMTP username
				$mail->Password   = Password;                               //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
				$mail->Port       = Port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

				//Recipients
				$mail->setFrom(Username, COMPANY);
				$mail->ClearAddresses();
				$mail->addAddress($key['det_cordes'], 'User');     //Add a recipient
				//Content
				//// este correo es para los usuarios que estan registrados y tienen pendiente una firma para el correo
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = COMPANY . ' - ' . $asunto;
				$mail->Body = $correo_content;
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				ob_start();
				$mail->send();
				ob_end_clean();
				//echo 'Message has been sent';
			} catch (Exception $e) {
				//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
		} else if ($execute == 0) {
			function generateRandomString($length) {
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = mb_strlen($characters);
				$randomString = substr(str_shuffle($characters), 0, $length);
				return $randomString;
			}

			$randomString=generateRandomString(10);

			$codigo = rand(1000, 99999999);
			$bytes = random_bytes(5);
			$token = bin2hex($bytes);

			$det_nomdes = $key['det_nomdes'];
			$det_cordes = $key['det_cordes'];

			if(strpos($det_nomdes, ' ')) {
				$usu_nombre = explode(' ', $det_nomdes)[0];
				$usu_apellido = explode(' ', $det_nomdes)[1];
			} else {
				$usu_nombre = $det_nomdes;
				$usu_apellido = '';
			}

			$sql="INSERT INTO usuario(usu_estado, usu_passwo, rol_usuario, usu_nombre, usu_apelli, usu_email, usu_terminos, usu_token, usu_codigo, usu_codigo_vivo) values ('A' ,'" . password_hash($randomString, PASSWORD_BCRYPT) . "', '4' ,'" .$usu_nombre. "', '" .$usu_apellido. "', '".$det_cordes."', 'Si', '$token', '$codigo', false)";
			$result = $link->query($sql);

			///aqui empieza el envio de correos
			// para usuarios que no estan registrados en el sistema
			$correo_content = Plantilla::getRegisterEmailTemplate($nombre_usuario . ' ' . $apellido_usuario, $correo_usuario, $_SESSION["nameMerge"], $link_verificacion_plantillas_otp, 5, $mensaje, $key['codigo_verificacion'], $det_cordes, $randomString);

			///////////corre no registrado
			$mail = new PHPMailer(true);
			try {
				//Server settings
				$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
				$mail->isSMTP();                                            //Send using SMTP
				$mail->Host       = Host;                     //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = Username;                     //SMTP username
				$mail->Password   = Password;                               //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
				$mail->Port       = Port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

				//Recipients
				$mail->setFrom(Username, COMPANY);
				$mail->ClearAddresses();
				$mail->addAddress($key['det_cordes'], 'User');     //Add a recipient

				//Content
				//// este correo es para los usuarios que estan registrados y tienen pendiente una firma para el correo
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = COMPANY . ' - ' . $asunto;
				$mail->Body = $correo_content;
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				ob_start();
				$mail->send();
				ob_end_clean();
				//echo 'Message has been sent';
			} catch (Exception $e) {
				//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
		}
	}

	echo "<script>
		alert('El documento se ha enviado correctamente!');
		window.location.href = '../administrar/index.php';
	</script>";
	
	//header('Location: ../administrar/index.php');
	
	//  aqui elimino la variable del formulario
	unset($_SESSION['IdForm']);
}



function TemplatesData(){
	require_once "../config/APP.php";
	include '../conexion.php';
	require_once '../session.php';
	include '../dominio.php';

	$doc_id = $_POST['doc_id'];
	$_SESSION['codigo_documento'] = $doc_id;
	$URL = $_GET['nombreArchivo'];

	$typeTemplate = explode("-", explode("/", $URL)[4])[0];
	
	switch ($typeTemplate) {
		case 'Contract':
			include_once '../plantillasview/Condominios/ContractView.php';
		break;
		
		default:
			$sql = "SELECT DISTINCT id_plantilla FROM valores_plantilla WHERE doc_id='".$doc_id."'";
			$plantillas = $link->query($sql);

			foreach ($plantillas as $key) {
				$id_plantillas[] = $key['id_plantilla'];
			}
			include_once '../plantillasview/plantillas.php';	
		break;
	}
}

	function generatePdfContrato(){
		require_once "../config/APP.php";
		require_once '../session.php';
		include '../dominio.php';
	// campos del contrato
	ob_start();
	$var0=$_POST['0'];
	$var1=$_POST['1'];
	$var2=$_POST['2'];
	$var3=$_POST['3'];
	$var4=$_POST['4'];
	$var5=$_POST['5'];
	$var6=$_POST['6'];
	$var7=$_POST['7'];
	$var8=$_POST['8'];
	$var9=$_POST['9'];
	$var10=$_POST['10'];
	$var11=$_POST['11'];
	$var12=$_POST['12'];
	$var13=$_POST['13'];
	$var14=$_POST['14'];
	$var15=$_POST['15'];
	$var16=$_POST['16'];
	$var17=$_POST['17'];
	$var18=$_POST['18'];
	$var19=$_POST['19'];
	$var20=$_POST['20'];
	$ran = mt_rand();
	$nombre_archivo = $ran.'-'.$_POST['nombreArchivo'];
	$_SESSION['nombreArchivoContrato']=$nombre_archivo;

	// create new PDF document
	include('../recursos/tcpdf/examples/tcpdf_include.php');
	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');



	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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

	// crear html
	$html="
	<style>
	td{
		text-align:center;
		border:1px solid black;
	}
	small{
		text-align:center;
	}
	label{
		text-align:left;
	}
	h5{
		text-align:center;
	}
	</style>


				<div></div>
				<div></div>
					   <h5>
							<b>
								<u >
								CONTRATO INDIVIDUAL DE TRABAJO A TERMINO INDEFINIDO
								</u>
					   		</b>
						</h5>

					 <br>
					 <br>
					 <br>

                    <div class='col-md-12'>
                        <table>
                            <tr>
                                <td>
									DATOS DEL EMPLEADOR
								</td>
                                <td><label> NOMBRE DEL EMPLEADOR: ".$var0."<br><br> NIT: ".$var1."<br><br> REPRESENTANTE LEGAL: ".$var2."
								<br><br> DIRECCIÒN: ".$var3."<br><br> CIUDAD: ".$var4."</label></td>
                            </tr>
                            <tr>
                                <td>DATOS DEL TRABAJADOR</td>
                                <td><label> NOMBRE DEL EMPLEADO: ".$var5."<br><br> DOCUMENTO DE IDENTIDAD: ".$var6."<br><br> NO. ".$var7."<br><br> CARGO A DESEMPEÑAR: ".$var8."
                               </label></td>
                            </tr>
                            <tr>
                                <td>DATOS GENERALES DEL CONTRATO</td>
                                <td><label> SALARIO: ".$var9."<br><br> FORMA DE PAGO: ".$var10."<br><br> FECHA DE INGRESO: ".$var11."<br><br> CIUDAD DE EJECUCIÒN: ".$var12."</label></td>
                            </tr>
                        </table>
                        <p></p>
                        <p>Entre el empleador y trabajador, ambas mayores de edad, identificados como ya se anotó, se
                            suscribe DE TRABAJO A TERMINO INDEFINIDO, regido por las siguientes cláusulas:
                            PRIMERA: OBJETO: El empleador contrata los servicios personales del TRABAJADOR para
                            desempeñar el cargo de ".$var13."</p>
							<p></p>
							<p></p>
							<p></p>
							<p></p>
							<p></p>
							<p></p>
							<p></p>
							<p></p>
                    </div>
                </div>
                <div id='divcolor' class='x_panel col-md-8'>
                    <div class='col-md-12' style='text-align:justify;'>
					<div></div>
					<div></div>
                        <p style='text-align:justify;'><b>SEGUNDA: DURACION:</b> Término del contrato. El presente contrato tendrá una duración
                            indefinida,
                            pero podrá darse por terminado por cualquiera de las partes, cumpliendo con las exigencias
                            legales al respecto.
                        </p>
                        <p> <b>TERCERA: RESPONSABILIDADES Y FUNCIONES:</b><br>
                        <ol>
                            <li> Poner al servicio de SUNTIC S.A.S. toda su capacidad normal de trabajo, en el desempeño
                                de
                                las funciones propias del oficio mencionado y en las laborales anexas y complementarias
                                del
                                mismo, de conformidad con las órdenes e instrucciones que le imparta SUNTIC S.A.S
                                directamente o
                                a través de sus representantes.
                            </li>
                            <li>Guardar absoluta reserva sobre los hechos, documentos físicos y/o electrónicos,
                                informaciones
                                y en general, sobre todos los asuntos y materias que lleguen a su conocimiento por causa
                                o con
                                ocasión de su contrato de trabajo
                            </li>

                            <li>Ejecutar por si mismo las funciones asignadas y cumplir estrictamente las instrucciones
                                que
                                le sean dadas por la empresa o por quienes la representen respecto del desarrollo de sus
                                actividades
                            </li>
                            <li> Cuidar permanentemente los intereses del empleador </li>
                            <li> Dedicar la totalidad de la jornada laboral pactada y cumplir a cabalidad con sus
                                funciones</li>
                            <li>Observar completa armonía y comprensión con los clientes con sus superiores, compañeros
                                de
                                trabajo en sus relaciones personales y en la ejecución de su labor</li>
                            <li> Cumplir permanentemente con el espíritu de lealtad, colaboración y disciplina con el
                                empleador
                            </li>
                            <li>Avisar oportunamente y por escrito cualquier cambio de su dirección teléfono o ciudad de
                                residencia </li>
                            <li>En relación con la labor de ".$var14." deberá, sin limitarse a ellas, realizar las
                                actividades que permitan llevar en orden y perfecta ejecución las responsabilidades del
                                cargo,
                                mismas que se encuentran pactadas en documento adjunto al presente contrato y que hace
                                parte
                                integral del mismo. </li>
                        </ol>
                        </p>
                    </div>
                </div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>

						<p><b>CUARTA:</b> Lugar.
                                EL TRABAJADOR desarrollará sus funciones de ".$var15." en ".$var16." en las
                                dependencias o el lugar que la empresa determine, pudiendo incluso ser en distintas
                                sedes
                                dentro de la ciudad. Cualquier modificación del lugar de trabajo, que signifique cambio
                                de
                                ciudad, se hará conforme al Código Sustantivo de Trabajo.
                            </p>
                            <p><b>QUINTA:
                                </b>
                                Elementos de trabajo. Corresponde al empleador suministrar los elementos necesarios
                                para el normal desempeño de las funciones del cargo contratado.
                            </p>
                            <p><b>SEXTA:</b>

                                Periodo de prueba: Acuerdan las partes fijar como periodo de prueba de ".$var17." meses
                                contados a partir de la firme del contrato.
                            </p>

                            <p><b>SEPTIMA:</b>
                                Justas causas para terminar el contrato: Se dará por terminado el contrato con
                                justa causa ante el cumplimiento de la labor definida en el objeto del presente
                                contrato.
                                Además, son justas causas para dar por terminado unilateralmente el presente contrato
                                por
                                cualquiera de las partes, el incumplimiento a las obligaciones y prohibiciones que se
                                expresan en los artículos 57 y siguientes del Código sustantivo del Trabajo. Además del
                                incumplimiento o violación a las normas establecidas en el (Reglamento Interno de
                                Trabajo,
                                Higiene y de Seguridad) y las previamente establecidas por el empleador o sus
                                representantes.
                            </p>
                            <p><b> OCTAVA: </b> Salario. El empleador cancelará al trabajador(a) un salario mensual de ".$var18." ($ ".$var19.") pagaderos en el lugar de trabajo, dentro de los
                                cinco (5)
                                primeros días de cada mes vencido día. Dentro de este pago se encuentra incluida la
                                remuneración de los descansos dominicales y festivos de que tratan los capítulos I y II
                                del
                                título VII del Código Sustantivo del Trabajo.
                            </p>
                            <p><b>NOVENA:</b> Trabajo extra, en dominicales y festivos. El trabajo suplementario o en
                                horas
                                extras, así como el trabajo en domingo o festivo que correspondan a descanso, al igual
                                que los nocturnos, será remunerado conforme al código laboral. Es de advertir que dicho
                                trabajo debe ser autorizado u ordenado por el empleador para efectos de su
                                reconocimiento. Cuando se presenten situaciones urgentes o inesperadas que requieran la
                                necesidad de este trabajo suplementario, se deberá ejecutar y se dará cuenta de ello por
                                escrito, en el menor tiempo posible al jefe inmediato, de lo contrario, las horas
                                laboradas de manera suplementaria que no se autorizó o no se notificó no será
                                reconocido.
                            </p>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
                            <p><b>DÉCIMA:</b> Horario. EL TRABAJADOR se obliga a laborar la jornada ordinaria en los turnos y
                                dentro de las horas señaladas por el empleador, pudiendo hacer éste ajustes o cambios de
                                horario cuando lo estime conveniente. Por el acuerdo expreso o tácito de las partes,
                                podrán repartirse las horas jornada ordinaria de la forma prevista en el artículo 164
                                del Código Sustantivo del Trabajo, modificado por el artículo 23 de la Ley 50 de 1990,
                                teniendo en cuenta que los tiempos de descanso entre las secciones de la jornada no se
                                computan dentro de la misma, según el artículo 167 ibídem.</p>

                                <p><b>DECIMA PRIMERA:</b> Afiliación y pago a seguridad social. Es obligación del empleador
                                afiliar al trabajador a la seguridad social como es salud, pensión y riesgos
                                profesionales, autorizando el TRABAJADOR el descuento en su salario, los valores que le
                                corresponda aportan, en la proporción establecida por la ley.</p>

                                <p><b>DECIMA SEGUNDA:</b> Modificaciones. Cualquier modificación al presente contrato debe
                                efectuarse por escrito y anexarse a este documento.</p>

                                <p><b>DECIMA TERCERA:</b> Efectos. El presente contrato reemplaza y deja sin efecto cualquier otro
                                contrato verbal o escrito, que se hubiera celebrado entre las partes con anterioridad.
                                Se firma por las partes, el ".$var20."</p>

                            </p>

                    </div>";
	//FIN DE CREAR HTML
	$pdf->writeHTML($html, true, false, true, false, '');

	$bodega = "/../bodega/precarga/".$_SESSION['codigo_usuario']."/".$_SESSION['nombreArchivoContrato'];
	$pdf->Output(__DIR__.$bodega, 'F');
	//varuables utilizar para la vista
	$nombreArchivo=$_SESSION['nombreArchivoContrato'];
	echo "<script>window.location.href ='../documentos/index.php?nombreArchivo=".$nombreArchivo."&rutaArchivo=".$bodega."';</script>";


	}