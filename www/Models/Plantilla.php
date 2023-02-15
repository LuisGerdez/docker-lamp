<?php

namespace Models;

require_once __DIR__ . '/../config/APP.php';
class Plantilla
{

	public static function GenerateTemplateCourtsAtKendallDynamicfields(array $fields, int $contCampos)
	{
		$check_box = $fields['check_box'];
		$primeros_11 = $fields['primeros_11'];
		$tablas_secundatias = $fields['tablas_secundatias'];
				
		$html = '<style>
		h1{
			font-size:24px;
			letter-spacing: -3px;
			font-weight:bolder;
		
		}
		li{
			font-size:11px;
		}
		*{
			font-size:12px;
		}
		</style>		
			<table style="width:100%;">
				<tr>
					<td>
					<h4>SPM GROUP, INC.</h4><br>
					A Full Service Community Association Company
					</td>
					<td style="text-align:right;">
					2520 NW 970 Avc., suite 220<br>
					Doral. FL 33172<br>
					Tet: (305) 468-1416<br>
					Fax; (305) 468-1965
					</td>
				</tr>
			</table>		
		<h2 style="text-align:center;text-decoration:underline;font-size:24px;font-weight:bolder;letter-spacing: -2px;">The Courts at Kendall</h2>
		<p style="font-size:14px;">		
		The following applies to any real estate transaction involving the sale, rental or transfer of any
		condominium or home owners association unit.
		</p>

		<h2 style="font-style:italic;text-decoration:underline;font-weight:bolder;font-size:12px;">PLEASE READ CAREFULLY</h2>
		<p style="font-size:14px;">This application will not be processed unless the following items are attached:</p>
		<ol>
		<li><h2 style="text-decoration:underline;font-size:12px;"><label style="text-decoration:underline;">PAYMENTS MADE IN MONEY ORDERS OR CASHIERS CHECKS/NO REFUNDS!</label><br>
		• PAYABLE TO SPMGROUP INC (APPLICATION FEEI<br>
		• EVERY PROSPECTIVE APPLICANT OVER THE AGE OF 18 MUSTPAY A SEPARATE APPLICATION FEEOF S100.00 UNLESS LEGALLY MARRIED. (MUST PROVIDE CERTIFICATE OF MARRIAGE).<br>
		• $50 FOR CONDO DOCUMENTS & BY LAWS<br>
		• $175 TRANSFER FEE PAYABLE TO SPM GROUP FOR PURCHASE ONLY</h2></li>
		<li>Original completed application.</li>
		<li>Copy of Lease Agreement or Sales Contract.</li>
		<li>Copy of I. Ds of all prospective occupants.</li>
		<li>Copy of car registration & picture of vehicle for car decal.</li>
		<li>Copy of Drivers License.</li>
		<li>Original copy of police background check for applicants 18+ (If anything other than NO
		LOCAL RECORD PLEASE BRING ORIGINAL AFFIDAVIT AND DISPOSITION FOR
		EACH CASE).</li>
		<li>Reference from current landlord (IF YOU ARE CURRENTLY RENTING).</li>
		<li> Three (3) personal references</li>
		<li> Employment letter or most recent pay stubs <br> <label style="text-decoration:underline;font-weight:bolder;font-size:12px;">DO NOT PRINT FRONT & BACK. DOUBLE-SIDED COPIES ARE NOT ALLOWED.</label></li>
		</ol>		
		<h2 style="font-size:12px;">Please make sure that before you close on your unit the following information has been requested, if
		applicable.</h2>
		• Estoppel Letter, $350.00 fee Next day Processing Updates over 30 days, Sl 75.00 fee <br>
		• Refinance, $350.00 fee Next Day Processing Condo PUD Letter, $350.00 fee Next day
		processing<br>
		• In order to receive your Certificate of Approval you must have received and reviewed the
		By-Laws of the Association.
		<h2 style="font-size:13px;">ONCE THE SALE IF FINAL IT IS IMPERATIVE THAT YOU OR YOUR CLOSING AGENT
		FORWARDS A COPY OF THE WARRANTY DEED OR SETTLEMENT STATEMENT
		INDICATING DATE OF CLOSING AND NAME (S) OF NEW OWNER (<label style="text-decoration:underline;">Without this
		information we cannot update our system and in most cases no couepe.s will be issued.</label>)</h2>
		<h2>PLEASE BE AWARE THAT THIS PROCESS CAN TAKE UP TO TWENTY FIVE (25)
		BUSINESS DAYS AND NONE OF THE FEES INCURRED ARE REFUNDALBLE.</h2>
		<p style="font-size:14px;">This process may take longer than expected due to the delay form the Board of Directors to give
		an approval OR misinformation. Please be advised that you must request your parking decals at
		the time of the receiver of the Certificate of Approval. Also, please be advised that some
		applications may require an interview with the applicant.</p>
		<br>
		<table>
			<tr>
				<td><h1>SPM GROUP, INC.</h1>
				A Full Service Community Association Management Company</td>
				<td style="text-align:right;">Date:Asswiation<br>
				Name:2520 NW97•<br> Ave„ suite220<br>
				Doral, FL 33172<br>
				Tel: (305) 468-1416<br>
				Fu: (305) 468-1985</td>
			</tr>
		</table>
		<table style="width:650px;">
			<tr>
				<td style="text-align:right;">Date:</td>
				<td rowspan="2" style="border:1px solid black;height:50px;width:200px;">
				<div>

				<b style="text-align:center;font-size:15px;"><u style="padding-top:10px;">Payment Method</u></b>
				</div>
				</td>
			</tr>
			<tr>
				<td>Assoociation Name:</td>
			</tr>
		</table>

		<h2 style="text-align:center;text-decoration:underline;">Application Check List</h2>

		<div style="border:1px solid black;margin:auto;font-size:16px;">
		Please be advised that in order to process your application on a timely manner and within
		the (15) business days from the day it was turned in, the following requirements must be
		met:</div>

		<h2 style="text-align:center;">*This Application is to be filled out by SPM Group. Inc. only*</h2>

		<table style="font-size:15px;">
			<tr>
				<td style="width:40x;">
				<p style="border-bottom:1px solid black;">1) '.$check_box[0].'</p>
				</td>
				<td style="text-align:left;width:600px;">
				A money order or cashiers check payable to SPM Group. Inc. in the amount of $100.000
				for each applicant adult over 18 years of age and S50.00 for Condo
				Documents & By Laws. <b><u>$175 TRANSFER FEE FOR PURCHASE ONLY
				PAYABLE TO SPM GROUP (NO PERSONAL CHECKS ARE ACCEPTED).</u></b>
				</td>
			</tr>
			<tr>
				<td>
				2) '.$check_box[1].'
				</td>
				<td>
				Original completed application
				</td>
			</tr>
			<tr>
				<td>
				3) '.$check_box[2].'
				</td>
				<td>
				Copy of Lease Agreement or Sales Contract
				</td>
			</tr>
			<tr>
				<td>
				4) '.$check_box[3].'
				</td>
				<td>
				Copy of LDs of all proslkctive occupants
				</td>
			</tr>
			<tr>
				<td>
				5) '.$check_box[4].'
				</td>
				<td>
				Copy of car registration & picture of vehicle for car decal
				</td>
			</tr>
			<tr>
				<td>
				6) '.$check_box[5].'
				</td>
				<td>
				Copy of drivers license
				</td>
			</tr>
			<tr>
				<td>
				7) '.$check_box[6].'
				</td>
				<td>
				Original copy of police background check for applicants 18+ (If anything other
				than NO LOCAL RECORD PLEASE BRING ORIGINAL AFFIDAVIT AND
				DISPOSITION FOR EACH CASE).
				</td>
			</tr>
			<tr>
				<td>
				8) '.$check_box[7].'
				</td>
				<td>
				Reference letter from the current landlord. (IF YOU ARE CURRENTLY RENTING).
				</td>
			</tr>
			<tr>
				<td>
				9) '.$check_box[8].'
				</td>
				<td>
				Three (3) references
				</td>
			</tr>
			<tr>
				<td>10) '.$check_box[9].'</td>
				<td>
				Employment letter or most recent pay stubs
				</td>
			</tr>
		</table>
		<p></p>	
		<table style="font-size:16px;">

			<tr>
				<td style="border:1px solid black;">APPLICANTS NAME: '.$primeros_11[0].'</td>
				<td style="border:1px solid black;">EMAIL: '.$primeros_11[1].'</td>
			</tr>

			<tr>
				<td style="border:1px solid black;">CURRENT ADDRESS: '.$primeros_11[2].'</td>
				<td style="border:1px solid black;">PHONE: '.$primeros_11[3].'</td>
			</tr>

			<tr>
				<td style="border:1px solid black;">OWNERS NAME: '.$primeros_11[4].'</td>
				<td style="border:1px solid black;">PHONE: '.$primeros_11[5].'</td>
			</tr>

			<tr>
				<td colspan="2" style="border:1px solid black;">CURRENT ADDRESS: '.$primeros_11[6].'</td>
			</tr>

			<tr>
				<td style="border:1px solid black;">OWNERS EMAIL: '.$primeros_11[7].'</td>
				<td style="border:1px solid black;">EMERGENCY#: '.$primeros_11[8].'</td>
			</tr>

		</table>
		<p></p>
		<table >
			<tr>
			<td><h2>If realtor please provide Phone #</h2></td>
			<td><p style="text-align:center;border-bottom:1px solid black;">'.$primeros_11[9].'</p></td>
			</tr>
			<tr>
			<td colspan="2" style="text-align:center;"><b style="font-size:12px;">* * these requirements are not met the applicatiM1 will returned to you unprocessed***</b></td>
			</tr>
		</table>
		<p></p>
		<table style="font-size:15px;">
			<tr>
			<td><h3>Application and documents were received by:</h3></td>
			<td><p style="text-align:center;border-bottom:1px solid black;">'.$primeros_11[10].'</p></td>
			</tr>
			<tr>
			<td colspan="2" style="text-align:right;"><b style="font-size:12px;">SPM Group, Inc. — Representative</b></td>
			</tr>
		</table>';

		if ($contCampos > 0) {
			for ($i = 0; $i < $contCampos; $i++) {
				
				$arreglo = $tablas_secundatias[$i];

				$html .= '
				<table style="font-size:16px;">

					<tr>
						<td style="border:1px solid black;">APPLICANTS NAME: '.$arreglo[0].'</td>
						<td style="border:1px solid black;">EMAIL: '.$arreglo[1].'</td>
					</tr>

					<tr>
						<td style="border:1px solid black;">CURRENT ADDRESS: '.$arreglo[2].'</td>
						<td style="border:1px solid black;">PHONE: '.$arreglo[3].'</td>
					</tr>

					<tr>
						<td style="border:1px solid black;">OWNERS NAME: '.$arreglo[4].'</td>
						<td style="border:1px solid black;">PHONE: '.$arreglo[5].'</td>
					</tr>

					<tr>
						<td colspan="2" style="border:1px solid black;">CURRENT ADDRESS: '.$arreglo[6].'</td>
					</tr>

					<tr>
						<td style="border:1px solid black;">OWNERS EMAIL: '.$arreglo[7].'</td>
						<td style="border:1px solid black;">EMERGENCY#: '.$arreglo[8].'</td>
					</tr>

				</table>
				<p></p>';
			}
		}

		return $html;
	}

	public static function GenerateTemplateCourtsAtKendall($datos_formularios)
	{

		$datos = $datos_formularios['datos'];
		$check_box = $datos_formularios['check_box'];

		$estilos = "
			<style>
				h1{
					font-size:24px;
					letter-spacing: -3px;
					font-weight:bolder;
				}
			</style>
		";
				
		$datos_principales = '
				
			<table style="width:100%;">
				<tr>
					<td>
					<h1>SPM GROUP, INC.</h1><br>
					A Full Service Community Association Company
					</td>
					<td style="text-align:right;">
					2520 NW 970 Avc., suite 220<br>
					Doral. FL 33172<br>
					Tet: (305) 468-1416<br>
					Fax; (305) 468-1965
					</td>
				</tr>
			</table>		
		<h2 style="text-align:center;text-decoration:underline;font-size:24px;font-weight:bolder;letter-spacing: -2px;">The Courts at Kendall</h2>
		<p style="font-size:14px;">		
		The following applies to any real estate transaction involving the sale, rental or transfer of any
		condominium or home owners association unit.
		</p>

		<h2 style="font-style:italic;text-decoration:underline;font-weight:bolder;">PLEASE READ CAREFULLY</h2>
		<p style="font-size:14px;">This application will not be processed unless the following items are attached:</p>
		<ol>
		<li><h2 style="text-decoration:underline;"><label style="text-decoration:underline;">PAYMENTS MADE IN MONEY ORDERS OR CASHIERS CHECKS/NO REFUNDS!</label><br>
		• PAYABLE TO SPMGROUP INC (APPLICATION FEEI<br>
		• EVERY PROSPECTIVE APPLICANT OVER THE AGE OF 18 MUSTPAY A SEPARATE APPLICATION FEEOF S100.00 UNLESS LEGALLY MARRIED. (MUST PROVIDE CERTIFICATE OF MARRIAGE).<br>
		• $50 FOR CONDO DOCUMENTS & BY LAWS<br>
		• $175 TRANSFER FEE PAYABLE TO SPM GROUP FOR PURCHASE ONLY</h2></li>
		<li>Original completed application.</li>
		<li>Copy of Lease Agreement or Sales Contract.</li>
		<li>Copy of I. Ds of all prospective occupants.</li>
		<li>Copy of car registration & picture of vehicle for car decal.</li>
		<li>Copy of Drivers License.</li>
		<li>Original copy of police background check for applicants 18+ (If anything other than NO
		LOCAL RECORD PLEASE BRING ORIGINAL AFFIDAVIT AND DISPOSITION FOR
		EACH CASE).</li>
		<li>Reference from current landlord (IF YOU ARE CURRENTLY RENTING).</li>
		<li> Three (3) personal references</li>
		<li> Employment letter or most recent pay stubs <br> <label style="text-decoration:underline;font-weight:bolder;font-size:14px;">DO NOT PRINT FRONT & BACK. DOUBLE-SIDED COPIES ARE NOT ALLOWED.</label></li>
		</ol>		
		<h2>Please make sure that before you close on your unit the following information has been requested, if
		applicable.</h2>
		• Estoppel Letter, $350.00 fee Next day Processing Updates over 30 days, Sl 75.00 fee <br>
		• Refinance, $350.00 fee Next Day Processing Condo PUD Letter, $350.00 fee Next day
		processing<br>
		• In order to receive your Certificate of Approval you must have received and reviewed the
		By-Laws of the Association.
		<h2>ONCE THE SALE IF FINAL IT IS IMPERATIVE THAT YOU OR YOUR CLOSING AGENT
		FORWARDS A COPY OF THE WARRANTY DEED OR SETTLEMENT STATEMENT
		INDICATING DATE OF CLOSING AND NAME (S) OF NEW OWNER (<label style="text-decoration:underline;">Without this
		information we cannot update our system and in most cases no couepe.s will be issued.</label>)</h2>
		<h2>PLEASE BE AWARE THAT THIS PROCESS CAN TAKE UP TO TWENTY FIVE (25)
		BUSINESS DAYS AND NONE OF THE FEES INCURRED ARE REFUNDALBLE.</h2>
		<p style="font-size:14px;">This process may take longer than expected due to the delay form the Board of Directors to give
		an approval OR misinformation. Please be advised that you must request your parking decals at
		the time of the receiver of the Certificate of Approval. Also, please be advised that some
		applications may require an interview with the applicant.</p>
		<br>

		
		<table>
			<tr>
				<td><h1>SPM GROUP, INC.</h1>
				A Full Service Community Association Management Company</td>
				<td style="text-align:right;">Date:Asswiation<br>
				Name:2520 NW97•<br> Ave„ suite220<br>
				Doral, FL 33172<br>
				Tel: (305) 468-1416<br>
				Fu: (305) 468-1985</td>
			</tr>
		</table>
		<table style="width:650px;">
			<tr>
				<td style="text-align:right;">Date:</td>
				<td rowspan="2" style="border:1px solid black;height:50px;width:200px;">
				<div>

				<b style="text-align:center;font-size:15px;"><u style="padding-top:10px;">Payment Method</u></b>
				</div>
				</td>
			</tr>
			<tr>
				<td>Assoociation Name:</td>
			</tr>
		</table>

		<h2 style="text-align:center;text-decoration:underline;">Application Check List</h2>

		<div style="border:1px solid black;margin:auto;font-size:16px;">
		Please be advised that in order to process your application on a timely manner and within
		the (15) business days from the day it was turned in, the following requirements must be
		met:</div>

		<h2 style="text-align:center;">*This Application is to be filled out by SPM Group. Inc. only*</h2>

		<table style="font-size:16px;">
			<tr>
				<td style="width:40x;">
				<p style="border-bottom:1px solid black;">1)</p>
				</td>
				<td style="text-align:left;width:600px;">
				A money order or cashiers check payable to SPM Group. Inc. in the amount of $100.000
				for each applicant adult over 18 years of age and S50.00 for Condo
				Documents & By Laws. <b><u>$175 TRANSFER FEE FOR PURCHASE ONLY
				PAYABLE TO SPM GROUP (NO PERSONAL CHECKS ARE ACCEPTED).</u></b>
				</td>
			</tr>
			<tr>
				<td>
				2)
				</td>
				<td>
				Original completed application
				</td>
			</tr>
			<tr>
				<td>
				3)
				</td>
				<td>
				Copy of Lease Agreement or Sales Contract
				</td>
			</tr>
			<tr>
				<td>
				4)
				</td>
				<td>
				Copy of LDs of all proslkctive occupants
				</td>
			</tr>
			<tr>
				<td>
				5)
				</td>
				<td>
				Copy of car registration & picture of vehicle for car decal
				</td>
			</tr>
			<tr>
				<td>
				6)
				</td>
				<td>
				Copy of drivers license
				</td>
			</tr>
			<tr>
				<td>
				7)
				</td>
				<td>
				Original copy of police background check for applicants 18+ (If anything other
				than NO LOCAL RECORD PLEASE BRING ORIGINAL AFFIDAVIT AND
				DISPOSITION FOR EACH CASE).
				</td>
			</tr>
			<tr>
				<td>
				8)
				</td>
				<td>
				Reference letter from the current landlord. (IF YOU ARE CURRENTLY RENTING).
				</td>
			</tr>
			<tr>
				<td>
				9)
				</td>
				<td>
				Three (3) references
				</td>
			</tr>
			<tr>
				<td>10)</td>
				<td>
				Employment letter or most recent pay stubs
				</td>
			</tr>
		</table>
		<p></p>	
		<table style="font-size:16px;">

			<tr>
				<td style="border:1px solid black;">APPLICANTS NAME:</td>
				<td style="border:1px solid black;">EMAIL</td>
			</tr>

			<tr>
				<td style="border:1px solid black;">CURRENT ADDRESS:</td>
				<td style="border:1px solid black;">PHONE:</td>
			</tr>

			<tr>
				<td style="border:1px solid black;">OWNERS NAME:</td>
				<td style="border:1px solid black;">PHONE:</td>
			</tr>

			<tr>
				<td colspan="2" style="border:1px solid black;">CURRENT ADDRESS:</td>
			</tr>

			<tr>
				<td style="border:1px solid black;">OWNERS EMAIL:</td>
				<td style="border:1px solid black;">EMERGENCY#:</td>
			</tr>

		</table>
		<p></p>
		<table >
			<tr>
			<td><h2>If realtor please provide Phone #</h2></td>
			<td><p style="border-bottom:1px solid black;"></p></td>
			</tr>
			<tr>
			<td colspan="2" style="text-align:center;"><b style="font-size:12px;">* * these requirements are not met the applicatiM1 will returned to you unprocessed***</b></td>
			</tr>
		</table>
		<p></p>
		<table style="font-size:15px;">
			<tr>
			<td><h3>Application and documents were received by:</h3></td>
			<td><p style="border-bottom:1px solid black;"></p></td>
			</tr>
			<tr>
			<td colspan="2" style="text-align:right;"><b style="font-size:12px;">SPM Group, Inc. — Representative</b></td>
			</tr>
		</table>';
		
		$formularios = '<table style="width:100%;">
		<tr>
			<td>
			<h1>SPM GROUP, INC.</h1><br>
			A Full Service Community Association Company
			</td>
			<td style="text-align:right;">
			2520 NW 970 Avc., suite 220<br>
			Doral. FL 33172<br>
			Tet: (305) 468-1416<br>
			Fax; (305) 468-1965
			</td>
		</tr>
	</table>
	<h2>
		NOTE: print legibly or type. Answer all questions on this application. If not completed this
		application may returned or not approved.
	</h2>

		<h2 style="text-align:center;font-size:14px;">APPLICATION FOR PURCHASE,RENTAL<br>
		<small>(Please circle one).</small></h2>

		<table style="font-size:9px;">
			<tr>
				<td colspan="2">Community Name:</td>
				<td style="border-bottom:1px solid black;" colspan="2">'.$datos[0].'</td>
				<td >Apt. No.</td>
				<td style="border-bottom:1px solid black;">'.$datos[1].'</td>
				<td >Address:</td>
				<td style="border-bottom:1px solid black;" colspan="2">'.$datos[2].'</td>
			</tr>
			<tr>
			<td >City:</td>
			<td style="border-bottom:1px solid black;" colspan="2">'.$datos[3].'</td>
			<td >Owner Acct. #:</td>
			<td style="border-bottom:1px solid black;" colspan="2">'.$datos[4].'</td>
			<td  colspan="2">Desired date of occupancy:</td>
			<td style="border-bottom:1px solid black;" colspan="2">'.$datos[5].'</td>
			</tr>
		</table>
		<h2>Applicants Name(s):</h2>
		
		<table style="font-size:10px;width:640px;">
			<tr>
			<td>Name</td>
			<td style="border-bottom:1px solid black;">'.$datos[6].'</td>
			<td>DOB:</td>
			<td style="border-bottom:1px solid black;border-right:1px solid black;">'.$datos[7].'</td>
			<td style="border-bottom:1px solid black;border-right:1px solid black;">'.$datos[8].'</td>
			<td style="border-bottom:1px solid black;">'.$datos[9].'</td>
			<td >Soc. Sec#:</td>
			<td style="border-bottom:1px solid black;">'.$datos[10].'</td>
			</tr>
			<tr>
			<td >Spouse/Other</td>
			<td style="border-bottom:1px solid black";>'.$datos[11].'</td>
			<td>DOB:</td>
			<td style="border-bottom:1px solid black;border-right:1px solid black;">'.$datos[12].'</td>
			<td style="border-bottom:1px solid black;border-right:1px solid black;">'.$datos[13].'</td>
			<td style="border-bottom:1px solid black;">'.$datos[14].'</td>
			<td>Soc. Sec. #.</td>
			<td style="border-bottom:1px solid black;">'.$datos[15].'</td>
			</tr>
			<tr>
			<td>Phone Number</td>
			<td style="border-bottom:1px solid black;">'.$datos[16].'</td>
			<td >Email:</td>
			<td colspan="2" style="border-bottom:1px solid black;">'.$datos[17].'</td>
			<td>Other:</td>
			<td colspan="2"style="border-bottom:1px solid black;">'.$datos[18].'</td>
			</tr>
		</table>
<p></p>
<p></p>
		<table style="font-size:12px;">
			<tr>
				<td><b style="font-size:12px;">Marital Status:</b></td>
				<td>Single '.$check_box[0].'</td>
				<td>Divorced '.$check_box[1].'</td>
				<td>Widowed '.$check_box[2].'</td>
				<td>Married '.$check_box[3].'</td>
			</tr>
			<tr>
				<td  colspan="3"><b style="font-size:12px;">Number of adults(18 and over) who will be living in the unit:</b></td>
				<td colspan="2"style="border-bottom:1px solid black;">'.$datos[19].'</td>

			</tr>
		</table>
		<table style="font-size:10px;">
			<tr>
				<td colspan="4">Name and ages of children:</td>
			</tr>
			<tr>
				<td>1.  Name:</td>
				<td style="border-bottom:1px solid black;">'.$datos[20].'</td>
				<td>Age</td>
				<td style="border-bottom:1px solid black;">'.$datos[21].'</td>
			</tr>
			<tr>
				<td>2.  Name:</td>
				<td style="border-bottom:1px solid black;">'.$datos[22].'</td>
				<td>Age</td>
				<td style="border-bottom:1px solid black;">'.$datos[23].'</td>
			</tr>
		</table>
		<p></p>
		<table style="font-size:10px;">
			<tr>
				<td colspan="5">Number of vehicles would be parked at this address:</td>
				<td style="border-bottom:1px solid black;" colspan="3">'.$datos[24].'</td>
			</tr>
			<tr>
				<td >Drivers License No.</td>
				<td style="border-bottom:1px solid black;">'.$datos[25].'</td>
				<td >Drivers License No.</td>
				<td style="border-bottom:1px solid black;">'.$datos[26].'</td>
			</tr>
			<tr>
				<td>Make</td>
				<td style="border-bottom:1px solid black;">'.$datos[27].'</td>
				<td>Model</td>
				<td style="border-bottom:1px solid black;">'.$datos[28].'</td>
				<td>Plate No:</td>
				<td style="border-bottom:1px solid black;">'.$datos[29].'</td>
				<td>State</td>
				<td style="border-bottom:1px solid black;">'.$datos[30].'</td>
			</tr>
			<tr>
				<td>Make</td>
				<td style="border-bottom:1px solid black;">'.$datos[31].'</td>
				<td>Model</td>
				<td style="border-bottom:1px solid black;">'.$datos[32].'</td>
				<td>Plate No:</td>
				<td style="border-bottom:1px solid black;">'.$datos[33].'</td>
				<td>State</td>
				<td style="border-bottom:1px solid black;">'.$datos[34].'</td>
			</tr>
		</table>
		<h2><u><b>RESIDENCE HISTORY</b></u></h2>
		<table style="font-size:10px;">
			<tr>
				<td colspan="2">1 Previous Address:</td>
				<td colspan="2" style="border-bottom:1px solid black;">'.$datos[35].'</td>
				<td colspan="2">How long:</td>
				<td colspan="2" style="border-bottom:1px solid black;">'.$datos[36].'</td>
			</tr>
			<tr>
				<td >City:</td>
				<td style="border-bottom:1px solid black;">'.$datos[37].'</td>
				<td>State:</td>
				<td style="border-bottom:1px solid black;">'.$datos[38].'</td>
				<td >Zip code:</td>
				<td style="border-bottom:1px solid black;">'.$datos[39].'</td>
				<td >Email:</td>
				<td style="border-bottom:1px solid black;">'.$datos[40].'</td>
			</tr>
			<tr>
				<td>Landlord Name:</td>
				<td colspan="3" style="border-bottom:1px solid black;">'.$datos[41].'</td>
				<td >Phone:</td>
				<td colspan="3" style="border-bottom:1px solid black;">'.$datos[42].'</td>
			</tr>
			<tr>
				<td>
					<p>Rental '.$check_box[4].'</p>
				</td>
				<td>
					<p>Owned '.$check_box[5].'</p>
				</td>
			</tr>
		</table>

		<p></p>

		<table style="font-size:10px;">
			<tr>
				<td colspan="2">2 Previous Address:</td>
				<td colspan="2" style="border-bottom:1px solid black;">'.$datos[43].'</td>
				<td colspan="2">How long:</td>
				<td colspan="2" style="border-bottom:1px solid black;">'.$datos[44].'</td>
			</tr>
			<tr>
				<td >City:</td>
				<td style="border-bottom:1px solid black;">'.$datos[45].'</td>
				<td>State:</td>
				<td style="border-bottom:1px solid black;">'.$datos[46].'</td>
				<td >Zip code:</td>
				<td style="border-bottom:1px solid black;">'.$datos[47].'</td>
			</tr>
			<tr>
				<td>Landlord Name:</td>
				<td colspan="3" style="border-bottom:1px solid black;">'.$datos[48].'</td>
				<td >Phone:</td>
				<td colspan="3" style="border-bottom:1px solid black;">'.$datos[49].'</td>
			</tr>
			<tr>
				<td>
					<p>Rental '.$check_box[6].'</p>
				</td>
				<td>
					<p>Owned  '.$check_box[7].'</p>
				</td>
			</tr>
		</table>
		<h2><u><b>EMPLOYMENT REFERENCE</b></u></h2>
		<table >

		<tr>
		<td >1. Employer:</td>
		<td colspan="3" style="border-bottom:1px solid black;">'.$datos[50].'</td>
		<td >Phone No:</td>
		<td colspan="3" style="border-bottom:1px solid black;">'.$datos[51].'</td>
		</tr>

		<tr>
			<td>Address:</td>
			<td style="border-bottom:1px solid black;" colspan="7">'.$datos[52].'</td>
		</tr>
		<tr>
			<td>Position:</td>
			<td style="border-bottom:1px solid black;" colspan="3">'.$datos[53].'</td>
			<td>How long:</td>
			<td style="border-bottom:1px solid black;">'.$datos[54].'</td>
			<td >Mothly income:$</td>
			<td style="border-bottom:1px solid black;">'.$datos[55].'</td>
		</tr>


		</table>
		<p></p>
		<table >

		<tr>
		<td >2. Spouses Employer:</td>
		<td colspan="3" style="border-bottom:1px solid black;">'.$datos[56].'</td>
		<td >Phone No:</td>
		<td colspan="3" style="border-bottom:1px solid black;">'.$datos[57].'</td>
		</tr>

		<tr>
			<td>Address:</td>
			<td style="border-bottom:1px solid black;" colspan="7">'.$datos[58].'</td>
		</tr>
		
		<tr>
			<td>Position:</td>
			<td style="border-bottom:1px solid black;" colspan="3">'.$datos[59].'</td>
			<td>How long:</td>
			<td style="border-bottom:1px solid black;">'.$datos[60].'</td>
			<td>Mothly income:$</td>
			<td style="border-bottom:1px solid black;">'.$datos[61].'</td>
		</tr>
		</table>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>

		<table style="width:100%;font-size:14px;">
		<tr>
			<td>
			<h1>SPM GROUP, INC.</h1><br>
			A Full Service Community Association Company
			</td>
			<td style="text-align:right;">
			2520 NW 970 Avc., suite 220<br>
			Doral. FL 33172<br>
			Tet: (305) 468-1416<br>
			Fax; (305) 468-1965
			</td>
		</tr>
		</table>

		<h2><u><b>BANK REFERENCES</b></u></h2>
		<table>
			<tr>
				<td>1. Bank Name:</td>
				<td style="border-bottom:1px solid black;" >'.$datos[62].'</td>
				<td>Phone No.</td>
				<td style="border-bottom:1px solid black;" >'.$datos[63].'</td>
			</tr>
			<tr>
				<td>Address:</td>
				<td style="border-bottom:1px solid black;">'.$datos[64].'</td>
				<td>Officers Name:</td>
				<td style="border-bottom:1px solid black;">'.$datos[65].'</td>
			</tr>
			<tr>
				<td>Account No:</td>
				<td style="border-bottom:1px solid black;">'.$datos[66].'</td>
				<td>'.$check_box[8].' Checking:  '.$check_box[9].' Savings How long:</td>
				<td style="border-bottom:1px solid black;">'.$datos[67].'</td>
			</tr>

		</table>
		<p></p>
		<table>
			<tr>
				<td>2. Bank Name:</td>
				<td style="border-bottom:1px solid black;" >'.$datos[68].'</td>
				<td>Phone No.</td>
				<td style="border-bottom:1px solid black;" >'.$datos[69].'</td>
			</tr>
			<tr>
				<td>Address:</td>
				<td style="border-bottom:1px solid black;">'.$datos[70].'</td>
				<td>Officers Name:</td>
				<td style="border-bottom:1px solid black;">'.$datos[71].'</td>
			</tr>
			<tr>
				<td>Account No:</td>
				<td style="border-bottom:1px solid black;">'.$datos[72].'</td>
				<td>'.$check_box[10].' Checking:  '.$check_box[11].' Savings How long:</td>
				<td style="border-bottom:1px solid black;">'.$datos[73].'</td>
			</tr>

		</table>
		<p></p>
		<h2><u><b>PERSONAL REFERENCES</b></u></h2>
		
		<table>
			<tr>
				<td>1. Name:</td>
				<td colspan="3" style="border-bottom:1px solid black;">'.$datos[74].'</td>
				<td>Phone No.</td>
				<td colspan="3" style="border-bottom:1px solid black;">'.$datos[75].'</td>
			</tr>
			<tr>
				<td>Address:</td>
				<td style="border-bottom:1px solid black;">'.$datos[76].'</td>
				<td>City:</td>
				<td  style="border-bottom:1px solid black;">'.$datos[77].'</td>
				<td>State:</td>
				<td  style="border-bottom:1px solid black;">'.$datos[78].'</td>
				<td>Zip code:</td>
				<td  style="border-bottom:1px solid black;">'.$datos[79].'</td>
			</tr>
		</table>
		<p></p>
		<table>
			<tr>
				<td>2. Name:</td>
				<td colspan="3" style="border-bottom:1px solid black;">'.$datos[80].'</td>
				<td>Phone No.</td>
				<td colspan="3" style="border-bottom:1px solid black;">'.$datos[81].'</td>
			</tr>
			<tr>
				<td>Address:</td>
				<td style="border-bottom:1px solid black;">'.$datos[82].'</td>
				<td>City:</td>
				<td  style="border-bottom:1px solid black;">'.$datos[83].'</td>
				<td>State:</td>
				<td  style="border-bottom:1px solid black;">'.$datos[84].'</td>
				<td>Zip code:</td>
				<td  style="border-bottom:1px solid black;">'.$datos[85].'</td>
			</tr>
		</table>
		<p></p>
		<table style="font-size:12px;">
			<tr>
				<td>Have you ever applied in SPM Group, Inc. before? if yes, when?</td>
				<td style="border-bottom:1px solid black;">'.$datos[86].'</td>
			</tr>
			<tr>
				<td>Have you ever had any legal conflict with a landlord? If yes, explain.</td>
				<td style="border-bottom:1px solid black;">'.$datos[87].'</td>			
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;border-bottom:1px solid black;"></td>
			</tr>
			<tr>
				<td>Have you ever been evicted from a previous residence?</td>
				<td style="border-bottom:1px solid black;">'.$datos[88].'</td>
			</tr>
		</table>
		<p style="text-align:justify;font-size:14px;">
		This application is subject to acceptance by the Owner/Association/Landlord. The applicant
		understands that the Owner/Association/Landlord will 
		authorize SPM group Inc, to act as their agent to 
		investigate the information supplied to the applicant on this application from SPM Group, Inc. (and the Owner/Association/Landlord) will not
		be liable or responsible for any inaccurate infromation in their report, caused by illebibility or wring
		information on this application, given by the applicant. the applicant agrees, not hold SPM Group, Inc and/or the
		Owner/Association/Landlord reliable for the report received by their invertigators, All reports will be obtained
		under the regulations of the FCRA-Fair Credit Reporting Act. The applicant agrees to sign the Authorization
		Form, needed by SPM Group, Inc. to receive the requested information concerning the banking, emploument,
		credit and residential information in reference to this application. SPM Group, Inc. may investigate all given
		references as deemed necessary and may also require a credit report trhrough a credit agency. All investigation
		reports will be handled confidentially and only the results will be reported to the Owner/Association/Landlord or
		Authorized person. By signing this application the application authorizes the Owner/Association/Landlord and 
		their agent SPM Grpup, Inc. To investigate the information supplied
		</p>
		<br>
		Attached is the signed Authorization Form for release of the information.
		<br>
		<p></p>
		<table>
			<tr>
				<td>Signature:</td>
				<td style="border-bottom:1px solid black;">'.$datos[89].'</td>
				<td style="text-align:right;">Date:</td>
				<td style="border-bottom:1px solid black;">'.$datos[90].'</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align:center;">Primary applicant</td>
			</tr>
		</table>
		<table>
			<tr>
				<td>Signature:</td>
				<td style="border-bottom:1px solid black;">'.$datos[91].'</td>
				<td style="text-align:right;">Date:</td>
				<td style="border-bottom:1px solid black;">'.$datos[92].'</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align:center;">Secondary Application/Spouse</td>
			</tr>
		</table>

		<p></p>
		<table style="width:100%;">
		<tr>
			<td>
			<h1>SPM GROUP, INC.</h1><br>
			A Full Service Community Association Company
			</td>
			<td style="text-align:right;">
			2520 NW 970 Avc., suite 220<br>
			Doral. FL 33172<br>
			Tet: (305) 468-1416<br>
			Fax; (305) 468-1965
			</td>
		</tr>
		</table>

		<h2><b><u>APPLICANT</u></b></h2>

		<p>
		This authorization form will be used only to obtain and verify information with your eployers, banks and
		financial institutions and credit organizations, wich require your signature and name printed. You gave this
		information in connection with your purchase or lease agreement attached.		
		</p>
			<h2 style="text-align:center;">AUTHORIZATION TO RELEASE INFORMATION ABOUT MY:<br>EMPLOYEMENT, BANKING, CREDIT & RESIDENCE.</h2>
		<p style="font-size:14px;">
			The requested information will be used in reference to my purchase/rental/lease application. I hereby authorize
			you to release any and all information concerning employment, banking, credit, and residence and give this
			information to:
		</p>
		<h3 style="text-align:center;"><b>SPM Group, Inc</b></h3>
		<p style="font-size:14px;">
		I hereby authorize SPM Group, Inc. to instigate all statements contained in my applicantions as may be necessary. I
		understand that I hereby waive any priviliges I may have regarding the requested information to release it to the
		above named party.
		<br>
		A copy of this form may be used in licu of the original.
		<br>
		<p></p>
		<table>
				<tr>
					<td colspan="4">Sincerely,</td>
				</tr>	
				<tr>
					<td>Signature</td>
					<td  style="border-bottom:1px solid black;">'.$datos[93].'</td>
					<td style="text-align:right;">Date:</td>
					<td  style="border-bottom:1px solid black;">'.$datos[94].'</td>
				</tr>
				<tr>
					<td>Name (Please Print):</td>
					<td colspan="4" style="border-bottom:1px solid black;" >'.$datos[95].'</td>
				</tr>
		</table>

		<p style="border-bottom:2px solid black;"></p>

		<h2 style="text-align:center;">AUTHORIZATION TO RELEASE INFORMATION ABOUT MY:<br>EMPLOYEMENT, BANKING, CREDIT & RESIDENCE.</h2>
		<p>
			The requested information will be used in reference to my purchase/rental/lease application. I hereby authorize
			you to release any and all information concerning employment, banking, credit, and residence and give this
			information to:
		</p>
		<h3 style="text-align:center;"><b>SPM Group, Inc</b></h3>
		<p>
		I hereby authorize SPM Group, Inc. to instigate all statements contained in my applicantions as may be necessary. I
		understand that I hereby waive any priviliges I may have regarding the requested information to release it to the
		above named party.
		<br>
		A copy of this form may be used in licu of the original.
		<br>
		<p></p>
		<table>
				<tr>
					<td colspan="4">Sincerely,</td>
				</tr>	
				<tr>
					<td>Signature</td>
					<td  style="border-bottom:1px solid black;">'.$datos[96].'</td>
					<td style="text-align:right;">Date:</td>
					<td  style="border-bottom:1px solid black;">'.$datos[97].'</td>
				</tr>
				<tr>
					<td>Name (Please Print):</td>
					<td colspan="4" style="border-bottom:1px solid black;" >'.$datos[98].'</td>
				</tr>
		</table>
		<p></p>
		<table style="width:100%;">
		<tr>
			<td>
			<h1>SPM GROUP, INC.</h1><br>
			A Full Service Community Association Company
			</td>
			<td style="text-align:right;">
			2520 NW 970 Avc., suite 220<br>
			Doral. FL 33172<br>
			Tet: (305) 468-1416<br>
			Fax; (305) 468-1965
			</td>
		</tr>
		</table>
		<p></p>
		<p></p>
		<h3 style="text-align:center;font-size:18px;"><u>WE WIL NOT ACCEPT INCOMPLETE APPLICATIONS!!</u></h3>		
		<p></p>
		<h2 style="text-align:center;font-size:20px;"><u>GUEST PARKING WITH PERMIT ONLY FOR UP TO 24 HOURS</u></h2>		
		<p></p>
		
		<h3 style="text-align:justify;font-size:16px;">OWNERS ARE ALLOWED 1 PET PER UNIT. THE PET MUST BE LESS THAN 20 POUNDS RENTERS ARE NOT ALLOWED PETS IN UNITS</h3>
		<br>
		<p></p>

		<h3 style="text-align:justify;font-size:16px;">PLEASE DO NOT CALL THE MANAGEMENT COMPANY PRIOR TO 15 BUSINESS DAYS.
		IF THE MANAGEMENT COMPANY NEEDS MORE INFORMATION, THE UNIT OR
		TENANT WILL BE CONTACTED</h3>
		<br>
		<p></p>

		<h3 style="text-align:center;font-size:16px;">NO BARBEQUE PERMITTED</h3><br>
		<h3 style="text-align:center;font-size:16px;">MOVING HOURS MONDAY - FRIDAY 10AM TO 5PM</h3><br>
		<h3 style="text-align:center;font-size:16px;">SATURDAY 9AM - 4PM</h3><br>
		<h3 style="text-align:center;font-size:16px;">NO MOVING IN ON SUNDAYS</h3>
		<p></p>
		
		<h4 style="text-align:left;font-size:16px;">COMMERCIAL VEHICLES. COMMERCIAL VANS, LARGE PICK-UP TRUCKS ARE NOT PERMITTED IN THE COMMUNITY.</h4>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>		
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<h3 style="text-align:center;font-size:26px;"><u>Violation Inspections:</u></h3>
		<p></p>

		<p style="font-size:28px;">Review the Rules and Regulations so you know
		everything that we do not allow:</p>
	<ul style="font-size:22px;text-align:justify;">
		<li>For the general things like antennas, the CANNOT BE DRILLED or AFFIXED annywhere outside their unit.</li>
		<li>They cannot open any holes outside in their balconny, back porch, front porch or anywhere that isnt the insides of their units. if it
		is in the 1<sup>st</sup> floor they must have the antenna drilled on top of cement bricks.</li>
		<li>They cannot have anyh decorations, wind chimes, or objects hanging from their balcony except the
		flag respectufully displayed (look at Rules and Regulations for specific regulations regarding the flag)</li>
		<li><b>Absolutely no BBQs! No Bikes, exercise equipement, storage... etc! Only their patio furniture and plants.</b></li>
		<li><b>No animal cages or animals can be kept outside.</b></li>
	</ul>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<h3 style="text-align:center;font-size:24px;"><u>THE COURTS AT KENDALL CONDOMINIUM ASSN.<br>
	PARKING RULES & REGULATIONS</u></h3>
	<ol style="font-size:20px;text-align:justify;">
	<li>Residents shall only use the parking space assigned to their unit. All
	other vehicles MUST be parked in the designated guest parking spaces. Only 1 yellow visitor hanger per Unit NO EXCEPTIONS.</li>
	<li>All cars must be parked facing forward. (Head only)</li>
	<li>Guest Parking can be used by the residents for 24 hours ONLY and as
	long as they have their Visitor Hanger in their rearview mirror with
	the Unit Number facing out. All others will be towed at owners
	expense. NO EXCEPTIONS</li>
	<li>Any vehicles parked in an area not assigned for parking will be
	towed, immediately, without warning at owners expense. For
	example, Fire lanes, sidewalks, median & grass.</li>
	<li>All parking spaces shall be limited to passenger automobiles, station
	wagons, mini-vans and small trucks under two ton in weight. No boats
	or wave runners are permitted. Motorcycles ARE ONLY permitted in the resident assigned parking  space.
	</li>
	<li>No commercial vehicles are allowed in the property Saturday and Sunday only Monday trough Friday from 10am - 5pm</li>
	<li>No vehicle which can not operate on its own power or which has an expired license plate shall remain in the Condominium property.</li>
	<li>No doudble parking permitted, nor vehicles occupying  more than one space. Violators will be towed at owners expense without warning.
	</li>
	<li>No repair of vehicles shall be made on condominium. This includes changing of oil. Replacement of a flat tire and batteries is permitted.</li>
	<li>No car wash allowed</li>
	</ol>
	<h3 style="text-align:center;font-size:16px;"><b>ALL VEHICLES THAT DO NOT FOLLOW ABOVE MENTIONED RULES WILL BE<br> TOWED AT OWNERS EXPENSE.</b></h3>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<h3 style="text-align:center;font-size:20px;"><u>PARKING ENFORCEMENT PROCEDURES</u></h3>
	<ol style="font-size:18px;text-align:justify;">
	<li>All residents have on assigned parking space per unit, this space is numbered</li>
	<li>Residents shall use ONLY th parking space (white bumper) assigned to their unit, All other vehicles MUST parked iin the designated guest parking spaces
	(yellow bumper). All cars must be park facing forward.</li>
	<li>Guest parking can be use by the residents for 24 hours only, and guest until may park their vehicle until 11:00 PM</li>
	<li>Residents can use the guest parking as long as they have the THE COURTS decal properly affix to their car or they have the visitor hanging permit in the rear
	view mirror. All others will be towed at owners expense, no exceptions.</li>
	<li>Any vehicles parked in an area  not assigned for parking will be towe, immediately, without warning at owners expense, Example Fire lanes, sidewalks, median, & grass.
	</li>
	<li>All parking spaces shall be limited to passenger automobiles, station wagons, vans, small trucks, under two ton in weight. No boats or wave runners are permitted. Motorcycles are ONLY permitted to be parked in the resident assigned parking space. Commercial vehicles are not allowed in the property after 6:00 pm or before 8:00 am</li>
	<li>No vehicle wich can not operate on its own power or which has an expired
	license plate shall remain in the Confominium property</li>
	<li>No double parking parking permitted, novehicles occupying more than one space.
	Violators will be towed at owners expense without previous warning</li>
	<li>Any vehicles parled in a handicapped space without the appropriate permit wiil be towed at owners expense without warning</li>
	<li>No repair of vehicles shall be made on condominium. This includes changing of oil. Replacement of a flat tire and bateries is permitted. No car wash allowed.</li>
	<li><u>Failure to not follow thse Parking Rules and Regulations will result in your vehicle being towed from the community at yours on expense</u></li>
	</ol>	

	<h3 style="text-align:center;"><u>REGLAMENTACIONES DE ESTACIONAMIENTO</u></h3>
	<br>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<h2 style="text-align:left;font-size:22px;"><u>IMPORTANT INFORMATION:</u></h2>
	<p>Dear Residents, </p>
	<p style="font-size:20px;">
	To improve the Security at the Security at the community; the Board of
	Directors has issued a cell phone to the Security at the community; the Board of Directors has issued handy and use it for any situation dealing
	with Security within the community. We are confident that this new measure will be helpful to the residents and a benefit to
	the community.
	</p>
	<p style="font-size:18px;">SECURITY GUARDS CELL PHONE: 786-286-4009</p><br>
	<p>Sincerely,<br>
	The Board of Directors</p>
	<p style="border-bottom:1px solid black;"></p>
	<h2 style="font-size:22px;"><u>INFORMACION IMPORTANTE:</u></h2><br>
	<p  style="font-size:20px;">Estimados Residentes,<br>
	Para mejorar la seguridad de la comunidad, la junta directiva le ha asinado un telèfono a la seguridad- Por favor tengalo a mano y uselo para cualquier asunto relacionado con la seguridad de esta asociaciòn. Esperamos que esta nueva
	medida sea de ayuda y beneficio a toda la comunidad.</p>
	<p>Atentamente,<br>
	La junta Directiva<br>
	TELEFONO DE SEGURIDAD: 786-286-4009</p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<div style="font-size:24px;">
	<h2 style="text-align:center;"><u>In case of these situations occurring please call the corresponding vendor repair:</u></h2>
	<p style="text-align:center;"><b><u>Locksmith:</u></b> Precise lock Solutions -(786)2732441</p>
	<h2 style="text-align:center;"><u>Electronic Gate/Entrace/Gym Door/Tele-entry:</u>jj</h2>
	<p style="text-align:center;">Solutions - Ernesto Jaimes (305)7882128</p>
	<p style="text-align:center;"><b><u>Waste Connections (Trash):</u></b>Gabriel lalinde -<br>(305)3457861 (our sales agent) For late pickup or<br>
	schedules call (305)6383800<br><u><b>Global Pest Control (lanscapers):</b></u>Ivan Perez (305)5256256<br>
	<u><b>light Post:</b></u> Jesus Martinez (786)3516096<br>
	<u><b>Plumber:</b></u> Lescano (786)2511610<br>
	<h2 style="text-align:center;"><u>Roofer for leaks that belong to The Courts at Kendall </u></h2> <b style="font-size:16px;">Condo:</b>Design Builders - Michael Acosta (786)4266238<br>
	<b style="font-size:16px;"><u>Pools:</u></b> Island Pools Inc - Victor Felandro (786)34395575
	<p>
	</div>';
		
		$url= $_SERVER["REQUEST_URI"];
		$ruta = substr($url, strripos($url, '/') + 1);

		if($ruta == 'ControllerVista.php') return $estilos.$datos_principales.$formularios;
		else return $estilos.$formularios;
	}

	public static function getRegisteredUserEmail(string $nombre_usuario, string $apellido_usuario, string $enlace_verificacion, string $mensaje = null, string $mensaje_otp = null): string
	{
		$correo_registrado = '
		<!DOCTYPE html>
		<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width,initial-scale=1">
			<meta name="x-apple-disable-message-reformatting">
			<title></title>
			<!--[if mso]>
			<noscript>
				<xml>
					<o:OfficeDocumentSettings>
						<o:PixelsPerInch>96</o:PixelsPerInch>
					</o:OfficeDocumentSettings>
				</xml>
			</noscript>
			<![endif]-->
			<style>
				table, td, div, h1, p {font-family: Vistol Sans;}
			</>
		</head>
		<body style="margin:0;padding:0;">
			<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
				<tr>
					<td align="center" style="padding:0;">
						<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;background: #006CD8;">
							<tr>
								<td align="center" style="padding:40px 0 20px 0;">
									<img src="https://i.postimg.cc/rFM9NN77/logo-firmadoc-header-white.png" alt="" width="300" style="height:auto;display:block;" />
								</td>
							</tr>
							<tr>
								<td align="center"style="padding:30px 0 20px 0;">
									<img src="https://i.postimg.cc/W36gsx2r/h2-preview-rev-1.png" alt="" width="300" style="height:auto;display:block;" />
								</td>
							</tr>
							<tr>
								<td style="padding:30px 30px 42px 30px;">
									<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
										<tr>
										<td style="padding:0 0 36px 0;color:#153643;">
										<h1 style="color:#ffffff;text-align:center;font-size:25px;margin:0 0 20px 0;font-family:Vistol Sans;">' . utf8_decode($nombre_usuario) . ' ' . utf8_decode($apellido_usuario) . '</h1>
										<p style="text-align:center;margin:0 0 12px 0;font-size:20px;line-height:24px;font-family:Vistol Sans;color:#ffffff;">Le ha enviado un documento para que revise y firme</p>
										<p style="text-align:justify;margin:0 0 12px 0;font-size:20px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: center;">' . utf8_decode($mensaje) . '</p>
										' . $mensaje_otp . '
										</h1></p><p style="text-align:justify;margin:0 0 12px 0;font-size:20px;line-height:24px;font-family:Vistol Sans;color:#ffffff;">
										</p>

										<p style=" text-align:center;margin:30px 0 15px 0;font-size:20px;line-height:24px;font-family:Vistol Sans;"><a href="' . $enlace_verificacion . '" style="text-decoration:underline;background:#ffffff;padding: 20px 60px 20px;text-align:center;border-radius: 5px;
										border-color: #FFFFFF; text-decoration:none; color:black;">Firmar</a></p>
									</td>
										</tr>
										<tr>
											<td style="padding:0;">
												<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
													<tr>
														<td style="width:260px;padding:0;vertical-align:top;color:#153643;">
															<p style="margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff;"><img src="https://assets.codepen.io/210284/left.gif" alt="" width="260" style="height:auto;display:block;" /></p>
															<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;"><h3 style="color:#ffffff;">REQUISITOS PARA REGISTRO</h3></p>
															<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">1. Contar con conexion a internet.</p>
															<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">2. Contar con un dispositivo con Camara. </p>
															<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">3. Tener su cedula de identidad a la mano si va a firmar por primera vez.</p>
															<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">4. En caso de realizar el registro por primera vez desde un PC, debe tener cargada la imagen frontal y reversa de su cedula. En caso de realizar el proceso desde un movil, podra tomar la fotografía de su cedula en el mismo momento de registro.</p>
															<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">5. Se recomienda navegador Google Chrome.</p>
														</td>
														<td style="width:20px;padding:0;font-size:0;line-height:0;">&nbsp;</td>
														<td style="width:260px;padding:0;vertical-align:top;color:#153643;">
															<p style="margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff;"><img src="https://assets.codepen.io/210284/right.gif" alt="" width="260" style="height:auto;display:block;" /></p>
															<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;"><h3 style="color:#ffffff;">TOMAR EN CUENTA LAS SIGUIENTES RECOMENDACIONES AL FIRMAR UN DOCUMENTO:</h3></p>
															<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">1. No salir de la pantalla mientras realiza el proceso de registro o verificacion.</p>
															<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">2. Realizar el proceso de registro facial en un sitio iluminado.</p>
															<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Vistol Sans;color:#ffffff; text-align: justify;">3. Al momento de tomar la foto de su cedula, tratar en lo posible que ninguna parte de la imagen tenga demasiada iluminacion o partes borrosas, en especial la fotografia del rostro.</p>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style="padding:30px;background:#555555;">
									<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
										<tr>
											<td style="padding:0;width:50%;" align="left">
												<p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
													&reg; Suntic S.A.S, Cali 2022<br/>
												</p>
											</td>
											<td style="padding:0;width:50%;" align="right">
												<table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
													<tr>
														<td style="padding:0 0 0 10px;width:38px;">
															<a href="https://firmadoc.co/" style="color:#ffffff;"><img src="https://i.postimg.cc/mg1MzdWX/Icono-Firmadoc.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
														</td>
														<td style="padding:0 0 0 10px;width:38px;">
															<a href="https://portal-id.com/" style="color:#ffffff;"><img src="https://i.postimg.cc/fTnkqMGK/Icono-Portal-id.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</body>
		</html>';

		return $correo_registrado;
	}

	public static function getUnregisteredUserEmail()
	{
	}

	public static function getSignedEmailTemplate(string $dominio, string $nombre_archivo, string $nombre_certificado, string $remitente = '')
	{
		$correo = '
		<!DOCTYPE html>
		<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
			<head>
				<meta charset="UTF-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<meta name="x-apple-disable-message-reformatting">
				<title></title>
                <!--[if mso]>
                <noscript>
                    <xml>
                        <o:OfficeDocumentSettings>
                            <o:PixelsPerInch>96</o:PixelsPerInch>
                        </o:OfficeDocumentSettings>
                    </xml>
                </noscript>
                <![endif]-->
				<style>
					/* Fuentes */
					@font-face { font-family: "Poppins-Light"; src: url("./Poppins-Light.ttf"); }
		
					/* Estilos principales */
					* { padding: 0; margin: 0; box-sizing: border-box; }
		
					html, body { height: 100%; width: 100%; font-family: "Poppins-Light"; }
		
					/* Estilos del fondo */
					.background { background-color: #E6E6E6; height: 100%; width: 100%; /* background-color: #f0f0f0; */ }
		
					/* Estilos del logo */
					.logo-container { margin: auto; text-align: center; padding-top: 10px; width: 500px; }
		
					.logo { width: 300px; }
		
					/* Estilos del contenedor principal */
					.content { margin: auto; background-color: #FFF; padding: 20px; width: 450px; }
		
					/* Encabezado del correo */
					.header { position: relative; background-image: url("https://i.postimg.cc/8C8G8mtv/fondo.png"); border-radius: 2px; background-repeat: no-repeat; background-size: cover; }
		
					.header h1 { text-transform: capitalize; text-align: center; padding: 20px 0px 10px 0px; color: #FFF; font-size: 1.2rem; }
		
					.header p { color: #FFF; text-align: center; padding-bottom: 40px; }
		
					.header .firma { position: absolute; top: 0; right: 0; height: 145px; }
		
					.header .documento { font-style: italic; }
		
					/* Cuerpo del correo */
					.body { text-align: center; padding: 30px 0px; font-size: .9rem; font-weight: bold; }
											
					/* Sombra */
					.shadow { margin: auto; height: 5px; width: 35%; margin-top: 30px; border-radius: 50%; background-color: #E6E6E6; filter: blur(2px); }
		
					/* Pie de correo */
					.footer { margin: auto; background-color: #006CD8; width: 450px; padding: 10px; color: #FFF; }
		
					.footer .item { font-size: 0.8rem; font-style: italic; }
		
					.footer li { margin-left: 30px; }
		
					.footer h4 { text-align: center; }
				</style>
			</head>
			<body>
				<main class="background" style="background-color: #E6E6E6; height: 100%; width: 100%;">
					<div class="logo-container">
						<img src="https://i.postimg.cc/rsLhZG3j/logo.png" class="logo">
					</div>

					<section class="content">
						<div class="header">
							<h1 style="text-align:center;">'. $remitente .'</h1>
							<p>
								Le ha enviado un documento
								<br>
								<span class="documento">('.$nombre_archivo.')</span>								
							</p>
						</div>
						
						<div class="body">
							<div>
								<p style="font-style: normal;">
									Descarga una copia del documento firmado
									<a style="color: #0085f2;" href="' . $dominio . 'descargar/index.php?nombre_archivo=' . $nombre_archivo . '&key_path='.CLIENT.'/firmados/'. '">aqui</a>
								</p>
								<p style="font-style: normal;">
									Descarga una copia del certificado de firma
									<a style="color: #0085f2;" href="' . $dominio . 'descargar/index.php?nombre_archivo=' . $nombre_certificado . '&key_path='.CLIENT.'/certificados/'. '">aqui</a>
								</p>
							</div>
							<div class="shadow"></div>	
						</div>												
					</section>

					<div class="footer">
						<h4>Para validar el documento puede dar clic <a href="http://firmadoc-corp-public-alb-2125005779.us-east-1.elb.amazonaws.com/firmadoc_corp_suntic/validardocumento/">aqui<a/></h5>
					</div>
				</main>
			</body>
		</html>';
		return $correo;
	}

	public static function getEnrollCertificateTemplate(array $datos, string $img=null, string $img2=null): string
	{
		include '../conexion.php';

		$sql = "SELECT usu_rutafi FROM usuario WHERE usu_id = {$_SESSION['codigo_usuario']}";
		$result = $link->query($sql);
		$firma = $result->fetch_assoc()["usu_rutafi"];
		$contenido = '';

		if ($firma != null) {

			$S3 = new Bucket();
			$hash = $S3->s3DownloadObjectB64("firma_{$_SESSION['cedula_usuario']}.png", "suntic/images/{$_SESSION['cedula_usuario']}/");
			$imagen = "data:image/png;base64," . $hash;
			$contenido = "<td><img style='width: 100px;height:60px;' src='$imagen'></td>";
		} else $contenido = "<td style='font-family: Tangarine; font-size: 1.3rem; padding-top: 10px;'><p>{$_SESSION['nombre_usuario']} <br> {$_SESSION['apellido_usuario']}</p></td>";

		$plantilla = "";
		$plantilla = "<!DOCTYPE html>
    	<html lang='es'>
    
    	 <head>
    	    <meta charset='UTF-8' />
    	    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    	    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    	    <link rel='stylesheet' href='style.css' />
    	</head>
		
    	<body>  
    	    <div class='container_info'>
    	        <div class='information'>
				<h2 class='title-head' style='color:black;'>CERTIFICADO DE REGISTRO</h2>
    	            <table class='table_basic'>
    	                <tr>
    	                    <th class='title' colspan='2'>
    	                        <h3>INFORMACION BASICA</h3>
    	                    </th>
    	                </tr>
    	                <tr>
    	                    <th class='subtitles'>Registro:</th>
    	                    <td class='bolders'><b>" . $datos['Record'] . "</b></td>
							</tr>
    	                <tr>
    	                    <th class='subtitles'>Fecha Registro:</th>
    	                    <td class='bolders'><b>" . $datos['StartingDate'] . "</b></td>
    	                </tr>
    	                <tr>
    	                    <th class='subtitles'>Fecha Creación:</th>
    	                    <td class='bolders'><b>" . $datos['CreationDate'] . "</b></td>
    	                </tr>
    	                <tr>
    	                    <th class='subtitles'>IP:</th>
    	                    <td class='bolders'><b>" . $datos['CreationIP'] . "</b></td>
    	                </tr>
    	            </table>
    	        </div>
    	        <div class='container_data'>
    	            <table class='table_personal'>
    	                <tr>
    	                    <th  class='title' colspan='4'>
    	                        <h3>INFORMACION PERSONAL</h3>
    	                    </th>
    	                </tr>
    	                <tr>
    	                    <th>Cédula:</th>
    	                    <td>" . $datos['IdNumber'] . "</td>
    	                    <th>Fecha Expedición:</th>
    	                    <td style='padding-left:10px;'>" . $datos['IssueDate'] . "</td>
    	                </tr>
    	                <tr>
    	                    <th>Primer Nombre:</th>
    	                    <td>" . $datos['FirstName'] . "</td>
    	                    <th>Segundo Nombre:</th>
    	                    <td>" . $datos['SecondName'] . "</td>
    	                </tr>
    	                <tr>
    	                    <th>Primer Apellido:</th>
    	                    <td>" . $datos['FirstSurname'] . "</td>
    	                    <th>Segundo Apellido:</th>
    	                    <td>" . $datos['SecondSurname'] . "</td>
    	                </tr>
    	                <tr>
    	                    <th>Género:</th>
    	                    <td>" . $datos['Gender'] . "</td>
    	                    <th>Fecha Nacimiento:</th>
    	                    <td style='padding-left:10px;'>" . $datos['BirthDate'] . "</td>
    	                </tr>
    	                <tr>
    	                    <th>Lugar Nacimiento:</th>
    	                    <td>" . $datos['PlaceBirth'] . "</td>
    	                    <th>Tipo Transacción:</th>
    	                    <td>" . $datos['TransactionTypeName'] . "</td>
    	                </tr>
    	            </table>
    	        </div>
    	        <div class='container_result'>
    	            <table class='table_result'>
    	                <tr>
    	                    <th colspan='3' class='title'>
    	                        <h3>RESULTADO</h3>
    	                    </th>
    	                </tr>

    	                <tr>
    	                    <th>Estado:</th>
    	                    <td>2 Proceso satisfactorio:</td>
    	                </tr>
		
    	                <tr>
    	                    <th class='top' rowspan='7'>Respuesta ANI:</th>
    	                    <td><b>No:</b></td>
							<td>" . $datos['IdNumber'] . "</td>
						</tr>

						<tr>
							<td><b>FirstSurname:</b></td>
							<td>" . $datos['FirstSurname'] . "</td>
						</tr>

						<tr>
							<td><b>SecondSurname:</b></td>
							<td>" . $datos['SecondSurname'] . "</td>
						</tr>

                        <tr>
							<td><b>FirstName:</b></td>
							<td>" . $datos['FirstName'] . "</td>
						</tr>
						<tr>
							<td><b>SecondName:</b></td>
							<td>" . $datos['SecondName'] . "</td>
						</tr>
		                
						<tr>
							<td> <b>ExpeditionMunicipality:</b></td>
							<td>" . $datos['PlaceBirth'] . "</td>
						</tr>
						<tr >
							<td style='padding-bottom:20px;'><b>ExpeditionDate:</b></td>
							<td style='padding-bottom:20px;'>" . $datos['IssueDate'] . "</td>
						</tr>          
    	                <tr >
    	                    <th class='top border-top'>El usuario aceptó:</th>
    	                    <td class='border-top' colspan='2'>
    	                    <p><b>Terminos y condiciones:</b> (Anéxo 1) <img src='" . __DIR__ . "/../perfil/img/controlar.png'></p>
    	                    <p><b>Acuerdo de comunicacion:</b>  (Anéxo 2) <img src='" . __DIR__ . "/../perfil/img/controlar.png'></p>
    	                    <p><b>Politica de tratamiento de datos:</b> (Anéxo 3) <img src='" . __DIR__ . "/../perfil/img/controlar.png'></p>
    	                    <p><b>Firma electronica de documento:</b> (Anéxo 4) <img src='" . __DIR__ . "/../perfil/img/controlar.png'></p>
    	                    </td>
    	                </tr>
    	            </table>
    	        </div>
    	    </div>
    	    <br>
    	<h1 id='title'>TÉRMINOS Y CONDICIONES <br>(ANÉXO 1).</h1>

    	<p style='padding:10xp 90px 0px 80px;'><b>AVISO IMPORTANTE:</b> estos términos y condiciones contienen una disposición de arbitraje vinculante y una renuncia a juicios por jurado y demandas colectivas que rigen las disputas que surjan del uso de los servicios de firmadoc-corp. afecta sus derechos legales según se detalla en la sección de arbitraje obligatorio y renuncia a la demanda colectiva a continuación. por favor lea detenidamente.<br><br>
    	Estos términos y condiciones de los servicios de firmadoc-corp ('términos') rigen el acceso y el uso de los sitios web y servicios de firmadoc-corp ('firmadoc-corp', 'nosotros' o 'nos') (en conjunto, el 'sitio') por parte de los visitantes del sitio ('visitantes del sitio') y por personas o entidades que compran servicios ('servicios de firmadoc-corp') o crean una cuenta ('cuenta') y sus usuarios autorizados (colectivamente, 'clientes' ). al utilizar el sitio o cualquier servicio de firmadoc-corp, usted, como visitante del sitio o cliente, acepta estos términos (ya sea en su nombre o en una entidad legal que represente). un 'usuario autorizado' de un cliente es una persona física individual, ya sea un empleado, socio comercial, contratista o agente de un cliente que está registrado o autorizado por el cliente para utilizar los servicios de firmadoc-corp sujeto a estos términos y hasta un máximo. número de usuarios o usos especificados en el momento de la compra.<br><br>
    	Si usted es un cliente y usted o su organización están sujetos a un acuerdo de servicios maestro con firmadoc-corp ('términos corporativos'), estos términos se aplicarán, en todo caso, solo al uso del sitio o de cualquier servicio de firmadoc-corp en la medida en que tales el uso no se rige ya por dicho acuerdo de servicios maestro. para evitar dudas, todas las referencias al 'sitio' en estos términos también incluyen los servicios de firmadoc-corp.
    	Al acceder, utilizar o descargar cualquier material del sitio, usted acepta seguir y estar obligado por estos términos. si no está de acuerdo con estos términos, no está autorizado y debe dejar de utilizar el sitio inmediatamente.<br><br>
    	<b>AVISO IMPORTANTE:</b> estos términos y condiciones contienen una disposición de arbitraje vinculante y una renuncia a juicios por jurado y demandas colectivas que rigen las disputas que surjan del uso de los servicios de firmadoc-corp. afecta sus derechos legales según se detalla en la sección de arbitraje obligatorio y renuncia a la demanda colectiva a continuación. por favor lea detenidamente.
    	</p>
    	<div style='padding-top:140PX;'>
    	<h1 class='title2' style='text-align:center;'>ACUERDO DE COMUNICACIONES <br>(ANÉXO 2).</h1>
    	</div>
    	<p style='text-align:justify;padding:5xp 90px 0px 80px;'>
		<b>1.</b>	Todas las partes integrantes y/o beneficiarias de este servicio manifiestan y aceptan que en lo sucesivo cualquier tipo de comunicación entre ellas se realice a través de medios electrónicos y no en papel.<br><br>
		<b>2.</b>	Mediante la implementación de este acuerdo de Comunicaciones las partes manifiestan entender y aceptar la obligación de guardar bajo absoluta reserva y confidencialidad sus nombres, claves, códigos de acceso a las plataformas tecnológicas y demás.  De esta manera firmadoc.co no recibirá autorizaciones que no hayan sido otorgadas por el titular.  Las partes entienden que firmadoc.co no se hará responsable por le uso inadecuado que le den los usuarios y/o beneficiarios a sus nombres, claves y códigos de acceso ni de las consecuencia que ello pueda acarrear.<br><br>
		<b>3.</b>	Firmadoc.co no se hace responsable por la no recepción de comunicación o comunicaciones a causa de cambios de direcciones de correo electrónico no actualizados en el sistema.<br><br>
		<b>4.</b>	Para la legalización de los documentos LAS PARTES acuerdan que los documentos necesarios para ello serán firmados utilizando mecanismos de firma electrónica que cumplen los requisitos  técnicos contemplados en la ley y que LAS PARTES reconocen como confiables y apropiados.<br><br>
		<b>5.</b>	LAS PARTES aceptan que los documentos serán firmados mediante alguno de los métodos de firma electrónica de firmadoc.co<br><br>
		<b>6.</b>	Las partes conocen que la firma electrónica permite realizar acuerdos sin que se requiera para ello la presentación personal, para que todas LAS PARTES puedan celebrar acuerdos de forma más rápida y efectiva.<br><br>
		<b>7.</b>	Las partes conocen y aceptan que para realizar el firmado electrónico de este documento, o de cualquier otro se deberá hacer uso de las herramientas suinistradas y del estricto cumplimiento del procedimiento establecido y conocido por el cliente. Igualmente, éste será válido única y exclusivamente para el trámite que se está realizando y no podrá ser utilizado para trámites futuros ya que deberá iniciar un nuevo procedimiento. Esto garantiza a cada parte, que es la única persona que podrá conocer el código de validación.<br><br>
		</p>


		<p style='text-align:justify;padding-left:10px; padding-top:100px;'>

		<h1 class='title2' > MANUAL DE POLÍTICAS Y TRATAMIENTO DE PROTECCIÓN DE DATOS PERSONALES<br>(ANÉXO 3).</h1> 

	<p style='padding:5xp 90px 0px 80px;'>
			La presente Política de Protección de Datos Personales (en adelante la “Política”) pretende regular la recolección, almacenamiento, uso, circulación y supresión de datos personales en FIRMADOC, brindando herramientas que garanticen la autenticidad, confidencialidad e integridad de la información. 

			La Política se estructura siguiendo los mandatos trazados y aceptados internacionalmente sin perjuicio que se adapte frente a los cambios que sobre la materia se realicen.  

	</p>
			<h1 class='title2' >POLÍTICA DE PROTECCIÓN DE DATOS PERSONALES </h1>
	<p style='padding:5xp 90px 20px 80px;text-align:justify;'>
		1       ALCANCE  

		La Política de FIRMADOC cubre todos los aspectos administrativos, organizacionales y de control que deben ser cumplidos por los directivos, funcionarios, contratistas y terceros que laboren o tengan relación directa con la FIRMADOC. <br>




		2       DESARROLLO DE LA POLÍTICA  

		FIRMADOC incorpora en todas sus actuaciones el respeto por la protección de datos personales. En consecuencia, solicitará desde el ingreso del dato, autorización para el uso de la información que reciba  para las finalidades propias de su objeto misional. 

		FIRMADOC respeta los principios establecidos en las leyes y atenderá en sus actuaciones y manejo de información de datos personales las finalidades que se deriven de la recolección de los mismos. 

		FIRMADOC implementará las estrategias y acciones necesarias para dar efectividad a los derechos consagrados en las leyes, normas y demás que regulen la materia y toda aquella normativa que la complemente, modifique o derogue. 

		FIRMADOC  dará a conocer a todos sus usuarios los derechos que se derivan de la protección de datos personales. <br>



		3       ESTRATEGIAS <br>

		3.1      Tratamiento 
		<br>
		Para el adecuado tratamiento y protección de los datos personales, FIRMADOC trabaja tres perspectivas básicas que tienen como fin desarrollar políticas particulares de tratamiento de datos de acuerdo; estas perspectivas son: 
		<br>
		•	Perspectiva Jurídica <br>
		•	Perspectiva Tecnológica <br>
		•	Perspectiva Organizacional <br>

		<p style='padding:60xp 90px 0px 80px;'>
		3.2      Divulgación y Capacitación <br>

		FIRMADOC definirá los procesos de divulgación y capacitación del contenido de esta Política a través de su Junta de Seguridad de la Información. 
		<br>

		3.3      Organización interna y Gestión de riesgos <br>

		
		FIRMADOC definirá cualquier acción relativa a la protección de datos personales en su Junta de Seguridad de la Información. Al interior de dicha Junta se ha definido el rol de Oficial de Protección de Datos Personales, rol que estará dentro de las atribuciones funcionales del actual Oficial de Seguridad de la Información. 
		4       DEFINICIONES: 
		Para los propósitos de este documento se aplican los siguientes términos y definiciones: <br>

		•	Aviso de Privacidad: Comunicación verbal o escrita generada por el Responsable del tratamiento de datos personales, dirigida al Titular de dichos datos, mediante la cual se le informa acerca de la existencia de las políticas de tratamiento de datos que le serán aplicables, la forma de acceder a las mismas y las finalidades del tratamiento que se pretende dar a los datos personales. 
		<br>

		•	Autorización: Consentimiento previo, expreso e informado del titular de los datos personales para llevar a cabo el tratamiento de dichos datos. 
		<br>
		•	Bases de Datos: Conjunto organizado de datos personales que sea objeto de Tratamiento. 
		<br>
		•	Dato Personal: Cualquier información vinculada o que pueda asociarse a una o a varias personas naturales determinadas o determinables. Debe entonces entenderse el “dato personal” como una información relacionada con una persona natural (persona individualmente considerada). 
		<br>
		•	Dato Público: Es el dato que no sea semiprivado, privado o sensible. Son considerados datos públicos, entre otros, los datos relativos al estado civil de las personas, a su profesión u oficio y a su calidad de comerciante o de servidor público. Por su naturaleza, los datos públicos pueden estar contenidos, entre otros, en registros públicos, documentos públicos, gacetas y boletines oficiales, y sentencias judiciales debidamente ejecutoriadas que no estén sometidas a reserva. 
		<br>
		•	Dato Sensible: Corresponde a aquel dato que afecta la intimidad del Titular o cuyo uso indebido puede generar su discriminación, tales como aquellos que revelen el origen racial o étnico, la orientación política, las convicciones religiosas o filosóficas, la pertenencia a sindicatos, organizaciones sociales, de derechos humanos o que promueva intereses de cualquier partido político o que garanticen los derechos y garantías de partidos políticos de oposición así como los datos relativos a la salud, a la vida sexual y los datos biométricos. 
		<br>
		•	Encargado del tratamiento: Persona natural o jurídica, pública o privada, que por sí misma o en asocio con otros, realice el tratamiento de datos personales por cuenta del responsable del tratamiento. 
		<br>
		•	Responsable del Tratamiento: Persona natural o jurídica, pública o privada, que por sí misma o en asocio con otros, decida sobre la base de datos y/o el Tratamiento de los datos. 
		<br>
		•	Titular: Persona natural cuyos datos personales sean objeto de tratamiento. 
		<br>
		•	Transferencia: La transferencia de datos tiene lugar cuando el responsable y/o encargado del tratamiento de datos personales, envía la información o los datos personales a un receptor, que a su vez es responsable del tratamiento y se encuentra dentro o fuera del país. 
		<p style='padding:60xp 90px 0px 80px;'>
		•	Transmisión: Tratamiento de datos personales que implica la comunicación de los mismos dentro o fuera del País de origen cuando tenga por objeto la realización de un tratamiento por el encargado por cuenta del responsable. 

		<br>
		•	Tratamiento: Cualquier operación o conjunto de operaciones sobre datos personales, tales como la recolección, almacenamiento, uso, circulación o supresión. 
		<br> 
		•   Oficial de Protección de Datos: Es el rol dentro de FIRMADOC, que tendrá como función la vigilancia y control de la Política bajo el control de la Junta de Seguridad. 
		<br>

		5      PRINCIPIOS RECTORES 
		<br>

		•	Principio de Legalidad en materia de Tratamiento de datos: El tratamiento de datos es una actividad reglada que debe sujetarse a lo establecido en la ley y en las demás disposiciones que la desarrollen. 
		<br>
		•	Principio de Finalidad: El tratamiento debe obedecer a una finalidad legítima de acuerdo con la ley, la cual debe ser informada al Titular. 
		<br> 
		•	Principio de Libertad: El tratamiento sólo puede ejercerse con el consentimiento, previo, expreso e informado del Titular. Los datos personales no podrán ser obtenidos o divulgados sin previa autorización, o en ausencia de mandato legal o judicial que releve el consentimiento. 
		<br>
		•	Principio de Veracidad o Calidad: La información sujeta a tratamiento debe ser veraz, completa, exacta, actualizada, comprobable y comprensible. Se prohíbe el tratamiento de datos parciales, incompletos, fraccionados o que induzcan a error. 
		<br>
		•	Principio de Transparencia: En el tratamiento debe garantizarse el derecho del Titular a obtener del Responsable de dicho tratamiento o del Encargado, en cualquier momento y sin restricciones, información acerca de la existencia de datos que le conciernan. 
		<br>
		•	Principio de Acceso y Circulación Restringida: El tratamiento se sujeta a los límites que se derivan de la naturaleza de los datos personales y de las disposiciones constitucionales y legales. En este sentido, el tratamiento sólo podrá hacerse por personas autorizadas por el Titular y/o por las personas previstas en la Ley. Los datos personales, salvo la información pública, no podrán estar disponibles en Internet u otros medios de divulgación o comunicación masiva, salvo que el acceso sea técnicamente controlable para brindar un conocimiento restringido sólo a los Titulares o terceros autorizados conforme a la ley. 
		<br>
		•	Principio de Seguridad: La información sujeta a tratamiento por el Responsable del Tratamiento o Encargado del tratamiento a que se refiere la ley se deberá manejar con las medidas técnicas, humanas y administrativas que sean necesarias para otorgar seguridad a los registros, y evitar su adulteración, pérdida, consulta, uso o acceso no autorizado o fraudulento. 
		<br>
		•	Principio de Confidencialidad: Todas las personas que intervengan en el tratamiento de datos personales que no tengan la naturaleza de públicos están obligadas a garantizar la reserva de la información, inclusive después de finalizada su relación con alguna de las labores que comprende el tratamiento, pudiendo sólo realizar suministro o comunicación de datos personales cuando ello corresponda al desarrollo de las actividades autorizadas en la Ley y en los términos de la misma. 


		6       CATEGORÍAS ESPECIALES DE DATOS <br>
		<p style='padding:55xp 90px 0px 80px;'>
		6.1      Datos Personales Sensibles 
		<br> 
		Los datos sensibles son aquellos datos que afectan la intimidad del titular o cuyo uso indebido puede generar su discriminación, tales como aquellos que revelen el origen racial o étnico, la orientación política, las convicciones religiosas o filosóficas, la pertenencia a sindicatos, organizaciones sociales, de derechos humanos o que promueva intereses de cualquier partido político o que garanticen los derechos y garantías de partidos políticos de oposición así como los datos relativos a la salud, a la vida sexual y los datos biométricos. 
		FIRMADOC restringirá el tratamiento de datos personales sensibles a lo estrictamente indispensable y solicitará consentimiento previo y expreso sobre la finalidad de su tratamiento. 
		<br>
		
		6.2      Tratamiento de Datos Personales Sensibles 
		<br>
		Se podrá hacer uso y tratamiento de los datos catalogados como sensibles cuando: 
		<br>
		•	El Titular haya dado su autorización explícita a dicho tratamiento, salvo en los casos que, por ley no sea requerido el otorgamiento de dicha autorización. 
		<br> 
		•	El tratamiento sea necesario para salvaguardar el interés vital del Titular y este se encuentre física o jurídicamente incapacitado. En estos eventos, los representantes legales deberán otorgar su autorización. 
		<br> 
		•	El tratamiento se refiera a datos que sean necesarios para el reconocimiento, ejercicio o defensa de un derecho en un proceso judicial. 
		<br>
		•	El tratamiento tenga una finalidad histórica, estadística o científica, o dentro del marco de procesos de mejoramiento, siempre y cuando se adopten las medidas conducentes a la
				
		supresión de identidad de los titulares. 
		<br>
		
		6.3      Datos Personales de Niños, Niñas y Adolescentes 
		<br>
		Los menores de edad son Titulares de sus datos personales y por lo tanto portadores de los derechos correspondientes.  Los derechos de los menores deben ser interpretados y aplicados de manera prevalente y por lo tanto, deben ser observados con especial cuidado. Por tal razón las opiniones de los menores deben ser tenidas en cuenta al momento de realizar algún tratamiento de sus datos. <br>
		FIRMADOC se compromete entonces, en el tratamiento de los datos personales, a respetar los derechos prevalentes de los menores. Queda proscrito el tratamiento de datos personales de menores, salvo aquellos datos que sean de naturaleza pública. 
		<br> 

		7       CLASIFICACIÓN DE INFORMACIÓN Y DE BASES DE DATOS <br>
		Las bases de datos se clasificarán de la siguiente manera: 
		    <br>
		7.1      Bases de datos Confidenciales: <br>
		Son bases de datos o ficheros electrónicos con información confidencial la cual trata el modelo de negocio de FIRMADOC, es el caso de datos financieros, bases de datos del personal, bases de datos con información sensible sobre directivos, proveedores etc. 
		<br>
		7.2      Bases de datos con Información Sensible: <br>
		Son los datos que afectan la intimidad del Titular o cuyo uso indebido puede generar su discriminación, tales como aquellos que revelen el origen racial o étnico, la orientación política, las convicciones religiosas o filosóficas, la pertenencia a sindicatos, organizaciones sociales, de derechos humanos o que promueva intereses de cualquier partido político o que garanticen los derechos y garantías de partidos políticos de oposición así como los datos relativos a la salud, a la vida sexual y los datos biométricos. En FIRMADOC, el acceso a este tipo de información es restringido y únicamente será conocido por un grupo autorizado de funcionarios. 
		<br>
		<p style='padding:60xp 90px 0px 80px;'>
		7.3      Bases de datos con Información Pública: <br>
		Son las bases de datos que contienen datos públicos calificados como tal según los mandatos de la ley o de la Constitución Política y que no son calificados como datos semiprivados, privados o sensibles. Son públicos, entre otros, los datos relativos al estado civil de las personas, a su profesión u oficio, a su calidad de comerciante o de servidor público y aquellos que puedan obtenerse sin reserva alguna. Por su naturaleza, los datos públicos pueden estar contenidos, entre otros, en registros públicos, documentos públicos, gacetas y boletines oficiales, sentencias judiciales debidamente ejecutoriadas que no estén sometidas a reserva. 
		
		<br> 
		8     PRERROGATIVAS Y DERECHOS DE LOS TITULARES <br>
		Los Titulares de los datos personales tienen los siguientes derechos: 
		<br>
		•	Acceder, conocer, actualizar y rectificar sus datos personales frente a FIRMADOC en su condición de responsable del tratamiento. 
		<br>
		
		•	Por cualquier medio válido, solicitar prueba de la existencia de la autorización otorgada a FIRMADOC, salvo los casos en los que la Ley exceptúa la autorización. 
		<br>
		•	Recibir información por parte de SUNTIC S.A.S, previa solicitud, respecto del uso que le ha dado a sus datos personales. 
		<br>
		•	Acudir ante las autoridades legalmente constituidas y presentar quejas por infracciones a lo dispuesto en la normatividad vigente, previo tramite de consulta o requerimiento ante el responsable del tratamiento. 
		
		<br>
		•	Modificar y revocar la autorización y/o solicitar la supresión de los datos personales cuando en el tratamiento no se respeten los principios, derechos y garantías constitucionales vigentes. 
		<br>
		•	Tener conocimiento y acceder en forma gratuita a sus datos personales que hayan sido objeto de tratamiento. 
		
		<br>
		9     DEBERES DE FIRMADOC EN RELACIÓN CON EL TRATAMIENTO DE LOS DATOS PERSONALES <br>
		</p>
		
		<p style='padding:0px 90px 0xp 80px;'>
		FIRMADOC, tendrá presente que los datos personales son propiedad de las personas a las que se refieren y que solamente ellas pueden decidir sobre los mismos. FIRMADOC hará uso de dichos datos solamente para las finalidades para las que se encuentra debidamente facultada como empresa dedicada a los servicios de tecnologías de la información y las comunicaciones y dentro de su objeto social respetando en todo caso la normativa vigente sobre la Protección de Datos Personales. 
		<br>
		10     POLÍTICAS DE TRATAMIENTO DE LA INFORMACIÓN 
		<br>
		10.1    Generalidades Sobre la Autorización 
		<br>
		FIRMADOC solicitará la autorización para el tratamiento de datos personales por cualquier medio que permita ser utilizado como prueba. Según el caso, dicha autorización puede ser parte de un documento más amplio, como por ejemplo un contrato o de un documento específico para tal efecto. En todo caso, la descripción de la finalidad del tratamiento de los datos también se informará mediante el mismo documento específico o adjunto. FIRMADOC informará al titular de los datos, lo siguiente: 
		    <br>
		•	El tratamiento al que serán sometidos sus datos personales y la finalidad del mismo. 
		<br>
		•	Los derechos que le asisten como Titular. 
		<br>
		
		•	Los canales en los cuales podrá formular consultas y/o reclamos. 
		
		<br>
		<p style='padding:45xp 90px 0px 80px;'>
		10.2    Garantías del Derecho de Acceso 
		<br>
		FIRMADOC garantizará el derecho de acceso, previa acreditación de la identidad del titular, legitimidad, o personalidad de su representante, poniendo a disposición de este, sin costo o erogación alguna, de manera pormenorizada y detallada, los respectivos datos personales. 
		
		<br>
		10.3    Consultas 
		<br>
		Los Titulares de los datos personales o sus causahabientes, podrán consultar sus datos personales que reposan en la base de datos. En consecuencia, FIRMADOC garantizará el derecho de consulta, suministrando a los Titulares de datos personales, toda la información contenida en el registro individual o que esté vinculada con la identificación del Titular. 
		<br>
		Con respecto a la atención de solicitudes de consulta de datos personales, FIRMADOC garantiza: 
		<br>
		•	Habilitar medios de comunicación electrónica u otros que considere pertinentes. 
		<br>
		•	Establecer formularios, sistemas y otros métodos. 
		<br>
		•	Utilizar los servicios de atención al cliente o de reclamaciones que se encuentren en operación. 
		<br>
		Independientemente del mecanismo que se implemente para la atención de solicitudes de consulta, estas serán atendidas en un término máximo de diez (10) días hábiles contados a partir de la fecha de su recibo. En el evento en el que una solicitud de consulta no pueda ser atendida dentro del término antes señalado, se informará al interesado antes del vencimiento del plazo las razones por las cuales no se ha dado respuesta a su consulta, la cual, en ningún caso podrá superar los cinco (5) días hábiles siguientes al vencimiento del primer término. 
		Las consultas que se efectúen respecto a datos personales deberán ser remitidas mediante un correo electrónico a la siguiente dirección juridico@suntic.co. 
		<br>
		
		10.4    Reclamos 
		<br>
		El Titular o sus causahabientes que consideren que la información contenida en una base de datos debe ser objeto de corrección, actualización o supresión, o cuando adviertan el presunto incumplimiento de cualquiera de los deberes contenidos en la normativa sobre Protección de Datos Personales, podrán presentar un reclamo ante el responsable del tratamiento. 
		<br>
		El reclamo deberá ser presentado por el Titular de los datos personales, mediante correo electrónico, y en él, el Titular deberá indicar si desea que sus datos sean actualizados, rectificados o suprimidos o bien si desea revocar la autorización que se había otorgado para el tratamiento de los datos personales. 
		Si el reclamo estuviese incompleto, el Titular lo puede completar dentro de los cinco (5) días hábiles siguientes a la recepción del reclamo para que se subsanen las fallas. Transcurridos dos (2) meses desde la fecha del requerimiento sin que el solicitante presente la información requerida, se entenderá que ha desistido del reclamo. 
		En caso que la persona que reciba el reclamo no sea competente para resolverlo, dará traslado a quien corresponda en un término máximo de dos (2) días hábiles e informará de la situación al interesado. 
		Una vez recibido el reclamo completo, el término máximo para atenderlo será de quince (15) días hábiles contados a partir del día siguiente a la fecha de su recibo. Cuando no fuere posible atender el reclamo dentro de dicho término, se informará al interesado los motivos de la demora y la fecha en que se atenderá su reclamo, la cual en ningún caso podrá superar los ocho (8) días hábiles siguientes al vencimiento del primer término. 
		<p style='padding:45xp 90px 0px 80px;'>
		10.5    Rectificación y Actualización de Datos 
		<br>
		FIRMADOC tiene la obligación de rectificar y actualizar, a solicitud del Titular, la información de éste que resulte ser incompleta o inexacta de conformidad con el procedimiento y lo términos antes señalados. Al respecto, FIRMADOC tendrá en cuenta lo siguiente: 
		    <br>
		•	En las solicitudes de rectificación y actualización de datos personales, el titular debe indicar las correcciones a realizar y aportar la documentación que avale su petición. 
		<br>
		•	FIRMADOC tiene plena libertad de habilitar mecanismos que le faciliten el ejercicio de este derecho, siempre y cuando beneficien al Titular de los datos. En consecuencia, se podrán habilitar medios electrónicos u otros que FIRMADOC considere pertinentes. 
		
		<br>
		•	FIRMADOC podrá establecer formularios, sistemas y otros métodos, que se pondrán a disposición de los interesados en la página web o solicitándolos mediante correo electrónico a la dirección juridico@suntic.co. 
		<br>
		10.6    Supresión de Datos <br>
		El Titular de datos personales tiene el derecho, en todo momento, a solicitar a FIRMADOC, la supresión (eliminación) de sus datos personales cuando: 
		<br>
		•	Considere que los mismos no están siendo tratados conforme a los principios, deberes y obligaciones previstas en la normativa vigente. 
		<br>
		•	Hayan dejado de ser necesarios o pertinentes para la finalidad para la cual fueron recabados. 
		<br>
		•	Se haya superado el periodo necesario para el cumplimiento de los fines para los que fueron recabados. 
		<br>
		La supresión implica la eliminación total o parcial de la información personal de acuerdo a lo solicitado por el Titular en los registros, archivos, bases de datos o tratamientos realizados por FIRMADOC 
		<br>
		El derecho de supresión no es un derecho absoluto y el responsable del tratamiento de datos personales puede negar el ejercicio del mismo cuando: 
		<br>
		•	El Titular de los datos tenga un deber legal o contractual de permanecer en la base de datos. 
		<br>
		•	La eliminación de datos obstaculice actuaciones judiciales o administrativas vinculadas a obligaciones fiscales, la investigación y persecución de delitos o la actualización de sanciones administrativas. 
		<br>
		•	Los datos sean necesarios para proteger los intereses jurídicamente tutelados del Titular para realizar una acción en función del interés público o para cumplir con una obligación legalmente adquirida por el Titular.  
		
		<br>
		10.7    Revocatoria de la Autorización <br>
		Todo Titular de datos personales puede revocar, en cualquier momento, el consentimiento al tratamiento de estos siempre y cuando no lo impida una disposición legal o contractual. Para ello, FIRMADOC establecerá mecanismos sencillos que le permitan al Titular revocar su consentimiento. 
		Existen dos modalidades en las que la revocación del consentimiento puede darse: 
		<br>
		
		•	Sobre la totalidad de finalidades consentidas, esto es, que FIRMADOC debe dejar de tratar por completo los datos del Titular. 
		<br>
		•	Sobre ciertas finalidades consentidas como por ejemplo para fines publicitarios o de estudios de mercado. En este caso, FIRMADOC, deberá dejar de tratar parcialmente los datos del Titular. Se mantienen entonces otros fines del tratamiento que el responsable, de conformidad con la autorización otorgada, puede llevar a cabo y con<p style='padding:45xp 90px 0px 80px;'> los que el Titular está de acuerdo. 
		<br>
		10.8    Contratos <br>
		
		En los contratos laborales, FIRMADOC  incluirá cláusulas con el fin de autorizar de manera previa y general el tratamiento de datos personales relacionados con la ejecución del contrato, lo que incluye la autorización de recolectar, modificar o corregir, en momentos futuros, datos personales del titular. También incluirá la autorización de que algunos de los datos personales, en caso dado, puedan ser entregados a terceros con los cuales FIRMADOC tenga contratos de prestación de servicios, para la realización de tareas tercerizadas. En estas cláusulas se hará mención a esta Política. 
		<br>
		En los contratos de prestación de servicios externos, cuando el contratista requiera de datos personales, FIRMADOC le suministrará dichos datos siempre y cuando exista una autorización previa y expresa del titular para esta transferencia. Dado que en estos casos los terceros son encargados del tratamiento de datos, sus contratos incluirán cláusulas que precisan los fines y los tratamientos autorizados por FIRMADOC y delimitan de manera precisa el uso que dicho terceros le pueden dar a los datos. 
		<br>
		10.9    Transferencia de Datos Personales a Terceros Países <br>
		La transferencia de datos personales a terceros países solamente se realizará cuando exista autorización correspondiente del Titular. 
		<br> 
		11     REGLAS GENERALES APLICABLES 
		<br>
		•	FIRMADOC  establece las siguientes reglas generales para la protección de datos personales y sensibles, como en el cuidado de bases de datos, ficheros electrónicos e información personal.
		<br>
		•	FIRMADOC garantizará la autenticidad, confidencialidad e integridad de la información. 
		La Junta de Seguridad será quien tendrá como objetivo ejecutar y diseñar la estrategia para que la presente Política se cumpla. 
		<br>
		•	FIRMADOC tomará todas las medidas técnicas necesarias para garantizar la protección de las bases de datos existentes. En los casos que la infraestructura dependa de un tercero, se cerciorará que la disponibilidad de la información como el cuidado de los datos personales y sensibles sea un objetivo fundamental. 
		<br>
		•	Se realizarán auditorías y controles de manera periódica para garantizar la correcta implementación de la ley. 
		<br>
		•	Es responsabilidad de los empleados y colaboradores de FIRMADOC reportar cualquier incidente de fuga de información, daño informático, violación de datos personales, comercialización de datos, uso de datos personales de niños, niñas o adolescentes, suplantación de identidad, o conductas que puedan vulnerar la intimidad de una persona. 
		<br>
		•	La formación y capacitación de los funcionarios, proveedores y contratistas será un complemento fundamental de estas Políticas.   
		<br>
		•	El Oficial de Protección de Datos, deberá identificar e impulsar las autorizaciones de los Titulares, los avisos de privacidad, los avisos en el website de la entidad, las campañas de sensibilización, las leyendas de reclamo y demás procedimientos para dar cumplimiento a la ley y demás normativa que la complemente, modifique o derogue. 
		<br>
		12     FUNCIÓN DE PROTECCIÓN DE DATOS PERSONALES AL INTERIOR DE FIRMADOC 
		
		12.1    Los Responsables 
		Es Responsable del tratamiento de datos personales 'la persona natural o jurídica, pública o privada, que [...] decida sobre la base de datos<p style='padding:50px 90px 0px 80px;'> y/o tratamiento de datos'. De esta manera, el Responsable es el que define los fines y los medios del tratamiento de datos personales y garantiza el cumplimiento de los requisitos de ley. 
		<br>
		En el caso de FIRMADOC, la Junta de Seguridad es la responsable de adoptar las medidas necesarias para el buen tratamiento de los datos personales. Quien desarrolla la Secretaría Técnica de la Junta es el Oficial de Protección de Datos Personales. 
		<br>
		12.2    Los Encargados  
		<br>
		Es Encargado del tratamiento de datos personales 'la persona natural o jurídica, pública o privada, que [...] realice el tratamiento de datos personales por cuenta del responsable del tratamiento'. Esto supone que, para cada tratamiento de datos, se hayan definido sus respectivos encargados y que éstos actúen por instrucción precisa de un Responsable. 
		<br>
		12.3    Deberes de los Encargados 
		<br>
		FIRMADOC distingue entre Encargado interno y Encargado externo. Los Encargados internos son empleados y colaboradores de FIRMADOC mientras que los externos son personas naturales o jurídicas que tratan datos que la entidad les suministra para la realización de una tarea asignada (proveedores, consultores etc.). 
		<br>
		12.4    El Despliegue Interno de la Política de Protección de Datos  <br>
		A partir de la adopción de la presente Política, FIRMADOC establecerá: <br>
		•	Términos y condiciones de uso de herramientas informáticas externas: Autorregulación de los principios y las reglas consagradas en la ley, dirigidos específicamente a proteger el derecho de hábeas data de clientes, usuarios y en general toda persona natural que interactúe con un aplicativo informático (elemento que gestione información bien sea física o electrónica). 
		<br>
		•	Oficial de Protección de Datos: En cumplimiento del deber legal relativo a la necesidad de asignar unas responsabilidades directas a un sujeto dentro de la Organización, se crea el rol de Oficial de Protección de Datos Personales, en cabeza del Oficial de Seguridad de la Información, quien teniendo en cuenta lo definido por la Junta de Seguridad, articulará todas las acciones para el efectivo cumplimiento de la Política de Protección de Datos Personales en FIRMADOC 
		<br>
		Las obligaciones más importantes a cargo de la Junta de Seguridad son las siguientes: <br>
		<br>
		A.	Garantizar al Titular, en todo tiempo, el pleno y efectivo ejercicio del derecho de hábeas data. <br>
		B.	Solicitar y conservar, en las condiciones previstas en la presente ley, copia de la respectiva autorización otorgada por el Titular. <br>
		C.	Informar debidamente al Titular sobre la finalidad de la recolección y los derechos que le asisten por virtud de la autorización otorgada. <br>
		D.	Conservar la información bajo las condiciones de seguridad necesarias para impedir su adulteración, pérdida, consulta, uso o acceso no autorizado o fraudulento. <br>
		E.	Garantizar que la información que se suministre al Encargado del tratamiento sea veraz, completa, exacta, actualizada, comprobable y comprensible. <br>
		F.	Actualizar la información, comunicando de forma oportuna al Encargado del tratamiento, todas las novedades respecto de los datos que previamente le haya suministrado y adoptar las demás medidas necesarias para que la información suministrada a éste se mantenga actualizada. <br>
		<p style='padding:50px 90px 0px 80px;'>
		G.	Rectificar la información cuando sea incorrecta y comunicar lo pertinente al Encargado del tratamiento. <br>
		H.	Suministrar al Encargado del tratamiento, según el caso, únicamente datos cuyo tratamiento esté previamente autorizado de conformidad con lo previsto en la ley.
		
		I.	Exigir al Encargado del tratamiento en todo momento, el respeto a las condiciones de seguridad y privacidad de la información del Titular. <br>
		J.	Tramitar las consultas y reclamos formulados en los términos señalados en la ley. <br>
		K.	Informar al Encargado del tratamiento cuando determinada    información se encuentre en discusión por parte del Titular, una vez se haya presentado la reclamación y no haya finalizado el trámite respectivo. <br>
		L.	Informar a solicitud del Titular el uso dado a sus datos personales. Informar a la autoridad de protección de datos cuando se presenten violaciones a los códigos de seguridad y existan riesgos en la administración de la información de los Titulares. <br>
		Cumplir las instrucciones y requerimientos que imparta la Entidad reguladora de la materia. <br>
		
		13    EL REGISTRO NACIONAL DE BASES DE DATOS <br>
		
		De acuerdo con lo establecido en la normatividad, FIRMADOC inscribirá de manera independiente en el Registro Nacional de Base de Datos, cada una de las base de datos que contengan datos personales cuyo tratamiento se realice por parte de la Compañía, identificando cada una de esas bases de datos de acuerdo con la finalidad para la cual fueron creadas. En el registro que se efectúe de las bases de datos FIRMADOC indicará su razón social, número de identificación tributaria, así como sus datos de ubicación y contacto. 
		FIRMADOC indicará en el Registro Nacional de Base de Datos la razón social, número de identificación tributaria, ubicación y contacto de los Encargados del tratamiento de sus bases de datos (artículo 7 del Decreto 886 de 2014). 
		Finalmente, FIRMADOC deberá actualizar en el Registro Nacional de Base de Datos la información inscrita cuando se presenten cambios sustanciales a la misma. 
		<br>
		14     VIGENCIA Y ACTUALIZACIÓN <br>
		La presente Política entra en vigencia a partir de su aprobación por parte de la Junta de Seguridad de la Información y su actualización dependerá de las instrucciones de dicha Junta. 
		Se articularán las acciones conducentes a la protección de datos personales dentro de la Junta de Seguridad de la Información, la cual realizará revisiones periódicas de la correcta ejecución de la Política de manera conjunta con el Oficial de Protección de Datos de la Compañía. La versión aprobada de esta Política se publicará en la página oficial de FIRMADOC 
		Es un deber de los empleados y colaboradores de FIRMADOC, conocer esta Política y realizar todos los actos conducentes para su cumplimiento, implementación y mantenimiento. 
		<br>
		La presente Política de Protección de Datos Personales fue aprobada en sesión de Junta de Seguridad de FIRMADOC el día dieciocho (18) de noviembre de 2022. 
		
		</p>
		</p>
		</p>
		
		</p>
		
		 <div class='container_header'>
		 	<p style='padding:80px 0px 0px 0px;'></p>
		    <h3 class='title-head' style='padding-top:70px;letter-spacing:-1px; font-size:2.1rem; font-family: Arial, sans-serif; font-style: none; color:black;'>REPÚBLICA DE COLOMBIA</h3>
		    <h3 style='padding-top:-5px;letter-spacing:-1px; font-size:2.1rem; font-family: Arial, sans-serif; font-style: none; color:black;'>CERTIFICADO DE FIRMA ELECTRÓNICA</h3>
		  </div>
		
		  <h4 style='padding:-10px 40px 0px 40px;text-align: center; font-family: Arial, sans-serif;'>
		    Las partes que firman de manera electrónica este documento, declaran que
		    lo han leído a plenitud, que reconocen su contenido y están de acuerdo con
		    el mismo. A su vez, esta firma reemplaza la firma mecánica estampada en
		    cada uno de los espacios donde tuviese lugar.
		  </h4>

		  	<table class='table_info' style='margin:0px 85px 0px 75px; width:100%;'>
				<tr>
					<td style='border-bottom:1px solid #000; width:49%;'>
						<strong style='font-size:1rem;font-style: normal; font-family: Arial, sans-serif;'>Codigo Verificación</strong><br>
						<p style='font-size:1rem;font-style: normal; font-family: Arial, sans-serif;' class='p_info'>" . substr(password_hash(rand(5, 15), PASSWORD_DEFAULT), 0, 30) . "</p>
					</td>
					<td>
					</td>
					<td style='border-bottom:1px solid #000; width:49%;'>	
						<strong style='font-size:1rem;font-style: normal; font-family: Arial, sans-serif;'>Fecha Generación</strong>
						<p style='font-size:1rem;font-style: normal; font-family: Arial, sans-serif;' class='p_info'>" . date("y/m/d:h:i:s A") . "</p>
					</td>
				</tr>
			</table>	  	

			<h1 style='padding-bottom:15px; font-family: Arial, sans-serif; text-align: center; font-size: 1.2rem;'>Firmante(s)</h1>
			
			<table class='signatory_table' style='margin-left:100px;margin-bottom:230px; width: 500px;background-image: url(../firma_destinatario/marco3.png);background-repeat: no-repeat;'>
				<tr>
			";

		$plantilla .= "<td style='padding: -30px 0px -50px 70px;'>";
		$plantilla .= !empty($img2) ? "<img id='CC' src='$img2' alt='img' style='width: 100px;height:200px;transform: rotate(-90deg); border: 2px solid #bebebe;'>" : "";
		$plantilla .= "</td></tr>";
		$plantilla .= !empty($img) ? "<tr>
				<td style='padding: 5px -20px 50px -70px;'><img id='foto' src='$img' alt='img' style='width: 80px;height:100px; border: 2px solid #bebebe;'></td>
				<td style='padding: 0px 0px 50px -340px;'>
					<table>
						<tr>
							<td style='text-align: left; padding-left: 20px;'>
								<p style='font-size: .8rem; font-style: normal; font-family: Arial, sans-serif;'>{$_SESSION['nombre_usuario']} {$_SESSION['apellido_usuario']}</p>
								<p style='font-size: .8rem; font-style: normal; font-family: Arial, sans-serif;'>CC: {$_SESSION['cedula_usuario']}</p>
							</td>
						</tr>
						<tr>$contenido</tr>
					</table>
				</td>
			</tr>" : '';

		$plantilla .= "</table>";
		$plantilla .= "<h5 style='font-size: 1.1rem; font-style: normal; font-family: Arial, sans-serif; text-align: center;'>Valida el documento en el siguiente enlace.</h5>";
		$plantilla .= "<h6 style='font-size: 1.1rem; font-weight:none; font-style: normal; font-family: Arial, sans-serif; text-align: center; padding: -20px 0px 0px 0px;'><a href=" . SERVERURL . "validardocumento name='verificacion'>Validar Documento</a></h6>";
		$plantilla .= "</body>
		</html>";

		return $plantilla;
	}

	public static function getSignedDocTemplate(string $hash, string $fecha, array $firmantes): string
	{
		$firmaE = '
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<body>
     		<h4>
        		Las partes que firman de manera electrónica este documento, declaran que
        		lo han leído a plenitud, que reconocen su contenido y están de acuerdo con
        		el mismo. A su vez, esta firma reemplaza la firma mecánica estampada en
        		cada uno de los espacios donde tuviese lugar.
      		</h4>
  
     		<table class="table_info">
        		<tr>
          			<td>
            			<strong>Codigo Verificacion</strong><br>
            			<p class="p_info">' . $hash . '</p>
          			</td>
          			<td>	
            			<strong>Fecha Generacion</strong>
            			<br>
            			<p class="p_info">' . $fecha . '</p>
          			</td>
        		</tr>
      		</table>
      		<h1>Firmante(s)</h1>
      		<h5>Valida el documento en el siguiente enlace.</h5>
      		<h6><a href="' . SERVERURL . 'validardocumento" name="verificacion">Validar Documento</a></h6>
    		<table class="signatory_table">';

		foreach ($firmantes as $firma) {
			$firmaE .= '<tr>';
			foreach ($firma as $signer) {
				$firmaE .= '
        				<td class="image_td">
          					<table class="table_td">';
				$firmaE .= !empty($signer['url_foto_doc']) ?
					'<tr>
            						<td colspan="2">
              							<img class="cc" src="' . $signer['url_foto_doc'] . '" alt="img">
            						</td>         
          						</tr>' : '';
				$firmaE .= '<tr>';
				$firmaE .= !empty($signer['url_foto']) ?
					'<td>
                	<img class="profile" src="' . $signer['url_foto'] . '" alt="img">
              	</td>' : '';
				$firmaE .= '
              <td>
                <div>
                  <p class="p_td">' . $signer["usu_nombre"] . ' ' . $signer["usu_apelli"] . '</p>
                  <p class="p_td">CC: ' . $signer["usu_docume"] . '</p>
                </div>';

				$firmaE .= !empty($signer['det_rutafi']) || file_exists($signer['det_rutafi']) ? '<img class="grafo" src="' . $signer['det_rutafi'] . '" alt="img">' : '<p id="firma" style="font-family: Tangarine; font-size: 200%;">' . $signer['det_nomdes'] . '</p>';
				$firmaE .= '</td>       
            		</tr>
          		</table>
        		</td>';
			}
			$firmaE .= '</tr>';
		}
		$firmaE .= '
        	</table>
      	</body>';
		return $firmaE;
	}

	public static function getSignedDocTemplateUS(string $hash, string $fecha, array $firmantes): string
	{
		$firmaE = '
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <body>
            <h4>
            Parties who electronically sign this document state that they have read 
            the entire document, acknowledge the contents of the document and approve it. 
            This signature replaces the mechanical signature stamped in each of the spaces 
            in which it was carried out.
            </h4>
            <br>
            
           <table class="table_info">
              <tr>
                <td>
                  <strong style="font-size: 1.1rem;">Verification Code</strong><br>
                  <p class="p_info">' . $hash . '</p>
                </td>
                <td>
                  <strong style="font-size: 1.1rem;">Generation Date</strong>
                  <br>
                  <p class="p_info">' . $fecha . '</p>
                </td>
              </tr>
            </table>
            <br>
            <br>
            <h1>Signatory(s)</h1>
            <br>
            <br>
            <h5>Valida el documento en el siguiente enlace:</h5>
            <h6><a href="' . SERVERURL . 'validardocumento" name="verificacion">Validar Documento</a></h6>
          <table class="signatory_table">';

		foreach ($firmantes as $firma) {
			$firmaE .= '<tr>';
			foreach ($firma as $signer) {
				$firmaE .= '<td class="image_td">';
				$firmaE .= !empty($signer['det_rutafi']) ? '<img class="grafo" src="..' . $signer['url_firma'] . '" alt="img"><br>' : '<span style="font-family: Tangarine; font-size: 200%;">' . $signer["usu_nombre"] . ' ' . $signer["usu_apelli"] . '</span><br>';
				$firmaE .= '<span class="name"><strong>' . $signer["usu_nombre"] . ' ' . $signer["usu_apelli"] . '</strong></span><br>
							<!--
							<span class="name">CC: ' . $signer["usu_docume"] . '</span>
							-->';

				$firmaE .= '</td>';
			}
			$firmaE .= '</tr>';
		}
		$firmaE .= '
              </table>
            </body>';
		return $firmaE;
	}

	public static function getSignCertificateTemplate(array $document_data, array $creator_data, array $firmantes_data, int $firmantes_amount): string
	{
		$firmaE = '
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <body>
			<h2>Información de firma:</h2>
			<!--
				<p><b>Signing Name:</b> ' . '??' . '</p>
			-->
			<p><b>Certificado ID:</b> ' . $document_data['hash_certificado'] . '</p>

			<table>
  				<tr>
    				<td>
						<p id="fecha-inicio"><b>Fecha y hora de creación:</b> ' . $document_data['doc_fechac'] . ' ' . $document_data['doc_horac'] . '</p>
    				</td>
    				<td>
						<p id="fecha-fin"><b>Fecha y hora de firma:</b> ' . $document_data['doc_fecha_f'] . ' ' . $document_data['doc_hora_f'] . '</p>
    				</td>
  				</tr>

				<tr>
    				<td colspan="1">
						<p><b>Cantidad de firmantes:</b> ' . $firmantes_amount . '</p>
    				</td>
  				</tr>

				<tr>
					<td colspan="1">
						<p></p>
					</td>
				</tr>

				<tr>
    				<td>
						<p><b>Creador:</b> ' . $creator_data['usu_nombre'] . ' ' . $creator_data['usu_apelli'] . '</p>
    				</td>
    				<td>
						<p><b>Correo electrónico:</b> ' . $creator_data['usu_email'] . '</p>
    				</td>
				</tr>
				
				<tr>
					<td>
						<p><b>Tipo de documento:</b> ' . $creator_data['usu_tipo_documento'] . '</p>
    				</td>
    				<td>
						<p><b>Número de documento:</b> ' . $creator_data['usu_docume'] . '</p>
    				</td>
  				</tr>
			</table>

			<hr>

			<h2>Información de documento:</h2>
			<p><b>Nombre del documento:</b> ' . $document_data['doc_nombre'] . '</p>
			<p><b>Código verificación:</b> ' . $document_data['doc_hash'] . '</p>
			<p><b>Número de páginas:</b> ' . $document_data['doc_pages'] . '</p>

			<hr>

			<h2>Información de firmantes:</h2>';

		$firmaE .= '<table>';

		foreach ($firmantes_data as $firmante) {
			$firmaE .= '
			<tr>
				<td>
					<p><b>Nombre:</b> ' . $firmante['usu_nombre'] . '</p>
				</td>
				<td>
					<p><b>Apellido:</b> ' . $firmante['usu_apelli'] . '</p>
				</td>
			</tr>
			
			<tr>
				<td>
					<p><b>Tipo de documento:</b> ' . $firmante['usu_tipo_documento'] . '</p>
    			</td>
				<td>
					<p><b>Número de documento:</b> ' . $firmante['usu_docume'] . '</p>
    			</td>
			</tr>
			
			<tr>
				<td colspan="2">
					<p><b>Correo electrónico:</b> ' . $firmante['det_cordes'] . '</p>
				</td>
			</tr>
			
			<tr class="blank_row">
    			<td colspan="2"></td>
			</tr>';
		}

		$firmaE .= '</table>';

		$firmaE .= '<p style="page-break-before: always;"></p>

			<h2 class="titulo">Consentimiento del consumidor</h2>

			<p>
				Procediendo y seleccionando el botón "Acepto" correspondiente a la sección Divulgación de consentimiento del consumidor en FIRMADOC
				Ventana de términos de servicio, usted acepta que ha revisado la siguiente información de divulgación de consentimiento del consumidor y consentimiento realizar transacciones comerciales electrónicamente, recibir avisos y divulgaciones electrónicamente y usar firmas electrónicas en lugar de utilizando documentos en papel. 
				Este servicio de firma electrónica ("FIRMADOC") se proporciona en nombre de nuestro cliente ("Remitente") que figura con su información de contacto en la parte inferior del correo electrónico del participante firmante de FIRMADOC ("Invitación") que recibió.
			</p>
        ';
		return $firmaE;
	}
	
	public static function getRegisterEmailTemplate($remitenteName, $remitenteEmail, $nombre_archivo, $enlace, $type, $mensaje, $otp, $new_email = null, $new_password = null) {
		$body = '
		<!DOCTYPE html>
		<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
			<head>
				<meta charset="UTF-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<meta name="x-apple-disable-message-reformatting">
				<style>
					
					/* Fuentes */
					@font-face {
						font-family: "Poppins-Light";
						src: url("./Poppins-Light.ttf");
					}
		
					/* Estilos principales */
					* {
						padding: 0;
						margin: 0;
						box-sizing: border-box;
					}
		
					html, body {
						height: 100%;
						width: 100%;
						font-family: "Poppins-Light";
					}
		
					/* Estilos del fondo */
					.background {
						background-color: #E6E6E6;
						height: 100%;
						width: 100%;
						
						/* background-color: #f0f0f0; */
					}
		
					/* Estilos del logo */
					.logo-container {
						margin: auto;
						text-align: center;
						padding-top: 10px;
						width: 500px;
					}
		
					.logo {
						width: 300px;
					}
		
					/* Estilos del contenedor principal */
					.content {
						margin: auto;
						background-color: #FFF;
						padding: 20px;
						width: 450px;
					}
		
					/* Encabezado del correo */
					.header {
						position: relative;
						background-image: url("https://i.postimg.cc/8C8G8mtv/fondo.png");
						border-radius: 2px;
						background-repeat: no-repeat;
						background-size: cover;
					}
		
					.header h1 {
						text-transform: capitalize;
						text-align: center;
						padding: 20px 0px 10px 0px;
						color: #FFF;
						font-size: 1.2rem;
					}
		
					.header p {
						color: #FFF;
						text-align: center;
						padding-bottom: 40px;
					}
		
					.header .firma {
						position: absolute;
						top: 0;
						right: 0;
						height: 145px;
					}
		
					.header .documento {
						font-style: italic;
					}
		
					/* Cuerpo del correo */
					.body {
						text-align: center;
						padding: 30px 0px;
						font-size: .9rem;
						font-weight: bold;
					}
		
					.body p {
						padding-bottom: 30px;
					}
		
					/* Boton que dirige al documento */
					.body a {
						text-decoration: none;
						background-color: #006CD8;
						border-radius: 2px;
						color: #FFF;
						padding: 15px 50px;
						text-transform: capitalize;
						/* box-shadow: 0 4px 4px -2px gray; */
					}
		
					/* Sombra */
					.shadow {
						margin: auto;
						height: 5px;
						width: 35%;
						margin-top: 30px;
						border-radius: 50%;
						background-color: #E6E6E6;
						filter: blur(2px);
					}
		
					/* Pie de correo */
					.footer {
						margin: auto;
						background-color: #006CD8;
						width: 450px;
						padding: 10px;
						color: #FFF;
					}
		
					.footer .item {
						font-size: 0.8rem;
						font-style: italic;
					}
		
					.footer li {
						margin-left: 30px;
					}
		
					.footer h4 {
						text-align: center;
						padding-bottom: 10px;
					}
		
				</style>
			</head>
			<body>
				<main class="background" style="background-color: #E6E6E6; height: 100%; width: 100%;">
					<div class="logo-container">
						<img src="https://i.postimg.cc/rsLhZG3j/logo.png" class="logo">
					</div>
					<section class="content">
						<div class="header">
							<h1 style="text-align:center;">' . utf8_decode($remitenteName) . '<br>' . ($remitenteEmail) . '</h1>
							<p>
								Le ha enviado un documento
								<br>
								<span class="documento">(' . $nombre_archivo . ')</span>
								<br>
								para revisar y firmar
								<br>
								Mensaje
								<br>
								' . utf8_decode($mensaje) . '
							</p>
						</div>';
		if ($type == 1) {
			$body .= '<div class="body">
							<p>
								Por favor, redirigirse al registro
								<br>
								Este es tu c&oacute;digo de verificaci&oacute;n para firmar el documento
								<br>
								<b>' . $otp . '</b>
								<br>
								<br>
								Para registrarse copie el siguiente el link y peguelo en navegador google Chrome con incgonito:
							</p>
							
							<p style="color:#006BD6; text-decoration:underline;">'.$enlace.'</p>
							
							<div class="shadow"></div>	
						</div>';
		} else if ($type == 2) {
			$body .= '<div class="body">
			<p>
			Por favor, redirigirse al registro
												
			<br>
			<br>
			Para registrarse copie el siguiente el link y peguelo en navegador google Chrome con incgonito:
		</p>
		<p style="color:#006BD6; text-decoration:underline;">'.$enlace.'</p>
		<div class="shadow"></div>	
		</div>';
		} elseif($type==3){
			$body.='<div class="body">
				<p>
					Por favor, redirigirse al inicio sesi&oacute;n
					<br>
					Este es tu Codigo de verificaci&oacute;n para firmar el documento
					<br>
					<b>' . $otp . '</b>
					<br>
					presionando el boton:
				</p>
				<a href="'.$enlace.'">Firmar</a>
				<div class="shadow"></div>	
				</div>';
		} elseif($type==4){
			$body.='<div class="body">
				<p>
					Por favor, redirigirse al inicio sesi&oacute;n
					<br>
					Para firmar el documento copie el siguiente el link y peguelo en navegador google Chrome con incgonito:
				</p>
				<p style="color:#006BD6; text-decoration:underline;">'.$enlace.'</p>
				<div class="shadow"></div>	
				</div>';
		} else if ($type == 5) {
			$body.= '<div class="body">
						<p>
							Por favor, ingrese sesi&oacute;n con las siguientes credenciales:
							<br>
							<b>Correo electr&oacute;nico</b>: ' . $new_email . '
							<br>
							<b>Contrase&ntilde;a</b>: ' . $new_password . '
							<br>
							<small>(Se recomienda cambiar la contrase&ntilde;a luego del primer inicio de sesi&oacute;n)</small>
							<br>
							<br>
							Este es tu c&oacute;digo de verificaci&oacute;n para firmar el documento
							<br>
							<b>' . $otp . '</b>
							<br>
							presionando el bot&oacute;n:
						</p>
						<a href="'.$enlace.'">Firmar</a>
						<div class="shadow"></div>	
					</div>';
		} 

		$body .= '</section>
					<div class="footer">
						<h4>Recomendaciones</h5>
						<p>Para una mejor experiencia tenga en cuenta:</p>
						<ul>
							<li>
								<p class="item">Utilizar navegadores Google Chrome y Safari.</p>
							</li>
							<li>
								<p class="item">Navegue siempre en una pesta&ntilde;a de incognito.</p>
							</li>
							<li>
								<p class="item">Disponga de una camara web.</p>
							</li>
							<li>
								<p class="item">Cuente con una conexion a internet estable.</p>
							</li>
						</ul>
					</div>
				</main>
			</body>
		</html>';
		
		return $body;
	}
}
