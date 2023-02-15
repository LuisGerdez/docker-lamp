<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
/*
*   Software development - Ing. Bernabe Sanchez Lenis
*/
require_once "../config/APP.php";

//Load Composer's autoloader
require 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo COMPANY ?></title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo FAVICON ?>">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">
  <script src="js/sweetalert2.js"></script>
</head>
<body>
  <form action="" method="post">
    <div class="container-form">
      <div class="imgcontainer">
        <img src="<?php echo LOGOWHITE ?>" alt="alt" width="220" height="55"/>
      </div>

      <div class="container">
        <label for="uname"><b>Correo electr&oacute;nico</b></label>
        <input type="text" placeholder="Ingrese su correo electr&oacute;nico" name="uname" id="uname" value="<?php if(isset($_POST['uname'])){echo $_POST['uname'];}?>">
        
        <button type="submit" name="ncontrasena">Nueva contrase&ntilde;a</button>
        <p><a href="../">Inicio de sesi&oacute;n.</a></p>
      </div>
    </div>
  </form>
</body>
</html>
<?php
if(isset($_POST['ncontrasena'])){

  $u = $_POST['uname'];
  $codigo = rand(1000,99999999);
  $bytes = random_bytes(5);
  $token = bin2hex($bytes);

  if (empty($u)) {
    echo "<script>document.getElementById('uname').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Por favor ingrese su correo electr&oacute;nico.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else {

    include '../conexion.php';

    $sqluser = "select * from usuario where usu_email = '$u'";
    $result = $link->query($sqluser);
    $user = $result->fetch_array(MYSQLI_ASSOC);

    $user_id = (int) $user['usu_id'];
    $edb = (string) $user['usu_email'];

    if ($u !== $edb) {
      echo "<script>document.getElementById('uname').focus();</script>";
      echo "<script>Swal.fire({
        icon: 'error',
        html: 'El correo electr&oacute;nico <b><i><u>".$u."</u></i></b> no est&aacute; registrado.',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar',
        allowOutsideClick: false
      });</script>";
    }else {
      if (filter_var($u, FILTER_VALIDATE_EMAIL)) {
        $sql = "update usuario set usu_token='$token', usu_codigo='$codigo', usu_codigo_vivo=false WHERE usu_id=$user_id";
        $link->query($sql);

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
        // mensaje
        $mensaje = '
        <html>
        <head>
        <title>Solicitud para cambio de contrase&ntilde;a.</title>
        </head>
        <body>
        <h1 style="text-align:center">C&oacute;digo de verificaci&oacute;n.</h1>
        <div style="text-align:center">
        <p>Por favor copie el siguiente c&oacute;digo para registrar la nueva contrase&ntilde;a de su cuenta en <b><i>'.COMPANY.'</i></b>:</p>
        <h2>'.$codigo.'</h2>
        <p>Por favor ingrese el c&oacute;digo <a href="'.SERVERURL.'codigo-verificacion-contrasena/?f='.$user_id.'&d='.$token.'"><b>aqu&iacute;</b></a></p>
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
            
            //Recipients
            $mail->setFrom(Username, COMPANY);
            $mail->addAddress($u, 'User');     //Add a recipient
            
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = utf8_decode(COMPANY.' - cambio de contraseña.');
            $mail->Body    = $mensaje;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
            ob_start();
            $mail->send();
            ob_end_clean();
            //echo 'Message has been sent';
          } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          }
          
          echo "<script>Swal.fire({
            icon: 'success',
            title: 'Solicitud realizada!!!',
            html: 'Por favor revise su correo electr&oacute;nico <b><i><u>".$u."</u></i></b> para el cambio de contrase&ntilde;a.',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
            allowOutsideClick: false
            }).then((result) => {
              if (result.isConfirmed) {
                window.location = '".SERVERURL."login';
              }
            });</script>";
          } else {
          }      
        }
      }
    }
  ?>