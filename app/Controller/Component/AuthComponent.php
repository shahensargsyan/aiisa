<?php
/**
 * Dashboard Component
 *
 * This component is used to generate user related info for logged in user dahsboard
 *
 * @package       dogvacay
 * @subpackage    dogvacay.Auth
 * @property 
 */
class AuthComponent extends Component {
    /**
     * The dependency components needed
     * @var array An array of component names
     */
    var $components = array(
        'Cookie',
        'Session',
        'Dashboard'
        );
    var $controller = null;

    /**
     * Initialize component
     *
     * @param object $controller Instantiating controller
     * @access public
     */
    public function initialize(Controller $controller) {        
            $this->controller = & $controller;
            $this->checkCookie();
            $this->checkAdminCookie();
    }

    /**
     * Startup component
     *
     * @param object $controller Instantiating controller
     * @access public
     */
    public function startup(Controller $controller){
        
    }
    
     /**
     * If user is logged in returns its id, otherwse redirects to login page
     * @return int The id of the user or void as not logged in user will be redirected
     */
    public function getUser(){
        if(!$this->Session->read('User.id')){
            $this->Session->write('Redirect.url',$this->controller->here);                      
            $this->controller->redirect(array('controller' => 'pages' , 'action' => 'home'));            
        }else{
            return (int)$this->Session->read('User.id');
        }
    }
    
    /**
     * Returns the ID of the user if logged in user found, null otherwise
     * @return int|null The user id or null of no logged in user found
     */
    public function checkUser(){
        if(!$this->Session->read('User.id')){
            return NULL;
        }else{
            return (int)$this->Session->read('User.id');
        }
    }

    /**
     * If Admin is logged in returns its id, otherwse redirects to login page
     * @return int The id of the user or void as not logged in user will be redirected
     */
    public function getAdmin(){
        if(!$this->Session->check('Admin.id')){
            $this->Session->write('Redirect.url',$this->controller->here);
            $this->controller->redirect('/admins/login/');
        }else{
            return $this->Session->read('Admin.id');
        }
    }
    /**
     * If Admin is logged in returns its id, otherwse redirects to login page
     * @return int The id of the user or void as not logged in user will be redirected
     */
    public function checkAdmin(){
        if(!$this->Session->check('Admin.id')){
            return null;
        }else{
            return $this->Session->read('Admin.id');
        }
    }    

    /**
     * Checking user type and return its value
     *  
     * @return string lowercase user type, if no user type , redirecting.
     */
    public function checkType(){
        $userDb = $this->Dashboard->getData();
        if($userDb['User']['userType'] == 'STARTER'){
            return 'starter';
        }elseif($userDb['User']['userType'] == 'PREMIUM'){
            return 'premium';
        } elseif($userDb['User']['userType'] == 'ADMIN'){
            return 'admin';
        }else{
            $this->controller->redirect('/');
        }
    }
    
    /**
     * If user is buyer it returns true, otherwse redirects to home page, If $url not specified
     * 
     * @param string $url Url to be redirected
     * @return bool The true if user type is starter void as not logged in user will be redirected
     */
    public function getStarter($url = null){
        if($this->checkType() !== 'starter'){
            if(!$url){
                $url = $this->controller->webroot;
            }
            $this->controller->redirect($url);
        }else{
            return true;
        }
    }
    
    /**
     * If user is seller it returns true, otherwse redirects to home page, If $url not specified
     * 
     * @param string $url Url to be redirected
     * @return bool The true if user type is premium void as not logged in user will be redirected
     */
    public function getPremium($url = null){
        if($this->checkType() !== 'premium'){
            if(!$url){
                $url = $this->controller->webroot;
            }
            $this->controller->redirect($url);
        }else{
            return true;
        }
    }
    
    public function checkCookie(){
        $userCookie = $this->Cookie->read('younger_user');
        if($userCookie){
            $this->Session->write('User.id', (int)$this->Cookie->read('younger_user'));
        }
    }
    
    public function checkAdminCookie(){
        $adminCookie = $this->Cookie->read('admin_user');
        if($adminCookie){
            $this->Session->write('Admin.id', (int)$this->Cookie->read('admin_user'));
        }
    }
    
    public function checkReCaptcha ($remote, $challenge, $response) {
        App::import('Vendor', 'captcha', array('file' => 'recaptcha/recaptchalib.php'));
        $resp = recaptcha_check_answer(Configure::read("RE_CAPTCHA"), $remote, $challenge, $response);
        if (!$resp->is_valid) {
            $message = 'error';
        } else {
            $message = 'success';
        }
        return $message;
    }
}