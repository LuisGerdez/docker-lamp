<?php
@session_start(['name'=>'SITI']);
/*
*   Software development - Ing. Bernabe Sanchez Lenis
*/
require_once "../config/APP.php";
require_once '../session.php';
?>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo COMPANY ?></title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo FAVICON ?>">
<link rel=stylesheet href="css/header.css" type="text/css" media=screen>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
<link rel=stylesheet href="css/menu-lateral.css" type="text/css" media=screen>
<link rel=stylesheet href="css/tabla-firmados.css" type="text/css" media=screen>
<link rel="stylesheet" type="text/css" href="css/datatables/DataTables-1.11.3/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="css/sweetalert2.css">
</head>
<body style="padding: 0; margin: 0; background-color:#EEEEEE">
<?php include '../menu.php' ?>
<?php $pagina = isset($_GET['p']) ? strtolower($_GET['p']) : 'pendientes'; ?>
<?php include './menu-lateral.php' ?>

<!-- <div class="menu__container" style="margin-left:16%"> -->
<div class="menu__container">
<?php require_once $pagina.'.php'; ?>
<div id="contenido_principal">
</div>

</div>

<script type="text/javascript" src="css/datatables/jquery/jquery-3.5.1.js"></script>
<script type="text/javascript" src="css/datatables/DataTables-1.11.3/js/jquery.dataTables.min.js"></script>
<script src="js/sweetalert2.js"></script>
<script type="text/javascript" src="js/pendientes.js"></script>
<script type="text/javascript" src="js/firmados.js"></script>
<script type="text/javascript" src="js/eliminados.js"></script>

<script type="text/javascript">
  var serv = "<?php echo SERVERURL ?>";
  window.onload=function() {
      listar_pendientes(serv);
      dropdwon();
      listar_firmados(serv);
      listar_eliminados();
    }
  function abrirOpcion(contenedor,contenido) {
    $("#"+contenedor).load(contenido);
  }
</script>
</body>
</html>