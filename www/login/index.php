<?php
@session_start(['name' => 'SITI']);

/*
*   Software development - Ing. Bernabe Sanchez Lenis
*/


require_once "../config/APP.php";
require_once '../Models/Mail.php';
require_once '../Models/CSRFToken.php';
require_once '../Models/Certificado.php';

use Models\Certificado;
use \Models\Mail;
use Models\Session;

?>
<!DOCTYPE html>
<html>

<head>
  <title><?php echo COMPANY ?></title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo FAVICON ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">
  <script src="js/sweetalert2.js"></script>
</head>

<body>
  <form method="post" id="form">
    <div class="container-form">
      <div class="imgcontainer">
        <img src="<?php echo LOGOWHITE ?>" alt="alt" width="320" height="55" />
      </div>
      <div class="container">

        <label for="uname"><b>Correo electrónico</b></label>
        <input type="text" placeholder="Ingrese su correo electrónico" name="uname" id="uname" value="<?php if (isset($_POST['uname'])) {
                                                                                                        echo $_POST['uname'];
                                                                                                      } ?>">

        <label for="psw"><b>Contraseña</b></label>
        <input type="password" placeholder="Ingrese su contrase&ntilde;a" name="psw" id="psw" value="<?php if (isset($_POST['psw'])) {
                                                                                                        echo $_POST['psw'];
                                                                                                      } ?>">
        <input type="hidden" name="tokenCSRF" id="tokenCSRF">
        <button type="submit" name="login">Ingresar</button>
        <p><a href="../olvido-contrasena">Olvidé mi contraseña.</a></p>
        <p><a href="../registro_usuario">Registrar una nueva cuenta.</a></p>
      </div>
    </div>
  </form>
</body>

</html>

<?php
include '../conexion.php';
// GEneramos los enlaces para tener la opcion de redirigirse a los destinos seleccionados

function redireccion()
{

  //Creación de directorios para el usuario.
  $directorioimgfirmatmp = "../bodega/precarga/" .  $_SESSION['codigo_usuario'] . "/imgfirmatmp";
  $directorioimgfirmafija = "../bodega/precarga/" .  $_SESSION['codigo_usuario'] . "/imgfirmafija";
  $directoriofirmadigital = "../bodega/precarga/" .  $_SESSION['codigo_usuario'] . "/firmadigital";
  $directoriofirmado = "../bodega/firmado/" .  $_SESSION['codigo_usuario'];
  $directorioeliminado = "../bodega/eliminado/" .  $_SESSION['codigo_usuario'];
  
 
  if((is_dir($directorioimgfirmatmp) && is_dir($directorioimgfirmafija) && is_dir($directoriofirmadigital) && is_dir($directoriofirmado) && is_dir($directorioeliminado)) != true){
    mkdir($directorioimgfirmatmp, 0755, true);
    mkdir($directorioimgfirmafija, 0755, true);
    mkdir($directoriofirmadigital, 0755, true);
    mkdir($directoriofirmado, 0755, true);
    mkdir($directorioeliminado, 0755, true);
  }


  if (isset($_GET['codigo'])) {
    if ($_GET['codigo'] == "OTP") {
      echo "<script>window.location.replace('../administrar/layout/layout.php?menu=pendientes_entrada');</script>";
    } //Redireccion plantillas
    else if ($_GET['codigo'] == "OTP2") {
      echo "<script>window.location.replace('../administrar/layout/layout.php?menu=pendientes_entrada');</script>";
    }
  } else {
    // var_dump( 'Yes');
    echo "<script>window.location.replace('../dashboard/');</script>";
  }

}

if (isset($_POST['login'])) {

  $u = $_POST['uname'];
  $c = ($_POST['psw']);
  $CSRF = $_POST['tokenCSRF'];
  $clv = strlen($c);

  if (empty($u)) {
    echo "<script>document.getElementById('uname').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Por favor ingrese su correo electr&oacute;nico.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else if (empty($c)) {
    echo "<script>document.getElementById('psw').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Por favor ingrese su contrase&ntilde;a.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else if ($clv < 8) {
    echo "<script>document.getElementById('psw').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'La contrase&ntilde;a debe tener m&iacute;nimo 8 caracteres.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else {


    $sqluser = "SELECT * FROM usuario where usu_email= '$u'";

    $result = $link->query($sqluser);
    $user = $result->fetch_array(MYSQLI_ASSOC);

    $user_id = (int) $user['usu_id'];
    $hash =  $user['usu_passwo'];

    
    if (password_verify($c, $hash)) {

      include '../conexion.php';

      $_SESSION['codigo_usuario'] = $user['usu_id'];
      $_SESSION['rol'] = $user['rol_usuario'];
      $_SESSION['cedula_usuario'] = $user['usu_docume'];
      $_SESSION['correo_usuario'] = $user['usu_email'];
      $_SESSION['nombre_usuario'] = $user['usu_nombre'];
      $_SESSION['apellido_usuario'] = $user['usu_apelli'];
      $_SESSION['tipo_documento'] = $user['usu_tipo_documento'];
      $_SESSION['celular'] = $user['usu_celula'];
      redireccion();
    } else {
      echo "<script>Swal.fire({
        icon: 'error',
        title: 'Error. . .',
        html: 'Usuario o contrase&ntilde;a no son validos.',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar',
        allowOutsideClick: false
      });</script>";
    }
  }
}
?>