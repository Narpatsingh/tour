<?php
App::uses('AppModel', 'Model');
/**
 * AccountHistory Model
 *
 * @property Account $Account
 */
class AccountHistory extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    public function insertLog($data = array())
    {
        if (!empty($data)) {
            $this->save($data);
        }
    }	
    public function ManageLog($data = array())
    {
    	unset($data['created'],$data['updated']);
        $data = array(
            'account_id' => $data['id'],
            'payment_recieved' => $data['payment_recieved'],
            'reason' => empty($data['reason'])?'':$data['reason'],
            'detail' => json_encode($data),
            'type' => $data['ac_type'],
        );
        $this->insertLog($data);
    }
}
