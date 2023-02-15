<?php
session_start(['name'=>'SITI']);
/*
*   Software development - Ing. Bernabe Sanchez Lenis
*/
require_once "../config/APP.php";
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
        <img src="<?php echo LOGOBLACK ?>" alt="alt" width="220" height="55"/>
      </div>
      <div class="container">
        <label for="code"><b>Ingrese el c&oacute;digo de verificaci&oacute;n.</b></label>
        <input type="text" id="txt_verificar_codigo" name="txt_verificar_codigo" placeholder="C&oacute;digo de verificaci&oacute;n" value="<?php if(isset($_POST['txt_verificar_codigo'])){echo $_POST['txt_verificar_codigo'];}?>" autofocus>
        <input type="hidden" class="form-control" id="usuario" name="usuario" value="<?php echo $_GET["f"];?>">
        <input type="hidden" class="form-control" id="token" name="token" value="<?php echo $_GET["d"];?>">
        <button type="submit" name="confirmarcode">Confirmar</button>
      </div>
    </div>
  </form>
</body>
</html>
<?php

if (isset($_POST['confirmarcode'])) {
  $codigo = $_POST['txt_verificar_codigo'];

  if (empty($codigo)) {
  echo "<script>document.getElementById('txt_verificar_codigo').focus();</script>";
  echo "<script>Swal.fire({
    icon: 'warning',
    html: 'Por favor ingrese el c&oacute;digo de verificaci&oacute;n.',
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Aceptar',
    allowOutsideClick: false
  });</script>";
}else {

  $code = $_POST['txt_verificar_codigo'];
  $user = $_POST['usuario'];
  $token = $_POST['token'];

  include '../conexion.php';

  if ($link->connect_errno) {
    echo "ERROR al conectar con la DB.";
    exit;
  }

  $sqlvalido = "select * from usuario where usu_id = $user and usu_token = '$token' and usu_codigo = $code and usu_codigo_vivo = 0";
  $result = $link->query($sqlvalido);
  $cv = mysqli_num_rows($result);

  if (!$cv) {
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'El c&oacute;digo es <b><i><u>INV&Aacute;LIDO</u></i></b>.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else {

      $sqlinf = "select usu_id, usu_email from usuario where usu_id = $user";
      $result = $link->query($sqlinf);
      $verificar = mysqli_fetch_array($result, MYSQLI_ASSOC);
    echo "<script>Swal.fire({
      icon: 'success',
      html: 'El c&oacute;digo es <b><i><u>CORRECTO</u></i></b>.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = '".SERVERURL."registro-password-new';
        }
      });</script>";
      //Paso de variables a register-password

      $_SESSION['iduser']=$verificar['usu_id'];
      $_SESSION['email']=$verificar['usu_email'];
    }
  }
}
?>