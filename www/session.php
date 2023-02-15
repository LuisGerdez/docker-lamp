<?php 
@session_start(['name'=>'SITI']);
require_once "../config/APP.php";

if(!isset($_SESSION['codigo_usuario'])){
    session_destroy();
    header('Location: '.CERRAR_SESION);
}
?>