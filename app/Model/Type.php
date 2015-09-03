<?php
    class Type extends AppModel{
        public $validate = array(
            'name' => array(
                'rule' => array('maxLength', 255),
                'message' => 'name must be no larger than 255 characters long.'
            )
        );
}
?>
