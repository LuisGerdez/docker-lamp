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
        <form action="../documentosview/index.php" method="post" enctype="multipart/form-data" target="" name="formulario"
            id="formulario">
            <?php include '../menu.php' ?>
            <br>
            <div class="datos-container-formulario">
                <div id="divcolor" class="x_panel col-md-8">
                    <div style="padding-top:10%;"class="col-md-12 text-center">
                    <img id="imgmulta"src="img/Logo.png" alt="" srcset="">
                    </div>
                    <br>
                    <br>
                    <div class="col-md-12 text-center">
                        <h5><u><b>COMPROMISO DE PAGO DE MULTAS AUTO TOMADO EN TRADE IN</b></u></h5>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-12">
                        <label style="padding-right:5px;">Yo,</label><input
                            style="border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;" type="text" name="mul_name"
                            id="mul_name"><label for="">, dueño del vehiculo.</label>
                        <br>
                        <label style="padding-right:5px;">Marca:</label><input
                            style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;" type="text" name="mul_marca"
                            id="mul_marca">
                        <br>
                        <label style="padding-right:5px;">Modelo:</label><input
                            style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;" type="text" name="mul_modelo"
                            id="mul_modelo">
                        <br>
                        <label style="padding-right:5px;">Año:</label><input
                            style="border:none;border-bottom:1px solid black;width:20%;background:#d3cccc;" type="text" name="mul_año"
                            id="mul_año">
                        <br>
                        <label style="padding-right:5px;">Tablilla:</label><input
                            style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;" type="text" name="mul_tablilla"
                            id="mul_tablilla">
                        <br>
                        <label style="padding-right:5px;">Núm. de serie:</label><input
                            style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;" type="text" name="mul_serie"
                            id="mul_serie">
                        <br>
                        <br>
                        <label style="padding-right:5px;">Dejado en trade-in el día:<input
                            style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;" type="text" name="mul_trade"
                            id="mul_trade">, soy responsable de toda la multa que aparezca en el auto antes de la entre del mismo al Dealer como trade-in.</label>
                            <div style="padding-bottom:300px;">

                            </div>
                    </div>
                    
                </div>


            </div>
            <div class="datos-formulario">
                        <input type="hidden" name="formulario_plantilla" value="true">
                        <input type="hidden" name="nombreArchivo" value="multasview.pdf">                       
            </div>
            <div class="cuerpo-botones">
                    <button type="button" title="volver" onclick="volverAtras();"><i
                            class="fas fa-arrow-left"></i>Volver</button>
                    <button title="siguiente" type="submit" name="siguiente">Siguiente<i
                            class="fas fa-arrow-right"></i></button>
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