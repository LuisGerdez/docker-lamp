<?php


@session_start(['name' => 'SITI']);
require_once "../config/APP.php";
require_once '../session.php';
require '../Models/Bucket.php';

use Models\Bucket;

$codigo_usuario = $_SESSION['codigo_usuario'];

if (isset($_FILES['fichero']['name'])) {

    $nombre_archivo_firma = $_FILES['fichero']['name'];
    $extension_archivo = $_FILES['fichero']['type'];
    if ($nombre_archivo_firma) {
        $extension = explode("/", $extension_archivo);

        $dir_subida = "../bodega/precarga/$codigo_usuario/imgfirmafija/firma_$codigo_usuario.$extension[1]";

        $campo_ruta = "/bodega/precarga/$codigo_usuario/imgfirmafija/firma_$codigo_usuario.$extension[1]";

        if (move_uploaded_file($_FILES['fichero']['tmp_name'], $dir_subida)) {
            $ruta_destino = $dir_subida;
            if ($extension_archivo == "image/jpeg") {
                $ruta_original =  $dir_subida;
                $ruta_destino = '../bodega/precarga/' . $_SESSION['codigo_usuario'] . '/imgfirmafija/firma_' . $_SESSION['codigo_usuario'] . '.png';
                $imagen_original = imagecreatefromjpeg($ruta_original);
                imagepng($imagen_original, $ruta_destino);
                imagedestroy($imagen_original);
            }
            // var_dump(str_replace("{$_SESSION['codigo_usuario']}","{$_SESSION['cedula_usuario']}",explode("/", $ruta_destino)[5]));
            // die;
            $S3 = new Bucket();
            $result = $S3->s3UploadObject($ruta_destino, str_replace("{$_SESSION['codigo_usuario']}","{$_SESSION['cedula_usuario']}",explode("/", $ruta_destino)[5]), "suntic/images/{$_SESSION['cedula_usuario']}/");


            include '../conexion.php';

            $firma = "firma_" . $_SESSION['cedula_usuario'] . ".png";
            $query = "update usuario set usu_rutafi = '$firma' where usu_id = '$codigo_usuario'";
            $link->query($query);

            $ok = "ok";
            echo "<script>alert('Imagen actualizada correctamente');</script>";
        } else {
            echo "No se subio la imagen";
        }
    }
}
?>
<html lang="es">

<head>
    <title><?php echo COMPANY ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo FAVICON ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <LINK REL=StyleSheet HREF="../estilo_principal.css" TYPE="text/css" MEDIA=screen>
</head>

<body style="padding: 0; margin: 0; background-color: #555555;">
    <?php include './header.php' ?>
    <?php include './cuerpo.php' ?>
</body>

</html>