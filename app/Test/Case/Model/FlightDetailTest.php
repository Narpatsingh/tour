<?php
App::uses('FlightDetail', 'Model');

/**
 * FlightDetail Test Case
 *
 */
class FlightDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.flight_detail'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FlightDetail = ClassRegistry::init('FlightDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FlightDetail);

		parent::tearDown();
	}

}
