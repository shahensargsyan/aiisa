<?php

class OurexpertsController extends AppController{
    public $name = 'Ourexperts';
    public $uses = array(
        'Expert',
        'Expertise',
        'Experience',
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'user';
        
    }

    public function index() {
        $conditions = '';
        if(isset($this->request->data["op"]) && $this->request->data["op"] == "Clear"){
             $this->Session->write('search',array());
             $this->request->data = array();
        }
        $data = $this->Session->read('search');
        if(!$this->request->data){
               $this->request->data = $data;
        }else{
            $this->Session->write('search',$this->request->data);
        }
        
        if($this->request->data){
            if(isset($this->request->data["date"]["expert_name"]) && $this->request->data["date"]["expert_name"] != ''){
                $conditions = 
                        ' && Expert.first_name LIKE "'.$this->request->data["date"]['expert_name'].'%" OR'. 
                        ' Expert.last_name LIKE "'. $this->request->data["date"]['expert_name'].'%" ';
            }
        }
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => 10,
            'queryId' => 1, 
        );
        $data = $this->paginate('Expert');
        $this->viewData['experts'] = $data;
        
    }
    
    public function expert($id = null){
        if($id){
            $expert = $this->Expert->findById($id);
            
            $this->viewData['title'] = $expert['Expert']['first_name'].' '.$expert['Expert']['last_name'];
            $this->viewData['image'] = "/system/experts/".$expert['Expert']['photo'];
            
            $this->viewData['expert'] = $expert;
            $expertises = $this->Expertise->find('all',array(
                'conditions' => array(
                    'expert_id' => $id
                )
            ));
            $experience = $this->Experience->find('all',array(
                'conditions' => array(
                    'expert_id' => $id
                )
            ));
            $this->viewData['experience'] = $experience;
            $this->viewData['expertises'] = $expertises;
            
            $publications = $this->Publication->find('all',array(
                'conditions' => array(
                    'expert_id' => $id
                ),
                'fields' => array('Publication.*','Topic.name')
                ,
                'joins' => array(
                    array(
                           'alias' => 'Topic',
                           'table' => 'topics',
                           'type' => 'LEFT',
                           'conditions' => array(
                               'Topic.id = Publication.topic_id'
                           ),
                    )                
                )
            ));
            $this->viewData['publications'] = $publications;
            
            $expertComments = $this->ExpertComment->find('all',array(
                'conditions' => array(
                    'expert_id' => $id
                ),
                'fields' => array('ExpertComment.*','ExpertComment.created','Topic.name'),
                'joins' => array(
                    array(
                           'alias' => 'Topic',
                           'table' => 'topics',
                           'type' => 'LEFT',
                           'conditions' => array(
                               'Topic.id = ExpertComment.topic_id'
                           ),
                    )                
                )
            ));
            
            $this->viewData['expertComments'] = $expertComments;
            
        }else{
            $this->redirect('ourexperts/index');
        }
    }
    
    public function comments(){
        $conditions = '';
        if(isset($this->request->data["op"]) && $this->request->data["op"] == "Clear"){
             $this->Session->write('search',array());
             $this->request->data = array();
        }
        $data = $this->Session->read('search');
        if(!$this->request->data){
               $this->request->data = $data;
        }else{
            $this->Session->write('search',$this->request->data);
        }
        
        if($this->request->data){
            if(isset($this->request->data["date"]["expert_name"]) && $this->request->data["date"]["expert_name"] != ''){
                $conditions = 
                        ' && Expert.first_name LIKE "'.$this->request->data["date"]['expert_name'].'%" OR'. 
                        ' Expert.last_name LIKE "'. $this->request->data["date"]['expert_name'].'%" ';
            }
            if(isset($this->request->data["date"]['topic']) &&  $this->request->data["date"]['topic'] != ''){
                $conditions.= ' && ExpertComment.topic_id='.$this->request->data["date"]['topic'];
            }
            if(isset($this->request->data["date"]['region']) && $this->request->data["date"]['region'] != ''){
                $conditions.= ' && ExpertComment.region_id='.$this->request->data["date"]['region'];
            }
            if(isset($this->request->data["date"]["year"]) && $this->request->data["date"]["year"]!= ''){
                $conditions.= ' && ExpertComment.date >='.$this->request->data["date"]["year"].'-01-01';
                $conditions.= ' && ExpertComment.date <='.$this->request->data["date"]["year"].'-12-31';
            }
           //var_dump($conditions);die;
        }
        $this->paginate = array(
            'ExpertComment' => array(
                'conditions' => $conditions,
                'limit' => 10,
                'queryId' => 1, 
            )
        );
        
        $ecpertComments = $this->paginate('ExpertComment');
        $this->viewData['ecpertComments'] = $ecpertComments;
        
        $topics = $this->getTopics();
        $this->viewData['topics'] = $topics;
        $regions = $this->getRegions();
        $this->viewData['regions'] = $regions;
        $programs = $this->getPrograms();
        $this->viewData['programs'] = $programs;
        $types = $this->getTypes();
        $this->viewData['types'] = $types;
        $array = array();
        $y = (int)date('Y');
        for($i=($y-15);$i<=$y;$i++){
            $array[$i] = $i; 
        }
        $this->viewData['years'] = $array;
    }
    
    public function publications(){
        
        $conditions = '';
        if(isset($this->request->data["op"]) && $this->request->data["op"] == "Clear"){
             $this->Session->write('search',array());
             $this->request->data = array();
        }
        $data = $this->Session->read('search');
        if(!$this->request->data){
               $this->request->data = $data;
        }else{
            $this->Session->write('search',$this->data);
        }
        if($this->request->data){
            if(isset($this->request->data["date"]['publication_type']) && $this->request->data["date"]['publication_type'] != ''){
                $conditions.= ' AND Publication.type_id='.$this->request->data["date"]['publication_type'];
            }
            if(isset($this->request->data["date"]['topic']) && $this->request->data["date"]['topic'] != ''){
                $conditions.= ' AND Publication.topic_id='.$this->request->data["date"]['topic'];
            }
            if(isset($this->request->data["date"]['region']) && $this->request->data["date"]['region'] != ''){
                $conditions.= ' AND PublicationRegions.region_id='.$this->request->data["date"]['region'];
            }
            if(isset($this->request->data["date"]["year"]) && $this->request->data["date"]["year"]!= ''){
                $conditions.= " AND Publication.date BETWEEN '".$this->request->data["date"]["year"].'-01-01'."' "
                        . "AND '".$this->request->data["date"]["year"].'-12-31'."'";
            }
        }
        $this->paginate = array(
            'Publication' => array(
                'conditions' => $conditions,
                'limit' => 10,
                'queryId' => 2, 
                
            )
        );
        $publications = $this->paginate('Publication');
        $this->viewData['publications'] = $publications;
        
        $topics = $this->getTopics();
        $this->viewData['topics'] = $topics;
        $regions = $this->getRegions();
        $this->viewData['regions'] = $regions;
        $programs = $this->getPrograms();
        $this->viewData['programs'] = $programs;
        $types = $this->getTypes();
        $this->viewData['types'] = $types;
        $array = array();
        $y = (int)date('Y');
        for($i=($y-15);$i<=$y;$i++){
            $array[$i] = $i; 
        }
        $this->viewData['years'] = $array;
    }
    
    public function databases($type = null){
        if($type){
            $this->loadModel('Database');
            $this->viewData['type'] = $type;
            $conditions = 'AND Database.type="'.$type.'"';
            // get column type
            $types = $this->Database->getColumnType('type');
            // extract values in single quotes separated by comma
            preg_match_all("/'(.*?)'/", $types, $enums);

            if(!in_array("'".$type."'",$enums[0])){
                $this->redirect('/');
            }
            
            if(isset($this->request->data["op"]) && $this->request->data["op"] == "Clear"){
                 $this->Session->write('search',array());
                 $this->request->data = array();
            }
            $data = $this->Session->read('search');
            if(!$this->request->data){
                   $this->request->data = $data;
            }else{
                $this->Session->write('search',$this->data);
            }
            if($this->request->data){

                if(isset($this->request->data["date"]['topic']) && $this->request->data["date"]['topic'] != ''){
                    $conditions.= ' AND Database.topic_id='.$this->request->data["date"]['topic'];
                }
                if(isset($this->request->data["date"]['region']) && $this->request->data["date"]['region'] != ''){
                    $conditions.= ' AND Database.region_id='.$this->request->data["date"]['region'];
                }
                if(isset($this->request->data["date"]["year"]) && $this->request->data["date"]["year"]!= ''){
                    $conditions.= " AND Database.date BETWEEN '".$this->request->data["date"]["year"].'-01-01'."' "
                            . "AND '".$this->request->data["date"]["year"].'-12-31'."'";
                }
            }
            $this->paginate = array(
                'Database' => array(
                    'conditions' => $conditions,
                    'limit' => 10,
                    'queryId' => 1, 
                )
            );
            $publications = $this->paginate('Database');
            $this->viewData['publications'] = $publications;

            $topics = $this->getTopics();
            $this->viewData['topics'] = $topics;
            $regions = $this->getRegions();
            $this->viewData['regions'] = $regions;

            $array = array();
            $y = (int)date('Y');
            for($i=($y-15);$i<=$y;$i++){
                $array[$i] = $i; 
            }
            $this->viewData['years'] = $array;
        }else{
            $this->redirect('/');
        }
    }
    
    public function database($id = null){
        if($id){
             $this->loadModel('Database');
             $database = $this->Database->find('first',array(
                    'conditions' => array(
                        'Database.id' => $id
                    ),
                    'fields' => array(
                        'Database.*','Region.name','Region.description','Topic.description','Topic.name'
                    ),
                    'joins' => array(
                        array(
                            'alias' => 'Region',
                            'table' => 'regions',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Region.id = Database.region_id'
                            ),
                        ),
                        array(
                            'alias' => 'Topic',
                            'table' => 'topics',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Topic.id = Database.topic_id'
                            ),
                        )  
                    ),
                )
            );
            $this->viewData['title'] = strip_tags($database['Database']['description']);
            $this->viewData['image'] = "/system/databases/".$database['Database']['photo_path'];
            
            if(!$database){
                 $this->redirect('/ourexperts/publications');
            }
            $this->viewData['database'] = $database;
        }else{
            $this->redirect('/');
        }
    }

    public function publication($id = null){
        if($id){
            $publication = $this->Publication->find('first',array(
                    'conditions' => array(
                        'Publication.id' => $id
                    ),
                    'fields' => array(
                        'Publication.*','Expert.first_name','Expert.last_name',
                        'Expert.id','Expert.photo','Expert.job_title','Topic.name',
                        'Type.*','Program.*','Project.*'
                    ),
                    'joins' => array(
                        array(
                            'alias' => 'Expert',
                            'table' => 'experts',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Expert.id = Publication.expert_id'
                            ),
                        ),
                        array(
                            'alias' => 'Topic',
                            'table' => 'topics',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Topic.id = Publication.topic_id'
                            ),
                        ),
                        array(
                            'alias' => 'Type',
                            'table' => 'types',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Type.id = Publication.type_id'
                            ),
                        ),
                        array(
                            'alias' => 'Program',
                            'table' => 'programs',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Program.id = Publication.program_id'
                            ),
                        ),
                        array(
                            'alias' => 'Project',
                            'table' => 'projects',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Project.id = Publication.project_id'
                            ),
                        )  
                    ),
                )
            );
            $this->viewData['title'] = strip_tags($publication['Publication']['title']);
            $this->viewData['description'] = strip_tags($publication['Publication']['intro_text']);
            $this->viewData['image'] = $this->host."/system/publications/".$publication['Publication']['photo'];
            
            $this->loadModel('PublicationRegion');
            $regions = $this->PublicationRegion->find('all',array(
                 'conditions' => array(
                        'PublicationRegion.publication_id' => $id
                    ),
                    'fields' => array(
                        'Region.*'
                    ),
                    'joins' => array(
                        array(
                            'alias' => 'Region',
                            'table' => 'regions',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Region.id = PublicationRegion.region_id'
                            ),
                        ),
                    )
            ));
            if(!$publication){
                 $this->redirect('/ourexperts/publications');
            }
            $this->viewData['publication'] = $publication;
            $this->viewData['regions'] = $regions;
        }else{
            $this->redirect('/ourexperts/publications');
        }
    }
    
    public function comment($id = null){
        if($id){
            $comment = $this->ExpertComment->find('first',array(
                    'conditions' => array(
                        'ExpertComment.id' => $id
                    ),
                    'fields' => array(
                        'ExpertComment.*','Expert.first_name','Expert.last_name',
                        'Expert.id','Expert.photo','Expert.job_title','Topic.name'
                    ),
                    'joins' => array(
                        array(
                            'alias' => 'Expert',
                            'table' => 'experts',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Expert.id = ExpertComment.expert_id'
                            ),
                        ),
                        array(
                            'alias' => 'Topic',
                            'table' => 'topics',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Topic.id = ExpertComment.topic_id'
                            ),
                        )  
                    ),
                )
            );
             
            $this->viewData['title'] = strip_tags($comment['ExpertComment']['title']);
            $this->viewData['description'] = strip_tags($comment['ExpertComment']['intro_text']);
            $this->viewData['image'] = $this->host."/system/expertComments/".$comment['ExpertComment']['photo'];
            if(!$comment){
                 $this->redirect('/ourexperts/comments');
            }
            $this->viewData['comment'] = $comment;
        }else{
            $this->redirect('/ourexperts/comments');
        }
    }
    
    public function inTheNews(){
        $this->loadModel('News');
        
        $conditions = '';
        if(isset($this->request->data["op"]) && $this->request->data["op"] == "Clear"){
             $this->Session->write('search_news',array());
             $this->request->data = array();
        }
        $data = $this->Session->read('search_news');
        if(!$this->request->data){
               $this->request->data = $data;
        }else{
            $this->Session->write('search_news',$this->request->data);
        }
        if($this->request->data){
            if(isset($this->request->data["date"]["expert_name"]) && $this->request->data["date"]["expert_name"] != ''){
                $conditions = 
                        ' && Expert.first_name LIKE "'.$this->request->data["date"]['expert_name'].'%" OR'. 
                        ' Expert.last_name LIKE "'. $this->request->data["date"]['expert_name'].'%" ';
            }
            if(isset($this->request->data["date"]["year"]) && $this->request->data["date"]["year"]!= ''){
                $conditions.= ' && News.date >='.$this->request->data["date"]["year"].'-01-01';
                $conditions.= ' && News.date <='.$this->request->data["date"]["year"].'-12-31';
            }
        }
        $this->paginate = array(
            'News' => array(
                'conditions' => $conditions,
                'limit' => 10,
                'queryId' => 1, 
            )
        );
        
        $news = $this->paginate('News');
        $this->viewData['news'] = $news;
        
        $array = array();
        $y = (int)date('Y');
        for($i=($y-15);$i<=$y;$i++){
            $array[$i] = $i; 
        }
        $this->viewData['years'] = $array;
    }
}

