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
                    <div class="formulario-subtitulo"><b style="text-decoration-line: underline; text-underline-offset: 3px;">PROMESA DE CONTRATO DE COMPRAVENTA</b></div>

                    <div class="formulario-subtitulo"><b>PROMITENTE VENDEDOR:</b></div>
        			<div class="datos-formulario">
                        <div><p>Nombre</p><input type="text" name="nombre_prominente" autocomplete="off" autofocus required></div>
                        <div><p>Identificación</p><input type="text" name="identificacion_prominente" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>PROMITENTE COMPRADOR:</b></div>
                    <div class="datos-formulario">
                        <div><p>Nombre</p><input type="text" name="nombre_comprador" autocomplete="off" required></div>
                        <div><p>Identificación</p><input type="text" name="identificacion_comprador" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>DESCRIPCI&Oacute;N DEL INMUEBLE:</b></div>
                    <div class="datos-formulario">
                        <div><p>Descripci&oacute;n</p><input type="text" name="descripcion_inmueble" style="width: 350%;" autocomplete="off" required></div>
                    </div>
                    <div class="datos-formulario">
                        <div><p>Direcci&oacute;n</p><input type="text" name="direccion_inmueble" autocomplete="off" required></div>
                        <div><p>N&uacute;mero de matr&iacute;cula inmobiliaria</p><input type="text" name="matricula_inmobiliaria" autocomplete="off" required></div>
                        <div><p>Precio</p><input type="text" name="precio" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>FORMA DE PAGO</b></div>
                    <div class="datos-formulario">
                        <div><p>Precio inmueble</p><input type="text" name="precio_inmueble" autocomplete="off" required></div>
                        <div><p>Abono inmueble</p><input type="text" name="abono_inmueble" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>NOTARIA</b></div>
                    <div class="datos-formulario">
                        <div><p>Nro notaria</p><input type="text" name="nro_notaria" autocomplete="off" required></div>
                        <div><p>Circulo</p><input type="text" name="circulo" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>INCUMPLIMIENTO</b></div>
                    <div class="datos-formulario">
                        <div><p>Valor en letras</p><input type="text" name="valor_en_letras" autocomplete="off" required></div>
                        <div><p>Valor en n&uacute;meros</p><input type="text" name="valor_en_numeros" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>EL PROMITENTE VENDEDOR</b></div>
                    <div class="datos-formulario">
                        <div><p>Devoluci&oacute;n en letras</p><input type="text" name="devolucion_en_letras_vendedor" autocomplete="off" required></div>
                        <div><p>Devoluci&oacute;n en n&uacute;meros</p><input type="text" name="devolucion_en_numeros_vendedor" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>EL PROMITENTE COMPRADOR</b></div>
                    <div class="datos-formulario">
                        <div><p>Devoluci&oacute;n en letras</p><input type="text" name="devolucion_en_letras_comprador" autocomplete="off" required></div>
                        <div><p>Devoluci&oacute;n en n&uacute;meros</p><input type="text" name="devolucion_en_numeros_comprador" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>CIUDAD</b></div>
                    <div class="datos-formulario">
                        <div><p>Nombre ciudad</p><input type="text" name="nombre_ciudad" autocomplete="off" required></div>
                        <input type="hidden" name="formulario_plantilla" value="true">
                        <input type="hidden" name="nombreArchivo" value="Promesa de compraventa.pdf">
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
