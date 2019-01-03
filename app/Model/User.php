<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @property User $User
 */
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{
    var $name = 'User';
    var $displayField = 'name';

	public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->virtualFields['name'] = sprintf(
            'CONCAT(%s.first_name, " ", %s.last_name)', $this->alias, $this->alias
        );
    }
    public $actsAs = array(
        'Upload.Upload' => array(
            'photo' => array(
                'thumbnailMethod' => 'php',
                'thumbnailSizes' => array(
                    'thumb' => '200w',
                ),
            )
        ),
        'Containable'
    );


    public $validate = array(
        'first_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Please enter a first name.'
            ),
            'minLength' => array(
                'rule' => array('minLength', 2),
                'message' => 'Please enter at least two characters first name'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 50),
                'message' => 'Please enter first name between 2 to 50 characters.'
            )
        ),
        'last_name' => array(
            'minLength' => array(
                'rule' => array('minLength', 2),
                'message' => 'Please enter at least two characters last name'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 50),
                'message' => 'Please enter last name between 2 to 50 characters.'
            )
        ),
//        'phone_no' => array(
//            'numeric' => array(
//                'rule' => 'numeric',
//                'allowEmpty' => true,
//                'message' => 'Please enter valid phone no.'
//            ),
//            '10-digit' => array(
//                'rule' => array('phone', '/^[0-9]( ?[0-9]){8} ?[0-9]$/'),
//                'message' => 'Please enter 10 digit phone no.'
//            )
//        ),
        'address' => array(
            'maxLength' => array(
                'rule' => array('maxLength', 150),
                'message' => 'Please enter address within 150 characters.'
            )
        ),
        'email' => array(
            'notempty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please enter Email Address',
                'last' => true,
            ),
            'email' => array(
                'rule' => array('email'),
                'message' => 'Please Enter a valid Email Address'
            ),
            'isUnique' => array(
                'rule' => array('isUniqueUser'),
                'message' => 'Email Address already Exist.'
            )
        ),
        'password' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter Password.',
                'last' => false
            ),
            'minLength' => array(
                'rule' => array('minLength', 6),
                'message' => 'Please enter at least six characters password'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 15),
                'message' => 'Please enter password between 6 to 15 characters.'
            )
        ),
        'confirm_password' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'on' => 'create',
                'message' => 'Please enter Confirm Password.',
                'last' => false
            ),
            'identicalFieldValues' => array(
                'rule' => array('identicalFieldValues', 'password'),
                'message' => 'Please re-enter your password twice so that the values match',
                'last' => true
            )
        ),
        'status' => array(
            'inList' => array(
                'rule' => array('inList', array('active', 'inactive', 'pending', 'deleted')),
                'message' => 'Please choose status from options.'
            ),
        ),
        'photo' => array(
            'isUnderPhpSizeLimit' => array(
                'rule' => 'isUnderPhpSizeLimit',
                'message' => 'File exceeds upload filesize limit',
            ),
            'isValidExtension' => array(
                'rule' => array('isValidExtension', array('jpg', 'png', 'jpeg', 'gif'), false),
                'message' => 'Please upload valid Image File',
            )
        )
    );
	
    function identicalFieldValues($field = array(), $compare_field = null)
    {
        foreach ($field as $key => $value) {
            $v1 = $value;
            $v2 = $this->data[$this->name][$compare_field];
            if ($v1 !== $v2) {
                return false;
            } else {
                continue;
            }
        }
        return true;
    }

    function beforeSave($options = array())
    {
        if (!empty($this->data['User']['password'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha1'));
            $this->data['User']['password'] = $passwordHasher->hash($this->data['User']['password']);
        }
		if (!empty($this->data['User']['email_password'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha1'));
            $this->data['User']['email_password'] = base64_encode($this->data['User']['email_password']);
        }		
        return true;
    }

    function afterSave($created, $options = array())
    {

        parent::afterSave($created, $options);
    }

    public function isUniqueUser($email = null)
    {
		$user = array();
        if (!empty($email)) {
			$this->recursive = -1;
			$userId = isset($this->data['User']['id'])?$this->data['User']['id']:0;
            $user = $this->find('count',array('conditions'=>array('id !='=>$userId,'email'=>$email,'status !='=>'deleted')));
            if (empty($user)) {
                return true;
            }
            return false;
        }
    }


    public function getUserList()
    {
        return $this->find('list', array(
            'conditions' => array(
                'status' => 'active',
//                'role !=' => 'admin'
            ),
            'contain' => false,
            'fields' => 'id, name'
        ));
    }
    
    public function getOnlyUserList()
    {
        return $this->find('list', array(
            'conditions' => array(
                'status' => 'active',
                'role !=' => 'admin'
            ),
            'contain' => false,
            'fields' => 'id, name'
        ));
    }

    public function getAdminIds()
    {
        return $this->find("list",[
            "fields"=>"id",
            "conditions"=>["role"=>"admin"],
            "recursive"=> -1
        ]);
    }

    public function getUserDetail($id = null)
    {
        return $this->find('first', array(
            'contain' => false,
            'conditions' => array(
                'id' => $id
            )
        ));
    }

}
