<?php

class Review extends AppModel {

    public $validate = array(
        'first_name' => array(
            'rule' => array('maxLength', 255),
            'message' => 'First name must be no larger than 255 characters long.'),
        'last_name' => array(
            'rule' => array('maxLength', 255),
            'message' => 'Last name must be no larger than 255 characters long.'),
        'email' => array(
            'rule' => 'email',
            'message' => 'Please supply a valid email address'
        ),
        'review' => array(
            'rule' => array('maxLength', 100),
            'message' => 'Review must be no larger than 100 characters long.'
        )
    );

}

?>
