<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
ob_start();
@session_start(['name' => 'SITI']);
require_once '../config/APP.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title><?= COMPANY ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="<?= 'FAVICON' ?>">
    <LINK REL=StyleSheet HREF="./estilo_principal.css" TYPE="text/css" MEDIA=screen>
    <!-- DATATABLES -->
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./css/estilo_tablas.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" type="text/css">
</head>

<body >
    <?php include '../menu.php' ?>
    <?php include 'vista_documento.php' ?>

    <!-- JS/Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
    <script src="./js/datatable.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>