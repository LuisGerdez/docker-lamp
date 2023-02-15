<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
ob_start();
@session_start(['name'=>'SITI']);

require_once "../config/APP.php";
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title><?php echo COMPANY ?></title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo 'FAVICON' ?>">
        <!-- DATATABLES -->
        <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="./css/estilo_tablas.css">

    </head>
    <body >
        <?php include '../menu.php' ?>
        <?php include 'bandeja.php' ?>

        <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
        <script src="./js/datatable.js"></script>
    </body>
</html>
<?php ob_end_flush();?>

