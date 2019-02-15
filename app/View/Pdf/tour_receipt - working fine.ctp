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
		width:115%;
	}
	th{
		border-bottom:1px solid gray;
	}
	td{
		padding:25px;
		text-align:center;
	}
	</style>
<body>
	<div id="content">
		<img src="<?=$this->webroot?>files/logo/reciept-mini-logo.jpg" style="float: right; margin-right: 25%; margin-top: 3.6%;">
		<span class="logo-desc" style="font-family: Lobster,cursive !important; color: gray; margin: 5.4% 0% 0% 74.8%; position: fixed;">Travel and Tours</span>
		<p class="logo-text" style="position: fixed; margin: 2.5% 0% 0% 74.5%; font-size: 2.3em; font-family: cursive;">Silshine</p>
		<div class="table-contain" style="margin: 6% 0% 0% 7%; position: fixed;">
		<center style="margin-left:10%;"><h2><u>Receipt</u></h2></center>
		<br>
			
			<table class="table" style="border:1px solid black; width:115%;">
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
			<table style="border:1px solid black; width:115%;">
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
			<div class="address" style="width:300px; float:right; margin: 3% -17% 0% 0%;">
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
 <script>
 	demoFromHTML();
    function demoFromHTML() {
        //var pdf = new jsPDF('p', 'pt', 'a4');
        var pdf = new jsPDF('landscape', 'pt', 'a4');
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
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

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
		                	if(data){window.location.assign("<?=$this->webroot.$redirect?>")}
		                },
		                error: function(data){console.log(data)}
		            });                
            }, margins
        );
    }
</script>
<?php exit; ?>