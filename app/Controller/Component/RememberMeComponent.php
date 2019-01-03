<?php

class RememberMeComponent extends Component {

    var $components = array('Auth', 'Cookie', 'Common', 'Session');
    var $controller = null;
    var $period = '+365 days';
    var $cookieName = 'ulrm';

    public function __construct(ComponentCollection $collection, $settings = array()) {
        $this->settings = $settings;
        parent::__construct($collection, $settings);
    }

    function remember($userId, $type = 'User') {
        $cookieName = $this->getCookieName($type);
        $cookie = array('userId' => $userId, 'loginTime' => time());
        $userCookie = Security::encrypt(json_encode($cookie), Configure::read('Security.salt'));
        $this->Cookie->write($cookieName, $userCookie, true, $this->period);
    }

    function check($type = 'User') {
        if ($this->Session->check('Auth.' . ucfirst($type))) {
            return true;
        }
        $cookie = $this->Cookie->read($this->getCookieName($type));
        if (!empty($cookie)) {
            $userCookie = Security::decrypt($cookie, Configure::read('Security.salt'));
            if (isset($userCookie)) {
                $cookie = json_decode($userCookie, true);
            }
            if (!empty($cookie['userId'])) {
                $this->Common->loginWithUserId($cookie['userId'], ucFirst($type));
            }
        }
    }

    function delete($type = 'User') {
        $cookieName = $this->getCookieName($type);
        $this->Cookie->delete($cookieName);
    }

    function getCookieName($type = 'User') {
        $cookieName = $this->cookieName;
        if ($type) {
            $cookieName = $type . $cookieName;
        }
        return strtolower($cookieName);
    }

}

?>
