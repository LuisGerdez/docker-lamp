<?php
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use iio\libmergepdf\Merger;

require_once "../config/APP.php";
require '../vendor/autoload.php';

$codigo_usuario = $_SESSION['codigo_usuario'];
$nombreArchivo = $_POST['nombreArchivo'];

//array de plantillas que recibe
$Templates = $_POST['templates'];

$options = [
    'region' => 'us-east-1',
    'version' => 'latest',
    'credentials' => [
        'key' => 'AKIAR5YN5DPDAVDEBXAH',
        'secret' => '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'
    ]
];

// FUNCIONES PARA IMPRIMIR LA HOJA FIRMADA
foreach ($Templates as $TempId) {
	switch ($TempId) {
		case '1':
			$route[]=".".template($TempId,1);
			$array[]=template($TempId,0);
			break;
		case '2':
			$route[]=".".template2($TempId,1);
			
			$array[]=template2($TempId,0);
			break;
		case '3':
			$route[]=".".template3($TempId,1);
			$array[]=template3($TempId,0);
			break;
		case '4':
			$route[]=".".template4($TempId,1);
			$array[]=template4($TempId,0);
			break;
		case '5':
			$route[]=".".template5($TempId,1);
			$array[]=template5($TempId,0);
			break;
		case '6':
			$route[]=".".template6($TempId,1);
			$array[]=template6($TempId,0);
			break;
		case '7':
			$route[]=".".template7($TempId,1);
			$array[]=template7($TempId,0);
			break;
	}
}

// firma de los documentos
# Crear el "combinador"
$combinador = new Merger;

# Agregar archivo en cada iteración
foreach ($route as $documento) {
	$combinador->addFile($documento);
}

// Obetener la id del creador del documento
$cod_documento = $_POST['codigo_documento'];
$resource = $link->query("SELECT doc_usuari FROM documento WHERE doc_id = '$cod_documento'");
$row = $resource->fetch_assoc();
$codigo_creator = $row['doc_usuari'];

$salida = $combinador->merge();
$nombreArchivo = "../bodega/precarga/".$_SESSION['codigo_usuario']."/".rand()."-DocumentSigned=User".$_SESSION['codigo_usuario']."date-".date("Ymd")."-Merge.pdf";
$ruta = $nombreArchivo; 
$name = explode("/",$nombreArchivo)[4];
$nombre_documento = $name;
file_put_contents($nombreArchivo, $salida);

// Se copia el archivo generado en la bodega del creador del documento
$ruta_creator = str_replace('/'.$_SESSION['codigo_usuario'].'/', '/'.$codigo_creator.'/', $ruta);
copy($ruta, $ruta_creator);

// DOCUMENTO: TRADE IN
function template($TempId, $ruta) {
	include '../conexion.php';

	$sql="SELECT * FROM valores_plantilla WHERE id_plantilla='1' AND doc_id='".$_SESSION['codigo_documento']."'";
	$valores= $link->query($sql);

	foreach ($valores as $key) {
		$arrayValores[]=$key['valores'];
	}

	$tradefecha = $arrayValores[1];
	$tradename = $arrayValores[2];
	$trade1 = $arrayValores[3];
	$trade2 = $arrayValores[4];
	$trade3 = $arrayValores[5];
	$tradeserie = $arrayValores[6];
	$tradecuenta = $arrayValores[7];
	$tradebanco = $arrayValores[8];
	$tradenumber =$arrayValores[9];
	$tradepoliza = $arrayValores[10];
	$tradeservicio = $arrayValores[11];

	//firma es lo unico que recibire
	$firma= $_POST['firma'];
	$firma2= $_POST['firma2'];
	$firma3= $_POST['firma3'];
	$firma4= $_POST['firma4'];

	// create new PDF document
	include('../vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}

	// remove default header/footer
	$pdf->setPrintHeader(false);

	// -------------------------------------------------------------------

	// add a page
	$pdf->AddPage();

	// set JPEG quality
	$pdf->setJPEGQuality(75);

	TCPDF_FONTS::addTTFfont('Cherolina.ttf',  'TrueTypeUnicode', '', 32);

	// ---------------------------------------------------------
	// Image example with resizing
	$pdf->Image('../documentos/images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'C',false,
	false, false, false, false, false);

	// crear html
	$html="
		<style>
			small { text-align:center; font-family:'Cherolina'; font-size:40px; }
			b { text-align:center; }
			a { color: black; text-decoration:none; font-size:10px; text-align:center; font-weight:bolder; }
		</style>

		<div class='col-md-12 text-center'>
			<a>Auto1pr.com</a>
			<a>ACUERDO SUPLEMENTARIO<br>SOBRE VEHÍCULO TOMADO COMO PRONTO PAGO (TRADE IN)</a>
		</div>

		<div class='col-md-12'>
			<label for=''>Fecha: </label>
			<b>".$tradefecha."</b>

			<br>
			
			<label style='padding-right:5px;'>Yo,
				<b>".$tradename."</b> hago constar que le he entregado a <b>Auto1pr.com</b>, en
				calidad de pronto pago (trade in) el vehículo de motor, marca <b>".$trade1."</b>,
				modelo <b>".$trade2."</b> con tablilla <b>".$trade3."</b> y número de serie
				<b>".$tradeserie."</b> (el 'Vehículo'), por lo que autorizo a <b>Auto1pr.com</b> a
				efectuar el traspaso de la titularidad de este a nombre de cuales quiera de sus
				subsiguientes adquirientes.
			</label>
			
			<br>
			INICIALES     <small> $firma</small>
			
			<br><br>
				
			Represento que la unidad descrita no tiene gravamen de hipoteca, o algún otro gravamen que no
			sea el correspondiente a la cuenta #<b>".$tradecuenta." </b>mantenida con el banco
			<b>".$tradebanco."</b> (el 'Financiamiento'). En la eventualidad que esta
			representación resulte incorrecta, me comprometo a tomar, dentro de los diez (10) días
			requerido, a aquellas medidas necesarias para liberar el Vehículo de todos y cada uno de
			los gravámentes que tenga, con la única excepción del Financiamiento.
			
			<br>
			INICIALES      <small> $firma2</small>
			
			<br><br>

			Por este medio AUTORIZO a <b>Auto1pr.com</b> a liquidar el balance pendiente de pago del
			Financimiento, balance que represento asciende a $
			<b>".$tradenumber."</b> y CEDO a favor de éste cualquier diferencial que pueda
			surgir por concepto de primas de seguros no devengadas y/o por concepto de un balance de
			cancelación inferior al aquí informado, número de Póliza
			<b>".$tradepoliza." </b>, o Contrato de Servicio <b>".$tradeservicio."</b>. Revelo a <b>Auto1.PR.com</b> de toda obligacipon que
			pudiera tener de traspasar el Vehículo a nombre suyo antes de venderlo al adquiriente
			subsiguiente.
			
			<br>
			INICIALES      <small> $firma3</small>
			
			<br><br>

			Al momento de la transacción se ha estimado que el balance a pagar para el saldo de
			financiamiento del Vehículo es el arriba
			indicado; También me comprometo a entregar balance de cancelación de la institución en la
			cual tiene deuda. No obstante,
			si al momento de liquidar dicho financiamiento, se encuentra que el balance de saldo fuera
			mayor al aquí informado, o si el vehículo
			tuviese otras deudas o gravámenes no informados al presente, o de estar alguna multa
			pendiente de pago o registro ante cualquier agencia pública de deficiencia y/o a pagar
			dichas cantidades dentro de diez (10)
			días desde que se me notifique la existencia de estas. En todo caso, REVELO a <b>Auto1pr.com</b> de
			toda la responsabilidad u obligación asociada
			con y me comprometo a indemnizarle (reembolsarle), cualquier pago que realice por dichos
			conceptos.

			<br>
			INICIALES      <small> $firma4</small><
			
			br><br>"
	;

	$pdf->writeHTML($html, true, false, true, false, '');
	$codigo_usuario = $_SESSION['codigo_usuario'];
	$bodega = '/../bodega/precarga/'.$codigo_usuario.'/pdfs+remitente='.$codigo_usuario.'+idForm='.$TempId.'.pdf';

	$_SESSION['nombreArchivo'] = explode("/",$bodega)[5];	

	if (!file_exists($bodega)) {
		mkdir($bodega, 0777, true);
	}

	$pdf->Output(__DIR__.$bodega,'F');

	// para mandar el nombre de la bodega y el array de los valores de la plantilla
	if ($ruta == 1) {
		return $bodega;
	} else {
		return $valores;
	}
}

// DOCUMENTO : FACTURA VENTA
function template2($TempId, $ruta) {	
	include '../conexion.php';

	$sql="SELECT * FROM valores_plantilla WHERE id_plantilla='2' AND doc_id='".$_SESSION['codigo_documento']."'";
	$valores= $link->query($sql);

	foreach ($valores as $key) {
		$arrayValores2[]=$key['valores'];
	}

	$vehi_nombre_comprador=$arrayValores2[1];
	$vehi_direccion_residencial=$arrayValores2[2];
	$vehi_postal=$arrayValores2[3];
	$vehi_fecha=$arrayValores2[4];
	$vehi_social=$arrayValores2[5];
	$vehi_nacimiento=$arrayValores2[6];
	$vehi_licencia=$arrayValores2[7];
	$vehi_telefono=$arrayValores2[8];
	$vehi_celular=$arrayValores2[9];
	$vehi_correo=$arrayValores2[10];
	///array de checkbox
	$vehi_check=$arrayValores2[11];              //////

	$vehi_stock=$arrayValores2[12];
	$vehi_año=$arrayValores2[13];
	$vehi_marca=$arrayValores2[14];
	$vehi_modelo=$arrayValores2[15];
	$vehi_vin=$arrayValores2[16];
	$vehi_color=$arrayValores2[17];
	$vehi_millaje=$arrayValores2[18];
	$vehi_tablilla=$arrayValores2[19];
	$vehi_marbete=$arrayValores2[20];
	$vehi_vence=$arrayValores2[21];
	$vehi_marca2=$arrayValores2[22];
	$vehi_modelo2=$arrayValores2[23];
	$vehi_año2=$arrayValores2[24];
	$vehi_vin2=$arrayValores2[25];

	$vehi_tablilla2=$arrayValores2[26];
	$vehi_millaje2=$arrayValores2[27];
	$vehi_color2=$arrayValores2[28];
	$vehi_balance=$arrayValores2[29];
	$vehi_marbete2=$arrayValores2[30];
	$vehi_vence2=$arrayValores2[31];
	//array2
	$vehi_check2=$arrayValores2[32];	/////

	$vehi_usado=$arrayValores2[33];
	$vehi_balance_adeudado=$arrayValores2[34];
	$vehi_credito_neto=$arrayValores2[35];
	$vehi_pago_contado=$arrayValores2[36];
	$vehi_credito_asufavor=$arrayValores2[37];
	$vehi_otros_pagos=$arrayValores2[38];
	$vehi_credito_total=$arrayValores2[39];
	$vehi_pronto_recibido=$arrayValores2[40];
	$vehi_recibo=$arrayValores2[41];
	$vehi_precio_unidad=$arrayValores2[42];
	$vehi_puertas=$arrayValores2[43];
	$vehi_cilindros=$arrayValores2[44];
	$vehi_transmision=$arrayValores2[45];
	$vehi_Caballaje=$arrayValores2[46];
	$vehi_total=$arrayValores2[47];
	$vehi_gap=$arrayValores2[48];
	$vehi_seguro_doble=$arrayValores2[49];
	$vehi_seguro_vida=$arrayValores2[50];
	$vehi_contrato_servicio=$arrayValores2[51];
	$vehi_tablillas=$arrayValores2[52];
	$vehi_seguro_ACAA=$arrayValores2[53];
	$vehi_precio_total=$arrayValores2[54];
	$vehi_balance_apagar=$arrayValores2[55];

	$vehi_plazo1=$arrayValores2[57];
	$vehi_numplazo1=$arrayValores2[56];
	$vehi_fecha1=$arrayValores2[58];

	$vehi_plazo2=$arrayValores2[60];
	$vehi_numplazo2=$arrayValores2[59];
	$vehi_fecha2=$arrayValores2[61];

	$vehi_bancoporcentaje=$arrayValores2[62];
	$vehi_observaciones=$arrayValores2[63];

	$firma5= $_POST['firma5'];

	$vehi_credito_total2=0;

	include('../vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}

	// remove default header/footer
	$pdf->setPrintHeader(false);

	// -------------------------------------------------------------------

	// add a page
	$pdf->AddPage('P', 'A4');

	// set JPEG quality
	$pdf->setJPEGQuality(75);

	// ---------------------------------------------------------
	// Image example with resizing
	$pdf->Image('../documentos/images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'L', false, false, false, false, false, false);
	
	/////////INPUTS DEL FORMULARIA VENTA VEHICULAR (NUEVO) O (USADO)
	$input1=<<<EOD
		<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   /> 
		EOD;
	$input2=<<<EOD
		<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   /> 
		EOD;
	
	switch ($vehi_check) {
		case '1':
			$input1=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;
		case '2':
			$input2=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;
		
		default:
			# code...
			break;
	}

	////inputs de abajo
	$licencia=<<<EOD
	<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   /> 
	EOD;

	$titulo=<<<EOD
	<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   /> 
	EOD;

	$certificacion=<<<EOD
	<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   /> 
	EOD;

	switch ($vehi_check2) {
		case '1':
			$licencia=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;
		case '2':
			$titulo=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;
		case '3':
			$certificacion=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		default:
			# code...
			break;
	}

	// crear html
	$html=<<<EOD
		<style>
			* { font-family: Arial, Helvetica, sans-serif; font-size:10px; }
			b { text-align: center; }
			h5 { border-bottom:1px solid black; }
			th { cellpadding:10px; padding: 5px; border:1px solid black; }
			td { cellpadding:10px; }
			table { cellpadding:10px; }
		</style>

		<table>
			<tr>
				<td colspan="4">
					NOMBRE DEL COMPRADOR: <b>$vehi_nombre_comprador</b>
					
					<br>

					<small>Dirección Residencial:</small>
					<h5>$vehi_direccion_residencial</h5>
					
					<br>
					
					<small>Dirección Postal:</small>
					<h5>$vehi_postal</h5>
				</td>
				
				<td>
					<small>
						Fecha Entrega:<br>
						Seg. Social:<br>
						Fecha de Nacimiento:<br>
						No. licencia:<br>
						Teléfono:<br>
						Celular:<br>
						Correo Electrónico:
					</small>
				</td>

				<td width="200px">
					<small>
						$vehi_fecha<br>
						$vehi_social<br>
						$vehi_nacimiento<br>
						$vehi_telefono<br>
						$vehi_celular<br>
						$vehi_licencia<br>
						$vehi_correo
					</small>
				</td>
			</tr>
		</table>

		<table>
			<tr>
				<th style="background-color:black;color:white;border:3px solid black;" colspan="3">
					<b>VEHÍCULO VENDIDO</b>
				</th>

				<th style="border-right:3px solid black;border-top:3px solid black;"colspan="2">
					PRECIO UNIDAD
				</th>

				<th style="border-right:3px solid black;border-top:3px solid black;">
					$<b>$vehi_precio_unidad</b>
				</th>
			</tr>

			<tr>
				<th style="border:3px solid black;" rowspan="2" colspan="3">
					Nuevo ($input1) Usado ($input2) Stock # <b>$vehi_stock</b>  Año: <b>$vehi_año</b>
					<br>
					Marca: <b>$vehi_marca</b> Modelo: <b>$vehi_modelo</b>
					<br>
					VIN:<b>$vehi_vin</b> Color: <b>$vehi_color</b> Millaje:<b>$vehi_millaje</b>
					<br>
					Tablilla:<b>$vehi_tablilla</b> Marbete: <b>$vehi_marbete</b> Vence: <b>$vehi_vence</b>
				</th>

				<th style="border-right:3px solid black;" rowspan="2" colspan="2">
					Puertas:<b>$vehi_puertas</b> Cilindros: <b>$vehi_cilindros</b>
					<br><br>
					Transmisión: <b>$vehi_transmision</b>
					<br>
					Caballaje: <b>$vehi_Caballaje</b>
				</th>

				<th style="border-right:3px solid black;"rowspan="2"></th>
			</tr>

			<tr>
				<td></td>
			</tr>

			<tr>
				<th colspan="5" style="border-right:3px solid black;border-left:3px solid black;"></th>
				<th style="border-right:3px solid black;">
					$<b>$vehi_total</b>
				</th>
			</tr>

			<tr>
				<th colspan="3" style="background-color:black;color:white;border:3px solid black;">
					<b>VEHÍCULO USADO TOMADO A CAMBIO</b>
				</th>

				<th colspan="2" style="border-right:3px solid black;">
					Gap
				</th>
				
				<th style="border-right:3px solid black;">
					$<b>$vehi_gap</b>
				</th>
			</tr>

			<tr>
				<th style="border-left:3px solid black;border-right:3px solid black;" colspan="3">
					Marca: <b>$vehi_marca2</b> Modelo: <b>$vehi_modelo2 </b> Año: <b>$vehi_año2</b>
				</th>

				<th colspan="2" style="border-right:3px solid black;">
					Seguro Doble()
				</th>

				<th style="border-right:3px solid black;">
					$<b>$vehi_seguro_doble</b>
				</th>
			</tr>

			<tr>
				<th style="border-left:3px solid black;border-right:3px solid black;" colspan="3">
					VIN: #<b>$vehi_vin2</b> Tablilla: <b>$vehi_tablilla2</b>
				</th>
				<th colspan="2"style="border-right:3px solid black;">Seguro de vida</th>
				<th style="border-right:3px solid black;">$<b>$vehi_seguro_vida</b></th>
			</tr>

			<tr>
				<th style="border-left:3px solid black;border-right:3px solid black;" colspan="3">Millaje: <b>$vehi_millaje2</b> Color: <b>$vehi_color2</b></th>
				<th colspan="2"style="border-right:3px solid black;">Contrato de servicio:</th>
				<th style="border-right:3px solid black;">$<b>$vehi_contrato_servicio</b></th>
			</tr>

			<tr>
				<th style="border-left:3px solid black;border-right:3px solid black;"colspan="3">Balance Adeudado A: <b>$vehi_balance</b></th>
				<th colspan="2"style="border-right:3px solid black;">Tablillas:</th>
				<th style="border-right:3px solid black;">$<b>$vehi_tablillas</b></th>
			</tr>

			<tr>
				<th style="border-left:3px solid black;border:3px solid black;" rowspan="3" colspan="3">
					Marbete: <b>$vehi_marbete2</b>  Vence: <b>$vehi_vence2</b>
					<br>
					Cliente entregó: ($licencia) Licencia   ($titulo) Título  <small style="text-align:center;font-family:'Cherolina';font-size:40px;">$firma5</small>
					<br>
					($certificacion) Certificación Multas AutoExpreso
				</th>

				<th colspan="2" style="border-right:3px solid black;">SeguroACAA</th>
				<th style="border-right:3px solid black;">
					$<b>$vehi_seguro_ACAA</b>
				</th>
			</tr>

			<tr>
				<th colspan="2"style="border-right:3px solid black;">Precio Total</th>
				<th style="border-right:3px solid black;">$<b>$vehi_precio_total</b></th>
			</tr>

			<tr>
				<th colspan="2"style="border-right:3px solid black;">Crédito Total</th>
				<th style="border-right:3px solid black;">$<b>$vehi_credito_total</b></th>
			</tr>

			<tr>
				<th colspan="2" style="border-right:3px solid black;border-left:3px solid black;">Crédito por Carro Usado</th>
				<th style="border-right:3px solid black;">$<b>$vehi_usado</b></th>
				<th colspan="2"style="border-right:3px solid black;">Balance a Pagar</th>
				<th style="border-right:3px solid black;">$<b>$vehi_balance_apagar</b></th>
			</tr>

			<tr>
				<th style="border-right:3px solid black;border-left:3px solid black;" colspan="2">Balance Adeudado</th>
				<td style="border-right:3px solid black;">$<b>$vehi_balance_adeudado</b></td>
				<th colspan="3" style="border:3px solid black;background-color:black;color:white;" ><b>BALANCE-CONTRATO A PAGARSE DE ACUERDO CON</b></th>
			</tr>

			<tr>
				<th style="border-right:3px solid black;border-left:3px solid black;" colspan="2">Crédito Neto</th>
				<th style="border-right:3px solid black;">$<b>$vehi_credito_neto</b></th>
				<th style="border:3px solid black;"colspan="3" >
					En <b>$vehi_numplazo1</b> plazos mensuales de $<b>$vehi_plazo1</b> con fecha de <b>$vehi_fecha1</b>
					
					<br>

					En <b>$vehi_numplazo2</b> plazos mensuales de $ <b>$vehi_plazo2</b> con fecha de <b>$vehi_fecha2</b>
					
					<br>
					
					First Bank al <b>$vehi_bancoporcentaje</b>
				</th>
			</tr>

			<tr>
				<th style="border-right:3px solid black;border-left:3px solid black;"colspan="2">Pago de Contado</th>
				<th style="border-right:3px solid black;">$<b>$vehi_pago_contado</b></th>
				<th style="border:3px solid black;"colspan="3">
					Observaciones:
					<label><br> <b>$vehi_observaciones</b></label>
				</th>
			</tr>

			<tr>
				<th style="border-right:3px solid black;border-left:3px solid black;"colspan="2">Crédito a su favor</th>
				<td style="border-right:3px solid black;">$<b>$vehi_credito_asufavor</b></td>
				<th style="border:3px solid black;" rowspan="4"colspan="3"><b><u>NO ACEPTAMOS DEVOLUCIONES</u></b><br><small>De devolver su unidad o cancelación de contrato de razon justificada. Auto 1
				LLC, le cobrará $95.00 diarios
				por el uso del vehículo. En adición, se cobrará millaje y depreciación según
				establece la ley. Los "Documents Fees"
				o "Gastos de cierre" <b>NO</b> son reembolsables una vez firmado la factura y el
				contrato.</small></th>
			</tr>

			<tr>
				<th style="border-right:3px solid black;border-left:3px solid black;"colspan="2">Otros Pagos</th>
				<th style="border-right:3px solid black;">$<b>$vehi_otros_pagos</b></th>
			</tr>

			<tr>
				<th style="border-right:3px solid black;border-left:3px solid black;" colspan="2">Crédito Total</th>
				<th style="border-right:3px solid black;">$<b>$vehi_credito_total2</b></th>
			</tr>

			<tr>
				<th style="border:3px solid black;"colspan="3">Pronto Recibido $<b>$vehi_pronto_recibido</b> <label>                         Recibo # <b>$vehi_recibo</b></label></th>
			</tr>

			<tr>
				<th colspan="6" style="border:3px solid black;">
				<p> NOTA: El comprador expresamente garantiza que el automóvil usado entregado a cuenta, si alguno, está libre de todo gravámen o contrato de venta consicional y que la licencia del mismo
				debidamente endosada será entregada a la vendedora con el vehículo. Se entiende que toda compra a plazos mediante contrato de venta condicional y/o hipoteca sobre bienes. En caso de que el comprador exprese su opción por cierta financiadora particular para el financiamiento del balance de esta venta, sele conceden 10 días de esta fecha para trae a la vendedora el aporte
				de este balance y en caso de transcurrir dicho término sin que haya pagado dicho balance la vendedora quedará en libertad de utilizar cualquier entidad financiadora para cobrarse dicho balance. En tal caso se entenderá que tal actuación de la vendedora tiene autorización expresa del comprador.
				El comprador ha representado a la vendedora ser mayor de edad, todo vehículo usado se cende de acuerdo a la garantía estipulada por la ley. En caso de tratarse de la compra de un vehículo nuevo, la vendedora expresamente concede al
				comprador la garantía normal en carros nuevos que concedo la casa manufacturera cuya garantía es de conocimiento del comprador. Aunque esta orden este firmada por un vendedor no obligará en forma alguna a la vendedora, hasta tanto haya sido aprobada y firmada por uno de los oficiales del la casa. Esta orden de compra y el contrato de venta condicional correspondiente y/o el contrato de hipoteca sobre bienes muebles, si la venta es a plazos, contiene por escrito todas las condiciones
				del negocio.</p></th>
			</tr>
		</table>
	EOD;

	$pdf->writeHTML($html, true, false, true, false, '');

	$codigo_usuario = $_SESSION['codigo_usuario'];
	$bodega = '/../bodega/precarga/'.$codigo_usuario.'/pdfs2+remitente='.$codigo_usuario.'+idForm='.$TempId.'.pdf';
	$_SESSION['nombreArchivo']=explode("/",$bodega)[5];					
	
	if (!file_exists($bodega)) {
		mkdir($bodega,0777,true);
	}

	$pdf->Output(__DIR__.$bodega,'F');
	
	if ($ruta==1) {
		return $bodega;
	} else {
		return $valores;
	}
}

// DOCUMENTO : PAGO DE VEHICULO
function template3($TempId, $ruta) {
	//datos recibidos
	include '../conexion.php';

	$sql="SELECT * FROM valores_plantilla WHERE id_plantilla='3' AND doc_id='".$_SESSION['codigo_documento']."'";
	$valores= $link->query($sql);

	foreach ($valores as $key) {
		$arrayValores3[]=$key['valores'];
	}

	$pagofecha1= $arrayValores3[1];
	$pagofecha2= $arrayValores3[2];
	$pagofecha3= $arrayValores3[3];

	$pagoname= $arrayValores3[4];
	$pagomodelo= $arrayValores3[5];
	$pagoaño= $arrayValores3[6];

	$pagocuenta= $arrayValores3[7];
	$pagofinancia= $arrayValores3[8];

	$compania_seguro = $arrayValores3[14];
	$compania_seguro_poliza = $arrayValores3[11];

	$contrato_servicio = $arrayValores3[10];
	$contrato_servicio_poliza = $arrayValores3[11];

	$gap = $arrayValores3[12];
	$gap_poliza = $arrayValores3[13];

	// create new PDF document
	include('../vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}

	// remove default header/footer
	$pdf->setPrintHeader(false);

	// -------------------------------------------------------------------

	// add a page
	$pdf->AddPage();

	// set JPEG quality
	$pdf->setJPEGQuality(75);

	// ---------------------------------------------------------
	// Image example with resizing
	$pdf->Image('../documentos/images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'C', false, false, false, false, false, false);

	// crear html
	$html="
		<style>
			small { text-align: center; }
		</style>

		<div class='col-md-12 text-center'>
			<small><b>Auto1pr.com</b></small>
			<br>
			<small><b>Po Box 8458 Ponce PR 00732</b></small>
			<br>
			<small><b>Tel. 787-843-1111</b></small>
		</div>

		<br>
		<br>

		<div class='col-md-12'>
			<b>".$pagofecha1."</b>
			<label for=''> de </label>
			<b>".$pagofecha2."</b>
			<label for=''> de </label>
			<b>".$pagofecha3."</b>
			
			<br>

			<label style='padding-right:5px;'><b>Liquidación de Trade In Reclamo de Prima No devengada</b></label>
			
			<br>
		
			<label style='padding-right:5px;'>A quien puede interesar:</label>
		
			<br>
		
			<label style='padding-right:5px;'>Por este medio yo, <b>".$pagoname."</b>
			autorizo <b>Auto1pr.com</b> a realizar gestiones de liquidar el financiamiento y/o balance
			de cancelación del vehículo que se describe a continuación:</label>
		
			<br>
		
			<label style='padding-right:5px;'>Modelo: <b>".$pagomodelo."</b> Año: <b>".$pagoaño."</b></label>
		
			<br>
			<br>
		
			<label style='padding-right:5px;'>El mismo está a mi nombre, con el número de cuenta # </label> <b>".$pagocuenta."</b>
		
			<br>
		
			<label style='padding-right:5px;'>Y con la institución financiera <b>".$pagofinancia."</b>. Entiendo también que al saldar la cuenta y cancelar la
			póliza de seguro y/o contrato de servicio, el importe de la prima no
			devengada le corresponderá <b>Auto1pr.com</b> como responsable de la liquidación de la
			misma.</label>
		
			<div style='padding-bottom:300px;'>
				<br>
				<br>
			
				<label style='padding-right:5px;'>Compañía de seguro:</label> <b>".$compania_seguro."</b>
				<label>Póliza:</label>
				<b>".$compania_seguro_poliza."</b>
			
				<br>
				<br>
			
				<label style='padding-right:5px;'>Contrato de servicio:</label> <b>".$contrato_servicio."</b> Póliza: </label><b> ".$contrato_servicio_poliza."</b>
				<br>
				<br>
			
				<label style='padding-right:5px;'>Gap:</label><b> ".$gap."</b>
				<label>Póliza: </label><b> ".$gap_poliza."</b>
			</div>
		</div>"
	;

	$pdf->writeHTML($html, true, false, true, false, '');
	$codigo_usuario = $_SESSION['codigo_usuario'];
	$bodega = '/../bodega/precarga/'.$codigo_usuario.'/pdfs3+remitente='.$codigo_usuario.'+idForm='.$TempId.'.pdf';
	$_SESSION['nombreArchivo']=explode("/",$bodega)[5];					
	if (!file_exists($bodega)){
		mkdir($bodega,0777,true);
	}	
	$pdf->Output(__DIR__.$bodega, 'F');
	if ($ruta==1) {
		return $bodega;
	}else {
		return $valores;
	}
}
// DOCUMENTO ESTIMADDO/QUOTE
function template4($TempId, $ruta) {
	include '../conexion.php';

	$sql="SELECT * FROM valores_plantilla WHERE id_plantilla='4' AND doc_id='".$_SESSION['codigo_documento']."'";
	$valores= $link->query($sql);

	foreach ($valores as $key) {
		$arrayValores4[]=$key['valores'];
	}

	$namequote= $arrayValores4[1];
	$fechaquote= $arrayValores4[2];
	$vendedorquote= $arrayValores4[3];
	$precioquote= $arrayValores4[4];
	$gastosquote= $arrayValores4[5];
	$totalquote= $arrayValores4[6];
	$prontoquote= $arrayValores4[7];
	$balancequote= $arrayValores4[8];
	$tradequote= $arrayValores4[9];
	$entidadquote= $arrayValores4[10];
	$terminoquote= $arrayValores4[11];
	$pagoquote= $arrayValores4[12];
	$marcaquote= $arrayValores4[13];
	$modeloquote= $arrayValores4[14];
	$versionquote= $arrayValores4[15];
	$añoquote= $arrayValores4[16];
	$millajequote= $arrayValores4[17];
	$tablillaquote= $arrayValores4[18];

	// create new PDF document
	include('../vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');



	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}
	// remove default header/footer
	$pdf->setPrintHeader(false);


	// -------------------------------------------------------------------

	// add a page
	$pdf->AddPage();
	// set JPEG quality
	$pdf->setJPEGQuality(75);

	// ---------------------------------------------------------
	// Image example with resizing
	$pdf->Image('../documentos/images/Logo.jpg', 15, 14, 70, 15, 'JPG', '', '', true, 150, 'L',false, false, false, false, false, false);

	// crear html
	$html="
			<p></p>
			<p></p>
			
			<p>
				Estimado/a: <b> ".$namequote."</b>
				<br>
				A continuación le brindamos los números para su análisis
			</p>

			<p>
				<b style='float:left;'>Fecha:</b> <b>".$fechaquote."</b>
			</p>

			<p>
				<b style='float:left;'>Vendedor:</b> <b>".$vendedorquote."</b>
			</p>

			<br>

			<p>
				<small><b>Precio de Venta:</b></small>
			</p>

			<label for=''>$ <b>".$precioquote."</b></label>

			<br>
			<br>

			<b>Gastos de traspaso: </b>
			<label>$ <b>".$gastosquote."</b></label>

			<br>

			<b>Total: </b><label>$ <b>".$totalquote."</b></label>

			<br>
			<br>

			<label for=''><small>
			<b>Forma de pago:</b></small></label>

			<br>

			<b>Pronto: </b><b>".$prontoquote."</b>

			<br>
			<br>

			<b>Balance a financiar: </b><label>$ <b>".$balancequote."</b></label>

			<br>
			<br>

			<b>Trade in: </b><label>$ <b>".$tradequote."</b></label>

			<br>
			<br>
			<br>

			<small><b>Balance a financiar: </b></small><label></label>

			<br>
			<br>

			<b>Entidad financiera: </b><label> <b>".$entidadquote."</b></label>

			<br>

			<b>Término: </b><label> <b>".$terminoquote."</b></label>

			<br>

			<b>Pago mensual: </b><label>$ <b>".$pagoquote."</b></label>

			<br>
			<br>
			<br>

			<small><b>Auto a cambio: </b></small><label></label>

			<br>
			<br>

			<b>Marca: </b><label> <b>".$marcaquote."</b></label>

			<br>

			<b>Modelo: </b><label> <b>".$modeloquote."</b></label>

			<br>

			<b>Versión: </b><label> <b>".$versionquote."</b></label>

			<br>

			<b>Año: </b><label> <b>".$añoquote."</b></label>

			<br>

			<b>Millaje: </b><label> <b>".$millajequote."</b></label>

			<br>

			<b>Tablilla: </b><label> <b>".$tablillaquote."</b></label>
		</div>"
	;
	
	$pdf->writeHTML($html, true, false, true, false, '');
	$codigo_usuario = $_SESSION['codigo_usuario'];
	$bodega = '/../bodega/precarga/'.$codigo_usuario.'/pdfs4+remitente='.$codigo_usuario.'+idForm='.$TempId.'.pdf';
	$_SESSION['nombreArchivo']=explode("/",$bodega)[5];					
	
	if (!file_exists($bodega)) {
		mkdir($bodega,0777,true);
	}

	$pdf->Output(__DIR__.$bodega, 'F');
	
	if ($ruta==1) {
		return $bodega;
	} else {
		return $valores;
	}
}

// COMPROMISO DE PAGO DE MULTAS
function template5($TempId, $ruta){
	include '../conexion.php';

	$sql="SELECT * FROM valores_plantilla WHERE id_plantilla='5' AND doc_id='".$_SESSION['codigo_documento']."'";
	$valores= $link->query($sql);

	foreach ($valores as $key) {
		$arrayValores5[]=$key['valores'];
	}

	$mul_name=$arrayValores5[1];
	$mul_marca=$arrayValores5[2];
	$mul_modelo=$arrayValores5[3];
	$mul_año=$arrayValores5[4];
	$mul_tablilla=$arrayValores5[5];
	$mul_serie=$arrayValores5[6];
	$mul_trade=$arrayValores5[7];

	// create new PDF document
	include('../vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}

	// remove default header/footer
	$pdf->setPrintHeader(false);

	// -------------------------------------------------------------------

	// add a page
	$pdf->AddPage();
	// set JPEG quality
	$pdf->setJPEGQuality(75);

	// ---------------------------------------------------------
	// Image example with resizing
	$pdf->Image('../documentos/images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'C',false, false, false, false, false, false);

	// crear html
	$html="
		<style>/* ESTILOS DE LOS LOGOS DE CADA PLANTILLA */

			h5{
				text-align:center;
			}

		</style>

		<div class='datos-container-formulario'>

			<div id='divcolor' class='x_panel col-md-8'>
				<div style='text-align:center;margin:auto;' class='col-md-12 text-center'>
					<h5><u><b>COMPROMISO DE PAGO DE MULTAS AUTO TOMADO EN TRADE IN</b></u></h5>
				</div>

				<br>
				<br>

				<div class='col-md-12'>
					<label style='padding-right:5px;'>Yo, </label><input
						style='border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;' type='text' name='mul_name'
						id='mul_name'><label id='a'for=''><b>".$mul_name."</b>, dueño del vehiculo.</label>
					
					<br>

					<label style='padding-right:5px;'>Marca:</label> <b>".$mul_marca."</b>

					<br>

					<label style='padding-right:5px;'>Modelo:</label><b> ".$mul_modelo."</b>

					<br>

					<label style='padding-right:5px;'>Año:</label> <b>".$mul_año."</b>

					<br>

					<label style='padding-right:5px;'>Tablilla:</label> <b>".$mul_tablilla."</b>

					<br>

					<label style='padding-right:5px;'>Núm. de serie:</label> <b>".$mul_serie."</b>

					<br>
					<br>

					<label style='padding-right:5px;'>Dejado en trade-in el día: <b>".$mul_trade."</b>, soy responsable de toda la multa que aparezca en el auto antes de la entre del mismo al Dealer como trade-in.</label>
						<div style='padding-bottom:300px;'>

				</div>
			</div>
		</div>"
	;

	$pdf->writeHTML($html, true, false, true, false, '');
	$codigo_usuario = $_SESSION['codigo_usuario'];
	$bodega = '/../bodega/precarga/'.$codigo_usuario.'/pdfs5+remitente='.$codigo_usuario.'+idForm='.$TempId.'.pdf';
	$_SESSION['nombreArchivo']=explode("/",$bodega)[5];					
	
	if (!file_exists($bodega)) {
		mkdir($bodega, 0777, true);
	}

	$pdf->Output(__DIR__.$bodega, 'F');

	if ($ruta==1) {
		return $bodega;
	} else {
		return $valores;
	}
}

// DOCUMENTO: RECIBO DE PRONTO/PAGO
function template6($TempId, $ruta) {
	include '../conexion.php';

	$sql="SELECT * FROM valores_plantilla WHERE id_plantilla='6' AND doc_id='".$_SESSION['codigo_documento']."'";
	$valores= $link->query($sql);
	
	foreach ($valores as $key) {
		$arrayValores6[]=$key['valores'];
	}

	$rec_control=$arrayValores6[1];
	$rec_fecha=$arrayValores6[2];
	$rec_stock=$arrayValores6[3];
	$rec_vin=$arrayValores6[4];
	$rec_de=$arrayValores6[5];
	$rec_cantidad=$arrayValores6[6];
	$rec_vehiculo=$arrayValores6[7];
	$rec_concepto=$arrayValores6[8];
	$rec_num=$arrayValores6[10];

	$inputs=$arrayValores6[9];

	// create new PDF document
	include('../vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}

	// remove default header/footer
	$pdf->setPrintHeader(false);

	// -------------------------------------------------------------------

	// add a page
	$pdf->AddPage();
	// set JPEG quality
	$pdf->setJPEGQuality(75);

	// ---------------------------------------------------------
	// Image example with resizing
	$pdf->Image('../documentos/images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'C',false, false, false, false, false, false);
	
	//inputs de recibo (3)
	$efectivo=<<<EOD
	<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
	EOD;
	$transferencia=<<<EOD
	<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
	EOD;
	$cheque=<<<EOD
	<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
	EOD;

	switch ($inputs) {
		case '1':
			$efectivo=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		case '2':
			$transferencia=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		case '3':
			$cheque=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		default:
			# code...
			break;
	}

	// crear html
	$html=<<<EOD
		<style>
			h4 { text-align:center;}
			small { text-align:right; position:absolute; margin-top:100px; }
			table { border:1px solid black; }
		</style>

		<table>
			<tr>
				<td></td>
				<td><br><h4 class='text-center'>RECIBO</h4></td>
				<td></td>
			</tr>

			<tr>
				<td>
					<p><b>Auto1</b>
					<br>
					Marginal San Rafael, PR-2km 229.2,
					<br>
					Ponce PR 00716</p>
				</td>

				<td>
				</td>

				<td>
					<p><small>Nùm. Control: <b>$rec_control</b></small>
					<br>
					<small>Fecha: <b>$rec_fecha</b></small>
					<br>
					<small>Stock#: <b>$rec_stock</b></small>
					<br>
					<small>VIN: <b>$rec_vin</b></small>
					</p>
				</td>
			</tr>
			
			<tr>
				<td colspan="3">
					<p></p>
					<label for=''>Recibido de: $rec_de</label>

					<label for=''>la cantidad de $ <b>$rec_cantidad</b></label>
					
					<br>
					
					Para aplicar a la compra del <b>$rec_vehiculo</b>
					
					<br>

					Concepto: <b>$rec_concepto</b>
					<p></p>
				</td>
			</tr>
		
			<tr>
				<td colspan="3">
					<label><b>$efectivo </b>EFECTIVO</label>
					<label><b>$transferencia</b> TRANSFERENCIA</label>
					<label>$cheque CHEQUE</label>
					<label>NUM.CHEQUE:<b>  $rec_num</b></label>
				</td>
			</tr>

			<tr>
				<td>
					<p></p>
				</td>
				<td>
					<p></p>
				</td>
				<td>
					<p></p>
				</td>
			</tr>

		</table>
	EOD;

	$pdf->writeHTML($html, true, false, true, false, '');
	$codigo_usuario = $_SESSION['codigo_usuario'];	
	$bodega = '/../bodega/precarga/'.$codigo_usuario.'/pdfs6+remitente='.$codigo_usuario.'+idForm='.$TempId.'.pdf';
	$_SESSION['nombreArchivo']=explode("/",$bodega)[5];	
	$_SESSION['bodega']=$bodega;				
	
	if (!file_exists($bodega)) {
		mkdir($bodega, 0777, true);
	}

	$pdf->Output(__DIR__.$bodega, 'F');

	if ($ruta==1) {
		return $bodega;
	} else {
		return $valores;
	}

}

// DOCUMENTO : GARANTIA
function template7($TempId, $ruta) {
	include '../conexion.php';

	$sql="SELECT * FROM valores_plantilla WHERE id_plantilla='7' AND doc_id='".$_SESSION['codigo_documento']."'";
	$valores= $link->query($sql);
	
	foreach ($valores as $key) {
		$arrayValores7[]=$key['valores'];
	}

	$garamarca = $arrayValores7[1];
	$garamodelo = $arrayValores7[2];
	$garaaño =  $arrayValores7[3];
	$garaserie =  $arrayValores7[4];
	$garainventario =  $arrayValores7[5];
	$garamillaje =  $arrayValores7[6];
	$garatablilla =  $arrayValores7[7];
	$garaprecio =  $arrayValores7[8];
	$tipo_garantia =  $arrayValores7[9];
	$confirmacion= $arrayValores7[10];

	// estas son las iniciales de las firmas
	$firma6 = $_POST['firma6'];
	$firma7 = $_POST['firma7'];
	$firma8 = $_POST['firma8'];
	$firma9 = $_POST['firma9'];
	$firma10 = $_POST['firma10'];
	$firma11 = $_POST['firma11'];
	$firma12 = $_POST['firma12'];
	$firma13 = $_POST['firma13'];

	// create new PDF document
	include('../vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 009');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}

	// remove default header/footer
	$pdf->setPrintHeader(false);

	// -------------------------------------------------------------------

	// add a page
	$pdf->AddPage();
	// set JPEG quality
	$pdf->setJPEGQuality(75);

	// ---------------------------------------------------------
	// Image example with resizing
	$pdf->Image('../documentos/images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'L',false, false, false, false, false, false);

	///CONDICIONALES PARA CHECKEAR Y NO CHECK
	switch ($tipo_garantia) {
		case '1':
			$input1=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			$input2=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input3=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input4=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			break;

		case '2':
			$input2=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			$input1=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input3=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input4=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			break;

		case '3':
			$input1=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input2=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input4=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input3=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		case '4':
			$input1=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input2=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input3=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$input4=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		default:
			break;
	}

	///inputs de confirmacion
	switch ($confirmacion) {
		case '1':
			$si=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			$no=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			break;
		case '2':
			$si=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			$no=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			break;

		default:
			$si=<<<EOD
			<label style="font-weight:bolder;">X</label>
			EOD;
			$no=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"   />
			EOD;
			break;
	}

	$inicial=<<<EOD
		<small style="				text-align:center;
		font-family:'Cherolina';
		font-size:20px;">$firma6</small>
	EOD;
	$inicial2=<<<EOD
		<small style="				text-align:center;
		font-family:'Cherolina';
		font-size:20px;">$firma7</small>
	EOD;
	$inicial3=<<<EOD
		<small style="				text-align:center;
		font-family:'Cherolina';
		font-size:20px;">$firma8</small>
	EOD;
	$inicial4=<<<EOD
		<small style="				text-align:center;
		font-family:'Cherolina';
		font-size:20px;">$firma9</small>
	EOD;
	$inicial5=<<<EOD
		<small style="				text-align:center;
		font-family:'Cherolina';
		font-size:20px;">$firma10</small>
	EOD;
	$inicial6=<<<EOD
		<small style="				text-align:center;
		font-family:'Cherolina';
		font-size:20px;">$firma11</small>
	EOD;
	$inicial7=<<<EOD
		<small style="				text-align:center;
		font-family:'Cherolina';
		font-size:20px;">$firma12</small>
	EOD;
	$inicial8=<<<EOD
		<small style="				text-align:center;
		font-family:'Cherolina';
		font-size:20px;">$firma13</small>
	EOD;
	
	// crear html
	$html="<style>
	*{
		font-family: Arial, Helvetica, sans-serif;
		
	}
	h4{
		border-top:1px solid black;
		text-align:center;
	}
	td{
		border-bottom:1px solid black;
		border-collapse: separate;
		
	}
	table{
		
		border-spacing:  8px 2px;
	  
	}
	h5{
		border-top:1px solid black;
	}
	label{
		font-size:12px;
	}
	h3{
		text-align:center;
	}
	</style>
		<h3>Auto 1 PR</h3>
	<h4>INFORMACIÓN SOBRE GARANTIA Y CONDICIONES PARA EL VEHICULO</h4>
	<table>
		<tr>
			<td><b>".$garamarca."</b></td>
			<td><b>".$garamodelo."</b></td>
			<td><b>".$garaaño."</b></td>
			<td><b>".$garaserie."</b></td>
		</tr>
		<tr>
		<th style=''>Marca:</th>
		<th style=''>Modelo:</th>
		<th style=''>Año:</th>
		<th style=''>Numero serie</th>
		</tr>
		<tr>
		<td style=''><b>".$garainventario."</b></td>
		<td style=''><b>".$garamillaje."</b></td>
		<td style=''><b>".$garatablilla."</b></td>
		</tr>
		<tr>
		<th style=''>Número inventario:</th>
		<th style=''>Millaje:</th>
		<th style=''>Tablilla:</th>
		<th style=''><h2>Precio: <br>$".$garaprecio."</h2></th>
		</tr>
	</table>";
	
	
	$html.="<h5>GARANTIAS PARA ESTE VEHICULO</h5>
	".$input1."<label for=''> 2 meses o dos mil millas, lo
		primero que ocurra. (Mas de 50,000 millas y hasta 100,000 millas) $inicial5 </label>

	<br>
	".$input2."<label for=''> 3 meses o tres mil millas, lo
		primero que ocurra. (Mas de 36,000 millas y hasta 50,000 millas)$inicial6 </label>

	<br>
	".$input3."<label for=''> 4 meses o cuatro mil millas, lo
		primero que ocurra. (Hasta 36,000 millas) $inicial7</label>
	<br>

	".$input4."<label for=''> 100,000 mil millas  en  adelante  no
		tiene garantìa. (     No tiene garantìa              )   $inicial8</label><br>
	

	<h5>PARTES INCLUIDAS SEGÙN REGLAMIENTO DE D.A.C.O</h5>
	<small><b>A) MOTOR</b> -incluye todas las piezas internas del motor incluyendo bomba de
			agua, bomba de gasolina (mecánica eléctrica), multiple adminisión y escape, bloque y
			volanta. En motores rotativos incluye las cajas de los rotores. Se excluyen piezas de
			servicio normal de mantenimiento que requieran cambios periódicos y su respectiva mano
			de obra.
			<br>
			<b>B) TRANSMISIÓN</b> -incluye caja de transmisiòn, todas las piezas internas de las
			transmisiòn y el convertidor de torsiòn.
			<br>
			<b>C) SISTEMA ELÉCTRICO</b> -Alternador, generador, motor de arranque y sistema de
			ignición. No incluye batería, bombillas ni piezas de cambio periódico.
			<br>
			<b>D) SISTEMA ELECTRÓNICO</b> -incluye computadora y sus accesorios.
			<br>
			<b>E) EJE IMPULSOR</b> -Caja de tracción trasera y/o delantera, según aplique, con sus
			partes internas, ejes impulsores,
			eje del cardan y uniones transversales.
			<br>
			<b>F) FRENOS</b> -cilindros traseros, bomba de frenos, servo asistencia de vacio, líneas
			y acoplamientos hidraulicos y calibrados de discos. Se excluyen piezas de servicios
			normal de mantenimiento que requieran cambios periódicos y su respectiva mano de obra.
			<br>
			<b>G) RADIADOR Y ABANICO DEL RADIADOR</b>
			<br>
			<b>H) DIRECCIÓN -La caja de guia y sus partes internas (rack & pinion)</b>
			<br>
			<b>I) ODOMETRO FUNCIONANDO</b>
		</small>
		
		<small>-Para obtener servicio: El consumidor se comunicará a (área de servicio) en horas
			laborales de requerir servicios por conceptos de garantía.
			-Será el proveedor del servicio y será la entidad responsable de honrar la garantía
			y/o coordinar cualquier otro recurso técnico
			<br>
			-Circunstancias bajo las cuales el consumidor puede perder el derecho a reclamar la
			garantía (a) Podría perder su derecho si el vehículo de referencia sufrió un impacto
			el cual ocasionara daño a la unidad, (b) Alteraciones al vehículo posterior a la
			compra
			, (c) Que la unidad sea intervenida mécanicamente previo a la evaluación profesional
			a la cual usted tiene derecho a recibir de nuestro departamento de servicio.
			<br>
			-Proveerá una unidad sustituida; si la reparación de la unidad vendida y en
			garantía permaneceriera más de (5)días calendario, sin incluir Domingo.
			<br>
			-La garantía de su vehículo será transferida a cualquier consumidor subsiguiente
			sin costo alguno por el tiempo o millaje restante.</small>
	<h5>NOTAS IMPORTANTES AL CONSUMIDOR</h5>
	<small>1. Leo y certifico que he sido responsablemente orientado y se me han mostrado los labels o etiquetas  $inicial <br> de las partes del vehículo de esta transacción.</small>
	<br>
	<small>2. Certifico haber sido orientado; que este vehículo pudo haber requerido trabajos de hojalateria y pintura $inicial2<br>con la intención de optimizarlo.
	</small>
	<br>
	<small>3. Certifico que he recibido copia del REGLAMENTO DE GARANTIAS DE VEHCULOS DE MOTOR el $inicial3<br>
	cual servirá con guía informativa.</small>
	<input
		readonly style='border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;'
			type='text' name='usu_name'>
	<br>
	<small>4. Certifico que he sido informado que el vehículo aquí vendido proviene del uso anteriores $inicial4<br> en carácter de (Rental Car). Si $si No $no
				</small>
	<input
		readonly style='border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;'
			type='text' name='usu_name'>";

	//FIN DE CREAR HTML
	$pdf->writeHTML($html, true, false, true, false, '');
	$codigo_usuario = $_SESSION['codigo_usuario'];
	$bodega = '/../bodega/precarga/'.$codigo_usuario.'/pdfs7+remitente='.$codigo_usuario.'+idForm='.$TempId.'.pdf';
	$_SESSION['nombreArchivo']=explode("/",$bodega)[5];					
	
	if (!file_exists($bodega)) {
		mkdir($bodega, 0777, true);
	}	

	$pdf->Output(__DIR__.$bodega,'F');

	if ($ruta==1) {
		return $bodega;
	} else {
		return $valores;
	}
}
			
?>
<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<script>
    function enviarFormulario(evento) {
        if(evento === "devolver"){
            document.formulario.action = '../devolver/index.php';
        }else if(evento === "firmar"){
            document.formulario.action = '../firma_destinatario/index.php';
        }
        document.formulario.submit();
    }
</script>
<div class="cuerpo-container">
    <form action="#" method="post" target="" name="formulario" id="formulario">
        <div class="cuerpo-pdf">
            <div>
                <!-- <embed src="../bodega/precarga/<?php //echo $codigo_usuario?>/<?php //echo $nombre_archivo?>" type="application/pdf" width="100%" height="600px" /> -->
                <object data="<?= $ruta ?>" type="application/pdf" width="100%" height="600px">
                    <div class="container-object">
                        <h1 class="title">Tu navegador no soporta PDF</h1>
                        <img src="../recursos/imagenes/alerta.png" alt="" class="alert-icon">
                        <a href="<?= $ruta ?>" class="boton-descarga">Descargar Documento</a>
                    </div>
                </object>
            </div>
        </div>
        <div class="cuerpo-botones">
            <button type="button" name="devolver" onclick="enviarFormulario(this.name);">Devolver</button>
            <button type="button" name="firmar" onclick="enviarFormulario(this.name);">Firmar</button>
        </div>
        <input type="hidden" id="nombre" name="nombre_archivo" value="<?php echo $nombre_documento ?>"/>
        <input type="hidden" id="nombre" name="nombreArchivo" value="<?php echo $nombre_documento ?>"/>
        <input type="hidden" id="codigo_usuario" name="codigo_usuario" value="<?= $_SESSION['codigo_usuario']?>"/>
        <input type="hidden" id="codigo_documento" name="codigo_documento" value="<?= $_POST['codigo_documento']?>"/>
        <input type="hidden" id="codigo_detalle_documento" name="codigo_detalle_documento" value="<?= $_POST['codigo_detalle_documento']?>"/>
        <input type="hidden" id="correos_destinatarios" name="correos_destinatarios" value="alexis-crokis@hotmail.com"/>
    </form>
</div>
