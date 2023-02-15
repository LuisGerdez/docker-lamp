<?php
require_once '../../Models/Certificado.php';
use Models\Certificado;

$Array=$_POST;
$id=$Array['id'];
$text=$Array['text'];

if ($text=="id_activar") {
    activarUsuario($id);
}
if ($text=="id_desactivar") {
    desactivarUsuario($id);
}
if ($text=="id_admin") {
    establecerAdmin($id);
}
if($text=="id_certificado"){
    certificadoEnroll($id);
}

function activarUsuario($update)
{

    include "../../conexion.php";

    $datos = mysqli_query(
        $link,
        "UPDATE usuario
         SET usu_estado='A' 
         WHERE usu_id='$update'"
    );
    mysqli_close($link);
}
function desactivarUsuario($update)
{

    include "../../conexion.php";

    $datos = mysqli_query(
        $link,
        "UPDATE usuario
         SET usu_estado='I'
         WHERE usu_id='$update'"
    );
    mysqli_close($link);
}
function establecerAdmin($update)
{

    include "../../conexion.php";

    $datos = mysqli_query(
        $link,
        "UPDATE usuario
         SET rol_usuario='1'
         WHERE usu_id='$update'"
    );
    mysqli_close($link);
}

function certificadoEnroll($cedula){
    $certificado = new Certificado();
    echo $certificado->setClient($cedula, 3);
}



