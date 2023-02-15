<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../conexion.php';

//Load Composer's autoloader
require '../vendor/autoload.php';

$_SESSION['codigo_usuario'];
$codigo_usuario = $_SESSION['codigo_usuario'];
$correo_remitente = $_SESSION['correo_usuario'];
$id_formulario = isset($_SESSION['id_formulario']) ? $_SESSION['id_formulario'] : '';




?>

<!-- CSS only bosstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<LINK REL=StyleSheet HREF="./btn_modal.css" TYPE="text/css" MEDIA=screen>
<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>

<!-- Ajax -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- sweetalert2 tabajamos con los mensajes de validacion -->
<script src="js/sweetalert2.js"></script>

<script>
//Se maneja cada funcion por separado
function enviarFormulario() {
    let evento = document.getElementById('formulario_envio')
    evento.action = "../revisarview/index.php";
    evento.submit();
}


function volverAtras() {
    history.go(-1)
}
</script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>
<div class="cuerpo-container">
    <div class="cuerpo-titulo">
        <label>Preparar</label>
    </div>
    <form action="" method="post" id="formulario_envio" name="formulario_envio">
        <div class="cuerpo-pdf">
            <div>
                <object data="../bodega/precarga/<?php echo $codigo_usuario ?>/<?php echo $_SESSION["nameMerge"]?>"
                    type="application/pdf" width="100%" height="600px">
                    <div class="container-object">
                        <h1 class="title">Tu navegador no soporta PDF</h1>
                        <img src="../recursos/imagenes/alerta.png" alt="" class="alert-icon">
                        <a href="../bodega/precarga/<?php echo $codigo_usuario ?>/<?php echo $_SESSION["nameMerge"]?>"
                            class="boton-descarga">Descargar Documento</a>
                    </div>
                </object>
            </div>
        </div>

        <div class="cuerpo-botones">
            <button class="btn_volver" type="button" title="volver" onclick="volverAtras();"><i
                    class="fas fa-arrow-left"></i>Volver</button>
 
            <button title="siguiente" onclick="enviarFormulario(this.name);" name="siguiente">Siguiente<i
                    class="fas fa-arrow-right"></i></button>

        </div>

        <input type="hidden" name="nombre" value="<?= isset($_SESSION["nombre"]) ? $_SESSION["nombre"] : ''; ?>" />
        <input type="hidden" name="correo" value="<?= isset($_SESSION["correo"]) ? $_SESSION["correo"] : ''; ?>" />
        <input type="hidden" name="codigo_usuario" value="<?= $codigo_usuario ?>" />

        <input type="hidden" name="id_formulario" value="<?= isset($_SESSION["id_formulario"]) ? implode(",", $_SESSION["id_formulario"]) : ''; ?>" />
    </form>
</div>