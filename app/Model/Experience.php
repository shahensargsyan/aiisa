<?php

class Experience extends AppModel {

    public $name = "Experience";
    
    public $validate = array(
        'title' => array(
            'rule' => array('maxLength', 1000),
            'message' => 'names must be no larger than 1000 characters long.')
    );


}

