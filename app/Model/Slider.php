<?php
App::uses('AppModel', 'Model');
/**
 * Slider Model
 *
 */
class Slider extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'slider';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

	public $belongsTo = array(
		
		'Tour' => array(
			'className' => 'Tour',
			'foreignKey' => 'tour_id',
		),
	);

}
