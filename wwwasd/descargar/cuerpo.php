<?php
use \Models\Bucket;
// require_once '../administrar/vendor/autoload.php';
require_once '../Models/Bucket.php';

include '../dominio.php';


if (isset($_POST['nombre_archivo'])) {
    $nombre_archivo = $_POST['nombre_archivo'];
} else {
    $nombre_archivo = $_GET['nombre_archivo'];
}

if (isset($_POST["key_path"])) {
    $key_path = $_POST['key_path'];
} else {
    $key_path = $_GET['key_path'];
}

if (isset($_POST['keyaws'])) {
    $S3 = new Bucket();

    if(isset($_POST['pathaws'])) {
        $S3->s3DownloadObject($_POST['keyaws'], $_POST['pathaws']);
    } else {
        $S3->s3DownloadObject($_POST['keyaws']);
    }
}

?>


<form action="" method="post" style='border:none;width:100%;height:100%; margin-top:15%;' class="form-control" name="formulario" id="formulario">
    <div style='border:none;' class="x_title form-control">
        <h3 style="font-weight:bolder;text-align:center;">Documento</h3>
    </div>
    <div class="x_panel col-md-3 " style="margin:auto;">
        <button type="submit" class="btn btn-success form-control" name="keyaws" value="<?= $nombre_archivo ?>">Descargar Archivo</button>
    </div>

    <input type="hidden" name="pathaws" value="<?= $key_path ?>">
</form>

<style>
    button:hover {
        background-color: white;
        color: black;
    }
</style>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>