<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
$numero_documento = $_SESSION['cedula_usuario'];


function traerDatos()
{
    include "../conexion.php";
    $datos = mysqli_query(
        $link,
        "SELECT doc_id,doc_nombre, doc_ruta,usu_nombre,usu_email,doc_fechac,doc_estado FROM documento INNER JOIN usuario ON documento.doc_usuari=usuario.usu_id GROUP BY doc_id,doc_nombre,usu_nombre,usu_email,doc_fechac,doc_estado "
    );
    mysqli_close($link);
    return $datos;
}

function traerDatosDestinatarios($parametro)
{
    include "../conexion.php";
    $array_firmados = array();
    $array_pendientes = array();
    $datos = mysqli_query(
        $link,
        "SELECT det_nomdes,det_firma FROM detalledocumento INNER JOIN documento ON detalledocumento.det_docume = documento.doc_id INNER JOIN usuario ON usuario.usu_id=documento.doc_usuari WHERE doc_id= $parametro "
    );
    mysqli_close($link);

    while ($consulta = mysqli_fetch_array($datos)) {
        if ($consulta['det_firma'] == 1) {
            array_push($array_firmados, $consulta['det_nomdes']);
        } else {
            array_push($array_pendientes, $consulta['det_nomdes']);
        }
    }
    if (empty($array_firmados)) {
        return 'Pendientes: ' . implode(",", $array_pendientes);
    } else if (empty($array_pendientes)) {
        return 'Firmados: ' . implode(",", $array_firmados);
    }

    return 'Firmados: ' . implode(",", $array_firmados) . '; ' . 'Pendientes: ' . implode(",", $array_pendientes);
}
/* print_r(implode(",",traerDatosDestinatarios())); */



function iterarDatos($data)
{
    $lines = '';
    while ($row = mysqli_fetch_array($data)) {
        $lines .= '<tr>
        <td>' . $row['usu_nombre'] . '</td>
        <td>' . $row['usu_email'] . '</td>
        <td>' . $row['doc_nombre'] . '</td>
        <td>' . $row['doc_fechac'] . '</td>';
        $lines .= $row['doc_estado']=='Firmado'? '<td style="color:green;">'  . $row['doc_estado'] . '</td>':'<td style="color:red;">'  . $row['doc_estado'] . '</td>';
        $lines .= '<td>' . traerDatosDestinatarios($row['doc_id']) . '</td>';       
        $lines .= $row['doc_estado']=='Pendiente'? '<td> <img style="cursor:pointer;padding-right: 5px;"value="' . $row['doc_id'] . '" id="eliminar" title="Eliminar documento" src="../recursos/boton-x.png">' : '<td>';
        $lines .= $row['doc_estado']!='Pendiente'? '<img style="cursor:pointer;padding-left:5px;"src="../recursos/descargar.png" title="Descargar documento" value="' . $row['doc_ruta'] . '" id="descargar"></td>' : '<img style="cursor:pointer;padding-left:5px;" src="../recursos/descargar.png" title="Descargar documento" value="'. $row['doc_nombre'] . '" id="descargarPendientes"></td>';
        $lines .='</tr>';
    }
    return $lines;
}

function eliminarDocumentos($eliminar)
{
    include "../conexion.php";

    $datos = mysqli_query(
        $link,
        "DELETE 
         FROM detalledocumento 
         WHERE det_docume='$eliminar'"
    );
    $datos2 = mysqli_query(
        $link,
        "DELETE FROM documento WHERE doc_id='$eliminar' "
    );
    if ($datos && $datos2) {
        echo 'Documentos eliminados correctamente';
    }
    mysqli_close($link);
}



$documentos_suscriptores = traerDatos();
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
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<div class="table-wrapper"> 
    <table class="fl-table" id="datatable">
        <thead>
            <tr>
                <th class="thead">Nombre Destinatario</th>
                <th class="thead">Correo del destinatario</th>
                <th class="thead">Nombre documento</th>
                <th class="thead">Fecha defirma</th>
                <th class="thead">Estado del documento</th>
                <th class="thead">Estado firmas</th>
                <th class="thead">Acciones</th>
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
        $(document).on("click", "#eliminar", function() {
            var eliminar = $(this).val();
            var confirmed = confirm("Estas seguro que deseas eliminar el documento?");
            if (confirmed) {
                $.ajax({
                    url: "./controller/controlador_documento.php",
                    type: "POST",
                    data: "id=" + eliminar,
                    success: function(result) {
                        location.reload();
                    }
                })
            }
        });
    });
</script>
<script>
        $(document).ready(function() {
            $(document).on("click", "#descargar", function() {
                let descargar = $(this).val();
                $.ajax({
                    // dataType: 'json',
                    type: 'POST',
                    url: './controller/DownloadController.php',
                    data: {
                        descargar: descargar
                    },
                    success: function(response) {
                        console.log(response);
                        var link = document.createElement("a");
                        document.body.appendChild(link);
                        link.setAttribute("type", "hidden");
                        link.href = "data:application/pdf;base64," + response;
                        link.download = descargar;
                        link.click();
                        document.body.removeChild(link);
                    }
                })
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on("click", "#descargarPendientes", function() {
                let descargar = $(this).val();
                $.ajax({
                    // dataType: 'json',
                    type: 'POST',
                    url: './controller/DownloadController.php',
                    data: {
                        descargarPendientes: descargar
                    },
                    success: function(response) {
                        // console.log(response);
                        var link = document.createElement("a");
                        document.body.appendChild(link);
                        link.setAttribute("type", "hidden");
                        link.href = "data:application/pdf;base64," + response;
                        link.download = descargar;
                        link.click();
                        document.body.removeChild(link);
                    }
                })
            })
        });
    </script>