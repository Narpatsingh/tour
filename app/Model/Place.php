<?php
App::uses('AppModel', 'Model');
/**
 * Place Model
 *
 */
class Place extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

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

    public $belongsTo = array(
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'city_id',
        ),
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'state_id',
        ),
    );

}
