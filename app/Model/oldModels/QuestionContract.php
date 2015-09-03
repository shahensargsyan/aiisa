<?php
class QuestionContract extends AppModel{
         public $validate = array(
            'question_id' => array(
                'rule' => 'notEmpty'),
            'category_id' => array(
                'rule' => 'notEmpty')         
        );       
}
?>
