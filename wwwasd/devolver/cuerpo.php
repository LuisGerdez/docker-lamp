<?php
$codigo_usuario = $_SESSION['codigo_usuario'];

if (isset($_POST['codigo_usuario'])) {
    $codigo_usuario = $_POST['codigo_usuario'];
}else{
    $codigo_usuario = $_GET['codigo_usuario'];
}

if (isset($_POST['codigo_documento'])) {
    $codigo_documento = $_POST['codigo_documento'];
}else{
    $codigo_documento = $_GET['codigo_documento'];
}

if (isset($_POST['codigo_detalle_documento'])) {
    $codigo_detalle_documento = $_POST['codigo_detalle_documento'];
}else{
    $codigo_detalle_documento = $_GET['codigo_detalle_documento'];
}

?>
<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<script>
    function enviarFormulario() {
        document.formulario.submit();
    }
    
    function volverAtras(){
        history.go(-1)
    }
</script>
<div class="cuerpo-container">
    <form action="index.php" method="post" target="" name="formulario" id="formulario">
        <div class="cuerpo-pdf">
            <label>&iquest;Cual es el motivo de la devolucion?</label>
            <div>
                <textarea name="observacion" rows="6" autofocus="true"></textarea>
            </div>
        </div>
        <div class="cuerpo-botones">
            <button type="button" onclick="volverAtras();">Atras</button>
            <button type="button" onclick="enviarFormulario();">Enviar</button>
        </div>
        <input type="hidden" id="codigo_usuario" name="codigo_usuario" value="<?php echo $codigo_usuario?>"/>
        <input type="hidden" id="codigo_documento" name="codigo_documento" value="<?php echo $codigo_documento?>"/>
        <input type="hidden" id="codigo_detalle_documento" name="codigo_detalle_documento" value="<?php echo $codigo_detalle_documento?>"/>
        <input type="hidden" id="metodo" name="metodo" value="devolver"/>
    </form>
</div>
