<?php
@session_start(['name'=>'SITI']);
include_once '../config/APP.php';
$codigo_usuario = $_SESSION['codigo_usuario'];

?>
<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<script>
    function enviarFormulario(){
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
        <LINK REL=StyleSheet HREF="../estilo_principal.css" TYPE="text/css" MEDIA=screen>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    </head>
    <script type="text/javascript">
        function volverAtras(){
            history.go(-1)
        }
    </script>
    <body style="padding: 0; margin: 0; background: #555555;">
        <div class="cuerpo-container">
            <form action="../documentos/index.php" method="post" enctype="multipart/form-data" target="" name="formulario" id="formulario">
                <?php include '../menu.php' ?>
                <div class="datos-container-formulario">
                    <div class="formulario-subtitulo"><b style="text-decoration-line: underline; text-underline-offset: 3px;">PAGARE</b></div>

        			<div class="datos-formulario">
                        <div><p>Numero de pagare</p><input type="text" name="numero" autocomplete="off" autofocus required></div>
                        <div><p>Suscriptor No.</p><input type="text" name="suscriptor" autocomplete="off" required></div>
                        <div><p>Valor deuda por consumos</p><input type="number" name="valor_deuda_consumos" autocomplete="off" required></div>
                        <div><p>Valor deuda por diferidos</p><input type="number" name="valor_deuda_diferidos" autocomplete="off" required></div>
                    </div>
                    <div class="datos-formulario">
                        <div><p>Valor deuda por financiaciones</p><input type="number" name="valor_deuda_financiaciones" autocomplete="off" required></div>
                        <div><p>Valor deuda total</p><input type="number" name="valor_deuda_total" autocomplete="off" required></div>
                        <div><p>Cuota inicial</p><input type="number" name="cuota_inicial" autocomplete="off" required></div>
                        <div><p>Plazo en meses</p><input type="number" name="plazo_meses" autocomplete="off" required></div>
                    </div>
                    <div class="datos-formulario">
                        <div><p>Cuota(s) mensual(es)</p><input type="number" name="cuota_mensual" autocomplete="off" required></div>
                        <div><p>Deudor</p><input type="text" name="deudor" autocomplete="off" required></div>
                        <div><p>Identificacion</p><input type="text" name="identificacion" autocomplete="off" required></div>
                        <div><p>Telefono</p><input type="number" name="telefono" autocomplete="off" required></div>
                    </div>
                    <div class="datos-formulario">
                        <div><p>Cuotas restantes</p><input type="number" name="cuota_restante" autocomplete="off" required></div>
                    </div>
                    <div class="datos-formulario">
                        <input type="hidden" name="formulario_plantilla" value="true">
                        <input type="hidden" name="nombreArchivo" value="pagare_a_la_orden.pdf">
                    </div>
                    <div class="cuerpo-botones">
                        <button type="button" title="volver" onclick="volverAtras();"><i class="fas fa-arrow-left"></i>Volver</button>
                        <button title="siguiente" type="submit" name="siguiente">Siguiente<i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
