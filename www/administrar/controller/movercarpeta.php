<?php
@session_start(['name' => 'SITI']);
include "../../Models/CSRFToken.php";
include "../../conexion.php";

if(isset($_POST['documento']) && isset($_POST['carpeta'])) {

    $sql = "UPDATE documento
        SET id_carpeta='".$_POST['carpeta']."'
        WHERE doc_usuari='".$_SESSION['codigo_usuario']."' AND doc_id='".$_POST['documento']."'";
    $folder = $link->query($sql);

    echo json_encode([
        'status' => 200,
        'message' => 'El el documento se movio correctamente'
    ]);
}

?>
