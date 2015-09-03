<?php
class PublicationsController extends AppController{
    public $name = 'Publications';


    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'user';

    }
    
    public function index(){
        
    }
    
    public function twt(){
        $publications = $this->Publication->find('all',array(
            'conditions' => array(
                'public' => 1
            ),
            'limit' => 10
        ));
        var_dump($publications);die;
    }
    
    public function ai(){
        
    }
}