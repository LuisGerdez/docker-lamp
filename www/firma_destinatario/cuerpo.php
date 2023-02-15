<?php

use Models\Session;

include '../Models/CSRFToken.php';

$codigo_usuario = $_SESSION['codigo_usuario'];

if (isset($_POST['nombreArchivo'])) {
    $nombreArchivo = $_POST['nombreArchivo'];
} else {
    if (isset($_POST['nombreArchivo'])) {
    $nombreArchivo = $_GET['nombreArchivo'];
    }
}
if (isset($_POST['nombre_archivo'])) {
    $nombre_archivo = $_POST['nombre_archivo'];
} else {
    $nombre_archivo = $_GET['nombre_archivo'];
}

if (isset($_POST['codigo_usuario'])) {
    $codigo_usuario = $_POST['codigo_usuario'];
} else {
    $codigo_usuario = $_GET['codigo_usuario'];
}

if (isset($_POST['codigo_documento'])) {
    $codigo_documento = $_POST['codigo_documento'];
} else {
    $codigo_documento = $_GET['codigo_documento'];
}

if (isset($_POST['codigo_detalle_documento'])) {
    $codigo_detalle_documento = $_POST['codigo_detalle_documento'];
} else {
    $codigo_detalle_documento = $_GET['codigo_detalle_documento'];
}

if (isset($_POST['correos_destinatarios'])) {
    $correos_destinatarios = $_POST['correos_destinatarios'];
}else{
    $correos_destinatarios = $_GET['correos_destinatarios'];
}


$ruta_imagen = "../recursos/imagenes/firme_aqui.png";
?>
<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>

<div class="info-grafo">
    <div class="Subir">
        <h1 style="    margin-bottom: auto;">Sube tu Grafo Aquí</h1>
    </div>

    <div class="Recuerda">

        <div id="cont1">
            <div id="cont2">
                <br>
                <br>
                <h2 style="color:gray;font-style:italic;font-size: 18px;">Arrastre y suelte la imagen de su grafo </h2>
                <button id="grafofile">Subir Grafo <img src="./cargar-documento.png"></button>

            </div>

        </div>

        <div class="contButtons">
            <p style="    font-size: 19px;
margin-top: auto;text-align:center;color:white;font-style:italic;"> Recuerda
                Subir tu grafo es opcional. Si no deseas utilizar esta funcion puedes continuar haciendo click en
                firmar </p>
        </div>
    </div>

    <form action="firmar.php" method="post" target="" name="formulario" id="formulario" enctype="multipart/form-data">
        <input type="hidden" name="tokenCSRF" id="tokenCSRF">
        <div class="botones">

            <input type="file" name="fichero" id="fichero" accept="image/*" onchange="todos();"
                style="  border: 3px dashed #D6D6D6;
    height: 34vh;
    border-radius: 5px;
    display: flex;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    cursor: pointer;
    margin-top: -22%;" />

            <button id="btnsave" class="btngeneral btn" onclick="enviarFormulario();">Firmar</button>
        </div>


        <input type="hidden" id="nombre_archivo" name="nombre_archivo" value="<?php echo $nombre_archivo ?>" />
        <input type="hidden" id="codigo_usuario" name="codigo_usuario" value="<?php echo $codigo_usuario ?>" />
        <input type="hidden" id="codigo_documento" name="codigo_documento" value="<?php echo $codigo_documento ?>" />
        <input type="hidden" id="codigo_detalle_documento" name="codigo_detalle_documento"
            value="<?php echo $codigo_detalle_documento ?>" />
        <input type="hidden" id="correos_destinatarios" name="correos_destinatarios"
            value="<?= $correos_destinatarios ?>" />
    </form>
    
    <div style="display:none;"class="icon">
                <div class="grafo" id="grafo"><img src="" id="imagenPrevisualizacion" width="100%" height="100%"></div>

                <img class="icono" id="contrato" src="./contrato.png" alt="">
            </div>
</div>
<?= CSRFToken::setToken(); ?>
<script>
function enviarFormulario() {

    let fieldToken = document.getElementById('tokenCSRF').value
    let sessionToken = '<?= $_SESSION['csrf']; ?>';

    if (sessionToken == fieldToken) document.formulario.submit();
}

function subir_imagen() {

    const $seleccionArchivos = document.querySelector("#fichero"),
        $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");
    // Los archivos seleccionados, pueden ser muchos o uno
    const archivos = $seleccionArchivos.files;
    // Si no hay archivos salimos de la funci�n y quitamos la imagen
    if (!archivos || !archivos.length) {
        $imagenPrevisualizacion.src = "";
        return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    $imagenPrevisualizacion.src = objectURL;

    /* Muestra el grafo cuando se sube */
    const contenedor = document.getElementById('cont2');
    contenedor.innerHTML = '';
    contenedor.innerHTML = `
        <img src="${objectURL}" width="100%" height="100%">
    `;

}
</script>

<script>
function todos() {
    const input_doc = document.getElementById('fichero');
    subir_imagen();
    setTimeout(() => {

        const subir = confirm("¿Esta seguro que desea subir este grafo?");

        if(!subir) {
            const contenedor = document.getElementById('cont2');
            contenedor.innerHTML = '';
            contenedor.innerHTML = `
                <br>
                <br>
                <h2 style="color:gray;font-style:italic;font-size: 18px;">Arrastre y suelte la imagen de su grafo </h2>
                <button id="grafofile">Subir Grafo <img src="./cargar-documento.png"></button>
            `;
            input_doc.value = '';
        }
    }, 100);
}
</script>