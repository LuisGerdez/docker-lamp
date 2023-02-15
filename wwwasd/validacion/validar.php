<?php

if (isset($_GET['token'])) {
    $token = $_GET['token'];
}

if (isset($_GET['nombre_archivo'])) {
    $nombre_archivo = $_GET['nombre_archivo'];
}

if (isset($_GET['codigo_usuario'])) {
    $codigo_usuario = $_GET['codigo_usuario'];
}

if (isset($_GET['codigo_documento'])) {
    $codigo_documento = $_GET['codigo_documento'];
}

if (isset($_GET['codigo_detalle_documento'])) {
    $codigo_detalle_documento = $_GET['codigo_detalle_documento'];
}
if (isset($_POST['correos_destinatarios'])) {
    $correos_destinatarios = $_POST['correos_destinatarios'];
}else{
    $correos_destinatarios = $_GET['correos_destinatarios'];
}
?>
<script>
function validarCodigo(){
    let token_1 = document.getElementById('token_1').value;
    let token_2 = document.getElementById('token_2').value;
    
    if(token_1 !== token_2){
        document.getElementById('panel-invalido').style.display = 'flex';
        return false;
    }
}
</script>
<LINK REL=StyleSheet HREF="./validar.css" TYPE="text/css" MEDIA=screen>
<form action="index.php" method="get" onsubmit="return validarCodigo();">
    <div class="container-validar">
        <div class="validar-panel">
            <div class="panel-parrafo"><p>* Por favor ingrese el c&oacute;digo de seguridad</p></div>
            <div class="panel-label">
                <label><b>C&Oacute;DIGO</b></label>
            </div>
            <div class="panel-input">
                <input type="text" name="token_2" id="token_2" autofocus="true" autocomplete="off">
            </div>
            <div id="panel-invalido">
                <p>Codigo invalido</p>
            </div>
            <div class="panel-boton">
                <button type="submit">Validar</button>
            </div>
        </div>
        <input type="hidden" name="token_1" id="token_1" value="<?php echo $token ?>">
        <input type="hidden" name="nombre_archivo" value="<?php echo $nombre_archivo ?>">
        <input type="hidden" name="codigo_usuario" value="<?php echo $codigo_usuario ?>">
        <input type="hidden" name="codigo_documento" value="<?php echo $codigo_documento ?>">
        <input type="hidden" name="codigo_detalle_documento" value="<?php echo $codigo_detalle_documento ?>">
        <input type="hidden" name="correos_destinatarios" value="<?php echo $correos_destinatarios ?>">
    </div>
</form>