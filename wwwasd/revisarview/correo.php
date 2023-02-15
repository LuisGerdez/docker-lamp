<?php
$_SESSION['codigo_usuario'];
$codigo_usuario = $_SESSION['codigo_usuario'];
$nombre_usuario = $_SESSION['nombre_usuario'];
$apellido_usuario = $_SESSION['apellido_usuario'];
$correo_usuario = $_SESSION['correo_usuario'];
$codigo = $_SESSION['codigo'];

$codigo_documento = $_SESSION['codigo_documento'];
$codigo_detalle_documento = $_SESSION['codigo_detalle_documento'];

$correos_destinatarios = $_SESSION['correos_destinatarios'];

include '../dominio.php';
$bytes = random_bytes(5);
$token = bin2hex($bytes);

if (isset($_POST['mensaje'])) {
    $mensaje = $_POST['mensaje'];
}

if (isset($_POST['nombre_archivo'])) {
    $nombre_archivo = $_POST['nombre_archivo'];
}

$nombre_archivostr=str_replace(" ",";",$nombre_archivo);



$correo_registrado = '
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="x-apple-disable-message-reformatting">
	<title></title>
	<!--[if mso]>
	<noscript>
		<xml>
			<o:OfficeDocumentSettings>
				<o:PixelsPerInch>96</o:PixelsPerInch>
			</o:OfficeDocumentSettings>
		</xml>
	</noscript>
	<![endif]-->
	<style>
		table, td, div, h1, p {font-family: Vistol Sans;}
	</style>
</head>
<body style="margin:0;padding:0;">
	<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
		<tr>
			<td align="center" style="padding:0;">
				<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;background: #006CD8;">
					<tr>
						<td align="center" style="padding:40px 0 20px 0;">
							<img src="https://i.postimg.cc/k59PNfDq/Firmadoc-corp-logo-SUNTIC2-Blanco.png" alt="" width="300" style="height:auto;display:block;" />
						</td>
					</tr>
					<tr>
						<td align="center"style="padding:30px 0 20px 0;">
							<img src="https://i.postimg.cc/W36gsx2r/h2-preview-rev-1.png" alt="" width="300" style="height:auto;display:block;" />
						</td>
					</tr>
					<tr>
						<td style="padding:30px 30px 42px 30px;">
							<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
								<tr>
								<td style="padding:0 0 36px 0;color:#153643;">
								<h1 style="color:#ffffff;text-align:center;font-size:25px;margin:0 0 20px 0;font-family:Vistol Sans;">'.utf8_decode($nombre_usuario).' '.utf8_decode($apellido_usuario).'</h1>
								<p style="text-align:justify;margin:0 0 12px 0;font-size:20px;line-height:24px;font-family:Vistol Sans;color:#ffffff;">Le ha enviado un documento para que revise y firme</p>
								
								<p style="text-align:justify;margin:0 0 12px 0;font-size:20px;line-height:24px;font-family:Vistol Sans;color:#ffffff;">Copie el siguiente codigo de validacion ! FIRMADOC ! Para firmar el documento
								<h1 style="color:#ffffff;text-align:center;font-size:25px;margin:0 0 20px 0;font-family:Vistol Sans;">' . $codigo.'
								</h1>
								</p>

								<p style="text-align:justify;margin:0 0 12px 0;font-size:20px;line-height:24px;font-family:Vistol Sans;color:#ffffff;">
								</p>

								<p style=" text-align:center;margin:30px 0 15px 0;font-size:20px;line-height:24px;font-family:Vistol Sans;"><a href="' . $link_verificacion_destinatario_otp.'" style="text-decoration:underline;background:#ffffff;padding: 20px 60px 20px;text-align:center;border-radius: 5px;
								border-color: #FFFFFF; text-decoration:none; color:black;">Firmar</a></p>
							</td>
								</tr>
								<tr>
									<td style="padding:0;">
										<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
											<tr>
												<td style="width:260px;padding:0;vertical-align:top;color:#153643;">
													<p style="margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff;"><img src="https://assets.codepen.io/210284/left.gif" alt="" width="260" style="height:auto;display:block;" /></p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;"><h3 style="color:#ffffff;">REQUISITOS PARA REGISTRO</h3></p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">1. Contar con conexion a internet.</p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">2. Contar con un dispositivo con Camara. </p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">3. Tener su cedula de identidad a la mano si va a firmar por primera vez.</p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">4. En caso de realizar el registro por primera vez desde un PC, debe tener cargada la imagen frontal y reversa de su cedula. En caso de realizar el proceso desde un movil, podra tomar la fotografía de su cedula en el mismo momento de registro.</p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">5. Se recomienda navegador Google Chrome.</p>
												</td>
												<td style="width:20px;padding:0;font-size:0;line-height:0;">&nbsp;</td>
												<td style="width:260px;padding:0;vertical-align:top;color:#153643;">
													<p style="margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff;"><img src="https://assets.codepen.io/210284/right.gif" alt="" width="260" style="height:auto;display:block;" /></p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;"><h3 style="color:#ffffff;">TOMAR EN CUENTA LAS SIGUIENTES RECOMENDACIONES AL FIRMAR UN DOCUMENTO:</h3></p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">1. No salir de la pantalla mientras realiza el proceso de registro o verificacion.</p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">2. Realizar el proceso de registro facial en un sitio iluminado.</p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">3. Al momento de tomar la foto de su cedula, tratar en lo posible que ninguna parte de la imagen tenga demasiada iluminacion o partes borrosas, en especial la fotografia del rostro.</p>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style="padding:30px;background:#555555;">
							<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
								<tr>
									<td style="padding:0;width:50%;" align="left">
										<p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
											&reg; Suntic S.A.S, Cali 2022<br/>
										</p>
									</td>
									<td style="padding:0;width:50%;" align="right">
										<table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
											<tr>
												<td style="padding:0 0 0 10px;width:38px;">
													<a href="https://firmadoc.co/" style="color:#ffffff;"><img src="https://i.postimg.cc/mg1MzdWX/Icono-Firmadoc.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
												</td>
												<td style="padding:0 0 0 10px;width:38px;">
													<a href="https://portal-id.com/" style="color:#ffffff;"><img src="https://i.postimg.cc/fTnkqMGK/Icono-Portal-id.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>';

$correo_noregistrado = '<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="x-apple-disable-message-reformatting">
	<title></title>
	<!--[if mso]>
	<noscript>
		<xml>
			<o:OfficeDocumentSettings>
				<o:PixelsPerInch>96</o:PixelsPerInch>
			</o:OfficeDocumentSettings>
		</xml>
	</noscript>
	<![endif]-->
	<style>
		table, td, div, h1, p {font-family: Vistol Sans;}
	</style>
</head>
<body style="margin:0;padding:0;">
	<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
		<tr>
			<td align="center" style="padding:0;">
				<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;background: #006CD8;">
					<tr>
						<td align="center" style="padding:40px 0 20px 0;">
							<img src="https://i.postimg.cc/k59PNfDq/Firmadoc-corp-logo-SUNTIC2-Blanco.png" alt="" width="300" style="height:auto;display:block;" />
						</td>
					</tr>
					<tr>
						<td align="center"style="padding:30px 0 20px 0;">
							<img src="https://i.postimg.cc/W36gsx2r/h2-preview-rev-1.png" alt="" width="300" style="height:auto;display:block;" />
						</td>
					</tr>
					<tr>
						<td style="padding:30px 30px 42px 30px;">
							<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
								<tr>
									<td style="padding:0 0 36px 0;color:#153643;">
										<h1 style="color:#ffffff;text-align:center;font-size:25px;margin:0 0 20px 0;font-family:Vistol Sans;">'.utf8_decode($nombre_usuario).' '.utf8_decode($apellido_usuario).'</h1>
										<p style="text-align:justify;margin:0 0 12px 0;font-size:20px;line-height:24px;font-family:Vistol Sans;color:#ffffff;">Le ha enviado un documento para que revise y firme, Por favor, redirigirse al registro presionando el boton</p>
										<p style="text-align:justify;margin:0 0 12px 0;font-size:20px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: center;">'.utf8_decode($mensaje).'</p>
										<p style=" text-align:center;margin:30px 0 15px 0;font-size:20px;line-height:24px;font-family:Vistol Sans;"><a href="' . $link_formulario_destinatario.'" style="text-decoration:underline;background:#ffffff;padding: 20px 60px 20px;text-align:center;border-radius: 5px;
										border-color: #FFFFFF; text-decoration:none; color:black;">Registrarse</a></p>
									</td>
								</tr>
								<tr>
									<td style="padding:0;">
										<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
											<tr>
												<td style="width:260px;padding:0;vertical-align:top;color:#153643;">
													<p style="margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;"><img src="https://assets.codepen.io/210284/left.gif" alt="" width="260" style="height:auto;display:block;" /></p>
														<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;"><h3 style="color:#ffffff;">REQUISITOS PARA REGISTRO</h3></p>
														<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">1. Contar con conexion a internet.</p>
														<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">2. Contar con un dispositivo con Camara. </p>
														<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">3. Tener su cedula de identidad a la mano si va a firmar por primera vez.</p>
														<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">4. En caso de realizar el registro por primera vez desde un PC, debe tener cargada la imagen frontal y reversa de su cedula. En caso de realizar el proceso desde un movil, podra tomar la fotografía de su cedula en el mismo momento de registro.</p>
														<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">5. Se recomienda navegador Google Chrome.</p>
												</td>
												<td style="width:20px;padding:0;font-size:0;line-height:0;">&nbsp;</td>
												<td style="width:260px;padding:0;vertical-align:top;color:#153643;">
													<p style="margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;"><img src="https://assets.codepen.io/210284/right.gif" alt="" width="260" style="height:auto;display:block;" /></p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;"><h3 style="color:#ffffff;">TOMAR EN CUENTA LAS SIGUIENTES RECOMENDACIONES AL FIRMAR UN DOCUMENTO:</h3></p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">1. No salir de la pantalla mientras realiza el proceso de registro o verificacion.</p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">2. Realizar el proceso de registro facial en un sitio iluminado.</p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">3. Al momento de tomar la foto de su cedula, tratar en lo posible que ninguna parte de la imagen tenga demasiada iluminacion o partes borrosas, en especial la fotografia del rostro.</p>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style="padding:30px;background:#555555;">
							<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
								<tr>
									<td style="padding:0;width:50%;" align="left">
										<p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
											&reg; Suntic S.A.S, Cali 2022<br/>
										</p>
									</td>
									<td style="padding:0;width:50%;" align="right">
										<table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
											<tr>
												<td style="padding:0 0 0 10px;width:38px;">
													<a href="https://firmadoc.co/" style="color:#ffffff;"><img src="https://i.postimg.cc/mg1MzdWX/Icono-Firmadoc.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
												</td>
												<td style="padding:0 0 0 10px;width:38px;">
													<a href="https://portal-id.com/" style="color:#ffffff;"><img src="https://i.postimg.cc/fTnkqMGK/Icono-Portal-id.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>';

// $enlace_firma = $dominio.'validacion/index.php?token='.$token.'&nombre_archivo='.$nombre_archivostr.'&codigo_usuario='.$codigo_usuario.'&codigo_documento='.$codigo_documento.'&codigo_detalle_documento='.$codigo_detalle_documento.'&correos_destinatarios='.$correos_destinatarios;
// include '../conexion.php';
// mysqli_query($link,"UPDATE detalledocumento SET link_firma = '$enlace_firma' WHERE det_docume = '$codigo_documento'");




//echo $correo;
