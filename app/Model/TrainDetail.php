<?php
App::uses('AppModel', 'Model');
/**
 * TrainDetail Model
 *
 */
class TrainDetail extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'customer_id';
    public $belongsTo = array(
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'customer_id'
        ),
    );
}
