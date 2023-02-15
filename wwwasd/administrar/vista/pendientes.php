<?php
include('../controller/tablesController.php');

@session_start(['name' => 'SITI']);

// $_SESSION['codigo_usuario'] = 1;

$datos = traerDatosDocumentos($_SESSION['codigo_usuario'],'Pendiente');
$lines = iterarDatosDocumentos($datos);


if (isset($_POST['descargar'])) {
    descargarDocumento($options, $_POST['descargar']);
}


?>
<body>
    <div class="table-wrapper">
        <table class="responsive" id="datatable">
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Destinatarios</th>
                    <th>Estado</th>
                    <th >Descargar</th>
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
