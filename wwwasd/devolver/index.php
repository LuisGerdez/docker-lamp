<?php
@session_start(['name'=>'SITI']);
require_once "../config/APP.php";

if(isset($_POST['metodo'])){
    $metodo = $_POST['metodo'];
}

if($metodo == "devolver"){
    $codigo_documento = $_POST['codigo_documento'];
    $codigo_detalle_documento = $_POST['codigo_detalle_documento'];
    $observacion = $_POST['observacion'];
    
    include '../conexion.php';
    
    $sql = "update documento set doc_estado = 'Devuelto' where doc_id = '$codigo_documento'";
    $link->query($sql);
    
    $sql = "update detalledocumento set det_firma = 0 where det_docume = '$codigo_documento' and det_usuari is null";
    $link->query($sql);
    
    $sql = "update detalledocumento set det_observ = '$observacion' where det_docume = '$codigo_documento' and det_id = '$codigo_detalle_documento'";
    $link->query($sql);
    
    header('Refresh: 0.1; URL='.REDIRECCION_FIRMA);
    echo "<script>alert('El documento fue devuelto al remitente')</script>";
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


