<?php
require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php'); 

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->load_html($content_for_layout);

// (Optional) Setup the paper size and orientation
$dompdf->set_paper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
exit(0);
?>