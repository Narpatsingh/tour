<!DOCTYPE html>
<html>
<head>
	<title>Generate Receipt</title>
	<script type="text/javascript" src="<?=$this->webroot?>js/backend/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="<?=$this->webroot?>js/receipt/jspdf.min.js"></script>
	<style type="text/css"> .vatHeader {background-color: #e1e1e1} .logoheader {background-color: #800080; } .backColor {border: 1px solid #ccc; } .backColor-border {border-bottom: 1px solid #ccc; } footer {left: 0px; right: 0px; bottom: -60px; height: 110px; position: fixed; } .site_name {margin-top: -2.2%; color: #fff; padding: 15px; } .silshine_logo {height: 36px; width: 90px; padding:1.5%; } .mdg-logo{margin-left:2%;} .tour_picture{margin-top:12px;margin-right:25px;}
	</style>
</head>
<body>
<div id="gampya">
	<div style="background-color:#800080;">
	<div style="margin-left:2%;">
	<img src="<?=$this->webroot?>img/logo.png" width="300px" height="80px" style="height: 36px; width: 90px; padding:1.5%;">
	<p style="margin-top: -2.2%; color: #fff; padding: 15px;">Silshine Trip</p>
	</div>
	</div>
</div>
</body>
<?php/*reference from:https://stackoverflow.com/questions/16858954/how-to-properly-use-jspdf-library*/?>
<script type="text/javascript">
function demoFromHTML() {
	alert('here');
    var pdf = new jsPDF('p', 'pt', 'letter');
    source = $('#gampya').html();
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
    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width': margins.width, // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
        pdf.save('Test.pdf');
    }, margins);
}	
demoFromHTML();
</script>
</html>
<?php exit; ?>