<?php
/*
*   Software development: Ing. Bernabe Sanchez Lenis
*/
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
                    <div class="formulario-subtitulo"><b style="text-decoration-line: underline; text-underline-offset: 3px;">CONTRATO DE PRESTACIÓN DE SERVICIOS</b></div>
        			<div class="datos-formulario">
                        <div><p>No. Contrato</p><input type="text" name="no_contrato" autocomplete="off" autofocus required></div>
                        <div><p>Plazo</p><input type="text" name="plazo" autocomplete="off" required></div>
                        <div><p>Valor</p><input type="number" name="valor" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>DATOS CONTRATANTE</b></div>
        			<div class="datos-formulario">
                        <div><p>Nombre contratante</p><input type="text" name="nombre_contratante" autocomplete="off" required></div>
                        <div><p>Identificación contratante</p><input type="number" name="identificacion_contratante" autocomplete="off" required></div>
                        <div><p>Dirección contratante</p><input type="text" name="direccion_contratante" autocomplete="off" required></div>
                        <div><p>Correo electrónico contratante</p><input type="email" name="correo_electronico_contratante" autocomplete="off" required></div>
                    </div>
                    <div class="datos-formulario">
                        <div><p>Celular contratante</p><input type="number" name="celular_contratante" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>DATOS CONTRATISTA</b></div>
                    <div class="datos-formulario">
                        <div><p>Nombre contratista</p><input type="text" name="nombre_contratista" autocomplete="off" required></div>
                        <div><p>Identificación contratista</p><input type="number" name="identificacion_contratista" autocomplete="off" required></div>
                        <div><p>Ciudad contratista</p><input type="text" name="ciudad_contratista" autocomplete="off" required></div>
                        <div><p>Dirección contratista</p><input type="text" name="direccion_contratista" autocomplete="off" required></div>
                    </div>
                    <div class="datos-formulario">
                        <div><p>Correo electrónico contratista</p><input type="email" name="correo_electronico_contratista" autocomplete="off" required></div>
                        <div><p>Celular contratista</p><input type="number" name="celular_contratista" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>OBJETO DEL CONTRATO</b></div>
                    <div class="datos-formulario">
                        <div><p>Cargo contratista</p><input type="text" name="cargo_contratista" autocomplete="off" required></div>
                        <div><p>Objeto contrato</p><input type="text" name="objeto_contrato" style="width: 330%;" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>FORMA DE PAGO</b></div>
                    <div class="datos-formulario">
                        <div><p>Fecha pago</p><input type="date" name="fecha_pago" autocomplete="off" required></div>
                        <div><p>Forma de pago</p><input type="text" name="forma_de_pago" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>CLÁUSULA COMPROMISORIA</b></div>
                    <div class="datos-formulario">
                        <div><p>Ciudad albitraje 1</p><input type="text" name="albitraje_1" autocomplete="off" required></div>
                        <div><p>Ciudad albitraje 2</p><input type="text" name="albitraje_2" autocomplete="off" required></div>
                        <input type="hidden" name="formulario_plantilla" value="true">
                        <input type="hidden" name="nombreArchivo" value="Contrato de prestación de servicios.pdf">
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
