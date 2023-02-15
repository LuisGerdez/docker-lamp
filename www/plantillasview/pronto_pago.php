<div class="whiteblock">
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
                                              readonly  style="border:none;border-bottom:1px solid black;background:white;width:30%;"
                                               value="<?= $rec_control?>" type="text" name="rec_control" id=""></b></small></p>
                                <p><small>Fecha: <b><input
                                readonly   style="border:none;border-bottom:1px solid black;background:white;width:30%;"
                                                value="<?= $rec_fecha?>"   type="text" name="rec_fecha" id=""></b></small></p>
                                <p><small>Stock#: <b><input
                                readonly  style="border:none;border-bottom:1px solid black;background:white;width:30%;"
                                                value="<?= $rec_stock?>"  type="text" name="rec_stock" id=""></b></small></p>
                                <p><small>VIN: <b><input
                                readonly     style="border:none;border-bottom:1px solid black;background:white;width:30%;"
                                                value="<?= $rec_vin?>" type="text" name="rec_vin" id=""></b></small></p>
                                </p>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="">Recibido de: </label><input
                                style="border:none;border-bottom:1px solid black;background:white;width:30%;"
                                type="text" name="rec_nombre"  value="<?= $rec_de?>" readonly id=""><label for="">la cantidad de
                                $</label><input
                                style="border:none;border-bottom:1px solid  black;background:white;width:30%;"
                                type="text" name="rec_cantidad" readonly value="<?= $rec_cantidad?>" id="">
                            <br>
                            <p>Para aplicar a la compra del <input
                                    style="border:none;border-bottom:1px solid black;background:white;width:30%;"
                                    type="text" name="rec_vehiculo" id="" readonly value="<?= $rec_vehiculo?>"><br><br>
                                Concepto: <input
                                    style="border:none;border-bottom:1px solid black;background:white;width:30%;"
                                    type="text" name="rec_concepto"readonly value="<?= $rec_concepto?>" id=""></p>

                            <div class="col-md-12 d-flex justify-content-start">
                                <div class="col-md-3">
                                    <label for="">
                                        <input type="checkbox" value="1" class="only-one" name="tipo_pago_check" id="">
                                        EFECTIVO</label>
                                </div>
                                <div class="col-md-4">
                                    <label for="">
                                    <input type="checkbox" value="2" class="only-one" name="tipo_pago_check" id="">
                                        TRANSFERENCIA</label>
                                </div>
                                <div class="col-md-5">

                                    <label for="">
                                        <input type="checkbox" value="3" class="only-one" name="tipo_pago_check" id="">
                                        CHEQUE</label>
                                    <br>
                                    <div id="numerocheque" style="padding-bottom: 10%;" class="col-md-12">
                                        <label for="">NUM.CHEQUE: </label><input
                                            style="border:none;border-bottom:1px solid black;background:white;width:100%;"
                                            type="text" readonly value="<?= $rec_num?>" readonly name="rec_num" id="">
                                    </div>

                                </div>
                            </div>

                        </div>

                                            <!-- aqui mandare el input para el array -->
                                        <input type="hidden" name="templates[]" value="6">
                                        <input type="hidden" id="tipo_pago" value="<?php echo $tipo_pago ?>">

                    </div>
                    <div style="padding-top:10%;" class="col-md-12"></div>
                </div>
            </div>

    </div>

<script>
    let tipo_pago = document.querySelector('#tipo_pago').value;

    if(tipo_pago == '1') {
        document.querySelector("input[name=tipo_pago_check][value='1']").checked = true;
        document.querySelector("input[name=tipo_pago_check][value='2']").checked = false;
        document.querySelector("input[name=tipo_pago_check][value='3']").checked = false;
    } else if(tipo_cliente_entrego == '2') {
        document.querySelector("input[name=tipo_pago_check][value='1']").checked = false;
        document.querySelector("input[name=tipo_pago_check][value='2']").checked = true;
        document.querySelector("input[name=tipo_pago_check][value='3']").checked = false;
    } else if(tipo_cliente_entrego == '3') {
        document.querySelector("input[name=tipo_pago_check][value='1']").checked = false;
        document.querySelector("input[name=tipo_pago_check][value='2']").checked = false;
        document.querySelector("input[name=tipo_pago_check][value='3']").checked = true;
    }
</script>


