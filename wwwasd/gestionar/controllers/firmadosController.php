<?php
@session_start(['name'=>'SITI']);
$_SESSION['codigo_usuario'];
$iduser = $_SESSION['codigo_usuario'];

require_once "../models/tablasModel.php";

$TF = new Tablas();
$consulta = $TF->tabla_firmados_model($iduser);
if ($consulta) {
	echo json_encode($consulta);
} else {
	echo'{
		"sEcho": 1,
		"iTotalRecords": "0",
		"iTotalDisplayRecords": "0",
		"aaData": []
		 }';
}