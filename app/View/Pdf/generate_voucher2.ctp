<?php
App::import('Vendor','xtcpdf');
$app = APP.'webroot/img/voucher_logo.png';
$pdf = new XTCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false); 
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Silshine');
$pdf->SetTitle('Silshine Voucher');
$pdf->SetSubject('Silshine Voucher');
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
$customer_full_name = $voucher['customer_full_name'];
$customer_contact_no = $voucher['customer_contact_no'];
$tour_manager_name = $voucher['tour_manager_name'];
$tour_manager_contact_no = $voucher['tour_manager_contact_no'];
$emergency_contact_no = $voucher['emergency_contact_no'];

$package_photo = APP.'webroot/'.$voucher['tour_photo'];
$customer_tour_type = $voucher['customer_tour_type'];
$customer_tour_name = $voucher['customer_tour_name'];
$customer_tour_date = date('d-M-Y',strtotime($voucher['customer_tour_date']));
$meal_plan = $voucher['meal_plan'];
$customer_travel_type = $voucher['customer_travel_type'];
$customer_hotel_name = $voucher['customer_hotel_name'];
$customer_hotel_place_name = $voucher['customer_hotel_place_name'];
$hotel_contact_no = $voucher['hotel_contact_no'];
$customer_room_type = $voucher['customer_room_type'];
$special_remarks = "Special remarks : ".$voucher['special_remarks'];$special_remarks = "Special remarks : ".$voucher['special_remarks'];
// $customer_hotel_check_in_date = date('d-M-Y',strtotime($voucher['customer_hotel_check_in_date']));
// $customer_hotel_check_out_date = date('d-M-Y',strtotime($voucher['customer_hotel_check_out_date']));

$package_photo2 = APP.'webroot/'.$voucher['tour_photo2'];
$customer_tour_type2 = $voucher['customer_tour_type2'];
$customer_tour_name2 = $voucher['customer_tour_name2'];
$customer_tour_date2 = date('d-M-Y',strtotime($voucher['customer_tour_date2']));
$meal_plan2 = $voucher['meal_plan2'];
$customer_travel_type2 = $voucher['customer_travel_type2'];
$customer_hotel_name2 = $voucher['customer_hotel_name2'];
$customer_hotel_place_name2 = $voucher['customer_hotel_place_name2'];
$hotel_contact_no2 = $voucher['hotel_contact_no2'];
$customer_room_type2 = $voucher['customer_room_type2'];
// $customer_hotel_check_in_date2 = date('d-M-Y',strtotime($voucher['customer_hotel_check_in_date2']));
// $customer_hotel_check_out_date2 = date('d-M-Y',strtotime($voucher['customer_hotel_check_out_date2']));
$id = $voucher['booking_id'];

//ToDo Display available hotels.
$hotel_data = '';$hsr = 1;
if (!empty($hotels_data)) {
		sort($hotels_data);
		$hotel_data .= '<br><br><br><br><br><br>';
		$hotel_data .= '<h4>Hotel Details:</h4>';
		$hotel_data .= '<table border="1" style="width:100%;padding:5px;" nobr="true">';
		$hotel_data .= '<thead>';
		$hotel_data .= '<tr>';
		$hotel_data .= '<th><b>No.</b></th>';
		$hotel_data .= '<th><b>Country</b></th>';
		$hotel_data .= '<th><b>State</b></th>';
		$hotel_data .= '<th><b>City</b></th>';
		$hotel_data .= '<th><b>Hotel Name</b></th>';
		$hotel_data .= '<th><b>Contact No</b></th>';
		$hotel_data .= '<th><b>Check In</b></th>';
		$hotel_data .= '<th><b>Check Out</b></th>';
		$hotel_data .= '<th><b>Meal Plan</b></th>';
		$hotel_data .= '</tr>';
		$hotel_data .= '</thead>';
		$hotel_data .= '<tbody>';

	foreach ($hotels_data as $key => $hotel) {

		$hotel_data .= '<tr>';
		$hotel_data .= '<td>'.$hsr++.'</td>';
		$hotel_data .= '<td>India</td>';
		$hotel_data .= '<td>'.$hotel['State']['name'].'</td>';
		$hotel_data .= '<td>'.$hotel['City']['name'].'</td>';
		$hotel_data .= '<td>'.$hotel['Hotel']['name'].'</td>';
		$hotel_data .= '<td>'.$hotel['HotelData']['hotel_contact_no'].'</td>';
		$hotel_data .= '<td>'.date('d-M-Y',strtotime($hotel['HotelData']['hotel_check_in_date'])).'</td>';
		$hotel_data .= '<td>'.date('d-M-Y',strtotime($hotel['HotelData']['hotel_check_out_date'])).'</td>';
		$hotel_data .= '<td>'.$hotel['Hotel']['meal_plan'].'</td>';
		$hotel_data .= '</tr>';
	}
	foreach ($hotels_data2 as $key => $hotel) {

		$hotel_data .= '<tr>';
		$hotel_data .= '<td>'.$hsr++.'</td>';
		$hotel_data .= '<td>India</td>';
		$hotel_data .= '<td>'.$hotel['State']['name'].'</td>';
		$hotel_data .= '<td>'.$hotel['City']['name'].'</td>';
		$hotel_data .= '<td>'.$hotel['Hotel']['name'].'</td>';
		$hotel_data .= '<td>'.$hotel['HotelData']['hotel_contact_no'].'</td>';
		$hotel_data .= '<td>'.date('d-M-Y',strtotime($hotel['HotelData']['hotel_check_in_date'])).'</td>';
		$hotel_data .= '<td>'.date('d-M-Y',strtotime($hotel['HotelData']['hotel_check_out_date'])).'</td>';
		$hotel_data .= '<td>'.$hotel['Hotel']['meal_plan'].'</td>';
		$hotel_data .= '</tr>';
	}	
		$hotel_data .= '</tbody>';
		$hotel_data .= '</table>';
}
$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<div><img src="$app">
</div>
<table style="width:100%;">
	<tr>
		<td><b>Customer Name</b> </td>
		<td> <b>:</b> $customer_full_name </td>
		<td><b>Tour Manager Contact</b></td>
		<td> <b>:</b> $tour_manager_contact_no</td>
		<td><b>Customer Contact</b></td>
		<td> <b>:</b> $customer_contact_no</td>
	</tr>	
</table>
<table style="width:100%;">
	<tr>
		<td><b>Emergency Contact </b> </td>
		<td><b> :</b> $emergency_contact_no </td>
		<td><b>Tour Manager Name</b></td>
		<td> <b>:</b> $tour_manager_name </td>
		<td><b>Generated Date</b></td>
		<td> <b>:</b> $date</td>
	</tr>
</table>
		<br><br>
		<table width="100%"  class="innerTable">
		<tr>
			<td style="margin-right:12px; padding-top:10px; padding-bottom:20px;">
				<img src="$package_photo" class="package_photo" width="460px" height="150px">
			</td>
		
			<td style="margin-right:12px; padding-top:10px; padding-bottom:20px;">
				<img src="$package_photo2" class="package_photo" width="460px" height="150px">
			</td>
		</tr>
		</table>
	<br><br>
	
<table class="first" border="1" style="padding:5px;" nobr="true">
 <thead>
 <tr>
  <th align="center"><b>No.</b></th>
  <th align="center"><b>Tour Type</b></th>
  <th align="center"><b>Tour Name</b></th>
  <th align="center"> <b>Tour Date</b></th>
  <th align="center"><b>Meal Plan</b></th>
  <th align="80"><b>Travel Type</b></th>
  <th><b>Place Name</b></th>
  <th align="center"><b>Room Type</b></th>
 </tr>
 </thead>
 <tbody>
 <tr>
  <td align="center">1</td>
  <td>$customer_tour_type</td>
  <td>$customer_tour_name</td>
  <td>$customer_tour_date</td>
  <td>$meal_plan</td>
  <td align="center">$customer_travel_type</td>
  <td>$customer_hotel_place_name</td>
  <td align="center">$customer_room_type</td>
 </tr>

 <tr>
  <td align="center">2</td>
  <td>$customer_tour_type2</td>
  <td>$customer_tour_name2</td>
  <td>$customer_tour_date2</td>
  <td>$meal_plan2</td>
  <td align="center">$customer_travel_type2</td>
  <td>$customer_hotel_place_name2</td>
  <td align="center">$customer_room_type2</td>
 </tr>

 </tbody>
 <tr style="border:none"></tr><tr style="border:none"></tr>
</table>
<br>
<br>
<br>
<table style="line-height:10px;width: 120%;">
	<tr>
	<td style="float:left;">	
	$special_remarks
	</td>
	</tr>
</table>
<br>
<br>
<table style="line-height:10px;width: 167%;">
	<tr>
	<td style="float:left;">	
	Customer  Signature :  <b><i><u>$customer_signature</u>.</i></b> 
	</td>
	<td style="float:right;">	
	Company  Signature :  <b><i><u>$company_signature</u>.</i></b>
	</td>
	</tr>
</table>
<br>
<hr>
<p>This voucher is auto generated by system.</p>

EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf_path = APP . 'webroot/files/voucher' . DS . $id;
createFolder($pdf_path); 
$pdf->Output($pdf_path . DS .''.'voucher.pdf', 'F');
?>