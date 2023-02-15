<?php
@session_start(['name'=>'SITI']);
$codigo_usuario = $_SESSION['codigo_usuario'];

if (isset($_POST['nombre_archivo'])) {
    $nombre_archivo = $_POST['nombre_archivo'];
}

if(isset($_POST['publica'])){
    
    include '../conexion.php';
    
    $sql_certdigital = "select usu_rutafidi from usuario where usu_id = $codigo_usuario";
    $certificado_dig = mysqli_query($link, $sql_certdigital);
    $ruta_firmapfx = $certificado_dig->fetch_row();

    $file = $ruta_firmapfx[0];
    
    $llavepublica = $_POST['publica'];
    
    $almacen_cert = file_get_contents($file);
    
    if (openssl_pkcs12_read($almacen_cert, $info_cert, $llavepublica)) {
        $clave_valida = true;
    }else{
        echo "<script>alert('La contraseña no es valida para este certificado.')</script>";
    }
}
?>

<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>

	var clave = "<?php echo $clave_valida?>"

    function enviarFormulario(clave) {
    	let publica = document.getElementById('txtPassword').value;
    	if(publica){
    		document.formulario.submit();
    	}else{
    		alert('Por favor ingrese la clave');
    	}
    }
    
    function volverAtras(){
        history.go(-1)
    }
    
</script>

<div class="cuerpo-container">
    <form action="firmardigitalmente.php" method="post" target="" name="formulario" id="formulario">
    	<div class="cuerpo-clave">
    		<span>Clave privada:</span>
    		<div class="input_container">
    			<input type="password" name="publica" id="txtPassword" class="control" autofocus>
    			<span id="imgContrasena" data-activo=false><img src="https://cdn3.iconfinder.com/data/icons/show-and-hide-password/100/show_hide_password-09-256.png" class="icon"></span>
    		</div>
    	</div>
        <div class="cuerpo-pdf">
            <div>
                <embed src="../bodega/precarga/<?php echo $codigo_usuario?>/<?php echo $nombre_archivo?>" type="application/pdf" width="100%" height="600px" />
            </div>
        </div>
        <div class="cuerpo-botones">
            <button type="button" title="volver" onclick="volverAtras();"><i class="fas fa-arrow-left"></i>Volver</button>
           
            <button type="button" title="siguiente" onclick="enviarFormulario();" name="firmar">Firmar<i class="fas fa-arrow-right"></i></button>
           
        </div>
        <input type="hidden" name="nombre_archivo" value="<?php echo $nombre_archivo?>" />
    </form>
</div>

<script>
$("#imgContrasena").click(function () {

  var control = $(this);
  var estatus = control.data('activo');

  var image = control.find('img');
  if (estatus == false) {
  
    control.data('activo', true);
    $(image).attr('src', 'https://cdn3.iconfinder.com/data/icons/show-and-hide-password/100/show_hide_password-10-256.png');
    $("#txtPassword").attr('type', 'text');
  }
  else {
  
    control.data('activo', false);
    $(image).attr('src', 'https://cdn3.iconfinder.com/data/icons/show-and-hide-password/100/show_hide_password-09-256.png');
    $("#txtPassword").attr('type', 'password');
  }
});
</script>