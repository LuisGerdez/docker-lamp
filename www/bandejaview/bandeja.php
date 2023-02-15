<?php
include '../conexion.php';

// Actualizamos la vista solo una unica vez
// Iniciar la sesion.
@session_start();
$correo_usuario = $_SESSION['correo_usuario'];
$numero_documento = $_SESSION['cedula_usuario'];

//LA VISTA DE LA TABLA CON ACTIVO E INACTIVO
function traerDatos($int)
{
    $correo_usuario = $_SESSION['correo_usuario'];
    include "../conexion.php";
    $datos = mysqli_query(
        $link,
    "SELECT DISTINCT
     documento.doc_nombre,documento.doc_fechac, 
     documento.doc_ruta,documento.doc_usuari, 
     documento.doc_horac,documento.doc_id,
     documento.doc_estado,detalledocumento.det_id 
     FROM detalledocumento 
     INNER JOIN documento 
     ON documento.doc_id=detalledocumento.det_docume 
     WHERE detalledocumento.det_cordes='".$correo_usuario."'
     AND det_firma=0 
     ORDER BY doc_fechac DESC,doc_horac DESC"
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
$modal = modal();

function iterarDatos($data)
{
    global $modal;
    $lines = '';
    while ($row = mysqli_fetch_array($data)) {
        $lines .= "<tr>
        <td data-parent='Nombre documento'>" . $row['doc_nombre'] . "</td>
        <td data-parent='Fecha de documento'>" . $row['doc_fechac'] . "</td>
        <td data-parent='Hora de documento'>" . $row['doc_horac'] . "</td>
        <td data-parent='codigo_verificacion'>";
       
        
        if ($row['doc_estado'] == 'Pendiente') {
            $lines .= $modal . "</td></tr>";
            //Este metodo elimina el archivo ya firmado, pero tambien lo elimina antes de firmar si recargamos la pagina
            // deleteCode();
        }  
                // $lines .= "<form action='../ControllerVista/ControllerVista.php?nombreArchivo=".$row['doc_ruta']."' method='POST'><button type='submit' class='fl-button'>Firmar</button><input type='hidden' name='accion' value='3'><input type='hidden' name='codigo_documento' value='" . $row['doc_id'] . "'><input type='hidden' name='trade_id' value='" . $row['trade_id'] . "'><input type='hidden' name='doc_usuari' value='" . $row['doc_usuari'] . "'><input type='hidden' name='codigo_detalle_documento' value='" . $row['det_id'] . "'></form></td></tr>";
        else {
            $lines .= "<form style='margin: 0;' action='../ControllerVista/ControllerVista.php?nombreArchivo=".$row['doc_ruta']."' method='POST'><button type='submit' style='background:none;border:none;'class='fl-button' ><img class='flecha' src='../bandejaview/img/flecha.png'></button><input type='hidden' name='accion' value='3'><input type='hidden' name='codigo_documento' value='" . $row['doc_id'] . "'><input type='hidden' name='doc_id' value='" . $row['doc_id'] . "'><input type='hidden' name='doc_usuari' value='" . $row['doc_usuari'] . "'><input type='hidden' name='codigo_detalle_documento' value='" . $row['det_id'] . "'></form></td></tr>";
            
         }
    }
    return $lines;
}
$documentos_suscriptores = traerDatos($numero_documento);
$lines = iterarDatos($documentos_suscriptores);
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<div id='back'>

</div>
<div class="table-wrapper">
    <img src="./img/lupa.png" alt="" srcset="" id="lupa">
    <table class="fl-table" id="datatable" >
        <thead>
            <tr>
                <th class="thead">Nombre documento</th>
                <th class="thead">Fecha de documento</th>
                <th class="thead">Hora de documento</th>
                <th class="thead" >Firmar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $lines;
            ?>
        </tbody>
    </table>
</div>
<script>
$(document).ready(function() {
    $(document).on("click", "#nextobj", function() {
        var id = $(this).next().val();
        var trade_id = $("#trade_id").attr("value", id);

    })
})
</script>