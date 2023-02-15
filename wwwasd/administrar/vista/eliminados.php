<?php
include('../controller/tablesController.php');
@session_start(['name' => 'SITI']);


$datos = traerDatosDocumentos($_SESSION['codigo_usuario'], 'Devuelto');
$lines = iterarDatosDocumentos($datos);

?>

<body>
<h3 style="text-align: center;">LISTADO DE DOCUMENTOS DEVUELTOS</h3>
    <div class="table-wrapper">
        <table class="responsive" id="datatable">
            <thead>
                <tr>
                    <th>Documento</th>
                    <th style="width: 15%;">Fecha de envio</th>
                    <th>Devuelto por</th>
                    <th>Estado</th>
                    <th>Observacion</th>
                    <th style="width:25%;">Descargar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo $lines;
                ?>
            </tbody>
        </table>
    </div>

    



   
</body>
