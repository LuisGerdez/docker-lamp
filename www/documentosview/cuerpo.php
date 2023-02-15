<?php
$codigo_usuario = $_SESSION['codigo_usuario'];
$IdForm=$_SESSION['IdForm'];
$nombreArchivo=$_POST['nombreArchivo'];

// $idArchivo = NULL;
// $nombreArchivo = NULL;
// $rutaArchivo = NULL;
// $prueba_tipoDoc = $_FILES['nombre_archivo']['type'];

// if (isset($_POST['formulario_plantilla'])) {
//     $formulario_plantilla = $_POST['formulario_plantilla'];
// }

// if (!isset($_POST['nombreArchivo'])) {
//     if(strlen($_FILES['nombre_archivo']['name']) > 64){
//         echo "<script>alert('El nombre del archivo es demasiodo extenso (máximo 60 caracteres)')</script>";
//         header('Refresh: 0.01; URL=../dashboard/');
//     }else{
//         // print_r($_FILES['nombre_archivo']['name']);
//         $tipo_documento = substr($_FILES['nombre_archivo']['name'], -4);
        
//         $nombre_archivo = $_FILES['nombre_archivo']['name'];
//         $dir_subida = "../bodega/precarga/$codigo_usuario/$nombre_archivo";
//         echo $dir_subida;
//         move_uploaded_file($_FILES['nombre_archivo']['tmp_name'], $dir_subida);
        
//         if($tipo_documento == "docx"){
//             $nombre_sin_extension = substr($_FILES['nombre_archivo']['name'],0, -5);
//             $nuevo_nombre = $nombre_sin_extension.".pdf";
//             //echo $nuevo_nombre;
//             //directorio de las dependencias
//             require './vendor/autoload.php';
            
//             //crear objeto de la case PHPWord
//             $phpWord = new \PhpOffice\PhpWord\PhpWord();
            
//             //Definimos constante del directorio del proyecto
//             define('PHPWORD_BASE_DIR', realpath(__DIR__));
            
//             //ruta donde se encuentra dompdf
//             $domPdfPath = realpath(PHPWORD_BASE_DIR . '/vendor/dompdf/dompdf');
            
//             //le pasamos a la configuración de phpword la librería que queremos utilizar para convertir word a pdf
//             \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
//             \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
            
//             //cargar el archivo de word a convertir a pdf
//             $phpWord = \PhpOffice\PhpWord\IOFactory::load("../bodega/precarga/$codigo_usuario/$nombre_archivo");
            
//             //convertimos el archivo a pdf
//              $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'PDF');
//              $xmlWriter->save("../bodega/precarga/$codigo_usuario/$nuevo_nombre");

//             $nombre_archivo = $nuevo_nombre;
//         } 
//         // else{
//         //     echo '<script language="javascript">alert("No se aceptan archivos diferentes a Docx o PDF");</script>';
//         //     $nombre_archivo = "";
//         //     header("Refresh:0; url=../dashboard/index.php");
//         // }
//     }
    
// } else {
//     if ($formulario_plantilla) {
//         $nombre_archivo = $_POST['nombreArchivo'];
//     }else{
//         $nombre_archivo = $_FILES['nombre_archivo']['name'];
//         $idArchivo = $_POST['idArchivo'];
//         $nombreArchivo = $_POST['nombreArchivo'];
//         $rutaArchivo = $_POST['rutaArchivo'];
//         $archivo_p = "../bodega/precarga/$codigo_usuario/$nombreArchivo";
//         $dir_subida = "../bodega/precarga/$codigo_usuario/$nombre_archivo";

//         if (file_exists($archivo_p)) {
//             move_uploaded_file($_FILES['nombre_archivo']['tmp_name'], $dir_subida);
//         }
//     }
// }
?>

<script>
    function enviarFormulario() {
        
        let option = document.getElementById('opciones_firma').value;
        if(option==''){
            alert('Selecione un tipo de firma');
            return false;
        }else if(option=='firma_digital'){
            //document.formulario.action = '../firmar_digitalmente/';
        }else if(option=='unico_firmante'){
           // document.formulario.action = '../preparar/';
        }else{
            document.formulario.action = '../destinatariosview/';
        }
        document.formulario.submit();
    }
    function volverAtras(){
    history.go(-1)
}
</script>

<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>

<div class="cuerpo-container">
    <form action="#" method="post" target="" name="formulario" id="formulario" class="container-contenido">
        <label>A&ntilde;adir documentos</label>
        <div class="cuerpo-documento">
            <div class="cuerpo-detalle"  style="word-wrap: break-word;">
                <?php echo $nombre_archivo; ?>
            </div>
        </div>
        <div class="cuerpo-complemento">
   
            <div class="complemento-items">
                
            <div class="cuerpo-detalle">
            
            </div>
           
                <!-- <select name="opciones_firma" id="opciones_firma" class="dropdown">
                    <option value="" name="firma_digital" id="firma_digital">Seleccione una opción</option>
                    <option value="firma_digital" name="firma_digital" id="firma_digital">Certificado digital</option> 
                    <option value="no_firmante" name="no_firmante" id="no_firmante">Solo destinatarios</option>
                    <option value="unico_firmante" name="unico_firmante" id="unico_firmante">Soy el unico firmante</option>
                    <option value="varios_destinatarios" name="varios_destinatarios" id="varios_destinatarios">Remitente y Destinatarios</option>
                </select> -->


                <select name="opciones_firma" id="opciones_firma" class="dropdown">
                    <option value="" name="firma_digital" id="firma_digital">Seleccione los firmantes</option>
                    <option value="no_firmante" name="no_firmante" id="no_firmante">Otro/s</option>
                    <option value="unico_firmante" name="unico_firmante" id="unico_firmante">Yo</option>
                    <option value="varios_destinatarios" name="varios_destinatarios" id="varios_destinatarios">Yo y otro/s</option>
                </select>
                <button class="btn_volver"type="button" title="volver" onclick="volverAtras();"><i class="fas fa-arrow-left"></i>Volver</button>
                <button onclick="return enviarFormulario();">Siguiente<i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
        <div class="cuerpo-informacion">
            <p><h2>Opciones</h2></p>
            <p>&#10148; <u>Utilizar Certificado digital</u>: Permite firmar con certificado digital.</p>
            <p>&#10148; <u>No soy firmante</u>: Permite enviar el documento para firmar electr&oacute;nicamente sin firmar el usuario de la plataforma.</p>
            <p>&#10148; <u>Soy el &uacute;nico firmante</u>: Permite firmar electr&oacute;nicamente sin enviar el documento a otras personas.</p>
            <p><em><u>Nota</u>: Si decide no escoger una opci&oacute;n el software firmara electr&oacute;nicamente con su usuario registrado en nuestra plataforma y a los destinatarios que se le env&iacute;a el correo con la solicitud.</em></p>
        </div>
    </form>
</div>