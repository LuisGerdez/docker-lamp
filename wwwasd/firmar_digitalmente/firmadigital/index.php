<?php
require_once "../config/APP.php";
/*
*   Software development - Ing. Bernabe Sanchez Lenis
*/

function getPlantilla($hash, $fecha, $firmadopor)
{
	$firmae ='
	<!DOCTYPE html>
	<html lang="es">
	<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="style.css" media="all" />
	</head>
	<body>
	<div style="text-align:center">
	<p>Este documento fue generado con firma digital por '.COMPANY.' y cuenta con plena validez júridica, conforme a lo dispuesto en la Ley 527/99 y el decreto reglamentario 2364/12</p>
	<p>Código de verificación:</p>
	<p>'.$hash.'</p>
	<p>'.$firmadopor.'<br>'.$fecha.'</p>
	<p>Valide este documento en el siguiente enlace:</p>
	<p>'.SERVERURL.'validardocumento</p>
	</div>';
	$firmae .='
	</body>
	</html>
	';

	return $firmae;
}