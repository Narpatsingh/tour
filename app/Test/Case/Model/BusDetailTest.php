<?php
App::uses('BusDetail', 'Model');

/**
 * BusDetail Test Case
 *
 */
class BusDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bus_detail'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BusDetail = ClassRegistry::init('BusDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BusDetail);

		parent::tearDown();
	}

}
