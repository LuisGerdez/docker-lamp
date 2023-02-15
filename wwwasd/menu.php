<LINK REL=StyleSheet HREF="../menu.css" TYPE="text/css" MEDIA=screen>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<div class="menu-container">
    <div class="logo">
        <?php if ($_SESSION['rol'] == 3) : ?>
            <a href=""><img src="../recursos/logito.png" alt="alt" width="320" height="60"></a>
        <?php else : ?>
            <a href="../dashboard/"><img src="../recursos/logito.png" alt="alt" width="320" height="60"></a>
        <?php endif; ?>
    </div>

    <div>
        <?php if ($_SESSION['rol'] != 3) : ?>
            <ul id="menu-listado" style="    margin-left: -28%;" class='nav'>
                <li><a href="../dashboard" onclick="closeMobileMenu();">Inicio</a></li>
                <li><a href="../administrar" onclick="closeMobileMenu();">Documentos</a></li>
                <li><a href="../plantillas" onclick="closeMobileMenu();">Plantillas</a></li>
            </ul>
        <?php endif; ?>
    </div>
    <div>
        <div class="usuario">
            <a id="boton" href="#"> <?php echo "<small style='    font-size: 16px;    padding-right: 8px;
            padding-top: 2px;'>" . $_SESSION['nombre_usuario'] . "</small>"; ?>
                <img src="../recursos/iconos/colombia1.png"></a>
        </div>
        <div id="submenu" style="display:none;" class="submenu">
            <ul class="subs1">
                <li><a href="../perfil/">Datos Personales</a></li>
                <li><a href="../firma_propia/">Cargue grafo/firma</a></li>
                <li <?php if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 4): ?> style="display: none;" <?php endif; ?>><a href="../gestion_documentos/">Gestion Documentos</a></li>
                <li <?php if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 4): ?> style="display: none;" <?php endif; ?>><a href="../gestion_usuarios/">Gestion Usuarios</a></li>
                <li><a href="../cerrar_sesion.php" class="btn_salir">Salir</a></li>
                <!-- <button type="button" class="btn btn-light btn_salir" id="salir"  onclick="cerrarSesion()">Salir</button> -->
            </ul>
        </div>
    </div>
    <div class="menu-icon" onclick="handleClick();">
        <i id="menu-icono" class='fas fa-bars'></i>
    </div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script>
    let click = false;
    let click_submenu = false;

    function handleClick() {
        click = !click

        if (click) {
            document.getElementById('menu-icono').className = 'fas fa-times';
            document.getElementById('menu-listado').className = 'nav active';
        } else {
            document.getElementById('menu-icono').className = 'fas fa-bars';
            document.getElementById('menu-listado').className = 'nav';
        }
    }

    function closeMobileMenu() {
        click = false;
        document.getElementById('menu-icono').className = 'fas fa-bars';
        document.getElementById('menu-listado').className = 'nav';
    }

</script>

<script>
    var div = document.getElementById('submenu');
    var but = document.getElementById('boton');

    //la funcion que oculta y muestra
    function showHide(e) {
        e.preventDefault();
        e.stopPropagation();

        if (div.style.display === "none") {
            div.style.display = "block";
        } else if (div.style.display === "block") {
            div.style.display = "none";
        }
    }
    //al hacer click en el boton
    but.addEventListener("click", showHide, false);

    //funcion para cualquier clic en el documento
    document.addEventListener("click", function(e) {
        //console.log('clic');
        //obtiendo informacion del DOM para  
        var clic = e.target;
        //console.log(clic);
        if (div.style.display === "block" && clic !== div) {
            div.style.display = "none";
        }
    }, false);
</script>