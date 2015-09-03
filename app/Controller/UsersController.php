<?php

App::import('Vendor', 'facebook', array('file' => 'facebook/facebook.php'));
/**
 * Users controller
 * @property Log $Log Log model
 */
class UsersController extends AppController {
    public $uses = array(
        'UserTopic',
        'UserRegion'
    );
    public $components = array('FileUploader');
    public $helpers = array(
        'Html',
        'Form',
        'Session'
    );
    public $name = 'Users';

    public function beforeFilter() {
        $this->layout = 'user';
        parent::beforeFilter();
    }

    public function index() {
        $this->redirect(array('controller' => 'users', 'action' => 'home'));
    }

    function home() {
        
    }
    
    public function passwordReminder(){
        $this->layout = FALSE;
    }
    
   public function login($contract_id = null,$membership_id = null) {
        
        if (!empty($this->request->data)) {
            $email = $this->request->data['User']['email'];
            $password = md5($this->request->data['User']['password'] . Configure::read('Password.salt'));
            $found_user = $this->User->find(
                'first', 
                array(
                    'conditions' => array(
                        'User.email' => $email,
                        'User.password' => $password,
                        'User.active' => 1
                    )
                )
            );
            if($found_user){
                $this->Session->write('User.id', $found_user['User']['id']);

                $this->Session->setFlash(__('Suc' . 'essfully logged in!'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
                $url = $this->Session->read('Redirect.url');
                $this->Session->delete('Redirect.url');
                if($url){
                    $this->redirect($url);
                }
                $this->redirect(array('controller' => 'users', 'action' => 'account'));
            }else{
                $this->Session->setFlash(__("Invalid Username or Password!"), 'default', array('class' => 'cake-error'));
            }

        }
    }

    public function email_signup() {
        if($this->request->data){
            $this->loadModel('EmailSubscription');
            //$data['EmailSubscription']['email'] = $this->request->data['EmailSubscription']['email'];
            $chek = $this->EmailSubscription->findByEmail($this->request->data['EmailSubscription']['email']);
            
            if (!$chek) {
                $saved = $this->EmailSubscription->save($this->request->data);
                if ($saved) {
                    $this->Session->setFlash(__('Your email was successfully registered'), 'flash', array('class' => 'success', 'noteType' => ''));
                } else {
                    $this->Session->setFlash(__('Something wrong. Please try later.'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                }
            } else {
                $this->Session->setFlash(__('This email has already been taken.'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
            }
        }
        //$this->redirect($this->referer());
    }

    public function registration($contract_id = null,$membership_id = null) {
        if($this->u_id){
            $this->redirect ('/');
        }
        $countries = $this->User->getCountries();
        $this->viewData['countries'] = $countries;
        if (!empty($this->request->data)) {
            try {
                $this->request->data['User']['country'] = $countries[ $this->request->data['User']['country']];
                $this->User->ValidateRegistration($this->request->data['User']);
                $this->User->set($this->request->data);
                if(!$this->User->validates()){
                     $error = reset($this->User->validationErrors);
                     throw new Exception(__(reset($error)));
                }
                $this->request->data['User']['password'] = md5($this->request->data['User']['password'] . Configure::read('Password.salt'));
                $this->request->data['User']['token'] = md5(time() . Configure::read('Password.salt'));

                //$this->request->data['User']['ip_address'] = $this->request->clientIp();
                if(reset(array_keys($this->request->data,current($this->request->data))) != 'User'){
                    $this->request->data['User']['active'] = true;
                }
                $user = $this->User->save($this->request->data['User']);
                if (!$user) {
                    throw new Exception('Registration failed');
                }
                //$this->Mailer->registration($user['User']);
                
                $this->Session->setFlash(__('Your profile is created! To activate your profile, please check your email!'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
                
            } catch (Exception $e) {
                $this->Session->setFlash($e->getMessage(), 'flash', array('class' => 'danger'));
            }
        }

    }

    public function activate($hash = null) {
        try {
            if (!$hash)
                throw new Exception('Be patient');
            $twoDays = 24*60*60*2;
            $yesterday = date('Y-m-d h:i:s',strtotime('now') - $twoDays);
            $user = $this->User->find(
                'first', array(
                    'conditions' => array(
                        'User.token' => $hash,
                        'User.active' => 0,
                        'User.created >' => $yesterday
                    )
                )
            );
            if (!$user)
                throw new Exception('This user does not exist or already activated');

            $save_data['User']['id'] = $user['User']['id'];
            $save_data['User']['token'] = md5(time() . Configure::read('Password.salt'));
            $save_data['User']['active'] = 1;

            $saved = $this->User->save($save_data);
            if (!$saved)
                throw new Exception('Can not save user, please try again later');

            $this->Session->setFlash(__('Your account is now active, please login.'), 'flash', array('class' => 'success'));
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        } catch (Exception $e) {
            $this->Session->setFlash(__($e->getMessage()), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
    }

    public function unsubscribe() {
        $this->autoRender = false;
        $this->loadModel('UserSearch');
        $this->Auth->getUser();
        $checkDefault = $this->UserSearch->find(
                'first', array(
            'conditions' => array(
                'user_id' => $this->u_id,
                'default' => '1'
            )
                )
        );

        $this->User->save(array(
            'id' => $this->u_id, 'subscribed' => '0'));
        if ($checkDefault) {
            $checkDefault['UserSearch']['default'] = 0;
            $this->UserSearch->save($checkDefault);
        }
        $this->Session->setFlash(__('You will not get monthly emails anymore!'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
        $this->redirect(FULL_BASE_URL_MINE);
    }

    public function logout() {
        //var_dump($this->Session->read('User.id'));die;
        $this->Auth->getUser();
        
        $this->Session->destroy();
        $this->Cookie->delete('remember');
        $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }

    public function forgotPassword() {
        if ($this->request->is('post')) {
            $this->loadModel('User');
            $email = $this->request->data['User']['email'];
            $contentForEmail = $this->User->find('first', array(
                'conditions' => array(
                    'email' => $email
                )
                    ));
            if ($contentForEmail) {
                $this->Mailer->forgotPassword($email, $contentForEmail);
                $this->Session->setFlash(__('An email with password recovery instructions have been sent to you.'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
            }else
                $this->Session->setFlash(__('No account found with this email address!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
        }
    }

    public function passwordRecovery($hash = NULL) {
        try {
            if (!$hash)
                throw new Exception('Be patient');
            $user = $this->User->find(
                    'first', array(
                'conditions' => array(
                    'User.token' => $hash,
                    'User.active' => 1
                )
                    )
            );
            if (!$user)
                throw new Exception('This user not exist');

            if ($this->request->is('post') || $this->request->is('put')) {
                try {
                    $this->User->id = $user['User']['id'];
                    $data = $this->request->data;
                    $valid = $this->User->ValidateChangePass($data['User']);
                    $newPassword = md5($data['User']['new_password'] . Configure::read('Password.salt'));
                    $data['User']['new_password'] = $newPassword;
                    $data['User']['password'] = $newPassword;

                    $data['User']['token'] = md5(microtime());

                    unset($data['User']['new_password']);
                    unset($data['User']['username']);

                    $save = $this->User->save($data);
                    if (!$save) {
                        throw new Exception("Can't save data, plese try again later");
                    }
                    $this->Session->setFlash(__('You have changed your password, now you can log in!'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
                    $this->redirect(array('controller' => 'users', 'action' => 'login'));
                } catch (Exception $e) {
                    $this->Session->setFlash(__($e->getMessage()), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                }
            } else {
                $this->request->data['User'] = $user['User'];
            }
        } catch (Exception $e) {
            $this->Session->setFlash(__($e->getMessage()), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            $this->redirect($this->webroot);
        }
    }

    public function edit_profile() {
        $this->Auth->getUser();       

        $userdata = $this->User->find('first', array('conditions' => array('id' => $this->u_id)));
        if (!$userdata) {
            $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }
        $this->viewData['User'] = $userdata['User'];
        $countries = $this->User->getCountries();
        $this->viewData['countries'] = $countries;
        if (!empty($this->request->data)) {
            try {
                $this->User->id = $this->userDb['User']['id'];
                $data = $this->request->data;
                $valid = $this->User->ValidateEdit($data['User']);
                if (!$data['User']['id'])
                    throw new Exception('Not allowed');
//                $userdata = $this->User->find('first', array('conditions' => array('id' => $this->u_id)));
//                $oldimage = $userdata['User']['image'];
//                $data['User']['id'] = $this->userDb['User']['id'];

                if (trim($data['User']['new_password']))
                    $data['User']['password'] = md5($data['User']['new_password'] . Configure::read('Password.salt'));
//               
                if ($this->User->save($data)) {
                    $this->Dashboard->cleanUp();
                    $this->Session->setFlash(__('Profile has been updated!'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
                }else
//                    $this->Session->setFlash(__('Can not update profile!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                    throw new Exception('Can not update profile!');
                $this->redirect(array('controller' => 'users', 'action' => 'edit_profile'));
            } catch (Exception $e) {
                $this->Session->setFlash(__($e->getMessage()), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            }
        } else {
            $userdata = $this->User->find('first', array('conditions' => array('id' => $this->u_id)));

            if (!$userdata) {
                $this->redirect(array('controller' => 'pages', 'action' => 'home'));
            }
            $this->request->data['User'] = $userdata['User'];
        }
    }
    
    public function subscribedTopics(){
        $this->Auth->getUser();   
        if (isset($this->request->data["UserTopics"]["Topics"])) {
            $this->UserTopic->deleteAll(array('UserTopic.user_id' => $this->u_id), false);
            if(!empty($this->request->data["UserTopics"]["Topics"])){
                foreach ($this->request->data["UserTopics"]["Topics"] as $key => $value) {
                    $this->UserTopic->create();
                    $this->UserTopic->save(array(
                        'user_id' => $this->u_id,
                        'topic_id' => $value
                    ));
                }
            }
            $this->redirect('/users/account');
        }
        $userTopics = $this->Topic->find('all',array(
            'conditions' => array(
                
            ),
            'fields' => array('UserTopic.id','Topic.name','Topic.id'),
            'order' => array('Topic.id'),
            'joins' => array(
                array(
                    'alias' => 'UserTopic',
                    'table' => 'user_topics',
                    'type' => 'left',
                    'conditions' => array(
                        'Topic.id = UserTopic.topic_id AND UserTopic.user_id='.$this->u_id,
                    ),
                ) 
            ),
        ));
        $options = array();
        $selected = array();
        foreach ($userTopics as $key => $value) {
            $options[$value['Topic']['id']] = $value['Topic']['name'];
            if($value['UserTopic']['id']){
                $selected[] = $value['Topic']['id'];
            }
        }
        $this->viewData['options'] = $options;
        $this->viewData['selected'] = $selected;
        $this->viewData['userTopics'] = $userTopics;
    }
    
    public function subscribedRegions(){
        $this->Auth->getUser();   
        if (isset($this->request->data["UserRegion"]["Region"])) {
            //var_dump($this->request->data["UserTopics"]["Topics"]);die;
            $this->UserRegion->deleteAll(array('UserRegion.user_id' => $this->u_id), false);
            if(!empty($this->request->data["UserRegion"]["Region"])){
                foreach ($this->request->data["UserRegion"]["Region"] as $key => $value) {
                    $this->UserRegion->create();
                    $this->UserRegion->save(array(
                        'user_id' => $this->u_id,
                        'region_id' => $value
                    ));
                }
            }
            $this->redirect('/users/account');
        }
        $userRegions = $this->Region->find('all',array(
            'conditions' => array(
                
            ),
            'fields' => array('UserRegion.id','Region.name','Region.id'),
            'order' => array('Region.id'),
            'joins' => array(
                array(
                    'alias' => 'UserRegion',
                    'table' => 'user_regions',
                    'type' => 'left',
                    'conditions' => array(
                        'Region.id = UserRegion.region_id AND UserRegion.user_id='.$this->u_id,
                    ),
                ) 
            ),
        ));
        $options = array();
        $selected = array();
        foreach ($userRegions as $key => $value) {
            $options[$value['Region']['id']] = $value['Region']['name'];
            if($value['UserRegion']['id']){
                $selected[] = $value['Region']['id'];
            }
        }
        $this->viewData['options'] = $options;
        $this->viewData['selected'] = $selected;
        $this->viewData['userRegions'] = $userRegions;
    }

    public function account(){
        $this->Auth->getUser();   
        $userdata = $this->User->findById($this->u_id);
        $this->viewData['user'] = $userdata['User'];
        $userTopics = $this->Topic->find('all',array(
            'conditions' => array(
                'UserTopic.user_id' => $this->u_id
            ),
            'fields' => array('UserTopic.id','Topic.name','Topic.id'),
            'joins' => array(
                array(
                    'alias' => 'UserTopic',
                    'table' => 'user_topics',
                    'type' => 'left',
                    'conditions' => array(
                        'Topic.id = UserTopic.topic_id',
                    ),
                ) 
            ),
        ));
        $userRegions = $this->Region->find('all',array(
            'conditions' => array(
                'UserRegion.user_id' => $this->u_id
            ),
            'fields' => array('UserRegion.id','Region.name','Region.id'),
            'joins' => array(
                array(
                    'alias' => 'UserRegion',
                    'table' => 'user_regions',
                    'type' => 'left',
                    'conditions' => array(
                        'Region.id = UserRegion.region_id',
                    ),
                ) 
            ),
        ));
        $mode = Configure::read('mode');
                
        $this->viewData['mode'] = $mode;

        $this->viewData['sid'] = Configure::read($mode.'.sid');
        
        $this->viewData['userTopics'] = $userTopics;
        $this->viewData['userRegions'] = $userRegions;
    }

    public function checkLogedIn() {
        if (!$this->request->is('ajax'))
            $this->redirect(array('controller' => 'users', 'action' => 'login'));

        if ($this->request->data['currentUrl'])
            $this->Session->write('Redirect.url', $this->request->data['currentUrl']);

        $this->_sendResponse(true, '', array('userId' => $this->Session->read('User.id')));
    }

    protected function _addToBlockList(){
        $time = date('Y-m-d h:i:s', strtotime('-15 minutes'));
        $wrong_attempts = $this->Log->find('count',array(
            'conditions' => array(
                'user_ip' => $this->request->clientIp(),
                'type LIKE' => 'wrong%',
                'blocked' => 0,
                'created >' => $time,
            )
        ));        
        if($wrong_attempts > 4){
            $this->loadModel('BlockedIp');
            $block_data['BlockedIp']['ip_address'] = $this->request->clientIp();
            $block_data['BlockedIp']['reason'] = 'Wrong email/password specified';
            $this->BlockedIp->create();
            $this->BlockedIp->save($block_data);
            $this->Log->updateAll(
                array('blocked' => 1), 
                array(
                    'user_ip' => $this->request->clientIp(),
                    'type LIKE' => 'wrong%',
                    'blocked' => 0
                )
            );
        }
    }
    
    public function validateHash(){
        if(!$this->request->data)
             $this->redirect('/users/account');
            
        $mode = Configure::read('mode');
        
        $this->viewData['mode'] = $mode;
        
        $hashSecretWord = 'NDI5ODhmODctMzkxZi00NmJjLTk0NWUtMGRkNjI1NjZlYzRi'; //2Checkout Secret Word
        $hashSid =  Configure::read($mode.'.sid'); //2Checkout account number
        $hashTotal = '1.00'; //Sale total to validate against
        if ($this->request->data['demo'] == 'Y') {
            $order_number = 1;
        }else{
            $order_number = $this->request->data['order_number'];
        }
        $StringToHash = strtoupper(md5($hashSecretWord . $hashSid . $order_number . $_REQUEST['total']));

        if ($StringToHash != $this->request->data['key']) {
            $this->Session->setFlash(__( "Payment error.Hash Mismatch!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            $this->redirect('/users/account');
        } else {
            $this->User->save(array(
                'id' => $this->u_id,
                'paid' => 1
            ));
            $this->Dashboard->cleanUp();
            
            $this->loadModel('Transaction');

            $transaction = array(
                'user_id' => $this->u_id,
                'paymentstatus' => 'paid',
                'transactionId' => $this->request->data["key"],
                'transactionData' => json_encode($this->request->data),
                'transactionDate' => date("Y-m-d H:i:s")
            );
            $transactionSave = $this->Transaction->save($transaction);
            $this->Session->setFlash(__('You are Suc' . 'essfully payed!'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
            $this->redirect('/users/account');
        }

    }
    
    

}