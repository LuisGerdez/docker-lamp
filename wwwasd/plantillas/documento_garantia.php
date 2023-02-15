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
                    <div style="padding-top:10%;" class="col-md-12">
                        <div class="col-md-4" style="float:left;">
                            <img id="imggarantia" src="img/Logo.png" alt="" srcset="">
                        </div>
                        <br>
                        <br>
                        <div style="text-align:left;float:right;" class="col-md-7">
                            <small><b>Auto1pr.com</b></small>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div style="border-top:2px solid black;d-flex justify-content-start col-md-12"
                        class="text-center col-md-12">
                        <h4>INFORMACIÓN SOBRE GARANTIA Y CONDICIONES PARA EL VEHICULO</h4>
                    </div>
                    <div class="d-flex justify-content-start col-md-12">
                        <div class="col-md-3">
                            <table>
                                <tr>
                                    <td><input name="garamarca" class="inputstitles" type="text"></td>
                                </tr>
                                <tr>
                                    <td style="">Marca</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <table>
                                <tr>
                                    <td><input name="garamodelo"class="inputstitles" type="text"></td>
                                </tr>
                                <tr>
                                    <td style="">Modelo:</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <table>
                                <tr>
                                    <td><input class="inputstitles" name="garaaño" type="text"></td>
                                </tr>
                                <tr>
                                    <td style="">Año:</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <table>
                                <tr>
                                    <td><input name="garaserie"class="inputstitles" type="text"></td>
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
                                    <td><input name="garainventario"class="inputstitles" type="text"></td>
                                </tr>
                                <tr>
                                    <td style="">Número de inventario</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <table>
                                <tr>
                                    <td><input name="garamillaje"class="inputstitles" type="text"></td>
                                </tr>
                                <tr>
                                    <td style="">Millage:</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <table>
                                <tr>
                                    <td><input name="garatablilla"class="inputstitles" type="text"></td>
                                </tr>
                                <tr>
                                    <td style="">Tablilla:</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <h3>Precio:</h3>
                            <input style="border:none;background:#d3cccc;" type="number" name="garaprecio" id="">
                        </div>


                    </div>
                    <div style="border-top:2px solid black;" class="col-md-12">
                        <h5>GARANTIAS PARA ESTE VEHICULO</h5>
                        <input   class="only-one" type="checkbox" value='1'name="check[]" id=""> <label for=""> 2 meses o dos mil millas, lo
                            primero que ocurra. (Mas de 50,000 millas y hasta 100,000 millas)</label>
                        <br>
                        <input   class="only-one" type="checkbox" value='2'name="check[]" id=""> <label for=""> 3 meses o tres mil millas, lo
                            primero que ocurra. (Mas de 36,000 millas y hasta 50,000 millas)</label>
                        <br>
                        <input   class="only-one" type="checkbox"value='3' name="check[]" id=""> <label for=""> 4 meses o cuatro mil millas, lo
                            primero que ocurra. (Hasta 36,000 millas)</label>
                        <br>
                        <input   class="only-one" type="checkbox" value='4'name="check[]" id=""> <label for=""> 100,000 mil millas en adelante no
                            tiene garantìa. (No tiene garantìa)</label>
                    </div>
                    <div style="border-top:2px solid black;" class="col-md-12">
                        <h5>PARTES INCLUIDAS SEGÙN REGLAMIENTO DE D.A.C.O</h5>
                        <p>
                            <small>
                                <b>A) MOTOR</b> -incluye todas las piezas internas del motor incluyendo bomba de
                                agua, bomba de gasolina (mecànicao elèctrica), multiple adminisiòn y escape, bloque y
                                volanta. En motores rotativos incluye las cajas de los rotores. Se excluyen piezas de
                                servicio normal de mantenimiento que requieran cambios periodicos y su respectiva mano
                                de obra.
                                <br>
                                <b>B) TRANSMISIÒN</b> -incluye caja de transmisiòn, todas las piezas internas de las
                                transmisiòn y el convertidor de torsiòn.
                                <br>
                                <b>C) SISTEMA ELECTRICO</b> -Alternador,generador, motor de arranque y sistema de
                                ignición. No incluye bateria, bombillas ni piezas de cambio periodico.
                                <br>
                                <b>D) SISTEMA ELECTRÒNICO</b> -incluye computadora y sus accesorios.
                                <br>
                                <b>E) EJE IMPULSOR</b> -Caja de tracciòn trasera y/o delantera, segun aplique, con sus
                                partes internas, ejes impulsores,
                                eje del cardan y uniones transversales.
                                <br>
                                <b>F) FRENOS</b> -cilindros traseros, bomba de frenos, servo asistencia de vacio, lineas
                                y acoplamientos hidraulicos y calibrados de discos. Se excluyen piezas de servicios
                                normal de mantenimiento que requieran cambios periodicos y su respectiva mano de obra.
                                <br>
                                <b>G) RADIADOR Y ABANICO DEL RADIADOR</b>
                                <br>
                                <b>H) DIRECCIÓN -La caja de guia y sus partes internas (rack & pinion)</b>
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
                                garantía (a) Podría perder su derecho si el vehiculo de referencia sufrio un impacto
                                el cual ocasionara daño a la unidad, (b) Alteraciones al vehículo posterior a la
                                compra
                                , (c) Que la unidad sea intervenida mécanicamente previo a la evaluación profesional
                                a la cual usted tiene derecho a recibir de nuestro departamento de servicio.
                                <br>
                                - Proveerá una unidad sustituida; si la reparación de la unidad vendida y en
                                garantía permaneceriera más de (5)días calendario, sin incluir Domingo.
                                <br>
                                - La garantía de su vehículo será transferida a cualquier consumidor subsiguiente
                                sin costo alguno por el tiempo o millaje restante.
                            </small>
                        </p>
                    </div>
                    <div style="border-top:2px solid black;col-md-12" class="col-md-12">
                        <h5>NOTAS IMPORTANTES AL CONSUMIDOR</h5>
                    </div>
                    <div style="" class="d-flex justify-content-start col-md-12">
                        <div class="col-md-8">
                            <p>
                                <small>
                                    1. Leo y certifico que he sido responsablemente orientado y se me han msotrado los
                                    labels o etiquetas de las partes del vehículo de esta transacción.
                                </small>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label style="padding-right:5px;">INICIALES</label><input
                            readonly style="border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;"
                                type="text" name="usu_name">
                        </div>
                    </div>
                    <div style="" class="d-flex justify-content-start col-md-12">
                        <div class="col-md-8">
                            <p>
                                <small>
                                    2. Certifico haber sido orientado; que este vehículo pudo haber requerido trabajos de hojalateria y pintura con la intención de optimizarlo.
                                </small>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label style="padding-right:5px;">INICIALES</label><input
                            readonly style="border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;"
                                type="text" name="usu_name">
                        </div>
                    </div>
                    <div style="" class="d-flex justify-content-start col-md-12">
                        <div class="col-md-8">
                            <p>
                                <small>
                                    3. Certifico que he recibido copia del REGLAMENTO DE GARANTIAS DE VEHCULOS DE MOTOR el cual servirá con guía informativa. 
                                </small>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label style="padding-right:5px;">INICIALES</label><input
                            readonly style="border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;"
                                type="text" name="usu_name">
                        </div>
                    </div>
                    <div style="" class="d-flex justify-content-start col-md-12">
                        <div class="col-md-8">
                            <p>
                                <small>
                                    4. Certifico que he sido informado que el vehículo aquí vendido proviene del uso anteriores en carácter de (Rental Car).
                                    Si <input class="only-one2" name="confirmacion[]"style="background:#d3cccc;" value="1" type="checkbox">No 
                                     <input class="only-one2" name="confirmacion[]"style="background:#d3cccc;"value="2"type="checkbox">
                                </small>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label style="padding-right:5px;">INICIALES</label><input
                               readonly style="border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;"
                                type="text" name="usu_name">
                        </div>
                    </div>
                    <div class="datos-formulario">
                        <input type="hidden" name="formulario_plantilla" value="true">
                        <input type="hidden" name="nombreArchivo" value="documentogarantia.pdf">
                    </div>
                </div>
            </div>


    </div>
    <div class="cuerpo-botones">
        <button type="button" title="volver" onclick="volverAtras();"><i class="fas fa-arrow-left"></i>Volver</button>
        <button title="siguiente" type="submit" name="siguiente">Siguiente<i class="fas fa-arrow-right"></i></button>
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
        for (let CheckBox of document.getElementsByClassName('only-one')){
            CheckBox.onclick = function(){
            if(Checked!=null){
            Checked.checked = false;
            Checked = CheckBox;
            }
            Checked = CheckBox;
        }
        }
        // inputs de abajo
        let Checked2 = null;
        for (let CheckBox of document.getElementsByClassName('only-one2')){
            CheckBox.onclick = function(){
            if(Checked2!=null){
            Checked2.checked = false;
            Checked2 = CheckBox;
            }
            Checked2 = CheckBox;
        }
        }
    </script>


</footer>

</html>