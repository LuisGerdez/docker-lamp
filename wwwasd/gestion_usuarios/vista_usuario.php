<?php
$numero_documento = $_SESSION['cedula_usuario'];

function traerDatos()
{
    include "../conexion.php";
    $datos = mysqli_query(
        $link,
        "SELECT usu_id,usu_estado,usu_nombre,usu_apelli,usu_tipo_documento,usu_docume,usu_email,usu_celula,id_rol,nombre_rol FROM usuario LEFT JOIN roles_usuario ON usuario.rol_usuario = roles_usuario.id_rol "
    );
    mysqli_close($link);
    return $datos;
}

function iterarDatos($data)
{
    $lines = '';
    while ($row = mysqli_fetch_array($data)) {
        $lines .= '<tr>
        <td>'  . $row['usu_estado']   . '</td>
        <td>'  . $row['usu_nombre']   . '</td>
        <td>'  . $row['usu_apelli']   . '</td>
        <td>'  . $row['usu_tipo_documento'] . '</td>
        <td>'  . $row['usu_docume']   . '</td>
        <td>'  . $row['usu_email']    . '</td>
        <td>'  . $row['usu_celula']   . '</td>
        <td>'  . $row['nombre_rol']   . '</td>
        <td>
        <select class="selector">
        <option selected="true" disabled="disabled">Selecciona una opción</option>
            <option  id="certificado"  data="Certificado" value="' . $row['usu_id'] . '">      
                Certificado
            </option>
            
        ';
        if ($row['usu_estado'] == 'A' && $row['id_rol'] != 1) {
            
            $lines .= '<option title="Bloquear Usuario" style="color:red;" id="desactivar" value="' . $row['usu_id'] . '">
            Desactivar usuario
            </option>';
        } else if ($row['usu_estado'] == 'I' && $row['id_rol'] != 1) {
            $lines .= '<option title="Desbloquear Usuario"  id="activar" value="' . $row['usu_id'] . '">
            Desbloquear usuario
            </option>';
        }
        if ($row['id_rol'] != 1) {
            $lines .= '<option title="Hacer Admin"  id="admin" style="color:rgb(118 192 45);"value="' . $row['usu_id'] . '">
            Convertir en Admin
            </option>
            
            </select>
            </td>
            </tr>';
        }
    }
    return $lines;
}
$documentos_suscriptores = traerDatos();
$lines = iterarDatos($documentos_suscriptores);
?>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<div class="table-wrapper">
    <table class="fl-table" id="datatable">
        <thead>
            <tr>
                <th class="thead">Estado</th>
                <th class="thead">Nombres</th>
                <th class="thead">Apellidos</th>
                <th class="thead">Tipo Documento</th>
                <th class="thead">Documento</th>
                <th class="thead">Email</th>
                <th class="thead">Telefono</th>
                <th class="thead">Rol</th>
                <th class="thead">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $lines;
            ?>
        </tbody>
    </table>
</div>
<script>
const selectElements = document.querySelectorAll('.selector');
for (let i = 0; i < selectElements.length; i++) {
    selectElements[i].addEventListener('change', (event) => {
        const selectedValue = event.target.value;
        const selectedOption = event.target.options[event.target.selectedIndex];
        const selectedText = selectedOption.text;
        executar(selectedText, selectedValue);
    });
}
function executar(selectedText, selectedValue) {
    switch (selectedText) {
        case 'Certificado':
            action = 'id_certificado';
            break;
        case 'Desactivar usuario':
            action = 'id_desactivar';
            break;
        case 'Activar usuario':
            action = 'id_activar';
            break;
        case 'Convertir en Admin':
            action = 'id_admin';
            break;
    }
    $.ajax({
        url: "./controller/usuario_controlador.php",
        type: "POST",
        data: {
            id: selectedValue,
            text: action
        },
        success: function(result) {
            switch (action) {
                case 'id_certificado':
                    if (!$.trim(result)) {
                        alert('El usuario no se encuentra enrolado');
                    } else {
                        var link = document.createElement("a");
                        document.body.appendChild(link);
                        link.setAttribute("type", "hidden");
                        link.href = "data:application/pdf;base64," + result;
                        link.download = 'certificado.pdf';
                        link.click();
                        document.body.removeChild(link);
                        location.reload();
                    }
                    break;
                case 'id_desactivar':
                    location.reload();
                    alert('Usuario desactivado con éxito');
                    break;
                case 'id_activar':
                    location.reload();
                    alert('Usuario activado con éxito');
                    break;
                case 'id_admin':
                    location.reload();
                    alert('Administrador asignado con éxito');
                    break;
            }
        },
        error: function(result) {
            alert('Error inesperado, intente nuevamente mas tarde.');
        }
    })
}
</script>