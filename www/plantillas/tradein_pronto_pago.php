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
        <form action="../ControllerVista/ControllerVista.php" method="post" enctype="multipart/form-data" target=""
            name="formulario" id="formulario">
            <?php include '../menu.php' ?>
            <br>
            <div class="datos-container-formulario">
                <div id="divcolor" class="x_panel col-md-8">
                    <div class="col-md-12 text-center" style="padding-top:3%;">
                        <small><b><u>CONTRATO INDIVIDUAL DE TRABAJO A TERMINO INDEFINIDO</u></b></small>
                    </div>
                    <p></p>
                    <div class="col-md-12">
                        <table>
                            <tr>
                                <td>DATOS DEL EMPLEADOR</td>
                                <td style="padding-left: 5%;">NOMBRE DEL EMPLEADOR: <input
                                        style="border:none;border-bottom:1px solid black;width:40%;background:#d3cccc;"
                                        type="text" name="0"><br><br>
                                    NIT:<input
                                        style="border:none;border-bottom:1px solid black;width:40%;background:#d3cccc;"
                                        type="number" name="1"><br><br>
                                    REPRESENTANTE LEGAL:<input
                                        style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;"
                                        type="text" name="2"><br><br>DIRECCIÒN:<input
                                        style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;"
                                        type="text" name="3"><br><br>CIUDAD:<input
                                        style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;"
                                        type="text" name="4"></td>
                            </tr>
                            <tr>
                                <td>DATOS DEL TRABAJADOR</td>
                                <td style="padding-left: 5%;">NOMBRE DEL EMPLEADO:<input
                                        style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;"
                                        type="text" name="5"><br><br>
                                    DOCUMENTO DE IDENTIDAD:<input
                                        style="border:none;border-bottom:1px solid black;width:40%;background:#d3cccc;"
                                        type="number" name="6">.<br><br> NO.<input
                                        style="border:none;border-bottom:1px solid black;width:40%;background:#d3cccc;"
                                        type="number" name="7"><br><br>CARGO A DESEMPEÑAR:<input
                                        style="border:none;border-bottom:1px solid black;width:20%;background:#d3cccc;"
                                        type="text" name="8">
                                </td>
                            </tr>
                            <tr>
                                <td>DATOS GENERALES DEL CONTRATO</td>
                                <td style="padding-left: 5%;">SALARIO:<input
                                        style="border:none;border-bottom:1px solid black;width:40%;background:#d3cccc;"
                                        type="text" name="9"><br><br>
                                    FORMA DE PAGO:<input
                                        style="border:none;border-bottom:1px solid black;width:40%;background:#d3cccc;"
                                        type="text" name="10"><br><br>
                                    FECHA DE INGRESO:<input
                                        style="border:none;border-bottom:1px solid black;width:40%;background:#d3cccc;"
                                        type="text" name="11"><br><br>CIUDAD DE EJECUCIÒN:<input
                                        style="border:none;border-bottom:1px solid black;width:40%;background:#d3cccc;"
                                        type="text" name="12"></td>
                            </tr>
                        </table>
                        <p></p>
                        <p>Entre el empleador y trabajador, ambas mayores de edad, identificados como ya se anotó, se
                            suscribe</p>
                        <p> DE TRABAJO A TERMINO INDEFINIDO, regido por las siguientes cláusulas:
                            PRIMERA: OBJETO: El
                        <p>empleador contrata los servicios personales del TRABAJADOR para
                            desempeñar el cargo de </p><input
                            style="border:none;border-bottom:1px solid black;width:20%;background:#d3cccc;" type="text"
                            name="13"></p>

                        <div class="col-md-12" style="padding-bottom:10%;"></div>
                    </div>
                </div>
                <div id="divcolor" class="x_panel col-md-8">
                    <div class="col-md-12 text-center" style="padding-top:8%;">
                    </div>
                    <div class="col-md-12" style="text-align:justify;">
                        <p>
                            <b>SEGUNDA: DURACION:</b> Término del contrato. El presente contrato tendrá una duración
                            indefinida,
                            pero podrá darse por terminado por cualquiera de las partes, cumpliendo con las exigencias
                            legales al respecto.
                        </p>
                        <p> <b>TERCERA: RESPONSABILIDADES Y FUNCIONES:</b><br>
                        <ol>
                            <li> Poner al servicio de SUNTIC S.A.S. toda su capacidad normal de trabajo, en el desempeño
                                de
                                las funciones propias del oficio mencionado y en las laborales anexas y complementarias
                                del
                                mismo, de conformidad con las órdenes e instrucciones que le imparta SUNTIC S.A.S
                                directamente o
                                a través de sus representantes.
                            </li>
                            <li>Guardar absoluta reserva sobre los hechos, documentos físicos y/o electrónicos,
                                informaciones
                                y en general, sobre todos los asuntos y materias que lleguen a su conocimiento por causa
                                o con
                                ocasión de su contrato de trabajo
                            </li>

                            <li>Ejecutar por si mismo las funciones asignadas y cumplir estrictamente las instrucciones
                                que
                                le sean dadas por la empresa o por quienes la representen respecto del desarrollo de sus
                                actividades
                            </li>
                            <li> Cuidar permanentemente los intereses del empleador </li>
                            <li> Dedicar la totalidad de la jornada laboral pactada y cumplir a cabalidad con sus
                                funciones</li>
                            <li>Observar completa armonía y comprensión con los clientes con sus superiores, compañeros
                                de
                                trabajo en sus relaciones personales y en la ejecución de su labor</li>
                            <li> Cumplir permanentemente con el espíritu de lealtad, colaboración y disciplina con el
                                empleador
                            </li>
                            <li>Avisar oportunamente y por escrito cualquier cambio de su dirección teléfono o ciudad de
                                residencia </li>
                            <li>En relación con la labor de <input
                                    style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;"
                                    type="text" name="14"> deberá, sin limitarse a ellas, realizar las
                                actividades que permitan llevar en orden y perfecta ejecución las responsabilidades del
                                cargo,
                                mismas que se encuentran pactadas en documento adjunto al presente contrato y que hace
                                parte
                                integral del mismo. </li>
                        </ol>





                        </p>
                    </div>
                </div>
                <div id="divcolor" class="x_panel col-md-8">
                    <div class="col-md-12 text-center" style="padding-top:8%;">
                        <div class="col-md-12" style="text-align:justify;">

                            <p>
                                <b>CUARTA:</b> Lugar.
                                EL TRABAJADOR desarrollará sus funciones de <input
                                    style="border:none;border-bottom:1px solid black;width:40%;background:#d3cccc;"
                                    type="text" name="15"> en <input
                                    style="border:none;border-bottom:1px solid black;width:40%;background:#d3cccc;"
                                    type="text" name="16"> en las
                                dependencias o el lugar que la empresa determine, pudiendo incluso ser en distintas
                                sedes
                                dentro de la ciudad. Cualquier modificación del lugar de trabajo, que signifique cambio
                                de
                                ciudad, se hará conforme al Código Sustantivo de Trabajo.
                            </p>
                            <p>
                                <b>
                                    QUINTA:
                                </b>
                                Elementos de trabajo. Corresponde al empleador suministrar los elementos necesarios
                                para el normal desempeño de las funciones del cargo contratado.
                            </p>
                            <p>
                                <b>SEXTA:</b>

                                Periodo de prueba: Acuerdan las partes fijar como periodo de prueba de <input style="border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;"
                                    type="number" name="17"> meses
                                contados a partir de la firme del contrato.
                            </p>

                            <p>
                                <b>
                                    SEPTIMA:</b>
                                Justas causas para terminar el contrato: Se dará por terminado el contrato con
                                justa causa ante el cumplimiento de la labor definida en el objeto del presente
                                contrato.
                                Además, son justas causas para dar por terminado unilateralmente el presente contrato
                                por
                                cualquiera de las partes, el incumplimiento a las obligaciones y prohibiciones que se
                                expresan en los artículos 57 y siguientes del Código sustantivo del Trabajo. Además del
                                incumplimiento o violación a las normas establecidas en el (Reglamento Interno de
                                Trabajo,
                                Higiene y de Seguridad) y las previamente establecidas por el empleador o sus
                                representantes.
                            </p>
                            <p>

                                <b> OCTAVA: </b> Salario. El empleador cancelará al trabajador(a) un salario mensual de
                                <input style="border:none;border-bottom:1px solid black;width:35%;background:#d3cccc;"
                                    type="text" name="18"> ($<input
                                    style="border:none;border-bottom:1px solid black;width:35%;background:#d3cccc;"
                                    type="number" name="19">) pagaderos en el lugar de trabajo, dentro de los
                                cinco (5)
                                primeros días de cada mes vencido día. Dentro de este pago se encuentra incluida la
                                remuneración de los descansos dominicales y festivos de que tratan los capítulos I y II
                                del
                                título VII del Código Sustantivo del Trabajo.
                            </p>
                            <p>

                                <b>NOVENA:</b> Trabajo extra, en dominicales y festivos. El trabajo suplementario o en
                                horas
                                extras, así como el trabajo en domingo o festivo que correspondan a descanso, al igual
                                que los nocturnos, será remunerado conforme al código laboral. Es de advertir que dicho
                                trabajo debe ser autorizado u ordenado por el empleador para efectos de su
                                reconocimiento. Cuando se presenten situaciones urgentes o inesperadas que requieran la
                                necesidad de este trabajo suplementario, se deberá ejecutar y se dará cuenta de ello por
                                escrito, en el menor tiempo posible al jefe inmediato, de lo contrario, las horas
                                laboradas de manera suplementaria que no se autorizó o no se notificó no será
                                reconocido.
                            </p>
                        </div>
                    </div>
                </div>
                <div id="divcolor" class="x_panel col-md-8">
                    <div class="col-md-12 text-center" style="padding-top:8%;">
                        <div class="col-md-12" style="text-align:justify;">
                            <p>
                               <b> DÉCIMA:</b> Horario. EL TRABAJADOR se obliga a laborar la jornada ordinaria en los turnos y
                                dentro de las horas señaladas por el empleador, pudiendo hacer éste ajustes o cambios de
                                horario cuando lo estime conveniente. Por el acuerdo expreso o tácito de las partes,
                                podrán repartirse las horas jornada ordinaria de la forma prevista en el artículo 164
                                del Código Sustantivo del Trabajo, modificado por el artículo 23 de la Ley 50 de 1990,
                                teniendo en cuenta que los tiempos de descanso entre las secciones de la jornada no se
                                computan dentro de la misma, según el artículo 167 ibídem.</p>

                                <p> <b> DECIMA PRIMERA:</b> Afiliación y pago a seguridad social. Es obligación del empleador
                                afiliar al trabajador a la seguridad social como es salud, pensión y riesgos
                                profesionales, autorizando el TRABAJADOR el descuento en su salario, los valores que le
                                corresponda aportan, en la proporción establecida por la ley.</p>

                                <p> <b> DECIMA SEGUNDA:</b> Modificaciones. Cualquier modificación al presente contrato debe
                                efectuarse por escrito y anexarse a este documento.</p>

                                <p> <b> DECIMA TERCERA:</b> Efectos. El presente contrato reemplaza y deja sin efecto cualquier otro
                                contrato verbal o escrito, que se hubiera celebrado entre las partes con anterioridad.
                                Se firma por las partes, el <input style="border:none;border-bottom:1px solid black;width:30%;background:#d3cccc;"
                                    type="date" name="20"></p>

                            </p>
                        </div>
                    </div>
                </div>

                <div class="datos-formulario">
                    <input type="hidden" name="formulario_plantilla" value="true">
                    <input type="hidden" name="accion" value="5">
                    <input type="hidden" name="nombreArchivo" value="contrato.pdf">
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
</footer>

</html>