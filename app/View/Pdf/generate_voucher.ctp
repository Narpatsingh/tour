<?php
App::import('Vendor','xtcpdf');
$app = APP.'webroot/img/tour_head_logo.png';
$pdf = new XTCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false); 
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Silshine');
$pdf->SetSubject('Silshine');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default header data
$pdf->SetHeaderData($app, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
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

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style
$date = date("d-M-Y");
$customer_signature = $voucher['customer_signature'];
$company_signature = $voucher['company_signature'];
$package_photo = APP.'webroot/'.$voucher['tour_photo'];
$customer_full_name = $voucher['customer_full_name'];
$customer_contact_no = $voucher['customer_contact_no'];
$tour_manager_name = $voucher['tour_manager_name'];
$tour_manager_contact_no = $voucher['tour_manager_contact_no'];
$emergency_contact_no = $voucher['emergency_contact_no'];
$customer_tour_type = $voucher['customer_tour_type'];
$customer_tour_name = $voucher['customer_tour_name'];
$customer_tour_date = date('d-M-Y',strtotime($voucher['customer_tour_date']));
$meal_plan = $voucher['meal_plan'];
$customer_travel_type = $voucher['customer_travel_type'];
$customer_hotel_name = $voucher['customer_hotel_name'];
$customer_hotel_place_name = $voucher['customer_hotel_place_name'];
$hotel_contact_no = $voucher['hotel_contact_no'];
$customer_room_type = $voucher['customer_room_type'];
$customer_hotel_check_in_date = date('d-M-Y',strtotime($voucher['customer_hotel_check_in_date']));
$customer_hotel_check_out_date = date('d-M-Y',strtotime($voucher['customer_hotel_check_out_date']));
$id = $voucher['booking_id'];
$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	h1 {
		color: navy;
		font-family: times;
		font-size: 24pt;
		text-decoration: underline;
	}
	p.first {
		color: #003300;
		font-family: helvetica;
		font-size: 12pt;
	}
	p.first span {
		color: #006600;
		font-style: italic;
	}
	p#second {
		color: rgb(00,63,127);
		font-family: times;
		font-size: 12pt;
		text-align: justify;
	}
	p#second > span {
		background-color: #FFFFAA;
	}
	table.first {
		color: #003300;
		font-family: helvetica;
		font-size: 8pt;
		border-left: 2px solid #800080;
		border-right: 2px solid #800080;
		border-top: 2px solid #800080;
		border-bottom: 2px solid #800080;
		background-color: #ccffcc;
	}
	td {
		border: none;
		background-color: #ffffee;
	}
	td.second {
		border: 2px dashed green;
	}
	
	.innerTable{
		border: none;
		margin-top:-500px;
		padding:5px;
	}

	.innerTable td {
		border: none;
		background-color: #ffffee;
		padding:2px;
		font-family: helvetica;
		font-size: 8pt;		
	}
	.innerTable td.second {
		border: none;
	}

	div.test {
		color: #CC0000;
		background-color:#800080;
		font-family: helvetica;
		font-size: 10pt;
		border-style: solid solid solid solid;
		border-width: 2px 2px 2px 1px;
		border-color: #800080 #800080 #800080 #800080;
	}
	.lowercase {
		text-transform: lowercase;
	}
	.uppercase {
		text-transform: uppercase;
	}
	.capitalize {
		text-transform: capitalize;
	}
	.package_photo{
		margin-top:12px;margin-right:25px;width:300px;height:180px;
	}
	.PackageTable{
		border:1px solid #800080;
		border-right:1px solid #800080;
		padding:5px;

	}
	.PackageTable td{
		border:1px solid #800080;
		padding:2px;		
	}	

</style>
<body style="border:2px solid #800080;">
<div><img src="$app">
</div>

<br />
		<table width="100%"  class="innerTable">
		<tr>
			<td width="20%">
				<img src="$package_photo" class="package_photo" width="300px" height="180px">
			</td>
			<td width="2%"></td>
			<td width="400px" >
	

	<table class="PackageTable">
					<tr>
						<td width="40%"> 
							Date
						</td>
						<td width="40%"> $date </td>
					</tr>
					<tr>
						<td width="40%"> Customer Name </td>
						<td width="40%"> $customer_full_name </td>
					</tr>
					<tr>
						<td width="40%"> Customer Contact </td>
						<td width="40%"> $customer_contact_no </td>
					</tr>
					<tr>
						<td width="40%"> Tour Manager Name </td>
						<td width="40%"> $tour_manager_name </td>
					</tr>
					<tr>
						<td width="40%"> Tour Manager Contact </td>
						<td width="40%"> $tour_manager_contact_no </td>
					</tr>
					<tr>
						<td width="40%"> Emergency Contact No </td>
						<td width="40%"> $emergency_contact_no </td>
					</tr>
		</table>

			</td>
		</tr>
	</table>
	<br>
	<br>
	<br>
	<br>

<table class="first" cellpadding="4" cellspacing="6">
 <tr>
  <td width="30" align="center"><b>No.</b></td>
  <td width="140" align="center"><b>Tour Type</b></td>
  <td width="140" align="center"><b>Tour Name</b></td>
  <td width="80" align="center"> <b>Tour Date</b></td>
  <td width="80" align="center"><b>Meal Plan</b></td>
  <td width="90" align="center"><b>Travel Type</b></td>
 </tr>
 <tr>
  <td width="30" align="center">1.</td>
  <td width="140">$customer_tour_type</td>
  <td width="140">$customer_tour_name</td>
  <td width="80">$customer_tour_date</td>
  <td width="80">$meal_plan</td>
  <td align="center" width="90">$customer_travel_type</td>
 </tr>
 <tr style="border:none"></tr><tr style="border:none"></tr>
 <tr>
  <td width="90" align="center"><b>Hotel Name</b></td>
  <td width="115"><b>Place Name</b></td>
  <td width="100"><b>Hotel Contact No</b></td>
  <td width="75" align="center"><b>Room Type</b></td>
  <td width="90"><b>Check in Date</b></td>
  <td width="90"><b>Check Out Date</b></td>
 </tr>
<tr>
  <td width="90" align="center">$customer_hotel_name</td>
  <td width="115">$customer_hotel_place_name</td>
  <td width="100">$hotel_contact_no</td>
  <td align="center" width="75">$customer_room_type</td>
  <td width="90">$customer_hotel_check_in_date</td>
  <td width="90">$customer_hotel_check_out_date</td>
 </tr>
</table>
	<br>
	<br>
	<br>
	<br>

Customer  Signature :  <b><i><u>$customer_signature</u>.</i></b> 
	<br>
Company  Signature :  <b><i><u>$company_signature</u>.</i></b> 
</body>
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf_path = APP . 'webroot/files/voucher' . DS . $id;
createFolder($pdf_path); 
$pdf->Output($pdf_path . DS .''.'file.pdf', 'F');
?>
