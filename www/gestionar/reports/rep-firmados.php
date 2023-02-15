<?php
@session_start(['name'=>'SITI']);

require '../../vendor/autoload.php';
require_once '../../config/APP.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$_SESSION['codigo_usuario'];
$iduser = $_SESSION['codigo_usuario'];
$nombre = $_SESSION['nombre_usuario'];
$apellido = $_SESSION['apellido_usuario'];
$usuario = $nombre." ".$apellido;

require_once "../models/tablasModel.php";

$RDF = new Tablas();
$consulta = $RDF->reporte_firmados_model($iduser);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getPageSetup()->setFitToWidth(1);
$sheet->getPageSetup()->setFitToHeight(0);
$sheet->setTitle("Docs_firmados_".date("d-m-Y"));
$sheet->mergeCells('A1:C1');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('A1', 'Informe de documentos firmados - '.COMPANY);
$sheet->setCellValue('A2', '');
$sheet->getStyle('A3:A4')->getFont()->setSize(12);
$sheet->setCellValue('A3', 'Generado el: '.date("d-m-Y"));
$sheet->setCellValue('A4', 'Usuario: '.$usuario);
$sheet->setCellValue('A5', '');
$sheet->getColumnDimension('A')->setWidth(40);
$sheet->getStyle('A6:C6')->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('A6:C6')->getAlignment()->setHorizontal('center');
$sheet->getStyle('A6:C6')->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$sheet->setCellValue('A6', 'Nombre del documento');
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getStyle('B')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('B6', 'Fecha de firma');
$sheet->getColumnDimension('C')->setWidth(40);
$sheet->setCellValue('C6', 'Firmantes');

$fila = 7;

while($data = mysqli_fetch_assoc($consulta)){
	$sheet->getStyle('A'.$fila.':C'.$fila)->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$sheet->setCellValue('A'.$fila, $data['doc_nombre']);
	$sheet->setCellValue('B'.$fila, $data['doc_fecha_f']);
	$sheet->setCellValue('C'.$fila, $data['det_nomdes']);
	$fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Informe_de_documentos_firmados"'.date("d-m-Y").'".xlsx"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');