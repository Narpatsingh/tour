<?php
App::uses('SocialMediaDetail', 'Model');

/**
 * SocialMediaDetail Test Case
 *
 */
class SocialMediaDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.social_media_detail',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SocialMediaDetail = ClassRegistry::init('SocialMediaDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SocialMediaDetail);

		parent::tearDown();
	}

}
