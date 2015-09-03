<?php

class SiteMap extends AppModel {

    public $validate = array(
        'url' => array(
            'rule' => array('maxLength', 255),
            'message' => 'name must be no larger than 255 characters long.'),
    );

}

?>
