<!-- Large modal -->
<?php


?>
<div id="modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="table-wrapper">
                <table class="responsive" id="datatable">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Fecha de firma</th>
                            <th>Firmantes</th>
                            <th>Estado</th>
                            <th>Descargar</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

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
    </script>
</div>