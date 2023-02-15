<?php
    class Bandeja {

        public static function modal() {
            include 'btn_modal.php';
            return  $boton;
        }

        public static function cuerpo() {
            $correo_usuario = $_SESSION['correo_usuario'];
            include "../../conexion.php";
            $modal = Bandeja::modal();          
            $lineas = '<tbody class="tbody">';
            $datos = mysqli_query(
                $link,
                "SELECT DISTINCT documento.doc_nombre,documento.doc_fechac,documento.doc_horac,
                documento.doc_estado,detalledocumento.codigo_verificacion,detalledocumento.det_docume,
                detalledocumento.det_cordes,detalledocumento.link_firma,detalledocumento.det_usuari,detalledocumento.det_firma,detalledocumento.estado_firma_destinatario_modal
                FROM detalledocumento
                INNER JOIN documento ON documento.doc_id=detalledocumento.det_docume
                WHERE detalledocumento.det_cordes='$correo_usuario' AND doc_estado='Pendiente' AND det_firma = '0' AND link_firma IS NOT NULL",
            );
            mysqli_close($link);

            while($row = mysqli_fetch_array($datos)) {
                $lineas .= "
                    <tr id='{$row['doc_nombre']}' fecha='{$row['doc_fechac']}'>
                        <td>{$row['doc_nombre']}</td>
                        <td>{$row['doc_fechac']}</td>
                        <td>{$row['doc_horac']}</td>";

                if ($row['det_firma'] == 0 && $row['codigo_verificacion'] == 0) {
                    $lineas .= "
                        <td>
                            <a  href=../" . $row['link_firma'] . " target='__blank'>
                                <button class='fl-button' style='background-color: #0d6efd; outline: none; border-radius:50%;border:none;padding: 3px 7px; cursor: pointer;'>
                                    <img title='Firmar documento' src='../../bandejaview/img/flecha.png'>
                                </button>
                            </a>
                        </td>
                    ";
                }
                // Condicion para documentos
                else if ($row['estado_firma_destinatario_modal'] == 'Pendiente2' && $row['codigo_verificacion'] != 0) {
                    $lineas .= "<td>". $modal . "<input type='hidden' name='cod_otp' value='" . $row['det_docume'] . "'></td>";
                }
                // Condicion para documentos
                else if ($row['codigo_verificacion'] != 0 && $row['estado_firma_destinatario_modal'] == 'no_pendiente2') {
                    $lineas .= "
                        <td>
                            <a href=../" . $row['link_firma'] . " target='__blank'>
                                <button class='fl-button' style='background-color: #0d6efd; outline: none; border-radius:50%;border:none;padding: 3px 7px; cursor: pointer;'>
                                    <img title='Firmar documento' src='../../bandejaview/img/flecha.png'>
                                </button>
                            </a>
                        </td>
                    ";
                }
            }
            
            $lineas .= "</tr>";
            $lineas .= Bandeja::TemplateData();
            $lineas .= '
                <script>                
                    const pendientes = document.getElementById("pendientes");
                    const firmados = document.getElementById("firmados");
                    const devueltos = document.getElementById("devueltos");
                    const validar = document.getElementById("validar");
                    
                    pendientes.classList.add("button-border");
                    firmados.classList.add("button-border");
                    devueltos.classList.add("button-border");
                    validar.classList.add("button-border");
                    
                    const cerrar = document.querySelector(".cerrar");
                
                    cerrar.addEventListener("mouseenter", () => {
                        cerrar.src = "../../recursos/iconos/cerrar-negro.png";
                    });
                
                    cerrar.addEventListener("mouseleave", () => {
                        cerrar.src = "../../recursos/iconos/cerrar-gris.png";
                    });
                </script>
            ';
            $lineas .= "</tbody>";

            echo $lineas;
        }
        public static function TemplateData(){
            include "../../conexion.php";
            $modal = Bandeja::modal();
            $lineas2 = '';
            $datos = mysqli_query(
                $link,
                "SELECT DISTINCT
                documento.doc_nombre,documento.doc_fechac,
                documento.doc_ruta,documento.doc_usuari,
                documento.doc_horac,documento.doc_id,
                documento.doc_estado,detalledocumento.det_id,detalledocumento.det_docume,
                detalledocumento.estado_firma_destinatario_modal
                FROM detalledocumento
                INNER JOIN documento
                ON documento.doc_id=detalledocumento.det_docume
                WHERE detalledocumento.det_cordes='".$_SESSION['correo_usuario']."'
                AND det_firma=0 AND link_firma IS NULL
                ORDER BY doc_fechac DESC,doc_horac DESC",
            );
            mysqli_close($link);

            while($row = mysqli_fetch_array($datos)) {
                $lineas2 .= "
                    <tr>
                        <td>{$row['doc_nombre']}</td>
                        <td>{$row['doc_fechac']}</td>
                        <td>{$row['doc_horac']}</td>";

                if ($row['doc_estado'] == 'Pendiente' && $row['estado_firma_destinatario_modal'] == 'Pendiente2') {
                    $lineas2 .= "<td>". $modal . "<input type='hidden' name='cod_otp' value='" . $row['det_docume'] . "'></td></tr>";
                } else {
                    $lineas2 .= "
                    <td>
                    <form style='margin: 0;' action='../../ControllerVista/ControllerVista.php?nombreArchivo=".$row['doc_ruta']."'method='POST'>
                    <button title='Firmar documento' type='submit'
                    style='background-color: #0d6efd; outline: none;
                     border-radius:50%;border:none;padding: 3px 7px; cursor: pointer;'class='fl-button' >
                    <img class='flecha'src='../../bandejaview/img/flecha.png'></button>
                    <input type='hidden' name='accion' value='3'>
                    <input type='hidden'name='codigo_documento' value='" . $row['doc_id'] . "'>
                    <input type='hidden' name='doc_id' value='" . $row['doc_id'] . "'>
                    <input type='hidden' name='doc_usuari' value='" . $row['doc_usuari'] . "'>
                    <input type='hidden' name='codigo_detalle_documento' value='" . $row['det_id'] . "'>
                    </form>
                    </td>
                    </tr>";
                    }
            }
            return $lineas2;
        }

        public static function cabecera() {
            echo("
                <thead>
                    <tr>
                        <th style='width: 40%;'>Nombre documento</th>
                        <th>Fecha de documento</th>
                        <th>Hora de firma</th>
                        <th>Firma</th>
                    </tr>
                </thead>
            ");
        }

        public static function mostrarBadeja() {
            Bandeja::cabecera();
            Bandeja::cuerpo();
        }
    }
?>