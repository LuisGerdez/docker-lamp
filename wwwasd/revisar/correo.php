<?php

use Models\Plantilla;

$codigo_usuario = $_SESSION['codigo_usuario'];
$nombre_usuario = $_SESSION['nombre_usuario'];
$apellido_usuario = $_SESSION['apellido_usuario'];
$correo_usuario = $_SESSION['correo_usuario'];
$codigo_documento = $_SESSION['codigo_documento'];
$codigo_detalle_documento = $_SESSION['codigo_detalle_documento'];
$correos_destinatarios = $_SESSION['correos_destinatarios'];

include '../Models/Plantilla.php';
include '../dominio.php';
$bytes = random_bytes(5);
$token = bin2hex($bytes);

if (isset($_POST['mensaje'])) {
	$mensaje = $_POST['mensaje'];
}

if (isset($_POST['nombre_archivo'])) {
	$nombre_archivo = $_POST['nombre_archivo'];
}

// variable Creada para firmar sin otp, y la utilizamos para restringir el envio del codigo cundo se quiera firmar sin OTP;
$sin_otp = $_SESSION['sin_otp'];
$codigo = $_SESSION['codigo'];

//Cuendo firmamos sin codigo de verificacion OTP enviamos el enlace de verificacion 
$enlace_verificacion = LINK_VERIFICAR_DESTINATARIO;
$enlace_registro = isset($_SESSION['sin_otp']) ? $link_formulario_destinatario : $link_formulario_destinatario_otp;

//Cuendo firmamos con codigo de verificacion OTP
if ($sin_otp == false) {
	$mensaje_otp = '<p style="text-align:justify;margin:0 0 12px 0;font-size:20px;line-height:24px;font-family:Vistol Sans;color:#ffffff;">Copie el siguiente codigo de validacion para validar el documento
	<h1 style="color:#ffffff;text-align:center;font-size:25px;margin:0 0 20px 0;font-family:Vistol Sans;">' . $codigo . '
	</h1></p>';

	//Cuendo firmamos con codigo de verificacion OTP 
	$enlace_verificacion = $link_verificacion_destinatario_otp;
}

$nombre_archivostr = str_replace(" ", ";", $nombre_archivo);

$nombre = utf8_decode($nombre_usuario) . ' ' . utf8_decode($apellido_usuario);

if(!$sin_otp){

	$correo_registrado = Plantilla::getRegisterEmailTemplate($nombre, $correo_usuario, $nombre_archivostr, $enlace_verificacion, 3, utf8_decode($mensaje), $codigo);
	$correo_noregistrado = Plantilla::getRegisterEmailTemplate($nombre, $correo_usuario, $nombre_archivo, $enlace_registro, 1, utf8_decode($mensaje), $codigo);
}
else {
	$correo_registrado = Plantilla::getRegisterEmailTemplate($nombre, $correo_usuario, $nombre_archivostr, $enlace_verificacion, 4, utf8_decode($mensaje), null);
	$correo_noregistrado = Plantilla::getRegisterEmailTemplate($nombre, $correo_usuario, $nombre_archivo, $enlace_registro, 2, utf8_decode($mensaje), null);
}
