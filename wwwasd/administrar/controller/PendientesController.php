<?php

include('../controller/tablesController.php');

class TablaPendientes {

    public static function cuerpo() {
        
        $datos = traerDatosDocumentos($_SESSION['codigo_usuario'], 'Pendiente');
        $lines = '';
        $firmados = '';
        $pendientes = '';
        
        while ($row = mysqli_fetch_assoc($datos)) {
        
            $data = traerDatosDestinatarios($row['doc_id']);
            $arreglo = explode(';', $data);
        
            foreach ($arreglo as $i) {
                if (str_contains($i, 'Firmados')) $firmados .= $i;
                else $pendientes .= $i;
            }
        
            if ($row['doc_estado'] == 'Pendiente') {
                $lines .= '
                    <tr id="'.$row['doc_nombre'].'">'
                        . '<td id="column-doc" class="texto">' . $row['doc_nombre'] . '</td>'
                        . '<td class="texto">' . '<span class="firmado">' . $firmados . '</span>' . '<span class="pendiente">' . $pendientes . '</span>' . '</td>'
                        . '<td class="pendiente negrita">' . $row['doc_estado'] . '</td>'
                        . '<td name="DescargaPendientes" class="acciones" value="' . $row['doc_nombre'] . '">' . '<img class="descargarDoc" src="../../recursos/iconos/icon-descargar.png" title="Descargar" alt="Descargar">' . '</td>' .
                    '</tr>
                ';
            }
        
            $pendientes = '';
            $firmados = '';
        }

        $lines .= '
            <script>
                const activo = document.querySelector(".active");
                const pendientes = document.getElementById("pendientes");
                const firmados = document.getElementById("firmados");
                const devueltos = document.getElementById("devueltos");
                const validar = document.getElementById("validar");
        
                activo.classList.remove("active");
                pendientes.classList.add("active");
                firmados.classList.add("button-border");
                devueltos.classList.add("button-border");
                validar.classList.add("button-border");
            </script>
        ';

        echo $lines;
    }

    public static function cabecera() {
        echo '
            <thead class="thead">
                <tr>
                    <th class="doc-column">Documento</th>
                    <th class="dest-column">Destinatario</th>
                    <th>Estado</th>
                    <th>Descargar</th>
                </tr>
            </thead>
        ';
    }

    public static function mostrarTabla() {
        TablaPendientes::cabecera();
        TablaPendientes::cuerpo();
    }
}
?>
