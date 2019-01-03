<?php
App::uses('TrainDetail', 'Model');

/**
 * TrainDetail Test Case
 *
 */
class TrainDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.train_detail'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TrainDetail = ClassRegistry::init('TrainDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TrainDetail);

		parent::tearDown();
	}

}
