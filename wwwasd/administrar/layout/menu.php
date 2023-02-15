
<div class="menu-container">
    <div class="logo" >
        <?php if ($_SESSION['rol'] == 3) : ?>
            <a href="#"><img src="../../recursos/logito.png" alt="alt" width="320" height="60"></a>

            <!-- <a href="#"><img src="../img/Suntic.png" alt="alt" width="125" height="45" /></a> -->
        <?php else : ?> 
            <a href="../../dashboard/"><img   src="../../recursos/logito.png" alt="alt" width="320" height="60"></a>
            <!-- <a href="#"><img src="../img/Suntic.png" alt="alt" width="125" height="45" /></a> -->
        <?php endif; ?>
    </div>

    <div>
    <?php if ($_SESSION['rol'] != 3) : ?>
        <ul id="menu-listado" style="    margin-left: -28%;" class='nav'>
            <li><a href="../../dashboard" onclick="closeMobileMenu();">Inicio</a></li>
            <li><a href="./layout.php?menu=pendientes_entrada" onclick="closeMobileMenu();">Documentos</a></li>
            <li><a href="../../plantillas" onclick="closeMobileMenu();">Plantillas</a></li>
        </ul>
    <?php endif;  ?>
   
    </div>
    <div style='padding-top: 3%;'>
            <div class="usuario">
            <a id="boton" href="#">  <?php echo "<small style='     font-size: 88%;   padding-right: 8px;    font-size: 16px;
    padding-top: 5px;'>".$_SESSION['nombre_usuario']."</small>";?>
           <img src="../../recursos/iconos/colombia1.png"></a>
           
            </div>
            
           
            <div id="submenu" style="display:none;" class="submenu">
                <ul class="subs1">
                    <li><a href="../../perfil/">Datos Personales</a></li>
                    <li><a href="../../firma_propia/">Cargue grafo/firma</a></li>
                    <li <?php if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 4): ?> style="display: none;" <?php endif; ?>><a href="../../gestion_documentos/">Gestion Documentos</a></li>
                    <li <?php if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 4): ?> style="display: none;" <?php endif; ?>><a href="../../gestion_usuarios/">Gestion Usuarios</a></li>
                    <li><a href="../../cerrar_sesion.php">Salir</a></li>
                </ul>
            </div>
    </div>
    <div class="menu-icon" onclick="handleClick();">
        <i id="menu-icono" class='fas fa-bars'></i>
    </div>
</div>

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