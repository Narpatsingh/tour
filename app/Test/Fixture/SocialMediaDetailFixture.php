<?php
/**
 * SocialMediaDetailFixture
 *
 */
class SocialMediaDetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'date' => array('type' => 'date', 'null' => false, 'default' => null),
		'twitter' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'instagram' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'other' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'cretaed_at' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated_at' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'user_id' => 1,
			'date' => '2017-08-30',
			'twitter' => 1,
			'instagram' => 1,
			'other' => 1,
			'cretaed_at' => '2017-08-30 01:53:25',
			'updated_at' => '2017-08-30 01:53:25'
		),
	);

}
