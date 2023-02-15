<?php use Models\Bucket;
require '../../Models/Bucket.php';
include('./tablesController.php');
require '../../config/APP.php';
$S3 = new Bucket();

$respusta = [
    'status' => null,
    'message' => null
];

if (isset($_POST['DescargaPendientes'])) {
    $result = $S3->s3DownloadObjectAjax($_POST['DescargaPendientes'],CLIENT.'/pendientes/');
    $respusta['status'] = 200;
    $respusta['message'] = $result;

}
if (isset($_POST['descargarFirmados'])) {
    $result = $S3->s3DownloadObjectAjax($_POST['descargarFirmados']);
    $respusta['status'] = 200;
    $respusta['message'] = $result;
}
if (isset($_POST['DescargaDevueltos'])) {
    $result = $S3->s3DownloadObjectAjax($_POST['DescargaDevueltos'],CLIENT.'/pendientes/');
    $respusta['status'] = 200;
    $respusta['message'] = $result;
}
echo json_encode($respusta);
?>