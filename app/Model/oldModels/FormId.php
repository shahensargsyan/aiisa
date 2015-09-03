<?php

class FormId extends AppModel {

    public $validate = array(
        'form_id' => array(
            'alphanumeric' => array(
                'rule' => '/^[a-z0-9_]{3,}$/i',
                'message' => 'Please supply a valid FormId'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This FormId has already been taken.'
            ),
        )
    );
    public function chekFormId($form_id){
        $first_sim = substr($form_id,0,(-strlen($form_id)+1));
        $arr_sim = array('0','1','2','3','4','5','6','7','8','9','_');
        if(in_array($first_sim, $arr_sim)){
            return true;
        }
        else {
            return false;
        }
    }
}

?>
