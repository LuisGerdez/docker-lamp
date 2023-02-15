<div class="whiteblock">
    <div class="datos-container-formulario">
        <div id="divcolor" class="x_panel col-md-8">

            <br>
            <div class="col-md-12 text-center">
                <img id="imgquote" src="../plantillasview/img/Logo.png" alt="" srcset="">
            </div>
            <br>
            <div class="col-md-12">
                <p>Estimado/a:<input style="border:none;background:white;" value="<?= $namequote?>" readonly type="text" name="namequote"
                        id="namequote"><br>
                    A continuación le brindamos los números para su análisis </p><br>
            </div>

            <div class="col-md-6">
                <p><b style="float:left;">Fecha:</b></p><input value="<?= $fechaquote?>" readonly style="border:none;background:white;float:left;"
                   name="fechaquote" id="fechaquote">
            </div>
            <br>
            <div class="col-md-6">
                <p><b style="float:left;">Vendedor:</b></p>
                <input style="border:none;background:white;float:left;"value="<?= $vendedorquote?>" readonly type="text" name="vendedorquote"
                    id="vendedorquote">
            </div>
            <br>
            <br>
            <br>

            <p><small><b>Precio de Venta:</b></small></p>
            <label for="">$<input style="border:none;background:white;"value="<?= $precioquote?>" type="text" name="precioquote"
                    id="precioquote"></label>
            <br>
            <br>
            <b>Gastos de traspaso: </b><label>$<input style="border:none;background:white;" readonly value="<?= $gastosquote?>"name="gastosquote"
                    id="gastosquote" type="text" ></label>
            <br>
            <b>Total: </b><label>$<input style="border:none;background:white;" readonly value="<?= $totalquote?>"name="totalquote"
                    type="text"></label>
            <br>
            <br>
            <label for=""><small>
                    <b>Forma de pago:</b></small></label>
            <br>
            <b>Pronto: </b><input style="border:none;background:white;" readonly value="<?= $prontoquote?>"name="prontoquote" type="text">
            <br>
            <br>
            <b>Balance a financiar: </b><label>$<input style="border:none;background:white;"readonly value="<?= $balancequote?>" name="balancequote"
                    id="balancequote" type="text"></label>
            <br>
            <br>
            <b>Trade in: </b><label>$<input style="border:none;background:white;" readonly value="<?= $tradequote?>"  name="tradequote"
                    type="text"></label>
            <br>
            <br>
            <br>
            <small><b>Balance a financiar: </b></small><label></label>
            <br>
            <br>
            <b>Entidad financiera: </b><label><input style="border:none;background:white;" name="entidadquote"
                    id="entidadquote" readonly value="<?= $entidadquote?>"type="text"></label>
            <br>
            <b>Término: </b><label><input style="border:none;background:white;" readonly value="<?= $terminoquote?>"name="terminoquote"
                    type="text"></label>
            <br>
            <b>Pago mensual: </b><label>$<input style="border:none;background:white;"readonly value="<?= $pagoquote?>" name="pagoquote"
                    type="text"></label>
            <br>
            <br>
            <br>
            <small><b>Auto a cambio: </b></small><label></label>
            <br>
            <br>
            <b>Marca: </b><label><input style="border:none;background:white;"readonly value="<?= $marcaquote?>" name="marcaquote" type="text"></label>
            <br>
            <b>Modelo: </b><label><input style="border:none;background:white;"readonly value="<?= $modeloquote?>" name="modeloquote" type="text"></label>
            <br>
            <b>Versión: </b><label><input style="border:none;background:white;"readonly value="<?= $versionquote?>" name="versionquote"
                    type="text"></label>
            <br>
            <b>Año: </b><label><input style="border:none;background:white;" readonly value="<?= $añoquote?>"name="añoquote" type="text"></label>
            <br>
            <b>Millaje: </b><label><input style="border:none;background:white;" readonly value="<?= $millajequote?>"name="millajequote"
                    type="text"></label>
            <br>
            <b>Tablilla: </b><label><input style="border:none;background:white;" readonly value="<?= $tablillaquote?>"name="tablillaquote"
                    type="text"></label>
<div style="height: 5%;">

</div>
        </div>
    </div>
                <!-- aqui mandare el input para el array -->
                <input type="hidden" name="templates[]" value="4">
</div>