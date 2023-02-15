  <div class="whiteblock">     
            <div class="datos-container-formulario">
                <div style="padding-top:10%;">

                </div>
                <div id="divcolor" class="x_panel col-md-8">

                    <div style="padding-top:10%;" class="col-md-12 text-center">
                        <img id="imgpago" src="../plantillasview/img/Logo.png" alt="" srcset="">
                    </div>

                    <div class="col-md-12 text-center">
                        <small><b>Auto1pr.com</b></small>
                        <p></p>
                        <small><b>ACUERDO SUPLEMENTARIO<br>SOBRE VEHÍCULO TOMADO COMO PRONTO PAGO (TRADE IN)</b></small>
                    </div>
                    <p></p>

                    <div class="col-md-12">
                        <label for="">Fecha:</label>
                        <input style="border:none;background:white;"type="hidden" name="tradefecha" value='<?php echo  $tradefecha ?>'>
                        <label for=""><b><?php echo  $tradefecha?></b></label>
                        <br>
                        <label style="padding-right:5px;">Yo,
                            <input style="border:none;background:white;"type="hidden" value='<?php echo $tradename ?>' name="tradename">
                            <b><?php echo $tradename ?></b> hago constar que le he entregado a <b>Auto1pr.com</b>, en
                            calidad de pronto pago (trade in) el vehÍculo de motor, marca
                            <b><?php echo $trade1 ?></b>
                            <input style="border:none;background:white;"type="hidden" value='<?php echo $trade1 ?>' name="trade1">,
                            modelo <b><?php echo  $trade2 ?></b>
                            <input style="border:none;background:white;"
                                type="hidden" value='<?php echo  $trade2 ?>' name="trade2"> con tablilla <b><?php echo  $trade3 ?></b>

                            <input style="border:none;background:white;"
                                type="hidden"  value='<?php echo  $trade3 ?>' name="trade3"> y número de serie  <b><?php echo  $tradeserie ?></b>
                      
                      
                            <input style="border:none;background:white;"
                                type="hidden"  value='<?php echo  $tradeserie ?>' name="tradeserie">(el "Vehículo"), por lo que autorizo a <b>Auto1pr.com</b> a
                            efectuar el traspaso de la titularidad de este a nombre de cuales quiera de sus
                            subsiguientes adquirientes.
                        </label>
                        <br>
                        <label style="padding-right:5px;">INICIALES</label><input id="firma" required class="firma"
                        style="border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;cursor:pointer;" type="text" name="firma" readonly>
                        <p></p>
                        <p>Represento que la unidad descrita no tiene gravamen de hipoteca, o algún otro gravamen que no
                            sea el correspondiente a la cuenta #<b><?php echo  $tradecuenta ?></b><input
                                style="border:none;background:white;"
                                type="hidden"  value='<?php echo  $tradecuenta ?>' name="tradecuenta"> mantenida con el banco <b> <?php echo  $tradebanco ?></b>
                            <input style="border:none;background:white;"
                                type="hidden"  value='<?php echo  $tradebanco ?>' name="tradebanco">(el "Financiamiento"). En la eventualidad que esta
                            representación resulte incorrecta, me comprometo a tomar, dentro de los diez (10) días
                            requerido, a aquellas medidas necesarias para liberar el Vehículo de todos y cada uno de
                            los gravámentes que tenga, con la única excepción del Financiamiento.
                        </p>
                        <label style="padding-right:5px;">INICIALES</label><input id="firma2" required class="firma"
                        readonly style="border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;cursor:pointer;" type="text"name="firma2"
                            >
                        <p></p>
                        <p>Por este medio AUTORIZO a <b>Auto1pr.com</b> a liquidar el balance pendiente de pago del
                            Financimiento, balance que represento asciende a $
                            <input style="border:none;background:white;"
                                type="hidden"  value='<?php echo  $tradenumber ?>' name="tradenumber"><b><?php echo  $tradenumber ?></b> y CEDO a favor de éste cualquier diferencial que pueda
                            surgir por concepto de primas de seguros no devengadas y/o por concepto de un balance de
                            cancelación inferior al aquí informado, número de Póliza <b><?php echo  $tradepoliza ?></b>
                            <input style="border:none;background:white;"
                                type="hidden"  value='<?php echo  $tradepoliza ?>' name="tradepoliza">, o Contrato de Servicio <input
                                style="border:none;background:white;"
                                type="hidden"  value='<?php echo  $tradeservicio ?>'name="tradeservicio"><b><?php echo  $tradeservicio ?></b>. Revelo a <b>Auto1.PR.com</b> de toda obligación que
                            pudiera tener de traspasar el Vehículo a nombre suyo antes de venderlo al adquiriente
                            subsiguiente.
                        </p>
                        <label style="padding-right:5px;">INICIALES</label><input id="firma3" name="firma3" required class="firma"
                        readonly   style="border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;cursor:pointer;" type="text"
                            >
                        <p>Al momento de la transacción se ha estimado que el balance a pagar para el saldo de
                            financiamiento del Vehículo es el arriba
                            indicado; También me comprometo a entregar balance de cancelación de la institución en la
                            cual tiene deuda. No obstante,
                            si al momento de liquidar dicho financiamiento, se encuentra que el balance de saldo fuera
                            mayor al aquí informado, o si el vehículo
                            tuviese otras deudas o gravámenes no informados al presente, o de estar alguna multa
                            pendiente de pago o registro ante cualquier agencia pública de deficiencia y/o a pagar
                            dichas cantidades dentro de diez (10)
                            días desde que se me notifique la existencia de estas. En todo caso, REVELO a <b>Auto1pr.com</b> de
                            toda la responsabilidad u obligación asociada
                            con y me comprometo a indemnizarle (reembolsarle), cualquier pago que realice por dichos
                            conceptos.
                        </p>
                        <label style="padding-right:5px;">INICIALES</label><input id="firma4" name="firma4" required
                        readonly   style="border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;cursor:pointer;" class="firma" type="text"
                            >
                        <div class="col-md-12" style="padding-bottom:10%;"></div>
                 </div>
                </div>

                    <!-- aqui mandare el input para el array -->
                    <input type="hidden" name="templates[]" value="1">
            </div>
</div>


