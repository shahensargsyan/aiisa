<?php
class AccountController  extends AppController{
    public $name = "Account";
    public $components = array('RequestHandler');
    var $helpers = array('Html', 'Form', 'Js');
    public $uses = array(
        'Expert',
        'Expertise',
        'Experience',
        'Video',
        'UserTopic',
        'UserRegion'
    );
    private $utopics = array();
    private $regions = array();
    private $inTopics = '';
    private $inRegion = '';
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->getUserTopics();
        $this->getUserRegions();
        $this->layout = 'user';
    }
    
    public function getUserTopics(){
        $user_topics = $this->UserTopic->find('all',array(
            'conditions' => array(
                'user_id' => $this->u_id
            )
        ));
        $this->inTopics = '(0,';
        foreach ($user_topics as $key => $value) {
            $this->utopics[] = $value['UserTopic']['topic_id'];
            $this->inTopics.=$value['UserTopic']['topic_id'].',';
        }
        //var_dump( $this->utopics);die;
        $this->inTopics = trim($this->inTopics, ",");
        $this->inTopics.= ')';
    }
    
    public function getUserRegions(){
        $user_regions = $this->UserRegion->find('all',array(
            'conditions' => array(
                'user_id' => $this->u_id
            )
        ));
        $this->inRegion = '(0,';
        foreach ($user_regions as $key => $value) {
            $this->regions[] = $value['UserRegion']['region_id'];
            $this->inRegion.=$value['UserRegion']['region_id'].',';
        }
        $this->inRegion = trim($this->inRegion, ",");
        $this->inRegion.= ')';
    }


    public function index() {
        $this->redirect('research/view');
    }

    public function past_events($type = null, $id = null) {
        $this->layout = FALSE;

        $this->viewData['type'] = $type;
        $this->viewData['id'] = $id;

        switch ($type) {
            case 'topic':
                $conditions = array(
                    'Event.topic_id' => $this->utopics
                );
                break;
            case 'region':
                $conditions = array(
                    'Event.region_id' => $this->regions
                );
                break;
            case 'project':
                $conditions = array(
                    'Event.project_id' => $id
                );
                break;

            default:
                break;
        }
        $conditions['Event.event_date <'] = date('Y-m-d');
        $conditions['Event.active'] = 1;
        $this->paginate = array(
            'conditions' => $conditions,
            'order' => array('Event.id' => 'asc'),
            'limit' => 10,
            'fields' => array(
                'Event.title', 'Event.id',
                'Event.photo', 'Event.photo_by', 'Topic.name'
            ),
            'joins' => array(
                array(
                    'alias' => 'Topic',
                    'table' => 'topics',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Topic.id = Event.topic_id'
                    ),
                ),
                array(
                    'alias' => 'Region',
                    'table' => 'regions',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Region.id = Event.topic_id'
                    ),
                )
            )
        );

        $events = $this->paginate('Event');
        $this->viewData['events'] = $events;
    }

    public function videos($type = null, $id = null) {
        $this->layout = FALSE;
        //var_dump($this->regions);die;
        $this->viewData['type'] = $type;
        $this->viewData['id'] = $id;

        switch ($type) {
            case 'topic':
                $conditions = array(
                    'Video.topic_id' => $this->utopics
                );
                break;
            case 'region':
                $conditions = array(
                    'Video.region_id' => $this->regions
                );
                break;
            case 'project':
                $conditions = array(
                    'Video.project_id' => $id
                );
                break;

            default:
                break;
        }

        $this->paginate = array(
            'conditions' => $conditions,
            'order' => array('Video.id' => 'asc'),
            'limit' => 10,
            'fields' => array(
                'Video.title', 'Video.id',
               'Topic.name'
            ),
            'joins' => array(
                array(
                    'alias' => 'Topic',
                    'table' => 'topics',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Topic.id = Video.topic_id'
                    ),
                ),
                array(
                    'alias' => 'Region',
                    'table' => 'regions',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Region.id = Video.topic_id'
                    ),
                )
            )
        );

        $videos = $this->paginate('Video');
        $this->viewData['videos'] = $videos;
    }

    public function publications($type = null, $id = null) {
        $this->layout = FALSE;

        $this->viewData['type'] = $type;
        $this->viewData['id'] = $id;

        switch ($type) {
            case 'topic':
                $conditions = array(
                    'Publication.topic_id' => $this->utopics
                );
                break;
            case 'region':
                $conditions = array(
                    'Publication.region_id' => $this->regions
                );
                break;
            case 'project':
                $conditions = array(
                    'Publication.project_id' => $id
                );
                break;

            default:
                break;
        }
        $this->paginate = array(
            'Publication' => array(
                'conditions' => $conditions, 
                'limit' => 10,
                'queryId' => 3, 
            )
        );
        $publications = $this->paginate('Publication');
        $this->viewData['publications'] = $publications;
    }
    
    public function latest($type = null, $id = null){
        $this->layout = FALSE;
        $this->viewData['type'] = $type;
        $this->viewData['id'] = $id;

        switch ($type) {
            case 'topic':
                $conditions = array(
                    'expert_comments.active=1 AND expert_comments.topic_id in'.$this->inTopics,  
                    'publications.active=1 AND publications.topic_id in'.$this->inTopics,
                    'events.active=1 AND events.topic_id in'.$this->inTopics  
                );
                break;
            case 'region':
                $conditions = array(
                    'expert_comments.active=1 AND expert_comments.region_id in '.$this->inRegion,  
                    'publications.active=1 AND publications.region_id in '.$this->inRegion,
                    'events.active=1 AND events.region_id in '.$this->inRegion  
                );
                break;
            case 'project':
                $conditions = array(
                    'expert_comments.active=1 AND expert_comments.project_id='.$id,  
                    'publications.active=1 AND publications.project_id='.$id,
                    'events.active=1 AND events.project_id='.$id  
                );
                break;

            default:
                break;
        }
        $this->paginate = array(
            'Publication' => array(
                'conditions' => $conditions,
                'limit' => 10,
                'queryId' => 4, 
            )
        );
        $result = $this->paginate('Publication');
        $this->viewData['result'] = $result;
    }

    public function experts($type = null, $id = null) {
        $this->layout = FALSE;

        $this->viewData['type'] = $type;
        $this->viewData['id'] = $id;

        switch ($type) {
            case 'topic':
                $conditions = array(
                    'ExpertComment.topic_id' => $this->utopics
                );
                break;
            case 'region':
                $conditions = array(
                    'ExpertComment.region_id' => $this->regions
                );
                break;
            case 'project':
                $conditions = array(
                    'ExpertComment.project_id' => $id
                );
                break;

            default:
                break;
        }

        $this->paginate = array(
            'conditions' => $conditions,
            'order' => array('ExpertComment.id' => 'asc'),
            'limit' => 10,
            'fields' => array(
                'ExpertComment.title', 'ExpertComment.id',
                'ExpertComment.photo', 'ExpertComment.photo_title', 'Topic.name'
            ),
            'joins' => array(
                array(
                    'alias' => 'Topic',
                    'table' => 'topics',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Topic.id = ExpertComment.topic_id'
                    ),
                ),
                array(
                    'alias' => 'Region',
                    'table' => 'regions',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Region.id = ExpertComment.topic_id'
                    ),
                )
            )
        );
        $expertComments = $this->paginate('ExpertComment');
        $this->viewData['expertComments'] = $expertComments;
    }

    public function view($type = null, $id = null) {

        if(!$type)
            $this->redirect ('/');
            
        $this->viewData['type'] = $type;
        $this->viewData['id'] = $id;
        
        switch ($type) {
            case 'topic':
                $pconditions = array(
                    'Publication.topic_id' => $this->utopics
                );
                $econditions = array(
                    'ExpertComment.topic_id' => $this->utopics
                );
                $event_conditions = array(
                    'Event.topic_id' => $this->utopics
                );
                //$this->viewData['title'] = $this->topics[$id]['name'];
                //$this->viewData['description'] = $this->topics[$id]['description'];
                $conditions = array(
                    'expert_comments.active=1 AND expert_comments.topic_id in'.$this->inTopics,  
                    'publications.active=1 AND publications.topic_id in'.$this->inTopics,
                    'events.active=1 AND events.topic_id in'.$this->inTopics  
                );
                $vconditions = array(
                    'Video.topic_id' => $this->utopics
                );
                break;
            case 'region':
                $pconditions = array(
                    'Publication.region_id' => $this->regions
                );
                $econditions = array(
                    'ExpertComment.region_id' => $this->regions
                );
                $event_conditions = array(
                    'Event.region_id' => $this->regions
                );
                //$this->viewData['title'] = $this->allregions[$id]['name'];
                //$this->viewData['description'] = $this->allregions[$id]['description'];
                
                $conditions = array(
                    'expert_comments.active=1 AND expert_comments.region_id in'.$this->inRegion,  
                    'publications.active=1 AND publications.region_id in'.$this->inRegion,
                    'events.active=1 AND events.region_id in'.$this->inRegion  
                );
                $vconditions = array(
                    'Video.region_id' => $this->regions
                );
                break;
            case 'project':
                $pconditions = array(
                    'Publication.project_id' => $id
                );
                $econditions = array(
                    'ExpertComment.project_id' => $id
                );
                $event_conditions = array(
                    'Event.project_id' => $id
                );
                $this->viewData['title'] = $this->projecrs[$id]['name'];
                $this->viewData['description'] = $this->projecrs[$id]['description'];
                $conditions = array(
                    'expert_comments.active=1 AND expert_comments.project_id='.$id,  
                    'publications.active=1 AND publications.project_id='.$id,
                    'events.active=1 AND events.project_id='.$id  
                );
                $vconditions = array(
                    'Video.project_id' => $id
                );
                break;

            default:
                break;
        }
        $pub_count = $this->Publication->find('count', array(
            'conditions' => $pconditions
        ));
        $exp_count = $this->ExpertComment->find('count', array(
            'conditions' => $econditions
        ));
        $ev_count = $this->Event->find('count', array(
            'conditions' => $event_conditions
        ));
        $v_count = $this->Video->find('count', array(
            'conditions' => $vconditions
        ));
        
        
        $latest_c = $this->Publication->getlatestCount($conditions);
        
        $this->viewData['latest_count'] = $latest_c;
        $this->viewData['pub_count'] = $pub_count;
        $this->viewData['exp_count'] = $exp_count;
        $this->viewData['ev_count'] = $ev_count;
        $this->viewData['v_count'] = $v_count;
    }
    
    public function video($id = null){
        if($id){
            $video = $this->Video->findById($id);
            $this->viewData['video'] = $video;
        }  else {
            $this->redirect('/');
        }
    }
}
