<?php
    class EventType extends AppModel{
        public $validate = array(
            'name' => array(
                'rule' => array('maxLength', 100),
                'message' => 'name must be no larger than 255 characters long.'
            )
        );
}
?>
