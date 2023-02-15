<?php
include '../conexion.php';
include '../dominio.php';
$codigo_usuario = $_SESSION['codigo_usuario'];

$query = "select usu_rutafidi from usuario where usu_id = '$codigo_usuario'";
$result = $link->query($query);
$fila = $result->fetch_assoc();
$ruta_archivo = $fila['usu_rutafidi'];

$nombre_archivo = "Ninguna...";
if($ruta_archivo){
    $array_ruta = explode("/", $ruta_archivo);
    $nombre_archivo = $array_ruta[5];
}
?>
<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<script>
    function enviarFormulario() {
        document.formulario.submit();
    }
    
    function volver(){
        window.location.href = "<?php echo $dominio?>dashboard/";
    }

    function subir_imagen() {
        
        const $seleccionArchivos = document.querySelector("#fichero"),
                $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");
        
        // Los archivos seleccionados, pueden ser muchos o uno
        const archivos = $seleccionArchivos.files;
        //console.log(archivos[0].name);
        $imagenPrevisualizacion.innerHTML = archivos[0].name;

    }
</script>
<div class="cuerpo-container">
    <form action="index.php" method="post" target="" name="formulario" id="formulario" enctype="multipart/form-data">
        <div class="cuerpo-imagen-firma">
            <span id="imagenPrevisualizacion" class="firma-nombre" ><?php echo $nombre_archivo; ?></span>
            <input class="firma-input" type="file" name="fichero" id="fichero" accept=".pfx" onchange="subir_imagen();"/>
            <label for="fichero">Subir Certificado Digital</label>
        </div>
        <div class="cuerpo-botones">
            <button type="button" onclick="volver();">Volver</button>
            <button onclick="enviarFormulario();">Guardar</button>
        </div>
    </form>
</div>
