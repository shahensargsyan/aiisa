<?php

class Contact extends AppModel {

    public $validate = array(
        'first_name' => array(
            'rule' => array('maxLength', 255),
            'message' => 'name must be no larger than 255 characters long.'),
        'email' => array(
            'rule' => 'email',
            'message' => 'Please supply a valid email address'
        ),
        'phone_number' => array(
            'rule' => 'numeric',
            'allowEmpty' => true,
            'message' => 'Phone number should be numeric'),
        'text' => array(
            'rule' => 'notEmpty',
            'message' => 'Please write a message.'),
    );

}

?>
