<?php 
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
$customer_contact_no = $voucher['customer_contact_no'];
$payment_type = $voucher['payment_type'];
$total_payment = $voucher['total_payment_sum'];
$final_total_payment = $voucher['final_payment_with_gst'];
$gst_percent = $voucher['gst_percent'];
$id = $voucher['booking_id'];
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Two tables and header with jspdf-autotable</title> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
  
</head>

<style type="text/css">
	.t_c{
    margin: 4% 0% 0% 0%;		
    float:left;
	}
	.address{
		width:300px;
		float:right;
		margin: 3% 0% 0% 0%;
	}
	.email{
	font-size: large;
    font-style: italic;
    font-family: inherit;
    -webkit-font-smoothing: subpixel-antialiased;
    font-weight: 600;		
	}
	.mini-logo{
    float: right;
    margin-right: 25%;
    margin-top: 3.3%;
	}	
	/*.mar-rgt{
		padding:0% 0% 0% 0%;
	}
	.pad-two{
		padding:0% 0% 0% 0%;
	}*/
	.logo-text{
	position: fixed;
    margin: 2.5% 0% 0% 74.5%;
    font-size: 2.3em;
    font-family: cursive;	
	}
	.logo-desc{
	font-family: Lobster,cursive !important;
    color: gray;
    margin: 5.3% 0% 0% 74.8%;
    position: fixed;		
	}
	.table-contain{
    margin: 5% 0% 0% 20%;
    position: fixed;		
	}
	table{
		border:1px solid gray;
		width:106%;
	}
	th{
		border-bottom:1px solid gray;
	}
	td{
		padding:25px;
		text-align:center;
	}
	</style>
<body style="background-color:#ffffff;">
	<div id="content">
		<img src="<?=$this->webroot?>files/logo/reciept-mini-logo.jpg" style="float: right; margin-right: 25%; margin-top: 3.3%;">
		<span class="logo-desc" style="font-family: Lobster,cursive !important; color: gray; margin: 5.3% 0% 0% 74.8%; position: fixed;">Travel and Tours</span>
		<p class="logo-text" style="position: fixed; margin: 2.5% 0% 0% 74.5%; font-size: 2.3em; font-family: cursive;">Silshine</p>
		<div class="table-contain" style="margin: 6% 0% 0% 14%; position: fixed;">
		<center><h2><u>Receipt</u></h2></center>
		<br>
			
			<table class="table" style="border:1px solid black; width:106%;">
				<thead>
					<th style="border-bottom:1px solid black;">Customer Name</th>
					<th style="border-bottom:1px solid black;">Customer Tour Type</th>
					<th style="border-bottom:1px solid black;">Tour Name</th>
					<th style="border-bottom:1px solid black;">Contact Number</th>
					<th style="border-bottom:1px solid black;">Payment Recieved</th>
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
			<table style="border:1px solid black; width:106%;">
				<thead>
					<th style="border-bottom:1px solid black;">Invoice No.</th>
					<th style="border-bottom:1px solid black;">Date</th>
					<th class="mar-rgt" style="border-bottom:1px solid black;">Payment Type</th>
					<th class="mar-rgt" style="border-bottom:1px solid black;">Payment Amount</th>
					<th class="mar-rgt" style="border-bottom:1px solid black;">Payment Amount with GST(<?=$gst_percent?>%)</th>
					<th style="border-bottom:1px solid black;"></th>
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
	</div>
</body>

</html>
<script type="text/javascript" >
generate_cutomPDF();
function generate_cutomPDF() {
  	console.log(document.body);
    var doc = new jsPDF('p', 'pt');
	    doc.addHTML(document.body,function() {
	    doc.save('web.pdf');
	});
}

</script>
