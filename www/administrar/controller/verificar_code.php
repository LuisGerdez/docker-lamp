<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../codigo-verificacion/css/sweetalert2.css">
    <script src="../../codigo-verificacion/js/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <?php
    session_start(['name' => 'SITI']);
    require_once "../../config/APP.php";
    include '../../conexion.php';


    //ESTE ES EL CODIGO DE USUARIO QUE TIENE REGISTRADO EN LA BD(CADA USUARIO TIENE UN CODIGO DISTINTO)
    $codigo_usuario = $_SESSION['codigo_usuario'];

    //AQUI ENTRA EL CODIGO A LA TABLA CON ESTADO ACTIVO
    function Codigo_validacion()
    {
        include '../../conexion.php';
        //ESTE CODIGO ES EL MISMO QUE INGRESAMOS EN EL MODAL Y LO PASAMOS POR POST PARA VERIFICAR SI EL CODIGO ES CORRECTO O NO
        $verificar_codigo = $_POST['verificar_codigo'];
        $sql = "UPDATE detalledocumento 
                SET  estado_firma_destinatario_modal='no_pendiente2' 
                WHERE estado_firma_destinatario_modal = 'Pendiente2' 
                AND codigo_verificacion= $verificar_codigo ";
        $link->query($sql);

        /*$sql="SELECT codigo_verificacion,
        det_docume FROM detalledocumento 
        WHERE  codigo_verificacion='$verificar_codigo'";
        $result = $link->query($sql);
        $fila = $result->fetch_assoc();
        $det_docume = $fila['det_docume'];*/
           
        /*$sql = "UPDATE documento
        SET  doc_estado='no_pendiente' 
        WHERE doc_id='$det_docume' AND doc_estado='Pendiente'";  
        $link->query($sql);*/
    }
    //AQUI VALIDA EL CODIGO DE VERIFICACION
    function codigo_verificacion()
    {
        include "../../conexion.php";
        
        $verificar_codigo = $_POST['verificar_codigo'];

        $cod_otp = '';
   
        if ($verificar_codigo <> NULL or !empty($verificar_codigo)) {
            
            $sql = "SELECT codigo_verificacion,det_docume	
                    FROM detalledocumento  
                    WHERE estado_firma_destinatario_modal = 'Pendiente2' 
                    AND codigo_verificacion='$verificar_codigo' 
                    OR detalledocumento.codigo_verificacion='$verificar_codigo'";
            $result = $link->query($sql);
            $fila = $result->fetch_assoc();

            if(isset($fila['det_docume'])){
                $cod_otp = $fila['codigo_verificacion'];
            }
            if ($verificar_codigo == $cod_otp) {
                Codigo_validacion();
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
            } else {
                echo "<script>Swal.fire({
                                icon: 'warning',
                                html: 'El c&oacute;digo de verificaci&oacute;n es incorrecto',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Aceptar',
                                allowOutsideClick: false
                                     });</script>";
            }
        } else {
            echo "<script>Swal.fire({
                            icon: 'warning',
                            html: 'Por favor ingrese el c&oacute;digo de verificaci&oacute;n.',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                                 });</script>";
        }
    }
    codigo_verificacion();
    ?>
</body>

</html>