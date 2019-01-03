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

        function notifyManager($arrDetail,$arrTasks) {
            $emailTemplete = $this->_getTemplate('notify_manager');
            if (empty($emailTemplete) ) {
                return false;
            }
			$tasks = "<table style='color: #333;font-family: Helvetica, Arial, sans-serif;width: 640px;border-collapse: collapse;border-spacing: 0;text-align: left;'><tr style='background-color: #e0e0e0;height: 30px;'><th>Sr. No</th><th>Task</th><th>Completed At</th><th>Created By</th><th>Completed By</th><tr>";
            foreach($arrTasks["completedTasks"] as $k=>$task){
				$tasks .= "<tr style='height: 30px;border-bottom: 1pt solid #e0e0e0;'><td>".++$k."</td><td>".$task['Task']['title']."</td><td>".showtime($task['Task']['completed_date'])."</td><td>".$task['TaskOwner']['name']."</td><td>".$task['TaskCompletedBy']['name']."</td><tr>";
			}
			$tasks .= "</table>";

            $pending_tasks = "";
            if($arrTasks["pendingTasks"])
            {
                $pending_tasks = "<table style='color: #333;font-family: Helvetica, Arial, sans-serif;width: 640px;border-collapse: collapse;border-spacing: 0;text-align: left;'><tr style='background-color: #e0e0e0;height: 30px;'><th>Sr. No</th><th>Task</th><th>Created At</th><th>Created By</th><tr>";
                foreach($arrTasks["pendingTasks"] as $k=>$task){
                    $pending_tasks .= "<tr style='height: 30px;border-bottom: 1pt solid #e0e0e0;'><td>".++$k."</td><td>".$task['Task']['title']."</td><td>".showtime($task['Task']['created'])."</td><td>".$task['TaskOwner']['name']."</td><tr>";
                }
                $pending_tasks .= "</table>";
            }

            $replacement = array(
                '{GROUP_NAME}' 	=> $arrDetail['GROUP_NAME'],
                '{SHIFT_NAME}'	=> $arrDetail['SHIFT_NAME'],
                '{USER_NAME}'	=> $arrDetail['USER_NAME'],
                '{DATE}'		=> $arrDetail['DATE'],
                '{TASK_TABLE}'	=> $tasks,
                '{PENDING_TASK_TABLE}'	=> $pending_tasks,
            );
            $emailTemplete['body'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['body']);
            $emailTemplete['subject'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['subject']);
			return $this->send($arrDetail['users'], $emailTemplete['subject'], $emailTemplete['body']);
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

        function sendNewsBroadcastEmail($arrData,$userEmail) {
            $emailTemplete = $this->_getTemplate('news_brodcast');
            if (empty($emailTemplete) ) {
                return false;
            }
            $fname=CakeSession::read('Auth.User.first_name')?CakeSession::read('Auth.User.first_name')." ":'';
            $lname=CakeSession::read('Auth.User.last_name')?CakeSession::read('Auth.User.last_name'):'';

            $replacement = array(
                '{USER_NAME}' => $fname.$lname,
                '{NEWS_TITLE}' => $arrData['title']
            );
            $emailTemplete['body'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['body']);
            $emailTemplete['subject'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['subject']);
            $this->send($userEmail, $emailTemplete['subject'], $emailTemplete['body']);
        }

        function sendNewsPublishEmail($arrData,$userEmail) {
            $emailTemplete = $this->_getTemplate('news_publish');
            if (empty($emailTemplete) ) {
                return false;
            }
            $fname=CakeSession::read('Auth.User.first_name')?CakeSession::read('Auth.User.first_name')." ":'';
            $lname=CakeSession::read('Auth.User.last_name')?CakeSession::read('Auth.User.last_name'):'';

            $replacement = array(
                '{USER_NAME}' => $fname.$lname,
                '{NEWS_TITLE}' => $arrData['title'],
                '{STATUS}' => 'Published'
            );
            $emailTemplete['body'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['body']);
            $emailTemplete['subject'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['subject']);
            $this->send($userEmail, $emailTemplete['subject'], $emailTemplete['body']);
        }
        // send mail after successfully updated
        function sendNewsEditEmail($arrData,$userEmail) {
            $emailTemplete = $this->_getTemplate('news_edit');
            if (empty($emailTemplete) ) {
                return false;
            }
            $fname=CakeSession::read('Auth.User.first_name')?CakeSession::read('Auth.User.first_name')." ":'';
            $lname=CakeSession::read('Auth.User.last_name')?CakeSession::read('Auth.User.last_name'):'';

            $replacement = array(
                '{NEWS_TITLE}' => $arrData['title'],
                '{USER_NAME}' => $fname.$lname

            );
            $emailTemplete['body'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['body']);
            $emailTemplete['subject'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['subject']);
            $this->send($userEmail, $emailTemplete['subject'], $emailTemplete['body']);
        }

        // send mail after successfully audio added
        function sendNewsAudioEmail($arrData,$userEmail) {
            $emailTemplete = $this->_getTemplate('audio_add');
            if (empty($emailTemplete) ) {
                return false;
            }
            $fname=CakeSession::read('Auth.User.first_name')?CakeSession::read('Auth.User.first_name')." ":'';
            $lname=CakeSession::read('Auth.User.last_name')?CakeSession::read('Auth.User.last_name'):'';
            $replacement = array(
                '{USER_NAME}'=>$fname.$lname,
                '{NEWS_TITLE}' => $arrData['title'],
                '{LANGUAGES}' => isset($arrData['language'])?$arrData['language']:' - ',
            );
            $emailTemplete['body'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['body']);
            $emailTemplete['subject'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['subject']);
            $this->send($userEmail, $emailTemplete['subject'], $emailTemplete['body']);
        }

        // send mail after successfully translation added
        function sendNewsTranslationEmail($arrData,$userEmail) {
            $emailTemplete = $this->_getTemplate('news_translation');
            if (empty($emailTemplete) ) {
                return false;
            }
            $fname=CakeSession::read('Auth.User.first_name')?CakeSession::read('Auth.User.first_name')." ":'';
            $lname=CakeSession::read('Auth.User.last_name')?CakeSession::read('Auth.User.last_name'):'';
            $replacement = array(
                '{USER_NAME}'=>$fname.$lname,
                '{NEWS_TITLE}' => $arrData['title'],
                '{LANGUAGES}' => isset($arrData['language'])?$arrData['language']:' - ',
            );
            $emailTemplete['body'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['body']);
            $emailTemplete['subject'] = str_replace(array_keys($replacement), array_values($replacement), $emailTemplete['subject']);
            $this->send($userEmail, $emailTemplete['subject'], $emailTemplete['body']);
        }
        function sendPublishLink($arrData) {
            /*$emailTemplete = $this->_getTemplate('reset_password');
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
            $this->send($arrData['email'], $emailTemplete['subject'], $emailTemplete['body']);*/
        }
        function send($to, $subject, $body, $cc = array(), $attachment = '') {

            if (is_array($to)) {
                $to = array_unique(array_map('trim', $to));
            }
            if (is_array($cc)) {
                $cc = array_unique(array_map('trim', $cc));
            }
            try {
                //$layout = $this->_getLayout();
                $replacement = array(
                    '{SITE_NAME}' => Configure::read('Site.Name'),
                    '{SITE_URL}' => Configure::read('Site.Url'),
                    '{SITE_SUPPORT_EMAIL}' => Configure::read('Site.SupportEmail'),
                    '{SITE_SUPPORT_PHONE}' => Configure::read('Site.SupportPhone'),
                    '{CURRENT_TIME}' => date('Y-m-d H:i:s'),
                );
                $body = str_replace(array_keys($replacement), array_values($replacement), $body);
                $subject = str_replace(array_keys($replacement), array_values($replacement), $subject);
               
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
