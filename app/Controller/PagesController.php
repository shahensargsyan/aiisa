<?php

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * @package       app.Controller
 */
class PagesController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array(
        
    );
    public $components = array('CreatePDF','Mailer');

    public function beforeFilter() {
        $this->layout = 'user';
        parent::beforeFilter();
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
    public function home() {
        $sliders = $this->Slider->getSliders('all',array(
           'order' => array('id DESC'),
        ));
        $this->viewData['sliders'] = $sliders;
        
        $briefingPaper = $this->Publication->find('all',array(
            'conditions' => array(
                    'active' => 1,
                    'type_id' => 3
            ),
            'limit' => 3,
            'order' => array('id DESC'),
        ));
        $researchPaper = $this->Publication->find('all',array(
            'conditions' => array(
                    'active' => 1,
                    'type_id' => 4
            ),
            'limit' => 3,
            'order' => array('id DESC'),
        ));
        $ids = [];
        foreach ($briefingPaper as $key => $value) {
            $ids[] = $value['Publication']['id'];
        }
        foreach ($researchPaper as $key => $value) {
            $ids[] = $value['Publication']['id'];
        }
        $punlocations = $this->Publication->find('all',array(
            'conditions' => array(
                'active' => 1,
                'id !=' => $ids
            ),
            'limit' => 3,
             'order' => array('id DESC'),
        ));
        $expertComments = $this->ExpertComment->find('all',array(
            'conditions' => array(
                    'active' => 1
            ),
            'limit' => 2,
             'order' => array('id DESC'),
        ));
        $this->loadModel('Academie');
        $home_academie = $this->Academie->find('first',array(
            'conditions' => array(
                    'active' => 1
            ),
             'order' => array('id DESC'),
        ));
        $this->viewData['academie'] = $home_academie;
        $events = $this->Event->find('all',array(
            'conditions' => array(
                'Event.active' => 1,
                'Event.event_date >=' => date("Y-m-d")  
            ),
            'fields' => array('Event.*','EventTipe.*'),
            'joins' => array(
                array(
                    'alias' => 'EventTipe',
                    'table' => 'event_types',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'EventTipe.id = Event.event_type'
                    ),
                ),
            ),
            'limit' => 3,
            'order' => array('Event.id DESC'),
        ));
        
        $this->loadModel('News');
        $news = $this->News->find('first',array(
                        'conditions' => array('News.active' => 1), 
                        'order' => array('News.id' => 'DESC'),
                        'fields' => array(
                            'News.*','Expert.first_name','Expert.last_name',
                            'Expert.id','Expert.photo','Expert.job_title'
                        ),
                        'joins' => array(
                            array(
                                'alias' => 'Expert',
                                'table' => 'experts',
                                'type' => 'LEFT',
                                'conditions' => array(
                                    'Expert.id = News.author'
                                ),
                            ),
                        ),
                    )
                );
        $this->loadModel('Video');
        $video = $this->Video->find('first',array( 'order' => array('id' => 'DESC')));
        $this->viewData['video'] = $video;
        $this->viewData['news'] = $news;
        $this->viewData['punlocations'] = $punlocations;
        $this->viewData['expertComments'] = $expertComments;
        $this->viewData['events'] = $events;
        $this->viewData['briefingPaper'] = $briefingPaper;
        $this->viewData['researchPaper'] = $researchPaper;
    }
    
    public function page404() {
       $this->layout = '404';
    }

    public function contactUs() {
        if (!empty($this->request->data)) {
            $captcha = $this->Auth->checkReCaptcha($_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
            if ($captcha != "error") {
                $data = $this->request->data;
                $this->Contact->set($data);
                if (!$this->Contact->validates()) {
                    $errors = reset($this->Contact->validationErrors);
                    $this->Session->setFlash(__("$errors[0]"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                    return;
                }
                $this->Mailer->SendAdmin($data['Contact']['email'],$data['Contact']['subject'],$data['Contact']['text'],$data['Contact']['first_name']);
                $this->Contact->create();
                $bool = $this->Contact->save($data); 
                if ($bool) {
                    $this->Cookie->write('send_email', true, true);
                    $this->Session->setFlash(__('Your message has been sent to the administrator. We will contact you soon'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
                    $this->redirect(array('controller' => 'pages', 'action' => 'home'));
                }
            } else {
                $this->Session->setFlash(__('error'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            }
        }
        $footer = $this->Footer->find('first',array(
            'conditions' => array(
                'name' => 'Contact Us',
                'type' => 'static'
            )
        ));
        if($footer){
            $this->set('contact_us',$footer['Footer']['text']);
        }
    }
    
    public function Help(){
        $is_user = $this->Auth->checkUser();
        $this->set('is_user',$is_user);
        $questions = $this->Question->find('all',array(
            'conditions' => array(
                'active' => true,
                'help' => true 
            ),
            'limit' => 9,
            'fields' => array('question','answer','id')
        ));
        $this->set('questions',$questions);
        $other_info = $this->Footer->find('first',array(
            'conditions' => array(
                'name' => 'Help'
            ),
            'fields' => array('text')
        ));
        $this->set('other_info',$other_info['Footer']['text']);
    }

    public function Faq() {
        $this->Paginator->settings = array(
            'joins' => array(
                array(
                    'alias' => 'Question',
                    'table' => 'questions',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'FaqCategorie.id = Question.faq_category_id'
                    ),
                ),
            ),
            'conditions' => array(
                'Question.active' => true,
            ),
            'group' => array('Question.id'),
            'limit' => 10,
            'order' => 'Question.faq_category_id DESC',
            'fields' => array(
                'FaqCategorie.*',
                'Question.id', 'Question.question', 'Question.answer'
            )
        );
        $data = $this->Paginator->paginate('FaqCategorie');
        $this->set('data', $data);
    }

    public function view() {
        if($this->params['page']){
            $page = $this->params['page'];
            $page = preg_replace('/_/', ' ', $page);
            $data = $this->Footer->find('first', array(
                'conditions' => array('Footer.name' => $page),
                'fields' => array('Footer.id','Footer.name', 'Footer.text')
            ));
            $this->loadModel('Submenu');
            $submenus = $this->Submenu->find('all',array(
                'conditions' => array(
                    'page_id' => $data['Footer']['id'],
                ),
                'fields' => array('Footer.name','Footer.id'),
                'joins' => array(
                    array(
                        'alias' => 'Footer',
                        'table' => 'footers',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Footer.id = Submenu.submenu_id'
                        ),
                    ),
                ),
            ));
            $this->viewData['submenus'] = $submenus;
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
