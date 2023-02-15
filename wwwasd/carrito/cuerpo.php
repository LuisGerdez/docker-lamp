
<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function enviarFormulario() {
        document.formulario.submit();
    }
</script>
<form action="index.php" method="post" target="" name="formulario" id="formulario">
    <p class="broken"></p>
    <div class="cuerpo-container">
        <div class="cuerpo-titulo">
            <label>MI COMPRA</label>
        </div>
        <div class="cuerpo-encabezado">
            <div class="encabezado-nombre">Producto</div>
            <div class="encabezado-precio">Precio por Unidad</div>
            <div class="encabezado-cantidad">Cantidad</div>
            <div class="encabezado-subtotal">Subtotal</div>
            <div class="encabezado-eliminar"></div>
        </div>
        <div class="cuerpo-linea"></div>
        <?php 
        include '../conexion.php';
        $codigo_usuario = $_SESSION['codigo_usuario'];
        
        $query = "select car_id from carrito where car_estado = 'P' and car_usuari = '$codigo_usuario'";
        $result = $link->query($query);
        $fila = $result->fetch_assoc();
        $car_id = $fila['car_id'];
        
        $query = "select *, p.pro_nombre from detallecarrito dc left join producto p on (p.pro_id = dc.car_produc) where car_id = '$car_id'";
        $result = $link->query($query);
        $total = 0;
        while($row = mysqli_fetch_array($result)) {
            $total = $total + ($row["car_valor"]*$row["car_cantid"]);
            
        ?>
            <div class="cuerpo-producto">
                    <div class="producto-nombre"><?php echo $row["pro_nombre"]?></div>
                    <div class="producto-precio">$<?php echo number_format($row["car_valor"],0,",",".")?></div>
                    <div class="producto-cantidad"><?php echo $row["car_cantid"]?></div>
                    <div class="producto-subtotal">$<?php echo number_format($row["car_valor"]*$row["car_cantid"],0,",",".");?></div>
                    <div class="producto-eliminar">X</div>
            </div>
        <?php 
        }
        ?>
        <div class="cuerpo-linea"></div>
        <div class="cuerpo-total">
            <div class="total-titulo">Valor Total</div>
            <div class="total-valor">$<?php echo number_format($total,0,",",".")?></div>
        </div>
    </div>
</form>