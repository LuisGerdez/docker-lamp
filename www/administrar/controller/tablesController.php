<?php
// require_once '../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


function traerDatosDocumentos($id, $estado, $email=null)
{
    include "../../conexion.php";
    if ($estado == 'Firmado') {
        $datos = mysqli_query(
            $link,
            "SELECT doc_id, doc_nombre, doc_ruta, usu_nombre, doc_fecha_f, doc_hora_f, doc_estado FROM documento INNER JOIN usuario ON documento.doc_usuari = usuario.usu_id INNER JOIN detalledocumento ON detalledocumento.det_docume = documento.doc_id WHERE (det_cordes = '{$email}' OR doc_usuari='{$id}') AND doc_estado = '{$estado}' GROUP BY doc_id, doc_nombre, usu_nombre, usu_email, doc_fechac, doc_estado;"
        );
        mysqli_close($link);
    } else if ($estado == 'Pendiente') {
        $datos = mysqli_query(
            $link,
            "SELECT doc_id,doc_ruta,doc_nombre,usu_nombre,doc_estado FROM documento INNER JOIN usuario ON documento.doc_usuari=usuario.usu_id WHERE doc_usuari = '{$id}' and doc_estado = '{$estado}'  GROUP BY doc_id,doc_nombre,usu_nombre,usu_email,doc_fechac,doc_estado"
        );
        mysqli_close($link);
    } else {
        $datos = mysqli_query(
            $link,
            "SELECT doc_id, doc_ruta, doc_nombre, doc_estado, doc_fechac, doc_horac, det_observ, det_cordes
            FROM documento d
            INNER JOIN usuario ON d.doc_usuari = usuario.usu_id
            INNER JOIN detalledocumento ON d.doc_id = detalledocumento.det_docume
            WHERE doc_usuari = '{$id}' and doc_estado = '{$estado}' AND det_firma = 0
            GROUP BY doc_id,doc_nombre,usu_nombre,usu_email,doc_fechac,doc_estado;"
        );
        mysqli_close($link);
    }
    return $datos;
}

function iterarDatosDocumentos($data)
{
    $lines = '';
    while ($row = mysqli_fetch_array($data)) {
        if (isset($row['doc_fecha_f'])) {
            $lines .= '<tr>
        <td >' . $row['doc_nombre'] . '</td>
        <td>' . $row['doc_fecha_f'] . ' ' . $row['doc_hora_f'] . '</td>
        <td>' . traerDatosDestinatarios($row['doc_id']) . '</td>
        <td>' . $row['doc_estado'] . '</td>
        <form id="formFirmados" name="formFirmados" method= "post">
        <td> <button  name="descargar" id="descargarFirmados" class="fl-button btn btn-success" style="padding: 5px 40px;" value="'.$row['doc_ruta'].'">Descargar</button> <button  style="cursor: pointer;
        background-color: #BDC300;
        color: white;
        padding: 5px 13px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border: 0;border-radius:5px;" type="button" name="mover"style="  display: inline-block;
        font-size: 16px;"id="mover"value="'.$row['doc_id'].'">Copiar a carpeta</button> </td>
        </form>
        </tr>';
        } else if ($row['doc_estado'] == 'Pendiente') {
            $lines .= '<tr>
        <td >' . $row['doc_nombre'] . '</td>
        <td>' . traerDatosDestinatarios($row['doc_id']) . '</td>
        <td>' . $row['doc_estado'] . '</td>
        <td> <button style="cursor: pointer;" id="DescargaPendientes" class="fl-button btn btn-success" value="' . $row['doc_nombre'] . '">Descargar</button></td>
    </tr>';
        } else {
            $lines .= '<tr>
            <td >' . $row['doc_nombre'] . '</td>
            <td >' . $row['doc_fechac'] .' '.$row['doc_horac'] .'</td>
            <td>' . $row['det_cordes']. '</td>
            <td>' . $row['doc_estado']. '</td>
            <td>' . $row['det_observ'] . '</td>
            <td> <button style="cursor: pointer;" id="DescargaDevueltos" class="fl-button btn btn-success" value="' . $row['doc_nombre'] . '">Descargar</button></td>
        </tr>';
        }
    }
    return $lines;
}

function traerDatosFirmantes($doc_id)
{
    include "../../conexion.php";
    $array_firmados = array();

    $datos = mysqli_query(
        $link,
        "SELECT det_nomdes,det_firma,det_cordes FROM detalledocumento INNER JOIN documento ON detalledocumento.det_docume = documento.doc_id INNER JOIN usuario ON usuario.usu_id=documento.doc_usuari WHERE doc_id= $doc_id "
    );
    mysqli_close($link);

    while ($consulta = mysqli_fetch_array($datos)) {
        array_push($array_firmados, $consulta['det_cordes']);
    }
    return implode(",", $array_firmados);
}



function traerDatosDestinatarios($parametro)
{
    include "../../conexion.php";
    $array_firmados = array();
    $array_pendientes = array();
    $datos = mysqli_query(
        $link,
        "SELECT det_cordes,det_firma FROM detalledocumento INNER JOIN documento ON detalledocumento.det_docume = documento.doc_id INNER JOIN usuario ON usuario.usu_id=documento.doc_usuari WHERE doc_id= $parametro "
    );
    mysqli_close($link);

    while ($consulta = mysqli_fetch_array($datos)) {
        if ($consulta['det_firma'] == 1) {
            array_push($array_firmados, $consulta['det_cordes']);
        } else {
            array_push($array_pendientes, $consulta['det_cordes']);
        }
    }
    if (empty($array_firmados)) {
        return 'Pendientes: ' . implode(",", $array_pendientes);
    } else if (empty($array_pendientes)) {
        return 'Firmados: ' . implode(",", $array_firmados);
    }

    return 'Firmados: ' . implode(",", $array_firmados) . '; ' . 'Pendientes: ' . implode(",", $array_pendientes);
}

// function traerDestinatariosDevueltos()
// {
//     include "../../conexion.php";
//     $array_firmados = array();
//     $datos = mysqli_query(
//         $link,
//         "SELECT det_nomdes,det_cordes FROM detalledocumento INNER JOIN documento ON detalledocumento.det_docume = documento.doc_id INNER JOIN usuario ON usuario.usu_id=documento.doc_usuari WHERE doc_id= $doc_id "
//     );
// }
