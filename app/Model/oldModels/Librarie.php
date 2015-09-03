<?php
class Librarie extends AppModel {
        public $validate = array(
        'title' => array(
            'rule' => array('maxLength', 255),
            'message' => 'title must be no larger than 255 characters long.'),   
        'description' => array(
            'rule' => 'notEmpty'),
        'lib_file' => array(
            'rule'=> array('extension',array('pdf', 'docx', 'doc')),
            'message' => 'Please upload a file')
    );
}
?>
