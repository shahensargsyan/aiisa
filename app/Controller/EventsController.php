<?php
class EventsController extends AppController{
    public $name = "Events";
        public $uses = array(
        'Expert',
        'Expertise',
        'Experience',
        'UserEvent'
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'user';
    }

    public function index($id = 0,$past = null) {
        $this->viewData['id'] = $id;
        $this->viewData['past'] = $past;
        if(isset($this->request->data["op"]) && $this->request->data["op"] == "Clear"){
             $this->Session->write('search',array());
             $this->request->data = array();
        }
        $conditions = '';
        if($id){
            $this->request->data["date"]['event_type'] = $id;
        }
        $data = $this->Session->read('search');
        if(!$this->request->data){
               $this->request->data = $data;
        }else{
            $this->Session->write('search',$this->data);
        }
        if($past && $past='past'){
            $conditions.= ' AND Event.event_date < CURDATE()';
        }else{
            $conditions.= ' AND Event.event_date >= CURDATE()';
        }
        if($this->request->data){
            if(isset($this->request->data["date"]['event_type']) && $this->request->data["date"]['event_type'] != 'All'){
                $conditions.= ' AND Event.event_type='.$this->request->data["date"]['event_type'];
            }
            if(isset($this->request->data["date"]['topic']) && $this->request->data["date"]['topic'] != ''){
                $conditions.= ' AND Event.topic_id='.$this->request->data["date"]['topic'];
            }
            if(isset($this->request->data["date"]['region']) && $this->request->data["date"]['region'] != ''){
                $conditions.= ' AND Event.region_id='.$this->request->data["date"]['region'];
            }
            if(isset($this->request->data["date"]["year"]) && $this->request->data["date"]["year"]!= ''){
                $conditions.= " AND Event.event_date BETWEEN '".$this->request->data["date"]["year"].'-01-01'."' "
                        . "AND '".$this->request->data["date"]["year"].'-12-31'."'";
            }
        }
        
        
        $count = $this->Event->getEventCount($conditions);
        
        $this->viewData['count'] = $count;
        
        $this->paginate = array(
            'Event' => array(
                'conditions' => $conditions,
                'limit' => 10,
                'queryId' => 1, 
            )
        );
        $events = $this->paginate('Event');
        
        $this->viewData['events'] = $events;
        
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
    
    public function event($id = null){
        if($id){
            $event = $this->Event->find('first',array(
                'conditions' => array(
                    'Event.id' => $id
                ),
                'fields' => array('Event.*','EventType.name'),
                'joins' => array(
                        array(
                            'alias' => 'EventType',
                            'table' => 'event_types',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'EventType.id = Event.event_type'
                            ),
                        ) 
                    ),
                'limit' => 10,
                'order' => 'Event.id DESC'
            ));
            
            $this->viewData['event'] = $event;
        }else{
            $this->redirect('/events/index');
        }
    }
    
    public function register($id = null){
        if($id){
            $event = $this->Event->findById($id);
            if($event){
                
            }
            
        }else{
            
        }
    }
}


?>
