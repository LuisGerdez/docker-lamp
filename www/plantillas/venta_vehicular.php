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
            <style>
            * {
                font-size: 12px;
            }
            </style>
            <div class="datos-container-formulario">
                <div id="divcolor" class="x_panel col-md-8">
                    <div style="padding-top:10%;" class="col-md-12">
                        <div class="col-md-6" style="float:left;">
                            <img id="imggarantia" src="img/Logo.png" alt="" srcset="">
                        </div>
                        <div style="float:right;text-align:right;" class="col-md-6">
                            <small><b>AUTO 1 LLC</b></small>
                            <br>
                            <small><b>Marginal San Rafael, PR-2 km 229.2, Ponce By Pass Ponce 00716</b></small>
                            <br>
                            <small><b>P0 box 8458 Ponce00732</b></small>
                            <br>
                            <small><b>Tel: 787-843-1111</b></small>
                            <br>
                            <small><b>fax</b></small>
                        </div>
                    </div>

                    <div class="col-md-12  d-flex justify-content-start">

                        <div class="col-md-8 d-flex justify-content-start">

                            <div class="col-md-12 " style="padding:0;">
                                <div class="col-md-12 d-flex justify-content-start" style="padding:0;">
                                    <div class="col-md-6">
                                        <label for="">NOMBRE DEL COMPRADOR:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input style="border:none;border-bottom:1px solid black;width:100%;" type="text"
                                            name="vehi_nombre_comprador" id="">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <label for="">Dirección residencial:</label>
                                    <br>
                                    <input type="text" name="vehi_direccion_residencial" id=""
                                        style="border:none;border-bottom:1px solid black;width:100%;">
                                </div>
                                <div class="col-md-12">
                                    <label for="">Dirección Postal:</label>
                                    <br>
                                    <input style="border:none;border-bottom:1px solid black;width:100%;" type="text"
                                        name="vehi_postal" id="">
                                </div>
                            </div>


                        </div>
                        <div class="col-md-4 d-flex justify-content-start">
                            <table style="border-collapse:collapse;border:none;">
                                <tr>
                                    <td> <small><label for="">Fecha entrega:</label></small></td>
                                    <td> <small><input type="date"
                                                style="border:none;border-bottom:1px solid black;width:100%;"
                                                name="vehi_fecha" id=""></small></td>
                                </tr>
                                <tr>
                                    <td> <small><label for="">Seg. social:</label></small></td>
                                    <td><small><input type="text"
                                                style="border:none;border-bottom:1px solid black;width:100%;"
                                                name="vehi_social" id=""></small></td>
                                </tr>
                                <tr>
                                    <td> <small><label for="">Fecha de nacimiento:</label></small></td>
                                    <td><small><input type="date"
                                                style="border:none;border-bottom:1px solid black;width:100%;"
                                                name="vehi_nacimiento" id=""></small></td>
                                </tr>
                                <tr>
                                    <td> <small><label for="">Teléfono:</label></small></td>
                                    <td><small><input type="number"
                                                style="border:none;border-bottom:1px solid black;width:100%;"
                                                name="vehi_telefono" id=""></small></td>
                                </tr>

                                <tr>
                                    <td> <small><label for="">Celular:</label></small></td>
                                    <td><small><input type="number"
                                                style="border:none;border-bottom:1px solid black;width:100%;"
                                                name="vehi_celular" id=""></small></td>
                                </tr>
                                <tr>
                                    <td> <small><label for="">No. Licencia:</label></small></td>
                                    <td><small><input type="number"
                                                style="border:none;border-bottom:1px solid black;width:100%;"
                                                name="vehi_licencia" id=""></small></td>
                                </tr>
                                <tr>
                                    <td> <small><label for="">Correo electronico:</label></small></td>
                                    <td><small><input type="email"
                                                style="border:none;border-bottom:1px solid black;width:100%;"
                                                name="vehi_correo" id=""></small></td>
                                </tr>
                            </table>
                        </div>

                    </div>

                    <!-- cuadrados de la pagina -->
                    <div class="col-md-12 d-flex justify-content-start">
                        <div style="border:3px solid black;padding:0;" class="col-md-6">
                            <div class="col-md-12" style="padding:0;">
                                <!-- aqui comienza  -->
                                <div style="font-weight:bolder;border-bottom:1px solid black;background:black;color:white;"
                                    class="col-md-12 text-center">
                                    VEHICULO VENDIDO
                                </div>

                                <div class="col-md-12 d-flex justify-content-start "
                                    style="padding:0;border-bottom:3px solid black;">
                                    <div class="col-md-3"><br> <input type="checkbox" value="1" class="only-one"
                                            name="vehi_check" id=""><label><small>Nuevo</small></label>
                                    </div>
                                    <div class="col-md-3"> <br><input type="checkbox" class="only-one" value="2"
                                            name="vehi_check" id=""><label><small>Usado</small></label>
                                    </div>
                                    <div style="padding:0;" class="col-md-3"> <label for=""><small>Stock#: <input
                                                    style="width:100%;" type="number" name="vehi_stock"
                                                    id=""></small></label>
                                    </div>
                                    <div class="col-md-3"> <label for=""><small>Año:<input type="number" name="vehi_año"
                                                    style="width:90%;"></small></label>
                                    </div>
                                </div>

                                <div class="col-md-12 d-flex justify-content-start"
                                    style="padding:0;border-bottom:3px solid black;">
                                    <div class="col-md-6">
                                        <label for=""><small>Marca: <input style="width:100%;" type="text"
                                                    name="vehi_marca" id=""></small></label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""><small>Modelo: <input style="width:100%;" type="text"
                                                    name="vehi_modelo" id=""></small></label>
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex justify-content-start"
                                    style="padding:0;border-bottom:3px solid black;">
                                    <div class="col-md-4">
                                        <label for=""><small>VIN: <input style="width:100%;" type="text" name="vehi_vin"
                                                    id=""></small></label>
                                    </div>
                                    <div class="col-md-4">
                                        <label for=""><small>Color: <input style="width:100%;" type="text"
                                                    name="vehi_color" id=""></small></label>
                                    </div>
                                    <div class="col-md-4" style="">
                                        <label for=""><small>Millaje: <input style="width:100%;" type="number"
                                                    name="vehi_millaje" id=""></small></label>
                                    </div>
                                </div>

                                <div class="col-md-12 d-flex justify-content-start">
                                    <div class="col-md-4">
                                        <label for=""><small>Tablilla: <input type="text" style="width:100%;"
                                                    name="vehi_tablilla" id=""></small></label>
                                    </div>
                                    <div class="col-md-4">
                                        <label for=""><small>Marbete: <input type="text" style="width:100%;"
                                                    name="vehi_marbete" id=""></small></label>
                                    </div>
                                    <div class="col-md-4">
                                        <label for=""><small>Vence: <input type="number" style="width:100%;"
                                                    name="vehi_vence" id=""></small></label>
                                    </div>
                                </div>
                            </div>
                            <!-- parte 2 -->
                            <div class="col-md-12 " style="padding:0;">
                                <div style="border-bottom:1px solid black;font-weight:bolder;padding:0;background:black;"
                                    class="text-center col-md-12">

                                    <label style="color:white;">VEHICULO USADO TOMADO A CAMBIO</label>
                                </div>

                                <div class="col-md-12 d-flex justify-content-start"
                                    style="padding:0;border-bottom:3px solid black;">
                                    <div style="" class="col-md-4">
                                        <label for=""><small>Marca: <input type="text" style="width:100%;"
                                                    name="vehi_marca2" id=""></small></label>
                                    </div>
                                    <div class="col-md-4">
                                        <label for=""><small>Modelo: <input type="text" style="width:100%;"
                                                    name="vehi_modelo2" id=""></small></label>
                                    </div>
                                    <div class="col-md-4">
                                        <label for=""><small>Año: <input style="width:100%" type="text" name="vehi_año2"
                                                    id=""></small></label>
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex justify-content-start"
                                    style="padding:5px;border-bottom:3px solid black;">
                                    <div class="col-md-6" style="padding:0;">
                                        <label for=""><small>VIN: <input type="text" name="vehi_vin2"
                                                    id=""></small></label>
                                    </div>
                                    <div class="col-md-6" style="padding:0;">
                                        <label for=""><small>Tablilla: <input type="text" name="vehi_tablilla2"
                                                    id=""></small></label>

                                    </div>
                                </div>
                                <div class="col-md-12 d-flex justify-content-start"
                                    style="padding:5px;border-bottom:3px solid black;">
                                    <div class="col-md-6">
                                        <label for=""><small>Millaje: <input type="number" name="vehi_millaje2"
                                                    id=""></small></label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""><small>Color: <input type="text" name="vehi_color2"
                                                    id=""></small></label>

                                    </div>
                                </div>
                                <div class="col-md-12 d-flex justify-content-start" style="padding:5px;">

                                    <div class="col-md-6">
                                        <label for=""><small>Balance adeudado A:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="vehi_balance" id="">
                                    </div>
                                </div>
                                <p></p>
                                <div class="col-md-12" style="padding:0;">
                                    <div class="col-md-12" style="padding:0;border-top:3px solid black;">
                                        <div class="col-md-12 d-flex" style="padding:5px;">
                                            <div class="col-md-6">
                                                <label for=""><small>Marbete: <input type="text" name="vehi_marbete2"
                                                            id=""></small></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label for=""><small>Vence: <input type="text" name="vehi_vence2"
                                                            id=""></small></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for=""><small>Cliente entrego:</small></label>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-start">
                                            <div  style="padding:0;"class="col-md-4 d-flex justify-content-start">
                                                <label for=""><small>Licencia: <input value="1" class="only-one2"
                                                            type="checkbox" name="vehi_check2" id=""> </small> </label>
                                                <label for=""><small>Titulo: <input value="2" type="checkbox"
                                                            class="only-one2" name="vehi_check2" id=""> </small> </label>
                                            </div>
                                            <div  style="border:3px solid black;height:50px;margin-left:25%;width:200px;background:#d3cccc;">

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="checkbox" name="vehi_check2" class="only-one2" value="3" id="">
                                            <label for=""> <small>
                                                    Certificación
                                                    Multas Autoexpreso</small></label>
                                        </div>
                                    </div>

                                </div>
                                <p></p>
                                <div style="padding:0;" class="col-md-12 ">

                                    <div style="border-top:3px solid black;border-bottom:3px solid black;"
                                        class="col-md-12 d-flex justify-content-start">
                                        <div class="col-md-6" style="border-right:3px solid black;">
                                            <label><small>Credito por carro usado: </small></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" style="background:#d3cccc;border:none;"
                                                name="vehi_usado" id="">
                                        </div>
                                    </div>


                                    <div style="border-bottom:3px solid black;"
                                        class="col-md-12 d-flex justify-content-start">
                                        <div class="col-md-6" style="border-right:3px solid black;"> <label><small>
                                                    Balance Adeudado: </small></label></div>
                                        <div class="col-md-6"><input type="number"
                                                style="background:#d3cccc;border:none;" name="vehi_balance_Adeudado"
                                                id=""></div>

                                    </div>


                                    <div style="border-bottom:3px solid black;"
                                        class="col-md-12 d-flex justify-content-start">
                                        <div class="col-md-6" style="border-right:3px solid black;"> <label><small>
                                                    Crédito Neto: </small></label></div>
                                        <div class="col-md-6"><input type="number"
                                                style="background:#d3cccc;border:none;" name="vehi_credito_neto" id="">
                                        </div>

                                    </div>


                                    <div style="border-bottom:3px solid black;"
                                        class="col-md-12 d-flex justify-content-start">
                                        <div class="col-md-6" style="border-right:3px solid black;"><label><small>Pago
                                                    Contado:</small></label></div>
                                        <div class="col-md-6"> <input type="number"
                                                style="background:#d3cccc;border:none;" name="vehi_pago_contado" id="">
                                        </div>

                                    </div>
                                    <div style="border-bottom:3px solid black;"
                                        class="col-md-12 d-flex justify-content-start">
                                        <div class="col-md-6" style="border-right:3px solid black;"><label><small>
                                                    Credito A su favor:</small></label></div>
                                        <div class="col-md-6"> <input type="number"
                                                style="background:#d3cccc;border:none;" name="vehi_credito_asufavor"
                                                id=""></div>

                                    </div>

                                    <div style="border-bottom:3px solid black;"
                                        class="col-md-12 d-flex justify-content-start">
                                        <div class="col-md-6" style="border-right:3px solid black;"><label><small> Otros
                                                    Pagos:</small></label></div>
                                        <div class="col-md-6"> <input type="number"
                                                style="background:#d3cccc;border:none;" name="vehi_otros_pagos" id="">
                                        </div>

                                    </div>

                                    <div style="border-bottom:3px solid black;"
                                        class="col-md-12 d-flex justify-content-start">
                                        <div class="col-md-6" style="border-right:3px solid black;"> <label><small>
                                                    Crédito total: </small></label></div>
                                        <div class="col-md-6"><input type="number"
                                                style="background:#d3cccc;border:none;" name="vehi_credito_total2"
                                                id=""></div>

                                    </div>
                                    <div class="col-md-12 d-flex justify-content-start">

                                        <div class="col-md-6"><label><small>Pronto Recibido $: <input type="number"
                                                        style="background:#d3cccc;border:none;"
                                                        name="vehi_pronto_recibido" id=""></small></label></div>
                                        <div class="col-md-6"><label><small> Recibo#: <input type="number"
                                                        style="background:#d3cccc;border:none;" name="vehi_recibo"
                                                        id=""></small></label></div>
                                    </div>


                                </div>

                            </div>

                        </div>

                        <div style="border-top:3px solid black;border-right:3px solid black;border-bottom:3px solid black;padding:0;"
                            class="col-md-12">

                            <div class="col-md-12 d-flex justify-content-start"
                                style="padding:0;border-bottom:3px solid black;">
                                <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Precio
                                        Unidad</label>
                                </div>
                                <div class="col-md-6"> <input type="number" style="background:#d3cccc;border:none;"
                                        name="vehi_precio_unidad" id="">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-start"
                                style="padding:0;border-right:3px solid black;border-bottom:3px solid black;">
                                <div class="col-md-6" style="padding:0;">
                                    <label>Puertas: <input style="background:#d3cccc;border:none;width:50px;"
                                            name="vehi_puertas" id="" type="number"></label>
                                </div>
                                <div class="col-md-6" style="padding:0;">
                                    <label>Cilindros:<input style="background:#d3cccc;border:none;width:50px;"
                                            name="vehi_cilindros" id="" type="number"></label>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex justify-content-start"
                                style="border-right:3px solid black;padding:0;">
                                <div class="col-md-6" style="padding:0;">
                                    <label>Transmisión: <input type="text"
                                            style="background:#d3cccc;border:none;padding:0;width:30px;"
                                            name="vehi_transmision" id=""></label>
                                </div>
                                <div class="col-md-6" style="padding:0;">
                                    <label>Caballaje:<input type="number"
                                            style="background:#d3cccc;border:none;padding:0;width:46px;"
                                            name="vehi_Caballaje" id=""></label>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-start"
                                style="padding:0;border-bottom:3px solid black;border-top:3px solid black;">
                                <div class="col-md-6" style="padding:0;border-right:3px solid black;">
                                    <label>Total</label>
                                </div>
                                <div class="col-md-6"> <input type="number" style="background:#d3cccc;border:none;"
                                        name="vehi_total" id="">
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-start"
                                style="padding:0;border-bottom:3px solid black;">
                                <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Gap</label>
                                </div>
                                <div class="col-md-6"> <input type="number" style="background:#d3cccc;border:none;"
                                        name="vehi_gap" id="">
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-start"
                                style="padding:0;border-bottom:3px solid black;">
                                <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Seguro
                                        doble()</label>
                                </div>
                                <div class="col-md-6"> <input type="number" style="background:#d3cccc;border:none;"
                                        name="vehi_seguro_doble" id="">
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-start"
                                style="padding:0;border-bottom:3px solid black;">
                                <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Seguro de
                                        vida</label>
                                </div>
                                <div class="col-md-6"> <input type="number" style="background:#d3cccc;border:none;"
                                        name="vehi_seguro_vida" id="">
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-start"
                                style="padding:0;border-bottom:3px solid black;">
                                <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Contrato de
                                        servicio</label>
                                </div>
                                <div class="col-md-6"> <input type="number" style="background:#d3cccc;border:none;"
                                        name="vehi_contrato_servicio" id="">
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-start"
                                style="padding:0;border-bottom:3px solid black;">
                                <div class="col-md-6" style="padding:0;border-right:3px solid black;">
                                    <label>Tablillas</label>
                                </div>
                                <div class="col-md-6"> <input type="number" style="background:#d3cccc;border:none;"
                                        name="vehi_tablillas" id="">
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-start"
                                style="padding:0;border-bottom:3px solid black;">
                                <div class="col-md-6" style="padding:0;border-right:3px solid black;">
                                    <label>SeguroACAA</label>
                                </div>
                                <div class="col-md-6"> <input type="number" style="background:#d3cccc;border:none;"
                                        name="vehi_seguro_ACAA" id="">
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-start"
                                style="padding:0;border-bottom:3px solid black;">
                                <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Precio
                                        Total</label>
                                </div>
                                <div class="col-md-6"> <input type="number" style="background:#d3cccc;border:none;"
                                        name="vehi_precio_total" id="">
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-start" style="padding:0;">
                                <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Crédito
                                        Total</label>
                                </div>
                                <div class="col-md-6"> <input type="number" style="background:#d3cccc;border:none;"
                                        name="vehi_credito_total" id="">
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-start"
                                style="padding:0;border-top:3px solid black;">
                                <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Balance a
                                        pagar</label>
                                </div>
                                <div class="col-md-6"> <input type="number" style="background:#d3cccc;border:none;"
                                        name="vehi_balance_apagar" id="">
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:0; border-bottom:3px solid black;">
                                <div class="col-md-12 text-center"
                                    style="background:black;color:white;border-bottom:1px solid black;font-weight:bolder;padding:0;">
                                    BALANCE-CONTRATO A PAGARSE DE ACUERDO CON
                                </div>
                                <p style="padding-top:5px;margin:10px;">
                                    En <input type="number" name="vehi_numplazo1" id="" style="width:80px;"> plazos
                                    mensuales de
                                    $<input type="number" name="vehi_plazo1" id=""><br>con fecha de <input type="date"
                                        name="vehi_fecha1" id="">
                                    <br><br>En <input type="number" name="vehi_numplazo2" style="width:80px;" id="">
                                    plazos mensuales
                                    de $<input type="number" name="vehi_plazo2" id=""><br> con fecha de<input
                                        type="date" name="vehi_fecha2" id="">
                                <p style="padding-top:5px;margin:10px;">First Bank al %
                                    <input type="number" name="vehi_bancoporcentaje" id="">
                                </p>
                            </div>
                            <div class="col-md-12" style="padding:10px;">

                                <textarea placeholder="Observaciones:" style="  overflow-y: scroll;resize: none;"
                                    name="vehi_observaciones" id="" cols="45" rows="5"></textarea>
                            </div>
                            <div class="col-md-12" style="border-top:3px solid black;">
                                <h5 style="text-align:center;"><b><u>NO ACEPTAMOS DEVOLUCIONES</u></b></h5>
                                <p>
                                    <small>
                                        De devolver su unidad o cancelación de contrato de razon justificada. Auto 1
                                        LLC, le cobrara $95.00 diarios
                                        por el uso del vehiculo. En adición, se cobrara millaje y deprociacion segun
                                        establece la ley. Los "Documents Fees"
                                        o "Gastos de cierre" <b>NO</b> son reembolsables una vez firmado la factura y el
                                        contrato.
                                    </small>
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12" style="padding:0;">
                        <div class="col-md-12">


                            <p
                                style="border-left:3px solid black;border-right:3px solid black;border-bottom:3px solid black;padding:0;">
                                <small>
                                    <b>NOTA:</b> El comprador expresamente garantiza que el automóvil usado entregado a cuenta,
                                    si alguno, esta libre de todo gravámen o contrrato de venta consicional y qu ela
                                    licencia del mismo
                                    debidamente endosada sera entregada a la vendeddora con el vehículo. Se entiende que
                                    toda compra a plazos mediante contrato de venta condicional y/o hipoteca sobre
                                    bienes. En casede que el comprador exprese su opción por cierta financiadora
                                    particular para el financiamiento del balance de esta venta, sele conceden 10 días
                                    de esta fecha para trae a la vendedora el aporte
                                    de este balance y en caso de transcurrir decho termino sin que haya pagado dicho
                                    balance la vendedora quedara en libertad de utilizar cualquier entidad financiadora
                                    para cobrarse dicho balance. En tal caso se entenderá que tal actuación de la
                                    vendedora tiene autorización expresa del comprador.
                                    El comprador ha representado a la vendedora ser mayor de edad, todo vehículo usado
                                    se cende de acuerdo a la garantia estipualada por la ley. En caso de tratarse de la
                                    compra de un vehículo nuevo, la vendedora expresamente concede al
                                    comprador la garantía normal en carros nuevos que concedo la casa manucfacturora
                                    cuya garantía es de conocimiento del comprador. Aunque esta orden este firmada por
                                    un vendedor no obligara en forma alguna a la vendedora, hasta tanto haya sido
                                    aprobada y firmada por uno de los oficiales del la casa. Esta orden de compra y el
                                    contrato de venta condicional correspondiente y/o el contrato de hipoteca sobre
                                    iones muebles, si la venta es a plazos , cointieno por escrito todas las condiciones
                                    del negocio.
                                </small>
                            </p>
                            <div style="padding-top:5%;" class="col-md-12">

                            </div>
                            <div class="datos-formulario">
                                <input type="hidden" name="formulario_plantilla" value="true">
                                <input type="hidden" name="nombreArchivo" value="venta_vehicular.pdf">
                            </div>
                        </div>
                    </div>
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
    // inputs de arriba
    let Checked = null;
    for (let CheckBox of document.getElementsByClassName('only-one')) {
        CheckBox.onclick = function() {
            if (Checked != null) {
                Checked.checked = false;
                Checked = CheckBox;
            }
            Checked = CheckBox;
        }
    }

    // inputs de abajo
    let Checked2 = null;
    for (let CheckBox of document.getElementsByClassName('only-one2')) {
        CheckBox.onclick = function() {
            if (Checked2 != null) {
                Checked2.checked = false;
                Checked2 = CheckBox;
            }
            Checked2 = CheckBox;
        }
    }
    </script>
</footer>

</html>