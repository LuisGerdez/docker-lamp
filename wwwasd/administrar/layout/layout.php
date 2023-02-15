<?php

@session_start(['name' => 'SITI']);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    
    <!-- Ajax min -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/tablas.css">
    <link rel="stylesheet" href="../css/menu.css">
</head>

<body>
    <!-- Header  -->
    <?php include('./menu.php') ?>

    <!-- Se toman todos los datos de la sesion en campos ocultos  -->
    <input type="hidden" id="hash_queue" value="<?php echo isset($_SESSION['hash_queue']) ? $_SESSION['hash_queue'] : ''; ?>">
    <input type="hidden" id="fetch_codigo_usuario" value="<?php echo isset($_SESSION['fetch_codigo_usuario']) ? $_SESSION['fetch_codigo_usuario'] : ''; ?>">
    <input type="hidden" id="fetch_rol_usuario" value="<?php echo isset($_SESSION['fetch_rol_usuario']) ? $_SESSION['fetch_rol_usuario'] : ''; ?>">
    <input type="hidden" id="fetch_codigo_documento" value="<?php echo isset($_SESSION['fetch_codigo_documento']) ? $_SESSION['fetch_codigo_documento'] : ''; ?>">
    <input type="hidden" id="fetch_hash" value="<?php echo isset($_SESSION['fetch_hash']) ? $_SESSION['fetch_hash'] : ''; ?>">
    <input type="hidden" id="fetch_correos_destinatarios" value="<?php echo isset($_SESSION['fetch_correos_destinatarios']) ? $_SESSION['fetch_correos_destinatarios'] : ''; ?>">
    <input type="hidden" id="fetch_array1" value='<?php echo isset($_SESSION['fetch_array1']) ? $_SESSION['fetch_array1'] : ''; ?>'>
    <input type="hidden" id="fetch_nombre_archivo" value="<?php echo isset($_SESSION['fetch_nombre_archivo']) ? $_SESSION['fetch_nombre_archivo'] : ''; ?>">

    <main>
        <nav class="opciones">
            <ul id="lista-items">
                <li class="active" id="pendientes_entrada"><a href="?menu=pendientes_entrada">Pendientes entrada</a></li>
                <?php if($_SESSION['rol'] != 3 && $_SESSION['rol'] != 4): ?>
                    <li id="pendientes"><a href="?menu=pendientes">Pendientes salida</a></li>
                    <li id="firmados"><a href="?menu=firmados">Firmados</a></li>
                    <li id="devueltos"><a href="?menu=devueltos">Devueltos</a></li>
                    <li id="validar"><a href="?menu=validarDocumentos">Validar documento</a></li>
                    <li id="carpetas"><a href="?menu=carpetas">Carpetas</a></li>
                <?php else: ?>
                    <li id="validar"><a href="?menu=validarDocumentos">Validar documento</a></li>
                <?php endif ?>
            </ul>
        </nav>
        <div class="main-container">
            <p id="vacio"></p>
            <?php if ($_GET['menu'] == 'carpetas' && ($_SESSION['rol'] != 3 && $_SESSION['rol'] != 4)) : ?>

                <?php require_once '../controller/CarpetasController.php'; ?>

                <div class="filtro-container">
                    <button id="crear-carpeta">crear carpeta <img src="../../recursos/iconos/carpeta-agregar.png"></button>
                    <div class="search-container">
                        <input type="text" name="search" id="search" placeholder="Buscar carpetas...">
                        <img src="../../recursos/iconos/search-icon.png" alt="Buscar">
                    </div>
                </div>
                <div class="ordenar-container">
                    <p class="ordenar">Ordenar por</p>
                    <div class="content">
                        <img src="../../recursos/iconos/down-arrow.png">
                        <ul class="opciones-menu index">
                            <li id="ninguno">Ninguno</li>
                            <li id="ordenar">Orden alfabético</li>
                            <li id="ordenar-fecha">Fecha</li>
                        </ul>
                    </div>
                </div>
                <div class="wrapper">
                    <?php Carpetas::mostrarCarpetas($_SESSION["codigo_usuario"]); ?>
                </div>
                <div id="pag-container">
                    <p>Mostrando 1 a 6 de 7 registros</p>
                    <div>
                        <button page="0" id="anterior">Anterior</button>
                        <button id="pagina-1">0</button>
                        <button page="1" id="siguiente">Proximo</button>
                    </div>
                </div>
                <link rel="stylesheet" href="../css/carpetas.css">                
                <script src="../js/paginacion.js" type="module"></script>
                <script src="../js/carpetas.js" type="module"></script>
            <?php else : ?>
                <table class="tabla" id="datatable">
                    <?php if ($_GET['menu'] == 'pendientes_entrada') : ?>
                        <div class="ordenar-container">
                            <p class="ordenar">Ordenar por</p>
                            <div class="content">
                                <img class="flecha" src="../../recursos/iconos/down-arrow.png">
                                <ul class="opciones-menu">
                                    <li id="ninguno">Ninguno</li>
                                    <li id="ordenar">Orden alfabético</li>
                                    <li id="ordenar-fecha">Fecha</li>
                                </ul>
                            </div>
                        </div>
                        <?php require_once '../controller/BandejaController.php'; ?>
                        <?php Bandeja::mostrarBadeja(); ?>
                        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
                        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
                        <script src="../js/datatable.js" type="module"></script>
                        <script src="../js/ordenar.js"></script>
                    <?php elseif ($_GET['menu'] == 'pendientes' && ($_SESSION['rol'] != 3 && $_SESSION['rol'] != 4)) : ?>
                        <div class="ordenar-container">
                            <p class="ordenar">Ordenar por</p>
                            <div class="content">
                                <img class="flecha" src="../../recursos/iconos/down-arrow.png">
                                <ul class="opciones-menu">
                                    <li id="ninguno">Ninguno</li>
                                    <li id="ordenar">Orden alfabético</li>
                                </ul>
                            </div>
                        </div>
                        <?php require_once '../controller/PendientesController.php'; ?>
                        <?php TablaPendientes::mostrarTabla(); ?>
                        <link rel="stylesheet" href="../css/pendientes.css">
                        <!-- <script src="../js/textoVacio.js"></script> -->
                        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
                        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
                        <script src="../js/datatable.js" type="module"></script>
                    <?php elseif ($_GET['menu'] == 'firmados' && ($_SESSION['rol'] != 3 && $_SESSION['rol'] != 4)) : ?>
                        <div class="ordenar-container">
                            <p class="ordenar">Ordenar por</p>
                            <div class="content">
                                <img class="flecha" src="../../recursos/iconos/down-arrow.png">
                                <ul class="opciones-menu">
                                    <li id="ninguno">Ninguno</li>
                                    <li id="ordenar">Orden alfabético</li>
                                    <li id="ordenar-fecha">Fecha</li>
                                </ul>
                            </div>
                        </div>
                        <?php require_once '../controller/FirmadosController.php'; ?>
                        <?php TablaFirmados::mostrarTabla(); ?>
                        <link rel="stylesheet" href="../css/moverCarpetas.css">
                        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
                        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
                        <script src="../js/datatable.js" type="module"></script>
                    <?php elseif ($_GET['menu'] == 'devueltos' && ($_SESSION['rol'] != 3 && $_SESSION['rol'] != 4)) : ?>
                        <div class="ordenar-container">
                            <p class="ordenar">Ordenar por</p>
                            <div class="content">
                                <img class="flecha" src="../../recursos/iconos/down-arrow.png">
                                <ul class="opciones-menu">
                                    <li id="ninguno">Ninguno</li>
                                    <li id="ordenar">Orden alfabético</li>
                                    <li id="ordenar-fecha">Fecha</li>
                                </ul>
                            </div>
                        </div>
                        <?php require_once '../controller/DevueltosController.php'; ?>
                        <?php TablaDevueltos::mostrarTabla(); ?>
                        
                        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
                        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
                        <script src="../js/datatable.js" type="module"></script>
                    <?php elseif ($_GET['menu'] == 'validarDocumentos') : ?>
                        <script>location.href = "../../validardocumento"; </script>
                    <?php endif ?>
                </table>
            <?php endif ?>
        </div>
    </main>
    <script src="../js/descargarDocumentos.js" type="module"></script>
    <div class="fondo hidden"></div>
</body>

<script>
    // Se toma toda la informacion de los campos
    let formData = new FormData();
    formData.append('hash_queue', document.querySelector('#hash_queue').value);
    formData.append('codigo_usuario', document.querySelector('#fetch_codigo_usuario').value);
    formData.append('rol_usuario', document.querySelector('#fetch_rol_usuario').value);
    formData.append('codigo_documento', document.querySelector('#fetch_codigo_documento').value);
    formData.append('hash', document.querySelector('#fetch_hash').value);
    formData.append('correos_destinatarios', document.querySelector('#fetch_correos_destinatarios').value);
    formData.append('array1', document.querySelector('#fetch_array1').value);
    formData.append('nombre_archivo', document.querySelector('#fetch_nombre_archivo').value);

    // Se hace fetch para mandar los datos a firmar_fetch.php a traves del metodo post
    fetch('../../firma_destinatario/firmar_fetch.php', {
        method: 'POST',
        body: formData,
    })
    .then((response) => response.json())
    .then((data) => {
        if(data.file_storaged) {
            if(data.upload_details.call_back && data.upload_details.call_back_url) {

                let formData_call_back = new FormData();
                formData_call_back.append('datos', data.upload_details.call_back_content);

                fetch(data.upload_details.call_back_url, {
                    method: 'POST',
                    body: formData_call_back,
                })
                .then((response) => response.json())
                .then((data) => {
                    console.log('Success callback:', data);
                })
                .catch((error) => {
                    console.error('Error callback:', error);
                });

            }
        }

        console.log('Success:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
</script>

</html>
