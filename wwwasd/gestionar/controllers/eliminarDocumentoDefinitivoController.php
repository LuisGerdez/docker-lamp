<?php

require_once "../models/tablasModel.php";

$dir_eliminado = "../../bodega/eliminado/";

$EDD = new Tablas();
$mensajeerror="";
$contador=0;
$iddocumento = htmlspecialchars($_POST['iddocumento'], ENT_QUOTES, 'UTF-8');
$nombredocumento = htmlspecialchars($_POST['nombredocumento'], ENT_QUOTES, 'UTF-8');
$iduser = htmlspecialchars($_POST['usuarioid'], ENT_QUOTES, 'UTF-8');

if ($contador>0) {
	echo $mensajeerror;
}else{
	$directorio_e = $dir_eliminado.$iduser."/".$nombredocumento;
	
	if (file_exists($directorio_e)) {
		$consulta = $EDD->eliminar_documento_definitivo_model($iddocumento);
		if ($consulta==1) {
			unlink($directorio_e);
			echo $consulta;
		} else {
			echo $consulta;
		}
	}
}