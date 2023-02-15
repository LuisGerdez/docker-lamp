<?php
require_once "../config/APP.php";
require_once '../Models/Certificado.php';
require_once '../Models/Mail.php';
use Models\Mail;
use Models\Certificado;
$datos_credenciales = getallheaders();
$cedula_usuario = isset($datos_credenciales['Cedula-Firma']) ? $datos_credenciales['Cedula-Firma'] : 0;
$correo_usuario = isset($datos_credenciales['Correo-Firma-LDAP']) ? $datos_credenciales['Correo-Firma-LDAP'] : 0;

function certificadoEnroll(){
    include "../conexion.php";
    $sql = "select * from usuario where usu_id ='" . $_SESSION['codigo_usuario'] . "'";
        $result = $link->query($sql);
        foreach ($result as $key) {
            if ($key['usu_codigo_vivo'] != 1) {
                include 'plantilla.php';
                $mail = new Mail();
                $certificado = new Certificado();
                $certificado->setClient($_SESSION['codigo_usuario'],2);      
                $mail->enviarCorreo($plantillaCertificado, $_SESSION['correo_usuario'], 'Firmadoc-corp', __DIR__ . '/../perfil/certificado/certificadoEnroll-'.$_SESSION['cedula_usuario'].'.pdf');
                $sql = "UPDATE usuario
                      SET  usu_codigo_vivo = 1
                      WHERE usu_id ='" . $_SESSION['codigo_usuario'] . "'";
                $link->query($sql);
              }
        }
}

if ($cedula_usuario) {
    include "../conexion.php";
    $datos_usuario = mysqli_query($link, "SELECT DISTINCT usuario.usu_id,usuario.rol_usuario,usuario.usu_docume,usuario.usu_passwo,
    usuario.usu_email,usuario.usu_nombre,usuario.usu_apelli,usuario.usu_tipo_documento,
    usuario.usu_celula,MAX(ado_records.TransactionId),MAX(ado_records.CreationDate)  
    FROM ado_records 
    INNER JOIN usuario 
    ON ado_records.IdNumber=usuario.usu_docume 
    WHERE ado_records.TransactionType=2 
    AND usuario.usu_docume = '$cedula_usuario'
    ORDER BY ado_records.TransactionId DESC");
    if (mysqli_num_rows($datos_usuario)) {
        $row = mysqli_fetch_array($datos_usuario, MYSQLI_ASSOC);
        // printf ("%s %s %s %s %s  \n", $row["usu_id"], $row["usu_docume"], $row["usu_nombre"], $row["usu_apelli"], $row["usu_email"]);
        $id_usuario = $row["usu_id"];
        $cedula_usuario = $row["usu_docume"];
        $correo_usuario = $row["usu_email"];
        $nombre_usuario = $row["usu_nombre"];
        $apellido_usuario = $row["usu_apelli"];
        $tipo_documento = $row['usu_tipo_documento'];
        $celular = $row['usu_celula'];
        $rol = $row['rol_usuario'];
        $id_transaction=$row['MAX(ado_records.TransactionId)'];

        @session_start(['name' => 'SITI']);
        $_SESSION['codigo_usuario'] = $id_usuario;
        $_SESSION['cedula_usuario'] = $cedula_usuario;
        $_SESSION['correo_usuario'] = $correo_usuario;
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        $_SESSION['apellido_usuario'] = $apellido_usuario;
        $_SESSION['tipo_documento'] = $tipo_documento;
        $_SESSION['celular'] = $celular;
        $_SESSION['rol'] = (int)$rol;
        $_SESSION['TransactionId'] =  $id_transaction;
        
        certificadoEnroll();
        //Creación de directorios para el usuario.
        $directorioimgfirmatmp = "../bodega/precarga/" .  $_SESSION['codigo_usuario'] . "/imgfirmatmp";
        $directorioimgfirmafija = "../bodega/precarga/" .  $_SESSION['codigo_usuario'] . "/imgfirmafija";
        $directoriofirmadigital = "../bodega/precarga/" .  $_SESSION['codigo_usuario'] . "/firmadigital";
        $directoriofirmado = "../bodega/firmado/" .  $_SESSION['codigo_usuario'];
        $directorioeliminado = "../bodega/eliminado/" .  $_SESSION['codigo_usuario'];


        if((is_dir($directorioimgfirmatmp) && is_dir($directorioimgfirmafija) && is_dir($directoriofirmadigital) && is_dir($directoriofirmado) && is_dir($directorioeliminado)) != true){
        mkdir($directorioimgfirmatmp, 0777, true);
        mkdir($directorioimgfirmafija, 0777, true);
        mkdir($directoriofirmadigital, 0777, true);
        mkdir($directoriofirmado, 0777, true);
        mkdir($directorioeliminado, 0777, true);
        }

        header('Location: ../dashboard');
    } else {
        echo'<script>alert("El usuario con cedula:' .$correo_usuario. ' no se encuentra registrado");</script>';
    }
} else if ($correo_usuario) {
    include "../conexion.php";
    $datos_usuario = mysqli_query($link, "SELECT * from usuario WHERE usu_email = '$correo_usuario'");
    if (mysqli_num_rows($datos_usuario)) {
        $row = mysqli_fetch_array($datos_usuario, MYSQLI_ASSOC);
        // printf ("%s %s %s %s %s  \n", $row["usu_id"], $row["usu_docume"], $row["usu_nombre"], $row["usu_apelli"], $row["usu_email"]);
        $id_usuario = $row["usu_id"];
        $cedula_usuario = $row["usu_docume"];
        $correo_usuario = $row["usu_email"];
        $nombre_usuario = $row["usu_nombre"];
        $apellido_usuario = $row["usu_apelli"];
        $tipo_documento = $row['usu_tipo_documento'];
        $celular = $row['usu_celula'];
        $rol = $row['rol_usuario'];

        @session_start(['name' => 'SITI']);
        $_SESSION['codigo_usuario'] = $id_usuario;
        $_SESSION['cedula_usuario'] = $cedula_usuario;
        $_SESSION['correo_usuario'] = $correo_usuario;
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        $_SESSION['apellido_usuario'] = $apellido_usuario;
        $_SESSION['tipo_documento'] = $tipo_documento;
        $_SESSION['celular'] = $celular;
        $_SESSION['rol'] = (int)$rol;
        //Creación de directorios para el usuario.
        $directorioimgfirmatmp = "../bodega/precarga/" .  $_SESSION['codigo_usuario'] . "/imgfirmatmp";
        $directorioimgfirmafija = "../bodega/precarga/" .  $_SESSION['codigo_usuario'] . "/imgfirmafija";
        $directoriofirmadigital = "../bodega/precarga/" .  $_SESSION['codigo_usuario'] . "/firmadigital";
        $directoriofirmado = "../bodega/firmado/" .  $_SESSION['codigo_usuario'];
        $directorioeliminado = "../bodega/eliminado/" .  $_SESSION['codigo_usuario'];


        if((is_dir($directorioimgfirmatmp) && is_dir($directorioimgfirmafija) && is_dir($directoriofirmadigital) && is_dir($directoriofirmado) && is_dir($directorioeliminado)) != true){
        mkdir($directorioimgfirmatmp, 0777, true);
        mkdir($directorioimgfirmafija, 0777, true);
        mkdir($directoriofirmadigital, 0777, true);
        mkdir($directoriofirmado, 0777, true);
        mkdir($directorioeliminado, 0777, true);
        }

        certificadoEnroll();
        header('Location: ../dashboard');
    } else {
        echo'<script>alert("El usuario con correo:' .$correo_usuario. ' no se encuentra registrado");</script>';
    }
} else {
    echo '<script>alert("ERROR, NO SE ESTAN ENVIANDO DATOS DE USUARIO");</script>';
}

?>
