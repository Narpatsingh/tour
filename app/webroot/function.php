<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer\PHPMailer\src\PHPMailer.php';
require 'PHPMailer\PHPMailer\src\SMTP.php';
require 'PHPMailer\PHPMailer\src\Exception.php';

$first_name = $_REQUEST['firstname']; 
$last_name = $_REQUEST['lastname'];
$email = $_REQUEST['email'];
$experience = $_REQUEST['experiences'];
$mobile = $_REQUEST['mobile'];
$guest = $_REQUEST['guest'];
$month = $_REQUEST['month'];

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'ssl://smtp.gmail.com';                 // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'jnarpat46@gmail.com';             // SMTP username
    $mail->Password = 'narpat991333';                        // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('jnarpat46@gmail.com', 'Tour');
    $mail->addAddress('jnarpat46@gmail.com', 'Naps');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('developer.jayrathod@gmail.com');
    // $mail->addBCC('bcc@example.com');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Quick Enquiry For Travel';    
    $mail->Body    = '<html> <head> <title>Test</title> <meta charset="utf-8"> <meta name="viewport" content="width=device-width"> <style type="text/css"> /* CLIENT-SPECIFIC STYLES */ /* Force Outlook to provide a "view in browser" message */ #outlook a{padding:0;} /* Force Hotmail to display emails at full width */ .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display normal line spacing */ .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */ body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Remove spacing between tables in Outlook 2007 and up */ table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Allow smoother rendering of resized image in Internet Explorer */ img{-ms-interpolation-mode:bicubic;} /* RESET STYLES */ body{margin:0; padding:0;} img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;} table{border-collapse:collapse !important;} body{height:100% !important; margin:0; padding:0; width:100% !important;} /* iOS BLUE LINKS */ .appleBody a {color:#50a1ff; text-decoration: none;} .appleFooter a {color:#999999; text-decoration: none;} div.preheader { display: none !important; } /* MOBILE STYLES */ @media screen and (max-width: 480px) {.table_shrink  {width:95% !important;} .hero {width: 100% !important;} .appleBody a {color:#333333; text-decoration: none;} } </style> </head> <body> <div class="preheader" style="font-size: 1px; display: none !important;">Quick Enquiry</div> <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" class="table_shrink" style="border-radius: 10px; "  align="center"> <tr> <td> <table width="520" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" class="table_shrink"  align="center"> <tr> <td> <table width="520" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" class="table_shrink"  align="center"> <!-- start logo --> <tr valign="top"> <td align="left" style="padding-top:30px;"> <a href="#" >LOGO</a> </td> </tr> <!-- end logo --> <!-- start hr --> <tr> <td style="color:#cccccc; padding-top: 30px;" valign="top"> <hr color="cccccc" size="1"> </td> </tr> <!-- end hr --> <tr> <td valign="top" style="padding-top: 10px; font-family:Helvetica neue, Helvetica, Arial, Verdana, sans-serif; color: #205081; font-size: 22px; line-height: 40px; text-align:left; font-weight:bold;font-size: 13px; line-height: 16px;" align="middle"> <table border="\"> <tbody> <tr> <td colspan="\">Hello Admin,<br /><br /> For Quick Enquiry</td> </tr> <tr> <td> <table border="\"> <tbody> <tr> <td>First Name</td> <td> <p>'.$first_name.'</p> </td> </tr> <tr> <td>Last Name</td> <td> <p>'.$last_name.'</p> </td> </tr> <tr> <td>Mobile</td> <td> <p>'.$mobile.'</p> </td> </tr> <tr> <td>Email</td> <td> <p>'.$email.'</p> </td> </tr> <tr> <td>Holiday Month</td> <td> <p>'.$month.' Month</p> </td> </tr> <tr> <td>Number of guest</td> <td> <p>'.$guest.'</p> </td> </tr> <tr> <td>Additional Experiences</td> <td> <p>'.$experience.'</p> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> <tr> <td valign="top" style="padding-top: 10px; font-family:Helvetica neue, Helvetica, Arial, Verdana, sans-serif; color: #999; line-height: 40px; text-align:left; font-weight:bold;font-size: 12px; line-height: 16px;" align="middle"> <p>--<br /> Thanks and Regards,<br /> Team Travels <br /> www.test.com</p> </td> </tr> <tr> <td style="color:#cccccc;" valign="top"> <hr color="cccccc" size="1"> </td> </tr> <tr> <td valign="top" style=" font-family: Helvetica, Helvetica neue, Arial, Verdana, sans-serif; color: #707070; font-size: 12px; line-height: 18px; text-align:center; font-weight:none;" align="center"> Copyright © 2018 Travels. All Rights Reserved </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </body> </html>';
    $confirm_mail = $mail->send();

    if($confirm_mail){
        echo "Message sent";
        header("Location: index.php");
    }else{
        echo "Message could not be sent";
    }

} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>