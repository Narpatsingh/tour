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

}
