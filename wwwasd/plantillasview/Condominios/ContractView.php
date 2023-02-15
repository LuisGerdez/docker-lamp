<?php
include_once "../menu.php";
$ini1=$_SESSION['nombre_usuario'];
$ini2=$_SESSION['apellido_usuario'];
?>

<link rel="stylesheet" href="../plantillasview/Condominios/css/styleCourtsAtKendall.css">
<input type="hidden" name="ini1" id="ini1" value='<?php echo  $ini1?>'>
<input type="hidden" name="ini2" id="ini2"value='<?php echo  $ini2?>'>
<form action="../validacionview/indexCondominios.php" method="post" enctype="multipart/form-data" target="" name="formulario"
 id="formulario">
 <style>
	input[type=text] {
		height: 20px;
		outline: none;
	}
</style>
<!-- PAGE 1 -->
    <div class="whiteblock">	
			<table>
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
            <h4 class="title">The Courts at Kendall</h4>
            <p>		
            The following applies to any real estate transaction involving the sale, rental or transfer of any
            condominium or home owners association unit.
            </p>
            <h5>PLEASE READ CAREFULLY</h5>
            <p>This application will not be processed unless the following items are attached:</p>
            <ol>
            <li>
            <h5 class="size">PAYMENTS MADE IN MONEY ORDERS OR CASHIERS CHECKS/ NO REFUNDS!<br>
            • PAYABLE TO SPMGROUP INC (APPLICATION FEEI<br>
            • EVERY PROSPECTIVE APPLICANT OVER THE AGE OF 18 MUSTPAY A SEPARATE APPLICATION FEEOF S100.00 UNLESS LEGALLY MARRIED. (MUST PROVIDE CERTIFICATE OF MARRIAGE).<br>
            • $50 FOR CONDO DOCUMENTS & BY LAWS<br>
            • $175 TRANSFER FEE PAYABLE TO SPM GROUP FOR PURCHASE ONLY
            </h5>
            </li>
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
            <li> Employment letter or most recent pay stubs <br> <label>DO NOT PRINT FRONT & BACK. DOUBLE-SIDED COPIES ARE NOT ALLOWED.</label></li>
            </ol>		
            <h5 class="nonedecoration">Please make sure that before you close on your unit the following information has been requested, if
            applicable.</h5>
            • Estoppel Letter, $350.00 fee Next day Processing Updates over 30 days, Sl 75.00 fee <br>
            • Refinance, $350.00 fee Next Day Processing Condo PUD Letter, $350.00 fee Next day
            processing<br>
            • In order to receive your Certificate of Approval you must have received and reviewed the
            By-Laws of the Association.
            <p class="boldertext">
            ONCE THE SALE IF FINAL IT IS IMPERATIVE THAT YOU OR YOUR CLOSING AGENT
            FORWARDS A COPY OF THE WARRANTY DEED OR SETTLEMENT STATEMENT
            INDICATING DATE OF CLOSING AND NAME (S) OF NEW OWNER (
            <label style="text-decoration:underline;">
            Without this
            information we cannot update our system and in most cases no couepe.s will be issued.)</label>
            </p>
            <p class="bolder">PLEASE BE AWARE THAT THIS PROCESS CAN TAKE UP TO TWENTY FIVE (25)
            BUSINESS DAYS AND NONE OF THE FEES INCURRED ARE REFUNDALBLE.
            <label class="end">This process may take longer than expected due to the delay form the Board of Directors to give
            an approval OR misinformation. Please be advised that you must request your parking decals at
            the time of the receiver of the Certificate of Approval. Also, please be advised that some
            applications may require an interview with the applicant.</p>
    </div>
    <!-- PAGE 2 -->
    <div class="whiteblock" id="page2">
		<table>
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
		<table style="width:650px;">
			<tr>
				<td>Date:</td>
				<td rowspan="2" style="border:1px solid black;height:50px;width:200px;">
					<div style="text-align:center;">

						<b style="font-size:15px;"><u style="padding-top:10px;">Payment Method</u></b>
					</div>
				</td>
			</tr>
			<tr>
				<td>Assoociation Name:</td>
			</tr>
		</table>

		<h5 style="text-align:center;text-decoration:underline;">Application Check List</h5>

		<div style="border:1px solid black;margin:auto;font-size:16px;">
		Please be advised that in order to process your application on a timely manner and within
		the (15) business days from the day it was turned in, the following requirements must be
		met:</div>

		<h5 style="text-align:center;">*This Application is to be filled out by SPM Group. Inc. only*</h5>

		<table class=""  style="text-align:left;width:600px;">
			<tr>
				<td class="tds">
					1) <input type="checkbox" name="check1" id="" >
				</td>
				<td>
					A money order or cashiers check payable to SPM Group. Inc. in the amount of $100.000
					for each applicant adult over 18 years of age and S50.00 for Condo
					Documents & By Laws. <b><u>$175 TRANSFER FEE FOR PURCHASE ONLY
					PAYABLE TO SPM GROUP (NO PERSONAL CHECKS ARE ACCEPTED).</u></b>
				</td>
			</tr>
			<tr>
				<td class="tds">
					2) <input type="checkbox" name="check2" id="">
				</td>
				<td>
					Original completed application
				</td>
			</tr>
			<tr>
				<td class="tds">
					3)<input type="checkbox" name="check3" id="">
				</td>
				<td>
					Copy of Lease Agreement or Sales Contract
				</td>
			</tr>
			<tr>
				<td class="tds">
					4)<input type="checkbox" name="check4" id="">
				</td>
				<td>
					Copy of LDs of all proslkctive occupants
				</td>
			</tr>
			<tr>
				<td class="tds">
					5)<input type="checkbox" name="check5" id="">
				</td>
				<td>
					Copy of car registration & picture of vehicle for car decal
				</td>
			</tr>
			<tr>
				<td class="tds">
					6)<input type="checkbox" name="check6" id="">
				</td>
				<td>
					Copy of drivers license
				</td>
			</tr>
			<tr>
				<td class="tds">
					7)<input type="checkbox" name="check7" id="">
				</td>
				<td>
					Original copy of police background check for applicants 18+ (If anything other
					than NO LOCAL RECORD PLEASE BRING ORIGINAL AFFIDAVIT AND
					DISPOSITION FOR EACH CASE).
				</td>
			</tr>
			<tr>
				<td class="tds">
					8)<input type="checkbox" name="check8" id="">
				</td>
				<td>
					Reference letter from the current landlord. (IF YOU ARE CURRENTLY RENTING).
				</td>
			</tr>
			<tr>
				<td class="tds">
					9)<input type="checkbox" name="check9" id="">
				</td>
				<td>
					Three (3) references
				</td>
			</tr>
			<tr>
				<td class="tds">10) <input type="checkbox" name="check10" id=""></td>
				<td>
					Employment letter or most recent pay stubs
				</td>
			</tr>
		</table>
		<p></p>	
		<div id="contAtr"class="col-md-12">

			<table style="font-size:16px;" id="campospages2">
	
				<tr>
					<td style="border:1px solid black;">APPLICANTS NAME: <input type="text" style="width:60%;"name="valores[]" id=""></td>
					<td style="border:1px solid black;">EMAIL  <input type="text" style="width:60%;"name="valores[]" id=""></td>
				</tr>
	
				<tr>
					<td style="border:1px solid black;">CURRENT ADDRESS:  <input type="text" name="valores[]"style="width:60%;"name="" id=""></td>
					<td style="border:1px solid black;">PHONE:  <input type="text" style="width:60%;"name="valores[]" id=""></td>
				</tr>
	
				<tr>
					<td style="border:1px solid black;">OWNERS NAME:  <input type="text" style="width:60%;"name="valores[]" id=""></td>
					<td style="border:1px solid black;">PHONE:  <input type="text" style="width:60%;"name="valores[]" id=""></td>
				</tr>
	
				<tr>
					<td colspan="2" style="border:1px solid black;">CURRENT ADDRESS:  <input type="text" style="width:60%;"name="valores[]" id=""></td>
				</tr>
	
				<tr>
					<td style="border:1px solid black;">OWNERS EMAIL:  <input type="text" style="width:60%;"name="valores[]" id=""></td>
					<td style="border:1px solid black;">EMERGENCY#:  <input type="text" style="width:60%;"name="valores[]" id=""></td>
				</tr>
	
			</table>
			<div class="col-md-3 d-flex" id="contImg">
				<img id="add"src="../plantillasview/Condominios/img/add.png" alt="" srcset="">
				<img id="basura"src="../plantillasview/Condominios/img/basura.png" alt="" srcset="">
			</div>
		</div>

		<p></p>
		<table >
			<tr>
				<td><h5>If realtor please provide Phone #</h5></td>
				<td><input type="text" name="valores[]" id=""></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;"><b style="font-size:12px;">* * these requirements are not met the applicatiM1 will returned to you unprocessed***</b></td>
			</tr>
		</table>
		<p></p>
		<table style="font-size:15px;">
			<tr>
				<td><h5>Application and documents were<br> received by:</h5></td>
				<td><input type="text" name="valores[]" id=""></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:right;"><b style="font-size:12px;">SPM Group, Inc. — Representative</b></td>
			</tr>
		</table>
		
    </div>
	<!-- PAGE 3 -->
	<div class="whiteblock">
		<table style="width:100%; font-size: 13px;">
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
		<br>
		<b style="display:block;font-size: 14px; margin-top:-10;">
			NOTE: print legibly or type. Answer all questions on this application. If not completed this
			application may returned or not approved.
		</b>
		<br>
		<b style="display:block;text-align:center; margin-top:-15px; font-size: 14px;">APPLICATION FOR PURCHASE,RENTAL<br>
		<small style="font-style:italic;">(Please circle one).</small></b>
		<br>
		<table style="margin-top: -10px; font-size: 14px;">
			<tr>
				<td>Community Name:</td>
				<td><input style="width: 215px;" type="text" name="datos_form[]"></td>
				<td>Apt. No.</td>
				<td><input style="width: 50px;" type="text" name="datos_form[]"></td>
				<td>Address:</td>
				<td><input style="width: 215px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="margin-top: 0px; font-size: 14px;">
			<tr>
				<td>City:</td>
				<td><input style="width: 145px;" type="text" name="datos_form[]"></td>
				<td>Owner Acct. #:</td>
				<td><input style="width: 145px;" type="text" name="datos_form[]"></td>
				<td>Desired date of occupancy:</td>
				<td><input style="width: 120px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<br>
		<b style="display:block; margin-top: -10px; font-size: 14px;">Applicants Name(s):</b>
		<table style="margin-top: 0px; font-size: 14px;">
			<tr>
				<td>Name</td>
				<td><input style="width: 230px;" type="text" name="datos_form[]"></td>
				<td>DOB:</td>
				<td><input style="width: 30px;" type="text" name="datos_form[]"></td>
				<td>/</td>
				<td><input style="width: 30px;" type="text" name="datos_form[]"></td>
				<td>/</td>
				<td><input style="width: 50px;" type="text" name="datos_form[]"></td>
				<td>Soc. Sec#:</td>
				<td><input style="width: 210px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="margin-top: 0px; font-size: 14px;">
			<tr>
				<td>Spouse/Other</td>
				<td><input style="width: 160px;" type="text" name="datos_form[]"></td>
				<td>DOB:</td>
				<td><input style="width: 30px;" type="text" name="datos_form[]"></td>
				<td>/</td>
				<td><input style="width: 30px;" type="text" name="datos_form[]"></td>
				<td>/</td>
				<td><input style="width: 50px;" type="text" name="datos_form[]"></td>
				<td>Soc. Sec. #:</td>
				<td><input style="width: 225px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="margin-top: 0px; font-size: 14px;">
			<tr>
				<td><b>Phone Number: </b></td>
				<td><input style="width: 155px;" type="text" name="datos_form[]"></td>
				<td><b>Email:</b></td>
				<td><input style="width: 200px;" type="text" name="datos_form[]"></td>
				<td><b>Other:</b></td>
				<td><input style="width: 155px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="font-size: 14px;">
			<tr>
				<td><b>Marital Status:</b></td>
				<td><input type="checkbox" name="check11">Single</td>
				<td><input type="checkbox" name="check12">Divorced</td>
				<td><input type="checkbox" name="check13">Widowed</td>
				<td><input type="checkbox" name="check14">Married</td>
			</tr>
		</table>
		<table style="margin-top: 0px; font-size: 14px;">
			<tr>
				<td>Number of adults(18 and over) who will be living in the unit:</b></td>
				<td><input style="width: 335px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="margin-top: 0px; font-size: 14px;">
			Name and ages of children:
			<tr>
				<td style="padding-left:40px; width: 105px;">1.  Name:</td>
				<td style="width: 350px;"><input style="width: 100%;" type="text" name="datos_form[]"></td>
				<td style="width: 30px;">Age</td>
				<td><input style="width: 50px;" type="text" name="datos_form[]"></td>
			</tr>
			<tr>
				<td style="padding-left:40px; width: 105px;">2.  Name:</td>
				<td style="width: 350px;"><input style="width: 100%;" type="text" name="datos_form[]"></td>
				<td style="width: 30px;">Age</td>
				<td><input style="width: 50px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="font-size: 14px;">
			<tr>
				<td style="width:350px;"><b>Number of vehicles would be parked at this address:</b></td>
				<td><input style="width: 50px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="margin-top: 0px; font-size: 14px;">
			<tr>
				<td>Drivers License No.</td>
				<td><input style="width: 230px;" type="text" name="datos_form[]"></td>
				<td>Drivers License No.</td>
				<td><input style="width: 230px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="margin-top: 0px; font-size: 14px;">
			<tr>
				<td>Make</td>
				<td><input style="width: 160px;" type="text" name="datos_form[]"></td>
				<td>Model</td>
				<td><input style="width: 100px;" type="text" name="datos_form[]"></td>
				<td>Plate No:</td>
				<td><input style="width: 160px;" type="text" name="datos_form[]"></td>
				<td>State</td>
				<td><input style="width: 100px;" type="text" name="datos_form[]"></td>
			</tr>
			<tr>
				<td>Make</td>
				<td><input style="width: 160px;" type="text" name="datos_form[]"></td>
				<td>Model</td>
				<td><input style="width: 100px;" type="text" name="datos_form[]"></td>
				<td>Plate No:</td>
				<td><input style="width: 160px;" type="text" name="datos_form[]"></td>
				<td>State</td>
				<td><input style="width: 100px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<br>
		<u><b style="font-size: 14px;">RESIDENCE HISTORY</b></u>
		<table style="font-size: 14px;">
			<tr>
				<td>1 Previous Address:</td>
				<td><input style="width: 350px;" type="text" name="datos_form[]"></td>
				<td>How long:</td>
				<td><input style="width: 160px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="margin-top: 0px; font-size: 14px;">
			<tr>
				<td>City:</td>
				<td><input style="width: 105px;" type="text" name="datos_form[]"></td>
				<td>State:</td>
				<td><input style="width: 105px;" type="text" name="datos_form[]"></td>
				<td>Zip code:</td>
				<td><input style="width: 105px;" type="text" name="datos_form[]"></td>
				<td>Email:</td>
				<td><input style="width: 220px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="margin-top: 0px; font-size: 14px;">
			<tr>
				<td>Landlord Name:</td>
				<td><input style="width: 280px;" type="text" name="datos_form[]"></td>
				<td>Phone:</td>
				<td><input style="width: 280px;" type="text" name="datos_form[]"></td>
			</tr>
			<tr>
				<td style="padding-left: 50px;"><input type="checkbox" name="check15">Rental</td>
				<td style="padding-left: 50px;"><input type="checkbox" name="check16">Owned</td>
			</tr>
		</table>
		<table style="font-size:14px;">
			<tr>
				<td>2 Previous Address:</td>
				<td><input style="width: 360px;" type="text" name="datos_form[]"></td>
				<td>How long:</td>
				<td><input style="width: 160px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="margin-top: 0px; font-size: 14px;">
			<tr>
				<td style="width:30px;">City:</td>
				<td style=" width:150px;"><input style="width: 150px;" type="text" name="datos_form[]"></td>
				<td style="width:30px;">State:</td>
				<td style="width:100px;"><input style="width: 100px;" type="text" name="datos_form[]"></td>
				<td style="width:60px;">Zip code:</td>
				<td><input style="width: 100px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="margin-top: 0px; font-size: 14px;">
			<tr>
				<td>**Landlord Name:</td>
				<td><input style="width: 275px;" type="text" name="datos_form[]"></td>
				<td>Phone:</td>
				<td><input style="width: 275px;" type="text" name="datos_form[]"></td>
			</tr>
			<tr>
				<td style="padding-left: 50px;"><input type="checkbox" name="check17">Rental</td>
				<td style="padding-left: 50px;"><input type="checkbox" name="check18">Owned</td>
			</tr>
		</table>
		<br>
		<u><b style="font-size: 14px;">EMPLOYMENT REFERENCE</b></u>
		<table style="font-size: 14px;">
			<tr>
				<td >1. Employer:</td>
				<td><input style="width:410px;" type="text" name="datos_form[]"></td>
				<td >Phone No:</td>
				<td><input style="width:150px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="margin-top:0;font-size: 14px;">
			<tr>
				<td>Address:</td>
				<td><input style="width:655px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="margin-top:0;font-size: 14px;">
			<tr>
				<td>Position:</td>
				<td><input style="width:250px;" type="text" name="datos_form[]"></td>
				<td>How long:</td>
				<td><input style="width:115px;" type="text" name="datos_form[]"></td>
				<td>Mothly income:$</td>
				<td><input style="width:115px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="font-size: 14px;">
			<tr>
				<td>2. Spouse's Employer:</td>
				<td><input style="width:350px;" type="text" name="datos_form[]"></td>
				<td >Phone No:</td>
				<td><input style="width:150px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="margin-top:0;font-size: 14px;">
			<tr>
				<td>Address:</td>
				<td><input style="width:655px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="margin-top:0;font-size: 14px;">
			<tr>
				<td>Position:</td>
				<td><input style="width:250px;" type="text" name="datos_form[]"></td>
				<td>How long:</td>
				<td><input style="width:115px;" type="text" name="datos_form[]"></td>
				<td>Mothly income:$</td>
				<td><input style="width:115px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
	</div>
	<!-- PAGE 4 -->
	<div class="whiteblock">
		<table style="width:100%;font-size:13px;">
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
		<p></p>
		<u><b style="font-size: 14px;">BANK REFERENCES</b></u>
		<table style="font-size: 14px;">
			<tr>
				<td>1. Bank Name:</td>
				<td><input style="width: 325px;" type="text" name="datos_form[]"></td>
				<td>Phone No.</td>
				<td><input style="width: 225px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="font-size: 14px; margin-top: 0;">
			<tr>
				<td>Address:</td>
				<td><input style="width: 360px;" type="text" name="datos_form[]"></td>
				<td>Officers Name:</td>
				<td><input style="width: 200px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="font-size: 14px; margin-top: 0;">
			<tr>
				<td>Account No:</td>
				<td><input style="width: 211px;" type="text" name="datos_form[]"></td>
				<td><input type="checkbox" name="check19"> Checking</td>
				<td><input type="checkbox" name="check20"> Savings How long:</td>
				<td><input style="width: 211px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="font-size: 14px;">
			<tr>
				<td>2. Bank Name:</td>
				<td><input style="width: 325px;" type="text" name="datos_form[]"></td>
				<td>Phone No.</td>
				<td><input style="width: 225px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="font-size: 14px; margin-top: 0;">
			<tr>
				<td>Address:</td>
				<td><input style="width: 360px;" type="text" name="datos_form[]"></td>
				<td>Officers Name:</td>
				<td><input style="width: 200px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="font-size: 14px; margin-top: 0;">
			<tr>
				<td>Account No:</td>
				<td><input style="width: 211px;" type="text" name="datos_form[]"></td>
				<td><input type="checkbox" name="check21"> Checking</td>
				<td><input type="checkbox" name="check22"> Savings How long:</td>
				<td><input style="width: 211px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<p></p>
		<u><b style="font-size: 14px;">PERSONAL REFERENCES</b></u>
		<p></p>
		<table style="font-size: 14px; margin-top: 0;">
			<tr>
				<td>1. Name:</td>
				<td><input style="width: 385px;" type="text" name="datos_form[]"></td>
				<td>Phone No.</td>
				<td><input style="width: 200px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="font-size: 14px; margin-top: 0;">
			<tr>
				<td>Address:</td>
				<td><input style="width: 240px;" type="text" name="datos_form[]"></td>
				<td>City:</td>
				<td><input style="width: 150px;" type="text" name="datos_form[]"></td>
				<td>State:</td>
				<td><input style="width: 50px;" type="text" name="datos_form[]"></td>
				<td>Zip code:</td>
				<td><input style="width: 80px;" type="text" name="datos_form[]"></td>
			</tr>	
		</table>
		<p></p>
		<table style="font-size: 14px; margin-top: 0;">
			<tr>
				<td>2. Name:</td>
				<td><input style="width: 385px;" type="text" name="datos_form[]"></td>
				<td>Phone No.</td>
				<td><input style="width: 200px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="font-size: 14px; margin-top: 0;">
			<tr>
				<td>Address:</td>
				<td><input style="width: 240px;" type="text" name="datos_form[]"></td>
				<td>City:</td>
				<td><input style="width: 150px;" type="text" name="datos_form[]"></td>
				<td>State:</td>
				<td><input style="width: 50px;" type="text" name="datos_form[]"></td>
				<td>Zip code:</td>
				<td><input style="width: 80px;" type="text" name="datos_form[]"></td>
			</tr>	
		</table>
		<p></p>
		<table style="font-size:14px;">
			<tr>
				<td>Have you ever applied in SPM Group, Inc. before? if yes, when?</td>
				<td><input style="width:320px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="font-size:14px; margin-top:0;">
			<tr>
				<td>Have you ever had any legal conflict with a landlord? If yes, explain.</td>
				<td><input style="width:290px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="font-size:14px; margin-top:0;">
			<tr>
				<td>Have you ever been evicted from a previous residence?</td>
				<td><input style="width:365px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<p></p>
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
	
		<p style="font-size:14px;">Attached is the signed Authorization Form for release of the information.</p>
		
		<table style="font-size:14px;">
			<tr>
				<td style="width: 60px;">Signature:</td>
				<td style="width: 230px;"><input style="width: 200px;" type="text" name="datos_form[]"></td>
				<td style="width: 30px;">Date:</td>
				<td><input style="width: 200px;" type="text" name="datos_form[]"></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:40px;text-align:center;">Primary applicant</td>
			</tr>
		</table>
		<table style="font-size:14px;">
			<tr>
				<td style="width: 60px;">Signature:</td>
				<td style="width: 230px;"><input style="width: 200px;" type="text" name="datos_form[]"></td>
				<td style="width: 30px;">Date:</td>
				<td><input style="width: 200px;" type="text" name="datos_form[]"></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:30px;text-align:center;">Secondary Application/Spouse</td>
			</tr>
		</table>
	</div>
	<!-- PAGE 5 -->
	<div class="whiteblock">
		<table style="width:100%; font-size: 13px;">
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
		<br>
		<b style="font-size: 14px;"><u>APPLICANT</u></b>
	
		<p style="font-size: 14px;">
		This authorization form will be used only to obtain and verify information with your eployers, banks and
		financial institutions and credit organizations, wich require your signature and name printed. You gave this
		information in connection with your purchase or lease agreement attached.		
		</p>
		<b style="display:block; font-size:14px; text-align:center;">AUTHORIZATION TO RELEASE INFORMATION ABOUT MY:<br>EMPLOYEMENT, BANKING, CREDIT & RESIDENCE.</b>
		<p></p>
		<p style="font-size:14px;">
			The requested information will be used in reference to my purchase/rental/lease application. I hereby authorize
			you to release any and all information concerning employment, banking, credit, and residence and give this
			information to:
		</p>
		<b style="font-size:14px;display:block;text-align:center;">SPM Group, Inc</b>
		<p style="font-size:14px;">
		I hereby authorize SPM Group, Inc. to instigate all statements contained in my applicantions as may be necessary. I
		understand that I hereby waive any priviliges I may have regarding the requested information to release it to the
		above named party.
		<br>
		A copy of this form may be used in licu of the original.
		<br>
		<p></p>
		<table style="font-size: 14px;">
			<tr>
				<td>Sincerely,</td>
			</tr>
		</table>
		<table style="font-size: 14px;">	
			<tr>
				<td style="width:60px;">Signature: </td>
				<td style="width: 300px;"><input style="width:300px;" type="text" name="datos_form[]"></td>
				<td style="width:30px;">Date:</td>
				<td><input style="width:200px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="font-size: 14px;">
			<tr>
				<td style="width: 130px;">Name (Please Print):</td>
				<td><input style="width: 470px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<br>
		<div style="background-color: #000; height: 2px;"></div>
		<br>
		<b style="display:block; font-size:14px;text-align:center;">AUTHORIZATION TO RELEASE INFORMATION ABOUT MY:<br>EMPLOYEMENT, BANKING, CREDIT & RESIDENCE.</b>
		<p></p>
		<p style="font-size:14px;">
			The requested information will be used in reference to my purchase/rental/lease application. I hereby authorize
			you to release any and all information concerning employment, banking, credit, and residence and give this
			information to:
		</p>
		<b style="display:block; font-size:14px;text-align:center;">SPM Group, Inc</b>
		<p style="font-size:14px;">
		I hereby authorize SPM Group, Inc. to instigate all statements contained in my applicantions as may be necessary. I
		understand that I hereby waive any priviliges I may have regarding the requested information to release it to the
		above named party.
		<br>
		<p style="font-size:14px;">A copy of this form may be used in licu of the original.</p>
		
		<table style="font-size: 14px;">
			<tr>
				<td>Sincerely,</td>
			</tr>
		</table>
		<table style="font-size: 14px;">
			<tr>
				<td>Secondary Applicant:</td>
			</tr>
		</table>
		<table style="font-size: 14px;">	
			<tr>
				<td style="width:60px;">Signature: </td>
				<td style="width: 300px;"><input style="width:300px;" type="text" name="datos_form[]"></td>
				<td style="width:30px;">Date:</td>
				<td><input style="width:200px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
		<table style="font-size: 14px;">
			<tr>
				<td style="width: 130px;">Name (Please Print):</td>
				<td><input style="width: 470px;" type="text" name="datos_form[]"></td>
			</tr>
		</table>
	</div>
	<!-- PAGE 6 -->
	<div class="whiteblock">
		<table style="width:100%; font-size: 13px;">
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
		<p></p>
		<p></p>
		<b style="display:block;text-align:center;font-size:20px;"><u>WE WIL NOT ACCEPT INCOMPLETE APPLICATIONS!!</u></b>		
		<br>
		<br>
		<b style="display:block;text-align:center; font-size:23px;"><u>GUEST PARKING WITH PERMIT ONLY FOR UP TO 24 HOURS</u></b>		
		<br>
		<br>
		<b style="display:block;text-align:justify;font-size:16px;">OWNERS ARE ALLOWED 1 PET PER UNIT. THE PET MUST BE LESS THAN 20 POUNDS RENTERS ARE NOT ALLOWED PETS IN UNITS</b>
		<br>
		<p></p>
	
		<b style="display:block;text-align:justify;font-size:16px;">PLEASE DO NOT CALL THE MANAGEMENT COMPANY PRIOR TO 15 BUSINESS DAYS.
		IF THE MANAGEMENT COMPANY NEEDS MORE INFORMATION, THE UNIT OR
		TENANT WILL BE CONTACTED</b>
		<br>
		<br>
	
		<b style="display:block;text-align:center;font-size:18px;">NO BARBEQUE PERMITTED</b><br>
		<b style="display:block;text-align:center;font-size:18px;">MOVING HOURS MONDAY - FRIDAY 10AM TO 5PM</b><br>
		<b style="display:block;text-align:center;font-size:18px;">SATURDAY 9AM - 4PM</b><br>
		<b style="display:block;text-align:center;font-size:18px;">NO MOVING IN ON SUNDAYS</b>
		<p></p>
	
		<b style="display:block;text-align:left;font-size:16px;">COMMERCIAL VEHICLES. COMMERCIAL VANS, LARGE PICK-UP TRUCKS ARE NOT PERMITTED IN THE COMMUNITY.</b>
	</div>
	<!-- PAGE 7 -->
	<div class="whiteblock">
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
	</div>
	<!-- PAGE 8 -->
	<div class="whiteblock">
		<b style="display:block;text-align:center;font-size:24px;"><u>THE COURTS AT KENDALL CONDOMINIUM ASSN.<br>
		PARKING RULES & REGULATIONS</u></b>
		<br>
		<br>
		<ol style="font-size:20px;text-align:justify;">
			<li style="font-size:20px;">
				Residents shall only use the parking space assigned to their unit. All
				other vehicles MUST be parked in the designated guest parking spaces. Only 1 yellow visitor hanger per Unit NO EXCEPTIONS.
			</li>
			<li style="font-size:20px;">All cars must be parked facing forward. (Head only)</li>
		<li style="font-size:20px;">Guest Parking can be used by the residents for 24 hours ONLY and as
		long as they have their Visitor Hanger in their rearview mirror with
		the Unit Number facing out. All others will be towed at owners
		expense. NO EXCEPTIONS</li>
		<li style="font-size:20px;">Any vehicles parked in an area not assigned for parking will be
		towed, immediately, without warning at owners expense. For
		example, Fire lanes, sidewalks, median & grass.</li>
		<li style="font-size:20px;">All parking spaces shall be limited to passenger automobiles, station
		wagons, mini-vans and small trucks under two ton in weight. No boats
		or wave runners are permitted. Motorcycles ARE ONLY permitted in the resident assigned parking  space.
		</li>
		<li style="font-size:20px;">No commercial vehicles are allowed in the property Saturday and Sunday only Monday trough Friday from 10am - 5pm</li>
		<li style="font-size:20px;">No vehicle which can not operate on its own power or which has an expired license plate shall remain in the Condominium property.</li>
		<li style="font-size:20px;">No doudble parking permitted, nor vehicles occupying  more than one space. Violators will be towed at owners expense without warning.
		</li>
		<li style="font-size:20px;">No repair of vehicles shall be made on condominium. This includes changing of oil. Replacement of a flat tire and batteries is permitted.</li>
		<li style="font-size:20px;">No car wash allowed</li>
		</ol>
		<hb style="display:block;text-align:center;font-size:20px;"><b>ALL VEHICLES THAT DO NOT FOLLOW ABOVE MENTIONED RULES WILL BE<br> TOWED AT OWNERS EXPENSE.</b></hb>
	</div>
	<!-- PAGE 9 -->
	<div class="whiteblock">
		<h3 style="text-align:center;font-size:20px;"><u>PARKING ENFORCEMENT PROCEDURES</u></h3>
		<br>
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
		<br>
		<br>
		<b style="display:block;text-align:center;"><u>REGLAMENTACIONES DE ESTACIONAMIENTO</u></b>
	</div>
	<!-- PAGE 10 -->
	<div class="whiteblock">
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
	</div>
	<!-- PAGE 11 -->
	<div class="whiteblock">
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
		</div>
	</div>

	<div class="datos-formulario">
		<input type="hidden" name="formulario_plantilla" value="true">
		
		<input type="hidden" name="codigo_usuario" value='<?php echo $_POST['doc_usuari']?>'>
		<input type="hidden" name="codigo_documento" value='<?php echo $_POST['codigo_documento']?>'>
		<input type="hidden" name="codigo_detalle_documento" value='<?php echo $_POST['codigo_detalle_documento']?>'>
		<input type="hidden" name="nombreArchivo" value="<?= explode("/",$URL)[4]?>">
		<input type="hidden" name="Ruta" value=<?= $URL ?>>
		<input type="hidden" name="accion" value="GeneratePdf">
	</div>

	<div class="cuerpo-botones" style="float:right;">
		<button type="button" title="volver" onclick="volverAtras();"><i
			class="fas fa-arrow-left"></i>Volver</button>
		<button title="siguiente" type="submit" name="siguiente">Siguiente<i
			class="fas fa-arrow-right"></i></button>
	</div>
</form>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="../plantillasview/Condominios/js/globalCourtsAtKendall.js"></script>