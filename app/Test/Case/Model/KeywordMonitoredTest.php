<?php
App::uses('KeywordMonitored', 'Model');

/**
 * KeywordMonitored Test Case
 *
 */
class KeywordMonitoredTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.keyword_monitored',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->KeywordMonitored = ClassRegistry::init('KeywordMonitored');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->KeywordMonitored);

		parent::tearDown();
	}

}
