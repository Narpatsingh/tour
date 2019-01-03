<?php
/**
 * CustomerFixture
 *
 */
class CustomerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'mobile' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'address' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'dob' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'member' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'emergency_mobile' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'dob_proof' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 1,
			'mobile' => 1,
			'address' => 1,
			'dob' => 1,
			'member' => 1,
			'emergency_mobile' => 1,
			'dob_proof' => 1,
			'created' => 1
		),
	);

}
