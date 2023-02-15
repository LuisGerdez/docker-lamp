<?php
/*
*   Software development: Ing. Bernabe Sanchez Lenis
*	líneas de código: 18 - 24
*/
$nombre_archivo = $_POST['nombreArchivo'];
//echo "$codigo_usuario";

switch ($nombre_archivo) {
	////// generador de html para llevarlo a el generador de pdfs
	case 'viewtrade-in.pdf':
		viewtradein();
		break;
	case 'multasview.pdf':
		viewmulta();
		break;
	/////// generador de pdf de cada plantilla
	case 'compraventa_vehiculo.pdf':
	compraventa_vehiculo();
	break;

	case 'pagare_a_la_orden.pdf':
	pagare_a_la_orden();
	break;

	case 'Contrato de prestación de servicios.pdf':
	prestacion_servicios();
	break;

	case 'Promesa de compraventa.pdf':
	promesa_compraventa();
	break;

	case 'multas.pdf':
	multas();
	break;

	case 'estimadoquote.pdf':
	estimadoquote();
	break;

	case 'pagovehiculo.pdf':
	pagovehiculo();
	break;

	case 'pronto_pago.pdf':
	prontopagovehiculo();
	break;

	case 'documentogarantia.pdf':
	documentogarantia();
	break;

	case 'venta_vehicular.pdf':
	ventavehicular();
	break;

	
	default:
	echo "Ningun archivo...";
	break;
}


///vistas para los usuarios y hacerlos dinamicamente
///insert d elos datos del formulario
function viewtradein(){
	require_once '../conexion.php';
	$codigo_usuario = $_SESSION['codigo_usuario'];
	$nombreArchivo = $_POST['nombreArchivo'];
	///datos por post de el formulario
	$tradefecha = $_POST['tradefecha'];
	$tradename = $_POST['tradename'];
	$trade1 = $_POST['trade1'];
	$trade2 = $_POST['trade2'];
	$trade3 = $_POST['trade3'];
	$tradeserie = $_POST['tradeserie'];
	$tradecuenta = $_POST['tradecuenta'];
	$tradebanco = $_POST['tradebanco'];
	$tradenumber = $_POST['tradenumber'];
	$tradepoliza = $_POST['tradepoliza'];
	$tradeservicio = $_POST['tradeservicio'];
	
	// valor para no reutilizar id de tabla
	$otp=rand(1000, 99999999);
	$ran=rand(1000, 99999999);
	

	//Tabla de pronto pago 
	$sql = "INSERT INTO tbl_pronto_pago 
	values(NULL,'".$tradefecha."','".$tradename."','".$trade1."','".$trade2."','".$trade3."','".$tradeserie."','".$tradecuenta."','".$tradebanco."','".$tradenumber."','".$tradepoliza."','".$tradeservicio."','".$otp."','1')";
	$result = $link->query($sql);
	
	$ID_TABLA_PRONTO=mysqli_insert_id($link);
	//tabla documento
	$sql="INSERT INTO documento VALUES(NULL,'trade_in_pronto_pago',
	'../bodega/precarga/$codigo_usuario/$ran-viewtrade-in.pdf',
	'Pendiente','".$codigo_usuario."',CURRENT_DATE(),CURRENT_TIME(),NULL,
	NULL, NULL, NULL, NULL, NULL,NULL)";
	$result = $link->query($sql);

	$CODIGO_DOCUMENTO = mysqli_insert_id($link);
	//tabla de documentos_plantillas
	//TRAEMOS LOS ID DE LAS TABALS RESTANTES PARA SU POSTERIOR Y EJECUCION DE ESTAS MISMAS
    $sql="INSERT INTO documentos_plantillas 
	VALUES(NULL,$CODIGO_DOCUMENTO,'1',$ID_TABLA_PRONTO)";
	$result = $link->query($sql);
	


	//vamos a hacer una consulta para gener
	//generamos con este mismo codigo el pdf para luego mostrarlo

	//datos recibidos
	$nombre_archivo = $_POST['nombreArchivo'];
	// create new PDF document
	include('../recursos/tcpdf/examples/tcpdf_include.php');
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

	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
	$pdf->Image('images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'C',false,
	false, false, false, false, false);

	// crear html
	$html="
	<style>
	small{
		text-align:center;
	}
	</style>
	<div class='col-md-12 text-center'>
	<small><b>Auto1pr.com</b></small>
	<p></p>
	<small><b>ACUERDO SUPLEMENTARIO<br>SOBRE VEHICULO TOMADO COMO PRONTO PAGO (TRADE IN)</b></small>
</div>
<p></p>
<div class='col-md-12'>
	<label for=''>Fecha: </label>
	<b>".$tradefecha."</b>
	<br>
	<label style='padding-right:5px;'>Yo,
		<b>".$tradename."</b> hago constar que le he entregado a <b>Auto1pr.com</b>, en
		calidad de pronto pago (trade in) el vehiculo de motor,marca,
		<b>".$trade1."</b>,
		modelo, 
		<b>".$trade2."</b> con tablilla,
		<b>".$trade3."</b> y número de serie
		<b>".$tradeserie."</b> (el 'Vehículo'), por lo que autorizo a <b>Auto1pr.com</b> a
		efectuar el traspaso de la titularidad de este a nombre de cuales quiera de sus
		subsiguientes adquirientes.</label>
	<br>
	<br>
	
	<label style='padding-right:5px;'>INICIALES ____________</label><input
		style='border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;' type='text'
		name='usu_name'>
	<p></p>
	<p>Represento que la unidad descrita no tiene gravamen de hipoteca, o algún otro gravamen que no
		sea el correspondiente a la cuenta # <b>".$tradecuenta." </b>mantenida con el banco
		<b>".$tradebanco."</b> (el 'Financiamiento'). En la eventualidad que esta
		representación resulte incorrecta, me comprometo a tomar,dentro de los diez(10) días
		requerido, a aquellas medidas necesarias paraa liberar el Vehículo de todos y cada uno de
		los gravámentes que tenga, con la única excepción del Financiamiento.
	</p>
	<label style='padding-right:5px;'>INICIALES ____________</label><input
		style='border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;' type='text'
		name='usu_name'>
	<p></p>
	<p>Por este medio AUTORIZO a <b>Auto1pr.com</b> a liquidar el balance pendiente de pago del
		Financimiento, balance que represento asciende a $
		<b>".$tradenumber."</b> y CEDO a favor de éste cualquier diferencial que pueda
		surgir por concepto de primas de seguros no devengadas y/o por concepto de un balance de
		cancelación inferior al aquí informado, número de Póliza
		<b>".$tradepoliza." </b>, o Contrato de Servicio <b>".$tradeservicio."</b>. Revelo a <b>Auto1.PR.com</b> de toda obligacipon que
		pudiera tener de traspasar el Vehículo a nombre suyo antes de venderlo al adquiriente
		subsiguiente.
	</p>
	<label style='padding-right:5px;'>INICIALES ____________</label><input
		style='border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;' type='text'
		name='usu_name'>
	<p>Al momento de la transacción se ha estimado que el balance a pagar para el saldo de
		financiamiento del Vehículo es el arriba
		indicado; También me comprometo a entregar balance de cancelación de la institución en la
		cual tiene deuda. No obstante,
		si al momento de liquidar dicho financiamiento, se encuentra que el balance de saldo fuera
		mayor al aquí informado, o si el vehículo
		tuviese otras deudas o gravámenes no informados al presente, o de estar alguna multa
		pendiente de pago o registro ante cualquier agencia pública de deficiencia y/o a pagar
		dichas cantidades dentro de diez(10)
		días desde que se me notifique la existencia de estas. En todo caso, REVELO a Auto1pr.com de
		toda la responsabilidad u obligación asociada
		con y me comprometo a indemnizarle (reembolsarle), cualquier pago que realice por dichos
		conceptos.
	</p>
	<label style='padding-right:5px;'>INICIALES ____________</label><input
		style='border:none;border-bottom:1px solid black;width:10%;background:#d3cccc;' type='text'
		name='usu_name'>";
	//FIN DE CREAR HTML
	$pdf->writeHTML($html, true, false, true, false, '');
	$nombre_archivo = $ran.'-'.$nombre_archivo;
	$bodega = "/../bodega/precarga/".$codigo_usuario."/".$nombre_archivo;
	$pdf->Output(__DIR__.$bodega, 'F');

	//varuables utilizar para la vista
	$_SESSION['IdForm']=$ID_TABLA_PRONTO;	
	$_SESSION['codigo_documento']=$CODIGO_DOCUMENTO;
	$_SESSION['bodega']=$bodega;
	$_SESSION['nombreArchivo']=$nombre_archivo;


}
//vista de multa
function viewmulta(){
	require_once '../conexion.php';
	$codigo_usuario = $_SESSION['codigo_usuario'];
	$nombre_archivo = $_POST['nombreArchivo'];

	$mul_name=$_POST['mul_name'];
	$mul_marca=$_POST['mul_marca'];
	$mul_modelo=$_POST['mul_modelo'];
	$mul_año=$_POST['mul_año'];
	$mul_tablilla=$_POST['mul_tablilla'];
	$mul_serie=$_POST['mul_serie'];
	$mul_trade=$_POST['mul_trade'];

	// valor para no reutilizar id de tabla
	$ran=rand(1000, 99999999);

	//Tabla de pronto pago 
	$sql = "INSERT INTO multa 
	values(NULL,'".$mul_name."','".$mul_marca."','".$mul_modelo."','".$mul_año."','".$mul_tablilla."','".$mul_serie."','".$mul_trade."')";
	$result = $link->query($sql);

	$id_multa=mysqli_insert_id($link);
	//tabla documento
	$sql="INSERT INTO documento VALUES(NULL,'Compromiso pago multa',
	'../bodega/precarga/$codigo_usuario/$ran-view_multa.pdf',
	'Pendiente','".$codigo_usuario."',CURRENT_DATE(),CURRENT_TIME(),NULL,
	NULL, NULL, NULL, NULL, NULL,NULL)";
	$result = $link->query($sql);

	$CODIGO_DOCUMENTO = mysqli_insert_id($link);
	//tabla de documentos_plantillas
	//TRAEMOS LOS ID DE LAS TABALS RESTANTES PARA SU POSTERIOR Y EJECUCION DE ESTAS MISMAS
    $sql="INSERT INTO documentos_plantillas 
	VALUES(NULL,$CODIGO_DOCUMENTO,'2',$id_multa)";
	var_dump($sql);
	die();
	$result = $link->query($sql);
	




	// create new PDF document
	include('../recursos/tcpdf/examples/tcpdf_include.php');

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

	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
	$pdf->Image('images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'C',false,
	false, false, false, false, false);

	// crear html
	$html="<style>/* ESTILOS DE LOS LOGOS DE CADA PLANTILLA */

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
		
	</div>";
	//FIN DE CREAR HTML
	$pdf->writeHTML($html, true, false, true, false, '');

		$nombre_archivo = $ran.'-'.$nombre_archivo;
		$bodega = "/../bodega/precarga/".$codigo_usuario."/".$nombre_archivo;
		$pdf->Output(__DIR__.$bodega, 'F');

		//varuables utilizar para la vista
		$_SESSION['IdForm']=$id_multa;	
		$_SESSION['codigo_documento']=$CODIGO_DOCUMENTO;
		$_SESSION['bodega']=$bodega;
		$_SESSION['nombreArchivo']=$nombre_archivo;

}










// PLANTILLAS DE PDF
///////////VENTA VEHICULAR

function ventavehicular(){
	$codigo_usuario = $_SESSION['codigo_usuario'];
	$nombre_archivo = $_POST['nombreArchivo'];
	// create new PDF document

	//datos obtenidos por post
	$vehi_nombre_comprador=$_POST['vehi_nombre_comprador'];
	$vehi_direccion_residencial=$_POST['vehi_direccion_residencial'];
	$vehi_postal=$_POST['vehi_postal'];
	$vehi_fecha=$_POST['vehi_fecha'];
	$vehi_social=$_POST['vehi_social'];
	$vehi_nacimiento=$_POST['vehi_nacimiento'];
	$vehi_telefono=$_POST['vehi_telefono'];
	$vehi_celular=$_POST['vehi_celular'];
	$vehi_licencia=$_POST['vehi_licencia'];
	$vehi_correo=$_POST['vehi_correo'];
	///array de checkbox
	$vehi_check=$_POST['vehi_check'][0];
	//////
	$vehi_año=$_POST['vehi_año'];
	$vehi_marca=$_POST['vehi_marca'];
	$vehi_modelo=$_POST['vehi_modelo'];
	$vehi_stock=$_POST['vehi_stock'];
	$vehi_vin=$_POST['vehi_vin'];
	$vehi_color=$_POST['vehi_color'];
	$vehi_millaje=$_POST['vehi_millaje'];
	$vehi_tablilla=$_POST['vehi_tablilla'];
	$vehi_marbete=$_POST['vehi_marbete'];
	$vehi_vence=$_POST['vehi_vence'];
	$vehi_marca2=$_POST['vehi_marca2'];
	$vehi_modelo2=$_POST['vehi_modelo2'];
	$vehi_año2=$_POST['vehi_año2'];
	$vehi_vin2=$_POST['vehi_vin2'];
	$vehi_tablilla2=$_POST['vehi_tablilla2'];
	$vehi_millaje2=$_POST['vehi_millaje2'];
	$vehi_color2=$_POST['vehi_color2'];
	$vehi_balance=$_POST['vehi_balance'];
	$vehi_marbete2=$_POST['vehi_marbete2'];
	$vehi_vence2=$_POST['vehi_vence2'];
	//array2
	$vehi_check2=$_POST['vehi_check2'][0];
	/////
	$vehi_usado=$_POST['vehi_usado'];
	$vehi_balance_adeudado=$_POST['vehi_balance_Adeudado'];
	$vehi_credito_neto=$_POST['vehi_credito_neto'];
	$vehi_pago_contado=$_POST['vehi_pago_contado'];
	$vehi_credito_asufavor=$_POST['vehi_credito_asufavor'];
	$vehi_otros_pagos=$_POST['vehi_otros_pagos'];
	$vehi_credito_total=$_POST['vehi_credito_total'];
	$vehi_pronto_recibido=$_POST['vehi_pronto_recibido'];
	$vehi_recibo=$_POST['vehi_recibo'];
	$vehi_precio_unidad=$_POST['vehi_precio_unidad'];
	$vehi_puertas=$_POST['vehi_puertas'];
	$vehi_cilindros=$_POST['vehi_cilindros'];
	$vehi_transmision=$_POST['vehi_transmision'];
	$vehi_Caballaje=$_POST['vehi_Caballaje'];
	$vehi_total=$_POST['vehi_total'];
	$vehi_gap=$_POST['vehi_gap'];
	$vehi_seguro_doble=$_POST['vehi_seguro_doble'];
	$vehi_seguro_vida=$_POST['vehi_seguro_vida'];
	$vehi_contrato_servicio=$_POST['vehi_contrato_servicio'];
	$vehi_tablillas=$_POST['vehi_tablillas'];
	$vehi_seguro_ACAA=$_POST['vehi_seguro_ACAA'];
	$vehi_precio_total=$_POST['vehi_precio_total'];
	$vehi_credito_total2=$_POST['vehi_credito_total2'];
	$vehi_balance_apagar=$_POST['vehi_balance_apagar'];
	$vehi_plazo1=$_POST['vehi_plazo1'];
	$vehi_numplazo1=$_POST['vehi_numplazo1'];
	$vehi_plazo2=$_POST['vehi_plazo2'];
	$vehi_numplazo2=$_POST['vehi_numplazo2'];
	$vehi_bancoporcentaje=$_POST['vehi_bancoporcentaje'];
	$vehi_observaciones=$_POST['vehi_observaciones'];
	$vehi_fecha1=$_POST['vehi_fecha1'];
	$vehi_fecha2=$_POST['vehi_fecha2'];
	
	include('../recursos/tcpdf/examples/tcpdf_include.php');
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

	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
	$pdf->Image('images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'L',false,
	false, false, false, false, false);
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
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"  checked="checked" /> 
			EOD;
			break;
		case '2':
			$input2=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"  checked="checked" /> 
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
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola" checked="checked"   /> 
			EOD;
			break;
		case '2':
			$titulo=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola" checked="checked"   /> 
			EOD;
			break;
		case '3':
			$certificacion=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola" checked="checked"   /> 
			EOD;
			break;
		
		default:
			# code...
			break;
	}

	

	// crear html
	$html=<<<EOD
	<style>
		*{
			font-family: Arial, Helvetica, sans-serif;
			font-size:10px;
		}
		b{
			text-align:center;
		}
		h5{
			border-bottom:1px solid black;
		}
		th{
			cellpadding:10px;
			padding: 5px;
			border:1px solid black;		
		}
		td{
			cellpadding:10px;
		}
		table{
			cellpadding:10px;
		}

	
	</style>
	<table>
		<tr>
			<td colspan="4">NOMBRE DEL COMPRADOR: <b>$vehi_nombre_comprador</b><br><small>Dirección Residencial:</small><h5>$vehi_direccion_residencial</h5><br><small>Dirección Postal:</small><h5>$vehi_postal</h5></td>		
			<td>
			<small>Fecha Entrega:<br>
			Seg. Social:<br>
			Fecha de Nacimiento:<br>
			No. licencia:<br>
			Teléfono:<br>
			Celular:<br>
			Correo Electronico:
			</small>
			</td>
			<td>
			<small>$vehi_fecha<br>
			$vehi_social<br>
			$vehi_nacimiento<br>
			$vehi_telefono<br>
			$vehi_celular<br>
			$vehi_licencia<br>
			$vehi_correo
				</small>
			</td>
		</tr>
		<tr>
			<th style="background-color:black;color:white;border:3px solid black;" colspan="3"><b>VEHICULO VENDIDO</b></th>
			<th style="border-right:3px solid black;border-top:3px solid black;"colspan="2">PRECIO UNIDAD</th>
			<th style="border-right:3px solid black;border-top:3px solid black;">$<b>$vehi_precio_unidad</b></th>
		</tr>	
		
		<tr>
			<th style="border:3px solid black;" rowspan="2"colspan="3">Nuevo ($input1) Usado ($input2) Stock# <b>$vehi_stock</b>  Año: <b>$vehi_año</b><br>Marca: <b>$vehi_marca</b> Modelo: <b>$vehi_modelo</b><br>VIN:<b>$vehi_vin</b> Color: <b>$vehi_color</b> Millaje:<b>$vehi_millaje</b><br>Tablilla:<b>$vehi_tablilla</b> Marbete: <b>$vehi_marbete</b> Vence: <b>$vehi_vence</b></th>
			
			<th style="border-right:3px solid black;"rowspan="2"colspan="2">Puertas:<b>$vehi_puertas</b> Cilindros: <b>$vehi_cilindros</b><br><br>Transmisión: <b>$vehi_transmision</b><br>Caballaje: <b>$vehi_Caballaje</b></th>
			
			<th style="border-right:3px solid black;"rowspan="2"></th>
			
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<th colspan="5" style="border-right:3px solid black;border-left:3px solid black;"></th>
			<th style="border-right:3px solid black;">$<b>$vehi_total</b></th>
		</tr>
	
		<tr>
			<th colspan="3" style="background-color:black;color:white;border:3px solid black;" ><b>VEHICULO USADO TOMADO A CAMBIO</b></th>
			<th colspan="2" style="border-right:3px solid black;">Gap</th>		
			<th style="border-right:3px solid black;">$<b>$vehi_gap</b></th>		
		</tr>
		<tr>
			<th style="border-left:3px solid black;border-right:3px solid black;"colspan="3">Marca: <b>$vehi_marca2</b> Modelo: <b>$vehi_modelo2 </b> año: <b>$vehi_año2</b></th>
			<th colspan="2" style="border-right:3px solid black;">Seguro Doble()</th>
			<th style="border-right:3px solid black;">$<b>$vehi_seguro_doble</b></th>
		</tr>
		<tr>
			<th style="border-left:3px solid black;border-right:3px solid black;"colspan="3">VIN#: <b>$vehi_vin2 </b> Tablilla: <b>$vehi_tablilla2</b></th>
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
			<th style="border-left:3px solid black;border:3px solid black;"   rowspan="3" colspan="3">marbete: <b>$vehi_marbete2</b>  Vence: <b>$vehi_vence2</b><br>Cliente entrego: ($licencia)licencia   ($titulo)Titulo  _______________<br>($certificacion)Certificación Multas AutoExpreso</th>
			<th colspan="2"style="border-right:3px solid black;">SeguroACAA</th>
			<th style="border-right:3px solid black;">$<b>$vehi_seguro_ACAA</b></th>
		</tr>
		<tr>
			<th colspan="2"style="border-right:3px solid black;">Precio Total</th>
			<th style="border-right:3px solid black;">$<b>$vehi_precio_total</b></th>
		</tr>
		<tr>
			<th colspan="2"style="border-right:3px solid black;">Crèdito Total</th>
			<th style="border-right:3px solid black;">$<b>$vehi_credito_total</b></th>
		</tr>
		<tr>
			<th colspan="2" style="border-right:3px solid black;border-left:3px solid black;">Credito por Carro Usado</th>
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
			<th style="border:3px solid black;"colspan="3" >En <b>$vehi_plazo1</b> plazos mensuales de $ <b>$vehi_plazo1</b> con fecha de <b>$vehi_fecha1</b><br>En <b>$vehi_numplazo2</b> plazos mensuales de $ <b>$vehi_plazo2</b> con fecha de <b>$vehi_fecha2</b><br>First Bank al %<b>$vehi_bancoporcentaje</b></th>	
		</tr>
		<tr>
			<th style="border-right:3px solid black;border-left:3px solid black;"colspan="2">Pago de Contado</th>
			<th style="border-right:3px solid black;">$<b>$vehi_pago_contado</b></th>	
			<th style="border:3px solid black;"colspan="3" >Observaciones:<label><br> <b>$vehi_observaciones</b></label></th>
		</tr>
		<tr>
			<th style="border-right:3px solid black;border-left:3px solid black;"colspan="2">Crédito a su favor</th>
			<td style="border-right:3px solid black;">$<b>$vehi_credito_asufavor</b></td>	
			<th style="border:3px solid black;" rowspan="4"colspan="3"><b><u>NO ACEPTAMOS DEVOLUCIONES</u></b><br><small>De devolver su unidad o cancelación de contrato de razon justificada. Auto 1
			LLC, le cobrara $95.00 diarios
			por el uso del vehiculo. En adición, se cobrara millaje y deprociacion segun
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
			<p> NOTA: El comprador expresamente garantiza que el automóvil usado entregado a cuenta, si alguno, esta libre de todo gravámen o contrrato de venta consicional y qu ela licencia del mismo
			debidamente endosada sera entregada a la vendeddora con el vehículo. Se entiende que toda compra a plazos mediante contrato de venta condicional y/o hipoteca sobre bienes. En casede que el comprador exprese su opción por cierta financiadora particular para el financiamiento del balance de esta venta, sele conceden 10 días de esta fecha para trae a la vendedora el aporte 
			de este balance y en caso de transcurrir decho termino sin que haya pagado dicho balance la vendedora quedara en libertad de utilizar cualquier entidad financiadora para cobrarse dicho balance. En tal caso se entenderá que tal actuación de la vendedora tiene autorización expresa del comprador.
			El comprador ha representado a la vendedora ser mayor de edad, todo vehículo usado se cende de acuerdo a la garantia estipualada por la ley. En caso de tratarse de la compra de un vehículo nuevo, la vendedora expresamente concede al
			comprador la garantía normal en carros nuevos que concedo la casa manucfacturora cuya garantía es de conocimiento del comprador. Aunque esta orden este firmada por un vendedor no obligara en forma alguna a la vendedora, hasta tanto haya sido aprobada y firmada por uno de los oficiales del la casa. Esta orden de compra y el contrato de venta condicional correspondiente y/o el contrato de hipoteca sobre iones muebles, si la venta es a plazos , cointieno por escrito todas las condiciones
			del negocio.</p></th>	
		</tr>
	</table>
	EOD;
	//FIN DE CREAR HTML
	$pdf->writeHTML($html, true, false, false, false, '');

	$bodega = "/../bodega/precarga/".$codigo_usuario."/".$nombre_archivo;
	$pdf->Output("EJEMPLO.pdf", 'I');


}

///plantillas para Dealers
function documentogarantia(){
	$codigo_usuario = $_SESSION['codigo_usuario'];
	$nombre_archivo = $_POST['nombreArchivo'];
	//datos recibidos
	$garamarca = $_POST['garamarca'];
	$garamodelo = $_POST['garamodelo'];
	$garaaño = $_POST['garaaño'];
	$garaserie = $_POST['garaserie'];
	$garainventario = $_POST['garainventario'];
	$garamillaje = $_POST['garamillaje'];
	$garatablilla = $_POST['garatablilla'];
	$garaprecio = $_POST['garaprecio'];
	$check = $_POST['check'][0];
	$confirmacion=$_POST['confirmacion'][0];

	// create new PDF document
	include('../recursos/tcpdf/examples/tcpdf_include.php');
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

	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
	$pdf->Image('images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'L',false,
	false, false, false, false, false);
	// var_dump($check);
	// die();

	///CONDICIONALES PARA CHECKEAR Y NO CHECK
	switch ($check) {
	case '1':
		$input1=<<<EOD
		<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"  checked="checked" /> 
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
		<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"  checked="checked" /> 
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
		<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"  checked="checked" /> 
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
		<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"  checked="checked" /> 
		EOD;
		break;	
		default:

		break;
	}

	///inputs de confirmacion
	switch ($confirmacion) {
		case '1':
			$si=<<<EOD
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"  checked="checked" /> 
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
			<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"  checked="checked" /> 
			EOD;
			break;
		
		default:
			break;
	}
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
		
		border-spacing:  10px 2px;
	  
	}
	h5{
		border-top:1px solid black;
	}
	label{
		font-size:14px;
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
	primero que ocurra. (Mas de 50,000 millas y ____________<br> hasta 100,000 millas) </label>

<br>
".$input2."<label for=''> 3 meses o tres mil millas, lo
	primero que ocurra. (Mas de 36,000 millas y ____________<br> hasta 50,000 millas) </label>

<br>
".$input3."<label for=''> 4 meses o cuatro mil millas, lo
	primero que ocurra. (Hasta 36,000 millas) ____________</label>
<br>
<br>

".$input4."<label for=''> 100,000 mil millas  en  adelante  no
	tiene garantìa. (     No tiene garantìa              )_______________</label>
 

<h5>PARTES INCLUIDAS SEGÙN REGLAMIENTO DE D.A.C.O</h5>
<p><small><b>A) MOTOR</b> -incluye todas las piezas internas del motor incluyendo bomba de
		agua, bomba de gasolina (mecànicao elèctrica), multiple adminisiòn y escape, bloque y
		volanta. En motores rotativos incluye las cajas de los rotores. Se excluyen piezas de
		servicio normal de mantenimiento que requieran cambios periodicos y su respectiva mano
		de obra.
		<br>
		<b>B) TRANSMISIÒN</b> -incluye caja de transmisiòn, todas las piezas internas de las
		transmisiòn y el convertidor de torsiòn.
		<br>
		<b>C) SISTEMA ELECTRICO</b> -Alternador,generador, motor de arranque y sistema de
		ignición. No incluye bateria, bombillas ni piezas de cambio periodico.
		<br>
		<b>D) SISTEMA ELECTRÒNICO</b> -incluye computadora y sus accesorios.
		<br>
		<b>E) EJE IMPULSOR</b> -Caja de tracciòn trasera y/o delantera, segun aplique, con sus
		partes internas, ejes impulsores,
		eje del cardan y uniones transversales.
		<br>
		<b>F) FRENOS</b> -cilindros traseros, bomba de frenos, servo asistencia de vacio, lineas
		y acoplamientos hidraulicos y calibrados de discos. Se excluyen piezas de servicios
		normal de mantenimiento que requieran cambios periodicos y su respectiva mano de obra.
		<br>
		<b>G) RADIADOR Y ABANICO DEL RADIADOR</b>
		<br>
		<b>H) DIRECCIÓN -La caja de guia y sus partes internas (rack & pinion)</b>
		<br>
		<b>I) ODOMETRO FUNCIONANDO</b>
	</small>
	<h5></h5>
	<small>-Para obtener servicio: El consumidor se comunicará a (área de servicio) en horas
		laborales de requerir servicios por conceptos de garantía.
		-Será el proveedor del servicio y será la entidad responsable de honrar la garantía
		y/o coordinar cualquier otro recurso técnico
		<br>
		-Circunstancias bajo las cuales el consumidor puede perder el derecho a reclamar la
		garantía (a) Podría perder su derecho si el vehiculo de referencia sufrio un impacto
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
<small>1. Leo y certifico que he sido responsablemente orientado y se me han mostrado los labels o etiquetas de las partes del vehículo de esta transacción.</small>
<br>
<small>2. Certifico haber sido orientado; que este vehículo pudo haber requerido trabajos de hojalateria y pintura con la intención de optimizarlo.
</small>
<br>
<small>3. Certifico que he recibido copia del REGLAMENTO DE GARANTIAS DE VEHCULOS DE MOTOR el cual servirá con guía informativa.</small>
<input
	readonly style='border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;'
		type='text' name='usu_name'>
<br>
<small>4. Certifico que he sido informado que el vehículo aquí vendido proviene del uso anteriores en carácter de (Rental Car). Si".$si." No ".$no."
			</small>
<input
	   readonly style='border:none;border-bottom:1px solid black;width:50%;background:#d3cccc;'
		type='text' name='usu_name'>";
	//FIN DE CREAR HTML
	$pdf->writeHTML($html, true, false, true, false, '');
// ---------------------------------------------------------
	$bodega = "/../bodega/precarga/".$codigo_usuario."/".$nombre_archivo;
	$pdf->Output(__DIR__.$bodega, 'F');
}






function prontopagovehiculo(){
	$codigo_usuario = $_SESSION['codigo_usuario'];
	$nombre_archivo = $_POST['nombreArchivo'];

	//datos recibidos
	$rec_control = $_POST['rec_control'];
	$rec_fecha = $_POST['rec_fecha'];
	$rec_stock = $_POST['rec_stock'];
	$rec_vin = $_POST['rec_vin'];
	$rec_nombre = $_POST['rec_nombre'];
	$rec_cantidad = $_POST['rec_cantidad'];
	$rec_vehiculo = $_POST['rec_vehiculo'];
	$rec_concepto = $_POST['rec_concepto'];
	$rec_num = $_POST['rec_num'];
	$inputs = $_POST['checks'][0];
	
	// create new PDF document
	include('../recursos/tcpdf/examples/tcpdf_include.php');
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

	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
	$pdf->Image('images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'C',false,
	false, false, false, false, false);
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
				<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"  checked="checked" /> 
				EOD;
				break;
			
			case '2':
				$transferencia=<<<EOD
				<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"  checked="checked" /> 
				EOD;
				break;
			case '3':
				$cheque=<<<EOD
				<input type="checkbox" disabled="disabled" readonly="readonly" value="hola" name="hola"  checked="checked" /> 
				EOD;
				break;
			
			default:
				# code...
				break;
		}

	// crear html
	$html=<<<EOD
	<style>
		h4{
			text-align:center;
		}
		small{
			text-align:right;
			position:absolute;
			margin-top:100px;
		}
		table{
			border:1px solid black;
		}		
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
			<label for=''>Recibido de: </label>
				<label for=''>la cantidad de
					$ <b>$rec_cantidad</b></label>
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
			<p>
			</p>
		</td>
		<td>
			<p>
			</p>
		</td>
		<td>
			<p>
			</p>
		</td>
	</tr>
</table>
EOD;

	//FIN DE CREAR HTML
	$pdf->writeHTML($html, true, false, true, false, '');

	$bodega = "/../bodega/precarga/".$codigo_usuario."/".$nombre_archivo;
	$pdf->Output(__DIR__.$bodega, 'F');



}

function pagovehiculo(){
	$codigo_usuario = $_SESSION['codigo_usuario'];
	$nombre_archivo = $_POST['nombreArchivo'];

	//datos recibidos
	$pagofecha1=$_POST['pagofecha1'];
	$pagofecha2=$_POST['pagofecha2'];
	$pagofecha3=$_POST['pagofecha3'];
	$pagoname=$_POST['pagoname'];
	$pagomodelo=$_POST['pagomodelo'];
	$pagoaño=$_POST['pagoaño'];
	$pagocuenta=$_POST['pagocuenta'];
	$pagofinancia=$_POST['pagofinancia'];
	$pagoseguro=$_POST['pagoseguro'];
	$pagopoliza=$_POST['pagopoliza'];
	$pagocontrato=$_POST['pagocontrato'];
	$pagopolizacontrato=$_POST['pagopolizacontrato'];
	$pagogap=$_POST['pagogap'];
	$pagopolizagap=$_POST['pagopolizagap'];
	// create new PDF document
	include('../recursos/tcpdf/examples/tcpdf_include.php');
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

	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
	$pdf->Image('images/Logo.jpg', 15, 14, 50, 10, 'JPG', '', '', true, 150, 'C',false,
	false, false, false, false, false);

	// crear html
	$html="
	<style>
	small{
		text-align:center;
	}
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
	<label style='padding-right:5px;'><b>Liquidación de Trade In Reclamo de Prima No
			devengada</b></label>
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
	<label style='padding-right:5px;'>El mismo está a mi nombre, con el número de cuenta
		# </label> <b>".$pagocuenta."</b> 
	<br>
	<label style='padding-right:5px;'>Y con la insitución financiera <b>".$pagofinancia."</b>. Entiendo también que al saldar la cuenta y cancelar la
		póliza de seguro y/o contrato de servicio, el importe de la prima no
		devengada le corresponderá <b>Auto1pr.com</b> como responsable de la liquidación de la
		misma.</label>
	<div style='padding-bottom:300px;'>
		<br>
		<br>
		<label style='padding-right:5px;'>Compañía de seguro:</label> <b>".$pagocompañia."</b>
		<label>Póliza:</label>
		<b>".$pagopoliza."</b>
		<br>
		<br>
		<label style='padding-right:5px;'>Contrato de servicio:</label> <b>".$pagocontrato."</b> Póliza: </label><b> ".$pagopolizacontrato."</b>
		<br>
		<br>
		<label style='padding-right:5px;'>Gap:</label><b> ".$pagogap."</b>
		<label>Póliza: </label><b> ".$pagopolizagap."</b>

	</div>
	</div>";
	//FIN DE CREAR HTML
	$pdf->writeHTML($html, true, false, true, false, '');

	$bodega = "/../bodega/precarga/".$codigo_usuario."/".$nombre_archivo;
	$pdf->Output(__DIR__.$bodega, 'F');

}





function estimadoquote(){

	$codigo_usuario = $_SESSION['codigo_usuario'];
	$nombre_archivo = $_POST['nombreArchivo'];

	//datos recibidos	
	$namequote=$_POST['namequote'];
	$fechaquote=$_POST['fechaquote'];
	$vendedorquote=$_POST['vendedorquote'];
	$precioquote=$_POST['precioquote'];
	$gastosquote=$_POST['gastosquote'];
	$totalquote=$_POST['totalquote'];
	$prontoquote=$_POST['prontoquote'];
	$balancequote=$_POST['balancequote'];
	$tradequote=$_POST['tradequote'];
	$entidadquote=$_POST['entidadquote'];
	$terminoquote=$_POST['terminoquote'];
	$pagoquote=$_POST['pagoquote'];
	$marcaquote=$_POST['marcaquote'];
	$modeloquote=$_POST['modeloquote'];
	$versionquote=$_POST['versionquote'];
	$añoquote=$_POST['añoquote'];
	$millajequote=$_POST['millajequote'];
	$tablillaquote=$_POST['tablillaquote'];
	


	// create new PDF document
	include('../recursos/tcpdf/examples/tcpdf_include.php');

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

$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
$pdf->Image('images/Logo.jpg', 15, 14, 70, 15, 'JPG', '', '', true, 150, 'L',false,
 false, false, false, false, false);

// crear html
$html="
<p></p>
<p></p>
	<p>Estimado/a: <b> ".$namequote."</b><br>
		A continuación le brindamos los números para su análisis </p>


<p><b style='float:left;'>Fecha:</b> <b>".$fechaquote."</b></p>

<p><b style='float:left;'>Vendedor:</b> <b>".$vendedorquote."</b></p>


<br>

	<p><small><b>Precio de Venta:</b></small></p>
	<label for=''>$ <b>".$precioquote."</b></label>
	<br>
	<br>
	<b>Gastos de traspaso: </b><label>$ <b>".$gastosquote."</b></label>
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
	<b>Termino: </b><label> <b>".$terminoquote."</b></label>
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

</div>";
//FIN DE CREAR HTML
$pdf->writeHTML($html, true, false, true, false, '');

$bodega = "/../bodega/precarga/".$codigo_usuario."/".$nombre_archivo;
$pdf->Output(__DIR__.$bodega, 'F');


}

function compraventa_vehiculo(){
	$codigo_usuario = $_SESSION['codigo_usuario'];
	$nombre_archivo = $_POST['nombreArchivo'];
//////////////////////////
	$vendedor = $_POST['vendedor'];
	$identificacion_vendedor = $_POST['identificacion_vendedor'];
	$direccion_telefono_vendedor = $_POST['direccion_telefono_vendedor'];
	$ciudad_vendedor = $_POST['ciudad_vendedor'];
	$comprador = $_POST['comprador'];
	$identificacion_comprador = $_POST['identificacion_comprador'];
	$direccion_telefono_comprador = $_POST['direccion_telefono_comprador'];
	$ciudad_comprador = $_POST['ciudad_comprador'];
	$placa = $_POST['placa'];
	$marca = $_POST['marca'];
	$linea = $_POST['linea'];
	$modelo = $_POST['modelo'];
	$cilindrada = $_POST['cilindrada'];
	$color = $_POST['color'];
	$servicio = $_POST['servicio'];
	$clase = $_POST['clase'];
	$carroceria = $_POST['carroceria'];
	$combustible = $_POST['combustible'];
	$capacidad = $_POST['capacidad'];
	$motor = $_POST['motor'];
	$chasis = $_POST['chasis'];
	$fecha_matricula = $_POST['fecha_matricula'];
	$vin = $_POST['vin'];
	$importacion = $_POST['importacion'];
	$fecha = $_POST['fecha'];
	$transito = $_POST['transito'];
	$precio_letras = $_POST['precio_letras'];
	$precio_numeros = $_POST['precio_numeros'];
	$forma_pago = $_POST['forma_pago'];
	$telefono_vendedor = $_POST['telefono_vendedor'];
	$telefono_comprador = $_POST['telefono_comprador'];

	require('../recursos/fpdf/fpdf.php');

	$pdf = new FPDF();
	$pdf->AddPage();

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,15,'CONTRATO-COMPRA VENTA DE VEHICULO',0,2,'C');

	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(95,6,'VENDEDOR',1,0,'L');
	$pdf->Cell(95,6,utf8_decode("$vendedor"),1,0,'L');
	$pdf->Ln();

	$pdf->Cell(95,6,'IDENTIFICACION',1,0,'L');
	$pdf->Cell(95,6,"$identificacion_vendedor",1,0,'L');
	$pdf->Ln();

	$pdf->Cell(95,6,'DIRECCION',1,0,'L');
	$pdf->Cell(95,6,utf8_decode("$direccion_telefono_vendedor"),1,0,'L');
	$pdf->Ln();

	$pdf->Cell(95,6,'TELEFONO',1,0,'L');
	$pdf->Cell(95,6,utf8_decode("$telefono_vendedor"),1,0,'L');
	$pdf->Ln();

	$pdf->Cell(95,6,'CIUDAD',1,0,'L');
	$pdf->Cell(95,6,utf8_decode("$ciudad_vendedor"),1,0,'L');
	$pdf->Ln();
	$pdf->Ln();

	$pdf->Cell(95,6,'COMPRADOR',1,0,'L');
	$pdf->Cell(95,6,utf8_decode("$comprador"),1,0,'L');
	$pdf->Ln();

	$pdf->Cell(95,6,'IDENTIFICACION',1,0,'L');
	$pdf->Cell(95,6,"$identificacion_comprador",1,0,'L');
	$pdf->Ln();

	$pdf->Cell(95,6,'DIRECCION',1,0,'L');
	$pdf->Cell(95,6,utf8_decode("$direccion_telefono_comprador"),1,0,'L');
	$pdf->Ln();

	$pdf->Cell(95,6,'TELEFONO',1,0,'L');
	$pdf->Cell(95,6,utf8_decode("$telefono_comprador"),1,0,'L');
	$pdf->Ln();

	$pdf->Cell(95,6,'CIUDAD',1,0,'L');
	$pdf->Cell(95,6,utf8_decode("$ciudad_comprador"),1,0,'L');
	$pdf->Ln();
	$pdf->Ln();

	$pdf->MultiCell(190,6,utf8_decode('Hemos convenido celebrar un contrato de COMPRAVENTA DE VEHÍCULO AUTOMOTOR que se regirá por las normas legales aplicables a la materia y en especial por las siguientes cláusulas: '),0,'J');

	$pdf->Ln();

	$pdf->MultiCell(190,6,utf8_decode('PRIMERA. Objeto: EL VENDEDOR da en venta y transfiere la propiedad a EL COMPRADOR y este recibe a mismo título, en los términos y condiciones que aquí se determinan, el vehículo automotor identificado de la siguiente forma: '),0,'J');

	$pdf->Ln();

	$pdf->Cell(38,6,'PLACA',1,0,'C');
	$pdf->Cell(38,6,'MARCA',1,0,'C');
	$pdf->Cell(38,6,'LINEA',1,0,'C');
	$pdf->Cell(38,6,'MODELO',1,0,'C');
	$pdf->Cell(38,6,'CILINDRADA',1,0,'C');

	$pdf->Ln();

	$pdf->Cell(38,6,"$placa",1,0,'C');
	$pdf->Cell(38,6,utf8_decode("$marca"),1,0,'C');
	$pdf->Cell(38,6,utf8_decode("$linea"),1,0,'C');
	$pdf->Cell(38,6,utf8_decode("$modelo"),1,0,'C');
	$pdf->Cell(38,6,utf8_decode("$cilindrada"),1,0,'C');

	$pdf->Ln();
	$pdf->Ln();

	$pdf->Cell(38,6,'COLOR',1,0,'C');
	$pdf->Cell(38,6,'SERVICIO',1,0,'C');
	$pdf->Cell(38,6,'CLASE VEHIC',1,0,'C');
	$pdf->Cell(38,6,'CARROCERIA',1,0,'C');
	$pdf->Cell(38,6,'COMBUSTIBLE',1,0,'C');

	$pdf->Ln();

	$pdf->Cell(38,6,utf8_decode("$color"),1,0,'C');
	$pdf->Cell(38,6,utf8_decode("$servicio"),1,0,'C');
	$pdf->Cell(38,6,utf8_decode("$clase"),1,0,'C');
	$pdf->Cell(38,6,utf8_decode("$carroceria"),1,0,'C');
	$pdf->Cell(38,6,utf8_decode("$combustible"),1,0,'C');

	$pdf->Ln();
	$pdf->Ln();

	$pdf->Cell(47.5,6,'CAP: KILOS - PAS',1,0,'C');
	$pdf->Cell(47.5,6,'No. MOTOR',1,0,'C');
	$pdf->Cell(47.5,6,'No. CHASIS',1,0,'C');
	$pdf->Cell(47.5,6,'FECHA MATRICULA',1,0,'C');

	$pdf->Ln();

	$pdf->Cell(47.5,6,utf8_decode("$capacidad"),1,0,'C');
	$pdf->Cell(47.5,6,utf8_decode("$motor"),1,0,'C');
	$pdf->Cell(47.5,6,utf8_decode("$chasis"),1,0,'C');
	$pdf->Cell(47.5,6,utf8_decode("$fecha_matricula"),1,0,'C');

	$pdf->Ln();
	$pdf->Ln();

	$pdf->Cell(47.5,6,'VIN',1,0,'C');
	$pdf->Cell(47.5,6,'DEC. IMPORTAC',1,0,'C');
	$pdf->Cell(47.5,6,'FECHA DECLAR',1,0,'C');
	$pdf->Cell(47.5,6,'ORG. TRANSITO',1,0,'C');

	$pdf->Ln();

	$pdf->Cell(47.5,6,utf8_decode("$vin"),1,0,'C');
	$pdf->Cell(47.5,6,utf8_decode("$importacion"),1,0,'C');
	$pdf->Cell(47.5,6,utf8_decode("$fecha"),1,0,'C');
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(47.5,6,utf8_decode("$transito"),1,0,'C');
	$pdf->SetFont('Arial','B',12);

	$pdf->Ln();
	$pdf->Ln();

	$pdf->MultiCell(190,6,utf8_decode("El automotor se transfiere con sus accesorios correspondientes y en perfecto estado de funcionamiento, a entera satisfacción del comprador, como este lo declara expresamente. "),0,'J');

	$pdf->Ln();

	$pdf->MultiCell(190,6,utf8_decode("SEGUNDA. Precio: Como precio del vehículo descrito en la cláusula anterior, se ha acordado la suma de $precio_letras ($precio_numeros) Mcte."),0,'J');

	$pdf->Ln();

	$pdf->MultiCell(190,6,utf8_decode("TERCERA. Forma de pago: EL COMPRADOR, en virtud de este contrato se compromete a pagar al VENDEDOR la suma acordada en la Cláusula Segunda de la siguiente manera: $forma_pago"),0,'J');

	$pdf->Ln();

	$pdf->MultiCell(190,6,utf8_decode("CUARTA. Obligaciones del VENDEDOR:"),0,'J');

	$pdf->Ln();

	$pdf->MultiCell(190,6,utf8_decode("EL VENDEDOR se obliga a hacer entrega del vehículo descrito en el presente contrato, libre de gravámenes, embargos, sanciones, impuestos, pactos de reserva de domino, limitaciones a la propiedad y cualquiera otra circunstancia que afecte el libre comercio del bien objeto del presente contrato."),0,'J');

	$pdf->Ln();

	$pdf->MultiCell(190,6,utf8_decode("EL VENDEDOR hace entrega del vehículo a la firma del presente CONTRATO COMPRA-VENTA, del formulario de TRAMITE DE TRASPASO; se obliga a entregar el vehículo objeto del contrato una vez se termine el trámite de traspaso por parte del COMPRADOR"),0,'J');

	$pdf->Ln();

	$pdf->MultiCell(190,6,utf8_decode("QUINTA. Obligaciones del COMPRADOR:"),0,'J');

	$pdf->Ln();

	$pdf->MultiCell(190,6,utf8_decode("EL COMPRADOR, se obliga a pagar el precio estipulado en la cláusula segunda una vez cumplido el objeto de la presente contratación, recibido el vehículo a satisfacción."),0,'J');

	$pdf->Ln();

	$pdf->MultiCell(190,6,utf8_decode("SEXTA. Entrega: Para todos los efectos contractuales las partes convienen en que la entrega se entiende realizada ya que el COMPRADOR declara que ha recibido a entera satisfacción el vehículo objeto del contrato."),0,'J');

	$pdf->Ln();

	$pdf->MultiCell(190,6,utf8_decode("SÉPTIMA. Cesión: Las partes no podrán hacer cesión de este contrato, salvo autorización expresa y escrita de la contraparte."),0,'J');

	$pdf->Ln();

	$pdf->MultiCell(190,6,utf8_decode("OCTAVA. Derechos de Tramite e Impuestos: Todos los gastos relacionados con el trámite ante el Organismo de Transito serán cubiertos por parte: Comprador."),0,'J');

	$pdf->Ln();

	$dia = date('d');
	$mes = date('m');
	$año = date('Y');
	$pdf->MultiCell(190,6,utf8_decode("NOVENA.  Se firma entre las partes el $dia de $mes de $año"),0,'J');

	$pdf->Output('F',"../bodega/precarga/$codigo_usuario/$nombre_archivo");
	//$pdf->Output('I');
}

function pagare_a_la_orden(){

	$codigo_usuario = $_SESSION['codigo_usuario'];
	$nombre_archivo = $_POST['nombreArchivo'];

	$numero = $_POST['numero'];
	$suscriptor = $_POST['suscriptor'];
	$valor_deuda_consumos = $_POST['valor_deuda_consumos'];
	$valor_deuda_diferidos = $_POST['valor_deuda_diferidos'];
	$valor_deuda_financiaciones = $_POST['valor_deuda_financiaciones'];
	$valor_deuda_total = $_POST['valor_deuda_total'];
	$cuota_inicial = $_POST['cuota_inicial'];
	$plazo_meses = $_POST['plazo_meses'];
	$cuota_mensual = $_POST['cuota_mensual'];
	$deudor = $_POST['deudor'];
	$identificacion = $_POST['identificacion'];
	$telefono = $_POST['telefono'];
	$cuota_restante = $_POST['cuota_restante'];

	require('../recursos/fpdf/fpdf.php');

	$pdf = new FPDF();
	$pdf->AddPage();

	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(0,30,'PAGARE A LA ORDEN',0,2,'C');

	$fecha = date('d-m-Y');
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(0,5,utf8_decode("PAGARE No. $numero SUSCRIPTOR No. $suscriptor Santiago de Cali, $fecha "),0,0,'L');
	$pdf->Ln();

	$pdf->Cell(0,5,utf8_decode("VALOR DEUDA POR CONSUMOS $valor_deuda_consumos (Cero pesos con Cero Centavos m/cte.)"),0,0,'L');
	$pdf->Ln();

	$pdf->Cell(0,5,utf8_decode("VALOR DEUDA POR DIFERIDOS $valor_deuda_diferidos (Cero pesos con Cero Centavos m/cte.)"),0,0,'L');
	$pdf->Ln();

	$pdf->Cell(0,5,utf8_decode("VALOR DEUDA POR FINANCIACIONES $valor_deuda_financiaciones (Cero pesos con Cero Centavos m/cte.)"),0,0,'L');
	$pdf->Ln();

	$pdf->Cell(0,5,utf8_decode("VALOR DEUDA TOTAL $valor_deuda_total, (Cero pesos con Cero Centavos m/cte.)"),0,0,'L');
	$pdf->Ln();

	$pdf->Cell(0,5,utf8_decode("CUOTA INICAL $cuota_inicial (Cero pesos con Cero Centavos m/cte.)"),0,0,'L');
	$pdf->Ln();

	$pdf->Cell(30,5,utf8_decode("PLAZO"),0,0,'L');
	$pdf->Cell(30,5,utf8_decode("$plazo_meses Mes(es)"),0,0,'L');
	$pdf->Cell(70,5,utf8_decode("INTERESES (TEA) Cero porciento (0%)"),0,0,'L');
	$pdf->Ln();

	$pdf->Cell(0,5,utf8_decode("CUOTA(S) MENSUAL(ES) $cuota_mensual (Cero pesos con Cero Centavos m/cte.)"),0,0,'L');
	$pdf->Ln();

	$pdf->Cell(80,5,utf8_decode("ACEEDOR EMCALI EICE ESP NIT 890.399.003-4"),0,0,'L');
	$pdf->Cell(80,5,utf8_decode("Lugar donde se efectuara el pago: Santiago de Cali."),0,0,'L');
	$pdf->Ln();

	$pdf->Cell(0,5,utf8_decode("DEUDOR $deudor Identificado con CC/NIT $identificacion Teléfono $telefono"),0,0,'L');
	$pdf->Ln();
	$pdf->Ln();

	$pdf->MultiCell(0,4,utf8_decode("PRIMERA OBJETO: Que por virtud del presente título valor yo, $deudor, Identificado con CC/NIT $identificacion, pagaré incondicionalmente a la orden de EMCALI EICE ESP con NIT. 890.399.003-4, o a quien represente sus derechos en la ciudad, 
	dirección indicada, y en las fechas de amortización por cuotas señaladas en la cláusula tercera de este pagaré, la suma de $valor_deuda_total, más los intereses señalados en la clausula segunda de este documento.   SEGUNDA INTERESES: Que sobre la suma debida, se reconocerán intereses corrientes a una Tasa Efectiva Anual, del cero porciento (0%).   TERCERA FORMA DE PAGO: Que pagaré el capital indicado en la cláusula primera de este pagaré mediante CUOTA INICAL $cuota_inicial, y la diferencia en $cuota_restante CUOTA(S) MENSUAL(ES) $cuota_mensual, iguales y sucesiva cobradas en la factura de cobro de servicios públicos identificada con el SUSCRIPTOR No. $suscriptor CUARTA CLAUSULA ACELERATORIA: El tenedor del presente pagaré podrá declarar vencidos la totalidad de los plazos de esta obligación o de las cuotas que constituyan el saldo de lo debido y exigir su pago inmediato ya sea judicial o extrajudicialmente, cuando el (los) deudos(es) entre en mora de dos (2) facturas vencidas o incumpla una o cualquiera de las obligaciones derivadas del presente documento, cuando el (los) deudos(es) fuese demandado por cualquier persona distinta de EMCALI EICE ESP cuando el (los) deudos(es) se someta proceso concordatario, de recuperación de negocios, o presente cualquier tipo de insolvencia, que tenga una representación procesal.   Si el deudor es cliente de los estratos uno (1) y dos (2), autorizará a EMCALI EICE ESP para adelantar trabajos de normalización de las redes tanto de energía como de acueducto, en los casos en los que las condiciones técnicas, normativas y financieras de EMCALI EICE ESP lo permitan y el acreedor así lo contemple en su plan de mejoramiento de inversión.   QUINTA CUMPLIMIENTO: El Deudor que incumpla este plan de pagos (con dos (2) o mas facturas vencidas), quedará bloqueado para cualquier financiación y se le iniciara en forma inmediata EL PROCESO DE JUDICIALIZACIÓN. . El incumplimiento en el pago de dos (2) facturas, generara la suspensión del servicio o su posterior corte si persiste su incumplimiento  y generará el cargo automático del saldo de la deuda, así como de los descuentos que hubiese tenido.   Para garantizar el cumplimiento de las obligaciones contenidas en la(s) factura(s) de servicios públicos del SUSCRIPTOR No. $suscriptor propietario, poseedores, herederos reconocidos, o en su defecto atendiendo las ordenes hereditarios y en todos los casos quienes representen sus derechos, además de incluir los casos generales que reúnan los requisitos de la ley y establecidos por EMCALI EICE ESP, firmaran el presente titulo valor. Así mismo el incumplimiento en el pago de la cuota inicial dentro de los tres (3) días hábiles siguientes a la realización del convenio de pago, dará por incumplido el mismo y se realizara el cargo automático del saldo de la deuda "),0,'J');

	$pdf->Ln();

	$pdf->MultiCell(0,4,utf8_decode("En constancia de lo anterior, se suscribe este documento en la ciudad de Santiago de Cali, a los $fecha, de mutuo acuerdo dejan expresa constancia que la factura conserva plena validez para todos los efectos"),0,'J');

	
	$pdf->Output('F',"../bodega/precarga/$codigo_usuario/$nombre_archivo");
	//$pdf->Output('I');

}

/*
*   Software development: Ing. Bernabe Sanchez Lenis
*	líneas de código: 322 - 478
*/
function prestacion_servicios(){

	$codigo_usuario = $_SESSION['codigo_usuario'];
	$nombre_archivo = $_POST['nombreArchivo'];

	$no_contrato = $_POST['no_contrato'];
	$plazo = $_POST['plazo'];
	$valor = $_POST['valor'];
	$nombre_contratante = $_POST['nombre_contratante'];
	$identificacion_contratante = $_POST['identificacion_contratante'];
	$direccion_contratante = $_POST['direccion_contratante'];
	$correo_electronico_contratante = $_POST['correo_electronico_contratante'];
	$celular_contratante = $_POST['celular_contratante'];
	$nombre_contratista = $_POST['nombre_contratista'];
	$identificacion_contratista = $_POST['identificacion_contratista'];
	$ciudad_contratista = $_POST['ciudad_contratista'];
	$direccion_contratista = $_POST['direccion_contratista'];
	$correo_electronico_contratista = $_POST['correo_electronico_contratista'];
	$celular_contratista = $_POST['celular_contratista'];
	$cargo_contratista = $_POST['cargo_contratista'];
	$objeto_contrato = $_POST['objeto_contrato'];
	$fecha_pago = $_POST['fecha_pago'];
	$forma_de_pago = $_POST['forma_de_pago'];
	$albitraje_1 = $_POST['albitraje_1'];
	$albitraje_2 = $_POST['albitraje_2'];

	//Variables para indicar la fecha en que se redacta el documento
	$dia = date('d');
	$mes = date('m');
	$anio = date('Y');

	include('../recursos/tcpdf/tcpdf.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle($nombre_archivo);
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);

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

// ---------------------------------------------------------

// set font
	$pdf->SetFont('dejavusans', '', 10);

// add a page
	$pdf->AddPage();

// create some HTML content
	$html = '
	<h1 style="text-align:center">CONTRATO DE PRESTACIÓN DE SERVICIOS</h1>
	<table border="1" cellspacing="0" cellpadding="4">
	<tr>
	<th style="width:20%"><b>CONTRATO:</b></th>
	<th style="width:80%">'.$no_contrato.'</th>
	</tr>
	<tr>
	<th style="width:20%"><b>CONTRATANTE:</b></th>
	<th style="width:80%">'.$nombre_contratante.'</th>
	</tr>
	<tr>
	<th style="width:20%"><b>IDENTIFICACIÓN:</b></th>
	<th style="width:80%">'.$identificacion_contratante.'</th>
	</tr>
	<tr>
	<th style="width:20%"><b>CONTRATISTA:</b></th>
	<th style="width:80%">'.$nombre_contratista.'</th>
	</tr>
	<tr>
	<th style="width:20%"><b>IDENTIFICACIÓN:</b></th>
	<th style="width:80%">'.$identificacion_contratista.'</th>
	</tr>
	<tr>
	<th style="width:20%"><b>PLAZO:</b></th>
	<th style="width:80%">'.$plazo.'</th>
	</tr>
	<tr>
	<th style="width:20%"><b>VALOR:</b></th>
	<th style="width:80%">'.$valor.'</th>
	</tr>
	</table>

	<p style="text-align: justify;">Entre los suscritos CONTRATANTE Y CONTRATISTA, personas identificadas como aparece al pie de sus firmas, acuerdan celebrar el presente contrato de prestación de servicios que se regulará por las disposiciones del Código Civil y Código de Comercio aplicables al presente contrato y por las cláusulas que a continuación se expresan:</p>

	<p style="text-align: justify;"><b>PRIMERA: OBJETO DEL CONTRATO:</b> EL CONTRATISTA en su calidad de <u> '.$cargo_contratista.' </u>, se obliga para con El CONTRATANTE a ejecutar el objeto y demás actividades propias del servicio contratado, el cual debe realizar de conformidad con las condiciones y cláusulas del presente documento y que consistirá en: <u> '.$objeto_contrato.' </u>. <b>PARAGRAFO PRIMERO:</b> EL CONTRATISTA deberá atender todas las especificaciones técnicas, económicas, financieras y administrativas las cuales hacen parte integral del presente contrato y EL CONTRATISTA manifiesta conocer y estar en capacidad de cumplir. <b>PARAGRAFO SEGUNDO:</b> EL CONTRATISTA siendo una persona especializada en la prestación de los servicios aquí contratados declara que conoce de manera total el objeto social, presente y pasado del CONTRATANTE, obligaciones y actividades a realizar y se encuentra en total capacidad técnica y humana de prestar el servicio materia del presente contrato.</p>

	<p style="text-align: justify;"><b>SEGUNDA. -PLAZO.</b> El plazo para la ejecución del presente contrato es el que aparece en la parte superior de este documento contado a partir de la firma del mismo. El presente contrato podrá prorrogarse por acuerdo entre las partes con antelación a la fecha de su expiración mediante la celebración de un contrato adicional que deberá ser suscrito por las partes. <b>PARAGRAFO:</b> En caso que EL CONTRATISTA no realice la entrega total del trabajo dentro del plazo establecido, las partes aquí suscribientes podrán extender el plazo de ejecución de este contrato hasta tanto se culminen los trabajos por parte de EL CONTRATISTA sin que esto implique costo adicional alguno a cargo del CONTRATANTE.</p>

	<p style="text-align: justify;"><b>TERCERA. VALOR.</b> El valor del contrato será por la suma pactada y que se encuentra consignada en la parte superior de este documento.  Esta suma incluye todos los impuestos, tasas, estampillas y contribuciones a que haya lugar.</p>

	<p style="text-align: justify;"><b>CUARTA. -FORMA DE PAGO.</b> El valor pactado será cancelado por EL CONTRATANTE de la siguiente manera:  A) <u> '.$forma_de_pago.' </u> una vez EL CONTRATISTA entregue la totalidad del servicio contratado junto con los informes respectivos.  PARÁGRAFO PRIMERO: El dinero será cancelado a la cuenta que suministre EL CONTRATISTA, mediante transferencia bancaria dentro de los cinco (5) días siguientes a la presentación de la factura o cuenta de cobro según corresponda, o en efectivo si así lo acuerdan las partes en cada ocasión.  Para cada pago el CONTRATISTA deberá aportar la certificación de pago de la seguridad social y parafiscales. PARAGRAFO SEGUNDO: El precio convenido en el presente contrato no estará sujeto a variaciones.</p>

	<p style="text-align: justify;"><b>QUINTA. -OBLIGACIONES DEL CONTRATANTE.</b> Este deberá realizar el pago conforme lo establecido en el presente contrato y dar acceso a la información que sea necesaria, de manera oportuna, para la debida ejecución del objeto del contrato, y, estará obligado a cumplir con lo estipulado en las demás cláusulas y condiciones previstas en este documento</p>

	<p style="text-align: justify;"><b>SEXTA. -OBLIGACIONES DE EL CONTRATISTA.</b> EL CONTRATISTA deberá cumplir en forma eficiente y oportuna el servicio contratado y específicamente cumplir las siguientes obligaciones: <b>Obligaciones generales: 1.</b> Realizar las actividades necesarias para que el objeto del contrato se cumpla a cabalidad y se presten los servicios en debida forma dentro del plazo establecido. <b>2.</b> Guardar absoluta reserva en relación con toda la información que maneje con ocasión de las actividades y de la entidad en general, que le sea dada a conocer con ocasión del presente contrato. <b>3.</b> Informar oportunamente y por escrito al CONTRATANTE sobre los inconvenientes que afecten el desarrollo del objeto contractual. <b>4.</b> Cumplir con las obligaciones a su cargo que se deriven de la naturaleza de este contrato y de las exigencias legales. <b>5.</b> Atender oportunamente los requerimientos de EL CONTRATANTE. <b>6.</b> Cumplir con las garantías establecidas en el presente contrato, en caso que se estipularen. <b>7.</b> Cumplir con las obligaciones para con el Sistema de Seguridad Social y Parafiscales <b>8.</b> Subsanar las observaciones realizadas en forma escrita por parte del supervisor del presente contrato o cualquier directivo del CONTRATANTE. <b>9.</b> Reportar al CONTRATANTE el número de cuenta bancaria de ahorro o corriente, donde se le ha de consignar el pago derivado de la ejecución del presente contrato. <b>10.</b> Las demás que se consideren necesarias para la debida ejecución del objeto contractual y sus obligaciones. <b>DECLARACIONES DEL CONTRATISTA:</b> EL CONTRATISTA hace las siguientes declaraciones: 1. Conoce y acepta los Documentos del Proceso. 2. Tuvo la oportunidad de solicitar aclaraciones y modificaciones a los Documentos del Proceso y recibió del CONTRATANTE, respuesta oportuna a cada una de las solicitudes. 3. Se encuentra debidamente facultada académica y técnicamente para suscribir el presente contrato. 4. EL CONTRATISTA al momento de la celebración del presente contrato no se encuentra en ninguna causal de inhabilidad e incompatibilidad. 5. Está a paz y salvo con sus obligaciones laborales frente al sistema de seguridad social integral. 6. El valor del contrato es integral e incluye todos los gastos, costos, derechos y demás relacionados con el cumplimiento del objeto del presente contrato. 7. EL CONTRATISTA manifiesta que los recursos que componen su patrimonio no provienen de lavado de activos, financiación del terrorismo, narcotráfico, captación ilegal de dineros y en general de cualquier actividad ilícita; de igual manera manifiesta que los recursos recibidos en desarrollo de este contrato no serán destinados a ninguna de las actividades antes descritas. 8. EL CONTRATISTA se compromete a no contratar menores de edad para el ejercicio del objeto contractual, así como a no permitir que se subcontrate a menores de edad para tales efectos, dando aplicación a la Resolución 1677 de 2008 del Ministerio de la Protección Social y los Pactos, Convenios y Convenciones Internacionales ratificados por Colombia, sobre los derechos de los niños.</p>

	<p style="text-align: justify;"><b>SÉPTIMA. -VIGILANCIA DEL CONTRATO.</b> EL CONTRATANTE o su representante supervisarán la ejecución del servicio encomendado, y podrá formular las observaciones del caso con el fin de ser analizadas conjuntamente con EL CONTRATISTA y efectuar por parte de éste las modificaciones o correcciones a que hubiere lugar. <b>PARÁGRAFO:</b> Quien ejerza la supervisión del presente contrato ejercerá las siguientes funciones 1) Verificar que el objeto del contrato se desarrolle de manera eficiente y adecuada. 2) Exigir el cumplimiento del objeto y de las obligaciones derivadas del contrato. 3) Verificar el cumplimiento de las obligaciones que debe cumplir EL CONTRATISTA para con el Sistema de Seguridad Social y Parafiscales, 4) Certificar la ejecución del contrato dentro de las condiciones exigidas, el cual es requisito para efectuar los pagos.</p>

	<p style="text-align: justify;"><b>OCTAVA. -TERMINACIÓN.</b> El presente contrato podrá darse por terminado por mutuo acuerdo entre las partes, o en forma unilateral por el incumplimiento de cualquiera de las obligaciones derivadas del contrato. El presente contrato terminará válidamente por decisión unilateral de EL CONTRATANTE en cualquier momento durante la vigencia inicial del contrato o cualquiera de sus prórrogas si las hubiere, por incumplimiento grave de las obligaciones de EL CONTRATISTA. En todo caso, EL CONTRATISTA tendrá derecho al pago del precio correspondiente a la parte proporcional del contrato ejecutada efectivamente, sin lugar al cobro de la totalidad del precio convenido, por cualquiera de ellas. En caso que se presente la terminación EL CONTRATISTA autoriza a EL CONTRATANTE para deducir, retener o solicitar el reintegro del valor total de las actividades no ejecutadas.</p>

	<p style="text-align: justify;"><b>NOVENA. SUSPENSIÓN DEL CONTRATO:</b> Por circunstancias de fuerza mayor o caso fortuito, se podrá de común acuerdo entre las partes suspender temporalmente la ejecución del Contrato, mediante la suscripción de un Acta donde conste tal evento, sin que para los efectos del plazo extintivo se compute el tiempo de la suspensión. En caso que se presente la suspensión EL CONTRATISTA autoriza a EL CONTRATANTE para deducir, retener o solicitar el reintegro del valor total de las actividades no ejecutadas o no recibidas a satisfacción.</p>

	<p style="text-align: justify;"><b>DECIMA. TRATAMIENTO DE DATOS:</b> EL CONTRATISTA autoriza expresamente a EL CONTRATANTE para a recolectar, guardar, tener, mantener, manejar, tratar, utilizar, actualizar, transferir, transmitir, y compartir los datos personales que ha entregado y voluntariamente entregue en el futuro como consecuencia del presente contrato, para fines relacionados con el cumplimiento de la ley, el cumplimiento de las obligaciones contractuales, y el ejercicio lícito de la actividad de EL CONTRATISTA. Esta autorización se extiende a la vigencia contractual y sus diez años siguientes, salvo que solicite rectificación de la información o revoque la presente autorización en los términos de ley. Así mismo EL CONTRATISTA se obliga a tratar los datos personales del CONTRATANTE, que recaude y que le sean entregados en virtud de la ejecución del objeto del presente contrato, única y exclusivamente para la finalidad por la cual le sean entregados, y declara que la inobservancia de lo aquí indicado se considerará como un incumplimiento grave de sus obligaciones contractuales.</p>

	<p style="text-align: justify;"><b>DECIMA PRIMERA - EXCLUSIÓN DE LA RELACIÓN LABORAL.</b> Queda claramente entendido que no existirá relación laboral alguna entre EL CONTRATANTE y EL CONTRATISTA, o el personal que éste utilice en la ejecución del objeto del presente contrato. El presente contrato de prestación de servicios implica el cumplimiento de las actividades por parte de EL CONTRATISTA dentro de un cronograma que implica unos tiempos específicos de ejecución, sin que exista subordinación y dependencia.</p>

	<p style="text-align: justify;"><b>DÉCIMA SEGUNDA. -CESIÓN DEL CONTRATO.</b> EL CONTRATISTA no podrá ceder parcial ni totalmente la ejecución del presente contrato a un tercero salvo previa autorización expresa y escrita de EL CONTRATANTE.</p>

	<p style="text-align: justify;"><b>DÉCIMA TERCERA. DOMICILIO CONTRACTUAL.</b> Para todos los efectos legales, el domicilio contractual será la ciudad de <u> '.$ciudad_contratista.' </u> y las notificaciones serán recibidas por las partes en las siguientes direcciones: EL CONTRATISTA recibirá las que le corresponden en la <u> '.$direccion_contratista.' </u> ó a través del correo electrónico <u> '.$correo_electronico_contratista.' </u> o al celular <u> '.$celular_contratista.' </u> y al CONTRATANTE será entregada personalmente al representante legal o enviado a la <u> '.$direccion_contratante.' </u> o al correo electrónico <u> '.$correo_electronico_contratante.' </u> o al celular <u> '.$celular_contratante.' </u>.</p>

	<p style="text-align: justify;"><b>DÉCIMA CUARTA. - MODIFICACIONES AL CONTRATO:</b> El presente contrato solo podrá ser modificado mediante documento suscrito por ambas partes. El presente documento es el único contrato válido de común acuerdo otorgado entre las partes y deja sin efecto cualquier acuerdo anterior expreso o tácito, verbal o escrito sobre el mismo objeto.</p>

	<p style="text-align: justify;"><b>DÉCIMA QUINTA. -CLÁUSULA COMPROMISORIA.</b> Toda controversia o diferencia relativa a este contrato será dirimida por un tribunal de arbitramento administrado por el Centro de Conciliación, Arbitraje y Amigable Composición de la Cámara de Comercio de <u> '.$albitraje_1.' </u>, estará conformado por un (1) árbitro para asuntos que versen sobre pretensiones inferiores o iguales a cien (100) SMLMV y por tres (3) para asuntos superiores a dicha cuantía o cuando esta sea indeterminada. Los árbitros serán designados de común acuerdo por las partes, y en caso de que no fuere posible, serán nombrados mediante sorteo realizado por el Centro de Conciliación, Arbitraje y Amigable Composición de la Cámara de Comercio de <u> '.$albitraje_2.' </u> de sus listas. El tribunal funcionará en las instalaciones del mencionado Centro, se sujetará a las reglas previstas en el Reglamento de éste, se regirá por las disposiciones vigentes sobre la materia y decidirá en derecho.</p>

	<p style="text-align: justify;"><b>DECIMA SEXTA: DOCUMENTOS DEL CONTRATO:</b> Son documentos del presente contrato la propuesta presentada por EL CONTRATISTA, fotocopia de la cedula, RUT de EL CONTRATISTA y los demás documentos que hagan parte del presente contrato.</p>

	<p style="text-align: justify;"><b>DECIMA SÉPTIMA: LEGALIZACIÓN Y EJECUCIÓN:</b> El presente contrato se entiende legalizado con la firma electrónica de las partes e iniciará su ejecución con la firma del mismo. De conformidad con lo anterior, las partes suscriben el presente documento en dos ejemplares del mismo tenor y valor en la fecha indicada a continuación: <u> día '.$dia.' del mes '.$mes.' del año '.$anio.' </u>.</p>
	';

// output the HTML content
	$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------
// save pdf file
//$pdf->Output('$nombre_archivo', 'I');
	$bodega = "/../bodega/precarga/".$codigo_usuario."/".$nombre_archivo;
	$pdf->Output(__DIR__.$bodega, 'F');

//============================================================+
// END OF FILE
//============================================================+
}

/*
*   Software development: Ing. Bernabe Sanchez Lenis
*	líneas de código: 484 - 621
*/
function promesa_compraventa(){

	$codigo_usuario = $_SESSION['codigo_usuario'];
	$nombre_archivo = $_POST['nombreArchivo'];

	$nombre_prominente = $_POST['nombre_prominente'];
	$identificacion_prominente = $_POST['identificacion_prominente'];
	$nombre_comprador = $_POST['nombre_comprador'];
	$identificacion_comprador = $_POST['identificacion_comprador'];
	$descripcion_inmueble = $_POST['descripcion_inmueble'];
	$direccion_inmueble = $_POST['direccion_inmueble'];
	$matricula_inmobiliaria = $_POST['matricula_inmobiliaria'];
	$precio = $_POST['precio'];
	$precio_inmueble = $_POST['precio_inmueble'];
	$abono_inmueble = $_POST['abono_inmueble'];
	$nro_notaria = $_POST['nro_notaria'];
	$circulo = $_POST['circulo'];
	$valor_en_letras = $_POST['valor_en_letras'];
	$valor_en_numeros = $_POST['valor_en_numeros'];
	$devolucion_en_letras_vendedor = $_POST['devolucion_en_letras_vendedor'];
	$devolucion_en_numeros_vendedor = $_POST['devolucion_en_numeros_vendedor'];
	$devolucion_en_letras_comprador = $_POST['devolucion_en_letras_comprador'];
	$devolucion_en_numeros_comprador = $_POST['devolucion_en_numeros_comprador'];
	$nombre_ciudad = $_POST['nombre_ciudad'];

	//Variables para indicar la fecha en que se redacta el documento
	date_default_timezone_set("America/Bogota");
	$dia = date('d');
	$mes = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"][date("n") - 1];
	$anio = date('Y');

	include('../recursos/tcpdf/tcpdf.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle($nombre_archivo);
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);

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

// ---------------------------------------------------------

// set font
	$pdf->SetFont('dejavusans', '', 10);

// add a page
	$pdf->AddPage();

// create some HTML content
	$html = '
	<h1 style="text-align:center">PROMESA DE CONTRATO DE COMPRAVENTA</h1>
	<h3 style="text-align:left">PROMITENTE VENDEDOR:</h3>
	<table border="0" cellspacing="0" cellpadding="4">
	<tr>
	<th style="width:20%"><b>Nombre:</b></th>
	<th style="width:80%; border-bottom: 1px solid black;">'.$nombre_prominente.'</th>
	</tr>
	<tr>
	<th style="width:20%"><b>Identificación:</b></th>
	<th style="width:80%; border-bottom: 1px solid black;">'.$identificacion_prominente.'</th>
	</tr>
	</table>
	<h3 style="text-align:left">PROMITENTE COMPRADOR:</h3>
	<table border="0" cellspacing="0" cellpadding="4">
	<tr>
	<th style="width:20%"><b>Nombre:</b></th>
	<th style="width:80%; border-bottom: 1px solid black;">'.$nombre_comprador.'</th>
	</tr>
	<tr>
	<th style="width:20%"><b>Identificación:</b></th>
	<th style="width:80%; border-bottom: 1px solid black;">'.$identificacion_comprador.'</th>
	</tr>
	</table>
	<h3 style="text-align:left">DESCRIPCIÓN DEL INMUEBLE:</h3>
	<table border="0" cellspacing="0" cellpadding="4">
	<tr>
	<th style="width:100%; border-bottom: 1px solid black;">'.$descripcion_inmueble.'</th>
	</tr>
	</table>
	<h3 style="text-align:left"></h3>
	<table border="0" cellspacing="0" cellpadding="4">
	<tr>
	<th style="width:20%"><b>DIRECCIÓN:</b></th>
	<th style="width:80%; border-bottom: 1px solid black;">'.$direccion_inmueble.'</th>
	</tr>
	<tr>
	<th style="width:50%"><b>NÚMERO DE MATRÍCULA INMOBILIARIA:</b></th>
	<th style="width:50%; border-bottom: 1px solid black;">'.$matricula_inmobiliaria.'</th>
	</tr>
	<tr>
	<th style="width:20%"><b>PRECIO:</b></th>
	<th style="width:80%; border-bottom: 1px solid black;">'.$precio.'</th>
	</tr>
	</table>

	<p style="text-align: justify;">Entre los suscritos PROMITENTE VENDEDOR y PROMITENTE COMPRADOR, identificados como aparece en la parte superior de este documento, hemos celebrado el presente contrato de Promesa de Compraventa de bien inmueble, el cual regirá por las siguientes cláusulas y en lo no previsto, por las disposiciones pertinentes de la ley colombiana.  CLAUSULA PRIMERA: OBJETO DEL NEGOCIO Y DESCRIPCION DEL INMUEBLE:  mediante el presente contrato la parte denominada PROMITENTE VENDEDOR se obliga a vender a la parte denominada PROMITENTE COMPRADOR  y ésta a su vez se obliga a comprar el bien inmueble descrito en la parte superior de este documento.  CLAUSULA SEGUNDA: LIBERTAD DE GRAVAMENES Y SANEAMIENTO:  La parte PROMITENTE VENDEDOR:  garantiza la titularidad del derecho de propiedad y dominio del inmueble que transferirá a título de venta y declara expresamente que el inmueble  es de su exclusiva propiedad y que lo transferirán libre de gravámenes (hipotecas) medidas cautelares, inscripciones de demandas, títulos de tenencia por Escritura Pública, condiciones resolutorias, nulidades, censo, anticresis, servidumbres, usufructos y demás limitaciones al dominio.  CLAUSULA TERCERA: PRECIO Y FORMA DE PAGO: El valor total del inmueble objeto de este contrato de Promesa de Compraventa, se fija en la suma de <u> '.$precio_inmueble.' </u>, que serán cancelados por EL PROMITENTE COMPRADOR así: A) La suma de <u> '.$abono_inmueble.' </u> B) EL saldo al momento de la suscripción de la escritura pública de compraventa.  CLAUSULA CUARTA: FIRMA DE LA ESCRITURA PUBLICA:  La Escritura Pública de Compraventa que solemnice y de cumplimiento a esta Promesa de Contrato de Compraventa, se otorgará el día <u> '.$dia.' </u> de <u> '.$mes.' </u> de <u> '.$anio.' </u>, la cual se suscribirá en la NOTARIA <u> '.$nro_notaria.' </u> del circulo de <u> '.$circulo.' </u>, CLAUSULA QUINTA: ENTREGA DEL INMUEBLE: EL PROMITENTE VENDEDOR hará entrega material del inmueble a EL PROMITENTE COMPRADOR,  una vez sea cancelado el valor total del inmueble y sea suscita la Escritura Pública que protocolice el presente contrato de promesa de compraventa.   CLAUSULA SEPTIMA: ESTADO: EL PROMITENTE COMPRADOR,  declara conocer y haber identificado plenamente lo prometido en venta, al igual que las características físicas, que es  usado, con deterioro normal por su uso y se comprometen a recibirlo a su completa satisfacción en el estado físico en que se encuentre el día de la entrega material, por lo tanto renuncia desde ya a cualquier reclamación judicial por el estado de la cosa, a excepción del vicio oculto.  CLAUSULA OCTAVA: IMPUESTOS Y GASTOS: El valor correspondiente al impuesto predial, las tasas de contribución de valorización y mega obras,  serán asumidos en su totalidad por EL PROMITENTE VENDEDOR, hasta el día que se firme la respectiva Escritura Pública.  Las tasas de contribución de valorización, impuesto predial y mega obras, así como servicios públicos y la administración con posterioridad a la firma de la escritura pública del inmueble prometido en venta, correrán por cuenta exclusiva DEL PROMITENTE COMPRADOR.  CLAUSULA NOVENA: PENA POR INCUMPLIMIENTO:  Las partes convienen una cláusula penal equivalente a la suma de <u> '.$valor_en_letras.' </u> ($ <u> '.$valor_en_numeros.' </u> ) a favor de aquel que hubiera incumplido o se hubiera allanado a cumplir, salvo caso fortuito o fuerza mayor. Dicha suma será exigible por la vía ejecutiva. El contratante que hubiere cumplido o se hubiere allanado a cumplir lo que le corresponde, podrá escoger bien por el cumplimiento del contrato, o bien la resolución del mismo y tendrá derecho en ambos casos al pago de la penalidad como lo permiten los artículos 870 del Código de Comercio y 1546 y 1600 del Código Civil. De tal forma  que si quien incumpliere fuere EL PROMITENTE VENDEDOR,  este se obliga a devolver la suma recibida como parte del precio más <u> '.$devolucion_en_letras_vendedor.' </u> ($ <u> '.$devolucion_en_numeros_vendedor.' </u> ) y en el caso que el incumplimiento fuere por parte de EL PROMITENTE COMPRADOR, este perderán la suma de <u> '.$devolucion_en_letras_comprador.' </u> ($ <u> '.$devolucion_en_numeros_comprador.' </u> )  y se le reintegrará el saldo restante de la suma entregada como parte del precio de la misma si la hubiere.  CLAUSULA DECIMA: MERITO EJECUTIVO: El presente documento presta mérito ejecutivo pare exigir el cumplimiento de las obligaciones en él consagradas.  Las partes no podrán ceder a cualquier persona natural o jurídica el presente contrato, sin la autorización de la otra parte Para todos los efectos legales se fija como domicilio contractual, la ciudad de <u> '.$nombre_ciudad.' </u>.</p>

	<p style="text-align: justify;">La presente Promesa de Contrato de Compraventa se extiende al día <u> '.$dia.' </u> del mes de <u> '.$mes.' </u> de <u> '.$anio.' </u> .</p>
	';

// output the HTML content
	$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------
// save pdf file
//$pdf->Output('$nombre_archivo', 'I');
	$bodega = "/../bodega/precarga/".$codigo_usuario."/".$nombre_archivo;
	$pdf->Output(__DIR__.$bodega, 'F');

//============================================================+
// END OF FILE
//============================================================+
}
?>