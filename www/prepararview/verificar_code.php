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
    session_start(['name' => 'SITI']);
    require_once "../config/APP.php";
    include '../conexion.php';

    $_SESSION['codigo_usuario'];
    $codigo_usuario = $_SESSION['codigo_usuario'];
    $codigo = $_SESSION['codigo'];
    $verificar_codigo = $_POST['verificar_codigo'];
    
    function Codigo_validacion()
    {
        include '../conexion.php';
        global $codigo_usuario;
        $sql = "INSERT INTO codigo_validacion(id_user,estado) values ('$codigo_usuario','2' )";
        $resultcode = $link->query($sql);
        $string = 'hola';
        return $string;
    }

    function codigo_verificacion()
    {
        global $codigo;
       global $verificar_codigo;
        if (empty($verificar_codigo)) {
            echo "<script>Swal.fire({
                icon: 'warning',
                html: 'Por favor ingrese el c&oacute;digo de verificaci&oacute;n.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
                     });</script>";
        }   else {
            if ($verificar_codigo != $codigo) {
                echo "<script>Swal.fire({
                icon: 'warning',
                html: 'El c&oacute;digo de verificaci&oacute;n es incorrecto',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
                     });</script>";
            }
            if ($verificar_codigo == $codigo) {
                  Codigo_validacion();
            }
            if ($verificar_codigo == $codigo) {

                echo "<script>Swal.fire({
                    icon: 'success',
                    html: 'El c&oacute;digo es <b><i><u>CORRECTO</u></i></b>.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                    }).then((result) => {
                      if (result.isConfirmed) {
                      location.reload(); 
                      }
                    });</script>";
            }
        }
    }
    codigo_verificacion();
    ?>
</body>
</html>