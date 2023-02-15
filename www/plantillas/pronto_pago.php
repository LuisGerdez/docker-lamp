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
                    <br>
                    <br>

                    <div id="contenedorrecibo">
                        <h4 class="text-center">RECIBO</h4>
                        <br>
                        <div class="d-flex justify-content-start">
                            <div class="col-md-6">
                                <p><b>Auto1</b><br>Marginal San Rafael, PR-2km 229.2,<br>Ponce PR 00716</p>
                            </div>
                            <div class="col-md-6" style="text-align:right;">
                                <p><small>Nùm. Control: <b><input
                                                style="border:none;border-bottom:1px solid black;background:#d3cccc;width:30%;"
                                                type="number" name="rec_control" id=""></b></small></p>
                                <p><small>Fecha: <b><input
                                                style="border:none;border-bottom:1px solid black;background:#d3cccc;width:30%;"
                                                type="date" name="rec_fecha" id=""></b></small></p>
                                <p><small>Stock#: <b><input
                                                style="border:none;border-bottom:1px solid black;background:#d3cccc;width:30%;"
                                                type="number" name="rec_stock" id=""></b></small></p>
                                <p><small>VIN: <b><input
                                                style="border:none;border-bottom:1px solid black;background:#d3cccc;width:30%;"
                                                type="text" name="rec_vin" id=""></b></small></p>
                                </p>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="">Recibido de: </label><input
                                style="border:none;border-bottom:1px solid black;background:#d3cccc;width:30%;"
                                type="text" name="rec_nombre" id=""><label for="">la cantidad de
                                $</label><input
                                style="border:none;border-bottom:1px solid black;background:#d3cccc;width:30%;"
                                type="number" name="rec_cantidad" id="">
                            <br>
                            <p>Para aplicar a la compra del <input
                                    style="border:none;border-bottom:1px solid black;background:#d3cccc;width:30%;"
                                    type="text" name="rec_vehiculo" id=""><br><br>
                                Concepto: <input
                                    style="border:none;border-bottom:1px solid black;background:#d3cccc;width:30%;"
                                    type="text" name="rec_concepto" id=""></p>

                            <div class="col-md-12 d-flex justify-content-start">
                                <div class="col-md-3">
                                    <label for=""><input type="checkbox"class="only-one" value="1"name="checks[]" id="">
                                        EFECTIVO</label>
                                </div>
                                <div class="col-md-4">
                                    <label for=""> <input type="checkbox"class="only-one" value="2"name="checks[]" id="">
                                        TRANSFERENCIA</label>
                                </div>
                                <div class="col-md-5">

                                    <label for=""><input id="chequebox" class="only-one" value="3"type="checkbox" name="checks[]" id="">
                                        CHEQUE</label>
                                    <br>
                                    <div id="numerocheque" style="padding-bottom: 10%;" class="col-md-12">
                                        <label for="">NUM.CHEQUE: </label><input
                                            style="border:none;border-bottom:1px solid black;background:#d3cccc;width:100%;"
                                            type="number" name="rec_num" id="">
                                    </div>

                                </div>
                            </div>

                        </div>



                    </div>
                    <div style="padding-top:10%;" class="col-md-12"></div>
                    <div class="datos-formulario">
                        <input type="hidden" name="formulario_plantilla" value="true">
                        <input type="hidden" name="nombreArchivo" value="pronto_pago.pdf">
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

    <script>
    /// para solo deje un input
    let Checked = null;

    for (let CheckBox of document.getElementsByClassName('only-one')){
        CheckBox.onclick = function(){
        if(Checked!=null){
        Checked.checked = false;
        Checked = CheckBox;
        }
        Checked = CheckBox;
    }
    }
    </script>

</footer>

</html>