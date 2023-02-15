<?php

use Models\Session;
include "../Models/CSRFToken.php";
include '../conexion.php';
include '../dominio.php';
include_once '../Models/Bucket.php';
use Models\Bucket;

@session_start(['name' => 'SITI']);
$codigo_usuario = $_SESSION['codigo_usuario'];

$query = "select usu_rutafi from usuario where usu_id = '$codigo_usuario'";
$result = $link->query($query);
$fila = $result->fetch_assoc();
$ruta_archivo = $fila['usu_rutafi'];

$ruta_imagen = "../recursos/imagenes/firme_aqui.png";
if ($ruta_archivo) {
    $ruta_imagen = $ruta_archivo;
}

if (isset($_POST['eliminarGrafo'])) {
    $link->query("UPDATE usuario SET usu_rutafi = NULL WHERE usu_id = '$codigo_usuario'");
    echo "<script>alert('Se elimino el grafo correctamente');</script>";
    // header("Refresh:0");
}

$sql = "SELECT usu_rutafi FROM usuario WHERE usu_id = {$_SESSION['codigo_usuario']}";
$result = $link->query($sql);
$firma = $result->fetch_assoc()["usu_rutafi"];
$contenido = '';

if($firma != null) {

    $S3 = new Bucket();
    $hash = $S3->s3DownloadObjectB64("firma_{$_SESSION['cedula_usuario']}.png", "suntic/images/{$_SESSION['cedula_usuario']}/");
    $imagen = "data:image/png;base64,".$hash;
    $contenido = "<img width='100%' height='100%' src='$imagen'>";
}

?>
<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<LINK REL=StyleSheet HREF="./grafo.css" TYPE="text/css" MEDIA=screen>
<script>
function enviarFormularioGrafo() {
    document.eliminarGrafoForm.submit();
}

function enviarFormulario() {

    document.formulario.submit();
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
    //subirgrafo(primerArchivo);

    /* Muestra el grafo cuando se sube */
    const contenedor = document.getElementById('cont2');
    contenedor.innerHTML = '';
    contenedor.innerHTML = `
        <img src="${objectURL}" width="100%" height="100%">
    `;
}

function volverAtras() {
    window.location.href = "../dashboard/";
}
</script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<div class="cuerpo-container" style="height: 0;">


    <div class="Subir">
        <h1 style="    margin-bottom: auto;">Sube tu Grafo Aquí</h1>
    </div>

    <div id="cont1">
        <div id="cont2">
            <?php if($contenido != ''): ?>
                <?= $contenido; ?>
            <?php else: ?>
                <br>
                <br>
                <h2 style="color:gray;font-style:italic;font-size: 18px;">Arrastre y suelte la imagen de su grafo </h2>
                <button id="grafofile">Subir Grafo <img src="./cargar-documento.png"></button>
            <?php endif ?>
        </div>

    </div>

    <div class="icon">
        <img src="<?php echo ".." . $ruta_imagen; ?>" id="imagenPrevisualizacion" width="100%" height="100%">
    </div>

    <form action="index.php" method="post" target="" name="formulario" id="formulario" enctype="multipart/form-data">
        <input class="type-file" name="fichero" type="file" id="fichero" accept="image/*" onchange="todos();" style="  border: 3px dashed #D6D6D6;
    height: 34vh;
    border-radius: 5px;
    display: flex;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    cursor: pointer;
    margin-top: -17%;" />

        <input type="hidden" name="tokenCSRF" id="tokenCSRF">
        <div class="contButtons">
            <p style="    font-size: 19px;
margin-top: auto;text-align:center;color:white;font-style:italic;">Recuerda: Subir tu grafo es
                opcional. Si no deseas utilizar esta función puedes continuar haciendo click en "Firmar".</p>

        </div>

    </form>
    <div style="display:flex;margin-left: 30%;width:100%;">

        <button onclick="volverAtras();" class="btnback"
            style="text-decoration:none;color:white;cursor:pointer;color:white;opacity: 0.9;width: 200px;" type="button"
            class="buttons">Continuar
        </button>
        <form action="" method="POST" name="eliminarGrafoForm" id="eliminarGrafoForm">

            <input type="hidden" name="tokenCSRF2" id="tokenCSRF2">
            <input type="hidden" name="eliminarGrafo" id="eliminarGrafo" value="1">


            <button id="btnsave" class="btngeneral btn" onclick="enviarFormulario();">Eliminar <img src="./eliminar.png"
                    alt="" style="width:14px;color:white;"></button>
        </form>
    </div>

    <div id="contphotoback" style="    width: 41%;
    height: 100%;
    opacity: 0.1;
    margin-top: -41%;">
        <img style="width:100%;height:100%;" src="../recursos/bg-icon-vista-datos-usuario.png" alt="" srcset="">
    </div>
</div>
<?= CSRFToken::setToken(); ?>
<script>
function todos() {
    let fieldToken = document.getElementById('tokenCSRF').value;
    if ('<?= $_SESSION['csrf']; ?>' == fieldToken) {

        subir_imagen();
        setTimeout(() => {

            const subir = confirm("¿Esta seguro que desea subir este grafo?");
            if(subir) enviarFormulario();
            else {

                const contenedor = document.getElementById('cont2');
                contenedor.innerHTML = '';
                contenedor.innerHTML = `
                    <br>
                    <br>
                    <h2 style="color:gray;font-style:italic;font-size: 18px;">Arrastre y suelte la imagen de su grafo </h2>
                    <button id="grafofile">Subir Grafo <img src="./cargar-documento.png"></button>
                `;
            }
        }, 100);
    }
}

</script>
</div>
