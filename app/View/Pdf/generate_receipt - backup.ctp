<html>
<head>
	<meta http-equiv="Content-Type" content="charset=utf-8" />
</head>
<style type="text/css"> .vatHeader {background-color: #e1e1e1} .logoheader {background-color: #800080; } .backColor {border: 1px solid #ccc; } .backColor-border {border-bottom: 1px solid #ccc; } footer {left: 0px; right: 0px; bottom: -60px; height: 110px; position: fixed; } .site_name {margin-top: -2.2%; color: #fff; padding: 15px; } .silshine_logo {height: 36px; width: 90px; padding:1.5%; } .mdg-logo{margin-left:2%;} .tour_picture{margin-top:12px;margin-right:25px;}
</style> <body>
	<div class="col-md-12 logoheader">
	<div class="mdg-logo">
	<img src="<?=$this->webroot?>img/logo.png" width="300px" height="80px" class="silshine_logo">
	<p class="site_name">Silshine Trip</p>
	</div>
	</div>
	<table width="100%">
		<tr>
			<td width="20%">
				<img src="<?=$this->webroot?>img/../images/packages/154838479602854_HD.jpg" width="300px" height="180px" class="tour_picture"><p class="site_name">Silshine Trip</p>
			</td>
			<td width="400px" >
				<table style="margin-top:-30px; font-size:20px; border: 1px solid #ccc; padding: 20px; width: 550px;">
					<tr>
						<td width="40%"> 
							Date
						</td>
						<td width="40%"> <?php echo date('d-M-Y'); ?> </td>
					</tr>
					<tr>
						<td width="40%"> 
							Customer Name
						</td>
						<td width="40%"> Ajay Manesh Koli. </td>
					</tr>
					<tr>
						<td width="40%"> Customer Contact </td>
						<td width="40%"> 9904439004 </td>
					</tr>
					<tr>
						<td width="40%"> Tour Manager Name </td>
						<td width="40%"> Narpat Bandiya </td>
					</tr>
					<tr>
						<td width="40%"> Tour Manager Contact </td>
						<td width="40%"> 9876543215 </td>
					</tr>
					<tr>
						<td width="40%"> Emergency Contact No </td>
						<td width="40%"> 18003562487 </td>
					</tr>
				</table>
			</td>
		</tr>
		<!-- Break -->
		<tr>
			<td>
				<br>
			</td>
			<td>
				<br>
			</td>
			<td>
				<br>
			</td>
		</tr>
		
		<!-- Break -->
		<tr>
			<td>
				<br>
			</td>
			<td>
				<br>
			</td>
			<td>
				<br>
			</td>
		</tr>
		<!-- Table row for plan description -->
		<tr>
			<td colspan="3">
				<table cellpadding="10" cellspacing="0" class="backColor">
					<tr class="vatHeader">
						<td width="450px" class="backColor"> planDescription </td>
						<td width="200px" class="backColor"> unitPrice 125 </td>
						<td width="110px" class="backColor"> quantity 10 </td>
						<td width="210px" class="backColor"> priceBeforeVat 100 </td>
					</tr>
					<tr>
						<td width="450px" class="backColor" style="font-size:20px;"> Nom de labonnement /
							<br>
							<i>Subscription Name</i> - planDataName
							<br> Durée dengagement / 
							<br>
							<i>Period of engagement </i> - 5 
							<br> Date de début / 
							<br>
							<i>Start Date </i> - 24-04-2019
							<br> Date de fin / 
							<br>
							<i>End Date </i> - 24-04-2019 
						</td>
						<td width="200px" class="backColor" style="text-align: center;"> Test </td>
						<td width="110px" class="backColor" style="text-align: center;"> 1 </td>
						<td width="210px" class="backColor" style="text-align: center;"> 65 </td>
					</tr>
				</table>
			</td>
		</tr>
		<!-- Break -->
		<tr>
			<td>
				<br>
			</td>
			<td>
				<br>
			</td>
			<td>
				<br>
			</td>
		</tr>
		<!-- Break -->
		<tr>
			<td>
				<br>
			</td>
			<td>
				<br>
			</td>
			<td>
				<br>
			</td>
		</tr>
		<!-- Table row for price details -->
		
		<!-- Break -->
		<tr>
			<td>
				<br>
			</td>
			<td>
				<br>
			</td>
			<td>
				<br>
			</td>
		</tr>

		<tr>
			<td>
				<br>
			</td>
			<td>
				<br>
			</td>
			<td>
				<br>
			</td>
		</tr>
		
	</table>
	<br>
	<br>
<!-- 	<div>
		<b> Note: </b> Payments are not refundable. 
	</div> -->
	<footer>
		<hr width="100%">
		<center>
			<font size="3">
				<b> Silshine Tour - This is dummy Address, India. </b>
			</font>
			<br>
			<font size="2"> http://silshinetrip.com </font>
			<br>
			<font size="2"> SilshineTour </font>
		</center>
	</footer>
</body>
</html>

<?php
exit;
/*
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

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
$pdf_path = APP . 'webroot/files/receipt' . DS . $id;
createFolder($pdf_path); 
$pdf->Output($pdf_path . DS .''.'file.pdf', 'F');*/
?>