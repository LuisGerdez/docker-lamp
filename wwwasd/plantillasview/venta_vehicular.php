  <div class="whiteblock">
     <div class="datos-container-formulario">
         <div id="divcolor" class="x_panel col-md-8">
             <div style="padding-top:10%;" class="col-md-12">
                 <div class="col-md-6" style="float:left;">
                     <img id="imggarantia" src="../plantillasview/img/Logo.png" alt="" srcset="">
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
                                <label style="border:none;border-bottom:1px solid black;width:100%;" for="" ><b><?php echo $vehi_nombre_comprador?></b></label>
                                 <input style="border:none;border-bottom:1px solid black;width:100%;" type="hidden"
                                    value="<?php echo  $vehi_nombre_comprador ?>" name="vehi_nombre_comprador" id="">
                             </div>
                         </div>


                         <div class="col-md-12">
                             <label for="">Dirección residencial:</label>
                             <br>
                             <label style="border:none;border-bottom:1px solid black;width:100%;" for="" ><b><?php echo $vehi_direccion_residencial?></b></label>
                             <input type="hidden" name="vehi_direccion_residencial" id="" value="<?php echo $vehi_direccion_residencial?>">
                         </div>
                         <div class="col-md-12">
                             <label for="">Dirección Postal:</label>
                             <br>
                             <label style="border:none;border-bottom:1px solid black;width:100%;" for="" ><b><?php echo $vehi_postal?></b></label>
                             <input style="border:none;border-bottom:1px solid black;width:100%;" type="hidden"
                                 name="vehi_postal" id="" value="<?php echo $vehi_postal?>">
                         </div>
                     </div>


                 </div>
                 <div class="col-md-4 d-flex justify-content-start">
                     <table style="border-collapse:collapse;border:none;">
                         <tr>
                             <td> <small><label for="">Fecha entrega:</label></small></td>
                             <td> <small><label for="" style="border:none;border-bottom:1px solid black;width:100%;text-align:center;"><?php echo $vehi_fecha?></label><input type="hidden"
                                         style="border:none;border-bottom:1px solid black;width:100%;" value="<?php echo $vehi_fecha?>" name="vehi_fecha"
                                         id=""></small></td>
                         </tr>
                         <tr>
                             <td> <small><label for="">Seg. social:</label></small></td>
                             <td><small><label for="" style="border:none;border-bottom:1px solid black;width:100%;text-align:center;"><?php echo $vehi_social?></label>
                             <input type="hidden" style="border:none;border-bottom:1px solid black;width:100%;"
                                         name="vehi_social" id="" value="<?php echo $vehi_social?>"></small></td>
                         </tr>
                         <tr>
                             <td> <small><label for="">Fecha de nacimiento:</label></small></td>
                             <td><small><label for="" style="border:none;border-bottom:1px solid black;width:100%;text-align:center;"><?php echo $vehi_nacimiento?></label><input type="hidden" value="<?php echo $vehi_nacimiento?>"style="border:none;border-bottom:1px solid black;width:100%;"
                                         name="vehi_nacimiento" id=""></small></td>
                         </tr>

                         <tr>
                             <td> <small><label for="">No. Licencia:</label></small></td>
                             <td><small><label for="" style="border:none;border-bottom:1px solid black;width:100%;text-align:center;"><?php echo $vehi_licencia?></label><input type="hidden"
                                         style="border:none;border-bottom:1px solid black;width:100%;"
                                        value="<?php $vehi_licencia?>"   name="vehi_licencia" id=""></small></td>
                         </tr>

                         <tr>
                             <td> <small><label for="">Teléfono:</label></small></td>
                             <td><small><label for="" style="border:none;border-bottom:1px solid black;width:100%;text-align:center;"><?php echo $vehi_telefono?></label>
                             <input type="hidden" style="border:none;border-bottom:1px solid black;width:100%;"
                                         name="vehi_telefono" value="<?php echo $vehi_telefono?>" id=""></small></td>
                         </tr>

                         <tr>
                             <td> <small><label for="">Celular:</label></small></td>
                             <td><small><label for="" style="border:none;border-bottom:1px solid black;width:100%;text-align:center;"><?php echo $vehi_celular?></label><input type="hidden"
                                         style="border:none;border-bottom:1px solid black;width:100%;"
                                         name="vehi_celular" value="<?php echo $vehi_celular?>" id=""></small></td>
                         </tr>
                         <tr>
                             <td> <small><label for="">Correo electronico:</label></small></td>
                             <td><small><input type="email"
                                         style="border:none;border-bottom:1px solid black;width:100%;
                                         background:white;" readonly value="<?php echo $vehi_correo?>"><input type="hidden"
                                         style="border:none;border-bottom:1px solid black;width:100%;"
                                         name="vehi_correo" value="<?php echo $vehi_correo?>" id=""></small></td>
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
                             VEHÍCULO VENDIDO
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
                                             style="width:100%;background:white;border:none;" type="text"  name="vehi_stock" readonly value="<?php echo $vehi_stock?>" id=""></small></label>
                             </div>
                             <div class="col-md-3"> <label for=""><small>Año:<input type="text" name="vehi_año"
                             value="<?php echo $vehi_año?>" readonly    style="width:90%;background:white;border:none;"></small></label>
                             </div>
                         </div>

                         <div class="col-md-12 d-flex justify-content-start"
                             style="padding:0;border-bottom:3px solid black;">
                             <div class="col-md-6">
                                 <label for=""><small>Marca: <input style="background:white;border:none;width:100%;" type="text" name="vehi_marca"
                                           value="<?php echo $vehi_marca ?> "  id="" readonly></small></label>
                             </div>
                             <div class="col-md-6">
                                 <label for=""><small>Modelo: <input style="background:white;border:none;width:100%;" value="<?php echo $vehi_modelo?>" readonly type="text" name="vehi_modelo"
                                             id=""></small></label>
                             </div>
                         </div>
                         <div class="col-md-12 d-flex justify-content-start"
                             style="padding:0;border-bottom:3px solid black;">
                             <div class="col-md-4">
                                 <label for=""><small>VIN: <input style="background:white;border:none;width:100%;" readonly type="text" name="vehi_vin"
                                            value="<?php echo $vehi_vin?>" id=""></small></label>
                             </div>
                             <div class="col-md-4">
                                 <label for=""><small>Color: <input style="background:white;border:none;width:100%;" value="<?php echo $vehi_color?>" readonly type="text" name="vehi_color"
                                         id=""></small></label>
                             </div>
                             <div class="col-md-4" style="">
                                 <label for=""><small>Millaje: <input style="background:white;border:none;width:100%;" value="<?php echo $vehi_millaje?>" type="text"readonly
                                             name="vehi_millaje" id=""></small></label>
                             </div>
                         </div>

                         <div class="col-md-12 d-flex justify-content-start">
                             <div class="col-md-4">
                                 <label for=""><small>Tablilla: <input type="text" style="background:white;border:none;width:100%;"
                                         value="<?php echo $vehi_tablilla ?>" readonly    name="vehi_tablilla" id=""></small></label>
                             </div>
                             <div class="col-md-4">
                                 <label for=""><small>Marbete: <input type="text" readonly style="background:white;border:none;width:100%;"s
                                 value="<?php echo $vehi_marbete ?>"     name="vehi_marbete" id=""></small></label>
                             </div>
                             <div class="col-md-4">
                                 <label for=""><small>Vence: <input type="text" readonly style="background:white;border:none;width:100%;"s name="vehi_vence"
                                 value="<?php echo $vehi_vence ?>"  id=""></small></label>
                             </div>
                         </div>
                     </div>
                     <!-- parte 2 -->
                     <div class="col-md-12 " style="padding:0;">
                         <div style="border-bottom:1px solid black;font-weight:bolder;padding:0;background:black;"
                             class="text-center col-md-12">

                             <label style="color:white;">VEHÍCULO USADO TOMADO A CAMBIO</label>
                         </div>

                         <div class="col-md-12 d-flex justify-content-start"
                             style="padding:0;border-bottom:3px solid black;">
                             <div style="" class="col-md-4">
                                 <label for=""><small>Marca: <input type="text" style="background:white;border:none;width:100%;" value="<?php echo $vehi_marca2?>" readonly name="vehi_marca2"
                                             id=""></small></label>
                             </div>
                             <div class="col-md-4">
                                 <label for=""><small>Modelo: <input type="text" style="background:white;border:none;width:100%;" value="<?php echo $vehi_modelo2?>" readonly name="vehi_modelo2"
                                             id=""></small></label>
                             </div>
                             <div class="col-md-4">
                                 <label for=""><small>Año: <input style="background:white;border:none;width:100%;" value="<?php echo $vehi_año2?>" readonly type="text" name="vehi_año2"
                                             id=""></small></label>
                             </div>
                         </div>
                         <div class="col-md-12 d-flex justify-content-start"
                             style="padding:5px;border-bottom:3px solid black;">
                             <div class="col-md-6" style="padding:0;">
                                 <label for=""><small>VIN: <input type="text" style="background:white;border:none;" readonly value="<?php echo $vehi_vin2?>" name="vehi_vin2" id=""></small></label>
                             </div>
                             <div class="col-md-6" style="padding:0;">
                                 <label for=""><small>Tablilla: <input type="text" style="background:white;border:none;" readonly value="<?php echo $vehi_tablilla2?>" name="vehi_tablilla2"
                                             id=""></small></label>

                             </div>
                         </div>
                         <div class="col-md-12 d-flex justify-content-start"
                             style="padding:5px;border-bottom:3px solid black;">
                             <div class="col-md-6">
                                 <label for=""><small>Millaje: <input type="text" style="background:white;border:none;" value="<?php echo $vehi_millaje2?>" readonly name="vehi_millaje2"
                                             id=""></small></label>
                             </div>
                             <div class="col-md-6">
                                 <label for=""><small>Color: <input type="text" name="vehi_color2"
                                 value="<?php echo $vehi_color2?>" style="background:white;border:none;" readonly  id=""></small></label>

                             </div>
                         </div>
                         <div class="col-md-12 d-flex justify-content-start" style="padding:5px;">

                             <div class="col-md-6">
                                 <label for=""><small>Balance adeudado A:</label>
                             </div>
                             <div class="col-md-6">
                                 <input type="text" name="vehi_balance" value="<?php echo $vehi_balance?>" style="background:white;border:none;" readonly id="">
                             </div>
                         </div>
                         <p></p>
                         <div class="col-md-12" style="padding:0;">
                             <div class="col-md-12" style="padding:0;border-top:3px solid black;">
                                 <div class="col-md-12 d-flex" style="padding:5px;">
                                     <div class="col-md-6">
                                         <label for=""><small>Marbete: <?php echo $vehi_marbete2?><input type="hidden" readonly style="background:white;border:none;" name="vehi_marbete2" value="<?php echo $vehi_marbete2?>"
                                                     id=""></small></label>
                                     </div>
                                     <div class="col-md-6">
                                         <label for=""><small>Vence: <?php echo $vehi_vence2?> <input type="hidden" name="vehi_vence2"
                                                    value=" <?php echo $vehi_vence2?>" id=""></small></label>
                                     </div>
                                 </div>
                                 <div style="padding-left:5px;"class="col-md-4">
                                     <label for=""><small>Cliente entregó:</small></label>
                                 </div>
                                 <div  style="padding-left:5px;" class="col-md-12 d-flex justify-content-start">
                                     <div style="padding:0;" class="col-md-4 d-flex justify-content-start">
                                         <label for=""><small>Licencia: <input value="1" class="only-one2"
                                                     type="checkbox" name="vehi_check2" id=""> </small> </label>
                                         <label for=""><small>Título: <input value="2" checked type="checkbox" class="only-one2"
                                                     name="vehi_check2" id=""> </small> </label>
                                     </div>
                                     <input id="firma5"
                                         style="cursor:pointer;border:3px solid black;height:50px;margin-left:25%;width:161px;background:#d3cccc;" class="firma" name="firma5">

                                     </input>
                                 </div>

                                 <div  style="padding-left:5px;" class="col-md-12">
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
                                     <label><small>Crédito por carro usado: </small></label>
                                 </div>
                                 <div class="col-md-6">
                                     <input type="text" readonly value="$<?php echo $vehi_usado?>" style="background:white;border:none;" name="vehi_usado"
                                         id="">
                                 </div>
                             </div>


                             <div style="border-bottom:3px solid black;" class="col-md-12 d-flex justify-content-start">
                                 <div class="col-md-6" style="border-right:3px solid black;"> <label><small>
                                             Balance Adeudado: </small></label></div>
                                 <div class="col-md-6"><input type="text" readonly value="$<?php echo $vehi_balance_adeudado?>" style="background:white;border:none;"
                                         name="vehi_balance_Adeudado" id=""></div>

                             </div>


                             <div style="border-bottom:3px solid black;" class="col-md-12 d-flex justify-content-start">
                                 <div class="col-md-6" style="border-right:3px solid black;"> <label><small>
                                             Crédito Neto: </small></label></div>
                                 <div class="col-md-6"><input type="text" readonly value="$<?php echo $vehi_credito_neto?>" style="background:white;border:none;"
                                         name="vehi_credito_neto" id="">
                                 </div>

                             </div>


                             <div style="border-bottom:3px solid black;" class="col-md-12 d-flex justify-content-start">
                                 <div class="col-md-6" style="border-right:3px solid black;"><label><small>Pago
                                             Contado:</small></label></div>
                                 <div class="col-md-6"> <input type="text"readonly value="$<?php echo $vehi_pago_contado?>" style="background:white;border:none;"
                                         name="vehi_pago_contado" id="">
                                 </div>

                             </div>
                             <div style="border-bottom:3px solid black;" class="col-md-12 d-flex justify-content-start">
                                 <div class="col-md-6" style="border-right:3px solid black;"><label><small>
                                             Crédito A su favor:</small></label></div>
                                 <div class="col-md-6"> <input type="text" style="background:white;border:none;"
                                         name="vehi_credito_asufavor" readonly value="$<?php echo $vehi_credito_asufavor?>" id=""></div>

                             </div>

                             <div style="border-bottom:3px solid black;" class="col-md-12 d-flex justify-content-start">
                                 <div class="col-md-6" style="border-right:3px solid black;"><label><small> Otros
                                             Pagos:</small></label></div>
                                 <div class="col-md-6"> <input type="text" readonly value="$<?php echo $vehi_otros_pagos?>" style="background:white;border:none;"
                                         name="vehi_otros_pagos" id="">
                                 </div>

                             </div>

                             <div style="border-bottom:3px solid black;" class="col-md-12 d-flex justify-content-start">
                                 <div class="col-md-6" style="border-right:3px solid black;"> <label><small>
                                             Crédito total: </small></label></div>
                                 <div class="col-md-6"><input type="text"  readonly value="$<?php echo $vehi_credito_total?>" style="background:white;border:none;"
                                         name="vehi_credito_total2" id=""></div>

                             </div>
                             <div class="col-md-12 d-flex justify-content-start">

                                 <div class="col-md-6"><label><small>Pronto Recibido: <br>
                                 <input readonly type="text" value="$<?php echo $vehi_pronto_recibido?>"
                                                 style="background:white;border:none;    width: 50%;" name="vehi_pronto_recibido"
                                                 id=""></small></label></div>
                                 <div class="col-md-6"><label><small> Recibo: <br>
                                 <input type="text" readonly value="#<?php echo $vehi_recibo?>"
                                                 style="background:white;border:none;" name="vehi_recibo"
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
                         <div class="col-md-6"> <input type="text" style="background:white;border:none;"
                                 name="vehi_precio_unidad" id="" readonly value="$<?php echo $vehi_precio_unidad?>">
                         </div>
                     </div>
                     <div class="col-md-6 d-flex justify-content-start"
                         style="padding:0;border-right:3px solid black;border-bottom:3px solid black;">
                         <div class="col-md-6" style="padding:0;">
                             <label>Puertas: <input readonly style="background:white;border:none;width:50px;"
                                     name="vehi_puertas" id="" type="text" value="<?php echo $vehi_puertas?>"></label>
                         </div>
                         <div class="col-md-6" style="padding:0;">
                             <label>Cilindros:<input style="background:white;border:none;width:50px;"
                                     name="vehi_cilindros" readonly value="<?php echo $vehi_cilindros?>" id="" type="text"></label>
                         </div>
                     </div>

                     <div class="col-md-6 d-flex justify-content-start" style="border-right:3px solid black;padding:0;">
                         <div class="col-md-6" style="padding:0;">
                             <label>Transmisión: <input type="text" readonly
                                     style="background:white;border:none;padding:0;width:90%;"
                                     name="vehi_transmision" value="<?php echo $vehi_transmision?>" id=""></label>
                         </div>
                         <div class="col-md-6" style="padding:0;">
                             <label>Caballaje:<input type="text"
                                     style="background:white;border:none;padding:0;width:90%;"  readonly value="<?php echo $vehi_Caballaje?>" name="vehi_Caballaje"
                                     id=""></label>
                         </div>
                     </div>
                     <div class="col-md-12 d-flex justify-content-start"
                         style="padding:0;border-bottom:3px solid black;border-top:3px solid black;">
                         <div class="col-md-6" style="padding:0;border-right:3px solid black;">
                             <label>Total</label>
                         </div>
                         <div class="col-md-6"> <input readonly type="text" value="$<?php echo $vehi_total?>" style="background:white;border:none;"
                                 name="vehi_total" id="">
                         </div>
                     </div>
                     <div class="col-md-12 d-flex justify-content-start"
                         style="padding:0;border-bottom:3px solid black;">
                         <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Gap</label>
                         </div>
                         <div class="col-md-6"> <input type="text"readonly value="$<?php echo $vehi_gap?>" style="background:white;border:none;"
                                 name="vehi_gap" id="">
                         </div>
                     </div>
                     <div class="col-md-12 d-flex justify-content-start"
                         style="padding:0;border-bottom:3px solid black;">
                         <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Seguro
                                 doble()</label>
                         </div>
                         <div class="col-md-6"> <input type="text" readonly value="$<?php echo $vehi_seguro_doble?>" style="background:white;border:none;"
                                 name="vehi_seguro_doble" id="">
                         </div>
                     </div>
                     <div class="col-md-12 d-flex justify-content-start"
                         style="padding:0;border-bottom:3px solid black;">
                         <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Seguro de
                                 vida</label>
                         </div>
                         <div class="col-md-6"> <input type="text" readonly value="$<?php echo $vehi_seguro_vida?>" style="background:white;border:none;"
                                 name="vehi_seguro_vida" id="">
                         </div>
                     </div>
                     <div class="col-md-12 d-flex justify-content-start"
                         style="padding:0;border-bottom:3px solid black;">
                         <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Contrato de
                                 servicio</label>
                         </div>
                         <div class="col-md-6"> <input type="text" readonly value="$<?php echo $vehi_contrato_servicio?>" style="background:white;border:none;"
                                 name="vehi_contrato_servicio" id="">
                         </div>
                     </div>
                     <div class="col-md-12 d-flex justify-content-start"
                         style="padding:0;border-bottom:3px solid black;">
                         <div class="col-md-6" style="padding:0;border-right:3px solid black;">
                             <label>Tablillas</label>
                         </div>
                         <div class="col-md-6"> <input type="text" readonly value="$<?php echo $vehi_tablillas?>" style="background:white;border:none;"
                                 name="vehi_tablillas" id="">
                         </div>
                     </div>
                     <div class="col-md-12 d-flex justify-content-start"
                         style="padding:0;border-bottom:3px solid black;">
                         <div class="col-md-6" style="padding:0;border-right:3px solid black;">
                             <label>Seguro ACAA</label>
                         </div>
                         <div class="col-md-6"> <input type="text" readonly style="background:white;border:none;"
                                 name="vehi_seguro_ACAA" value="$<?php echo $vehi_seguro_ACAA?>"id="">
                         </div>
                     </div>
                     <div class="col-md-12 d-flex justify-content-start"
                         style="padding:0;border-bottom:3px solid black;">
                         <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Precio
                                 Total</label>
                         </div>
                         <div class="col-md-6"> <input type="text" readonly style="background:white;border:none;"
                                 name="vehi_precio_total" value="$<?php echo $vehi_precio_total?>" id="">
                         </div>
                     </div>
                     <div class="col-md-12 d-flex justify-content-start" style="padding:0;">
                         <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Crédito
                                 Total</label>
                         </div>
                         <div class="col-md-6"> <input type="text" value="$<?php echo $vehi_credito_total?>" readonly style="background:white;border:none;"
                                 name="vehi_credito_total" id="">
                         </div>
                     </div>
                     <div class="col-md-12 d-flex justify-content-start" style="padding:0;border-top:3px solid black;">
                         <div class="col-md-6" style="padding:0;border-right:3px solid black;"><label>Balance a
                                 pagar</label>
                         </div>
                         <div class="col-md-6"> <input type="text" readonly value="$<?php echo $vehi_balance_apagar?>" style="background:white;border:none;"
                                 name="vehi_balance_apagar" id="">
                         </div>
                     </div>
                     <div class="col-md-12" style="padding:0; border-bottom:3px solid black;">
                         <div class="col-md-12 text-center"
                             style="background:black;color:white;border-bottom:1px solid black;font-weight:bolder;padding:0;">
                             BALANCE-CONTRATO A PAGARSE DE ACUERDO CON
                         </div>
                         <p style="padding-top:5px;margin:10px;">
                             En <input type="text"readonly value="<?php echo $vehi_numplazo1?>" name="vehi_numpplazo1" id="" style="width:80px;background:white;"> plazos
                             mensuales de
                             $<input type="text" style="background:white;"value="<?php echo $vehi_plazo1?>" name="vehi_plazo1" id=""><br>con fecha de <input type="text" style="background:white;"value="<?php echo $vehi_fecha1?>"
                                 readonly name="vehi_fecha1" id="">
                             <br><br>En <input type="text" readonly value="<?php echo $vehi_numplazo2?>" name="vehi_numplazo2" style="width:80px;background:white;" id="">
                             plazos mensuales
                             de $<input type="text" style="background:white;"readonly value="<?php echo $vehi_plazo2?>" name="vehi_plazo2" id=""><br> con fecha de<input type="text" readonly
                                 name="vehi_fecha2" style="background:white;" value="<?php echo $vehi_fecha2?> "id="">
                         <p style="padding-top:5px;margin:10px;">First Bank al %
                             <input type="text"style="background:white;"  readonly value="<?php echo $vehi_bancoporcentaje?>" name="vehi_bancoporcentaje" id="">
                         </p>
                     </div>
                     <div class="col-md-12" style="padding:10px;">

                         <textarea style="  overflow-y: scroll;resize: none;"
                             name="vehi_observaciones" id="" cols="45" rows="5" readonly value="<?php echo $vehi_observaciones?>"><?php echo $vehi_observaciones?></textarea>
                     </div>
                     <div class="col-md-12" style="border-top:3px solid black;">
                         <h5 style="text-align:center;"><b><u>NO ACEPTAMOS DEVOLUCIONES</u></b></h5>
                         <p>
                             <small>
                                 De devolver su unidad o cancelación de contrato de razon justificada. Auto 1
                                 LLC, le cobrará $95.00 diarios
                                 por el uso del vehículo. En adición, se cobrará millaje y depreciación según
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
                             si alguno, está libre de todo gravámen o contrato de venta consicional y que la
                             licencia del mismo
                             debidamente endosada será entregada a la vendedora con el vehículo. Se entiende que
                             toda compra a plazos mediante contrato de venta condicional y/o hipoteca sobre
                             bienes. En caso de que el comprador exprese su opción por cierta financiadora
                             particular para el financiamiento del balance de esta venta, se le conceden 10 días
                             de esta fecha para traer a la vendedora el aporte
                             de este balance y en caso de transcurrir dicho término sin que haya pagado dicho
                             balance la vendedora quedará en libertad de utilizar cualquier entidad financiadora
                             para cobrarse dicho balance. En tal caso se entenderá que tal actuación de la
                             vendedora tiene autorización expresa del comprador.
                             El comprador ha representado a la vendedora ser mayor de edad, todo vehículo usado
                             se cende de acuerdo a la garantía estipualada por la ley. En caso de tratarse de la
                             compra de un vehículo nuevo, la vendedora expresamente concede al
                             comprador la garantía normal en carros nuevos que concedo la casa manufacturera
                             cuya garantía es de conocimiento del comprador. Aunque esta orden este firmada por
                             un vendedor no obligará en forma alguna a la vendedora, hasta tanto haya sido
                             aprobada y firmada por uno de los oficiales del la casa. Esta orden de compra y el
                             contrato de venta condicional correspondiente y/o el contrato de hipoteca sobre
                             bienes muebles, si la venta es a plazos, contiene por escrito todas las condiciones
                             del negocio.
                         </small>
                     </p>
                     <div style="padding-top:5%;" class="col-md-12">

                     </div>

                 </div>
             </div>
         </div>

        <!-- aqui mandare el input para el array -->
        <input type="hidden" name="templates[]" value="2">
        <input type="hidden" id="vehiculo_vendido_estado" value="<?php echo $vehi_check ?>">
        <input type="hidden" id="tipo_cliente_entrego" value="<?php echo $vehi_check2 ?>">
     </div>

 </div>

<script>
    let vehiculo_vendio_estado = document.querySelector('#vehiculo_vendido_estado').value;
    let tipo_cliente_entrego = document.querySelector('#tipo_cliente_entrego').value;

    if(vehiculo_vendio_estado == '1') {
        document.querySelector("input[name=vehi_check][value='1']").checked = true;
        document.querySelector("input[name=vehi_check][value='2']").checked = false;
    } else {
        document.querySelector("input[name=vehi_check][value='1']").checked = false;
        document.querySelector("input[name=vehi_check][value='2']").checked = true;
    }

    if(tipo_cliente_entrego == '1') {
        document.querySelector("input[name=vehi_check2][value='1']").checked = true;
        document.querySelector("input[name=vehi_check2][value='2']").checked = false;
        document.querySelector("input[name=vehi_check2][value='3']").checked = false;
    } else if(tipo_cliente_entrego == '2') {
        document.querySelector("input[name=vehi_check2][value='1']").checked = false;
        document.querySelector("input[name=vehi_check2][value='2']").checked = true;
        document.querySelector("input[name=vehi_check2][value='3']").checked = false;
    } else if(tipo_cliente_entrego == '3') {
        document.querySelector("input[name=vehi_check2][value='1']").checked = false;
        document.querySelector("input[name=vehi_check2][value='2']").checked = false;
        document.querySelector("input[name=vehi_check2][value='3']").checked = true;
    }
</script>