<?php
    
    include('../controller/tablesController.php');

    class TablaDevueltos {

        public static function cuerpo() {
        
            $lines = '';
            $datos = traerDatosDocumentos($_SESSION['codigo_usuario'], 'Devuelto');

            while($row = mysqli_fetch_assoc($datos)) {
                $lines .= '
                    <tr id="'.$row['doc_nombre'].'" fecha="'.$row['doc_fechac'].'">'
                        . '<td class="texto">' . $row['doc_nombre'] . '</td>'
                        . '<td class="texto">' . $row['doc_fechac'].' '.$row['doc_horac'] . '</td>'
                        . '<td class="texto" style="color: #ff0000;">' . $row['det_cordes']. '</td>'
                        . '<td class="negrita">' . $row['doc_estado'] . '</td>'
                        . '<td class="texto">' . $row['det_observ']. '</td>'
                        . '<td name="DescargaDevueltos" class="acciones" value="' . $row['doc_nombre'] . '">' . '<img class="descargarDoc" src="../../recursos/iconos/icon-descargar.png" title="Descargar" alt="Descargar">' . '</td>' .
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
                    devueltos.classList.add("active");
                    validar.classList.add("button-border");
                    pendientes.classList.add("button-border");
                    pendientes_entrada.classList.add("button-border");
                </script>
            ';

            echo $lines;
        }

        public static function cabecera() {
            echo '
                <thead class="thead">
                    <tr>
                        <th style="width: 15%;">Documento</th>
                        <th>Fecha de envio</th>
                        <th style="width: 25%;">Devuelto por</th>
                        <th>Estado</th>
                        <th style="width: 25%;">Observacion</th>
                        <th>Descargar</th>
                    </tr>
                </thead>
            ';
        }
        
        public static function mostrarTabla() {
            TablaDevueltos::cabecera();
            TablaDevueltos::cuerpo();
        }
    }
?>
