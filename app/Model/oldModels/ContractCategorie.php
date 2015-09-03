<?php
    class ContractCategorie extends AppModel{
        public $validate = array(
            'contract_id' => array(
                'rule' => 'notEmpty'),
            'category_id' => array(
                'rule' => 'notEmpty')         
        );        
        public function category($category_id,$question_id){
        $i = 0;
        foreach ($category_id as $id){
            $category[$i]['contract_id'] = $question_id;
            $category[$i]['category_id'] = $id;
            $i++;
        }
        return $category;
    }
    }
?>
