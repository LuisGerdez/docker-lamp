<?php

include('../recursos/tcpdf/examples/tcpdf_include.php');
// Crear nuevo PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Establezca la fuente, no el archivo TTF sino el nombre del archivo php dentro de tcpdf / fonts
$pdf->SetFont("justbeautifulsimplicity", '', 10);
$pathTTFFiles = array(
    'Cherolina.ttf'
);

foreach($pathTTFFiles as $ttfFile){
    $fontname = TCPDF_FONTS::addTTFfont($ttfFile, 'TrueTypeUnicode', '', 96);
    
    echo "The processed font '$ttfFile' can be used with the name: $fontname";
}
?>