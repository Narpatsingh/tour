<?php 
App::import('Vendor','xtcpdf');
$pdf = new XTCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false); 
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Amuk Saxena');
$pdf->SetTitle('Silshine');
$pdf->SetSubject('Silshine Invoice');
$pdf->SetKeywords('Silshine');
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT); 
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->AddPage();

$html .= '<div class="row">';
$html .= '<div class="col-xs-12">';
$html .= '<div class="box" style="background:#800080 !important;padding:2px !important;">';
$html .= '<h1 style="font-family:Lobster,cursive !important;color:white !important;padding:2px 2px 2px 20px !important;">Silshine Trip</h1>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="row">';
$html .= '<div class="col-xs-12">';
$html .= '<div class="box box-primary">';
$html .= '<div class="overflow-hide-break">';
$html .= '<div class="box-body EnquiryViewPage">';
$html .= '<h3>Enquiry Details</h3><hr>';
if (empty($enquiry)) { 
$html .= '<div class="col-md-12 col-sm-12">';
$html .= '<h5 style="color: chocolate !important;"> "No Enquiry found." </h5>';
$html .= '</div>';
} else {
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Customer Name</th>';
$html .= '<td style="padding:5px !important;">'.$enquiry['Customer']['name'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Customer Email</th>';
$html .= '<td style="padding:5px !important;">'.$enquiry['Customer']['email'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Customer Mobile</th>';
$html .= '<td style="padding:5px !important;">'.$enquiry['Customer']['mobile'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Customer Address</th>';
$html .= '<td style="padding:5px !important;">'.$enquiry['Customer']['address'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Customer DOB</th>';
$html .= '<td style="padding:5px !important;">'.$enquiry['Customer']['dob'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Total Members</th>';
$html .= '<td style="padding:5px !important;">'.$enquiry['Enquiry']['number_of_guest'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Customer Emergency Contact</th>';
$html .= '<td style="padding:5px !important;">'.$enquiry['Customer']['emergency_mobile'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Customer Proof</th>';
$html .= '<td style="padding:5px !important;">'.$enquiry['Customer']['dob_proof'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Number Of Month</th>';
$html .= '<td style="padding:5px !important;">'.$enquiry['Enquiry']['number_of_month'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Customer Experience</th>';
$html .= '<td style="padding:5px !important;">'.$enquiry['Enquiry']['experience'].'</td>';
$html .= '</tr>';
$html .= '</table>';

}      
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="row">';
$html .= '<div class="col-xs-12">';
$html .= '<div class="box box-primary">';
$html .= '<div class="overflow-hide-break">';
$html .= '<div class="box-body EnquiryViewPage">';
$html .= '<h3>Package Details</h3><hr>';
$html .= '<div class="row">';
if (empty($package)) { 
$html .= '<div class="col-md-12 col-sm-12">';
$html .= '<h5 style="color: chocolate;"> "No Package found."  </h5>';
$html .= '</div>';
} else  { 
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Package Name</th>';
$html .= '<td style="padding:5px !important;">'.$package['Tour']['name'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Package Type</th>';
$html .= '<td style="padding:5px !important;">'.$package['Tour']['type'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Package City</th>';
$html .= '<td style="padding:5px !important;">'.$package['City']['name'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Package State</th>';
$html .= '<td style="padding:5px !important;">'.$package['State']['name'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Package Place</th>';
$html .= '<td style="padding:5px !important;">'.$package['Tour']['place'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Package Cost</th>';
$html .= '<td style="padding:5px !important;">'.$package['Tour']['price'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Package Discount</th>';
$html .= '<td style="padding:5px !important;">'.$package['Tour']['discount'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Package Description</th>';
$html .= '<td style="padding:5px !important;">'.$package['Tour']['description'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Total Days</th>';
$html .= '<td style="padding:5px !important;">'.$package['Tour']['days'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th style="text-align:left; padding:5px !important;">Total Nights</th>';
$html .= '<td style="padding:5px !important;">'.$package['Tour']['nights'].'</td>';
$html .= '</tr>';
$html .= '</table>                        ';
}    
$html .= '</div>    ';
$html .= '</div>    ';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="row">';
$html .= '<div class="col-xs-12">';
$html .= '<div class="box box-primary">';
$html .= '<div class="overflow-hide-break">';
$html .= '<div class="box-body userViewPage">';
$html .= '<h3>Highlight Details</h3><hr>';
if (empty($package['Highlight'])) { 
$html .= '<div class="col-md-12 col-sm-12">';
$html .= '<h5 style="color: chocolate;"> "No Highlights found."  </h5>';
$html .= '</div>';
} else { 
foreach ($package['Highlight'] as $highlight) { 
$html .= '<ul>';
$html .= '<li>'.$highlight['title'].'</li>';
$html .= '</ul>';
}
}      
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>                     ';
$html .= '<div class="row">';
$html .= '<div class="col-xs-12">';
$html .= '<div class="box box-primary">';
$html .= '<div class="overflow-hide-break">';
$html .= '<div class="box-body userViewPage">';
$html .= '<h3>Itinerary Details</h3><hr>';
$html .= '<div class="row">';
if (empty($package['Itinerary'])) { 
$html .= '<div class="col-md-12 col-sm-12">';
$html .= '<h5 style="color: chocolate;"> "No Itinerary found."  </h5>';
$html .= '</div>';
} else { 
foreach ($package['Itinerary'] as $itinerary) { 
$html .= '<div class="col-md-12 col-sm-12">';
$html .= '<div class="desc">';
$html .= '<h3>Day '. $itinerary['day'] ; 
$html .= '</h3>';
$html .= '<h4>Title : '.$itinerary['title'].'('.$itinerary['km'].'kms / '.$itinerary['hour'].'hrs)'.'</h4>';
$html .= '<p style="padding-right: 60px;"><b>Description : </b>'. $itinerary['description'].'</p>';
$html .= '</div>';
$html .= '</div>';
}
}    
$html .= '</div>    ';
$html .= '</div>    ';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
$pdf_path = APP . 'webroot/files/pdf' . DS . $id;
createFolder($pdf_path); 
$pdf->Output($pdf_path . DS .''.'file.pdf', 'F');
?>
