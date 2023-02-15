<?php
@session_start(['name'=>'SITI']);
$_SESSION['codigo_usuario'];
if(isset($_SESSION['codigo_usuario'])){
    $codigo_usuario = $_SESSION['codigo_usuario'];
}else{
    $codigo_usuario=26;
}

// $codigo_usuario = $_SESSION['codigo_usuario'];
$codigo_producto = $_POST['codigo'];

include '../conexion.php';

$sql = "SELECT * FROM producto WHERE pro_id = '$codigo_producto'";
$result = $link->query($sql);
$fila = $result->fetch_assoc();
$precio = $fila['pro_valor'];

$sql = "SELECT car_id,car_valor FROM carrito WHERE car_usuari = '$codigo_usuario' and car_estado = 'P'";
$result = $link->query($sql);
$fila = $result->fetch_assoc();
$car_id = $fila['car_id'];
$car_valor = $fila['car_valor'];

if($car_id){
    $precio_total = $car_valor + $precio;
    $sql = "update carrito set car_valor = '$precio_total' where car_id = '$car_id'";
    $link->query($sql);
    
    $sql = "SELECT max(car_detall) as detalle FROM detallecarrito WHERE car_id = '$car_id'";
    $result = $link->query($sql);
    $fila = $result->fetch_assoc();
    $detalle = $fila['detalle'];
    $car_detall = $detalle+1;
    
    $sql = "SELECT * FROM detallecarrito WHERE car_id = '$car_id' and car_produc = '$codigo_producto'";
    $result = $link->query($sql);
    $fila = $result->fetch_assoc();
    $cantidad = $fila['car_cantid'];
    $nr = mysqli_num_rows($result);
    
    if($nr){
        $car_cantid = $cantidad+1;
        $sql = "update detallecarrito set car_cantid = '$car_cantid' where car_id = '$car_id' and car_produc = '$codigo_producto'";
        $link->query($sql);
    }else{
        $sql = "INSERT into detallecarrito (car_id, car_detall, car_produc, car_cantid, car_valor, car_fechac, car_horac)
                          values
                                ('$car_id', '$car_detall', '$codigo_producto', '1', '$precio', current_date, current_time)";
        $link->query($sql);
    }
    
    
}else{
    $sql = "INSERT into carrito (car_estado, car_usuari, car_valor, car_fechac, car_horac)
                          values
                                ('P', '$codigo_usuario', '$precio', CURRENT_DATE(), CURRENT_TIME())";
    $link->query($sql);
    $car_id = $link->insert_id;
    
    $sql = "INSERT into detallecarrito (car_id, car_detall, car_produc, car_cantid, car_valor, car_fechac, car_horac)
                          values
                                ('$car_id', '1', '$codigo_producto', '1', '$precio', CURRENT_DATE(), CURRENT_TIME())";
    $link->query($sql);
}

mysqli_close($link);

echo "<script>alert('Se agrego al carrito');</script>";
?>