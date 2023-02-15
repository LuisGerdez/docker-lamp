<!--
<?php echo '<pre>'; print_r($array7); echo '</pre>'; ?> 
-->

<div class="whiteblock">
    <div class="datos-container-formulario">
        <div id="divcolor" class="x_panel col-md-8">
            <div style="padding-top:10%;" class="col-md-12">
                <div class="col-md-4" style="float:left;">
                    <img id="imggarantia" src="../plantillasview/img/Logo.png" alt="" srcset="">
                </div>
                <br>
                <br>
                <div style="text-align:left;float:right;" class="col-md-7">
                    <small><b>Auto1pr.com</b></small>
                </div>
            </div>
            <br>
            <br>
            <div style="border-top:2px solid black;"
                class="text-center col-md-12">
                <h4>INFORMACIÓN SOBRE GARANTIA Y CONDICIONES PARA EL VEHICULO</h4>
            </div>
            <div class="d-flex justify-content-start col-md-12">
                <div class="col-md-3">
                    <table>
                        <tr>
                            <td><input style="background:white;" name="garamarca" value="<?= $garamarca?>"
                                    class="inputstitles" readonly type="text"></td>
                        </tr>
                        <tr>
                            <td style="">Marca</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3">
                    <table>
                        <tr>
                            <td><input style="background:white;" name="garamodelo" value="<?= $garamodelo?>" readonly
                                    class="inputstitles" type="text"></td>
                        </tr>
                        <tr>
                            <td style="">Modelo:</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3">
                    <table>
                        <tr>
                            <td><input style="background:white;" class="inputstitles" value="<?= $garaaño?>" readonly
                                    name="garaaño" type="text"></td>
                        </tr>
                        <tr>
                            <td style="">Año:</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3">
                    <table>
                        <tr>
                            <td><input style="background:white;" name="garaserie" class="inputstitles"
                                    value="<?= $garaserie?>" readonly type="text"></td>
                        </tr>
                        <tr>
                            <td style="">Número de Serie:</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div style="padding-bottom:1%;" class="d-flex justify-content-start col-md-12">
                <div class="col-md-3">
                    <table>
                        <tr>
                            <td><input style="background:white;" name="garainventario" value="<?= $garainventario?>"
                                    readonly class="inputstitles" type="text"></td>
                        </tr>
                        <tr>
                            <td style="">Número de inventario</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3">
                    <table>
                        <tr>
                            <td><input style="background:white;" name="garamillaje" value="<?= $garamillaje?>" readonly
                                    class="inputstitles" type="text"></td>
                        </tr>
                        <tr>
                            <td style="">Millage:</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3">
                    <table>
                        <tr>
                            <td><input style="background:white;" name="garatablilla" value="<?= $garatablilla?>"
                                    readonly class="inputstitles" type="text"></td>
                        </tr>
                        <tr>
                            <td style="">Tablilla:</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3">
                    <h3>Precio:</h3>
                    <input style="border:none;background:white;" value="$<?= $garaprecio?>" readonly type="text"
                        name="garaprecio" id="">
                </div>


            </div>
            <div style="border-top:2px solid black;font-size:12px;" class="d-flex align-items-start col-md-12">
                <div class="col-md-8">

                    <h5>GARANTIAS PARA ESTE VEHICULO</h5>

                    <input class="only-one" type="checkbox" readonly  value='1' name="check[]" id="check0"> <label for=""> 2 meses o dos
                        mil
                        millas, lo
                        primero que ocurra. (Mas de 50,000 millas y hasta 100,000 millas)</label>
                    <br>
                    <br>
                    <input class="only-one" type="checkbox" readonly value='2' name="check[]" id="check1"> <label for=""> 3 meses o
                        tres
                        mil millas, lo
                        primero que ocurra. (Mas de 36,000 millas y hasta 50,000 millas)</label>
                    <br>
                    <br>
                    <input class="only-one" type="checkbox" readonly value='3' name="check[]" id="check2"> <label for=""> 4 meses o
                        cuatro
                        mil millas, lo
                        primero que ocurra. (Hasta 36,000 millas)</label>
                    <br>
                    <br>
                    <input class="only-one" type="checkbox" readonly  value='4' name="check[]" id="check3"> <label for=""> 100,000 mil
                        millas en adelante no
                        tiene garantìa. (No tiene garantìa)</label>

                </div>
                <div class="col-md-4">
                    <label style="padding-right:5px;padding-top: 25px;">INICIALES</label><input readonly id="firma10"
                        style="border:none;border-bottom:1px solid black;width:60%;background:#d3cccc;cursor:pointer;"
                        type="text" class="firma" name="firma10">

                    <label style="padding-right:5px;padding-top: 22px;">INICIALES</label><input readonly id="firma11"
                        style="border:none;border-bottom:1px solid black;width:60%;background:#d3cccc;cursor:pointer;"
                        type="text"  name="firma11">


                    <label style="padding-right:5px;padding-top: 15px;">INICIALES</label><input readonly id="firma12"
                        style="border:none;border-bottom:1px solid black;width:60%;background:#d3cccc;cursor:pointer;"
                        type="text"  name="firma12">


                    <label style="padding-right:5px;padding-top: 17px;">INICIALES</label><input readonly id="firma13"
                        style="border:none;border-bottom:1px solid black;width:60%;background:#d3cccc;cursor:pointer;"
                        type="text"  name="firma13">

                </div>
            </div>

            <br>

            <div style="border-top:2px solid black;" class="col-md-12">
                <h5>PARTES INCLUIDAS SEGÙN REGLAMIENTO DE D.A.C.O</h5>

                <p>
                    <small>
                        <b>A) MOTOR</b> -incluye todas las piezas internas del motor incluyendo bomba de
                        agua, bomba de gasolina (mecánica eléctrica), multiple adminisión y escape, bloque y
                        volanta. En motores rotativos incluye las cajas de los rotores. Se excluyen piezas de
                        servicio normal de mantenimiento que requieran cambios periodicos y su respectiva mano
                        de obra.
                        <br>
                        <b>B) TRANSMISIÓN</b> -incluye caja de transmisiòn, todas las piezas internas de las
                        transmisiòn y el convertidor de torsión.
                        <br>
                        <b>C) SISTEMA ELECTRICO</b> -Alternador, generador, motor de arranque y sistema de
                        ignición. No incluye batería, bombillas ni piezas de cambio periodico.
                        <br>
                        <b>D) SISTEMA ELECTRÓNICO</b> -incluye computadora y sus accesorios.
                        <br>
                        <b>E) EJE IMPULSOR</b> -Caja de tracción trasera y/o delantera, según aplique, con sus
                        partes internas, ejes impulsores,
                        eje del cardan y uniones transversales.
                        <br>
                        <b>F) FRENOS</b> -cilindros traseros, bomba de frenos, servo asistencia de vacio, líneas
                        y acoplamientos hidraulicos y calibrados de discos. Se excluyen piezas de servicios
                        normal de mantenimiento que requieran cambios periódicos y su respectiva mano de obra.
                        <br>
                        <b>G) RADIADOR Y ABANICO DEL RADIADOR</b>
                        <br>
                        <b>H) DIRECCIÓN -La caja de guía y sus partes internas (rack & pinion)</b>
                        <br>
                        <b>I) ODOMETRO FUNCIONANDO</b>
                    </small>
            </div>

            <div style="border-top:2px solid black;" class="col-md-12">
                <p><small>
                        - Para obtener servicio: El consumidor se comunicará a (área de servicio) en horas
                        laborales de requerir servicios por conceptos de garantía.
                        <br>
                        - Será el proveedor del servicio y será la entidad responsable de honrar la garantía
                        y/o coordinar cualquier otro recurso técnico
                        <br>
                        - Circunstancias bajo las cuales el consumidor puede perder el derecho a reclamar la
                        garantía (a) Podría perder su derecho si el vehiculo de referencia sufrió un impacto
                        el cual ocasionara daño a la unidad, (b) Alteraciones al vehículo posterior a la
                        compra
                        , (c) Que la unidad sea intervenida mécanicamente previo a la evaluación profesional
                        a la cual usted tiene derecho a recibir de nuestro departamento de servicio.
                        <br>
                        - Proveerá una unidad sustituida; si la reparación de la unidad vendida y en
                        garantía permaneceriera más de (5) días calendario, sin incluir Domingo.
                        <br>
                        - La garantía de su vehículo será transferida a cualquier consumidor subsiguiente
                        sin costo alguno por el tiempo o millaje restante.
                    </small>
                </p>
            </div>
            <div style="border-top:2px solid black;" class="col-md-12">
                <h5>NOTAS IMPORTANTES AL CONSUMIDOR</h5>
            </div>
            <div style="" class="d-flex justify-content-start col-md-12">
                <div class="col-md-8">
                    <p>
                        <small>
                            1. Leo y certifico que he sido responsablemente orientado y se me han mostrado los
                            labels o etiquetas de las partes del vehículo de esta transacción.
                        </small>
                    </p>
                </div>
                <div class="col-md-4">
                    <label style="padding-right:5px;">INICIALES</label><input readonly id="firma6"
                        style="border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;cursor:pointer;"
                        type="text" name="firma6">
                </div>
            </div>
            <div style="" class="d-flex justify-content-start col-md-12">
                <div class="col-md-8">
                    <p>
                        <small>
                            2. Certifico haber sido orientado; que este vehículo pudo haber requerido trabajos de
                            hojalateria y pintura con la intención de optimizarlo.
                        </small>
                    </p>
                </div>
                <div class="col-md-4">
                    <label style="padding-right:5px;">INICIALES</label><input readonly id="firma7"
                        style="border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;cursor:pointer;"
                        type="text"class="firma" name="firma7">
                </div>
            </div>
            <div style="" class="d-flex justify-content-start col-md-12">
                <div class="col-md-8">
                    <p>
                        <small>
                            3. Certifico que he recibido copia del REGLAMENTO DE GARANTIAS DE VEHCULOS DE MOTOR el cual
                            servirá con guía informativa.
                        </small>
                    </p>
                </div>
                <div class="col-md-4">
                    <label style="padding-right:5px;">INICIALES</label><input readonly id="firma8"
                        style="border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;cursor:pointer;"
                        type="text" class="firma"name="firma8">
                </div>
            </div>
            <div style="" class="d-flex justify-content-start col-md-12">
                <div class="col-md-8">
                    <p>
                        <small>
                            4. Certifico que he sido informado que el vehículo aquí vendido proviene del uso anteriores
                            en carácter de (Rental Car).
                            Si <input class="only-one2" name="confirmacion[]" style="background:#d3cccc;" value="1"
                                type="checkbox" readonly id="confirmacion1">No
                            <input class="only-one2" name="confirmacion[]" style="background:#d3cccc;" value="2"
                                type="checkbox" readonly id="confirmacion2">
                        </small>
                    </p>
                </div>
                <div class="col-md-4">
                    <label style="padding-right:5px;">INICIALES</label><input readonly id="firma9"
                        style="border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;cursor:pointer;"
                        type="text" class="firma" name="firma9">
                </div>
            </div>
        </div>
    </div>

    <!-- aqui mandare el input para el array -->
 <input type="hidden" name="templates[]" value="7">
 <input type="hidden" name="where" id="valor" value="<?php echo $garaprecio?>">

 <input type="hidden" name="tipo_garantia" id="tipo_garantia" value="<?php echo $tipo_garantia?>">


</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
<script>
$(document).ready(function() {    
    let firmar = 1;  
    let tipo_garantia = document.querySelector('#tipo_garantia').value;

    document.querySelector('input[name=firma10]').className = '';
    document.querySelector('input[name=firma11]').className = '';
    document.querySelector('input[name=firma12]').className = '';
    document.querySelector('input[name=firma13]').className = '';
      
    switch (tipo_garantia) {
        case '1':
            document.querySelector('input[name=firma10]').className = 'firma';
        
            let firmado = document.getElementById("confirmacion1").checked="checked";
            let check = document.getElementById("check0").checked="checked";
            
            $(document).on("click", "#firma10", function() {
                var ini1 = $('#ini1').val();
                var ini2 = $('#ini2').val();


                var first = ini1.charAt(0);
                var second = ini2.charAt(0);
                var1 = $("#firma10").attr("value", first + second);
                var1 = $("#firma10").attr("style",
                    "font-family:'cherolina';    margin-top: -14px; font-size: 26px;font-weight:bolder;background-color:white!important;border:none;border-bottom:1px solid black;width:60%;background:#d3cccc;cursor:pointer;"
                    );

            })
            break;

        case '2':
            document.querySelector('input[name=firma11]').className = 'firma';

            let firmado2= document.getElementById("confirmacion1").checked="checked";
            let check2=document.getElementById("check1").checked="checked";

            $(document).on("click", "#firma11", function() {
                var ini1 = $('#ini1').val();
                var ini2 = $('#ini2').val();

                var first = ini1.charAt(0);
                var second = ini2.charAt(0);
                var1 = $("#firma11").attr("value", first + second);
                var1 = $("#firma11").attr("style",
                    "font-family:'cherolina';    margin-top: -14px; font-size: 26px;font-weight:bolder;background-color:white!important;border:none;border-bottom:1px solid black;width:60%;background:#d3cccc;cursor:pointer;"
                    );

            })
            break;

        case '3':
            document.querySelector('input[name=firma12]').className = 'firma';

            let firmado3= document.getElementById("confirmacion1").checked="checked";
            let check3=document.getElementById("check2").checked="checked";
            $(document).on("click", "#firma12", function() {
                var ini1 = $('#ini1').val();
                var ini2 = $('#ini2').val();

                var first = ini1.charAt(0);
                var second = ini2.charAt(0);
                var1 = $("#firma12").attr("value", first + second);
                var1 = $("#firma12").attr("style",
                    "font-family:'cherolina';  font-size: 26px;font-weight:bolder;background-color:white!important;border:none;border-bottom:1px solid black;width:60%;background:#d3cccc;cursor:pointer;"
                    );

            })
            break;
            
        case '4':
            document.querySelector('input[name=firma13]').className = 'firma';

            let firmado4= document.getElementById("confirmacion1").checked="checked";
            let check4=document.getElementById("check3").checked="checked";
            $(document).on("click", "#firma13", function() {
                var ini1 = $('#ini1').val();
                var ini2 = $('#ini2').val();


                var first = ini1.charAt(0);
                var second = ini2.charAt(0);
                var1 = $("#firma13").attr("value", first + second);
                var1 = $("#firma13").attr("style",
                    "font-family:'cherolina';    margin-top: -14px; font-size: 26px;font-weight:bolder;background-color:white!important;border:none;border-bottom:1px solid black;width:60%;background:#d3cccc;cursor:pointer;"
                    );

            })
            break;
    }
});
</script>