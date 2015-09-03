<?php
class ExpertsController extends AppController{
    
    public $components = array('FileUploader');
    public $name = 'Experts';
    public $uses = array(
        'Admin',
        'Expertise',
        'Experience',
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'experts';
        if ($this->Session->check('Expert.id')) {
             $this->viewData['expert_id'] = $this->Session->read('Expert.id');
             $this->expert_id = $this->Session->read('Expert.id');
         }else{
             if($this->action == 'login' || $this->action == 'passwordReminder'){

             }else{
                 $this->redirect('/experts/login');
             }
         }
    }
    
    public function delete($id = null, $model = null) { 
        if (isset($id) && isset($model)) {
            $this->$model->delete($id);
            $this->redirect($this->referer());
        } elseif (isset($_POST['id']) && isset($_POST['model'])) {
            $this->$_POST['model']->delete($_POST['id']);
            $this->_sendResponse(true, 'deleted');
        }
    }
    
    public function index(){
        $this->redirect('/experts/home');
    }


    public function home($id = null){
        $expert = $this->Expert->findById($this->expert_id);
        $this->viewData['expert'] = $expert;
        $expertises = $this->Expertise->find('all',array(
            'conditions' => array(
                'expert_id' => $this->expert_id
            )
        ));
        $experience = $this->Experience->find('all',array(
            'conditions' => array(
                'expert_id' => $this->expert_id
            )
        ));
        $this->viewData['experience'] = $experience;
        $this->viewData['expertises'] = $expertises;
    }
    
    public function view($id = null){
        $this->layout = 'user';
    }
    
    public function edit(){
        $this->css_for_layout_include[] = 'jquery-ui-1.8.23.custom';
        $this->scripts_for_layout_include[] = 'fileuploader';
        $this->css_for_layout_include[] = 'chatem/crop';
        $this->scripts_for_layout_include[] = 'chatem/crop';
        if(isset($this->request->data["Expert"])){
            $this->request->data["Expert"]["id"] = $this->expert_id;
            $save = $this->Expert->save($this->request->data["Expert"]);
            if($save){
                $this->Session->setFlash(__('Your profile sucsessfully edited.'), 'default', array('class' => 'success'));
            }  else {
                $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
            }
        }
        
        $expert = $this->Expert->findById($this->expert_id);
        $this->viewData['expert'] = $expert;
        
        
        if(isset($this->request->data["ExpertPassword"])){
            $this->request->data["ExpertPassword"]["id"] = $this->expert_id;
            $salt = Configure::read('Password.salt');
            $oldPassword = md5($this->request->data["ExpertPassword"]['old_password'] . $salt);
            if($oldPassword == $expert['Expert']['password']){
                $new_expert = array(
                    'id' => $this->expert_id,
                    'password' => md5($this->request->data["ExpertPassword"]['password'] . $salt)
                );
                $save = $this->Expert->save($new_expert);
                if($save){
                    $this->Session->setFlash(__('Your password sucsessfully changed.'), 'default', array('class' => 'success'));
                }  else {
                    $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                }
            }else{
                $this->Session->setFlash(__("Old password is wrong!"), 'default', array('class' => 'cake-error'));             
            }
        }
        
        $this->request->data = $expert;
        //var_dump($expert);
    }
    
    public function expertises(){
        $expertises = $this->Expertise->find('all',array(
            'conditions' => array(
                'expert_id' => $this->expert_id
            )
        ));
        $this->viewData['expertises'] = $expertises;
    }
    
    public function addExpertise() {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $data['Expertise']['expert_id'] = $this->expert_id;
            $this->Expertise->create();
            $this->Expertise->save($data);
            $this->redirect(array('controller' => 'experts', 'action' => 'expertises'));
        }
    }
    
    public function editExpertise($id = null){
        if($id){
            $expertise = $this->Expertise->findById($id);
            if($this->request->data){
                $this->request->data['Expertise']['id'] = $id;

                $save = $this->Expertise->save($this->request->data['Expertise']);
                if($save){
                    $this->Session->setFlash(__('Your Expertise sucsessfully edited.'), 'default', array('class' => 'success'));
                }  else {
                    $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                }

                $this->redirect(array('controller' => 'experts', 'action' => 'expertises'));
            }
            if($expertise){
                $this->request->data = $expertise;
            }else{
                $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                $this->redirect('/experts/expertises');
            }
        }  else {
            $this->redirect('/experts/expertises');
        }
    }
    
    public function editPublication($id = null){
        if($id){
            $this->scripts_for_layout_include[] = 'jquery-ui';
            $this->css_for_layout_include[] = 'jquery-ui';
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
            $types = $this->getTypes();
            $this->viewData['types'] = $types;
            $publication = $this->Publication->findById($id);
            $this->loadModel('PublicationRegion');
            $publicationRegions = $this->PublicationRegion->find('all',array(
                'conditions' => array( 'publication_id' => $id)
            ));
            $selected  = array();
            if($publicationRegions){
                foreach ($publicationRegions as $key => $value) {
                    $selected[] = $value['PublicationRegion']['region_id'];
                }
            }
            $this->viewData['selected'] = $selected;
            if($this->request->data){
                $this->request->data['Publication']['id'] = $id;
                $regions = $this->request->data['Publication']['region_id'];
                unset($this->request->data['Publication']['region_id']);
                $save = $this->Publication->save($this->request->data['Publication']);
                $this->PublicationRegion->deleteAll(array('publication_id' => $id), false);
                //var_dump($regions);die;
                foreach ($regions as $key => $value) {
                    $this->PublicationRegion->create();
                    $this->PublicationRegion->save(array(
                        'publication_id' => $id,
                        'region_id' => $value
                    ));
                }
                if($save){
                    $this->Session->setFlash(__('Your publication sucsessfully edited.'), 'default', array('class' => 'success'));
                }  else {
                    $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                }

                $this->redirect(array('controller' => 'experts', 'action' => 'publications'));
            }
            if($publication){
                $this->request->data = $publication;
                $this->viewData['photo'] = $publication['Publication']['photo'];
                $this->viewData['pdf'] = $publication['Publication']['pdf'];
            }else{
                $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                $this->redirect('/experts/publications');
            }
        }  else {
            $this->redirect('experts/publications');
        }
    }
    
    public function editExpertComment($id = null){
        if($id){
            $this->scripts_for_layout_include[] = 'jquery-ui';
            $this->css_for_layout_include[] = 'jquery-ui';
            $this->css_for_layout_include[] = 'jquery-ui-1.8.23.custom';
            $this->scripts_for_layout_include[] = 'fileuploader';
            $this->css_for_layout_include[] = 'chatem/crop';
            $this->scripts_for_layout_include[] = 'chatem/crop';
            $topics = $this->getTopics();
            $regions = $this->getRegions();
            $this->viewData['topics'] = $topics;
            $this->viewData['regions'] = $regions;
            $programs = $this->getPrograms();
            $this->viewData['programs'] = $programs;
            $publication = $this->Publication->findById($id);
            $expertComment = $this->ExpertComment->findById($id);
            if($this->request->data){
                $this->request->data['ExpertComment']['id'] = $id;

                $save = $this->ExpertComment->save($this->request->data['ExpertComment']);
                if($save){
                    $this->Session->setFlash(__('Your Expert Comment sucsessfully edited.'), 'default', array('class' => 'success'));
                }  else {
                    $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                }

                $this->redirect(array('controller' => 'experts', 'action' => 'expertComments'));
            }
            if($expertComment){
                $this->request->data = $expertComment;
                $this->viewData['photo'] = $expertComment['ExpertComment']['photo'];
            }else{
                $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                $this->redirect('/experts/expertComments');
            }
        }  else {
            $this->redirect('experts/expertComments');
        }
    }

    public function experiences(){
        $experience = $this->Experience->find('all',array(
            'conditions' => array(
                'expert_id' => $this->expert_id
            )
        ));
        $this->viewData['experience'] = $experience;
    }
    
    private function getYears(){
        $years = array_combine(range(date("Y"), 1950), range(date("Y"), 1950));
        asort($years);
        $years['until_now'] = 'Until now';
        return $years;
    }

    public function addExperience() {
        $years = $this->getYears();
        $this->viewData['years'] = $years;                        
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $data['Experience']['expert_id'] = $this->expert_id;
            $data['Experience']['from_date'] = $data['Experience']['from_date'];
            $data['Experience']['to_date'] = $data['Experience']['to_date'];
            $save = $this->Experience->save($data);
            $this->redirect(array('controller' => 'experts', 'action' => 'experiences'));
        }
    }
    
    public function editExperience($id = null){
        if($id){
            $years = $this->getYears();
            $this->viewData['years'] = $years;  
            $experiences = $this->Experience->findById($id);
            if($this->request->data){
                $this->request->data['Experience']['id'] = $id;

                $save = $this->Experience->save($this->request->data['Experience']);
                if($save){
                    $this->Session->setFlash(__('Your Experience sucsessfully edited.'), 'default', array('class' => 'success'));
                }  else {
                    $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                }

                $this->redirect(array('controller' => 'experts', 'action' => 'experiences'));
            }
            if($experiences){
                $this->request->data = $experiences;
            }else{
                $this->Session->setFlash(__("Some error occured"), 'default', array('class' => 'cake-error'));
                $this->redirect('/experts/experiences');
            }
        }  else {
            $this->redirect('/experts/experiences');
        }
    }
    
    public function publications(){
        $publication = $this->Publication->find('all',array(
            'conditions' => array(
                'expert_id' => $this->expert_id
            )
        ));
        $this->viewData['publication'] = $publication;
    }
    
    
    public function expertComments(){
        $expertComments = $this->ExpertComment->find('all',array(
            'conditions' => array(
                'expert_id' => $this->expert_id
            )
        ));
        $this->viewData['expertComments'] = $expertComments;
    }
    
    public function addPublication(){
        $this->scripts_for_layout_include[] = 'jquery-ui';
        $this->css_for_layout_include[] = 'jquery-ui';
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
        $types = $this->getTypes();
        $this->viewData['types'] = $types;
        if (!empty($this->request->data) && !empty($this->request->data['Publication']['region_id'])) {
            $this->request->data['Publication']['expert_id'] = $this->expert_id;
            $regions = $this->request->data['Publication']['region_id'];
            
            unset($this->request->data['Publication']['region_id']);
            $save = $this->Publication->save($this->request->data['Publication']);
            $this->loadModel('PublicationRegion');
            foreach ($regions as $key => $value) {
                $this->PublicationRegion->create();
                $this->PublicationRegion->save(array(
                    'publication_id' => $save['Publication']['id'],
                    'region_id' => $value
                ));
            }
            $this->redirect(array('controller' => 'experts', 'action' => 'publications'));
        }
    }
    
    public function addExpertComment(){
        $this->scripts_for_layout_include[] = 'jquery-ui';
        $this->css_for_layout_include[] = 'jquery-ui';
        $this->css_for_layout_include[] = 'jquery-ui-1.8.23.custom';
        $this->scripts_for_layout_include[] = 'fileuploader';
        $this->css_for_layout_include[] = 'chatem/crop';
        $this->scripts_for_layout_include[] = 'chatem/crop';
        $topics = $this->getTopics();
        $regions = $this->getRegions();
        $this->viewData['topics'] = $topics;
        $this->viewData['regions'] = $regions;
        $programs = $this->getPrograms();
        $this->viewData['programs'] = $programs;
        if (!empty($this->request->data)) {
            $this->request->data['ExpertComment']['expert_id'] = $this->expert_id;

            $save = $this->ExpertComment->save($this->request->data['ExpertComment']);

            $this->redirect(array('controller' => 'experts', 'action' => 'expertComments'));
        }
    }
    
    public function viewPublication($id = null){
        $this->layout = 'user';
        if($id){
            $publication = $this->Publication->find('first',array(
                'condition' => array(
                    'id' => $id
                ),
                'fields' => array(
                    'Publication.*','Expert.*'
                ),
                'joins' => array(
                       array(
                           'alias' => 'Expert',
                           'table' => 'experts',
                           'type' => 'LEFT',
                           'conditions' => array(
                               'Expert.id = Publication.expert_id'
                           ),
                       )                
                   ),
            ));
            $this->viewData['publication'] = $publication['Publication'];
        }else{
            $this->redirect('/');
        }
    }

    public function login() {
        if ($this->Session->check('Expert.id')) {
            $this->redirect(array('controller' => 'experts', 'action' => 'home',$this->Session->read('Expert.id')));
        }
        if ($this->request->data) {
            $username = $this->request->data['Expert']['email'];
            $password = $this->request->data['Expert']['password'];
            $salt = 's+(_expert*';
            Configure::read('Password.salt');
            $password = md5($password . $salt);
            $found_expert = $this->Expert->find('first', 
                    array(
                        'conditions' => 
                            array(
                                array('Expert.email' => "$username"),
                                array('Expert.password' => "$password"),
                            ),
                        'callback' => true
                    )
                );
            if (empty($found_expert)) {
                $this->Session->setFlash(__('Email or Password is not correct!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                $this->Session->write('Note.error', 'Email or Password is not correct');
            } else {
                $this->Session->write('Expert.id', $found_expert['Expert']['id']);
                $this->redirect(array('controller' => 'experts', 'action' => 'home'));
            }
        }
    }

    public function logout() {
        $this->Session->destroy();
        $this->redirect(array('controller' => 'experts', 'action' => 'login'));
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
            $allowedFiles = array('jpg', 'jpeg', 'gif', 'png');
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
    
    public function deleteTempFile(){
        if($this->request->data['image']){
            unlink('temp/'.$this->request->data['image']);
        }
    }
    
    
}
