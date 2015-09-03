<?php
class IndividualDay extends AppModel {
        public $validate = array(
            'day' => array(
                'rule' => 'numeric',
                'allowEmpty' => true,
                'message'=>'day should be numeric'),
            'finished_document' => array(
                'rule' => 'numeric',
                'message'=>'day should be numeric'),
            'unfinished_document' => array(
                'rule' => 'numeric',
                'message'=>'day should be numeric'),
        );
}
?>
