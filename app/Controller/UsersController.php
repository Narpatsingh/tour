<?php

/**
 * @property User $User
 */
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $components = array('Auth', 'Captcha', 'Cookie');
    public $uses = array('User','SiteConfig');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('getCaptcha','activateUser','dashboard','login','maintainace','forgot_password');
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
        $this->loadModel('State');
        $this->loadModel('City');
        $this->loadModel('Hotel');
        $this->loadModel('Slider');
        $hotels = $this->Hotel->find('all');
        $states = $this->State->find('all', array('fields'=>array('name'),'contain' => false));
        $cities = $this->City->find('list');
        $destination = $this->Tour->find('list',array('fields' => array('place','place')));
        $specials = $this->Tour->find('all', array('contain' => false,'conditions' => array('Tour.type' => '1')));
        $hots = $this->Tour->find('all', array('contain' => false,'limit'=>6,'conditions' => array('Tour.type' => '2')));
        $discounts = $this->Tour->find('all', array('contain' => false, 'conditions' => array('Tour.type' => '3')));
        $blogs = $this->Tour->find('all', array('contain' => false, 'limit'=>6,'order' => array('Tour.id' => 'DESC')));
        $sliders = $this->Slider->find('all');
        $this->set(compact('specials','hots','discounts','states','cities','hotels','blogs','destination','sliders')); 
    }

    public function maintainace()
    {

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

    public function site_status($value='')
    {
        $this->loadModel('SiteConfig');
        $this->SiteConfig->updateAll(array('value' => "'" . $value . "'"), array('key' => 'Site.Status'));
        $this->Message->setSuccess(__('Site status is changed.'));
        Cache::delete('siteConfig');
        return $this->redirect($this->Auth->loginRedirect);
    }


}

?>
