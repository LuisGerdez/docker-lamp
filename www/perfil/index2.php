<?php

@session_start(['name' => 'SITI']);
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Models\Bucket;


include "../conexion.php";
require '../Models/Bucket.php';
//Contador firmas
$query = "SELECT SUM(cantidad_firmas) FROM producto";
$result = $link->query($query);
$fila = $result->fetch_assoc();
$firmas = $fila['SUM(cantidad_firmas)'];

$query = "SELECT SUM(total_firmas) FROM producto";
$result = $link->query($query);
$fila = $result->fetch_assoc();
$total_firmas = $fila['SUM(total_firmas)'];

function recordsEnroll($cedula){
    include "../conexion.php";
    $sql = "SELECT Record, Uid, StartingDate, CreationDate, CreationIP, IdNumber, IssueDate, FirstName, SecondName, FirstSurname, SecondSurname, Gender, BirthDate, PlaceBirth, TransactionTypeName, Response_ANI, TransactionId FROM ado_records WHERE IdNumber = {$cedula} and TransactionTypeName = 'Enroll'  ORDER BY `ado_records`.`CreationDate` DESC LIMIT 1";
    $result = $mysqli->query($sql);
    $datos = $result->fetch_assoc();
    $mysqli->close();

    return $datos;
}

function getImageEnroll($IdNumber, $TransactionId,$key){
    $S3 = new Bucket();
    switch ($key) {
        case '1':
            $img='data:image/png;charset=utf-8;base64,'.$S3->s3DownloadObjectB64("clientFace.png",CLIENT."/images/$IdNumber/$TransactionId/");
            break;
        case '2':
            $img='data:image/png;charset=utf-8;base64,'.$S3->s3DownloadObjectB64("frontDocument.png",CLIENT."/images/$IdNumber/$TransactionId/");
            break;
    }
    return $img;
}


function generateLayout($array){
    include "certificado_enroll/plantilla.php";
    $img = getImageEnroll($array['IdNumber'], $array['TransactionId'],1); 
    $img2 = getImageEnroll($array['IdNumber'], $array['TransactionId'],2); 
    $plantilla = getPlantillaEnroll($array,$img,$img2);
    return $plantilla;
}


function getEnrollCertificate($layout,$key=null, $cedula){
    require_once('../vendor/autoload.php');
    $mpdf = new \Mpdf\Mpdf([
    ]);
    $mpdf->AddPage();
    $stylesheet = file_get_contents(__DIR__.'/certificado_enroll/style.css');
    $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($layout, \Mpdf\HTMLParserMode::HTML_BODY);
    if($key==1){
        $mpdf->Output(__DIR__.'/certificado/certificado.pdf', 'F');
        $S3 = new Bucket();
        $S3->s3UploadObject(__DIR__.'/certificado/certificado.pdf', "certificado-$cedula.pdf", CLIENT.'/certificados/');
    }else{
    $mpdf->Output('certificado.pdf','I');
    }
}

if(isset($_POST['certificado'])){
    $datos = recordsEnroll($num_documento);
    $layout = generateLayout($datos);
    getEnrollCertificate($layout);
}
?>