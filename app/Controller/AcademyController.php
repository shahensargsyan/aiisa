<?php
class AcademyController extends AppController{
    public $name = 'Academy';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'user';
    }
    
    public function index(){
        
    }
    
    public function view(){
        if($this->params['page']){
            $page = $this->params['page'];
            $page = preg_replace('/_/', ' ', $page);
            $data = $this->Academy->find('first', array(
                'conditions' => array('Academy.name' => $page),
                'fields' => array('Academy.*')
            ));
            if($data){
                $this->set('data', $data);
            }else{
               $this->redirect('/'); 
            }
        }else{
            $this->redirect('/');
        }
    }
}
