<?php 
App::import('Vendor','xtcpdf');
$pdf = new XTCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false); 
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Amuk Saxena');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Invoice Receipt');
$pdf->SetKeywords('Invoice');
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->AddPage();
$html = '';
$html .= '<div class="row">';
$html .= '<div class="col-xs-12">';
$html .= '<div class="box" style="background:#800080 !important;padding:2px !important;">';
$html .= '<h1 style="font-family:Lobster,cursive !important;color:white !important;padding:2px 2px 2px 20px !important;">Silshine Trip</h1>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '<div id="invoice-POS">';

$html .= '<div id="mid">';
$html .= '<div class="info">';
$html .= '<h2>Contact Info</h2>';
$html .= '<p> ';
$html .= 'Address : street city, state 0000</br>';
$html .= 'Email   : JohnDoe@gmail.com</br>';
$html .= 'Phone   : 555-555-5555</br>';
$html .= '</p>';
$html .= '</div>';
$html .= '</div>';

$html .= '<div id="bot">';
$html .= '<div id="table">';
$html .= '<table>';
$html .= '<tr class="tabletitle">';
$html .= '<td class="item"><h2>Package</h2></td>';
$html .= '<td class="Hours"><h2>Days</h2></td>';
$html .= '<td class="Rate"><h2>Sub Total</h2></td>';
$html .= '</tr>';

$html .= '<tr class="service">';
$html .= '<td class="tableitem"><h3 class="itemtext">'.$package['Tour']['name'].'</h3></td>';
$html .= '<td class="tableitem"><h3 class="itemtext">'.$package['Tour']['days'].'</h3></td>';
$html .= '<td class="tableitem"><h3 class="itemtext">Rs. '.$package['Tour']['price'].'</h3></td>';
$html .= '</tr>';

$html .= '<tr class="tabletitle">';
$html .= '<td></td>';
$html .= '<td class="Rate"><h2>tax</h2></td>';
$html .= '<td class="payment"><h2>N\A</h2></td>';
$html .= '</tr>';

$html .= '<tr class="tabletitle">';
$html .= '<td></td>';
$html .= '<td class="Rate"><h2>Total</h2></td>&nbsp;&nbsp;&nbsp;';
$html .= '<td class="payment"><h2>Rs. '.$package['Tour']['price'].'</h2></td>';
$html .= '</tr>';

$html .= '</table>';
$html .= '</div>';

$html .= '<div id="legalcopy">';
$html .= '<p class="legal"><strong>Thank you for your contact!</strong>  Payment is in form of invoice.
</p>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
$pdf_path = APP . 'webroot/files/receipt' . DS . $id;
createFolder($pdf_path); 
$pdf->Output($pdf_path . DS .''.'file.pdf', 'F');
?>