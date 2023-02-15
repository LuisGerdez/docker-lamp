<?php
include '../conexion.php';
$codigo_usuario = $_SESSION['codigo_usuario'];

$sql = "SELECT count(*) as contador FROM carrito WHERE car_usuari = '$codigo_usuario' and car_estado = 'P'";
$result = $link->query($sql);
$fila = $result->fetch_assoc();

$cont = $fila['contador'];

$circulo_carrito = "";
if ($cont > 0) {
    $circulo_carrito = "carrito-circulo";
}
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
<LINK REL=StyleSheet HREF="../carrito.css" TYPE="text/css" MEDIA=screen>

<div class="carrito-container">
    <a href="../carrito/index.php"><i class="fas fa-cart-plus"></i></a>
    <div class="<?php echo $circulo_carrito; ?>"></div>
</div>
