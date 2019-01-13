<?php
App::uses('AppModel', 'Model');
/**
 * FlightDetail Model
 *
 */
class FlightDetail extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'company_name';
    public $belongsTo = array(
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'customer_id'
        ),
    );
}
