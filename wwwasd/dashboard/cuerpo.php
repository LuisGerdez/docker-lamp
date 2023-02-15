<?php
include '../conexion.php';
include '../Models/DB.php';
include '../Models/CSRFToken.php';

use Models\DB;

function infoUser()
{
    try {
        $pdo = new DB();
        $con = $pdo->connect();
        
        $stmt = $con->prepare("SELECT SUM(cantidad_firmas) FROM producto");
        $stmt->execute();
        $firmas = $stmt->fetch(PDO::FETCH_ASSOC)['SUM(cantidad_firmas)'];

        $stmt = $con->prepare("SELECT count(*) as pendientes from documento where doc_estado = 'Pendiente' and doc_usuari = :codigo");
        $stmt->execute(['codigo' => $_SESSION['codigo_usuario']]);
        $pendientes = $stmt->fetch(PDO::FETCH_ASSOC)['pendientes'];

        $stmt = $con->prepare("SELECT count(*) as eliminados from documento where doc_estado = 'Eliminado' and doc_usuari = :codigo");
        $stmt->execute(['codigo' => $_SESSION['codigo_usuario']]);
        $eliminados = $stmt->fetch(PDO::FETCH_ASSOC)['eliminados'];

        $stmt = $con->prepare("SELECT count(*) as firmados from documento where doc_estado = 'Firmado' and doc_usuari = :codigo");
        $stmt->execute(['codigo' => $_SESSION['codigo_usuario']]);
        $firmados = $stmt->fetch(PDO::FETCH_ASSOC)['firmados'];
        
        return $infoArr = [
            'firmas' => $firmas,
            'pendientes' => $pendientes,
            'eliminados' => $eliminados,
            'firmados' => $firmados
        ];
    } catch (\PDOException $e) {
        error_log($e,0,'../php-error.log');
    }
}

$infoArr = infoUser();

?>


<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<div class="cuerpo-container">
    <form action="../documentos/index.php" method="post" enctype="multipart/form-data" target="" name="formulario" id="formulario">
        <div class="datos-container">
            <div class="datos-datos">
                <header>Firmas Disponibles:</header><?= $infoArr['firmas'] ?? 0; ?>
            </div>
            <div class="datos-datos">
                <header>Pendientes:</header><?= $infoArr['pendientes'] ?? 0; ?>
            </div>
            <div class="datos-datos">
                <header>Eliminados:</header><?= $infoArr['eliminados'] ?? 0; ?>
            </div>
            <div class="datos-datos">
                <header>Firmados:</header><?= $infoArr['firmados'] ?? 0; ?>
            </div>
        </div>
        <div class="drag-area-container" >
            <input type="hidden" name="tokenCSRF" id="tokenCSRF">
            <div class="drag-area">
                <header>Arrastre su documento aqu&iacute</header>
                <span></span>
                <button>Subir documento<i class="fas fa-arrow-up"></i></button>
                <input class="type-file" type="file" id="Documento" accept=".pdf,.docx" name="nombre_archivo" onchange="cargarDocumento()" />
            </div>
        </div>
    </form>
</div>
<?= CSRFToken::setToken(); ?>
<script>
    function cargarDocumento() {
        
        let rol, firmas;
        rol = '<?= $_SESSION['rol']; ?>'
        firmas = '<?= $infoArr['firmas']; ?>'
        let tokenSession = '<?= $_SESSION['csrf']; ?>'
        let tokenCampo = document.getElementById('tokenCSRF').value
        //validacion de documento IVAN ALEXIS URBINA :D
        var archivoInput = document.getElementById('Documento');
        var archivoRuta = archivoInput.value;
        var extPermitidas = /(.pdf|.docx|.docs|.xlsx|.pptx|.docm|.dotx|.dotm)$/i;
        var Documento = document.getElementById('Documento').files[0].size;

        if( rol == 3 || firmas==0 ) {
            alert('Usted no tiene firmas disponibles');
            return false;
        }
        else {
            ///aqui empieza la validacion
            if (Documento == 0) {
                alert('no puede mandar un archivo vacio!');
                archivoInput.value = '';
                return false;
            }
            else {
                if (!extPermitidas.exec(archivoRuta)) {
                    alert('Recuerde que solo se permite word y pdf');
                    archivoInput.value = '';
                    return false;
                } else if(tokenSession == tokenCampo) {
                    document.formulario.submit();
                }
            }
        }
    }
</script>

<?php
    if($_SESSION["rol"] == 3)
        header("Location: ../administrar");
?>