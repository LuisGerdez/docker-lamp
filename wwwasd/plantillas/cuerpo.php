<?php
/*
*   Software development: Ing. Bernabe Sanchez Lenis
*   líneas de código: 38 - 66
*/
$codigo_usuario = $_SESSION['codigo_usuario'];

include "../Models/CSRFToken.php";

?>
<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<form action="../destinatariosview/index.php" method="post" id="formCheckBox">
    <input type="hidden" name="tokenCSRF" id="tokenCSRF">


    <div class="backtemplate col-md-12">

        <div class="col-md-10 contPlantillas">

            <div class="col-md-12" id="title">

                <p id="styleOrder">Ordenar plantillas</p>
                <img id="order-button" src="./img/flecha-hacia-abajo-para-navegar.png" alt="" srcset="">

                <div class="contSearch col-md-3">
                    <img src="./img/lupa.png" style="  position: absolute;padding: 6px;margin-left: 21.5%;cursor:pointer;" alt="" srcset="">
                    <input type="text" name="search" id="search" class="col-md-12" style="font-style:italic;" placeholder="Buscar plantilla...">

                </div>

            </div>

            <div class="col-md-12 contContenido">
                <!-- <div class="col-md-12">
                    <h3 style="color:black;margin-left:30%;">No hay plantillas para mostrar!</h3>

                </div> -->

                <!-- - #template -->
                <div class="contTemplate list-items col-md-2 ">
                    <div class="col-md-12 contTexto">
                        <img class="imgSave" src="./img/marcador.png" alt="" srcset="">
                        <p class="texto"> TRADE IN</p>

                    </div>
                    <div class="col-md-12">
                        <input type="checkbox" name="plantilla[]" value="1" id="" class="check">
                    </div>
                </div>
                <!-- #2template -->
                <div class="contTemplate list-items col-md-2 ">
                    <div class="col-md-12 contTexto">
                        <img class="imgSave" src="./img/marcador.png" alt="" srcset="">
                        <p class="texto">FACTURA VENTA</p>
                    </div>
                    <div class="col-md-12">
                        <input type="checkbox" name="plantilla[]" value="2" id="" class="check">
                    </div>
                </div>
                <!-- #3template -->
                <div class="contTemplate list-items col-md-2 ">
                    <div class="col-md-12 contTexto">
                        <img class="imgSave" src="./img/marcador.png" alt="" srcset="">
                        <p class="texto">PAGO DE VEHICULO "TRADE IN"</p>
                    </div>
                    <div class="col-md-12">
                        <input type="checkbox" name="plantilla[]" value="3" id="" class="check">
                    </div>
                </div>
                <!-- #4template -->
                <div class="contTemplate list-items col-md-2 ">
                    <div class="col-md-12 contTexto">
                        <img class="imgSave" src="./img/marcador.png" alt="" srcset="">
                        <p class="texto"> ESTIMADO/QUOTE</p>
                    </div>
                    <div class="col-md-12">
                        <input type="checkbox" name="plantilla[]" value="4" id="" class="check">
                    </div>
                </div>
                <!-- #5template -->
                <div class="contTemplate list-items col-md-2 ">
                    <div class="col-md-12 contTexto">
                        <img class="imgSave" src="./img/marcador.png" alt="" srcset="">
                        <p class="texto"> COMPROMISO DE PAGO DE MULTAS</p>
                    </div>
                    <div class="col-md-12">
                        <input type="checkbox" name="plantilla[]" value="5" id="" class="check">
                    </div>
                </div>
                <!-- #6template -->
                <div class="contTemplate list-items col-md-2 ">
                    <div class="col-md-12 contTexto">
                        <img class="imgSave" src="./img/marcador.png" alt="" srcset="">
                        <p class="texto"> RECIBO DE PAGO/PRONTO</p>
                    </div>
                    <div class="col-md-12">
                        <input type="checkbox" name="plantilla[]" value="6" id="" class="check">
                    </div>
                </div>
                <!-- #7template -->
                <div class="contTemplate list-items col-md-2 ">
                    <div class="col-md-12 contTexto">
                        <img class="imgSave" src="./img/marcador.png" alt="" srcset="">
                        <p class="texto"> DOCUMENTO:GARANTIA</p>
                    </div>
                    <div class="col-md-12">
                        <input type="checkbox" name="plantilla[]" value="7" id="" class="check">
                    </div>
                </div>

                <div class="contTemplate list-items col-md-2 ">
                    <div class="col-md-12 contTexto">
                        <img class="imgSave" src="./img/marcador.png" alt="" srcset="">
                        <p class="texto"> CONTRATO </p>
                    </div>
                    <div class="col-md-12">
                        <input type="checkbox" name="ContratoSuntic" value="ContratoSuntic" id="" class="check">
                    </div>
                       <!-- <a class="btn btn-primary" id="submitButton" href="./tradein_pronto_pago.php">Iniciar</a> -->
                </div>
                <div class="contTemplate list-items col-md-2 ">
                    <div class="col-md-12 contTexto">
                        <img class="imgSave" src="./img/marcador.png" alt="" srcset="">
                        <p class="texto"> CONTRACT</p>
                    </div>
                    <div class="col-md-12">
                        <input type="checkbox" name="condominios" value="8" id="" class="check">
                    </div>
                </div>
            </div>

            <div class="contTemplate col-md-22" style="    border: none;
    margin-left: 40%;
    margin-top: 22%;
    background: none;
    position: fixed;">
                <button onclick="volverAtras();" class="btn btn-primary" type="button" class="buttons">Regresar
                </button>
                <!-- AQUI EJECUTAREMOS LAS ACCIONES DEL FORMULARIO -->
                <button class="btn btn-primary" type="sumbit" id="submitButton">Continuar</button>
            </div>

        </div>


</form>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</div>
<?= CSRFToken::setToken(); ?>
<script>
    const checks = document.querySelectorAll('input[type="checkbox"]');
    const formCheck = document.getElementById('formCheckBox');
    const button = document.getElementById('submitButton');
    const tokenField = document.getElementById('tokenCSRF').value;
    const tokenSession = '<?= $_SESSION['csrf']; ?>';
    const checksArray = Array.from(checks);

    formCheck.addEventListener('submit', (e) => {
        if (tokenField === tokenSession) {
            if (checksArray.some(check => check.checked)) {
                formCheck.submit();
            } else {
                e.preventDefault();
                Swal.fire('Seleccione una plantilla como mínimo para continuar');
            }
        }
    });

    $(document).ready(function() {
        $("#order-button").click(function() {
            // Obtener la lista de elementos a ordenar
            $(".list-items").each(function(index, element) {
                if (index > 0) {
                    $(element).insertBefore($(".list-items").eq(index - 1));
                }
            });
        });

        $("#search").on("keyup", function() {
            var searchValue = $(this).val().toLowerCase();
            var listItems = $(".contContenido").find(".list-items");
            // Recorrer los elementos de la lista
            listItems.each(function() {
                // Obtener el valor de cada elemento
                var itemValue = $(this).text().toLowerCase();;
                // Comparar el valor del elemento con el valor de búsqueda
                if (itemValue.indexOf(searchValue) > -1) {
                    // Mostrar el elemento si cumple la condición
                    $(this).show();
                } else {
                    // Ocultar el elemento si no cumple la condición
                    $(this).hide();
                }
            });
        });



    });

    function volverAtras() {
        window.location.href = "../dashboard/";
    }
</script>