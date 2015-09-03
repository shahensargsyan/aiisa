<?php
class Project extends AppModel{
    public $validate = array(
        'name' => array(
             'rule' => array('maxLength', 255),
             'message' => 'names must be no larger than 255 characters long.'
        ),
        'description' => array('rule' => 'notEmpty')
    );
}
?>
