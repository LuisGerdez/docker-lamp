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
                    <div class="formulario-subtitulo"><b style="text-decoration-line: underline; text-underline-offset: 3px;">CONTRATO DE VEHÍCULO</b></div>

                    <div class="formulario-subtitulo"><b>VENDEDOR</b></div>
        			<div class="datos-formulario">
                        <div><p>Vendedor</p><input type="text" name="vendedor" autocomplete="off" autofocus required></div>
                        <div><p>Identificacion</p><input type="number" name="identificacion_vendedor" autocomplete="off" required></div>
                        <div><p>Direccion</p><input type="text" name="direccion_telefono_vendedor" autocomplete="off" required></div>
                        <div><p>Ciudad</p><input type="text" name="ciudad_vendedor" autocomplete="off" required></div>
                    </div>
                    <div class="datos-formulario">
                        <div><p>Telefono</p><input type="number" name="telefono_vendedor" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>COMPRADOR</b></div>
                    <div class="datos-formulario">
                        <div><p>Comprador</p><input type="text" name="comprador" autocomplete="off" required></div>
                        <div><p>Identificacion</p><input type="number" name="identificacion_comprador" autocomplete="off" required></div>
                        <div><p>Direccion</p><input type="text" name="direccion_telefono_comprador" autocomplete="off" required></div>
                        <div><p>Ciudad</p><input type="text" name="ciudad_comprador" autocomplete="off" required></div>
                    </div>
                    <div class="datos-formulario">
                        <div><p>Telefono</p><input type="number" name="telefono_comprador" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>DATOS VEHICULO</b></div>
                    <div class="datos-formulario">
                        <div><p>Placa</p><input type="text" name="placa" autocomplete="off" required></div>
                        <div><p>Marca</p><input type="text" name="marca" autocomplete="off" required></div>
                        <div><p>Linea</p><input type="text" name="linea" autocomplete="off" required></div>
                        <div><p>Modelo</p><input type="number" name="modelo" autocomplete="off" required></div>
                    </div>
                    <div class="datos-formulario">
                        <div><p>Cilindrada</p><input type="text" name="cilindrada" autocomplete="off" required></div>
                        <div><p>Color</p><input type="text" name="color" autocomplete="off" required></div>
                        <div><p>Servicio</p><input type="text" name="servicio" autocomplete="off" required></div>
                        <div><p>Clase de vehiculo</p><input type="text" name="clase" autocomplete="off" required></div>
                    </div>
                    <div class="datos-formulario">
                        <div><p>Carroceria</p><input type="text" name="carroceria" autocomplete="off" required></div>
                        <div><p>Combustible</p><input type="text" name="combustible" autocomplete="off" required></div>
                        <div><p>Capacidad: kilos - pas</p><input type="number" name="capacidad" autocomplete="off" required></div>
                        <div><p>No. Motor</p><input type="text" name="motor" autocomplete="off" required></div>
                    </div>
                    <div class="datos-formulario">
                        <div><p>No. Chasis</p><input type="text" name="chasis" autocomplete="off" required></div>
                        <div><p>Fecha matricula</p><input type="date" name="fecha_matricula" autocomplete="off" required></div>
                        <div><p>Vin</p><input type="text" name="vin" autocomplete="off" required></div>
                        <div><p>Dec. Importac</p><input type="number" name="importacion" autocomplete="off" required></div>
                    </div>
                    <div class="datos-formulario">
                        <div><p>Fecha declaración</p><input type="date" name="fecha" autocomplete="off" required></div>
                        <div><p>Org. Transito</p><input type="text" name="transito" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>VALOR VEHICULO</b></div>
                    <div class="datos-formulario">
                        <div><p>Precio en letras</p><input type="text" name="precio_letras" autocomplete="off" required></div>
                        <div><p>Precio en numeros</p><input type="text" name="precio_numeros" autocomplete="off" required></div>
                    </div>
                    <div class="formulario-subtitulo"><b>FORMA DE PAGO</b></div>
                    <div class="datos-formulario">
                        <div><p>Forma de pago</p><input type="text" name="forma_pago" autocomplete="off" required></div>
                        <input type="hidden" name="formulario_plantilla" value="true">
                        <input type="hidden" name="nombreArchivo" value="compraventa_vehiculo.pdf">
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
