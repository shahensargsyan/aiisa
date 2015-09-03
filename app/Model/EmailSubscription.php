<?php
    class EmailSubscription extends AppModel{
          public $validate = array(
             'email' => array(
                 'email' => array(
                     'rule' => 'email',
                     'message'  => 'Please supply a valid email address'
                 ),
                 'isUnique' => array(
                     'rule' => 'isUnique' ,
                     'message' => 'This email has already been taken.'
                 )
             ),
            'first_name' => array(
                'rule' => array('maxLength', 255),
                'message' => 'names must be no larger than 255 characters long.'
            ),
            'last_name' => array(
                'rule' => array('maxLength', 255),
                'message' => 'names must be no larger than 255 characters long.'
            ),
         );       
    }
?>
