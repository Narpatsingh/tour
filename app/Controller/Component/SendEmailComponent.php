<?php

    App::uses('CakeEmail', 'Network/Email');

    class SendEmailComponent extends Component {

        var $components = array("Email");
        var $subject;
        var $body;
        var $to;

        public function __construct(ComponentCollection $collection, $settings = array()) {
            $this->settings = $settings;
            parent::__construct($collection, $settings);
        }

        public function initialize(Controller $controller) {
            $this->controller = $controller;
        }

        function sendForgotPasswordEmail($arrData, $type = 'users') {
            $emailTemplete = $this->_getTemplate('reset_password');
            if (empty($emailTemplete) || empty($arrData['email'])) {
                return false;
            }
            $replacement = array(
                '{FIRST_NAME}' => $arrData['first_name'],
                '{LAST_NAME}' => $arrData['last_name'],
                '{EMAIL}' => $arrData['email'],
                '{ACTIVATION_LINK}' => Router::url(array('controller' => $type, 'action' => 'reset_password', $arrData['reset_code']), true),
                '{SITE_LOGIN_URL}' => Router::url(array('controller' => $type, 'action' => 'login'), true)
            );
            $emailTemplete['body'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['body']);
            $emailTemplete['subject'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['subject']);
            $this->send($arrData['email'], $emailTemplete['subject'], $emailTemplete['body']);
        }

        function _getTemplate($emailTemplete) {

            $template = ClassRegistry::init("EmailTemplate")->find('first', array('conditions' => array('name' => $emailTemplete), 'fields' => 'body,subject'));
           /* echo "<pre>";
            print_r($emailTemplete);exit;*/
            if (!empty($template)) {
                return $template['EmailTemplate'];
            }
            return true;
        }
		
        function _getLanguage() {
            $lang = 'eng';
            if (CakeSession::check('Auth.User.language')) {
                $lang = CakeSession::read('Auth.User.language');
            } elseif (CakeSession::check('Config.language')) {
                $lang = CakeSession::read('Config.language');
            }
            return $lang;
        }

    
        public function activateUser($to,$userId)
        {
            $emailTemplete = $this->_getTemplate('activate_user');
            
            $userId = encrypt($userId);
            $replacement = array(
                '{EMAIL}' => Configure::read('Site.Email.Username'),
                '{ACTIVATION_LINK}' => Router::url(array('controller' => 'users', 'action' => 'activateUser', $userId), true),
                '{SITE_NAME}' => Configure::read('Site.Name'),
                '{SITE_URL}' => Configure::read('Site.Url'),
            );

            $emailTemplete['body'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['body']);
            $emailTemplete['subject'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['subject']);
            $this->send($to, $emailTemplete['subject'], $emailTemplete['body']);
        }
        
        public function sendEnquiry($to,$arrData)
        {
            $first_name = $arrData['firstname']; 
            $last_name  = $arrData['lastname'];
            $email      = $arrData['email'];
            $experience = $arrData['experiences'];
            $mobile     = $arrData['mobile'];
            $guest      = $arrData['guest'];
            $month      = $arrData['month'];
            $subject    = 'Quick Enquiry For Travel';;
            $body       = '<html> <head> <title>Test</title> <meta charset="utf-8"> <meta name="viewport" content="width=device-width"> <style type="text/css"> /* CLIENT-SPECIFIC STYLES */ /* Force Outlook to provide a "view in browser" message */ #outlook a{padding:0;} /* Force Hotmail to display emails at full width */ .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display normal line spacing */ .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */ body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Remove spacing between tables in Outlook 2007 and up */ table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Allow smoother rendering of resized image in Internet Explorer */ img{-ms-interpolation-mode:bicubic;} /* RESET STYLES */ body{margin:0; padding:0;} img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;} table{border-collapse:collapse !important;} body{height:100% !important; margin:0; padding:0; width:100% !important;} /* iOS BLUE LINKS */ .appleBody a {color:#50a1ff; text-decoration: none;} .appleFooter a {color:#999999; text-decoration: none;} div.preheader { display: none !important; } /* MOBILE STYLES */ @media screen and (max-width: 480px) {.table_shrink  {width:95% !important;} .hero {width: 100% !important;} .appleBody a {color:#333333; text-decoration: none;} } </style> </head> <body> <div class="preheader" style="font-size: 1px; display: none !important;">Quick Enquiry</div> <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" class="table_shrink" style="border-radius: 10px; "  align="center"> <tr> <td> <table width="520" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" class="table_shrink"  align="center"> <tr> <td> <table width="520" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" class="table_shrink"  align="center"> <!-- start logo --> <tr valign="top"> <td align="left" style="padding-top:30px;"> <a href="#" >LOGO</a> </td> </tr> <!-- end logo --> <!-- start hr --> <tr> <td style="color:#cccccc; padding-top: 30px;" valign="top"> <hr color="cccccc" size="1"> </td> </tr> <!-- end hr --> <tr> <td valign="top" style="padding-top: 10px; font-family:Helvetica neue, Helvetica, Arial, Verdana, sans-serif; color: #205081; font-size: 22px; line-height: 40px; text-align:left; font-weight:bold;font-size: 13px; line-height: 16px;" align="middle"> <table border="\"> <tbody> <tr> <td colspan="\">Hello Admin,<br /><br /> For Quick Enquiry</td> </tr> <tr> <td> <table border="\"> <tbody> <tr> <td>First Name</td> <td> <p>'.$first_name.'</p> </td> </tr> <tr> <td>Last Name</td> <td> <p>'.$last_name.'</p> </td> </tr> <tr> <td>Mobile</td> <td> <p>'.$mobile.'</p> </td> </tr> <tr> <td>Email</td> <td> <p>'.$email.'</p> </td> </tr> <tr> <td>Holiday Month</td> <td> <p>'.$month.' Month</p> </td> </tr> <tr> <td>Number of guest</td> <td> <p>'.$guest.'</p> </td> </tr> <tr> <td>Additional Experiences</td> <td> <p>'.$experience.'</p> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> <tr> <td valign="top" style="padding-top: 10px; font-family:Helvetica neue, Helvetica, Arial, Verdana, sans-serif; color: #999; line-height: 40px; text-align:left; font-weight:bold;font-size: 12px; line-height: 16px;" align="middle"> <p>--<br /> Thanks and Regards,<br /> Team Travels <br /> www.test.com</p> </td> </tr> <tr> <td style="color:#cccccc;" valign="top"> <hr color="cccccc" size="1"> </td> </tr> <tr> <td valign="top" style=" font-family: Helvetica, Helvetica neue, Arial, Verdana, sans-serif; color: #707070; font-size: 12px; line-height: 18px; text-align:center; font-weight:none;" align="center"> Copyright © 2018 Travels. All Rights Reserved </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </body> </html>';;
            $this->send($to, $subject, $body);
        }

        function send($to, $subject, $body, $cc = array(), $attachment = '') {

            if (is_array($to)) {
                $to = array_unique(array_map('trim', $to));
            }
            if (is_array($cc)) {
                $cc = array_unique(array_map('trim', $cc));
            }
            try {
                // $replacement = array(
                //     '{SITE_NAME}' => Configure::read('Site.Name'),
                //     '{SITE_URL}' => Configure::read('Site.Url'),
                //     '{SITE_SUPPORT_EMAIL}' => Configure::read('Site.SupportEmail'),
                //     '{SITE_SUPPORT_PHONE}' => Configure::read('Site.SupportPhone'),
                //     '{CURRENT_TIME}' => date('Y-m-d H:i:s'),
                // );
                // $body = str_replace(array_keys($replacement), array_values($replacement), $body);
                // $subject = str_replace(array_keys($replacement), array_values($replacement), $subject);
               
				$Email = new CakeEmail();
				$Email->config(array(
					'host' => Configure::read('Site.Email.Host'),
					'port' => Configure::read('Site.Email.Port'),
					'username' => Configure::read('Site.Email.Username'),
					'password' => decode(Configure::read('Site.Email.Password')),
					'transport' => 'Smtp'
				));
				
				if (!empty($attachment)) {
                    $Email->attachments($attachment);
                }

                $Email->from(array(Configure::read('Site.FromEmail') => Configure::read('Site.FromName')))
                    ->sender(array(Configure::read('Site.FromEmail') => Configure::read('Site.FromName')))
                    ->to($to)
                    ->cc($cc)
                    ->emailFormat('both')
                    ->subject($subject)
                    ->send($body);
               
                return true;
            } catch (Exception $e) {
                return false;
            }
        }

    }

?>
