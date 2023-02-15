<?php

@session_start(['name' => 'SITI']);
include('../controller/tablesController.php');

class TablaFirmados {

    public static function cuerpo() {
        
        $lines = '';
        $datos = traerDatosDocumentos($_SESSION['codigo_usuario'], 'Firmado');

        while($row = mysqli_fetch_assoc($datos)) {
            $firmados = traerDatosFirmantes($row['doc_id']);
            $lines .= '
                <tr id="'.$row['doc_nombre'].'" fecha="'.$row['doc_fecha_f'].'">'
                    . '<td class="texto">' . $row['doc_nombre'] . '</td>'
                    . '<td class="texto">' . $row['doc_fecha_f'].' '.$row['doc_hora_f'] . '</td>'
                    . '<td class="texto">' . '<span class="firmado">' . $firmados . '</span>' . '</td>'
                    . '<td class="firmado negrita">' . $row['doc_estado'] . '</td>'
                    . '<td name="descargarFirmados" class="acciones" value="' . $row['doc_ruta'] . '">'
                        . '<img class="descargarDoc descargar" src="../../recursos/iconos/icon-descargar.png" title="Descargar" alt="Descargar">'
                        . '<img class="copiarDoc mover" src="../../recursos/iconos/copiar.png" title="Copiar a carpeta" alt="Copiar" value="'.$row['doc_id'].'">'
                    . '</td>'.
                '</tr>
            ';
        }
        
        $lines .= '
            <script>
                const activo = document.querySelector(".active");
                const pendientes = document.getElementById("pendientes");
                const pendientes_entrada = document.getElementById("pendientes_entrada");
                const firmados = document.getElementById("firmados");
                const devueltos = document.getElementById("devueltos");
                const validar = document.getElementById("validar");
    
                activo.classList.remove("active");
                firmados.classList.add("active");
                devueltos.classList.add("button-border");
                validar.classList.add("button-border");
                pendientes_entrada.classList.add("button-border");
            </script>
        ';
        
        echo $lines;
    }

    public static function cabecera() {
        echo '
            <thead class="thead">
                <tr>
                    <th style="width: 28%;">Documento</th>
                    <th>Fecha de firma</th>
                    <th style="width: 30%;">Firmantes</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        ';
    }

    public static function carpetas() {

        include "../../conexion.php";

        $resultado = [];
        $datos = mysqli_query(
            $link,
            "SELECT * FROM carpetas WHERE usu_id='" . $_SESSION["codigo_usuario"] . "'" . "ORDER BY carp_nombre ASC"
        );

        while($row = mysqli_fetch_assoc($datos)) {
            
            $carpeta = [];
            $carpeta['id'] = $row['id_carpeta'];
            $carpeta['nombre'] = $row['carp_nombre'];
            array_push($resultado, $carpeta);
        }

        return $resultado;
    }

    public static function mostrarTabla() {
        TablaFirmados::cabecera();
        TablaFirmados::cuerpo();
    }
}

if(isset($_POST['request'])) {
    
    echo json_encode([
        'status' => 200,
        'carpetas' => TablaFirmados::carpetas()
    ]);
}
