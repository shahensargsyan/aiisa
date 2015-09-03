<?php
class Question extends AppModel{
    public $validate = array(
        'question' => array(
            'rule' => 'notEmpty'),
        'answer' => array(
            'rule' => 'notEmpty'),
        'active' => array(
            'rule'=> 'notEmpty')

    );
    public function category($contract_id,$question_id){
        $i = 0;
        foreach ($contract_id as $id){
            $contract[$i]['question_id'] = $question_id;
            $contract[$i]['contract_id'] = $id;
            $i++;
        }
        return $contract;
    }
}
?>
