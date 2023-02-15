<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
ob_start();
@session_start(['name'=>'SITI']);
require_once "../config/APP.php";
require_once '../session.php';

?>
<html lang="es">
    <head>
        <title><?php echo COMPANY ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo FAVICON ?>">
        <LINK REL=StyleSheet HREF="../estilo_principal.css" TYPE="text/css" MEDIA=screen>
    </head>
    <body style="padding: 0; margin: 0; background: #555555;">
        <?php include '../menu.php' ?>
        <?php include './cuerpo.php' ?>
    </body>
</html>
<?php ob_end_flush();?>

