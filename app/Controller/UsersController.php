<?php

/**
 * @property User $User
 */
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $components = array('Auth', 'Captcha', 'Cookie');
    public $uses = array('User','SocialMediaDetail','KeywordMonitored','OffendingDomain','ContactInformation','Report','Ticket', 'DomainsDiscovered','KeyPost','Vvip','SiteConfig');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('getCaptcha','activateUser','dashboard','login');
        $this->_checkLogin();
    }

    public function login() {
        $this->layout = "login";
        if ($this->Session->read('Auth.User.id')) {
			if($this->Session->read('Auth.User.role')=="admin"){
				$this->redirect(array('controller' => 'tours', 'action' => 'index'));
			}else{
				$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
			}
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $status = $this->Session->read('Auth.User.status');
                //Audit Log
                $this->loadModel('AuditLog');
                $this->AuditLog->addUserLog('login');

                if ($status == 'active') {
                    // Process After Login
                    $this->User->id = $this->Session->read('Auth.User.id');
                    $this->__setUserSession();

                    $sessionData = getMySessionData();
					if($this->Session->read('Auth.User.role')=="admin"){
						$this->redirect(array('controller' => 'tours', 'action' => 'index'));
					}else{
						$this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'dashboard');
					}

                    return $this->redirect($this->Auth->loginRedirect);
                } else {
                    $this->Auth->logout();
                    $this->Session->destroy();
                    $this->Message->setWarning(__('Your account is not active'));
                }
            } else {
                $this->Message->setWarning(__('Invalid Username/Password'));
            }
        }
        $this->set('title_for_layout', Configure::read('Site.Name'));
    }

    public function __setUserSession() {
        $userId = $this->Session->read('Auth.User.id');
        if ($this->User->exists($userId)) {
            $this->User->id = $userId;
            $userDetail = $this->User->find('first', array('contain' => false, 'conditions' => array('User.id' => $userId)));
            $this->Session->write('Auth.User', $userDetail['User']);
        }
    }

    public function logout() {
        $this->loadModel('AuditLog');
        $this->RememberMe->delete('User');
        $this->AuditLog->addUserLog('logout');
        $this->Auth->logout();
        $this->Session->destroy();
        $this->redirect($this->Auth->logoutRedirect);
    }

    public function profile() {
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->__setUserSession();
                $this->Message->setSuccess(__('Profile Updated Successfully.'), array('action' => 'profile'));
            }
            if (!empty($this->User->validationErrors)) {
                $this->set('validationErrors', $this->User->validationErrors);
            }
            $this->Message->setWarning(__('Unable to update detail.'));
        }
        if (empty($this->request->data)) {
            $userDetailArr = $this->User->getUserDetail($this->Session->read('Auth.User.id'));
            $this->request->data['User'] = $record = $userDetailArr['User'];
            $this->set('user', $this->request->data);
        }
    }

    public function add() {
        if ($this->request->is(array('post', 'put'))) {
            if (!empty($this->request->data)) {
                $this->request->data['User']['status'] = 'inactive';
                $this->request->data['User']['is_email_verify'] = 0;
                $this->request->data['User']['phone_no'] = rtrim($this->request->data['User']['phone_no'], '_');
                if ($this->User->save($this->request->data)) {
                    $user_email = $this->request->data["User"]["email"];
                    $user_id = $this->User->getLastInsertID();
                    $this->SendEmail->activateUser($user_email,$user_id);
                    $this->Message->setSuccess(__('User Added Successfully.'));
					return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Message->setWarning(__('Unable to add New User.'));
                }
            }
        }
        $roles = Configure::read('user_role');
        $this->set(compact('roles'));
        $this->set('dbOpration', 'Add');
    }

    public function edit($id = null) {
        $sessionData = getMySessionData();
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['User']['id'] = $id;

            if (isset($this->request->data['User']['passwordChk'])) {
                $user = $this->User->find('first', array(
                    'contain' => false,
                    'conditions' => array('User.id' => $id)
                        )
                );

                if (!empty($this->request->data['User']['old_password']) && AuthComponent::password($this->request->data['User']['old_password']) != $user['User']['password']) {
                    $this->Message->setWarning(__("Old Password not matched in database."));
                } elseif ($this->request->data ['User'] ['password'] != $this->request->data ['User'] ['confirm_password']) {
                    $this->Message->setWarning(__("Provide same confirm password as new password."));
                } elseif ($this->request->data ['User'] ['password'] == "") {
                    $this->Message->setWarning(__("New Password Must Not Blank."));
                } else {
                    unset($this->request->data['User']['passwordChk']);
                    unset($this->request->data['User']['old_password']);
                    $this->request->data['User']['phone_no'] = rtrim($this->request->data['User']['phone_no'], '_');
                    if ($this->User->save($this->request->data)) {
                        $this->Message->setSuccess(__("User information updated successfully."));
                    } else {
                        $this->Message->setWarning(__("Unable to update detail."));
                    }
                }
            } else {
                unset($this->request->data['User']['password']);
                unset($this->request->data['User']['old_password']);
                unset($this->request->data['User']['confirm_password']);
                $this->User->id = $this->request->data['User']['id'];
                $this->request->data['User']['phone_no'] = rtrim($this->request->data['User']['phone_no'], '_');
                if ($this->User->save($this->request->data)) {
                    $this->Message->setSuccess(__("User information updated successfully."));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Message->setWarning(__("Unable to update detail."));
                }
            }
        }
        $selectedUser = $this->User->find('first', array('contain' => false, 'conditions' => array('User.id' => $id)));
        $this->request->data = $selectedUser;
        unset($this->request->data['User']['password']);
        $roles = Configure::read('user_role');
        $this->set(compact('roles'));
        $this->set('dbOpration', 'Edit');
        $this->render('add');
    }

    public function index($all = null, $dealerId = null) {
        $sessionData = getMySessionData();
        $conditions = array(
            'User.id !=' => $sessionData['id'],
            'User.status !=' => 'deleted'
        );
        if ($all == "all") {
            $this->Session->write($this->type . 'Search', '');
        }
        if (empty($this->request->data['User']) && $this->Session->read($this->type . 'Search')) {
            $this->request->data['User'] = $this->Session->read($this->type . 'Search');
        }

        if (!empty($this->request->data['User'])) {
            $this->request->data['User'] = array_filter($this->request->data['User']);
            $this->request->data['User'] = array_map('trim', $this->request->data['User']);
            if (!empty($this->request->data)) {
                if (isset($this->request->data['User']['name'])) {
                    $conditions['OR'] = array(
                        'User.first_name LIKE ' => '%' . $this->request->data['User']['name'] . '%',
                        'User.last_name LIKE ' => '%' . $this->request->data['User']['name'] . '%'
                    );
                }
                if (isset($this->request->data['User']['email'])) {
                    $conditions['User.email LIKE '] = '%' . $this->request->data['User']['email'] . '%';
                }

                if (isset($this->request->data['User']['status'])) {
                    $conditions['User.status'] = $this->request->data['User']['status'];
                }
            }
            $this->Session->write($this->type . 'Search', $this->request->data['User']);
        }

        $contains = array();

        $fields = array(
            'id',
            'name',
            'first_name',
            'last_name',
            'email',
            'role',
            'phone_no',
            'status',
            'created'
        );

        $this->AutoPaginate->setPaginate(array(
            'fields' => $fields,
            'order' => ' User.name',
            'conditions' => $conditions,
            'contain' => $contains,
        ));
        $this->set('users', $this->paginate('User'));
    }


    public function password_reset($userId = null)
    {
        if ($this->request->is('post')) {
            $this->request->data['User']['id'] = $userId;
            $this->User->validates(array('fieldList' => array('password')));
            unset($this->User->validate['first_name']);
            if ($this->User->save($this->request->data)) {
                $this->Message->setSuccess(__('Password reset successfully.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Message->setWarning(__('Password not reset. Please, try again.'));
            }
        }
        $user = $this->User->findById($userId);
        $this->set(compact('user'));
    }

    public function dashboard($id = null) {
        $this->layout = 'tour';
        $this->loadModel('Tour');
        $specials = $this->Tour->find('all', array('contain' => false, 'conditions' => array('Tour.type' => '1')));
        $hots = $this->Tour->find('all', array('contain' => false, 'conditions' => array('Tour.type' => '2')));
        $discounts = $this->Tour->find('all', array('contain' => false, 'conditions' => array('Tour.type' => '3')));
        $this->set(compact('specials','hots','discounts'));
    }

    public function change_password($userId = null) {
        $sessionData = getMySessionData();
        $userId = decrypt($userId);
        $id = (empty($userId) ? $this->__getUserId() : $userId);
        if (!empty($this->request->data)) {
            $user = $this->User->find('first', array(
                'fields' => 'id, first_name, last_name, email, password',
                'conditions' => array('User.id' => $id),
                'contain' => false
            ));
            if (!empty($user)) {
                if ($id == $sessionData['id'] && AuthComponent::password($this->request->data['User']['old_password']) != $user['User'] ['password']) {
                    $this->Message->setWarning(__("Old Password not matched in database."));
                } elseif ($this->request->data ['User'] ['new_password'] != $this->request->data ['User'] ['confirm_password']) {
                    $this->Message->setWarning(__("Provide same confirm password as new password."));
                } elseif ($this->request->data ['User'] ['new_password'] == "") {
                    $this->Message->setWarning(__("New Password Must Not Blank."));
                } else {
                    $user['User']['password'] = $this->request->data['User']['new_password'];
                    $user['User'] ['confirm_password'] = $this->request->data['User']['confirm_password'];
                    if ($this->User->save($user)) {
                        $this->Message->setSuccess(__("Password changed successfully."));
                        if ($user['User']['id'] == $sessionData['id']) {
                            return $this->redirect(array('action' => 'profile'));
                        }
                        return $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Message->setWarning(__("Unable to change password, Please try again."));
                    }
                }
            } else {
                $this->Message->setWarning(__("Unable to change password, Please try again."));
            }
        }
    }

    function reset_password($resetKey = null) {
        $this->layout = 'login';
        $this->set(compact('resetKey'));
        $user = $this->User->find('first', array('conditions' => array('reset_key' => $resetKey), 'recursive' => "-1"));
        if (empty($user)) {
            $this->Message->setWarning(__('Invalid reset password token.'), '/');
        }
        if (!empty($this->request->data)) {
            if (!empty($user)) {
                $user['User']['reset_key'] = '';
                $user['User']['password'] = $this->request->data ['User']['password'];
                $user['User'] ['confirm_password'] = $this->request->data ['User'] ['confirm_password'];
                if ($this->User->save($user)) {
                    $this->Message->setSuccess(__('Password changed successfully.'), array('controller' => 'users', 'action' => 'change_password'));
                } else {
                    $this->Message->setWarning(__('Unable to reset password, Please try again.'), '/');
                }
            } else {

                $this->Message->setWarning(__('Invalid reset password token.'), '/');
            }
        }
    }

    public function forgot_password() {
        $this->layout = 'login';
        if (!empty($this->request->data)) {
            $this->User->recursive = -1;
            $user = $this->User->find('first', array(
                'conditions' => array('email' => $this->request->data['User']['email']),
                'fields' => array('id', 'email', 'first_name', 'last_name', 'status', 'reset_key')
            ));
            if (!empty($user)) {
                if ($user['User']['status'] == 'active') {
					//send mail to the User
                    $user['User']['reset_key'] = $this->Common->getActivationCode($user['User']['id'], time());
                    $this->User->save($user);
                    $this->SendEmail->sendForgotPasswordEmail($user['User']);
                    $this->Session->setFlash(__('Please check your email for Password.'), 'default', array(), 'auth');
                } elseif ($user['User']['status'] == 'pending') {
                    $this->Session->setFlash(__('Your account is not varified Yet, Please verify your account.'), 'default', array(), 'auth');
                } elseif ($user['User']['status'] == 'inactive') {
                    $this->Session->setFlash(__('Your account is Inactive, Please Contact Site User.'), 'default', array(), 'auth');
                } elseif ($user['User']['status'] == 'deleted') {
                    $this->Session->setFlash(__('Your account is Deleted, Please Contact Site User.'), 'default', array(), 'auth');
                }
            } else {
                $this->Session->setFlash(__('No matching Email Address Found.'), 'default', array(), 'auth');
            }
        }
    }

    function change_status($userId = null, $status = null) {
        $responseArr = array('status' => 'fail', 'message' => __('Unable to change status of User'));
        if ($this->User->exists($userId) && !empty($status)) {
            $this->User->id = $userId;
            $this->User->saveField('status', $status);
            $responseArr = array(
                'status' => 'success',
                'message' => __('User status has been changed to ' . $status)
            );
        }
        echo json_encode($responseArr);
        exit;
    }

    public function delete($id = null) {
        if (!empty($id)) {
            $this->User->id = $id;
            //if ($this->User->saveField('status', 'deleted')) {
            if ($this->User->delete($id)) {
                $this->Message->setSuccess(__('User Deleted successfully.'));
            } else {
                $this->Message->setWarning(__('Unable to Delete user, Please try again.'));
            }
        }
        return $this->redirect(array('action' => 'index'));
    }

    function __getUserId($userId = null) {
        $sessionData = getMySessionData();
        if (empty($userId)) {
            $userId = $sessionData['id'];
            $this->set('profile', true);
        }
        return $userId;
    }

    public function getCaptcha() {
        $this->autoRender = false;
        $random = mt_rand(100, 99999);
        $this->Session->write('captcha_code', $random);

        $settings = array(
            'characters' => $random,
            'winHeight' => 50,
            'winWidth' => 230,
            'fontSize' => 20,
            'fontPath' => WWW_ROOT . '/fonts/tahomabd.ttf',
            'noiseColor' => '#254E82',
            'bgColor' => '#fff',
            'noiseLevel' => '100',
            'textColor' => '#000'
        );
        $img = $this->Captcha->ShowImage($settings);
        echo $img;
    }

    public function checkCaptcha($captcha = null) {
        $ajaxResponse = array('status' => 'fail');
        $response = false;
        if ($this->Session->read('captcha_code') == $captcha) {
            $ajaxResponse = array('status' => 'success');
            $response = true;
        }
        if ($this->request->is('ajax')) {
            echo json_encode($ajaxResponse);
            exit;
        }
        return $response;
    }

    public function getDashboardData()
    {
        $user_id = $this->Session->read('user_id') ;
        $start_date = $this->Session->read('start_date');
        $end_date = $this->Session->read('end_date');

        $this->layout = false;
        $this->autoRender = false;
        //Get Data for Dashboard
        $arrData = array();
        $keyArray = array('Posts_Found','EPI_Offending_Accounts','DEF_Offending_Accounts','GHI_Offending_Accounts');
        $keyDomainArray = array('DEF_Offending_Domains','GHI_Offending_Domains');

        $arrData['vvip']['fake_account_found'] = $this->SocialMediaDetail->getFakeAccountsFound($user_id,$start_date,$end_date,'VVIP_Fake_Accounts');
        $arrData['abc']['fake_account_found'] = $this->SocialMediaDetail->getFakeAccountsFound($user_id,$start_date,$end_date,'Posts_Found');
        $arrData['epi']['fake_account_found'] = $this->SocialMediaDetail->getFakeAccountsFound($user_id,$start_date,$end_date,'EPI_Offending_Accounts');
        $arrData['def']['fake_account_found'] = $this->SocialMediaDetail->getFakeAccountsFound($user_id,$start_date,$end_date,'DEF_Offending_Accounts');
        $arrData['ghi']['fake_account_found'] = $this->SocialMediaDetail->getFakeAccountsFound($user_id,$start_date,$end_date,'GHI_Offending_Accounts');
        $arrData['def']['key_posts'] = $this->KeyPost->getKeyPosts($user_id,$start_date,$end_date,'DEF_Key_Posts');
        $arrData['ghi']['key_posts'] = $this->KeyPost->getKeyPosts($user_id,$start_date,$end_date,'GHI_Key_Posts');

        $arrData['epi']['offending_domains'] = $this->OffendingDomain->getOffendingDomainByMonth($user_id,$start_date,$end_date,'EPI_Offending_Domains');
        $arrData['def']['offending_domains'] = $this->OffendingDomain->getOffendingDomainByMonth($user_id,$start_date,$end_date,'DEF_Offending_Domains');
        $arrData['ghi']['offending_domains'] = $this->OffendingDomain->getOffendingDomainByMonth($user_id,$start_date,$end_date,'GHI_Offending_Domains');

        $arrData['abc']['domain_discovered'] = $this->DomainsDiscovered->getDomainDiscoveredByMonth($user_id,$start_date,$end_date,'Domains_Discovered');

        foreach ($keyArray as $key => $value)
        {
           // $arrData[$value] = $this->SocialMediaDetail->getOffendingAccounts($user_id,date('Y-01-01'),date('Y-m-d'),$value);
            $arrData[$value] = $this->SocialMediaDetail->getOffendingAccounts($user_id,date('Y-01-01'),$end_date,$value);
        }

        foreach ($keyDomainArray as $key => $value) 
        {
            $arrData[$value] = $this->OffendingDomain->getOffendingDomains($user_id,date('Y-01-01'),date('Y-m-d'),$value);
        }
        
        $arrData['Domain_discovered'] = $this->DomainsDiscovered->getDomainDiscoveredCounts($user_id,$this->getYTD(),$this->getMTD(),$start_date,$end_date,'Domains_Discovered');
        $arrData['Fake_Accounts_Found'] = $this->SocialMediaDetail->getTotalFakeAccountsFound($user_id,$start_date,$end_date);
        $arrData['EPI_Offending_Domain'] = $this->OffendingDomain->getEPIOffendingDomains($user_id,$start_date,$end_date,'EPI_Offending_Domains');
        $arrData['Keywords_Monitored'] = $this->KeywordMonitored->getKeywordsMonitored($user_id,$start_date,$end_date);
        $arrData['Contact_Information'] = $this->ContactInformation->getContactInformation($user_id,$start_date,$end_date);
        //$arrData['reported_shutdown'] = $this->OffendingDomain->getReportedShutdown($user_id,$start_date,$end_date,'Fake_Accounts_Reported_Shutdown');
        $arrData['reported_shutdown'] = $this->SocialMediaDetail->getReportedShutdown($user_id,$start_date,$end_date,'VVIP_Fake_Accounts');
        
        $arrData['report'] = $this->Report->getReports($user_id,date('Y-01-01'),date('Y-m-d'));
        $arrData['ticket'] = $this->Ticket->getTickets($user_id,date('Y-01-01'),date('Y-m-d'));
        $arrData['start'] = $start_date;
        $arrData['end'] = $end_date;
        //echo "<pre>";print_r($arrData);exit;
        echo json_encode($arrData, JSON_NUMERIC_CHECK);
        exit;
    }

    public function activateUser($userId = NULL)
    {
        if(!empty($userId))
        {
            $userId = decrypt($userId);
            $userDetail = $this->User->findById($userId);
            if(isset($userDetail) && !empty($userDetail)){
                //$update = array('User.is_email_verify' => 1);
                $update = array('User.status' => "'active'");
                $where = array('User.id' => $userId);
                $this->User->updateAll($update, $where);
                $this->Message->setSuccess(__('The user has been activated successfully.'));
            }
        }
        else
        {
            $this->Message->setWarning(__('The user not activated successfully.'));
        }
        return $this->redirect($this->Auth->loginRedirect);
    }

    public function getYTD(){
        $start_date = date('Y-m-d',strtotime(date('Y-01-01')));
        $enddate = date('Y-m-d');
        $date['start_date'] = $start_date;
        $date['end_date'] = $enddate;
        return $date;
    }
    public function getMTD(){
        $start_date = date('Y-m-d',strtotime(date('Y-m-01')));
        $enddate = date('Y-m-d');
        $date['start_date'] = $start_date;
        $date['end_date'] = $enddate;
        return $date;
    }

    public function setDate(){
//        if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
//            $this->Session->write('user_id',$this->params['pass'][0]) ;
//        }else{
//            $this->Message->setWarning(__('Please select user'));
//            return $this->redirect(array('action' => 'index'));
//        }
        if (isset($_POST['from_date']) && !empty($_POST['from_date'])) {
            $this->Session->write('start_date',$_POST['from_date']) ;
        }
        if (isset($_POST['to_date']) && !empty($_POST['to_date'])) {
            $this->Session->write('end_date',$_POST['to_date']) ;
        }
        return $this->redirect(array('action' => 'dashboard'));
    }

    public function showDashboardData($table_name, $ref_type, $ref_field_name = NULL)
    {
        $this->layout = false;
        $this->loadModel('Monitoring');
        $this->loadModel('Vvip');

        $user_id = $this->Session->read('user_id') ;
        $start_date = $this->Session->read('start_date');
        $end_date = $this->Session->read('end_date');
        $monitoringData = array();
        $field =null;
        $field_values =null;
        if($ref_field_name=="ytd")
        {
            $start_date = date("Y-m-d", strtotime('first day of January '.date('Y') ));
            $end_date = date("Y-m-d", strtotime('last day of December '.date('Y') ));
            $ref_field_name = NULL;
        }
        if($ref_field_name=="mtd")
        {
            $start_date = date('Y-m-d', strtotime('first day of this month')) ;
            $end_date = date('Y-m-d', strtotime('last day of this month')) ;
            $ref_field_name = NULL;
        }

        if($table_name=="SocialMediaDetail" && in_array($ref_field_name,['reported','shutdown']))
        {
            $field ='field4';
            $field_values =$ref_field_name;
            $ref_field_name = NULL;
        }
        if($table_name=="OffendingDomain" && in_array($ref_field_name,['reported','blocked']))
        {
            $field ='field2';
            $field_values =$ref_field_name;
            $ref_field_name = NULL;
        }
        $reference = array(
            'reference_type' => $ref_type,
            'field_ref_name' => $ref_field_name,
            'field' => $field,
            'field_values' => $field_values
        );

        $arrData = $this->getPrimaryId($table_name,$user_id, $start_date, $end_date, $ref_type,$ref_field_name);
        
        if(!empty($arrData)){
            $monitoringData = $this->Monitoring->getMonitoringData($arrData, $reference);
        }
       
        $vvips = $this->Vvip->getvvipList($user_id);
		
		$this->set(compact('monitoringData','ref_type','vvips','ref_field_name'));
		$this->render('monitoring_data');
		        
		//$htmlDataTable = $this->render('/Elements/user/process_files')->body();
    }

    function getPrimaryId($table_name, $user_id, $start_date, $end_date, $ref_type,$ref_field_name=null)
    {
        $ids = array();
        $conditions = array('user_id'=>$user_id,'date >=' => $start_date,'date <=' => $end_date);
        if($table_name!="DomainsDiscovered"){
            $conditions['type']=$ref_type;
        }
        
        $data = $this->$table_name->find('all',array('fields'=>array('id'),'conditions'=>$conditions));

        if(!empty($data))
        {
            foreach($data as $values)
            {
                $ids[]= $values[$table_name]['id'];
            }
        }
        return $ids;
    }

    public function showDomainTrackData($table_name, $ref_type)
    {
        $this->layout = false;
        $user_id = $this->Session->read('user_id') ;
        $start_date = $this->Session->read('start_date');
        $end_date = $this->Session->read('end_date');
        $conditions = array('user_id'=>$user_id,'date >=' => $start_date,'date <=' => $end_date,'type'=>$ref_type);
		if(in_array($table_name,array('Vvip'))){
			$conditions = array('user_id'=>$user_id);
		}
        
        $domainData = $this->$table_name->find("all",array(
            'conditions' => $conditions,'recursive'=>-1
        ));
		
        $this->set(compact('domainData'));
        $this->render('domain_track_data');
    }


}

?>
