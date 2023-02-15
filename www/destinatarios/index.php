<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
@session_start(['name'=>'SITI']);
require_once "../config/APP.php";

require_once '../session.php';
?>
<html lang="es">
    <head>
        <title><?php echo COMPANY ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo FAVICON ?>">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
        <LINK REL=StyleSheet HREF="../estilo_principal.css" TYPE="text/css" MEDIA=screen>
    </head>
    <body style="padding: 0; margin: 0; background-color: #555555">
        <?php include './header.php' ?>
        <?php include './cuerpo.php' ?>
    </body>
</html>