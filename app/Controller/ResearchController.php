<?php

class ResearchController extends AppController {

    public $name = "Research";
    public $components = array('RequestHandler');
    var $helpers = array('Html', 'Form', 'Js');
    public $uses = array(
        'Expert',
        'Expertise',
        'Experience',
        'Video'
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'user';
    }

    public function index() {
        $this->redirect('research/view');
    }

    public function past_events($type = null, $id = null) {
        $this->layout = FALSE;

        $this->viewData['type'] = $type;
        $this->viewData['id'] = $id;
        $conditions = '';
        switch ($type) {
            case 'topic':
                $conditions.= 'Event.topic_id=' . $id;
                break;
            case 'region':
                $conditions.= 'Event.region_id=' . $id;
                break;
            case 'project':
                $conditions.= 'Event.project_id=' . $id;
                break;

            default:
                break;
        }

        $this->paginate = array(
            'Event' => array(
                'conditions' => $conditions,
                'limit' => 10,
                'queryId' => 2,
            )
        );

        $events = $this->paginate('Event');
        //var_dump($events);die;
        $this->viewData['events'] = $events;
    }

    public function videos($type = null, $id = null) {
        $this->layout = FALSE;

        $this->viewData['type'] = $type;
        $this->viewData['id'] = $id;

        switch ($type) {
            case 'topic':
                $conditions = array(
                    'Video.topic_id' => $id
                );
                break;
            case 'region':
                $conditions = array(
                    'Video.region_id' => $id
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
        $conditions = '';
        switch ($type) {
            case 'topic':
                $conditions.= 'topic_id=' . $id;
                break;
            case 'region':
                $conditions.='PublicationRegions.region_id=' . $id;
                break;
            case 'project':
                $conditions.= 'Publication.project_id=' . $id;
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

    public function latest($type = null, $id = null) {
        $this->layout = FALSE;
        $this->viewData['type'] = $type;
        $this->viewData['id'] = $id;
        switch ($type) {
            case 'topic':
                $conditions = array(
                    'expert_comments.active=1 AND expert_comments.topic_id=' . $id,
                    'publications.active=1 AND publications.topic_id=' . $id,
                    'events.active=1 AND events.topic_id=' . $id
                );
                break;
            case 'region':
                $conditions = array(
                    'expert_comments.active=1 AND expert_comments.region_id=' . $id,
                    'publications.active=1 AND publications.region_id=' . $id,
                    'events.active=1 AND events.region_id=' . $id
                );
                break;
            case 'project':
                $conditions = array(
                    'expert_comments.active=1 AND expert_comments.project_id=' . $id,
                    'publications.active=1 AND publications.project_id=' . $id,
                    'events.active=1 AND events.project_id=' . $id
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
        $conditions = '';
        switch ($type) {
            case 'topic':
                $conditions.= 'ExpertComment.topic_id=' . $id;

                break;
            case 'region':
                $conditions.= 'ExpertComment.region_id=' . $id;
                break;
            case 'project':
                $conditions.= 'ExpertComment.project_id=' . $id;
                break;

            default:
                break;
        }

        $this->paginate = array(
            'ExpertComment' => array(
                'conditions' => $conditions,
                'limit' => 10,
                'queryId' => 2,
            )
        );
        $expertComments = $this->paginate('ExpertComment');
        $this->viewData['expertComments'] = $expertComments;
    }

    public function view($type = null, $id = null) {

        $this->viewData['type'] = $type;
        $this->viewData['id'] = $id;

        switch ($type) {
            case 'topic':
                $pconditions = array(
                    'Publication.topic_id' => $id
                );
                $econditions = array(
                    'ExpertComment.topic_id' => $id
                );
                $event_conditions = array(
                    'Event.topic_id' => $id,
                    'Event.event_date < NOW()'
                );
                $this->viewData['title'] = $this->topics[$id]['name'];
                $this->viewData['description'] = $this->topics[$id]['description'];
                $conditions = array(
                    'expert_comments.active=1 AND expert_comments.topic_id=' . $id,
                    'publications.active=1 AND publications.topic_id=' . $id,
                    'events.active=1 AND events.topic_id=' . $id
                );
                $vconditions = array(
                    'Video.topic_id' => $id
                );
                break;
            case 'region':
                $pconditions = array(
                    'PublicationRegions.region_id' => $id
                );
                $econditions = array(
                    'ExpertComment.region_id' => $id
                );
                $event_conditions = array(
                    'Event.region_id' => $id,
                    'Event.event_date < NOW()'
                );
                $this->viewData['title'] = $this->allregions[$id]['name'];
                $this->viewData['description'] = $this->allregions[$id]['description'];

                $conditions = array(
                    'expert_comments.active=1 AND expert_comments.region_id=' . $id,
                    'publications.active=1 AND PublicationRegion.region_id=' . $id,
                    'events.active=1 AND events.region_id=' . $id
                );
                $vconditions = array(
                    'Video.region_id' => $id
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
                    'Event.project_id' => $id,
                    'Event.event_date < NOW()'
                );
                $this->viewData['title'] = $this->projecrs[$id]['name'];
                $this->viewData['description'] = $this->projecrs[$id]['description'];
                $conditions = array(
                    'expert_comments.active=1 AND expert_comments.project_id=' . $id,
                    'publications.active=1 AND publications.project_id=' . $id,
                    'events.active=1 AND events.project_id=' . $id
                );
                $vconditions = array(
                    'Video.project_id' => $id
                );
                break;

            default:
                break;
        }

        $pub_count = $this->Publication->find('count', array(
            'conditions' => $pconditions,
            'joins' => array(
                array(
                    'alias' => 'PublicationRegions',
                    'table' => 'publication_regions',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Publication.id = PublicationRegions.publication_id'
                    ),
                )
            ),
            'group' => '`Publication`.`id`',
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

    public function video($id = null) {
        if ($id) {
            $video = $this->Video->findById($id);
            $this->viewData['video'] = $video;
        } else {
            $this->redirect('/');
        }
    }

    public function multimedia() {
        //$media = $this->Video->find('all');
        //$this->viewData['media'] = $media;

        $this->paginate = array(
            'Video' => array(
                'limit' => 10,
            )
        );
        $media = $this->paginate('Video');
        $this->viewData['media'] = $media;
    }

    public function gallery() {
        
    }
    public function library() {
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
    
    public function download_file($id) {
        if($id){
            $this->loadModel('Library');
            $librarie = $this->Library->findById($id);
            if(file_exists("system/libraries/".$librarie['Library']['filename'])){
                $name = $librarie['Library']['filename'];
                $title = $librarie['Library']['title'];
                $this->viewClass = 'Media';
                $path = "webroot/system/libraries/";
                // in this example $path should hold the filename but a trailing slash
                $params = array(
                    'id' => $name,
                    'name' => $title,
                    'download' => true,
                    'extension' => 'pdf',
                    'path' => $path
                );
                $this->set($params);
            }else{
                $this->redirect('/research/library');
            }
        }
    }
    
    public function test() {
        
    }
}
