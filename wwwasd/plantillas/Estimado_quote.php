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

                    <br>
                    <div class="col-md-12 text-center">
                        <img id="imgquote" src="img/Logo.png" alt="" srcset="">
                    </div>
                    <br>
                    <div class="col-md-12">
                        <p>Estimado/a:<input style="border:none;background:#d3cccc;" type="text" name="namequote"
                                id="namequote"><br>
                            A continuación le brindamos los números para su análisis </p><br>
                    </div>

                    <div class="col-md-6">
                        <p><b style="float:left;">Fecha:</b></p><input
                            style="border:none;background:#d3cccc;float:left;" type="datetime-local" name="fechaquote"
                            id="fechaquote">
                    </div>
                    <br>
                    <div class="col-md-6">
                        <p><b style="float:left;">Vendedor:</b></p>
                        <input style="border:none;background:#d3cccc;float:left;" type="text" name="vendedorquote"
                            id="vendedorquote">
                    </div>
                    <br>
                    <br>
                    <br>

                    <p><small><b>Precio de Venta:</b></small></p>
                    <label for="">$<input style="border:none;background:#d3cccc;" type="number" name="precioquote"
                            id="precioquote"></label>
                    <br>
                    <br>
                    <b>Gastos de traspaso: </b><label>$<input style="border:none;background:#d3cccc;" name="gastosquote"
                            id="gastosquote" type="number"></label>
                    <br>
                    <b>Total: </b><label>$<input style="border:none;background:#d3cccc;" name="totalquote"
                            type="number"></label>
                    <br>
                    <br>
                    <label for=""><small>
                            <b>Forma de pago:</b></small></label>
                    <br>
                    <b>Pronto: </b><input style="border:none;background:#d3cccc;" name="prontoquote" type="number">
                    <br>
                    <br>
                    <b>Balance a financiar: </b><label>$<input style="border:none;background:#d3cccc;"
                            name="balancequote" id="balancequote" type="number"></label>
                    <br>
                    <br>
                    <b>Trade in: </b><label>$<input style="border:none;background:#d3cccc;" name="tradequote"
                            type="number"></label>
                    <br>
                    <br>
                    <br>
                    <small><b>Balance a financiar: </b></small><label></label>
                    <br>
                    <br>
                    <b>Entidad financiera: </b><label><input style="border:none;background:#d3cccc;" name="entidadquote"
                            id="entidadquote" type="text"></label>
                    <br>
                    <b>Termino: </b><label><input style="border:none;background:#d3cccc;" name="terminoquote"
                            type="text"></label>
                    <br>
                    <b>Pago mensual: </b><label>$<input style="border:none;background:#d3cccc;" name="pagoquote"
                            type="number"></label>
                    <br>
                    <br>
                    <br>
                    <small><b>Auto a cambio: </b></small><label></label>
                    <br>
                    <br>
                    <b>Marca: </b><label><input style="border:none;background:#d3cccc;" name="marcaquote"
                            type="text"></label>
                    <br>
                    <b>Modelo: </b><label><input style="border:none;background:#d3cccc;" name="modeloquote"
                            type="text"></label>
                    <br>
                    <b>Versión: </b><label><input style="border:none;background:#d3cccc;" name="versionquote"
                            type="text"></label>
                    <br>
                    <b>Año: </b><label><input style="border:none;background:#d3cccc;" name="añoquote"
                            type="text"></label>
                    <br>
                    <b>Millaje: </b><label><input style="border:none;background:#d3cccc;" name="millajequote"
                            type="text"></label>
                    <br>
                    <b>Tablilla: </b><label><input style="border:none;background:#d3cccc;" name="tablillaquote"
                            type="text"></label>

                </div>
                <div class="datos-formulario">
                    <input type="hidden" name="formulario_plantilla" value="true">
                    <input type="hidden" name="nombreArchivo" value="estimadoquote.pdf">
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