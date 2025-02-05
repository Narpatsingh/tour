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
<html>
<head>
	<title>Silshine</title>
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
    margin: 5% 0% 0% 74.8%;
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
</head>
<body>
<div id="content">
	<img src="<?=$this->webroot?>files/logo/reciept-mini-logo.jpg" class="mini-logo">
	<span class="logo-desc">Travel and Tours</span>
	<p class="logo-text">Silshine</p>
	<div class="table-contain">
	<center><h2><u>Receipt</u></h2></center>
	<br>
		
		<table>
			<thead>
				<th>Customer Name</th>
				<th>Customer Tour Type</th>
				<th>Tour Name</th>
				<th>Contact Number</th>
				<th>Payment Recieved</th>
				<th></th>
			</thead>
			<tbody>
				<td><?=$customer_full_name?></td>
				<td><?=$customer_tour_type?></td>
				<td><?=$customer_tour_name?></td>
				<td><?=$customer_contact_no?></td>
				<td><?=$payment_recieved?></td>
			</tbody>
		</table>
		<br>
		<br>
		<table>
			<thead>
				<th>Invoice No.</th>
				<th>Date</th>
				<th class="mar-rgt">Payment Type</th>
				<th class="mar-rgt">Payment Amount</th>
				<th class="mar-rgt">Payment Amount with GST(<?=$gst_percent?>%)</th>
				<th></th>
			</thead>
			<tbody>
				<td><?=$invoice_no?></td>
				<td><?=$date?></td>
				<td class="pad-two"><?=$payment_type?></td>
				<td class="pad-two"><?=$total_payment?></td>
				<td class="pad-two"><?=$final_total_payment?></td>
			</tbody>
		</table>

		<div class="t_c">
		<?=$all_t_and_c?>
		</div>
		<div class="address">
		<p>
			<b>Office:</b>
			501/6, Bhakti Dharm Township, Palanpur, Canal Road, Jahangirabad, Surat.
			<b>Contact No:</b>
			8733897945 / 8758368590
			<b>Email:</b>
			<span class="email">silshinetrip@gmail.com</span>
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
<script>
	$(document).ready(function(){
	demoFromHTML();
	});	
    function demoFromHTML() {
    	alert('Hwre');
        var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#content').html();
        console.log(source);
        // we support special element handlers. Register them with jQuery-style 
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors 
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }, margins
        );
    }
</script>