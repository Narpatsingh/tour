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

$html .= '<div id="pdfDiv">';
$html .= '<div class="row">';
$html .= '<div class="col-xs-12">';
$html .= '<div class="box box-primary">';
$html .= '<div class="overflow-hide-break">';
$html .= '<div class="box-body userViewPage">';
$html .= '<h3>Tour Details</h3><hr>';
if (empty($package["Tour"])) { 
$html .= '<div class="col-md-12 col-sm-12">';
$html .= '<h5 style="color: chocolate;">'; 
$html .= 'No Tour found. </h5>';
$html .= '</div>';
} else { $tour = $package["Tour"];
$html .= '<ul>';
$html .= '<li> "Tour Title       : "'. $tour["name"]  .'</li>';
$html .= '<li> "Tour City        : "'. $tour["city"]  .'</li>';
$html .= '<li> "Tour State       : "'. $tour["state"]  .'</li>';
$html .= '<li> "Tour Place       : "'. $tour["place"]  .'</li>';
$html .= '<li> "Tour Total Price : "'. $tour["price"] .'</li>';
$html .= '<li> "Tour Description : "'. $tour["description"]  .'</li>';
$html .= '<li> "Tour Total Days  : "'. $tour["days"] .'</li>';
$html .= '<li> "Tour Total Nights: "'. $tour["nights"] .'</li>';
$html .= '</ul>';
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
$html .= '<div class="box-body userViewPage">';
$html .= '<h3>Highlight Details</h3><hr>';
if (empty($package["Highlight"])) {
$html .= '<div class="col-md-12 col-sm-12">';
$html .= '<h5 style="color: chocolate;"> No Highlights found. </h5>';
$html .= '</div>';
} else { 
foreach ($package["Highlight"] as $highlight) { 
$html .= '<ul>';
$html .= '<li>'. $highlight["title"]. '</li>';
$html .= '</ul>';
}
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
$html .= '<div class="box-body userViewPage">';
$html .= '<h3>Itinerary Details</h3><hr>';
$html .= '<div class="row">';
if (empty($package["Itinerary"])) {
$html .= '<div class="col-md-12 col-sm-12">';
$html .= '<h5 style="color: chocolate;"> No Itinerary found. </h5>';
$html .= '</div>';
} else { 
foreach ($package["Itinerary"] as $itinerary) {
$html .= '<div class="col-md-12 col-sm-12">';
$html .= '<div class="desc">';
$html .= '<h3>Day '. $itinerary["day"].'</h3>';
$html .= '<h4>Title :  '.$itinerary["title"].'."('.$itinerary["km"].'kms /'.$itinerary["hour"].'hrs)</h4>';
$html .= '<p style="padding-right: 60px;"><b>Description : </b>'.$itinerary["description"].'</p>';
$html .= '</div>';
$html .= '</div>';
}
}   
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
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
