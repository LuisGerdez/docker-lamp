
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../codigo-verificacion/css/sweetalert2.css">
    <script src="../codigo-verificacion/js/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start(['name' => 'SITI']);
//Load Composer's autoloader
require '../registro_usuario/vendor/autoload.php';
include '../conexion.php';
require_once "../config/APP.php";

$_SESSION['codigo_usuario'];
$email = $_SESSION['correo_usuario'];

if(isset($_POST['opciones_firma'])){
    $firmante = $_POST['opciones_firma'];
}

$email_Arary = $_SESSION['correos_destinatarios'];

//Generamos el otp
$_SESSION['codigo'] = rand(1000, 99999999);
$codigo = $_SESSION['codigo'];
$bytes = random_bytes(5);

if(isset($unico_firmante)){
    $unico_firmante;
}
if(isset($no_firmante)){
    $no_firmante;
}
if(isset($varios_destinatarios)){
    $varios_destinatarios;
}

$emails = explode("*/*", $email_Arary);

    if (isset($firmante )===isset($varios_destinatarios)||isset($firmante)==isset($unico_firmante)) {

        echo "<script>Swal.fire({
            icon: 'success',
            html: 'Su c&oacute;digo de validaci&oacute;n fue enviado al <b><i><u>CORREO</u></i></b>.',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
            allowOutsideClick: false
                 });</script>";
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            $mensaje = '
            <html>
            <head>
            <title>Codigo de validaCi&oacute;n' . COMPANY . '.</title>
            </head>
            <body>
            <h1 style="text-align:center">C&oacute;digo de validaci&oacute;n</h1>
            <div style="text-align:center">
            <p>Por favor copie el siguiente c&oacute;digo <b><br> <i>' . COMPANY . '</i></b>:</p>
            <h2>' . $codigo . '</h2>
            </div>
            </body>
            </html>
            ';

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = Host;                                   //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = Username;                               //SMTP username
            $mail->Password   = Password;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = Port;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            
            $mail->setFrom(Username, COMPANY);
            
            //Remitentes y Destinatarios
            //Solo le llega el codigo otp al remitente
            if (isset($firmante )===isset( $varios_destinatarios)) {
                $mail->AddAddress($email,'User');
            }
            //remitente y destinatarios 
            // for ($i = 0; $i < count($emails)-1; $i++) {
            //     $mail->AddAddress($emails[$i],'User');
            //     //echo $emails[$i];
            // }
            // destinatarios
            
          
            // $mail->addAddress($email, 'User');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = COMPANY . ' - Codigo de validacion.';
            $mail->Body    = $mensaje;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            ob_start();
            $mail->send();
            ob_end_clean();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    var_dump($codigo);
?>
</body>
</html>