<?php
require_once "../config/APP.php";

if (isset($_GET['codigo_documento'])) {
    $codigo_documento = $_GET['codigo_documento'];
}

    include '../conexion.php';

    $sql_date = "SELECT doc_estado from documento where doc_id = '$codigo_documento'";

    $resultado = mysqli_query($link,$sql_date);

    while($fila = mysqli_fetch_assoc($resultado)) {
        $estado = $fila["doc_estado"];
    }

    mysqli_close($link);

    if($estado == "Pendiente"){
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
<?php
    }else{
        echo "<script>alert('El documento ya se encuentra firmado')</script>";
        //  header('Refresh: 0.01; URL=../validacion/validar.php');
    }
?>

