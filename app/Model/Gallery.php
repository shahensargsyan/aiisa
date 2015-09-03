<?php
class Gallery extends AppModel{
    public $validate = array(
        'title' => array(
             'rule' => array('maxLength', 255),
             'message' => 'title must be no larger than 255 characters long.'
        ),
        'folder' => array(
            'rule'=> 'notEmpty'
        ),
        'main_image' => array(
            'rule'=> 'notEmpty'
        ),
    );
}
?>
