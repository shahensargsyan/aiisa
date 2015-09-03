<?php

class BlockedEmail extends AppModel {

    public $validate = array(
        'email_address' => array(
            'email' => array(
                'rule' => 'email',
                'message' => 'Please supply a valid email address'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This email has already been taken.'
            ),
            'reason' => array(
                'rule' => 'notEmpty',)
        )
    );

}

?>