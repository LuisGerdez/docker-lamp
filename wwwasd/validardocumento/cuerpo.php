
<div class="container">
  <br>
  <div class="text-center mb-4">
    <h1><img src="<?php echo LOGOWHITE ?>" align="middle" width="150" height="50" /></h1>
  </div>
  <br>
  <h2>Valide la autenticidad de su documento</h2>
  <br>
  <form action="" class="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="tokenCSRF" id="tokenCSRF">
    <div class="form-group">
     <label for="file-upload" class="custom-file-upload">
      <i class="fa fa-cloud-upload"></i> Seleccione su archivo
    </label>
    <input name="archivo" id="file-upload" type="file" accept="application/pdf"/>
  </div>
  <div class="form-group input-group-lg">
    <label for="usr">Nombre del documento:</label>
    <input type="text" class="form-control" id="nombre" disabled="">
  </div>
  <div class="form-group input-group-lg">
    <label for="usr">Tama&ntilde;o:</label>
    <input type="text" class="form-control" id="peso" disabled="">
  </div>
  <div class="form-group input-group-lg">
    <label for="usr">Extensi&oacute;n del archivo:</label>
    <input type="text" class="form-control" id="tipo" disabled="">
  </div>
  <div class="form-group input-group-lg">
    <label for="usr">C&oacute;digo de Verificaci&oacute;n:</label>
    <input type="text" class="form-control" name="code" id="codigo" disabled="disabled">
  </div>
  <div class="col text-center">
    <a href="../administrar/" class="btn btn-primary btn-lg">Regresar</a>
    <button type="submit" id="submit" class="btn btn-primary btn-lg" disabled="disabled">Validar documento</button>
  </div>
</form>
</div>

<?php
include "SED.php";
include '../conexion.php';
include "../Models/CSRFToken.php";
session_start();

if (isset($_FILES['archivo']['tmp_name']) && isset($_POST['code'])) {
  $codigo1 = md5_file($_FILES['archivo']['tmp_name']);
  $claveE = $_POST['code'];
  $minlength = strlen($claveE);

  if ($minlength <= 31) {
    
    echo "<script>Swal.fire({
      icon: 'warning',
      title: 'El código de verificación es invalido',
      confirmButtonColor: '#3085d6',
      confirmButtonText:
      'Aceptar',
    allowOutsideClick: false
    })</script>";
    
  } else {
    $code_decrypted = SED::decryption($claveE);

    // Se establece la variable como 'doc' por defecto antes de comprobar si es un documento o un certificado
    $validation_type = 'doc';

    // Si la cantidad de caracteres es menor que 5 se entiende que es un documento, sino se verifica
    if(strlen($code_decrypted) > 5) {
      // Si el codigo desencriptado tiene el prefijo 'cert-', entonces es un certificado
      $prefix = substr($code_decrypted, 0, 5);
      $validation_type = ($prefix == 'cert-') ? 'certificadofirma' : 'doc';
    }

    $resultado = $link->query("SELECT " . $validation_type . "_hash FROM documento WHERE " . $validation_type . "_hash = '$claveE'");
    $fila = $resultado->fetch_assoc();

    if (!$fila) {

      echo "<script>Swal.fire({
        icon: 'warning',
        title: 'El código de verificación es invalido',
        confirmButtonColor: '#3085d6',
        confirmButtonText:
        'Aceptar',
    allowOutsideClick: false
      })</script>";

    } else {

      $codigo2 = SED::decryption($claveE);
      
      if($validation_type == 'doc') {
        $sql = "SELECT doc_md5 FROM documento WHERE doc_id = $codigo2 and doc_hash = '$claveE'";
      } else {
        $cert_document_id = substr($code_decrypted, strpos($code_decrypted, "-") + 1);
        $sql = "SELECT certificadofirma_md5 FROM documento WHERE doc_id = $cert_document_id and certificadofirma_hash = '$claveE'";
      }

      $result = $link->query($sql);
      $fila = $result->fetch_assoc();
      $validacion = $fila[$validation_type.'_md5'];

      if ($codigo1 != $validacion || $validacion == null) {

        echo "<script>Swal.fire({
          icon: 'error',
          title: 'El documento no es auténtico',
          confirmButtonColor: '#3085d6',
          confirmButtonText:
          'Aceptar',
    allowOutsideClick: false
        })</script>";
        echo "<script>console.log('Invalido');</script>";

      } else if(CSRFToken::verifyToken($_SESSION['csrf'], $_POST['tokenCSRF'])) {

       echo "<script>Swal.fire({
        icon: 'success',
        title: 'El documento es auténtico',
        confirmButtonColor: '#3085d6',
        confirmButtonText:
        'Aceptar',
        allowOutsideClick: false
      })</script>";
      echo "<script>console.log('Valido');</script>";

    }
  }
}
}
?>

<script type="text/javascript">
  $(document).ready(function () {
    $('#file-upload').change(function(){
      $('#submit').prop('disabled', this.files.length == 0);
      $('#codigo').prop('disabled', false).focus();
      $('#submit').prop('disabled', true);
      $('#codigo').on('input change', function () {
        if ($(this).val() != '') {
          $('#submit').prop('disabled', false);
        }
      });
    });
  });

  let archivo = document.querySelector('#file-upload');
  archivo.addEventListener('change',() => {
    document.getElementById('nombre').value = archivo.files[0].name;
    document.getElementById('peso').value = archivo.files[0].size+' bytes';
    var ext = $('#file-upload').val().split('.').pop();
    document.getElementById('tipo').value = ext;
  });
</script>

<?= CSRFToken::setToken(); ?>