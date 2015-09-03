<?php

class Video extends AppModel{
    public $name = "Video";
    
    public $validate = array(
        'content' => array(
            'rule' => 'notEmpty',
            'message' => 'content cannot be empty'
        ),
        'link' => array(
            'rule' => 'notEmpty',
            'message' => 'link cannot be empty'
        ),
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'title cannot be empty'
        )
    );
}