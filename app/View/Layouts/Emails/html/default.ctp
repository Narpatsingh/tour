<?php
$siteUrl = Router::url('/', true);
?>
<html>
    <head>
        <title>Test</title>
        <meta charset="utf-8">
            <meta name="viewport" content="width=device-width">
                <style type="text/css"> /* CLIENT-SPECIFIC STYLES */ /* Force Outlook to provide a "view in browser" message */ #outlook a{padding:0;} /* Force Hotmail to display emails at full width */ .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display normal line spacing */ .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */ body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Remove spacing between tables in Outlook 2007 and up */ table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Allow smoother rendering of resized image in Internet Explorer */ img{-ms-interpolation-mode:bicubic;} /* RESET STYLES */ body{margin:0; padding:0;} img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;} table{border-collapse:collapse !important;} body{height:100% !important; margin:0; padding:0; width:100% !important;} /* iOS BLUE LINKS */ .appleBody a {color:#50a1ff; text-decoration: none;} .appleFooter a {color:#999999; text-decoration: none;} div.preheader { display: none !important; } /* MOBILE STYLES */ @media screen and (max-width: 480px) {.table_shrink  {width:95% !important;} .hero {width: 100% !important;} .appleBody a {color:#333333; text-decoration: none;} } </style>
            </head>
            <body>
                <div class="preheader" style="font-size: 1px; display: none !important;">Quick Enquiry</div>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" class="table_shrink" style="border-radius: 10px; "  align="center">
                    <tr>
                        <td>
                            <table width="520" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" class="table_shrink"  align="center">
                                <tr>
                                    <td>
                                        <table width="520" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" class="table_shrink"  align="center">
                                            <tr>
                                                <td valign="top" style="padding-top: 10px; font-family:Helvetica neue, Helvetica, Arial, Verdana, sans-serif; color: #5a5757; line-height: 40px; text-align:left; font-weight:bold;font-size: 12px; line-height: 16px;" align="middle">
                                                    <p>Dear Guest,
                                                    
                                                    </br>
                                                </br> Greetings from SilShine Trip…!!
                                            
                                            </br>
                                            <?php
                                            if (!empty($isFromView)):
                                                echo '{BODY}';
                                            else:
                                                echo $this->fetch('content');
                                            endif;

                                            ?>
                            </br>
                        </br> In case of any changes, please contact your travel advisor (Minesh Pisolkar &amp; 8733897945) or the SilShine trip toll-free number 8758368590 immediately.
                    
                    </br>
                </br> Thank you and have a nice day!
            
            </br>
        </br> SilShine Trip
    
    </br>
</br> Here is booking form Attached</br></br></p></td></tr><tr><td valign="top" style="padding-top: 10px; font-family:Helvetica neue, Helvetica, Arial, Verdana, sans-serif; color: #999; line-height: 40px; text-align:left; font-weight:bold;font-size: 12px; line-height: 16px;" align="middle"><p>--<br /> Thanks and Regards,<br /> Team SilShine <br /> http://silshinetrip.com </p></td></tr><tr><td style="color:#cccccc;" valign="top"><hr color="cccccc" size="1"></td></tr><tr><td valign="top" style=" font-family: Helvetica, Helvetica neue, Arial, Verdana, sans-serif; color: #707070; font-size: 12px; line-height: 18px; text-align:center; font-weight:none;" align="center"> Copyright © <?=date('Y')?> SilShine Trip. All Rights Reserved </td></tr></table></td></tr></table></td></tr></table></body></html>