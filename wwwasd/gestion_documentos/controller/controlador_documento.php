<?php

function Eliminar($eliminar)
{
    include "../../conexion.php";

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
    if($datos && $datos2){
        echo '200';
    }
    mysqli_close($link);
}

if (isset($_POST['id'])) {
    Eliminar($_POST['id']);
}
?>