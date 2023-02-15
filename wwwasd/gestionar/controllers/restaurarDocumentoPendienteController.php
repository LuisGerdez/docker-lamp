<?php

require_once "../models/tablasModel.php";

//$iduser = 1;
$dir_precarga = "../../bodega/precarga/";
$dir_eliminado = "../../bodega/eliminado/";

$RDE = new Tablas();
$mensajeerror="";
$contador=0;
$iddocumento = htmlspecialchars($_POST['iddocumento'], ENT_QUOTES, 'UTF-8');
$nombredocumento = htmlspecialchars($_POST['nombredocumento'], ENT_QUOTES, 'UTF-8');
$iduser = htmlspecialchars($_POST['usuarioid'], ENT_QUOTES, 'UTF-8');

if ($contador>0) {
	echo $mensajeerror;
}else{
	$directorio_p = $dir_precarga.$iduser."/".$nombredocumento;
	$directorio_e = $dir_eliminado."/".$iduser."/".$nombredocumento;
	$nueva_ruta = "/bodega/precarga/".$iduser."/".$nombredocumento;
	
	if (file_exists($directorio_e)) {
		$consulta = $RDE->restaurar_documento_eliminado_model($iddocumento,$nombredocumento,$nueva_ruta);
		if ($consulta==1) {
			copy($directorio_e, $directorio_p);
			unlink($directorio_e);
			echo $consulta;
		} else {
			echo $consulta;
		}
	}
}