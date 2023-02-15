
//Cerrado del SIDEBAR
$(document).ready(function() {
    $("#sidebar").mCustomScrollbar({
        theme: "minimal"
    });

    $('#sidebarCollapse').on('click', function() {
        $('#sidebar, #content').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
});

//Cambio de pagina sin recargar
$(document).ready(function() {
    $("#pendientes").click(function() {
        $("#content").load("../vista/pendientes.php");
    });
    $("#firmados").click(function() {
        $("#content").load("../vista/firmados.php");
    });
    $("#eliminados").click(function() {
        $("#content").load("../vista/eliminados.php");
    });
    $("#carpetas").click(function() {
        $("#content").load("../vista/carpetas.php");
    });
});

//active class
const links = document.querySelectorAll("li.button");
        links.forEach(button => button.addEventListener("click", (e) => {
            e.preventDefault();
            document.querySelector(".button.active").classList.remove("active");
            button.classList.add("active")
        }));

