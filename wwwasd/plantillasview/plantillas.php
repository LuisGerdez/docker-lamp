
<head>
  <link rel=stylesheet href="../plantillasview/css/style_plantillas.css" type="text/css" media=screen>
</head>
<?php
@session_start(['name'=>'SITI']);

include_once '../config/APP.php';

$codigo_usuario = $_SESSION['codigo_usuario'];
$ini1 = $_SESSION['nombre_usuario'];
$ini2 = $_SESSION['apellido_usuario'];
$URL = $_GET['nombreArchivo'];

//variables
include '../menu.php';?>

<script>
  function enviarFormulario() {
    document.formulario.submit();
  }

  function cargarDocumento() {
    document.formulario.submit();
  }
</script>

<script type="text/javascript">
  function volverAtras() {
    history.go(-1)
  }
</script>

<input type="hidden" name="ini1" id="ini1" value='<?php echo  $ini1?>'>
<input type="hidden" name="ini2" id="ini2"value='<?php echo  $ini2?>'>

 <form action="../validacionview/index.php" method="post" enctype="multipart/form-data" target="" name="formulario"
 id="formulario">
 <?php
    for ($i=0; $i <count($id_plantillas) ; $i++) { 
        switch ($id_plantillas[$i]) {
            case '1':
                $fields= QueryData(1);
                foreach ($fields as $key) {
                 $array[]= $key['valores'];                   
                }
                $tradefecha = $array[1];
                $tradename = $array[2];
                $trade1 = $array[3];
                $trade2 = $array[4];
                $trade3 = $array[5];
                $tradeserie = $array[6];
                $tradecuenta = $array[7];
                $tradebanco = $array[8];
                $tradenumber =$array[9];
                $tradepoliza = $array[10];
                $tradeservicio = $array[11];
                 include_once "../plantillasview/tradein_pronto_pago.php";
                break;
            
            case '2':
              $fields= QueryData(2);
              foreach ($fields as $key) {
                $array2[]= $key['valores'];                   
               }
                $vehi_nombre_comprador=$array2[1];
                $vehi_direccion_residencial=$array2[2];
                $vehi_postal=$array2[3];
                $vehi_fecha=$array2[4];
                $vehi_social=$array2[5];
                $vehi_nacimiento=$array2[6];
                $vehi_licencia=$array2[7];
                $vehi_telefono=$array2[8];
                $vehi_celular=$array2[9];
                $vehi_correo=$array2[10];
                ///array de checkbox
                $vehi_check=$array2[11];              //////

                $vehi_stock=$array2[12];
                $vehi_año=$array2[13];
                $vehi_marca=$array2[14];
                $vehi_modelo=$array2[15];
                $vehi_vin=$array2[16];
                $vehi_color=$array2[17];
                $vehi_millaje=$array2[18];
                $vehi_tablilla=$array2[19];
                $vehi_marbete=$array2[20];
                $vehi_vence=$array2[21];
                $vehi_marca2=$array2[22];
                $vehi_modelo2=$array2[23];
                $vehi_año2=$array2[24];
                $vehi_vin2=$array2[25];

                $vehi_tablilla2=$array2[26];
                $vehi_millaje2=$array2[27];
                $vehi_color2=$array2[28];
                $vehi_balance=$array2[29];
                $vehi_marbete2=$array2[30];
                $vehi_vence2=$array2[31];
                //array2
                $vehi_check2=$array2[32];	/////

                $vehi_usado=$array2[33];
                $vehi_balance_adeudado=$array2[34];
                $vehi_credito_neto=$array2[35];
                $vehi_pago_contado=$array2[36];
                $vehi_credito_asufavor=$array2[37];
                $vehi_otros_pagos=$array2[38];
                $vehi_credito_total=$array2[39];
                $vehi_pronto_recibido=$array2[40];
                $vehi_recibo=$array2[41];
                $vehi_precio_unidad=$array2[42];
                $vehi_puertas=$array2[43];
                $vehi_cilindros=$array2[44];
                $vehi_transmision=$array2[45];
                $vehi_Caballaje=$array2[46];
                $vehi_total=$array2[47];
                $vehi_gap=$array2[48];
                $vehi_seguro_doble=$array2[49];
                $vehi_seguro_vida=$array2[50];
                $vehi_contrato_servicio=$array2[51];
                $vehi_tablillas=$array2[52];
                $vehi_seguro_ACAA=$array2[53];
                $vehi_precio_total=$array2[54];
                $vehi_balance_apagar=$array2[55];

                $vehi_plazo1=$array2[57];
                $vehi_numplazo1=$array2[56];
                $vehi_fecha1=$array2[58];

                $vehi_plazo2=$array2[60];
                $vehi_numplazo2=$array2[59];
                $vehi_fecha2=$array2[61];

                $vehi_bancoporcentaje=$array2[62];
                $vehi_observaciones=$array2[63];
              include_once "../plantillasview/venta_vehicular.php";
                break;
            
            case '3':
              $fields= QueryData(3);
              foreach ($fields as $key) {
                $array3[]= $key['valores'];                   
               }
                $pagofecha1= $array3[1];
                $pagofecha2= $array3[2];
                $pagofecha3= $array3[3];

                $pagoname= $array3[4];
                $pagomodelo= $array3[5];
                $pagoaño= $array3[6];

                $pagocuenta= $array3[7];
                $pagofinancia= $array3[8];

                $compania_seguro = $array3[14];
                $compania_seguro_poliza = $array3[11];

                $contrato_servicio = $array3[10];
                $contrato_servicio_poliza = $array3[11];

                $gap = $array3[12];
                $gap_poliza = $array3[13];
              include_once "../plantillasview/pago_vehiculo.php";
                break;
            
            case '4':
              $fields= QueryData(4);
              foreach ($fields as $key) {
                $array4[]= $key['valores'];                   
               }
                $namequote= $array4[1];
                $fechaquote= $array4[2];
                $vendedorquote= $array4[3];
                $precioquote= $array4[4];
                $gastosquote= $array4[5];
                $totalquote= $array4[6];
                $prontoquote= $array4[7];
                $balancequote= $array4[8];
                $tradequote= $array4[9];
                $entidadquote= $array4[10];
                $terminoquote= $array4[11];
                $pagoquote= $array4[12];
                $marcaquote= $array4[13];
                $modeloquote= $array4[14];
                $versionquote= $array4[15];
                $añoquote= $array4[16];
                $millajequote= $array4[17];
                $tablillaquote= $array4[18];
              include_once "../plantillasview/Estimado_quote.php";
                break;
            
            case '5':
              $fields=QueryData(5);
              foreach ($fields as $key) {
                $array5[]= $key['valores'];                   
               }
               $mul_name=$array5[1];
               $mul_marca=$array5[2];
               $mul_modelo=$array5[3];
               $mul_año=$array5[4];
               $mul_tablilla=$array5[5];
               $mul_serie=$array5[6];
               $mul_trade=$array5[7];
              include_once "../plantillasview/multas.php";
                break;
            case '6':
              $fields=QueryData(6);
              foreach ($fields as $key) {
                $array6[]= $key['valores'];                   
               }

               $rec_control=$array6[1];
               $rec_fecha=$array6[2];
               $rec_stock=$array6[3];
               $rec_vin=$array6[4];
               $rec_de=$array6[5];
               $rec_cantidad=$array6[6];
               $rec_vehiculo=$array6[7];
               $rec_concepto=$array6[8];
               $tipo_pago=$array6[9];
               $rec_num=$array6[10];

               //$efectivo=$array6[8];
               //$transferencia=$array6[9];
               //$cheque=$array6[10];
              include_once "../plantillasview/pronto_pago.php";
                break;          
            case '7':
              $fields=QueryData(7);
              foreach ($fields as $key) {
                $array7[]= $key['valores'];                   
               }
                $garamarca = $array7[1];
                $garamodelo = $array7[2];
                $garaaño =  $array7[3];
                $garaserie =  $array7[4];
                $garainventario =  $array7[5];
                $garamillaje =  $array7[6];
                $garatablilla =  $array7[7];
                $garaprecio =  $array7[8];
                $tipo_garantia =  $array7[9];
                $confirmacion= $array7[10];
              include_once "../plantillasview/documento_garantia.php";
                break;
        }
    }   

    function QueryData($id_plantilla)
    {
      include '../conexion.php';
      require_once '../session.php';
      include '../dominio.php';
      $doc_id=$_POST['doc_id'];
      $sql="SELECT * FROM  valores_plantilla WHERE doc_id='".$doc_id."' AND id_plantilla='".$id_plantilla."'";
      $result = $link->query($sql);  
      return $result;            
    }

?>
<!-- DATOS DEL FORMULARIO -->
<div class="datos-formulario">
                        <input type="hidden" name="formulario_plantilla" value="true">                     
                        <input type="hidden" name="codigo_usuario" value='<?php echo $_POST['doc_usuari']?>'>
                        <input type="hidden" name="codigo_documento" value='<?php echo $_POST['codigo_documento']?>'>
                        <input type="hidden" name="codigo_detalle_documento" value='<?php echo $_POST['codigo_detalle_documento']?>'>
                        <input type="hidden" name="nombreArchivo" value="<?= explode("/",$URL)[4]?>">
                        <input type="hidden" name="Ruta" value=<?= $URL ?>>

                    </div>

                    <div class="cuerpo-botones">
                    <button type="button" title="volver" onclick="volverAtras();"><i
                            class="fas fa-arrow-left"></i>Volver</button>
                    <button title="siguiente" type="submit" name="siguiente">Siguiente<i
                            class="fas fa-arrow-right"></i></button>
            </div>
 </form>
 
<script>
    let INPUT =document.querySelectorAll("input[type=checkbox]");
    console.log(INPUT.length);
    for (let i = 0; i < INPUT.length; i++) {
      const element = INPUT[i].style.cssText = 'pointer-events: none;';
      
    }

   

    const formulario = document.getElementById("formulario");
    const inputs = document.getElementsByClassName("firma");

    formulario.addEventListener("submit", (event) => {
      // Convertir la colección de elementos en un verdadero arreglo
      const inputArray = [].slice.call(inputs);

      // Comprobar si algún campo está vacío y prevenir el envío del formulario
      if (inputArray.some((input) => !input.value.trim())) {
        alert("Debe insertar todas las iniciales");
        event.preventDefault();
      }
    });


</script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="../plantillasview/js/global.js"></script>
    