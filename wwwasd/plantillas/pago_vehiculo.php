<?php
@session_start(['name'=>'SITI']);
include_once '../config/APP.php';
$codigo_usuario = $_SESSION['codigo_usuario'];
?>

<script>
function enviarFormulario() {
    document.formulario.submit();
}

function cargarDocumento() {
    document.formulario.submit();
}
</script>

<html lang="es">

<head>
    <title><?php echo COMPANY ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo FAVICON ?>">
    <link rel=stylesheet HREF="./css/style_plantillas.css" type="text/css" media=screen>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"
        integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<script type="text/javascript">
function volverAtras() {
    history.go(-1)
}
</script>

<body style="padding: 0; margin: 0; background: #fff; color:black;">
    <div class="whiteblock">
        <form action="../documentos/index.php" method="post" enctype="multipart/form-data" target="" name="formulario"
            id="formulario">
            <?php include '../menu.php' ?>
            <div class="datos-container-formulario">
                <div id="divcolor" class="x_panel col-md-8">

                    <div style="padding-top:10%;" class="col-md-12 text-center">
                        <img id="imgpago" src="img/Logo.png" alt="" srcset="">
                    </div>

                    <div class="col-md-12 text-center">
                        <small><b>Auto1pr.com</b></small>
                        <br>
                        <small><b>Po Box 8458 Ponce PR 00732</b></small>
                        <br>
                        <small><b>Tel. 787-843-1111</b></small>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-12">
                        <input style="border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;"
                            type="text" name="pagofecha1">
                        <label for=""> de</label>
                        <input style="border:none;border-bottom:1px solid black;width:20%;background:#d3cccc;"
                            type="text" name="pagofecha2">
                        <label for=""> de</label>
                        <input style="border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;"
                            type="text" name="pagofecha3">
                        <br>
                        <label style="padding-right:5px;"><b>Liquidación de Trade In Reclamo de Prima No
                                devengada</b></label>
                        <br>
                        <label style="padding-right:5px;">A quien puede interesar:</label>
                        <br>
                        <label style="padding-right:5px;">Por este medio yo,<input
                                style="border:none;border-bottom:1px solid black;width:40%;background:#d3cccc;"
                                type="text" name="pagoname">
                            autorizo <b>Auto1pr.com</b> a realizar gestiones de liquidar el financiamiento y/o balance
                            de cancelación del vehículo que se describe a continuación:</label>
                        <br>
                        <label style="padding-right:5px;">Modelo:<input
                                style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;"
                                type="text" name="pagomodelo">Año:<input
                                style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;"
                                type="text" name="pagoaño"></label>
                        <br>
                        <br>
                        <label style="padding-right:5px;">El mismo está a mi nombre, con el número de cuenta
                            #</label><input
                            style="border:none;border-bottom:1px solid black;width:40%;background:#d3cccc;" type="text"
                            name="pagocuenta">
                        <br>
                        <label style="padding-right:5px;">Y con la insitución financiera<input
                                style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;"
                                type="text" name="pagofinancia">. Entiendo también que al saldar la cuenta y cancelar
                            la
                            póliza de seguro y/o contrato de servicio, el importe de la prima no
                            devengada le corresponderá <b>Auto1pr.com</b> como responsable de la liquidación de la
                            misma.</label>
                        <div style="padding-bottom:300px;">
                            <br>
                            <br>
                            <label style="padding-right:5px;">Compañía de seguro:</label><input
                                style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;"
                                type="text" name="pagoseguro">
                            <label>Póliza:</label>
                            <input style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;"
                                type="text" name="pagopoliza">
                            <br>
                            <br>
                            <label style="padding-right:5px;">Contrato de servicio:</label><input
                                style="border:none;border-bottom:1px solid black;width:35%;background:#d3cccc;"
                                type="text" name="pagocontrato">Póliza:</label><input
                                style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;"
                                type="text" name="pagopolizacontrato">
                            <br>
                            <br>
                            <label style="padding-right:5px;">Gap:</label><input
                                style="border:none;border-bottom:1px solid black;width:40%;background:#d3cccc;"
                                type="text" name="pagogap">
                            <label>Póliza:</label><input
                                style="border:none;border-bottom:1px solid black;width:40%;background:#d3cccc;"
                                type="text" name="pagopolizagap">

                        </div>
                    </div>
                    <div class="datos-formulario">
                        <input type="hidden" name="formulario_plantilla" value="true">
                        <input type="hidden" name="nombreArchivo" value="pagovehiculo.pdf">
                    </div>
                </div>

                <div class="cuerpo-botones">
                    <button type="button" title="volver" onclick="volverAtras();"><i
                            class="fas fa-arrow-left"></i>Volver</button>
                    <button title="siguiente" type="submit" name="siguiente">Siguiente<i
                            class="fas fa-arrow-right"></i></button>
                </div>

            </div>
        </form>
    </div>
</body>
<footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</footer>

</html>