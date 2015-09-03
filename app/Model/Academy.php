<?php

class Academy extends AppModel {

    public $name = "Academy";
    
    public $validate = array(
        'content' => array(
            'rule' => 'notEmpty',
            'message' => 'content cannot be empty'
        ),
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'title cannot be empty'
        ),
        'content' => array(
            'rule' => 'notEmpty',
            'message' => 'content cannot be empty'
        ),
        'intro_text' => array(
            'rule' => 'notEmpty',
            'message' => 'intro_text cannot be empty'
        ),
    );


}

