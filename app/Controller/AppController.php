<?php

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @property SessionComponent $Session Session Handling Coponent
 * @property AuthComponent $Auth Authentication component
 * @property DashboardComponent $Dashboard Dashboard data collector
 * @property MailerComponent $Mailer Emailing Coponent
 * @property UploadComponent $Upload File upload Handling Coponent
 * @property User $User User model
 *
 */
class AppController extends Controller {

    /**
     * The dependency components needed
     * @var array An array of component names
     */
    public $components = array(
        'Cookie',
        'Paginator',
        'Session',
        'Auth',
        'Dashboard',
        'Mailer',
    );
    public $helpers = array('Html' => array('className' => 'MyHtml'), 'Form', 'Session', 'Paginator');

    /**
     * The dependency Models needed
     * @var array An array of model names
     */
    public $uses = array(
        'User',
        'Publication',
        'ExpertComment',
        'Region',
        'Topic',
        'Expert',
        'Program',
        'EventType',
        'Event',
        'Footer',
        'Slider',
        'Academy',
        'Project',
        'Type',
        'Video'
    );

    /**
     * Logged in user id
     * @var int An int of user Id
     */
    public $u_id = null;
    
    /**
     * Logged in expert id
     * @var int An int of user Id
     */
    public $expert_id = null;

    /**
     * Logged in user related Data
     * @var array An array of logged in user
     */
    public $userDb = null;

    /**
     * Variable For setting data to view file
     * @var array An array of variables to be set to view
     */
    public $viewData = null;

    /**
     * Variable For setting scripts to view file
     * @var array An array of script paths to be set to view
     */
    public $scripts_for_layout_include = array();
    
    /**
     * Variable For setting css to view file
     * @var array An array of css paths to be set to view
     */
    public $css_for_layout_include = array();

    public $allregions = array();
    public $topics = array();
    public $projecrs = array();

    public function beforeFilter() {
        parent::beforeFilter();
        
        if ($this->Cookie->read('langs') && $this->action !== 'language') {
            Configure::write('Config.language', $this->Cookie->read('langs'));
            $this->params['language'] = $this->Cookie->read('langs');
        } elseif ($this->request->language) {
            Configure::write('Config.language', $this->request->language);
        }
                
        $this->loadModel("Language");
        $languages = $this->Language->find('all', array(
            'conditions' => array(
                'Language.active' => 1
            )
        ));
        $lang = array();
        foreach ($languages as $key => $value) {
            $lang[$key] = array(
                'text' => $value['Language']['name'],
                'value' => $value['Language']['id'],
                'selected' => ($value['Language']['lang_code'] == 'eng') ? true : false,
                'imageSrc' => $this->webroot . 'img/' . $value['Language']['flag'],
            );
        }
        $this->viewData['languages'] = json_encode($lang);
//        $this->viewData['languages'] = $languages;

        $this->_setLanguage();

        $this->u_id = $this->Auth->checkUser();
        $this->viewData['u_id'] = $this->u_id;
        $this->viewData['title_for_layout'] = 'AIISA';
        //var_dump($this->Session->read('User.id'));die;
        if ($this->u_id) {
            $this->userDb = $this->Dashboard->getData();
            $this->viewData['userDb'] = $this->userDb;
        }
        
        //script files for all project
        $this->scripts_for_layout_include[] = 'jquery-1.8.3.min';

        $this->scripts_for_layout_include[] = 'jquery.ddslick.min';
        $this->scripts_for_layout_include[] = 'jquery.validate.min';
        if ($this->params['controller'] != 'admins' && $this->params['controller'] != 'experts') {
            $this->scripts_for_layout_include[] = 'jquery-ui.min';
            $this->scripts_for_layout_include[] = 'jquery-ui';

            ///given
            $this->scripts_for_layout_include[] = 'jquery.main';
            
        }
        $this->scripts_for_layout_include[] = 'bootstrap.min';
        $this->scripts_for_layout_include[] = 'jquery.jgrowl.min';

        //css files for all project
        if ($this->params['controller'] != 'admins' && $this->params['controller'] != 'experts') {
            $this->css_for_layout_include[] = 'jquery.jgrowl';
            $this->css_for_layout_include[] = 'jquery-ui';

            ///given
            $this->css_for_layout_include[] = 'jquery-ui.min';
            $this->css_for_layout_include[] = 'bootstrap.min';
            $this->css_for_layout_include[] = 'bootstrap-theme.min';
            $this->css_for_layout_include[] = 'all';
        }
        

        $topics = $this->getTopics();
        $this->viewData['allTopics'] = $topics;
        
        $allregions = $this->getRegions();
        $this->viewData['allRegions'] = $allregions;
        
        $eventTypes = $this->getEventTypes();
        $this->viewData['eventTypes'] = $eventTypes;
        
        $projecrs = $this->getProjects();
        $this->viewData['projecrs'] = $projecrs;
            
        $lastExCom = $this->ExpertComment->find('first',array(
            'conditions'=>array('ExpertComment.active' => 1),
            'order' => array('ExpertComment.id' => 'DESC'),
            'fields' => array('ExpertComment.*','Expert.first_name','Expert.last_name','Expert.id'),
            'joins' => array(
                array(
                    'alias' => 'Expert',
                    'table' => 'experts',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Expert.id = ExpertComment.expert_id'
                    ),
                )                
            ),
        ));
        $this->viewData['lastExCom'] = $lastExCom;
        
        $lastEvent = $this->Event->find('first',array(
            'conditions'=>array('Event.active' => 1,'event_date >=' => date("Y-m-d")),
            'order' => array('Event.id' => 'DESC'),
        ));
        $this->viewData['lastEvent'] = $lastEvent;
        
        $academies = array();
        $academies = $this->Academy->find('all', array(
            'conditions' => array(
                'Academy.active' => 1
            ),
            'fields' => array('id', 'name'),
        ));
        $this->viewData['academies'] = $academies;
        $footer = array();
        $footer['top'] = $this->Footer->find('all', array(
            'conditions' => array(
                'Footer.navigation' => 'top'
            ),
            'fields' => array('id', 'name', 'type', 'url'),
            'group' => 'Footer.position'
        ));
        

        $footer['bottom'] = $this->Footer->find('all', array(
            'conditions' => array(
                'Footer.navigation' => 'bottom'
            ),
            'fields' => array('id', 'name', 'type', 'url'),
            'group' => 'Footer.position'
        ));

        $footer['publication'] = $this->Footer->find('all', array(
            'conditions' => array(
                'Footer.navigation' => 'publication'
            ),
            'fields' => array('id', 'name', 'type', 'url'),
            'group' => 'Footer.position'
        ));
        $this->set('footers', $footer);

        $lastVideo = $this->Video->find('first',array( 'order' => array('id' => 'DESC')));
        $this->viewData['lastVideo'] = $lastVideo;
        //var_dump($lastVideo);die;
        $url = explode('/',$this->here);
        
        if(isset($url[2])){
            $controller = $url[1];
            $action = $url[2];
        }else{
            $controller = '';
            $action = '';
        }
        $this->viewData['controller'] = $controller;
        $this->viewData['action'] = $action;
        
        if (!defined('FULL_BASE_URL_MINE')) {
            define('FULL_BASE_URL_MINE', FULL_BASE_URL . $this->webroot);
        }
        /*$this->viewData['social_settings'] = $this->Setting->findByName('social');
        $this->viewData['trust'] = $this->Setting->findByName('trust');*/
        $this->set($this->viewData);
        
        $this->host = Router::url('/', true);
        
    }

    public function beforeRender() {
        parent::beforeRender();
        if($this->response->statusCode() == '404'){
            //$this->layout = 'error';
        }
        if ($this->name == 'CakeError') {
            $this->layout = 'error';
        }

        if (!empty($this->scripts_for_layout_include))
            $this->viewData['scripts_for_layout_include'] = $this->scripts_for_layout_include;

        if (!empty($this->css_for_layout_include))
            $this->viewData['css_for_layout_include'] = $this->css_for_layout_include;
        
//        var_dump($this->viewData['scripts_for_layout_include']);die;
        $this->set($this->viewData);
    }

    private function _setLanguage() {

        //if the cookie was previously set, and Config.language has not been set
        //write the Config.language with the value from the Cookie

        if ($this->Cookie->read('lang') && !$this->Session->check('Config.language')) {

            $this->Session->write('Config.language', $this->Cookie->read('lang'));
        }

        //if the user clicked the language URL
        else if (isset($this->params['language'])) {

            if ($this->params['language'] != $this->Session->read('Config.language')) {

                //then update the value in Session and the one in Cookie

                $this->Session->write('Config.language', $this->params['language']);

                $this->Cookie->write('lang', $this->params['language'], false, '20 days');
            }
        }
    }

    /**
     * Function for redirectiong using language param
     * 
     * @param type $url
     * @param type $status
     * @param type $exit
     */
    public function redirect($url, $status = null, $exit = true) {
        if (is_array($url)) {
            if (!isset($url['language'])) {
                $url['language'] = $this->params['language'];
            }
        }
        parent::redirect($url, $status, $exit);
    }

    /**
     * function for generating url using language param
     * 
     * @param type $url
     * @param type $full
     * @return type
     */
    public function urlGen($url, $full = false) {
        if (is_array($url)) {
            if (!isset($url['language'])) {
                $url['language'] = $this->params['language'];
            }
        }
        $generatedUrl = Router::url($url, $full);
        return $generatedUrl;
    }

    /**
     * Send response to view after ajax call
     * @param bool $status Status of process called
     * @param string $message A string to show user if needed
     * @param array $params An array of params to send
     * @return Json exit and echo respons in json format
     */
    protected function _sendResponse($status, $message = '', $params = array()) {
        $this->layout = false;
        $this->autoRender = false;
        $resp = array(
            'status' => $status,
            'response' => $message,
            'params' => $params,
        );

        echo json_encode($resp);
    }
    
        
    public function getTopics(){
        $topics = $this->Topic->find('all',array(
            'conditions' => array(
                'active' => 1
            )
        ));
        $top = array();
        $all = array();
        if(!empty($topics)){
            foreach ($topics as $key => $value) {
                $top[$value["Topic"]["id"]] = $value["Topic"]["name"];
                $all[$value["Topic"]["id"]]['id'] = $value["Topic"]["id"];
                $all[$value["Topic"]["id"]]['name'] = $value["Topic"]["name"];
                $all[$value["Topic"]["id"]]['description'] = $value["Topic"]["description"];
            }
        }
        $this->topics =  $all;
        return $top;
    }
    
    public function getPrograms(){
        $program = $this->Program->find('all',array(
            'conditions' => array(
                'active' => 1
            )
        ));
        $pro = array();
        if(!empty($program)){
            foreach ($program as $key => $value) {
                $pro[$value["Program"]["id"]] = $value["Program"]["name"];
            }
        }
        return $pro;
    }
    
    public function getRegions(){
        $this->allregions = $region = $this->Region->find('all',array(
            'conditions' => array(
                'active' => 1
            )
        ));
        $reg = array();
        $all = array();
        if(!empty($region)){
            foreach ($region as $key => $value) {
                $reg[$value["Region"]["id"]] = $value["Region"]["name"];
                $all[$value["Region"]["id"]]['id'] = $value["Region"]["id"];
                $all[$value["Region"]["id"]]['name'] = $value["Region"]["name"];
                $all[$value["Region"]["id"]]['description'] = $value["Region"]["description"];
            }
        }
        $this->allregions = $all;
        return $reg;
    }
        
    public function getEventTypes(){
        $eventType = $this->EventType->find('all',array(
            'conditions' => array(
                'active' => 1
            )
        ));
        $eTipes = array();
        
        if(!empty($eventType)){
            foreach ($eventType as $key => $value) {
                $eTipes[$value["EventType"]["id"]] = $value["EventType"]["name"];

            }
        }
        return $eTipes;
    }
    
    public function getProjects(){
        $allprojects = $this->Project->find('all',array(
            'conditions' => array(
                'active' => 1
            )
        ));
        $projects = array();
        $all = array();
        if(!empty($allprojects)){
            foreach ($allprojects as $key => $value) {
                $projects[$value["Project"]["id"]] = $value["Project"]["name"];
                $all[$value["Project"]["id"]]['id'] = $value["Project"]["id"];
                $all[$value["Project"]["id"]]['name'] = $value["Project"]["name"];
                $all[$value["Project"]["id"]]['description'] = $value["Project"]["description"];
            }
        }
        
        $this->projecrs = $all;
        return $projects;
    }
    
    public function getTypes(){
        $alltypes = $this->Type->find('all',array(
            'conditions' => array(
                'active' => 1
            )
        ));
        $types = array();
        $all = array();
        if(!empty($alltypes)){
            foreach ($alltypes as $key => $value) {
                $types[$value["Type"]["id"]] = $value["Type"]["name"];
                $all[$value["Type"]["id"]]['id'] = $value["Type"]["id"];
                $all[$value["Type"]["id"]]['name'] = $value["Type"]["name"];
                $all[$value["Type"]["id"]]['description'] = $value["Type"]["description"];
            }
        }
        
        $this->projecrs = $all;
        return $types;
    }
    
      
    
}
