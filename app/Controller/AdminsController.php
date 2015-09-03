    <?php

class AdminsController extends AppController {

    public $components = array('FileUploader');
    public $name = 'Admins';
    public $uses = array(
        'Admin',
        'EmailSubscription',
        'News',
        'Video',
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'admin';
        if ($this->Session->check('Admin.id')) {
            $this->viewData['admin_id'] = $this->Session->read('Admin.id');
        }
        $this->viewData['active_menu'] = $this->action;
        if($this->action == 'login' || $this->action == 'save_form'){
            
        }else{
            $this->Auth->getAdmin();
        }
    }
    
    public function index() {
        
    }
    
    public function loginExpert($id = null) {
        if($id){
             $expert = $this->Expert->findById($id);
             if($expert){
                 $this->Session->write('Expert.id', $expert['Expert']['id']);
                $this->redirect(array('controller' => 'experts', 'action' => 'home'));
             }else{
                 $this->redirect('/');
             }
        }else{
            $this->redirect('/');
        }
    }
    
    public function delete($id = null, $model = null) {
        $this->loadModel('Database');
        $this->loadModel('Gallery');
        if (isset($id) && isset($model)) {
            $this->$model->delete($id);
            $this->redirect($this->referer());
        } elseif (isset($_POST['id']) && isset($_POST['model'])) {
            $this->$_POST['model']->delete($_POST['id']);
            $this->_sendResponse(true, 'deleted');
        }
    }

    public function addAcademy(){
        $this->css_for_layout_include[] = 'jquery-ui-1.8.23.custom';
        $this->scripts_for_layout_include[] = 'fileuploader';
        $this->css_for_layout_include[] = 'chatem/crop';
        $this->scripts_for_layout_include[] = 'chatem/crop';
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->Academy->set($data);
            if (!$this->Academy->validates()) {
                $errors = reset($this->Academy->validationErrors);
                $this->set('error', reset($errors));
                return;
            }
            $this->Academy->create();
            $this->Academy->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'academies'));
        }
    }
    
    public function editAcademy($id = null){
        if($id){
            $this->css_for_layout_include[] = 'jquery-ui-1.8.23.custom';
            $this->scripts_for_layout_include[] = 'fileuploader';
            $this->css_for_layout_include[] = 'chatem/crop';
            $this->scripts_for_layout_include[] = 'chatem/crop';
            $academy = $this->Academy->findById($id);
            if($this->request->data){
                $this->request->data['Academy']['id'] = $id;

                $save = $this->Academy->save($this->request->data['Academy']);
                if($save){
                    $this->Session->setFlash(__('Your Academy sucsessfully edited.'), 'default', array('class' => 'success'));
                }  else {
                    $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                }

                $this->redirect(array('controller' => 'admins', 'action' => 'academies'));
            }
            if($academy){
                $this->request->data = $academy;
                $this->viewData['photo'] = $academy['Academy']['photo'];
            }else{
                $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                $this->redirect('/admins/academies');
            }
        }  else {
            $this->redirect('admins/academies');
        }
    }
    
    public function academies(){
        $this->paginate = array(
            'conditions' => array(
            ),
            'limit' => 10,
            'order' => array('created' => 'Desc'),
        );
        $data = $this->paginate('Academy');
        $this->viewData['data'] = $data;
    }
    
    public function videos(){
        $this->paginate = array(
            'conditions' => array(
            ),
            'limit' => 10,
            'order' => array('created' => 'Desc'),
        );
        $data = $this->paginate('Video');
        $this->viewData['data'] = $data;
    }
    
    public function addVideo(){
        $this->scripts_for_layout_include[] = 'jquery-ui';
        $this->css_for_layout_include[] = 'jquery-ui';
        $topics = $this->getTopics();
        $this->viewData['topics'] = $topics;
        $regions = $this->getRegions();
        $this->viewData['regions'] = $regions;
        $programs = $this->getPrograms();
        $this->viewData['programs'] = $programs;
        
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->Video->set($data);
            if (!$this->Video->validates()) {
                $errors = reset($this->Video->validationErrors);
                $this->set('error', reset($errors));
                return;
            }
             if (strpos($data['Video']['link'],'http://www.youtube.com/') !== false || strpos($data['Video']['link'],'https://www.youtube.com/') !== false) {
                $url = str_replace('watch?v=','embed/', $data['Video']['link']);
                $data['Video']['link'] = $url;
                $this->Video->save($data);
                $this->redirect(array('controller' => 'admins', 'action' => 'videos'));
            }else{
                $this->Session->setFlash(__("Please add youtube video"), 'default', array('class' => 'cake-error'));
            }
        }
    }
    
   public function editVideo($id = null){
        if($id){
            $topics = $this->getTopics();
            $this->viewData['topics'] = $topics;
            $regions = $this->getRegions();
            $this->viewData['regions'] = $regions;
            $programs = $this->getPrograms();
            $this->viewData['programs'] = $programs;

            $video = $this->Video->findById($id);
            if($this->request->data){
                $data = $this->request->data;
                if (strpos($this->request->data['Video']['link'],'http://www.youtube.com/') !== false || strpos($this->request->data['Video']['link'],'https://www.youtube.com/') !== false) {
                    $url = str_replace('watch?v=','embed/', $this->request->data['Video']['link']);
                    $data['Video']['link'] = $url;
                    $data['Video']['id'] = $id;
                    
                    $this->Video->save($data);
                    
                    $save = $this->Video->save($data);
                    if($save){
                        $this->Session->setFlash(__('Your Video sucsessfully edited.'), 'default', array('class' => 'success'));
                    }  else {
                        $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                    }
                }else{
                    $this->Session->setFlash(__("Please add youtube video"), 'default', array('class' => 'cake-error'));
                }
                

                $this->redirect(array('controller' => 'admins', 'action' => 'videos'));
            }
            if($video){
                $this->request->data = $video;
            }else{
                $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                $this->redirect('/admins/videos');
            }
        }  else {
            $this->redirect('admins/videos');
        }
    }
    
    public function news(){
        $this->paginate = array(
            'conditions' => array(
            ),
            'limit' => 10,
            'order' => array('created' => 'Desc'),
            'queryId' => 2, 
        );
        $data = $this->paginate('News');
        $this->viewData['data'] = $data;
    }
    
    private function getExperts(){
        $experts = $this->Expert->find('all',array(
            'condition' => array(
                'active' => 1
            )
        ));
        $ex = array();
        foreach ($experts as $key => $value) {
            $ex[$value['Expert']['id']] = $value['Expert']['first_name'].' '.$value['Expert']['last_name'];
        }
    }
    
    public function addNews(){
        $this->scripts_for_layout_include[] = 'jquery-ui';
        $this->css_for_layout_include[] = 'jquery-ui';
        $topics = $this->getTopics();
        $this->viewData['topics'] = $topics;
        $regions = $this->getRegions();
        $this->viewData['regions'] = $regions;
        $programs = $this->getPrograms();
        $this->viewData['programs'] = $programs;
        
        $ex = getExperts();
        $this->viewData['experts'] = $ex;
        
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->News->set($data);
           
            if (!$this->News->validates()) {
                $errors = reset($this->News->validationErrors);
                $this->set('error', reset($errors));
                return;
            }
            $this->News->create();
            $this->News->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'news'));
        }
    }
    
    public function editNews($id = null){
        if($id){
            $this->scripts_for_layout_include[] = 'jquery-ui';
            $this->css_for_layout_include[] = 'jquery-ui';
            $topics = $this->getTopics();
            $this->viewData['topics'] = $topics;
            $regions = $this->getRegions();
            $this->viewData['regions'] = $regions;
            $programs = $this->getPrograms();
            $this->viewData['programs'] = $programs;
            $experts = $this->Expert->find('all',array(
                'condition' => array(
                    'active' => 1
                )
            ));
            $ex = array();
            foreach ($experts as $key => $value) {
                $ex[$value['Expert']['id']] = $value['Expert']['first_name'].' '.$value['Expert']['last_name'];
            }

            $this->viewData['experts'] = $ex;
            $news = $this->News->findById($id);
            if($this->request->data){
                $this->request->data['News']['id'] = $id;

                $save = $this->News->save($this->request->data['News']);
                if($save){
                    $this->Session->setFlash(__('Your News sucsessfully edited.'), 'default', array('class' => 'success'));
                }  else {
                    $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                }

                $this->redirect(array('controller' => 'admins', 'action' => 'news'));
            }
            if($news){
                $this->request->data = $news;
            }else{
                $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                $this->redirect('/admins/news');
            }
        }  else {
            $this->redirect('admins/news');
        }
    }

    public function addEvent(){
        $this->scripts_for_layout_include[] = 'jquery-ui';
        $this->css_for_layout_include[] = 'jquery-ui';
        $this->scripts_for_layout_include[] = 'chatem/jquery.timepicker';
        $this->css_for_layout_include[] = 'chatem/jquery.timepicker';

        $eventTypes = $this->getEventTypes();
        $this->viewData['eventTypes'] = $eventTypes;
        $topics = $this->getTopics();
        $this->viewData['topics'] = $topics;
        $regions = $this->getRegions();
        $this->viewData['regions'] = $regions;
        $programs = $this->getPrograms();
        $this->viewData['programs'] = $programs;

        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->Event->set($data);
            if (!$this->Event->validates()) {
                $errors = reset($this->Event->validationErrors);
                $this->set('error', reset($errors));
                return;
            }
            $this->Event->create();
            $this->Event->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'events'));
        }
    }
    
    public function events(){
        $this->paginate = array(
            'conditions' => '',
            'limit' => 10,
            'queryId' => 3,
            'order' => array('created' => 'Desc'),
        );
        $data = $this->paginate('Event');
        $this->viewData['data'] = $data;
    }


    public function regions(){
        $this->paginate = array(
            'conditions' => array(
            ),
            'limit' => 10,
            'order' => array('created' => 'Desc'),
        );
        $data = $this->paginate('Region');
        $this->viewData['data'] = $data;
    }
    
     public function editRegion($id = NULL) {
        $data = $this->Region->findById($id);
        if (!$data)
            $this->redirect('/admins/regions');

        if (!empty($this->request->data)) {
            try {
                $data = $this->request->data;
                $this->Region->id = $id;

                $category = $this->Region->find('first', array('conditions' => array('id' => $id)));

                if ($this->Region->save($data)) {
                    $this->Session->write('Note.ok', 'The Region has been updated.');
                } else {
                    $this->Session->write('Note.error', 'Unable to save changes.');
                }//////redirect
                $this->redirect(array('controller' => 'admins', 'action' => 'regions'));
            } catch (Exception $e) {
                $this->Session->write('Note.error', $e->getMessage());
            }
        }
        if (!$this->request->data) {
            $this->request->data['Region'] = $data['Region'];
            $this->viewData['Region'] = $data['Region'];
        }
    }
    
    public function addRegion() {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->Region->set($data);
            if (!$this->Region->validates()) {
                $errors = reset($this->Region->validationErrors);
                $this->set('error', reset($errors));
                return;
            }
            $this->Region->create();
            $this->Region->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'regions'));
        }
    }
    
    public function addType() {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->Type->set($data);
            if (!$this->Type->validates()) {
                $errors = reset($this->Type->validationErrors);
                $this->set('error', reset($errors));
                return;
            }
            $this->Type->create();
            $this->Type->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'types'));
        }
    }
    
    public function types(){
        $this->paginate = array(
            'conditions' => array(
            ),
            'limit' => 10,
            'order' => array('created' => 'Desc'),
        );
        $data = $this->paginate('Type');
        $this->viewData['data'] = $data;
    }
    
        
     public function editType($id = NULL) {
        $data = $this->Type->findById($id);
        if (!$data)
            $this->redirect('/admins/regions');

        if (!empty($this->request->data)) {
            try {
                $data = $this->request->data;
                $this->Type->id = $id;

                $category = $this->Type->find('first', array('conditions' => array('id' => $id)));

                if ($this->Type->save($data)) {
                    $this->Session->write('Note.ok', 'The Type has been updated.');
                } else {
                    $this->Session->write('Note.error', 'Unable to save changes.');
                }//////redirect
                $this->redirect(array('controller' => 'admins', 'action' => 'types'));
            } catch (Exception $e) {
                $this->Session->write('Note.error', $e->getMessage());
            }
        }
        if (!$this->request->data) {
            $this->request->data['Type'] = $data['Type'];
            $this->viewData['Type'] = $data['Type'];
        }
    }
    
    public function addEventType() {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->EventType->set($data);
            if (!$this->EventType->validates()) {
                $errors = reset($this->EventType->validationErrors);
                $this->set('error', reset($errors));
                return;
            }
            $this->EventType->create();
            $this->EventType->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'eventTypes'));
        }
    }
    
    public function editEventType($id = NULL) {
        $data = $this->EventType->findById($id);
        if (!$data)
            $this->redirect('/admins/eventTypes');

        if (!empty($this->request->data)) {
            try {
                $data = $this->request->data;
                $this->EventType->id = $id;
                
                $category = $this->EventType->find('first', array('conditions' => array('id' => $id)));

                if ($this->EventType->save($data)) {
                    $this->Session->write('Note.ok', 'The Event Type has been updated.');
                } else {
                    $this->Session->write('Note.error', 'Unable to save changes.');
                }//////redirect
                $this->redirect(array('controller' => 'admins', 'action' => 'eventTypes'));
            } catch (Exception $e) {
                $this->Session->write('Note.error', $e->getMessage());
            }
        }
        if (!$this->request->data) {
            $this->request->data['EventType'] = $data['EventType'];
            $this->viewData['EventType'] = $data['EventType'];
        }
    }
    
    public function editEvent($id = null){
        if($id){
            $this->scripts_for_layout_include[] = 'jquery-ui';
            $this->css_for_layout_include[] = 'jquery-ui';
            $this->css_for_layout_include[] = 'chatem/crop';
            $this->scripts_for_layout_include[] = 'chatem/crop';
            $this->scripts_for_layout_include[] = 'chatem/jquery.timepicker';
            $this->css_for_layout_include[] = 'chatem/jquery.timepicker';
            $topics = $this->getTopics();
            $this->viewData['topics'] = $topics;
            $regions = $this->getRegions();
            $this->viewData['regions'] = $regions;
            $programs = $this->getPrograms();
            $this->viewData['programs'] = $programs;

            $event = $this->Event->findById($id);
            if($this->request->data){
                $this->request->data['Event']['id'] = $id;

                $save = $this->Event->save($this->request->data['Event']);
                if($save){
                    $this->Session->setFlash(__('Your Event sucsessfully edited.'), 'default', array('class' => 'success'));
                }  else {
                    $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                }

                $this->redirect(array('controller' => 'admins', 'action' => 'events'));
            }
            if($event){
                $this->request->data = $event;
                $this->viewData['photo'] = $event['Event']['photo'];
            }else{
                $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                $this->redirect('/admins/events');
            }
        }  else {
            $this->redirect('admins/events');
        }
    }
    
    public function eventTypes(){
        $this->paginate = array(
            'conditions' => array(
            ),
            'limit' => 10,
            'order' => array('created' => 'Desc'),
        );
        $data = $this->paginate('EventType');
        $this->viewData['data'] = $data;
    }
    
    public function projects(){
        $this->paginate = array(
            'conditions' => array(
            ),
            'limit' => 10,
            'order' => array('created' => 'Desc'),
        );
        $data = $this->paginate('Project');
        $this->viewData['data'] = $data;
    }
    
    public function addProject() {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            //$this->Project()->set($data);
            if (!$this->Project->validates()) {
                $errors = reset($this->Project->validationErrors);
                $this->set('error', reset($errors));
                return;
            }
            $this->Project->create();
            $this->Project->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'projects'));
        }
    }
    
    public function editProject($id = NULL){
        $data = $this->Project->findById($id);
        if (!$data)
            $this->redirect('/admins/projects');

        if (!empty($this->request->data)) {
            try {
                $data = $this->request->data;
                $this->Project->id = $id;

                if ($this->Project->save($data)) {
                    $this->Session->write('Note.ok', 'The Project has been updated.');
                } else {
                    $this->Session->write('Note.error', 'Unable to save changes.');
                }//////redirect
                $this->redirect(array('controller' => 'admins', 'action' => 'projects'));
            } catch (Exception $e) {
                $this->Session->write('Note.error', $e->getMessage());
            }
        }
        if (!$this->request->data) {
            $this->request->data['Project'] = $data['Project'];
            $this->viewData['Project'] = $data['Project'];
        }
    }
    public function topics(){
        $this->paginate = array(
            'conditions' => array(
            ),
            'limit' => 10,
            'order' => array('created' => 'Desc'),
        );
        $data = $this->paginate('Topic');
        $this->viewData['data'] = $data;
    }
    
    public function addTopic() {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->Topic->set($data);
            if (!$this->Topic->validates()) {
                $errors = reset($this->Topic->validationErrors);
                $this->set('error', reset($errors));
                return;
            }
            $this->Topic->create();
            $this->Topic->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'topics'));
        }
    }
    
    public function editTopic($id = NULL){
        $data = $this->Topic->findById($id);
        if (!$data)
            $this->redirect('/admins/topics');

        if (!empty($this->request->data)) {
            try {
                $data = $this->request->data;
                $this->Topic->id = $id;

                if ($this->Topic->save($data)) {
                    $this->Session->write('Note.ok', 'The Topic Type has been updated.');
                } else {
                    $this->Session->write('Note.error', 'Unable to save changes.');
                }//////redirect
                $this->redirect(array('controller' => 'admins', 'action' => 'topics'));
            } catch (Exception $e) {
                $this->Session->write('Note.error', $e->getMessage());
            }
        }
        if (!$this->request->data) {
            $this->request->data['Topic'] = $data['Topic'];
            $this->viewData['Topic'] = $data['Topic'];
        }
    }
    
    public function login() {
        if ($this->Session->check('Admin.id')) {
            $this->redirect(array('controller' => 'admins', 'action' => 'users'));
        }
        if ($this->request->data) {
            $username = $this->request->data['Admin']['username'];
            $password = $this->request->data['Admin']['password'];
            $salt = 's+(_a*';
            $password = md5($password . $salt);
            $found_admin = $this->Admin->find('first', array('conditions' => array(
                    array('Admin.username' => "$username"),
                    array('Admin.password' => "$password"),
                ),
                'callback' => true));
            if (empty($found_admin)) {
                $this->Session->setFlash(__('Username or Password is not correct!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                $this->Session->write('Note.error', 'Username or Password is not correct');
            } else {
                $this->Session->write('Admin.id', $found_admin['Admin']['id']);
                $this->redirect(array('controller' => 'admins', 'action' => 'index'));
            }
        }
    }
    
    public function logout() {
        $this->Session->destroy();
        $this->redirect(array('controller' => 'admins', 'action' => 'login'));
    }
    
    public function users() {
        $this->paginate = array(
            'conditions' => array(
                'id !=' => 0),
            'limit' => 10,
            'order' => 'User.id DESC'
        );
        $data = $this->paginate('User');
        $this->viewData['data'] = $data;
    }
    
    public function add_user() {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->User->set($data);
            if (!$this->User->validates()) {
                $errors = reset($this->User->validationErrors);
                $this->set('error', reset($errors));
                return;
            }
            if ($data['User']['password'] != $data['User']['confirm_password']) {
                $errors = "password and confirm password doesn't match!";
                $this->set('error', $errors);
                return;
            }
            $data['User']['password'] = md5($data['User']['password'] . Configure::read('Password.salt'));
            $data['User']['token'] = md5(time() . Configure::read('Password.salt'));
            $data['User']['active'] = 1;
            $boll = $this->User->save($data);
            if ($boll) {
                $this->redirect(array('controller' => 'admins', 'action' => 'users'));
            }
        }
    }
    
    public function experts() {
        $this->paginate = array(
            'conditions' => '',
            'limit' => 10,
            'queryId' => 1, 
            'order' => 'Expert.id DESC'
        );
        $data = $this->paginate('Expert');
        $this->viewData['data'] = $data;
    }
    
    public function addExpert() {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->Expert->set($data);
            if (!$this->Expert->validates()) {
                $errors = reset($this->Expert->validationErrors);
                $this->set('error', reset($errors));
                return;
            }
            if ($data['Expert']['password'] != $data['Expert']['confirm_password']) {
                $errors = "password and confirm password doesn't match!";
                $this->set('error', $errors);
                return;
            }
            $salt = Configure::read('Password.salt');
            //$salt = 's+(_expert*';
            $data['Expert']['password'] = md5($data['Expert']['password'] . $salt);
            $data['Expert']['token'] = md5(time() . Configure::read('Password.salt'));
            $data['Expert']['active'] = 1;
            $boll = $this->Expert->save($data);
            if ($boll) {
                $this->redirect(array('controller' => 'admins', 'action' => 'experts'));
            }
        }
    }

    
    public function editExpert($id = NULL) {
        $data = $this->Expert->findById($id);
        $email = $data['Expert']['email'];
        $this->viewData['Expert'] = $data['Expert'];
        if (!$data)
            $this->redirect('/admins/experts');
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            if (!empty($data['Expert']['new_password'])) {
                if ($data['Expert']['new_password'] != $data['Expert']['confirm_password']) {
                    $errors = "password and confirm password doesn't match!";
                    $this->set('error', $errors);
                    return;
                }
                $data['Expert']['password'] = $data['Expert']['new_password'];
                $data['Expert']['password'] = md5($data['Expert']['new_password'] . Configure::read('Security.salt'));
            }
            $this->Expert->set($data);
            if (!$this->Expert->validates()) {
                $validate = true;
                $first_key = key($this->Expert->validationErrors);
                if($first_key == 'email'){
                    if($email == $data['Expert']['email']){
                        $validate = false;
                    }
                }
                if($validate){
                    if($this->Expert->validationErrors){
                        $errors = reset($this->Expert->validationErrors);
                        $this->set('error', reset($errors));
                        return;                   
                    }
                }
            }
            $this->Expert->id = $id;
            $boll = $this->Expert->save($data);
            if ($boll) {
                $this->redirect(array('controller' => 'admins', 'action' => 'experts'));
            }
        } else {
            $this->request->data = $this->Expert->findById($id);
        }
    }
    
    public function editUser($id = NULL) {
        $data = $this->User->findById($id);
        $email = $data['User']['email'];
        $this->viewData['User'] = $data['User'];
        if (!$data)
            $this->redirect('/admins/users');
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            if (!empty($data['User']['new_password'])) {
                if ($data['User']['new_password'] != $data['User']['confirm_password']) {
                    $errors = "password and confirm password doesn't match!";
                    $this->set('error', $errors);
                    return;
                }
                $data['User']['password'] = $data['User']['new_password'];
                $data['User']['password'] = md5($data['User']['new_password'] . Configure::read('Security.salt'));
            }
            $this->User->set($data);
            if (!$this->User->validates()) {
                $validate = true;
                $first_key = key($this->User->validationErrors);
                if($first_key == 'email'){
                    if($email == $data['User']['email']){
                        $validate = false;
                    }
                }
                if($validate){
                    if($this->User->validationErrors){
                        $errors = reset($this->User->validationErrors);
                        $this->set('error', reset($errors));
                        return;                   
                    }
                }
            }
            $this->User->id = $id;
            $boll = $this->User->save($data);
            if ($boll) {
                $this->redirect(array('controller' => 'admins', 'action' => 'users'));
            }
        } else {
            $this->request->data = $this->User->findById($id);
        }
    }
    
    public function add_admin() {
        if ($this->request->is('post')) {
            $val = $this->request->data['Admin']['password'];
            $salt = 's+(_a*';
            $this->request->data['Admin']['password'] = md5($val . $salt);
            $this->Admin->create();
            if ($this->Admin->save($this->request->data)) {
                $this->Session->write('Note.ok', 'Admin has been saved.');
                $this->redirect(array('controller' => 'Admins', 'action' => 'index'));
            } else {
                $this->Session->write('Note.error', 'Unable to add Admin.');
            }
        }
    }

    public function pages($id = NULL) {
        $this->Paginator->settings = array(
            'limit' => 100,
            'fields' => array('Footer.name', 'Footer.id', 'Footer.navigation', 'Footer.type'),
            'order' => 'Footer.id DESC',
            'group' => 'name'
        );
        $data = $this->Paginator->paginate('Footer');
        $this->set('data', $data);
    }

    public function newPage() {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $check = $this->Footer->validateFooter($data);
            if ($check["status"]) {
                $data['Footer']['name'] = $this->request->data['name'];
                $data['Footer']['text'] = $this->request->data['text'];
                if ($this->request->data['navigation']) {
                    $data['Footer']['navigation'] = $this->request->data['navigation'];
                }
                $position = $this->Footer->find('first', array(
                    'conditions' => array('navigation' => $data['Footer']['navigation']),
                    'fields' => array('MAX(position) AS position')
                        ));
                $data['Footer']['position'] = $position[0]['position'] + 1;
                $this->Footer->create();
                if ($this->Footer->save($data)) {
                    if (isset($data['apply'])) {
                        $this->redirect(array('controller' => 'admins', 'action' => 'edit_page', $this->Footer->id));
                    }
                    $this->redirect(array('controller' => 'admins', 'action' => 'pages'));
                }
            } else {
                $this->set("error_msg", $check["msg"]);
            }
        }
    }

    public function edit_page($id = NULL) {
        if($id){
            $page = $this->Footer->find('first',array(
                'conditions' => array(
                    'id' => $id,
                )
            ));
            if($page['Footer']['name'] == 'Help' or $page['Footer']['name'] == 'Contact Us'){
                $this->set('page',true);
            }
        }
        if (!empty($this->request->data)) {
            $navigation = $this->Footer->findById($id);
            $data = $this->request->data['Footer'];
            if(isset($this->data['help'])){
                if(isset($this->data['apply'])){
                    $this->Footer->id = $id;
                    $this->Footer->save($data);
                    $this->request->data = $this->Footer->findById($this->Footer->id);
                    $this->redirect(array('controller' => 'admins', 'action' => 'edit_pages', $id));
                }
                $this->Footer->id = $id;
                $this->Footer->save($data);
                $this->redirect(array('controller' => 'admins', 'action' => 'pages'));
            }
            $check = $this->Footer->validateFooter($data);
            if ($check["status"]) {
                if (isset($this->request->data['duplicate_id'])) {
                    $duplicate_id = $this->request->data['duplicate_id'];
                    $menu = $this->Footer->find('first', array(
                        'conditions' => array(
                            'id' => $duplicate_id
                        ),
                        'fields' => array('position')
                            ));
                    $this->request->data['Footer']['position'] = $menu['Footer']['position'];
                    $this->Footer->id = $duplicate_id;
                    $chek_save = $this->Footer->save($this->request->data, array('validate' => false));
                    if ($chek_save) {
                        $menu = $this->Footer->find('first', array(
                            'conditions' => array(
                                'id' => $id
                            ),
                            'fields' => array('position')
                                ));
                        $this->request->data['Footer']['position'] = $menu['Footer']['position'];
                        $this->Footer->id = $id;
                        $this->Footer->save($this->request->data, array('validate' => false));
                    }
                } else {
                    if ($data['navigation'] != $navigation['Footer']['navigation']) {
                        $menu = $this->Footer->find('first', array(
                            'conditions' => array(
                                'navigation' => $data['navigation']
                            ),
                            'fields' => array('position'),
                            'order' => 'position DESC'
                                ));
                        $position = (!empty($menu['Footer']['position']))?$menu['Footer']['position'] + 1:1;
                        if($this->request->data['Footer']['navigation'] != 'not'){
                            $data['position'] = $position;
                        }
                        else{
                             $data['position'] = 1;
                        }
                    }
                    $this->Footer->id = $id;
                    $this->Footer->save($data);
                }
                if (isset($this->request->data['apply'])) {
                    $this->request->data = $this->Footer->findById($this->Footer->id);
                    $this->redirect(array('controller' => 'admins', 'action' => 'edit_page', $id));
                }
                $this->redirect(array('controller' => 'admins', 'action' => 'pages'));
            } else {
                $this->set("error_msg", $check["msg"]);
            }
        }
        $all_name = $this->Footer->find('list', array(
            'fields' => 'name'
                ));
        $unique_name = array_unique($all_name);
        $duplicate_name = array_diff_assoc($all_name, $unique_name);
        $this->request->data = $this->Footer->findById($id);
        $duplicate_id = array_search($this->request->data['Footer']['name'], $duplicate_name);
        if ($duplicate_id) {
            $this->set('duplicate_id', $duplicate_id);
        }
    }
    
    public function addSubmenu($id = NULL){
        if($id){
            $this->loadModel('Submenu');
            $page = $this->Footer->find('first',array(
                'conditions' => array(
                    'id' => $id,
                )
            ));
            if($page){
                $data = $this->Footer->find('list',array(
                    'conditions' => array(
                        'Footer.id !=' => $id 
                    ),
                    'fields' => array(
                        'id','name'
                    )
                ));
                $submenus = $this->Submenu->find('all',array(
                    'conditions' => array(
                        'page_id' => $id,
                    )
               ));
               $selected  = array();
               if($submenus){
                   foreach ($submenus as $key => $value) {
                       $selected[] = $value['Submenu']['submenu_id'];
                   }
               }
               $this->viewData['selected'] = $selected;
                 if (!empty($this->request->data)) {
                    
                    $this->Submenu->deleteAll(array('page_id' => $id), false);
                    foreach ($this->request->data['Submenu']['submenus'] as $key => $value) {
                        $this->Submenu->create();
                        $this->Submenu->save(array(
                            'page_id' => $id,
                            'submenu_id' => $value
                        ));
                    }
                    $this->redirect(array('controller' => 'admins', 'action' => 'pages'));
                }
                $this->set('data', $data);
            }else{
                $this->redirect('/admins/pages');
            }
        }else{
            $this->redirect('/admins/pages');
        }
    }

    public function change_position() {
        $this->scripts_for_layout_include[] = 'jquery-ui';
        $top_navigation = $this->Footer->find('all', array(
            'conditions' => array(
                'Footer.navigation' => 'top'
            ),
            'fields' => array('Footer.name', 'Footer.position'),
            'group' => 'Footer.position'
                ));
        $bottom_navigation = $this->Footer->find('all', array(
            'conditions' => array(
                'Footer.navigation' => 'bottom'
            ),
            'fields' => array('Footer.name'),
            'group' => 'Footer.position'
                ));
        $this->set('bottom_navigation', $bottom_navigation);
        $this->set('top_navigation', $top_navigation);
    }

    public function save_change() {
        $footers = $this->request->data;
        //var_dump($footers);die;
        $position = 1;
        foreach ($footers['str'] as $footer) {
            $footer_id = $this->Footer->find('first', array(
                'conditions' => array(
                    'Footer.name' => trim($footer),
                    'Footer.navigation' => $footers['navigation']),
                'fields' => array('Footer.id')
            ));
            if ($footer_id) {
                $this->Footer->id = $footer_id['Footer']['id'];
                $data['Footer']['position'] = $position;
                $position++;
                $this->Footer->save($data);
            }
        }
        die;
    }
    
    public function subscription_email($all = null) {
        if(!$all){
            $this->Paginator->settings = array(
                'limit' => 10,
            );
            $data = $this->Paginator->paginate('EmailSubscription');
        }else{
            $data = $this->EmailSubscription->find('all');
        }
        $this->set('data', $data);
    }
    
     public function uploadPhoto() {
        $this->autoRender = false;
        $name = md5(microtime()).'.jpg';
        $url = $_POST['path']. $name ;

	// remove the base64 part
	$base64 = preg_replace('#^data:image/[^;]+;base64,#', '', $_POST['image']);
	$base64 = base64_decode($base64);

	$source = imagecreatefromstring($base64); // create

	imagejpeg($source, $url, 100); // save image

	// return URL
	$response = array (
            'success' => TRUE,
	    'fileName' => $name
	);
	echo json_encode($response);
        die;
    }
    public function uploadTempPhoto($id = null, $isFile = null){
        $this->autoRender = false;
        
        if (isset($_GET['qqfile'])) {
            $imgName = $_GET['qqfile'];
        } elseif (isset($_FILES['qqfile'])) {
            $imgName = $_FILES['qqfile']['name'];
        }
        $explode = explode('.', $imgName);
        $ext = end($explode);
        if (!$isFile) {
            $allowedFiles = array('jpg', 'jpeg', 'gif', 'png','JPG');
        } else {
            $allowedFiles = array('pdf');
        }

        if (!in_array($ext, $allowedFiles)) {
            $response['success'] = false;
            $response['message'] = "File Not Permitted!";
            echo json_decode($response);
            die;
        }
        $userId = $this->u_id;
        if (isset($_GET['qqfile'])) {
            $imgName = $_GET['qqfile'];
        } elseif (isset($_FILES['qqfile'])) {
            $imgName = $_FILES['qqfile']['name'];
        }
        $explode = explode('.', $imgName);
        $ext = end($explode);
        $newName = md5(microtime()) . '.' . $ext;
        $this->FileUploader->upload(WWW_ROOT . 'temp' . DS );
        @rename(WWW_ROOT . 'temp' . DS . $imgName, WWW_ROOT . 'temp' . DS . $newName);
        list($width, $height) = getimagesize(WWW_ROOT . 'temp' . DS . $newName);
        $response['width'] = $width;
        $response['height'] = $height;
        $response['fileName'] = $newName;
        $response['success'] = true;
        echo json_encode($response);
        die;
    }
    
    public function uploadMultiplePhoto($folder = null){
        $this->autoRender = false;
        
        if (isset($_GET['qqfile'])) {
            $imgName = $_GET['qqfile'];
        } elseif (isset($_FILES['qqfile'])) {
            $imgName = $_FILES['qqfile']['name'];
        }
        $explode = explode('.', $imgName);
        $ext = end($explode);
        $allowedFiles = array('jpg', 'jpeg', 'gif', 'png','JPG');
        

        if (!in_array($ext, $allowedFiles)) {
            $response['success'] = false;
            $response['message'] = "File Not Permitted!";
            echo json_decode($response);
            die;
        }
        $userId = $this->u_id;
        if (isset($_GET['qqfile'])) {
            $imgName = $_GET['qqfile'];
        } elseif (isset($_FILES['qqfile'])) {
            $imgName = $_FILES['qqfile']['name'];
        }
        $explode = explode('.', $imgName);
        $ext = end($explode);
        $newName = md5(microtime()) . '.' . $ext;
        $this->FileUploader->upload(WWW_ROOT . 'temp' . DS );
        @rename(WWW_ROOT . 'temp' . DS . $imgName, WWW_ROOT . 'gallery'. DS . $folder . DS . $newName);
        
        $response['success'] = true;
        echo json_encode($response);
        die;
    }
    public function uploadPdfPhoto($id = null){
        $this->autoRender = false;
        $folder = $_GET ["folder"];
        if (isset($_GET['qqfile'])) {
            $imgName = $_GET['qqfile'];
        } elseif (isset($_FILES['qqfile'])) {
            $imgName = $_FILES['qqfile']['name'];
        }
        $explode = explode('.', $imgName);
        $ext = end($explode);

        $allowedFiles = array('pdf');

        if (!in_array($ext, $allowedFiles)) {
            $response['success'] = false;
            $response['message'] = "File Not Permitted!";
            echo json_decode($response);
            die;
        }
        $userId = $this->u_id;
        if (isset($_GET['qqfile'])) {
            $imgName = $_GET['qqfile'];
        } elseif (isset($_FILES['qqfile'])) {
            $imgName = $_FILES['qqfile']['name'];
        }
        $explode = explode('.', $imgName);
        $ext = end($explode);
        $newName = md5(microtime()) . '.' . $ext;
        $this->FileUploader->upload(WWW_ROOT . 'system' . DS . $folder . DS );
        @rename(WWW_ROOT  . 'system' . DS . $folder . DS  . $imgName, WWW_ROOT . 'system' . DS . $folder . DS  . $newName);
        $response['fileName'] = $newName;
        $response['success'] = true;
        echo json_encode($response);
        die;
    }
    
    public function deleteTempFile(){
        if($this->request->data['image']){
            unlink('temp/'.$this->request->data['image']);
        }
    }
    
    public function addSlider(){
        $this->css_for_layout_include[] = 'jquery-ui-1.8.23.custom';
        $this->scripts_for_layout_include[] = 'fileuploader';
        $this->css_for_layout_include[] = 'chatem/crop';
        $this->scripts_for_layout_include[] = 'chatem/crop';
        $topics = $this->getTopics();
        $this->viewData['topics'] = $topics;
        $regions = $this->getRegions();
        $this->viewData['regions'] = $regions;
        $programs = $this->getPrograms();
        $this->viewData['programs'] = $programs;
        if (!empty($this->request->data)) {
            $this->request->data['Slider']['expert_id'] = $this->expert_id;

            $save = $this->Slider->save($this->request->data['Slider']);

            $this->redirect(array('controller' => 'admins', 'action' => 'sliders'));
        }
    }
    
    public function addLibrary(){
        $this->loadModel('Library');
        $this->css_for_layout_include[] = 'jquery-ui-1.8.23.custom';
        $this->scripts_for_layout_include[] = 'fileuploader';
        
        if (!empty($this->request->data)) {

            $save = $this->Library->save($this->request->data['Library']);

            $this->redirect(array('controller' => 'admins', 'action' => 'libraries'));
        }
    }
    
    public function editLibrary($id = null){
        if($id){
            $this->css_for_layout_include[] = 'jquery-ui-1.8.23.custom';
            $this->scripts_for_layout_include[] = 'fileuploader';
            $this->loadModel('Library');
            $library = $this->Library->findById($id);
            if($this->request->data){
                $this->request->data['Library']['id'] = $id;

                $save = $this->Library->save($this->request->data['Library']);
                if($save){
                    $this->Session->setFlash(__('Your Library sucsessfully edited.'), 'default', array('class' => 'success'));
                }  else {
                    $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                }

                $this->redirect(array('controller' => 'admins', 'action' => 'libraries'));
            }
            if($library){
                $this->request->data = $library;
                $this->viewData['filename'] = $library['Library']['filename'];
            }else{
                $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                $this->redirect('/admins/libraries');
            }
        }  else {
            $this->redirect('admins/libraries');
        }
    }
    
    public function libraries(){
        $this->loadModel('Library');

        $this->paginate = array(
            'conditions' => '',
            'limit' => 10,
            'queryId' => 1,
            'order' => array('created' => 'Desc'),
        );
        $libraries = $this->paginate('Library');
        $this->viewData['libraries'] = $libraries;
    }
    
    public function addGallery(){
        $this->loadModel('Gallery');
        $this->scripts_for_layout_include[] = 'jquery-ui';
        $this->css_for_layout_include[] = 'jquery-ui';
        $this->scripts_for_layout_include[] = 'fileuploader';
        $this->css_for_layout_include[] = 'chatem/crop';
        $this->scripts_for_layout_include[] = 'chatem/crop';
        if (!empty($this->request->data)) {
            if (!file_exists('gallery/'.$this->request->data['Gallery']['folder'])) {
                mkdir('gallery/'.$this->request->data['Gallery']['folder'], 0777, true);
            }
            $save = $this->Gallery->save($this->request->data['Gallery']);

            $this->redirect(array('controller' => 'admins', 'action' => 'gallery'));
        }
    }
    
    public function editGallery($id){
        $this->loadModel('Gallery');
        $this->scripts_for_layout_include[] = 'jquery-ui';
        $this->css_for_layout_include[] = 'jquery-ui';
        $this->scripts_for_layout_include[] = 'fileuploader';
        $this->css_for_layout_include[] = 'chatem/crop';
        $this->scripts_for_layout_include[] = 'chatem/crop';
        
        if (!empty($this->request->data)) {
            $this->Gallery->id = $id;
            $save = $this->Gallery->save($this->request->data['Gallery']);

            $this->redirect(array('controller' => 'admins', 'action' => 'gallery'));
        }
        $this->request->data = $this->Gallery->findById($id);
    }
    
    public function addImages($id = null){
         if($id){
            $this->css_for_layout_include[] = 'jquery-ui-1.8.23.custom';
            $this->scripts_for_layout_include[] = 'fileuploader';
            $this->css_for_layout_include[] = 'chatem/crop';
            $this->scripts_for_layout_include[] = 'chatem/crop';
            $this->loadModel('Gallery');
            $gallery = $this->Gallery->findById($id);
            $this->viewData['gallery'] = $gallery;
        }  else {
            $this->redirect('admins/sliders');
        }
    }
    
    public function sliders(){
        $sliders = $this->Slider->find('all',array());
        $this->viewData['sliders'] = $sliders;
    }
    
    public function gallery(){
        $this->loadModel('Gallery');
        $sliders = $this->Gallery->find('all',array());
        $this->viewData['sliders'] = $sliders;
    }
    
    public function deleteImage($folder = null,$path = null,$id = null){
        
         if($path && $folder){
             //var_dump($folder.'/'.$path);die;
             @unlink('gallery/'.$folder.'/'.$path);
             $this->redirect('/admins/addImages/'.$id);
         }else{
             $this->redirect('/admins');
         }
    }

    public function editSlider($id = null){
        if($id){
            $this->css_for_layout_include[] = 'jquery-ui-1.8.23.custom';
            $this->scripts_for_layout_include[] = 'fileuploader';
            $this->css_for_layout_include[] = 'chatem/crop';
            $this->scripts_for_layout_include[] = 'chatem/crop';

            $slider = $this->Slider->findById($id);
            if($this->request->data){
                $this->request->data['Slider']['id'] = $id;

                $save = $this->Slider->save($this->request->data['Slider']);
                if($save){
                    $this->Session->setFlash(__('Your Slider sucsessfully edited.'), 'default', array('class' => 'success'));
                }  else {
                    $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                }

                $this->redirect(array('controller' => 'admins', 'action' => 'sliders'));
            }
            if($slider){
                $this->request->data = $slider;
                $this->viewData['photo'] = $slider['Slider']['photo'];
            }else{
                $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                $this->redirect('/admins/sliders');
            }
        }  else {
            $this->redirect('admins/sliders');
        }
    }
    
    public function addDatabase(){
        $this->scripts_for_layout_include[] = 'jquery-ui';
        $this->css_for_layout_include[] = 'jquery-ui';
        $this->scripts_for_layout_include[] = 'fileuploader';
        $this->css_for_layout_include[] = 'chatem/crop';
        $this->scripts_for_layout_include[] = 'chatem/crop';
        $topics = $this->getTopics();
        $this->viewData['topics'] = $topics;
        $regions = $this->getRegions();
        $this->viewData['regions'] = $regions;

        $this->loadModel('Database');
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->Database->set($data);
            if (!$this->Database->validates()) {
                $errors = reset($this->Database->validationErrors);
                $this->set('error', reset($errors));
                return;
            }
            $this->Database->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'databases'));
        }
    }
    
    public function databases(){
        $this->loadModel('Database');
        $this->paginate = array(
            'conditions' => '',
            'limit' => 10,
            'queryId' => 1,
            'order' => array('created' => 'Desc'),
        );
        $data = $this->paginate('Database');
        $this->viewData['data'] = $data;
    }
    
    public function editDatabase($id = null){
        if($id){
            $this->loadModel('Database');
            $this->scripts_for_layout_include[] = 'jquery-ui';
            $this->css_for_layout_include[] = 'jquery-ui';
            $this->scripts_for_layout_include[] = 'fileuploader';
            $this->css_for_layout_include[] = 'chatem/crop';
            $this->scripts_for_layout_include[] = 'chatem/crop';
            $topics = $this->getTopics();
            $this->viewData['topics'] = $topics;
            $regions = $this->getRegions();
            $this->viewData['regions'] = $regions;
            $database = $this->Database->findById($id);
            if($this->request->data){
                $this->request->data['Database']['id'] = $id;

                $save = $this->Database->save($this->request->data['Database']);
                if($save){
                    $this->Session->setFlash(__('Your Slider sucsessfully edited.'), 'default', array('class' => 'success'));
                }  else {
                    $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                }

                $this->redirect(array('controller' => 'admins', 'action' => 'databases'));
            }
            if($database){
                $this->request->data = $database;
                $this->viewData['photo'] = $database['Database']['photo_path'];
            }else{
                $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                $this->redirect('/admins/databases');
            }
        }  else {
            $this->redirect('admins/databases');
        }
    }
}