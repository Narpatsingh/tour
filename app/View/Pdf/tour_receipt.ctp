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
$ac_id = $voucher['ac_id'];
$redirect = $voucher['redirect'];
$gst_amount = $final_total_payment-$total_payment;
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>SilShine Trip</title> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
</head>
<body id="content">
	<div>
		<img src="<?=$this->webroot?>files/logo/reciept-mini-logo.jpg" style="float: left; margin-left: 7.5%; margin-top: 3.8%;">
		<span class="logo-desc" style="font-family: Lobster,cursive !important; color: gray; margin: 5.7% 0% 0% 0.5%; position: fixed;font-size: smaller;font-weight: 600;">Travel and Tours</span>
		<span class="logo-desc" style="font-family: Lobster,cursive !important; color: gray; margin: 7% 0% 0% -5.5%; position: fixed;font-size: medium;font-weight: 600;">Makeover Your Own Trip</span>
		<p class="logo-text" style="position: fixed; margin: 3% 0% 0% 13%;; font-size: 2em; font-family: cursive;">Silshine</p>
		<div class="address" style="width:300px; float:right; margin: 2.5% 0% 0% 70.5%;text-align:justify;position:fixed;">
			<p>
				<b>Office:</b>
				501/6, Bhakti Dharm Township, Palanpur, Canal Road, Jahangirabad, Surat.
				<b>Contact No:</b>
				8733897945 / 8758368590
				<b>Email:</b>
				<span class="email" style="font-size: large; font-style: italic; font-family: inherit; -webkit-font-smoothing: subpixel-antialiased; font-weight: 600;">silshinetrip@gmail.com</span>
			</p>
		</div>		
		<div class="table-contain" style="margin: 6% 0% 0% 7%; position: fixed;">
		<center style="margin:6% 0% -2% 120%;"><h2>INVOICE</h2></center>
		<div class="separator" style="border: 1px solid #800080;margin:0% -32% 1% 0%;"></div>
		<br>
			
			<table class="table" style="border:0px; width:132.5%;">
				<tr>
					<td><b>Invoice No</b></td>
					<td> <b>:</b> <?=$invoice_no?></td>
					<td><b>Customer Name</b></td>
					<td> <b>:</b> <?=$customer_full_name?></td>
					<td style="padding-left:80px;"><b>Date</b></td>
					<td> <b>:</b> <?=$date?></td>
				</tr>
				<tr>
					<td><b>Customer Tour Type</b></td>
					<td> <b>:</b> <?=$customer_tour_type?></td>
										
					<td><b>Contact Number</b></td>
					<td> <b>:</b> <?=$customer_contact_no?></td>
				</tr>	
			</table>
			<br>
			<br>
			<div class="separator" style="border: 0.5px solid black;margin: 2% 0% 1% 0%; position: fixed; width: 86.8%;"></div>
			<table style="border:1px solid black; width:132.5%;">
				<thead>
					<th>No.</th>
					<th>Tour Name</th>
					<th>Payment Type</th>
					<th>Payment Amount</th>
					<th>Payment Recieved</th>
					<th>Payment Amount with GST(<?=$gst_percent?>%)</th>
					<th></th>
				</thead>
				<tbody>
					<td style="border-top:1px;padding:25px 0px 25px 0px; text-align:center;"><?='1'?></td>
					<td style="border-top:1px;padding:25px 0px 25px 0px; text-align:center;"><?=$customer_tour_name?></td>
					<td style="border-top:1px;padding:25px 0px 25px 0px; text-align:center;" class="pad-two"><?=$payment_type?></td>
					<td style="border-top:1px;padding:25px 0px 25px 0px; text-align:center;"><?=$total_payment?></td>
					<td style="border-top:1px;padding:25px 0px 25px 0px; text-align:center;"><?=$payment_recieved?></td>
					<td style="border-top:1px;padding:25px 0px 25px 0px; text-align:center;" class="pad-two"><?=$final_total_payment?></td>
					<td style="border-top:1px;padding:25px 0px 25px 0px; text-align:center;" class="pad-two"></td>
				</tbody>
			</table>
			<table style="border:1px solid black; width:132.5%;">
				<!-- <tr>
					<td style="padding:0% 0% 0% 45%;"></td>
					<td style="padding:0% 0% 0% 45%;"><b> </b></td>					
					<td style="padding:0px 0px 0px 0px; text-align:right;"><?='TOTAL AMOUNT EXCLUDING GST OF'?></td>
					<td style="text-align:left"><b>:    &#8377;</b><?=$total_payment?></td>
				</tr>	
				<tr>
					<td style="padding:0% 0% 0% 45%;"></td>
					<td style="padding:0% 0% 0% 45%;"><b> </b></td>
					<td style="padding:0px 0px 0px 0px; text-align:right;"><?='TOTAL AMOUNT INCLUDES GST OF'?></td>
					<td style="text-align:left"><b>:    &#8377;</b><?=$gst_amount?></td>
				</tr>	
				<tr>
					<td style="padding:0% 0% 0% 45%;"></td>
					<td style="padding:0% 0% 0% 45%;"><b> </b></td>					
					<td style="padding:0px 0px 0px 0px; text-align:right;"><?='TOTAL AMOUNT RECIEVED'?></td>
					<td style="text-align:left"><b>:    &#8377;</b><?=$payment_recieved?></td>
				</tr>	 -->
				<tr>
					<td style="padding:0% 0% 0% 45%;"></td>
					<td style="padding:0% 0% 0% 45%;"><b> </b></td>
					<td style="padding:0px 0px 0px 0px; text-align:right;"><b><?='TOTAL AMOUNT PAYABLE THIS INVOICE'?></b></td>
					<td style="text-align:left"><b>:    &#8377;<?=$final_total_payment-$payment_recieved?></b></td>
				</tr>	
			</table>

			<div class="t_c" style="margin: 4% 0% 0% 0%; float:left;"> 
				<?=$all_t_and_c?>
			</div>
			<br>
			<br>
		<div style="line-height:10px;width: 132.5%;">
			<div style="float:left;">	
			Customer  Signature :  <b><i><u><?=$customer_signature?></u>.</i></b> 
			</div>
			<div style="float:right;">	
			Company  Signature :  <b><i><u><?=$company_signature?></u>.</i></b>
			</div>
		</div>	
		</div>
	</div>
</body>

</html>
 <script>
 	demoFromHTML();
    function demoFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'a4');
        //var pdf = new jsPDF('landscape', 'pt', 'a4');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = document.body;

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
            top: 0,
            bottom: 0,
            left: 0,
            width: 0
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.addHTML(
            source, // HTML string or DOM elem ref.
            // margins.left, // x coord
            // margins.top, { // y coord
            //     'width': 1365, // max width of content on PDF
            //     'elementHandlers': specialElementHandlers
            // },
            scale: 2,
            dpi: 144,
            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                //pdf.save('Test.pdf');

					var blob = pdf.output('blob');
		            var formData = new FormData();
		            formData.append('pdf', blob);

		            $.ajax('<?=$this->webroot?>save_file/<?=$ac_id?>/<?=$invoice_no?>',
		            {
		                method: 'POST',
		                data: formData,
		                processData: false,
		                contentType: false,
		                success: function(data){console.log(data); 
		                	//if(data){window.location.assign("<?=$this->webroot.$redirect?>")}
		                },
		                error: function(data){console.log(data)}
		            });                
            }, margins
        );
    }
</script>
<?php exit; ?>