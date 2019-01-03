<?php

App::uses('AppModel', 'Model');
/**
 * @property SiteConfig $SiteConfig
 */
class SiteConfig extends AppModel {

    var $name = 'SiteConfig';
    var $primaryKey = 'key';
    var $displayField = 'value';
    var $validate = array(
        'key' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter Key',
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'This Key is already exist',
            ),
        )
    );

    function updateConfigs($arrConfigs) {
        foreach ($arrConfigs as $key => $val) {
            if(!empty($key)){
                $val = Sanitize::clean($val);
                $this->updateAll(array('value' => "'" . $val . "'"), array('key' => $key));
            }            
        }
    }

}

?>
