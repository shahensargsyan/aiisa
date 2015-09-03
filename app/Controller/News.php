<?php

class News extends AppModel {

    public $name = "News";
    
    public $validate = array(
        'label' => array(
            'rule' => 'notEmpty',
            'message' => 'label cannot be empty'
        ),
        'quote' => array(
            'rule' => 'notEmpty',
            'message' => 'quote cannot be empty'
        ),
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'title cannot be empty'
        ),
        'secondary_link' => array(
            'rule' => 'notEmpty',
            'message' => 'link cannot be empty'
        ),
        'date' => array(
            'rule' => 'notEmpty',
            'message' => 'date cannot be empty'
        ),
        'author' => array(
            'rule' => 'numeric',
            'message' => 'author cannot be empty'
        ),
    );
    
}

