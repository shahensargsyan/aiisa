<?php
class Footer extends AppModel {
    public $validate = array(
        'name' => array(
            'rule'    => 'isUnique'),
        'text' => array(
            'rule'=> 'notEmpty'),
        'navigation' => array(
            'rule'=> 'notEmpty'),
        'position' => array(
            'rule'=> 'notEmpty'),        

    );
    public function validateFooter($data) {
        $result = array();
        try {
            if (!trim($data["name"])) {
                throw new Exception(__("The name is required"));
            }
            if(!trim($data['text'])){
                throw new Exception(__("Content can not be empty"));
            }
            $result["status"] = true;
            $result["msg"] = "Your request successfully done.";
        } catch (Exception $exc) {
            $result["status"] = false;
            $result["msg"] = $exc->getMessage();
        }
        return $result;
    }

}

?>
