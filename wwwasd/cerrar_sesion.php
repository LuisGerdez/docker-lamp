<?php 
//session_unset();
@session_start(['name'=>'SITI']);
require_once "./config/APP.php";

clearstatcache();
session_destroy();

header('Location: '.CERRAR_SESION);
?>