<?php
App::uses('AppModel', 'Model');
/**
 * Gallery Model
 *
 */
class Gallery extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

	public $actsAs = array(
        'Upload.Upload' => array(
            'photo' => array(
                'thumbnailMethod' => 'php',
                'thumbnailSizes' => array(
                    'thumb' => '200w',
                ),
            )
        ),
        'Containable'
    );

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
