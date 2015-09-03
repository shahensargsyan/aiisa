<?php
class Slider extends AppModel{
    public $validate = array(
        'title' => array(
             'rule' => array('maxLength', 255),
             'message' => 'title must be no larger than 255 characters long.'
        ),
    );
    
    public function getSliders(){
        $sliders = $this->find('all',array(
            'conditions' => array(
                'active' => 1
            )
        ));

        return $sliders;
    }
}
?>
