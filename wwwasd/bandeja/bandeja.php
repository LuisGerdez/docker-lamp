<?php

use PhpOffice\PhpSpreadsheet\Calculation\TextData\Concatenate;

include '../conexion.php';
$numero_documento = $_SESSION['cedula_usuario'];

//LA VISTA DE LA TABLA CON ACTIVO E INACTIVO
function traerDatos($int)
{
    $correo_usuario = $_SESSION['correo_usuario'];
    include "../conexion.php";
    $datos = mysqli_query(
        $link,
        "SELECT DISTINCT documento.doc_nombre,documento.doc_fechac,documento.doc_horac,
        documento.doc_estado,detalledocumento.codigo_verificacion,detalledocumento.det_docume,
        detalledocumento.det_cordes,detalledocumento.link_firma,detalledocumento.det_usuari,detalledocumento.det_firma,detalledocumento.estado_firma_destinatario_modal
        FROM detalledocumento
        INNER JOIN documento ON documento.doc_id=detalledocumento.det_docume
        WHERE detalledocumento.det_cordes='$correo_usuario' AND doc_estado='Pendiente' AND det_firma = '0' AND link_firma IS NOT NULL 
        ORDER BY doc_fechac DESC, doc_horac DESC",


    );

    // AND detalledocumento.det_usuari=NULL
    mysqli_close($link);

    return $datos;
}

function modal()
{
    include './btn_modal.php';
    return  $boton;
}
function iterarDatos($data)
{

    $modal = modal();
    $lines = '';
    while ($row = mysqli_fetch_array($data)) {
        $lines .= "<tr>
        <td data-parent='Nombre documento' class='width'>" . $row['doc_nombre'] . "</td>
        <td data-parent='Fecha de documento'>" . $row['doc_fechac'] . "</td>
        <td data-parent='Hora de documento'>" . $row['doc_horac'] . "</td>
        <td data-parent='codigo_verificacion'>";
        // Condicion para documentos
        if ($row['det_firma'] == 0 && $row['codigo_verificacion'] == 0) {
            $lines .= "<a  href=" . $row['link_firma'] . " target='__blank'><button class='fl-button' style='border-radius:50%;border:none;padding-bottom: 3px;'><img title='Firmar documento' src='./../bandejaview/img/flecha.png'></button></a></td></tr>";
        }
        // Condicion para documentos
        else if ($row['estado_firma_destinatario_modal'] == 'Pendiente2' && $row['codigo_verificacion'] != 0) {
            $lines .= $modal . "<input type='hidden' name='cod_otp' value='" . $row['det_docume'] . "'></td></tr>";
        } // Condicion para documentos
        else if ($row['codigo_verificacion'] != 0 && $row['estado_firma_destinatario_modal'] == 'no_pendiente2') {
            $lines .= "<a href=" . $row['link_firma'] . " target='__blank'><button class='fl-button' style='border-radius:50%;border:none;padding-bottom: 3px;'><img title='Firmar documento' src='./../bandejaview/img/flecha.png'></button></a></td></tr>";
        }
    }
    return $lines;
}
$documentos_suscriptores = traerDatos($numero_documento);
$lines = iterarDatos($documentos_suscriptores);
?>
<script type='text/javascript'>
    // JavaScript anonymous function
    (() => {
        if (window.localStorage) {

            // If there is no item as 'reload'
            // in localstorage then create one &
            // reload the page
            if (!localStorage.getItem('refresh')) {
                localStorage['refresh'] = true;
                window.location.reload();
            } else {

                // If there exists a 'reload' item
                // then clear the 'reload' item in
                // local storage
                localStorage.removeItem('refresh');
            }
        }
    })(); // Calling anonymous function here only
</script>
<?php if (!empty($lines)) : ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<div id='back'>
    <div class="table-wrapper">
    <img src="../bandejaview/img/lupa.png" alt="" srcset="" id="lupa">
        <table class="fl-table" id="datatable">
            <thead>
                <tr>
                    <th class="thead" style="width:315px;">Nombre documento</th>
                    <th class="thead">Fecha de documento</th>
                    <th class="thead">Hora de documento</th>
                    <th class="thead" id="btnfirmar">Firmar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo $lines;
                ?>
            </tbody>
        </table>
    </div>
<?php elseif (empty($lines) && $_SESSION['rol']==3):?>
    <script>
        if (window.confirm('No tiene documentos por firmar, se cerrará la sesión.')) {
            window.location.replace("../cerrar_sesion.php");
        }
    </script>
<?php else : ?>
    <div class="container-title">
        <h1>
            No hay documentos pendientes por firmar
        </h1>
    </div>
<?php endif ?>
<script>
    $(document).ready(function() {
        $(document).on("click", "#nextobj", function() {
            var id = $(this).next().val();
            var cod_otp = $("#cod_otp").attr("value", id);

        })
    })
</script>