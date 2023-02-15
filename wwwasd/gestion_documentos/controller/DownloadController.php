<?php use Models\Bucket;
require '../../Models/Bucket.php';

// var_dump($_POST);

if (isset($_POST['descargar'])) {
    $S3 = new Bucket();
    $S3->s3DownloadObjectAjax($_POST['descargar']);
}
if (isset($_POST['descargarPendientes'])) {
    $S3 = new Bucket();
    $S3->s3DownloadObjectAjax($_POST['descargarPendientes'],CLIENT.'/pendientes/');
}











?>