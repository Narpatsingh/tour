<?php
App::uses('AppModel', 'Model');
/**
 * Account Model
 *
 * @property Voucher $Voucher
 */
class Account extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'payment_amount';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'payment_recieved' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Voucher' => array(
			'className' => 'Voucher',
			'foreignKey' => 'voucher_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public function afterSave($created, $options = array()){
    if($created) {
	$accountHistory = ClassRegistry::init("AccountHistory");
	$accountHistory->ManageLog($this->data['Account']);
    }
	}

	public function get_total_payment_with_gst($id='')
	{
		$total_payment = $this->find('first', array('fields'=>array('total_payment_with_gst'),'conditions' => array('Account.id'=> $id)));
		return $total_payment['Account']['total_payment_with_gst'];
	}
}
