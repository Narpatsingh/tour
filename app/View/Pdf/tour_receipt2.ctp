<?php
App::import('Vendor','xtcpdf');
$app = APP.'webroot/img/tour_head_logo.png';
$rupee = APP.'webroot/img/rupee.png';
$pdf = new XTCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false); 
// set document information 
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SilShine');
$pdf->SetTitle('SilShine');
$pdf->SetSubject('Invoice Receipt');
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
 * External CSS $invoice_no will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */


// define variables.
$date = date("d-M-Y");
$all_t_and_c = $voucher['all_t_and_c'];
$payment_recieved = $voucher['payment_recieved'];
$customer_signature = $voucher['customer_signature'];
$company_signature = $voucher['company_signature'];
$customer_full_name = $voucher['customer_full_name'];
$invoice_no = $voucher['invoice_no'];
$customer_tour_type = $voucher['customer_tour_type'];
$customer_tour_name = $voucher['customer_tour_name'];
$customer_tour_name2 = $voucher['customer_tour_name2'];
$cus_total_payment = $voucher['total_payment'];
$cus_total_payment2 = $voucher['total_payment2'];
$customer_contact_no = $voucher['customer_contact_no'];
$payment_type = $voucher['payment_type'];
$total_payment = $voucher['total_payment_sum'];
$final_total_payment = $voucher['final_payment_with_gst'];
$gst_percent = $voucher['gst_percent'];
$id = $voucher['booking_id'];
$ac_id = $voucher['ac_id'];
$redirect = $voucher['redirect'];
$gst_amount = $final_total_payment-$total_payment;
$gst_total = get_total_gst($cus_total_payment,$gst_percent);
$gst_total2 = get_total_gst($cus_total_payment2,$gst_percent);
$cus_final_total_payment = get_gst_amount($cus_total_payment,$gst_percent);
$cus_final_total_payment2 = get_gst_amount($cus_total_payment2,$gst_percent);
$grand_total = $final_total_payment-$payment_recieved;
// define some HTML content with style
$html = <<<EOF
<img src="$app">
<br><br>
<table style"width:120%;">
	<tr>
		<td><b>Invoice No</b></td>
		<td> <b>: </b> $invoice_no</td>
		<td><b>Customer Name</b></td>
		<td><b>: </b>$customer_full_name</td>
	</tr>	
</table>
<table style"width:120%;">
	<tr>
		<td><b>Contact Number</b></td>
		<td><b>: </b>$customer_contact_no</td>
		<td><b>Date</b></td>
		<td><b>: </b>$date</td>
	</tr>
</table>
<br>
<br>
<table border="1" style="padding:5px;">
	<thead>
		<tr>
		<th style="width:35px">No.</th>
		<th style="width:25%">Tour Name</th>
		<th>Payment Type</th>
		<th>Payable Amount</th>
		<th>GST($gst_percent%)</th>
		<th style="width:21.5%">Total</th>
		</tr>
	</thead>
	<tbody>
		<tr>
		<td style="width:35px;">1</td>
		<td style="width:25%">$customer_tour_name</td>
		<td class="pad-two">$payment_type</td>
		<td>$cus_total_payment</td>
		<td>$gst_total</td>
		<td style="width:21.5%">$cus_final_total_payment</td>
		</tr>
		<tr>
		<td style="width:35px;">2</td>
		<td style="width:25%">$customer_tour_name2</td>
		<td class="pad-two">$payment_type</td>
		<td>$cus_total_payment2</td>
		<td>$gst_total2</td>
		<td style="width:21.5%">$cus_final_total_payment2</td>
		</tr>
	</tbody>
</table>
<table style="border:1px solid black; width:100.3%; padding:5px;">
	<tr>
		<td colspan="6" align="right" style="padding:25px; text-align:right;"><b>GRAND TOTAL</b>: &nbsp;&nbsp;<img src="$rupee" width="10" height="10">&nbsp;$final_total_payment</td>
	</tr>	
</table>
<table style="border:1px solid black; width:100.3%; padding:5px;">
	<tr>
		<td colspan="6" align="right" style="padding:25px; text-align:right;"><b>AMOUNT PAID</b>: &nbsp;&nbsp;<img src="$rupee" width="10" height="10">&nbsp;$payment_recieved</td>
	</tr>	
</table>
<table style="border:1px solid black; width:100.3%; padding:5px;">
	<tr>
		<td colspan="6" align="right" style="padding:25px; text-align:right;"><b>AMOUNT REMAINING</b>: &nbsp;&nbsp;<img src="$rupee" width="10" height="10">&nbsp;$grand_total</td>
	</tr>	
</table>
<br>
<br>
<br>
<table style="line-height:10px;width: 120%;">
	<tr>
	<td style="float:left;">	
	Customer  Signature :  <b><i><u>$customer_signature</u>.</i></b> 
	</td>
	<td style="float:right;">	
	Company  Signature :  <b><i><u>$company_signature</u>.</i></b>
	</td>
	</tr>
</table>
<hr>
<p>This form is auto generated by system.</p>
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf_path = APP . 'webroot/files/receipt' . DS . $ac_id;
createFolder($pdf_path); 
$pdf->Output($pdf_path . DS .''.$invoice_no.'.pdf', 'F');
?>