<?php
class ProjectController extends AppController{
    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'user';
    }
    public function index(){
        
    }
    
    public function view($id = null){
        if($id){
            
        }else{
            
        }
    }
}