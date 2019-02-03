d<?php
App::import('Vendor','xtcpdf');
$app = APP.'webroot/img/pdf_logo.jpg';
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
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style
$date = date("d-M-Y");
$customer_signature = $voucher['customer_signature'];
$company_signature = $voucher['company_signature'];
$customer_full_name = $voucher['customer_full_name'];
$customer_tour_type = $voucher['customer_tour_type'];
$customer_tour_name = $voucher['customer_tour_name'];
$payment_type = $voucher['payment_type'];
$total_payment = $voucher['total_payment'];
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
		border-left: 3px solid #800080;
		border-right: 3px solid #800080;
		border-top: 3px solid #800080;
		border-bottom: 3px solid #800080;
		background-color: #ccffcc;
	}
	td {
		border: 2px solid blue;
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

</style>


<div><img src="$app">
</div>
<h2>Receipt</h2>
<br />
		<table width="100%"  class="innerTable">
		<tr>
			<td width="20%">
				
			</td>
		</tr>
		<tr>
			<td width="400px" >
	

	<table class="innerTable">
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
						<td width="40%"> Customer Tour Type </td>
						<td width="40%"> $customer_tour_type </td>
					</tr>
					<tr>
						<td width="40%"> Tour Name </td>
						<td width="40%"> $customer_tour_name </td>
					</tr>
					<tr>
						<td width="40%"> Payment Type </td>
						<td width="40%"> $payment_type </td>
					</tr>
					<tr>
						<td width="40%"> Payment Amount </td>
						<td width="40%"> $total_payment </td>
					</tr>
		</table>

			</td>
		</tr>
	</table>
	<br>
	<br>
	<br>
	<br>
	<br>
Customer  Signature :  <b><i><u>$customer_signature</u>.</i></b> 
	<br><br>
Company  Signature :  <b><i><u>$company_signature</u>.</i></b> 
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf_path = APP . 'webroot/files/receipt' . DS . $id;
createFolder($pdf_path); 
$pdf->Output($pdf_path . DS .''.'file.pdf', 'F');

echo $html; exit;
?>