<?php
include('../controller/tablesController.php');
@session_start(['name' => 'SITI']);

$datos = traerDatosDocumentos($_SESSION['codigo_usuario'], 'Firmado', $_SESSION['correo_usuario']);
$lines = iterarDatosDocumentos($datos);

?>

<body>
<h3 style="text-align: center;">LISTADO DE DOCUMENTOS FIRMADOS</h3>
    <div class="table-wrapper">
        <table class="responsive" id="datatable">
            <thead>
                <tr>
                    <th>Documento</th>
                    <th style="width: 15%;">Fecha de firma</th>
                    <th>Firmantes</th>
                    <th>Estado</th>
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
<?php
include_once 'modalmover.php';
?>
<script>
$(document).ready(function() {

    $(document).on("click", "#mover", function() {
        let id = $(this).val();
        $.ajax({
            type: "POST",
            url: "../controller/CarpetasmoverController.php",
            data: "id=" + id,
            success: function(response) {

                $("#modalmover").modal("show");

                $("#contmover").html(response);
            },
        })

    });
});
</script>
