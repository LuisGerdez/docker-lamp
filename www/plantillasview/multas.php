 <div class="whiteblock">
     <div class="datos-container-formulario">
         <div id="divcolor" class="x_panel col-md-8">
             <div style="padding-top:10%;" class="col-md-12 text-center">
                 <img id="imgmulta" src="../plantillasview/img/Logo.png" alt="" srcset="">
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
                     style="border:none;border-bottom:1px solid black;width:50%;background:white;"value="<?=$mul_name?>"readonly type="text"
                     name="mul_name" id="mul_name"><label for="">, dueño del vehiculo.</label>
                 <br>
                 <label style="padding-right:5px;">Marca:</label><input
                 value="<?=$mul_marca?>" readonly style="border:none;border-bottom:1px solid black;width:30%;background:white;" type="text"
                     name="mul_marca" id="mul_marca">
                 <br>
                 <label style="padding-right:5px;">Modelo:</label><input
                     style="border:none;border-bottom:1px solid black;width:30%;background:white;" type="text"
                     value="<?=$mul_modelo?>"readonly   name="mul_modelo" id="mul_modelo">
                 <br>
                 <label style="padding-right:5px;">Año:</label><input
                     style="border:none;border-bottom:1px solid black;width:20%;background:white;" type="text"
                     name="mul_año" value="<?=$mul_año?>"readonlyid="mul_año">
                 <br>
                 <label style="padding-right:5px;">Tablilla:</label><input
                     style="border:none;border-bottom:1px solid black;width:30%;background:white;" type="text"
                     name="mul_tablilla"value="<?=$mul_tablilla?>"readonly id="mul_tablilla">
                 <br>
                 <label style="padding-right:5px;">Núm. de serie:</label><input
                     style="border:none;border-bottom:1px solid black;width:30%;background:white;" type="text"
                     name="mul_serie" value="<?=$mul_serie?>"readonlyid="mul_serie">
                 <br>
                 <br>
                 <label style="padding-right:5px;">Dejado en trade-in el día:<input
                         style="border:none;border-bottom:1px solid black;width:30%;background:white;" type="text"
                         name="mul_trade"value="<?=$mul_trade?>"readonly id="mul_trade">, soy responsable de toda la multa que aparezca en el auto
                     antes de la entre del mismo al Dealer como trade-in.</label>
                 <div style="padding-bottom:300px;">

                 </div>
             </div>
                <!-- aqui mandare el input para el array -->
                <input type="hidden" name="templates[]" value="5">
         </div>
     </div>
 </div>