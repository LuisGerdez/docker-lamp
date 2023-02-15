<?php
@session_start(['name'=>'SITI']);
require_once "../config/APP.php";

require_once '../session.php';

$codigo_usuario = $_SESSION['codigo_usuario'];

if (isset($_FILES['fichero']['name'])) {

    $nombre_archivo_firma = $_FILES['fichero']['name'];
    $extension_archivo = $_FILES['fichero']['type'];

    if ($nombre_archivo_firma) {
        $extension = explode("/", $extension_archivo);

        $dir_subida = "../bodega/precarga/$codigo_usuario/firmadigital/$nombre_archivo_firma";

        if (move_uploaded_file($_FILES['fichero']['tmp_name'], $dir_subida)) {

            include '../conexion.php';
        
            $query = "UPDATE usuario set usu_rutafidi = '$dir_subida' where usu_id = '$codigo_usuario'";
            $link->query($query);
        
            echo "<script>alert('La firma digital se subio correctamente')</script>";
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
    <body style="padding: 0; margin: 0; background-color: #F7F7F7">
        <?php include './header.php' ?>
        <?php include './cuerpo.php' ?>
    </body>
</html>


