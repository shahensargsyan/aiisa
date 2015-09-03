<?php

App::uses('AppController', 'Controller');

/**
 * Dynamic content controller
 *
 * @package       app.Controller
 */
class ContentsController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array(
        'CustomPages'
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'user';
        if($this->action != 'home'){
            if($this->Auth->checkUser()){
                $user_data = $this->User->find('first',array(
                    'conditions' => array(
                        'id' => $this->Auth->getUser()
                    )
                ));
                if($user_data['User']['active'] == false){
                    $this->Session->destroy();
                    $this->Cookie->delete('remember');
                    $this->redirect(array('controller' => 'pages', 'action' => 'home'));
                }
            }
        }
    }
    
    /**
     * Displays a home page
     *
     */
    
    public function view() {
        if($this->params['page']){
            $url = $this->params['page'];
            $this->loadModel('CustomPage');
            $data = $this->CustomPage->find(
                'first', 
                array(
                    'conditions' => array(
                        'url' => $url,
                        'active' => 1
                    ),
                )
            );
            if($data){
                $this->set('data', $data);
            }else{
               $this->redirect('/'); 
            }
            $this->viewData['title_for_layout'] = ucfirst($data['CustomPage']['title']) . ' | ' . $this->viewData['title_for_layout'];
            $this->viewData['index_search_engine'] = $data['CustomPage']['index'];
            
        }else{
            $this->redirect('/');
        }
    }
    
    public function search(){
        //var_dump($this->request->params["named"]["page"]);die;
        if(!$this->data){
            $this->data = $this->Session->read('search');
        }else{
            $this->Session->write('search',$this->data);
        }
        if($this->request->data || isset($this->request->params["named"]["page"])){
            $this->paginate = array(
                'Publication' => array(
                    'conditions' => $this->request->data["Search"]["term"],
                    'limit' => 4,
                    'queryId' => 1, 
                )
            );
            $result = $this->paginate('Publication');
            $this->viewData['result'] = $result;
        }

    }
    public function index(){
        $this->redirect('/');
    }
}
