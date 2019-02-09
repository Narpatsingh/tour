<?php
App::import('Vendor','xtcpdf');
$app = APP.'webroot/files/logo/reciept-mini-logo.jpg';
$pdf = new XTCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false); 
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 061');
$pdf->SetSubject('TCPDF Tutorial');
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

// define some HTML content with style
$date = date("d-M-Y");
$all_t_and_c = $voucher['all_t_and_c'];
$payment_recieved = $voucher['payment_recieved'];
$customer_signature = $voucher['customer_signature'];
$company_signature = $voucher['company_signature'];
$customer_full_name = $voucher['customer_full_name'];
$invoice_no = $voucher['invoice_no'];
$customer_tour_type = $voucher['customer_tour_type'];
$customer_tour_name = $voucher['customer_tour_name'];
$customer_contact_no = $voucher['customer_contact_no'];
$payment_type = $voucher['payment_type'];
$total_payment = $voucher['total_payment_sum'];
$final_total_payment = $voucher['final_payment_with_gst'];
$gst_percent = $voucher['gst_percent'];
$id = $voucher['booking_id'];
$html = <<<EOF
<img src="$app" style="float: right; margin-right: 25%; margin-top: 3.3%;">
	<span class="logo-desc" style="font-family: Lobster,cursive !important; color: gray; margin: 5% 0% 0% 74.8%; position: fixed;">Travel and Tours</span>
	<p class="logo-text" style="position: fixed; margin: 2.5% 0% 0% 74.5%; font-size: 2.3em; font-family: cursive;">Silshine</p>
	<div class="table-contain" style="margin: 5% 0% 0% 20%; position: fixed;">
	<center><h2><u>Receipt</u></h2></center>
	<br>
		
		<table style="border:1px solid gray; width:106%;">
			<thead>
				<th style="border-bottom:1px solid gray;">Customer Name</th>
				<th style="border-bottom:1px solid gray;">Customer Tour Type</th>
				<th style="border-bottom:1px solid gray;">Tour Name</th>
				<th style="border-bottom:1px solid gray;">Contact Number</th>
				<th style="border-bottom:1px solid gray;">Payment Recieved</th>
				<th style="border-bottom:1px solid gray;"></th>
			</thead>
			<tbody>
				<td style="padding:25px; text-align:center;"><?=$customer_full_name?></td>
				<td style="padding:25px; text-align:center;"><?=$customer_tour_type?></td>
				<td style="padding:25px; text-align:center;"><?=$customer_tour_name?></td>
				<td style="padding:25px; text-align:center;"><?=$customer_contact_no?></td>
				<td style="padding:25px; text-align:center;"><?=$payment_recieved?></td>
			</tbody>
		</table>
		<br>
		<br>
		<table style="border:1px solid gray; width:106%;">
			<thead>
				<th style="border-bottom:1px solid gray;">Invoice No.</th>
				<th style="border-bottom:1px solid gray;">Date</th>
				<th class="mar-rgt" style="border-bottom:1px solid gray;">Payment Type</th>
				<th class="mar-rgt" style="border-bottom:1px solid gray;">Payment Amount</th>
				<th class="mar-rgt" style="border-bottom:1px solid gray;">Payment Amount with GST(<?=$gst_percent?>%)</th>
				<th style="border-bottom:1px solid gray;"></th>
			</thead>
			<tbody>
				<td style="padding:25px; text-align:center;"><?=$invoice_no?></td>
				<td style="padding:25px; text-align:center;"><?=$date?></td>
				<td style="padding:25px; text-align:center;" class="pad-two"><?=$payment_type?></td>
				<td style="padding:25px; text-align:center;" class="pad-two"><?=$total_payment?></td>
				<td style="padding:25px; text-align:center;" class="pad-two"><?=$final_total_payment?></td>
			</tbody>
		</table>

		<div class="t_c" style="margin: 4% 0% 0% 0%; float:left;"> 
			<?=$all_t_and_c?>
		</div>
		<div class="address" style="width:300px; float:right; margin: 3% 0% 0% 0%;">
		<p>
			<b>Office:</b>
			501/6, Bhakti Dharm Township, Palanpur, Canal Road, Jahangirabad, Surat.
			<b>Contact No:</b>
			8733897945 / 8758368590
			<b>Email:</b>
			<span class="email" style="font-size: large; font-style: italic; font-family: inherit; -webkit-font-smoothing: subpixel-antialiased; font-weight: 600;">silshinetrip@gmail.com</span>
		</p>
		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
	Customer  Signature :  <b><i><u><?=$customer_signature?></u>.</i></b> 
		<br><br>
	Company  Signature :  <b><i><u><?=$company_signature?></u>.</i></b>
	</div>
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf_path = APP . 'webroot/files/receipt' . DS . $id;
createFolder($pdf_path); 
$pdf->Output($pdf_path . DS .''.$invoice_no.'.pdf', 'I');
echo $html; exit;
?>