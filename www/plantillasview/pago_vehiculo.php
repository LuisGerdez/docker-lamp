<div class="whiteblock">
    <div class="datos-container-formulario">
        <div id="divcolor" class="x_panel col-md-8">

            <div style="padding-top:10%;" class="col-md-12 text-center">
                <img id="imgpago" src="../plantillasview/img/Logo.png" alt="" srcset="">
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
                <input readonly style="border:none;border-bottom:1px solid black;width:10%;background:white;" value="<?php echo  $pagofecha1?>"type="text"
                    name="pagofecha1">
                <label for=""> de</label>
                <input readonly style="border:none;border-bottom:1px solid black;width:20%;background:white;"  value="<?php echo  $pagofecha2?>"type="text"
                    name="pagofecha2">
                <label for=""> de</label>
                <input readonly style="border:none;border-bottom:1px solid black;width:10%;background:white;"  value="<?php echo  $pagofecha3?>"type="text"
                    name="pagofecha3">
                <br>
                <label style="padding-right:5px;"><b>Liquidación de Trade In Reclamo de Prima No
                        devengada</b></label>
                <br>
                <label style="padding-right:5px;">A quien puede interesar:</label>
                <br>
                <label style="padding-right:5px;">Por este medio yo,<input
                        style="border:none;border-bottom:1px solid black;width:40%;background:white;" readonly value="<?= $pagoname ?>"type="text"
                        name="pagoname">
                    autorizo <b>Auto1pr.com</b> a realizar gestiones de liquidar el financiamiento y/o balance
                    de cancelación del vehículo que se describe a continuación:</label>
                <br>
                <label style="padding-right:5px;">Modelo:<input
                        style="border:none;border-bottom:1px solid black;width:30%;background:white;"readonly value="<?= $pagomodelo ?>" type="text"
                        name="pagomodelo">Año:<input
                        style="border:none;border-bottom:1px solid black;width:30%;background:white;"readonly value="<?= $pagoaño ?>" type="text"
                        name="pagoaño"></label>
                <br>
                <br>
                <label style="padding-right:5px;">El mismo está a mi nombre, con el número de cuenta
                    #</label><input style="border:none;border-bottom:1px solid black;width:40%;background:white;"
                    type="text" name="pagocuenta" readonly value="<?= $pagocuenta?>">
                <br>
                <label style="padding-right:5px;">Y con la institución financiera<input
                        style="border:none;border-bottom:1px solid black;width:30%;background:white;" type="text"
                        name="pagofinancia"readonly value="<?= $pagofinancia?>">. Entiendo también que al saldar la cuenta y cancelar
                    la
                    póliza de seguro y/o contrato de servicio, el importe de la prima no
                    devengada le corresponderá <b>Auto1pr.com</b> como responsable de la liquidación de la
                    misma.</label>
                <div style="padding-bottom:300px;">
                    <br>
                    <br>
                    <label style="padding-right:5px;">Compañía de seguro:</label><input
                        style="border:none;border-bottom:1px solid black;width:30%;background:white;" readonly value="<?= $compania_seguro?>" type="text"
                        name="pagoseguro">
                    <label>Póliza:</label>
                    <input style="border:none;border-bottom:1px solid black;width:30%;background:white;"readonly value="<?= $compania_seguro_poliza?>" type="text"
                        name="pagopoliza">
                    <br>
                    <br>
                    <label style="padding-right:5px;">Contrato de servicio:</label><input
                        style="border:none;border-bottom:1px solid black;width:35%;background:white;" type="text"
                        name="pagocontrato"readonly value="<?= $contrato_servicio?>">Póliza:</label><input
                        style="border:none;border-bottom:1px solid black;width:30%;background:white;" type="text"
                        readonly value="<?= $contrato_servicio_poliza?>"name="pagopolizacontrato">
                    <br>
                    <br>
                    <label style="padding-right:5px;">Gap:</label><input
                        style="border:none;border-bottom:1px solid black;width:40%;background:white;" type="text"
                        readonly value="<?= $gap?>" name="gap">
                    <label>Póliza:</label><input
                        style="border:none;border-bottom:1px solid black;width:40%;background:white;" type="text"
                        name="pagopolizagap" readonly value="<?= $gap_poliza?>">

                </div>
            </div>
        </div>
            <!-- aqui mandare el input para el array -->
            <input type="hidden" name="templates[]" value="3">
    </div>

</div>