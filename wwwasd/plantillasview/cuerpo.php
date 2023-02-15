<?php
/*
*   Software development: Ing. Bernabe Sanchez Lenis
*   líneas de código: 38 - 66
*/
$codigo_usuario = $_SESSION['codigo_usuario'];

?>
<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<LINK REL=StyleSheet HREF="css/modal.css" TYPE="text/css" MEDIA=screen>
<script>
    function cargarDocumento() {
        document.formulario.submit();
    }
</script>

<div class="cuerpo-container">
    <form action="../documentos/index.php" method="post" enctype="multipart/form-data" target="" name="formulario" id="formulario">
        <div class="datos-container">
         <div class="datos-plantillas">
            <p><h2>Plantillas</h2></p>
            <!-- <p>&#10148; Contrato compraventa de veh&iacuteculo</p>
            <p>&#10148; Promesa de contrato de compraventa</p>
            <p>&#10148; Contrato de prestación de servicios</p> -->
            <p>&#10148; Pagare a la orden</p>
            <p>&#10148; Compromiso de pago (MULTAS)</p>
            <p>&#10148; Estimado quote</p>
            <p>&#10148; Pago de vehiculo "TRADE IN"</p>
            <p>&#10148; Recibo pronto pago</p>
            <p>&#10148; Trade In Pronto pago</p>
            <p>&#10148; Documento de garantia</p>
            <p>&#10148; Factura venta vehicular</p>
        </div>
        <div class="datos-botones">
            <p><h2></h2></p>
            <!-- <p><button type="button" onclick="Abrir_Modal_Compraventa_Vehiculo()">Ver</button><a href="compraventa_vehiculo.php">Iniciar</a></p>
            <p><button type="button" onclick="Abrir_Modal_Promesa_Compraventa()">Ver</button><a href="promesa_compraventa.php">Iniciar</a></p>
            <p><button type="button" onclick="Abrir_Modal_Prestacion_Servicios()">Ver</button><a href="prestacion_servicios.php">Iniciar</a></p> -->
            <p style="padding:5px 5px 5px 5px;"><button type="button" onclick="Abrir_Modal_Pagare()">Ver</button><a href="pagare.php">Iniciar</a></p>
            <p style="padding:5px 5px 5px 5px;"><a href="multas.php">Iniciar</a></p>
            <p style="padding:5px 5px 5px 5px;"><a href="Estimado_quote.php">Iniciar</a></p>
            <p style="padding:5px 5px 5px 5px;"><a href="pago_vehiculo.php">Iniciar</a></p>
            <p style="padding:5px 5px 5px 5px;"><a href="pronto_pago.php">Iniciar</a></p>
            <p style="padding:5px 5px 5px 5px;"><a href="tradein_pronto_pago.php">Iniciar</a></p>
            <p style="padding:5px 5px 5px 5px;"><a href="documento_garantia.php">Iniciar</a></p>
            <p style="padding:5px 5px 5px 5px;"><a href="venta_vehicular.php">Iniciar</a></p>
            
        </div>
    </div>
</form>
</div>

<div id="compraventa_vehiculo" class="modalContainer">
   <div class="modal-content">
       <span class="close" onclick="Cerrar_Modal_Compraventa_Vehiculo()">×</span> <h2>Contrato compraventa de vehiculo</h2>
       <iframe src="modelos/Contrato compraventa de vehiculo.pdf" style="width:100%; height:60%;" frameborder="0"></iframe>
   </div>
</div>

<div id="promesa_compraventa" class="modalContainer">
   <div class="modal-content">
       <span class="close" onclick="Cerrar_Modal_Promesa_Compraventa()">×</span> <h2>Promesa de contrato de compraventa</h2>
       <iframe src="modelos/Promesa de contrato de compraventa.pdf" style="width:100%; height:60%;" frameborder="0"></iframe>
   </div>
</div>

<div id="prestacion_servicios" class="modalContainer">
   <div class="modal-content">
       <span class="close" onclick="Cerrar_Modal_Prestacion_Servicios()">×</span> <h2>Contrato de prestación de servicios</h2>
       <iframe src="modelos/Contrato de prestacion de servicios.pdf" style="width:100%; height:60%;" frameborder="0"></iframe>
   </div>
</div>

<div id="pagare" class="modalContainer">
   <div class="modal-content">
       <span class="close" onclick="Cerrar_Modal_Pagare()">×</span> <h2>Pagare a la orden</h2>
       <iframe src="modelos/Pagare a la orden.pdf" style="width:100%; height:60%;" frameborder="0"></iframe>
   </div>
</div>

<script type="text/javascript" src="js/modal.js"></script>