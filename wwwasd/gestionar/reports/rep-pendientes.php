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
$consulta = $RDF->reporte_pendientes_model($iduser);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getPageSetup()->setFitToWidth(1);
$sheet->getPageSetup()->setFitToHeight(0);
$sheet->setTitle("Docs_pendientes_".date("d-m-Y"));
$sheet->mergeCells('A1:D1');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('A1', 'Informe de documentos pendientes - '.COMPANY);
$sheet->setCellValue('A2', '');
$sheet->getStyle('A3:A4')->getFont()->setSize(12);
$sheet->setCellValue('A3', 'Generado el: '.date("d-m-Y"));
$sheet->setCellValue('A4', 'Usuario: '.$usuario);
$sheet->setCellValue('A5', '');
$sheet->getColumnDimension('A')->setWidth(40);
$sheet->getStyle('A6:D6')->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('A6:D6')->getAlignment()->setHorizontal('center');
$sheet->getStyle('A6:D6')->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$sheet->setCellValue('A6', 'Nombre del documento');
$sheet->getColumnDimension('B')->setWidth(18);
$sheet->getStyle('B')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('B6', 'Fecha de creación');
$sheet->getColumnDimension('C')->setWidth(40);
$sheet->getStyle('C')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('C6', 'Estado');
$sheet->getColumnDimension('D')->setWidth(40);
$sheet->setCellValue('D6', 'Observaciones');

$fila = 7;

while($data = mysqli_fetch_assoc($consulta)){
	$sheet->getStyle('A'.$fila.':D'.$fila)->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$sheet->setCellValue('A'.$fila, $data['doc_nombre']);
	$sheet->setCellValue('B'.$fila, $data['doc_fechac']);
	$sheet->setCellValue('C'.$fila, $data['doc_estado']);
	$sheet->setCellValue('D'.$fila, $data['det_observ']);
	$fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Informe_de_documentos_pendientes"'.date("d-m-Y").'".xlsx"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');