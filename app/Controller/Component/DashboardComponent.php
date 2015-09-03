<?php
/**
 * Dashboard Component
 *
 * This component is used to generate user related info for logged in user dahsboard
 *
 * @package       dogvacay
 * @subpackage    dogvacay.Dashboard
 * @property 
 */
class DashboardComponent extends Component{
    /**
    * The dependency components needed
    * @var array An array of component names
    */
    
    public $components = array('Session','Auth');
    
    public $controller = null;



    /**
     * Initialize component
     *
     * @param object $controller Instantiating controller
     * @access public
     */
    public function initialize(Controller $controller, $settings = array()) {
            $this->controller = $controller;
            $this->_set($settings);
    }  

    /**
     * check for user related info and return values , or if not exist , genearate them
     */
    public function getData(){
        if(!$this->Session->check('Dashboard')){
            $this->generateDashboard();
        }
        return $this->Session->read('Dashboard');
    }
    
    public function generateDashboard(){
        $uId = $this->Auth->getUser();
        
        $this->controller->loadModel('User');
        
        $userData = array();
        
        $user = $this->controller->User->findByid($uId);
        $userData['User'] = $user['User'];
        
        $this->Session->write('Dashboard',$userData);
    }
    
    public function cleanUp(){
        $this->Session->delete('Dashboard');
    }        
    
    public function saveLog($logData = array()){
        if($this->Auth->checkUser()){
            $logData['user_id'] = $this->Auth->checkUser();
            $logData['email'] = $this->controller->userDb['User']['email'];
        }
        $ContractLog = ClassRegistry::init('Log');
        $log = $ContractLog->save($logData);
        
        if($log){
            $log = $ContractLog->findById($log["Log"]["id"]);
            if($log){
                return $log["Log"]["id"];

                $contractData = $this->Session->read('contract_'.$log['Log']['contract_id']);
                
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }

    }
}
