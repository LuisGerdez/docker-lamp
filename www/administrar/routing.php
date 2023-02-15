<?php 
	if ($_GET['menu']=='eliminados') {
		require_once('vista/eliminados.php');
	}
	if ($_GET['menu']=='firmados') {
		require_once('vista/firmados.php');
	} 
	if ($_GET['menu']=='pendientes') {
		require_once('vista/pendientes.php');
	} 
	if ($_GET['menu']=='carpetas') {
		require_once('vista/carpetas.php');
	} 
 ?>