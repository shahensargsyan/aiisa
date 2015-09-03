<?php
class Membership extends AppModel {
    public $validate = array(
        'name' => array(
            'rule' => array('maxLength', 255),
            'message' => 'names must be no larger than 255 characters long.'),
        'type' => array(
            'rule'=> 'notEmpty',
             'message' => 'Select the type of'),
        'month_price' => array(
            'rule' => array('money', 'left'),
            'allowEmpty' => true,
            'message' => 'Please supply a valid monetary amount.'),
        'month_count' => array(
            'rule' => 'numeric',
            'allowEmpty' => true,
            'message'=>'Count should be numeric'),
        'individual_price' => array(
            'rule' => array('money', 'left'),
            'allowEmpty' => true,
            'message' => 'Please supply a valid monetary amount.'),       
    );
}
?>
