<?php
/**
 * MailerComponent
 *
 * This component is used for handling automated emailing stuff
 *
 * @package       dogvacay
 * @subpackage    dogvacay.mailer
 * @property EmailComponent $Email The dependency email component used for email stuff handling
 * @property EmailServiceComponent $EmailService The dependency email service component 
 * used for email through AWS stuff handling
 */

App::uses('CakeEmail', 'Network/Email');

class MailerComponent extends Component{
    public $components = array('CakeEmail');
    
    public $concierge = Null;
    public $noreply = Null;
    
    public $team = null;
    public $web = null;
	
    public $controller = null;
    
    public $Email = null;

  
    public function initialize(Controller $controller, $settings = array()) {
        $this->controller = $controller;
        $this->Email = new CakeEmail();
        $this->_set($settings);
        $this->concierge = Configure::read('Email.concierge');
        $this->noreply = Configure::read('Email.noreply');
        $this->team = Configure::read('TeamName');
        $this->web = Configure::read('WebName');
    }

    /**
     * Startup component
     *
     * @param object $controller Instantiating controller
     * @access public
     */
    public function startup(Controller $controller) {
        parent::startup($controller);
    }
    
    /**
     * Sends an email to the user that want to recover his pass
     * @param array $data An array of user and profile data
     * @return bool Returns true if email is sent successfully, false otherwise
     */
    public function passwordRecovery($data){
        $email = $data['email'];
        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $name = $firstName.' '.$lastName;
        $this->Email->from(array($this->noreply => $this->team));
        $this->Email->bcc(array($this->concierge => 'Concierge'));
        $this->Email->to(array($email => $name));
        $this->Email->emailFormat('both');

        $this->Email->subject('You have requested password recovery at '.$this->web.'!');
        $this->Email->template('passwordRecovery');

        $this->Email->viewVars(array('contentForEmail' => $data));
        return $this->Email->send();
    } 
    
    /**
     * Sends an email to the admin after filling contact us form
     * @param array $data An array of user and profile data
     * @return bool Returns true if email is sent successfully, false otherwise
     */
    public function contactUs($data) {
        $name = $data[0];
        $email = $data[1];
        $phone=$data[2];
        $question = $data[3];
        $this->Email->from(array($email => $name));
        $this->Email->bcc(array($this->concierge => 'Concierge'));
        $this->Email->to(Configure::read('Email.contact'));
        $this->Email->emailFormat('both');
        $this->Email->subject('New message from Contact');
        $this->Email->template('contactUs');
        $this->Email->viewVars(array('messageData' => $data));
        return $this->Email->send();
    }

    /**
     * Sends an email to the user that have just registered
     * @param array $data An array of user and profile data
     * @return bool Returns true if email is sent successfully, false otherwise
     */
    public function registration ($data){
        $this->Email->from(array($this->noreply => $this->team));
        $this->Email->to($data['email']);
        $this->Email->emailFormat('both');
        $this->Email->subject('One more Step required to complete your Registration at '.$this->web.'!');
        $this->Email->template('reg_user');
        $this->Email->viewVars(array('viewData' => $data));
        return $this->Email->send();
    }
    
    public function forgotPassword($email1, $mess){

        $this->Email->emailFormat('html');
        $this->Email->to($email1);
        $this->Email->from(array($this->noreply => $this->team));

        $this->Email->subject('Password reset at ' . $this->web . '!');
        $this->Email->template('forgotpassword'); //must be changed
        $this->Email->viewVars(array('contentForEmail' => $mess));
        $this->Email->send();
        return true;
    }
    public function SendAdmin($user_email,$subject,$message,$name){
        
//        $this->Email->emailFormat('html');
//        $this->Email->to(array('manvel150@gmail.com'));
//        $this->Email->subject($subject);
//        $this->Email->from($user_email);//otpravitel
//        $this->Email->viewVars(array('contentForEmail' => $message));
//        $this->Email->send(array($message => $name));
//        return true;
        $this->Email->emailFormat('html');
        $this->Email->from(array($user_email => $name));
        $this->Email->to('astghik@stdevmail.com');
        $this->Email->subject($subject);
        $this->Email->send($message);
        return true;
    }
    
    public function SendDocument($data){
//        var_dump(FULL_BASE_URL.'/system/print_documents/'.$data['file']);die;
        $this->Email->emailFormat('html');
        $this->Email->to($data['email']);
        $this->Email->from(array($this->noreply => $this->team));
        $this->Email->attachments(FULL_BASE_URL_MINE.'system/print_documents/'.$data['file']);
        //$this->Email->attachments(array('photo.pdf' => FULL_BASE_URL.'/system/print_documents/'.$data['file']));
        /*$this->Email->attachments(array(
            $data['file'] => array(
                'file' => FULL_BASE_URL.'/system/print_documents/'.$data['file'],
                //'mimetype' => 'image/png',
                //'contentId' => 'my-unique-id'
            )
        ));*/
        //$this->Email->filePaths  = array($data['file']);
        //$this->Email->attachments = array(FULL_BASE_URL.'/system/print_documents/');
        
        $this->Email->subject('Contract PDF document');
        $this->Email->template('send_document'); //must be changed
        $this->Email->viewVars(array('contentForEmail' => $data));
        $this->Email->send();
    }
}