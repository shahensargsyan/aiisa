<?php

class Library extends AppModel {

    public $name = "Library";
    
    public $validate = array(

        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'title cannot be empty'
        ),
        'filenama' => array(
            'rule' => 'notEmpty',
            'message' => 'link cannot be empty'
        )
    );
}

