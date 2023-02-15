<?php

include '../dominio.php';

$nombre_archivo = $_SESSION['ruta_archivo'];

$correo = '
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="x-apple-disable-message-reformatting">
        <link rel="stylesheet" href="./style_correo.css">
    </head>
    <body>
        <main class="background">
            <div class="logo-container">
                <img src="./logo.png" alt="" class="logo">
            </div>
            <section class="content">
                <div class="header">
                    <h1>nicoláz vélez</h1>
                    <p>
                        Le ha enviado un documento
                        <br>
                        <span class="documento">(Proyecto santa clara norte.pdf)</span>
                        <br>
                        para revisar y firmar
                    </p>
                    <img class="firma" src="./firma.png">
                </div>
                <div class="body">
                    <p>
                        Por favor, redirigirse al registro
                        <br>
                        presionando el boton:
                    </p>
                    <a href="#">registrarse</a>
                    <div class="shadow"></div>
                </div>
            </section>
            <div class="footer">
                <h4>Recomendaciones</h5>
                <p>Para una mejor experiencia tenga en cuenta:</p>
                <ul>
                    <li>
                        <p class="item">Utilizar navegadores Google Chrome y Safari.</p>
                    </li>
                    <li>
                        <p class="item">Navegue siempre en una pestaña de incognito.</p>
                    </li>
                    <li>
                        <p class="item">Disponga de una camara web.</p>
                    </li>
					<li>
						<p class="item">Cuente con una conexion a internet estable.</p>
					</li>
                </ul>
            </div>
        </main>
    </body>
</html>
';

/*$correo = '
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="x-apple-disable-message-reformatting">
	<title></title>
	<style>
		table, td, div, h1, p {font-family: Vistol Sans;}
	</style>
</head>
<body style="margin:0;padding:0;">
	<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
		<tr>
			<td align="center" style="padding:0;">
				<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;background: #084078;">
					<tr>
						<td align="center" style="padding:40px 0 20px 0;">
							<img src="https://i.postimg.cc/k59PNfDq/Firmadoc-corp-logo-SUNTIC2-Blanco.png" alt="" width="300" style="height:auto;display:block;" />
						</td>
					</tr>
					<tr>
						<td align="center"style="padding:20px 0 20px 0;">
							<img src="https://i.postimg.cc/8P7Qc7ds/Mask-group.png" alt="" width="150" style="height:auto;display:block;" />
						</td>
					</tr>
					<tr>
						<td style="padding:30px 30px 42px 30px;">
							<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
								<tr>
									<td style="padding:0 0 36px 0;color:#153643;">
										<p style="text-align:justify;margin:0 0 12px 0;font-size:20px;line-height:24px;font-family:Vistol Sans;color:#ffffff;">En el siguiente boton puede descargar y validar el documento</p>
										<p style=" text-align:center;margin:30px 0 15px 0;font-size:20px;line-height:24px;font-family:Vistol Sans;"><a href="' . $dominio . 'descargar/index.php?nombre_archivo=' . $nombre_archivo . '" style="text-decoration:underline;background:#ffffff;padding: 20px 60px 20px;text-align:center;border-radius: 5px;
										border-color: #FFFFFF; text-decoration:none; color:black;">Ver Documento</a></p>
									</td>
								</tr>
								<tr>
									<td style="padding:0;">
										<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
											<tr>
												<td style="width:260px;padding:0;vertical-align:top;color:#153643;">
													<p style="margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff;"><img src="https://assets.codepen.io/210284/left.gif" alt="" width="260" style="height:auto;display:block;" /></p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tempus adipiscing felis, sit amet blandit ipsum volutpat sed. Morbi porttitor, eget accumsan dictum, est nisi libero ultricies ipsum, in posuere mauris neque at erat.</p>
												</td>
												<td style="width:20px;padding:0;font-size:0;line-height:0;">&nbsp;</td>
												<td style="width:260px;padding:0;vertical-align:top;color:#153643;">
													<p style="margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff;"><img src="https://assets.codepen.io/210284/right.gif" alt="" width="260" style="height:auto;display:block;" /></p>
													<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff;">Morbi porttitor, eget est accumsan dictum, nisi libero ultricies ipsum, in posuere mauris neque at erat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tempus adipiscing felis, sit amet blandit ipsum volutpat sed.</p>
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
</html>';*/

?>