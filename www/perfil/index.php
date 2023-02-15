<?php
@session_start(['name' => 'SITI']);


require_once '../Models/Certificado.php';

use Models\Certificado;


$id_usuario = (int) $_SESSION['codigo_usuario'];
$nombre = $_SESSION['nombre_usuario'];
$apellido = $_SESSION['apellido_usuario'];
$num_documento = $_SESSION['cedula_usuario'];
$correo = $_SESSION['correo_usuario'];
$cc_documento = $_SESSION['tipo_documento'];
$telefono = $_SESSION['celular'];

include "../conexion.php";

$query = "SELECT SUM(cantidad_firmas) FROM producto";
$result = $link->query($query);
$fila = $result->fetch_assoc();
$firmas = $fila['SUM(cantidad_firmas)'];

$query = "SELECT SUM(total_firmas) FROM producto";
$result = $link->query($query);
$fila = $result->fetch_assoc();
$total_firmas = $fila['SUM(total_firmas)'];


if (isset($_POST['certificado'])) {
    $certificado = new Certificado();
    // var_dump($certificado->setClient($_SESSION['codigo_usuario']), 1);
    if($certificado->setClient($_SESSION['codigo_usuario'])==0){
        echo "<script>alert('Usted no esta enrolado')</script>";
    }
}
?>

<link rel="stylesheet" href="./css/usuario.css">
<?php  include '../menu.php' ?>


<!--Informacion del Usuario-->
<div class="info-container">
    <div id="contcards">
        <div class="User-container">
            <div class="card1">
                <div id="contPhoto">
                    <img id="logoUser" src="../recursos/icn-usuario-sin-foto.png" alt="">
                    <p class="titulo">@Usuario</p>
                </div>
                <div class="info-general">
                    <p>

                        <label class="sub">Nombre</label><br>
                        <label class="texto"><?= $nombre .' ' . $apellido ?></label>
                    </p>
                    <p>
                        <label class="sub">Número de identificación</label><br>

                        <label class="texto"><?= $num_documento ?></label><br>
                    </p>
                    <p>
                        <label class="sub">Tipo de identificación</label><br>

                        <label class="texto"><?= $cc_documento ?></label><br>
                    </p>
                    <p>
                        <label class="sub">Correo electrónico</label><br>

                        <label class="texto"><?= $correo ?></label>
                    </p>
                    <p>
                        <label class="sub">Teléfono</label><br>

                        <label class="texto"><?= $telefono ?></label>
                    </p>
                    <form action="" method="POST">
                        <button id="certificado" type="submit" name="certificado">Ver mi Certificado</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="info-user">

            <p id="title" style="    padding-top: 9px;">Consumo General</p>

            
            <div class="info-producto">
                <div class="datos-datos div1">
                    Firmas Restantes: <br>
                    <label class="bluetext"><?php if($firmas){ echo $firmas;} else { echo 0;} ?></label>
                </div>
                <div class="datos-datos div2">
                    Total de firmas: <br>
                    <label class="bluetext"><?php if($total_firmas){ echo $total_firmas;} else { echo 0;} ?></label>
                </div>
            </div>
            <div class="img2">
                <img id="logosuntic" src="../recursos/logo.png" alt="">
            </div>
        </div>
    </div>
</div>

<script src="./js/popup.js"></script>