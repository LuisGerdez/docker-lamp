
<link rel=stylesheet href="css/header.css" type="text/css" media=screen>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
<link rel=stylesheet href="css/menu-lateral.css" type="text/css" media=screen>
<link rel=stylesheet href="css/tabla-firmados.css" type="text/css" media=screen>
<link rel="stylesheet" type="text/css" href="css/datatables/DataTables-1.11.3/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="css/sweetalert2.css">

<script>
    let click = false;
    
    function handleClick() {
        click = !click
        if(click){
            document.getElementById('menu-icono').className = 'fas fa-times';
            document.getElementById('menu-listado').className = 'nav active';
        }else{
            document.getElementById('menu-icono').className = 'fas fa-bars';
            document.getElementById('menu-listado').className = 'nav';
        }
    }
    
    function closeMobileMenu(){
        click = false;
        document.getElementById('menu-icono').className = 'fas fa-bars';
        document.getElementById('menu-listado').className = 'nav';
    }
</script>

<div class="header-container">
    <div class="logo">
        <img src="../recursos/logo.png" alt="alt" width="120" height="45" />
    </div>
    <div class="menu-icon" onclick="handleClick();">
        <i id="menu-icono" class='fas fa-bars'></i>
    </div>
    <ul id="menu-listado" class='nav'>
        <li><a href="<?php echo SERVERURL ?>dashboard/" onclick="closeMobileMenu();">Inicio</a></li>
        <li><a href="#" onclick="closeMobileMenu();">Gestionar</a></li>
        <li><a href="#" onclick="closeMobileMenu();">Plantillas</a></li>
        <li><a href="#" onclick="closeMobileMenu();">Informes</a></li>
        <li><a href="#" onclick="closeMobileMenu();">Configuraci&oacute;n</a></li>
    </ul>
    <div class="usuario">
        <button>Ver planes</button>
        <i class="fas fa-user-circle"></i>
    </div>
</div>