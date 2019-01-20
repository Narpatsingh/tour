<?php
App::uses('Controller', 'Controller');

class AppController extends Controller
{

    public $components = array(
        'Auth',
        'Cookie',
        'Common',
        'Session',
        'Paginator',
        'Message',
        'SendEmail',
        'Siteconfig',
        'AutoPaginate' => array('options' => array(10, 20, 50, 100, 250), 'defaultLimit' => 10)
    );
    public $helpers = array(
        'Html' => array('className' => 'Custom'),
        'Form' => array('className' => 'CustomForm'),
    );

    public function beforeFilter()
    {
        $this->setTimezone(); // Setting Timezone from Database        
        parent::beforeFilter();
        if(!$this->Session->check('Auth.User.id')){
            $this->layout = 'login';
        }     
		$this->set('users', ClassRegistry::init("User")->getOnlyUserList()); //Set User List
    }

    public function _checkLogin()
    {
        $this->_checkUserSession();
    }

    public function _checkUserSession()
    {
        $this->Auth->authenticate = array(
            'Form' => array(
                'fields' => array('username' => 'email'),
				 'scope' => array('User.status !=' => 'deleted')
            )
        );
        $this->Auth->loginAction = array(
            'controller' => 'users',
            'action' => 'login'
        );
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'index');
        $this->Auth->logoutRedirect = '/';
        $this->Auth->authError = __('Please login to view that page.');
    }
    
    function setTimezone($timezone = null){
        $timezone =  !empty($timezone)?$timezone:Configure::read("Site.Timezone");
        if(!empty($timezone)){
            date_default_timezone_set($timezone);
        }
    }
	function getSearchCondition($model,$all = null){
		$conditions = array();
		if(!empty($this->type)){
			$conditions['type'] = $this->type;
		}
		if ($all == "all") {
			$this->Session->write($model.'Search'.$this->type, '');
		}

		if (empty($this->request->data[$model]) && $this->Session->read($model.'Search')) {
			$this->request->data[$model] = $this->Session->read($model.'Search'.$this->type);
		}
		if (!empty($this->request->data[$model])) {
			$this->request->data[$model] = array_filter($this->request->data[$model]);
			$this->request->data[$model] = array_map('trim', $this->request->data[$model]);
			if (!empty($this->request->data)) {
				if (isset($this->request->data[$model]['user'])) {
					$conditions[$model.'.user_id'] = $this->request->data[$model]['user'];
				}
				if (isset($this->request->data[$model]['date'])) {
					$conditions[$model.'.date'] = $this->request->data[$model]['date'];
				}
			}
			$this->Session->write($model.'Search'.$this->type, $this->request->data[$model]);
		}
		return $conditions;
	}
    
    public function sendMail($data, $subject, $attachment = '') {
        $cc = array();
        $to = $data['Customer']['email'];
        $body = '<html> <head> <title>Test</title> <meta charset="utf-8"> <meta name="viewport" content="width=device-width"> <style type="text/css"> /* CLIENT-SPECIFIC STYLES */ /* Force Outlook to provide a "view in browser" message */ #outlook a{padding:0;} /* Force Hotmail to display emails at full width */ .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display normal line spacing */ .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */ body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Remove spacing between tables in Outlook 2007 and up */ table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Allow smoother rendering of resized image in Internet Explorer */ img{-ms-interpolation-mode:bicubic;} /* RESET STYLES */ body{margin:0; padding:0;} img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;} table{border-collapse:collapse !important;} body{height:100% !important; margin:0; padding:0; width:100% !important;} /* iOS BLUE LINKS */ .appleBody a {color:#50a1ff; text-decoration: none;} .appleFooter a {color:#999999; text-decoration: none;} div.preheader { display: none !important; } /* MOBILE STYLES */ @media screen and (max-width: 480px) {.table_shrink  {width:95% !important;} .hero {width: 100% !important;} .appleBody a {color:#333333; text-decoration: none;} } </style> </head> <body> <div class="preheader" style="font-size: 1px; display: none !important;">Quick Enquiry</div> <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" class="table_shrink" style="border-radius: 10px; "  align="center"> <tr> <td> <table width="520" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" class="table_shrink"  align="center"> <tr> <td> <table width="520" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" class="table_shrink"  align="center"> <!-- start logo --> <tr valign="top"> <td align="left" style="padding-top:30px;"> <a href="#" >LOGO</a> </td> </tr> <!-- end logo --> <!-- start hr --> <tr> <td style="color:#cccccc; padding-top: 30px;" valign="top"> <hr color="cccccc" size="1"> </td> </tr> <!-- end hr --> <tr> <td valign="top" style="padding-top: 10px; font-family:Helvetica neue, Helvetica, Arial, Verdana, sans-serif; color: #205081; font-size: 22px; line-height: 40px; text-align:left; font-weight:bold;font-size: 13px; line-height: 16px;" align="middle"> <table border="\"> <tbody> <tr> <td colspan="\">Hello Admin,<br /><br /> For Quick Enquiry</td> </tr> <tr> <td> <table border="\"> <tbody> <tr> <td>Name</td> <td> <p>'.$data['Customer']['name'].'</p> </td> </tr> <tr> <td>Mobile</td> <td> <p>'.$data['Customer']['mobile'].'</p> </td> </tr> <tr> <td>Email</td> <td> <p>'.$data['Customer']['email'].'</p> </td> </tr> <tr> <td>Holiday Month</td> <td> <p>'.$data['Enquiry']['number_of_month'].' Month</p> </td> </tr> <tr> <td>Number of guest</td> <td> <p>'.$data['Enquiry']['number_of_guest'].'</p> </td> </tr> <tr> <td>Additional Experiences</td> <td> <p>'.$data['Enquiry']['experience'].'</p> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> <tr> <td valign="top" style="padding-top: 10px; font-family:Helvetica neue, Helvetica, Arial, Verdana, sans-serif; color: #999; line-height: 40px; text-align:left; font-weight:bold;font-size: 12px; line-height: 16px;" align="middle"> <p>--<br /> Thanks and Regards,<br /> Team Travels <br /> www.test.com</p> </td> </tr> <tr> <td style="color:#cccccc;" valign="top"> <hr color="cccccc" size="1"> </td> </tr> <tr> <td valign="top" style=" font-family: Helvetica, Helvetica neue, Arial, Verdana, sans-serif; color: #707070; font-size: 12px; line-height: 18px; text-align:center; font-weight:none;" align="center"> Copyright © 2018 Travels. All Rights Reserved </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </body> </html>';

        if (is_array($to)) {
            $to = array_unique(array_map('trim', $to));
        }
        if (is_array($cc)) {
            $cc = array_unique(array_map('trim', $cc));
        }
        try {
            $Email = new CakeEmail();
            $Email->config(array(
                'host' => 'ssl://smtp.gmail.com',
                'port' => 465,
                'username' => 'jnarpat46@gmail.com',
                'password' => 'narpat991333',
                'transport' => 'Smtp'
            ));
            
            if (!empty($attachment)) {
                $Email->attachments($attachment);
            }

            $Email->from(array('jnarpat46@gmail.com' => 'Silshine Trip'))
                ->sender(array('jnarpat46@gmail.com' => 'Silshine Trip'))
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