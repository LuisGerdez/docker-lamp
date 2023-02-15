<?php

$_SESSION['codigo_usuario'] = 1;
$codigo_usuario = $_SESSION['codigo_usuario'];

$codigo_documento = $_SESSION['codigo_documento'];
$codigo_detalle_documento = $_SESSION['codigo_detalle_documento'];

include '../dominio.php';
$bytes = random_bytes(5);
$token = bin2hex($bytes);

if (isset($_POST['mensaje'])) {
    $mensaje = $_POST['mensaje'];
}

if (isset($_POST['nombre_archivo'])) {
    $nombre_archivo = $_POST['nombre_archivo'];
}

$correo = '
<html>
    <head>
        <title>Hola</title>
        <style type="text/css">
            .correo-container{
                padding: 0;
                margin: 0;
            }
            
            .correo-logo{
                width: 100%;
                font-size: 25px;
                font-weight: bold;
            }
            
            .correo-panel{
                width: 100%;
                background-color: #00f;
                color: #fff;
                font-family: Arial;
            }
            
            .correo-icono{
                text-align: center;
                font-size: 50px;
                padding-top: 30px;
                padding-bottom: 30px;
            }
            
            .correo-leyenda{
                text-align: center;
                font-size: 20px;
                padding-top: 10px;
                padding-bottom: 10px;
            }
            
            .correo-link{
                text-align: center;
                justify-content: center;
                padding-top: 10px;
                padding-bottom: 10px;
            }
            
            .correo-link a{
                text-decoration: none;
            }
            
            .link-boton{
                padding: 10px;
                margin-left: 35%;
                margin-right: 35%;
                background-color: #FCEC00;
                border: 0.1px solid #B9B9B9;
                cursor: pointer;
                font-weight: bold;
                color: #43433B;
            }
            
            .link-boton label{
                cursor: pointer;
                text-decoration: none;
            }
            
            .correo-cuerpo{
                width: 100%;
                font-family: Arial;
            }
            
            .cuerpo-remitente{
                text-align: left;
                font-size: 15px;
            }
        </style>
    </head>
    <body>
        <div class="correo-container">
            <div class="correo-logo">
                <label>FirmaDoc</label>
            </div>
            <div class="correo-panel">
                <div class="correo-icono">
                    <img src="' . $dominio . 'revisar/icono.jpg" alt="FD">
                </div>
                <div class="correo-leyenda">
                    <p>Alejandro Cardenas le ha enviado un documento para que revise y firme</p>
                    <p>Codigo de seguridad: ' . $token . '</p>
                </div>
                <div class="correo-link">
                    <a href="' . $dominio . 'validacion/validar.php?token=' . $token . '&nombre_archivo=' . $nombre_archivo . '&codigo_usuario=' . $codigo_usuario . '&codigo_documento=' . $codigo_documento . '&codigo_detalle_documento=' . $codigo_detalle_documento . '">
                        <div class="link-boton">
                            <label>Revisar Documento</label>
                        </div>
                    </a>
                </div>
            </div>
            <div class="correo-cuerpo">
                <div class="cuerpo-remitente">
                    <p><b>Alejandro Cardenas</b></p>
                    <p>alejocarpa@hotmail.com</p>
                    <br>
                    <p>' . $mensaje . '</p>
                </div>
            </div>
        </div>
    </body>
</html>';

?>