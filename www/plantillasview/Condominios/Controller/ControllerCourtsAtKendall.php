<?php
require_once "../../../config/APP.php";
require '../../../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use iio\libmergepdf\Merger;


$accion=$_POST['accion'];

switch ($accion) {
    case 'GeneratePdf':
        GeneratePdf();
        break;
    
    default:
        echo "ups, hubo un problema";
        break;
}

function GeneratePdf(){
    

}








?>