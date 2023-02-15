<?php
include('../controller/CarpetasController.php');
@session_start(['name' => 'SITI']);


$datos = allFolder($_SESSION['codigo_usuario'], 'Carpetas');
$lines = ShowFolder($datos);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpetas</title>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <!-- CSS only -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        a {
            text-decoration: none;
            color: white;
            font-family: 'Poppins', sans-serif;
        }
        .container-folder{
            position: relative;
            width: 100%;
            height: 80%;
            margin-top: 20%;

        }
    </style>
</head>

<body>
    <?php

    echo $lines;

    ?>

    <button style='
    position:absolute;
    top: 10px;
    left: 10px;
    background: #6d7fcc;

    ' id='crearfolder' type='button' class='btn btn-primary'>Crear
        carpeta</button>

        <?php
        echo $lines;
        ?>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> -->

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <!-- Large modal -->



    <script>
    $(document).ready(function() {

        $(document).on("click", "#botonfield", function() {
            let id = $(this).val();
            $.ajax({
                type: "POST",
                url: "../controller/fieldsviewmodal.php",
                data: "id=" + id,
                success: function(response) {
                    $("#modal").modal("show");
                    $("tbody").html(response);
                },
            })

        });
        $(document).on("click", "#botoneliminar", function() {
            var id = $(this).val();
            console.log(id);

            Swal.fire({
                title: 'Estas Seguró?',
                text: "la carpeta sera eliminidada!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar carpeta!',

            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "../controller/eliminarcarpeta.php",
                        data: "id=" + id,
                        success: function(response) {
                            console.log(response);
                            Swal.fire({
                                icon: 'success',
                                title: 'Ha sido eliminado correctamente',
                                showConfirmButton: false,
                                timer: 1500,

                            })

                            function actualizar() {
                                location.reload(true);
                            }
                            setTimeout(actualizar, 1000);
                        },
                    })
                }

            })

        });
        $(document).on("click", "#crearfolder", function() {
            let id = $(this).val();
            $.ajax({
                type: "POST",
                url: "../controller/crearcarpeta.php",
                data: "id=" + id,
                success: function(response) {
                    $("#modal2").modal("show");
                    $(".table-wrapper2").html(response);
                },
            })



        });


    });
</script>

</body>

<?php
include_once 'modal.php';
include_once 'modal2.php';
?>
<script>
    document.getElementById('crearfolder').addEventListener('click', () => {

        let formulario = document.getElementById('formFolder');
        
        formulario.addEventListener('submit', (e) => {

            e.preventDefault();
            
            const form2 = document.getElementById('formFolder');
            const nombre = document.getElementById('nombre').value.trim();
            const tokenSession = '<?= $_SESSION['csrf']; ?>';
            const tokenField = form2.children[0].value;

            if(nombre == '') alert('Campo vacio');
            else if(tokenSession != tokenField) alert("Error");
            else e.target.submit();
        });
    });
</script>
</html>