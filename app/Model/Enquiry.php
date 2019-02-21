<?php
App::uses('AppModel', 'Model');
/**
 * RiskFactor Model
 *
 */
class Enquiry extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    public $belongsTo = array(
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'customer_id'
        ),
        'City' => array(
            'className' => 'Tour',
            'foreignKey' => 'destination'
        ),
        /*'Package' => array(
            'className' => 'Tour',
            'foreignKey' => false,
            'conditions' => 'Customer.package_id = Package.id'
        )*/        
    );
}
