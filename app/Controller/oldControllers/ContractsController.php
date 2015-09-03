<?php

App::uses('AppController', 'Controller');

class ContractsController extends AppController{
    public $components = array('CreatePDF');
        public $uses = array(
            'Log'
        );
    public function index(){
        $this->redirect('/');
    }
    
    public function contract(){
        
    }
    
    public function fill_information($name = NULL,$orderId = null){
        if($name){
            $this->css_for_layout_include[] = 'jquery.steps';
            $this->scripts_for_layout_include[] = 'jquery.steps';
            $this->scripts_for_layout_include[] = 'jquery.validate.min';
            $this->scripts_for_layout_include[] = 'jquery-ui.min';
            $this->css_for_layout_include[] = 'jquery-ui.min';
            if($orderId){
                $this->loadModel('Order');
                $order = $this->Order->findById($orderId);
                if($order){
                    $contractData['Order'] = $order['Order'];
                    $contractData['id'] = $order['Order']['contract_id'];
                    $contractData['Data'] = json_decode($order['Order']['data'],true);
                    $contractData['log_id'] = $order['Order']['log_id'];
                    $this->Session->write('contract_'.$order['Order']['contract_id'], $contractData);
                    $saved = $this->Cookie->write('contract_'.$order['Order']['contract_id'],json_decode($order['Order']['data'],true));
                    $log_id = $order['Order']['log_id'];
                }
            }else{
                $orderId = 0;
            }
            $this->viewData['orderId'] = $orderId;
            $this->loadModel('Contract');
            $this->loadModel('FormId');
            $string = preg_replace('/_/', ' ', $name);
            $contract = $this->Contract->find('first',array(
                'conditions' => array(
                    'name="'.$string.'"'
                )
            ));
            if($contract){
                $logData = array(
                    'contract_id' => $contract['Contract']['id'],
                    'type' => 'fill_information',
                    'user_ip' => $this->request->clientIp()
                );
                if(isset($log_id)){
                    $logData['id'] = $log_id;
                }
                
                $log_id = $this->Dashboard->saveLog($logData);
                
                $this->viewData['log_id'] = $log_id;
                $saved = $this->Cookie->read('contract_'.$contract['Contract']['id']);
                if($saved && is_array($saved)){
                    foreach ($saved as $key => $value) {
                        $this->request->data[$key] = $value;
                    }
                }
                $id = $contract['Contract']['id'];
                $stepsIds = array();
                $form = array();
                if ($contract['Contract']['form'] && is_array(json_decode($contract['Contract']['form'], TRUE))) {
                    $form = json_decode($contract['Contract']['form'], TRUE);
                    foreach ($form as $key => $value) {
                        
                        $stepsIds[$key] = $value['name'];
                        $value = $value['data'];
                        foreach ($value as $k => $val) {
                            $form[$val["form_id"]] = $val;   
                        }

                    }
                }
                if(is_array(json_decode($contract['Contract']['form'], TRUE))){
                    $steps = json_decode($contract['Contract']['form'], TRUE);
                }  else {
                    $steps = array();
                }
                $steps = json_decode($contract['Contract']['form'], TRUE);
                $this->viewData['steps'] = $steps;
                $this->viewData['stepsIds'] = $stepsIds;
                $this->viewData['contract'] = $contract['Contract'];
                $this->viewData['form'] = $form;
                
                $json_form = array();
                $step_id = 0;
                foreach ($form as $key => $value) {
                    
                    if(isset($value['data'])){
                       foreach ($value['data'] as $k => $val) {
                           if($val['form_id']){
                                $val['step'] = $step_id;
                                $json_form[$val['form_id']] = $val;
                           }
                        }
                    }
                    $step_id++;
                }
                //var_dump($json_form);die;
                $this->viewData['json_form'] = $json_form;
                $form_ids = $this->FormId->find('all');
                $f_ids = array();
                foreach ($form_ids as $key => $value) {
                    $f_ids[$value ["FormId"]["id"]] = $value ["FormId"]["form_id"];
                }
                $this->viewData['form_ids'] = $f_ids;
                
            }else{
                $this->redirect('/');
            }
        }else{
            $this->redirect('/');
        }
        //Contract Question
        $this->loadModel('Question');
        $this->loadModel('Question_contract');
        
        $faq_question = $this->Question->find('all',array(
            'joins' => array(
                array(
                    'alias' => 'Question_contract',
                    'table' => 'question_contracts',
                    'type' => 'LEFT',
                    'conditions' => array(
                        "Question_contract.contract_id = $id"
                    )
                )
             ),
            'conditions' => array(
                'OR' => array(
                    array('Question.faq_category_id' => 1),
                    array('Question.faq_category_id' => 'Question_contract.question_id'),
                )
            ),
            'fields'=>array('DISTINCT Question.id','Question.question','Question.answer')
        ));
        //var_dump((int)(count($faq_question)/count($steps)));die;
        $count = 1;
        if(count($steps) > 0 && count($faq_question)/count($steps) > 1){
            $count = round(count($faq_question)/count($steps));
        }
        $this->viewData['count'] = $count;
        //var_dump($count,$faq_question);die;
        $this->set('faq_question',$faq_question);
    }
    
    public function saveInformation() {
        $status = false;
        $message = __('no data');

        if(isset($_POST) && $_POST["data"]&& $_POST["id"] && $_POST["log_id"]){
            $contract = array();
            foreach ($_POST['data'] as $key => $value){
                $name = str_replace('data[','',$value["name"]);
                $name = str_replace(']','',$name);
                $contract[$name] = $value["value"];
            }
            $contractData['id'] = $_POST["id"];
            $contractData['Data'] = $contract;
            $logData = array(
                'contract_id' => $_POST["id"],
                'type' => 'fill_information',
                'user_ip' => $this->request->clientIp(),
                'id' => $_POST["log_id"]
            );
            if($this->u_id){
                
                $this->loadModel('Order');
                $order = array(
                    'contract_id' => $_POST["id"],
                    'user_id' => $this->u_id,
                    'data' => json_encode($contractData["Data"]),
                    'finished' => 0
                );
                if($_POST['orderId']){
                    $order['id'] = $_POST['orderId'];
                }
                $save = $this->Order->save($order);
                if($save){
                    $order = $this->Order->findById($save['Order']['id']);
                    $contractData['Order'] = $order["Order"];
                    
                    $logData['order_id'] = $order['Order']['id'];

                    
                }else{
                    $message = __("Can't save order!");
                }
            }
            
            $log_id = $this->Dashboard->saveLog($logData);
            //var_dump($log_id);die;
            if($log_id){
                if($this->u_id){
                    $order = array(
                        'id' => $order['Order']['id'],
                        'log_id' => $log_id,
                        'finished' => 0
                    );
                    $save = $this->Order->save($order);
                }
                $contractData['log_id'] = $log_id;
                $this->Session->write('contract_'.$_POST["id"], $contractData);
                $this->Cookie->write('contract_'.$_POST["id"], $contract, false, '+1 day');
                if ($this->Session->check('contract_'.$_POST["id"])) {
                    $status = true;

                    $message = __('data saved');
                }else{
                    $message = __("Can't find session!");
                }
            }  else {
                $message = __("Can't save log!");
            }
        }
        $this->_sendResponse($status, $message);
    }
    
    public function save_changes() {
        $status = false;
        $message = __('no data');
        $contract = array();
        if($this->u_id){
            if(isset($_POST) && $_POST["data"] && $_POST["orderId"] && $_POST["step_id"]){
                $this->loadModel('Order');
                $order = $this->Order->findById($_POST["orderId"]);
                if($order['Order']){
                    if($order['Order']['user_id'] == $this->u_id){
                        
                        foreach ($_POST['data'] as $key => $value){
                            $name = str_replace('data[','',$value["name"]);
                            $name = str_replace(']','',$name);
                            $contract[$name] = $value["value"];
                        }
                        
                        if(is_array(json_decode($order['Order']['data'],TRUE))){
                            $data = json_decode($order['Order']['data'],TRUE);
                            foreach ($contract as $key => $value) {
                                $data[$key] = $contract[$key];
                            }
                        }
                        
                        $save = $this->Order->save(array(
                            'id' => $order['Order']['id'],
                            'data' => json_encode($data),
                            'finished' => 0
                         ));
                        
                        $logData = array(
                            'id' => $order['Order']['log_id'],
                            'contract_id' => $order['Order']['contract_id'],
                            'type' => 'fill_information',
                            'user_ip' => $this->request->clientIp()
                        );

                        $log_id = $this->Dashboard->saveLog($logData);
                        
                        $contractData['id'] = $order['Order']['contract_id'];
                        $contractData['Data'] = $contract;
                        $contractData['log_id'] = $log_id;
                        $contractData['Order'] = $order['Order'];
                        $this->Session->write('contract_'.$order['Order']['contract_id'], $contractData);
                        
                        if ($save) {
                            $status = true;
                            $contract = $this->Contract->findById($order['Order']['contract_id']);
                            $form = array();
                            if ($contract['Contract']['form'] && is_array(json_decode($contract['Contract']['form'], TRUE))) {
                                foreach (json_decode($contract['Contract']['form'], TRUE) as $key => $value) {
                                    $stepsIds[$key] = $value['name'];

                                    foreach ($value['data'] as $k => $val) {
                                        $form[$val["form_id"]] = $val;   
                                    }

                                }
                            }
                            $contract['Data'] = $data;
                            

                            $this->loadModel('FormId');
                            $form_ids = $this->FormId->find('list',array(
                                'fields' => array('id','form_id')
                            ));
                            $variables = array();
                            $step_data = json_decode($contract['Contract']['form'], TRUE);
                            if ($step_data && is_array($step_data)) {
                                foreach ($step_data as $stepsIds => $value) {
                                    if($_POST["step_id"] == $stepsIds)
                                    foreach ($value['data'] as $k => $val) {
                                        switch($val['type']){
                                            case 'text':{
                                                $variables[$stepsIds]['name'][] = $val['label'];
                                                $text = '';
                                                if(isset($contract['Data'][$form_ids[$val["form_id"]]]))
                                                $text = $contract['Data'][$form_ids[$val["form_id"]]];                                        
                                                $variables[$stepsIds]['FormId'][$form_ids[$val["form_id"]]] = $text;                                        
                                            }
                                            break;
                                            case 'textarea':{
                                                $variables[$stepsIds]['name'][] = $val['label'];
                                                $textarea = '';
                                                if(isset($contract['Data'][$form_ids[$val["form_id"]]])){
                                                    $textarea = $contract['Data'][$form_ids[$val["form_id"]]];
                                                }
                                                $variables[$stepsIds]['FormId'][$form_ids[$val["form_id"]]] = $textarea;
                                            }
                                                break;
                                            case 'select':{
                                                $variables[$stepsIds]['name'][] = $val['label'];
                                                if(isset($val["choises"])){
                                                    $options = array_filter($val["choises"]);
                                                }else{
                                                    $options = array();
                                                }
                                                $select = '';
                                                if(isset($options[$contract['Data'][$form_ids[$val["form_id"]]]]))
                                                $select = $options[$contract['Data'][$form_ids[$val["form_id"]]]];
                                                $variables[$stepsIds]['FormId'][$form_ids[$val["form_id"]]] = $select;
                                            }
                                                break;
                                            case 'checkbox':{
                                                $variables[$stepsIds]['name'][] = $val['label'];
                                                if(($contract['Data'][$form_ids[$val["form_id"]]])){
                                                    $checkbox = 'Yes';
                                                }else{
                                                    $checkbox = 'No';
                                                }
                                                $variables[$stepsIds]['FormId'][$form_ids[$val["form_id"]]] = $checkbox;
                                            }
                                                break;
                                            case 'radiobatton':{
                                                $variables[$stepsIds]['name'][] = $val['label'];
                                                if(isset($val["radio"])){
                                                    $options = array_filter($val["radio"]);
                                                }else{
                                                    $options = array();
                                                }
                                                $radiobatton = '';
                                                if(isset($contract['Data'][$form_ids[$val["form_id"]]]))
                                                $radiobatton = $options[$contract['Data'][$form_ids[$val["form_id"]]]];
                                                $variables[$stepsIds]['FormId'][$form_ids[$val["form_id"]]] = $radiobatton;
                                            }
                                                break;
                                            case 'date':{
                                                $variables[$stepsIds]['name'][] = $val['label'];
                                                $date = '';
                                                if(isset($contract['Data'][$form_ids[$val["form_id"]]]))
                                                $date = $contract['Data'][$form_ids[$val["form_id"]]];
                                                $variables[$stepsIds]['FormId'][$form_ids[$val["form_id"]]] = $date;
                                            }
                                                break;
                                            default:
                                                break;
                                        }
                                    }
                                }
                            }
                            //var_dump($variables);die;
                            $message = __('data saved');
                        }
                    }else{
                        $message = __('You have not access!');
                    }
                }else{
                    $message = __('Cant find order');
                }
            }
        }else{
            $message = __('You must login for change order!');
        }
        $this->_sendResponse($status, $message, $variables[$_POST["step_id"]]['FormId']);
    }

    public function choose_license($id = NULL,$orderId = null){
        if($id){
            
            $this->loadModel('Contract');
            $this->loadModel('Order');
            if(!$this->Session->check('contract_'.$id) && $orderId){
                $order = $this->Order->find('first',array(
                    'conditions' => array(
                        'Order.id='.$orderId
                    ),
                    'fields' => array(
                        'Order.*',
                        'Log.*'
                    ),
                    'joins' => array(
                        array(
                            'alias' => 'Log',
                            'table' => 'logs',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Log.id = Order.log_id'
                            )
                        )
                    ),
                ));
                if($order && $order['Order']['paid'] == TRUE){
                    $this->redirect('/contracts/review_finalize/'.$orderId);
                }else{
                    //var_dump($order);die;
                    $contractData['Order'] = $order['Order'];
                    $contractData['id'] = $order['Order']['contract_id'];
                    $contractData['Data'] = json_decode($order['Order']['data'],true);
                    $contractData['log_id'] = $order['Order']['log_id'];;
                    $this->Session->write('contract_'.$order['Order']['contract_id'], $contractData);
                }
            }
            if($this->Session->check('contract_'.$id)){
                $contractData = $this->Session->read('contract_'.$id);
                $logData = array(
                    'contract_id' => $id,
                    'user_ip' => $this->request->clientIp(),
                    'id' => $contractData["log_id"]
                );
                $this->loadModel('Log');
                $type = $this->Log->findById($contractData["log_id"]);
                if(!in_array($type['Log']['type'], array('pay','review_finalize'))){
                      $logData['type'] = 'choose_license';
                }
                $log_id = $this->Dashboard->saveLog($logData);
                
                if(isset($contractData['Order']['id'])){
                    $order = $this->Order->findById($contractData['Order']['id']);
                    if($order && $this->u_id && isset($order['Order']) && $order['Order']['paid'] == TRUE){
                        $this->redirect('/contracts/review_finalize/'.$order['Order']['id']);
                    }
                }
                //$this->loadModel('Contract');
                $contract = $this->Contract->findById($contractData['id']);
                $this->viewData['contract'] = $contract['Contract'];
                if($contract){
                    $this->loadModel('Membership');
                    $this->loadModel('MembershipContract');
                    $mem = $this->MembershipContract->find('all',array(
                        'conditions' => array(
                            'contract_id' => $contract['Contract']['id']
                        ),
                        'fields' => 'membership_id'
                    ));
                    
                    $ids = array();
                    foreach ($mem as $key => $value) {
                         $ids[$value["MembershipContract"]['membership_id']] = $value["MembershipContract"]['membership_id'];
                    }
                    
                    $memberships = $this->Contract->find('all',array(
                        'conditions' => array(
                            'MembershipContracts.membership_id' => $ids
                        ),
                        'fields' => array('Contract.*','MembershipContracts.*','Membership.*'),
                        'joins' => array(
                            array(
                                'alias' => 'MembershipContracts',
                                'table' => 'membership_contracts',
                                'type' => 'LEFT',
                                'conditions' => array(
                                    'Contract.id = MembershipContracts.contract_id'
                                )
                            ),
                            array(
                                'alias' => 'Membership',
                                'table' => 'memberships',
                                'type' => 'LEFT',
                                'conditions' => array(
                                    'Membership.id = MembershipContracts.membership_id'
                                )
                            )
                        ),
                    ));
                    $mem = array();
                    foreach ($ids as $key => $value) {
                        if(is_array($memberships)){
                            foreach ($memberships as $k => $val) {
                                if ($value == $val["MembershipContracts"]["membership_id"]){
                                    $mem[$value]["Contract"][$val["Contract"]['id']] = $val["Contract"];
                                    $mem[$value]["Membership"] = $val["Membership"];
                                }
                            }
                        }
                    }
                    $this->viewData['memberships'] = $mem;
                    $this->viewData['id'] = $id;
                }else{
                    $this->Session->setFlash(__("Can't find contract!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                        $this->redirect('/');
                }
            }else{
                $this->Session->setFlash(__("Can't find contract session!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                $this->redirect('/');
            }
        }else{
            $this->Session->setFlash(__("Can't find contract id!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            $this->redirect('/');
        }
    }
        
    public function pay($id = null,$membership_id = null){
        if($id && $membership_id){
            $Contract = $this->Contract->findById($id);
            
            if($Contract){
                if($this->Session->check('contract_'.$id)){
                    $this->loadModel('Membership');
                    $membership = $this->Membership->findById($membership_id);
                    if($membership){
                        $paid = 0;
                        if($membership['Membership']['type'] == 'package'){
                            $price = (int)$membership['Membership']['month_price'];
                        }else{
                            $price = (int)$membership['Membership']['individual_price'];
                        }
                        if($price == 0){
                            $paid = 1;
                        }
                        $contractData = $this->Session->read('contract_'.$id);
                        $contractData['membership_id'] = $membership_id;

                        $this->loadModel('Contract');
                        /*if($this->u_id && $contractData['Membership']['id'] == $membership['Membership']['id']){
                            
                        }*/
                        //var_dump($contractData);die;
                        $this->Session->write('contract_'.$id, $contractData);
                        $logData = array(
                            'id' => $contractData['log_id'],
                            'membership_id' => $membership_id,
                            'type' => 'pay',
                            'user_ip' => $this->request->clientIp()
                        );

                        $this->Dashboard->saveLog($logData);

                        $this->viewData['id'] = $id;
                        $this->loadModel('Order');
                        if($this->u_id && isset($contractData['Order'])){
                            $order = $this->Order->findById($contractData['Order']['id']);
                            if($order){
                                if($order['Order']['paid'] == TRUE){
                                    $this->redirect('/contracts/review_finalize/'.$order['Order']['contract_id']);
                                }else{
                                    $order = array(
                                        'id' => $order['Order']['id'],
                                        'contract_id' => $id,
                                        'paid' => $paid,
                                        'user_id' => $this->u_id,
                                        'membership_id' => $membership_id,
                                        'data' => json_encode($contractData["Data"]),
                                        'finished' => 0
                                    );

                                    $save = $this->Order->save($order);
                                    if($save){
                                        $logData['order_id'] = $save["Order"]['id'];
                                        $order = $this->Order->findById($save['Order']['id']);
                                        $contract['Order'] = $order["Order"];
                                    }else{
                                        $this->Session->setFlash(__("Can't save order!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                                        $this->redirect('/contracts/');
                                    }
                                }
                            }else{
                                $this->Session->setFlash(__("Can't find order!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                                $this->redirect('/contracts/');
                            }
                        }
                    
                    
                        $contract['Membership'] = $membership['Membership'];
                        $contract['Data'] = $contractData["Data"];
                        $contract['id'] = $id;
                        
                        $logId = $this->Dashboard->saveLog($logData);
                        
                        $contract['log_id'] = $logId;
                        $this->Session->write('contract_'.$id, $contract);

                        
                        if($this->u_id){
                            $this->Order->save(array(
                                'id' => $save['Order']['id'],
                                'log_id' => $logId,
                                'finished' => 0
                            ));
                        }
                        
                        
                        $this->viewData['data'] = $contract;
                        if($this->u_id){
                            $this->viewData['membership'] = $membership;
                            $this->redirect('/contracts/pay_contract/'.$contract['Order']['id'].'/'.$id);
                        }else{
                            if($membership)
                            if($membership['Membership']['type'] == 'package'){
                                $price = (int)$membership['Membership']['month_price'];
                            }else{
                                $price = (int)$membership['Membership']['individual_price'];
                            }
                            if($price == 0){
                                $message = __( 'You must register or login for save order!');
                            }else{
                                $message = __( 'You must register or login for save and pay order!');
                            }
                            $this->Session->setFlash( $message, 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                            $this->redirect('/contracts/quick_register/'.$id);
                        }
                    }else{
                        $this->Session->setFlash(__( 'Cant find membership!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                        $this->redirect('/');
                    }
                }else{
                    $this->Session->setFlash(__( 'Cant find contract session!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                    $this->redirect('/');
                }

            }else{
                $this->Session->setFlash(__( 'Cant find contract!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                $this->redirect('/');
            }
        }else{
            $this->Session->setFlash(__( 'Cant find contract id!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            $this->redirect('/');
        }
    }
    
    public function pay_contract($order_id = null,$contract_id = null){
        if($order_id && $contract_id){
            $this->loadModel('Order');
            $order = $this->Order->find('first',array(
                'conditions' => array(
                    'Order.id='.$order_id
                ),
                'fields' => array(
                    'Order.*','Membership.*'
                ),
                'joins' => array(
                    array(
                        'alias' => 'Membership',
                        'table' => 'memberships',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Membership.id = Order.membership_id'
                        )
                    )
                ),
            ));
            $reccuring = FALSE;
            if($order){
                $contract = $this->Contract->findById($order['Order']['contract_id']);
                $this->viewData['contract'] = $contract['Contract'];
                if($order['Membership']['type'] == 'package'){
                    $reccuring = TRUE;
                    $price = (int)$order['Membership']['month_price'];
                }else{
                    $price = (int)$order['Membership']['individual_price'];
                }
                if($price == 0){
                    $save = $this->Order->save(array(
                        'id' => $order_id,
                        'paid' => 1,
                        'finished' => 0
                    ));
                    if($save){
                        $this->redirect('/contracts/review_finalize/'.$order_id);
                    }else{
                        $this->Session->setFlash(__("Can't save Order!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                        $this->redirect('/');
                    }
                }
                $this->viewData['reccuring'] = $reccuring;
                $this->viewData['price'] = $price;
                $this->viewData['order'] = $order;
                $mode = Configure::read('mode');
                
                $this->viewData['mode'] = $mode;
                
                $this->viewData['sid'] = Configure::read($mode.'.sid');
                
            }else{
                $this->Session->setFlash(__("Can't find Order!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            }
            $this->viewData['order_id'] = $order_id;
            $this->viewData['contract_id'] = $contract_id;
        }else{
            $this->Session->setFlash(__( 'Cant find contract id!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            $this->redirect('/');
        }
        
    }
    
    public function finalize_order(){
        $status = false;
        $message = __('no data');
        $contract = array();
        if($this->u_id){
            
            if(isset($_POST) && $_POST["orderId"]){
                $this->loadModel('Order');
                $order = $this->Order->findById($_POST["orderId"]);
                if($order['Order'] || !$order['Order']['count']){
                    if($order['Order']['user_id'] == $this->u_id){
                        if((int)$order['Order']['count']){
                            $count = (int)$order['Order']['count']-1;

                            if($count == 0){
                                $save = $this->Order->save(array(
                                    'id' => $order['Order']['id'],
                                    'count' => $count,
                                    'finished' => 1
                                )); 
                            }else{
                                $save = $this->Order->save(array(
                                    'id' => $order['Order']['id'],
                                    'count' => $count,
                                    'finished' => 1
                                )); 
                            }
                            if($save){
                                $status = true;
                                $message = '';
                                $contract = $save['Order']['id'];
                            }else{
                                $message = __('Something went wrong!');
                            }
                        }else{
                            $message = __("Edit limit is exoired!");
                        }
                    }else{
                        $message = __('You have not access!');
                    }
                }else{
                    $message = __('Cant find order');
                }
            }else{
                 $message = __('Cant find order Id order!');
            }
        }else{
            $message = __('You must login for change order!');
        }
        $this->_sendResponse($status, $message, $contract);
    }

    public function review_finalize($id = null,$modify = null){
        if($this->u_id){
            if(isset($id)){                
                $this->loadModel('Order');
                $this->loadModel('Contract');
                $order = $this->Order->findById($id);
                
                if($order){
                    if($this->u_id == $order['Order']['user_id']){
                        if((int)$order['Order']['count'] > 0){
                            $this->Cookie->delete('contract_'.$order['Order']['contract_id']);
                            $contract = $this->Contract->findById($order['Order']['contract_id']);
                            if($contract){
                                $form = array();
                                if ($contract['Contract']['form'] && is_array(json_decode($contract['Contract']['form'], TRUE))) {
                                    foreach (json_decode($contract['Contract']['form'], TRUE) as $key => $value) {
                                        $stepsIds[$key] = $value['name'];

                                        foreach ($value['data'] as $k => $val) {
                                            $form[$val["form_id"]] = $val;   
                                        }

                                    }
                                }
                                $contract['Data'] = json_decode($order['Order']['data'],TRUE);
                                $this->viewData['form']  = $form;
                                $this->viewData['orderId']  = $order['Order']['id'];

                                $logData = array(
                                    'id' => $order['Order']['log_id'],
                                    'type' => 'review_finalize',
                                    'user_ip' => $this->request->clientIp(),
                                    'email' => $this->userDb['User']['email']
                                );
                                $this->Dashboard->saveLog($logData);

                                $this->loadModel('FormId');
                                $form_ids = $this->FormId->find('list',array(
                                    'fields' => array('id','form_id')
                                ));
                                $variables = array();
                                $step_data = json_decode($contract['Contract']['form'], TRUE);
                                if ($contract['Contract']['form'] && is_array($step_data)) {
                                    foreach ($step_data as $stepsIds => $value) {
                                        foreach ($value['data'] as $k => $val) {
                                            switch($val['type']){
                                                case 'text':{
                                                    $variables[$stepsIds]['name'][] = $val['label'];
                                                    $text = '';
                                                    if(isset($contract['Data'][$form_ids[$val["form_id"]]]))
                                                    $text = $contract['Data'][$form_ids[$val["form_id"]]];                                        
                                                    $variables[$stepsIds]['FormId'][$form_ids[$val["form_id"]]] = $text;                                        
                                                }
                                                break;
                                                case 'textarea':{
                                                    $variables[$stepsIds]['name'][] = $val['label'];
                                                    $textarea = '';
                                                    if(isset($contract['Data'][$form_ids[$val["form_id"]]])){
                                                        $textarea = $contract['Data'][$form_ids[$val["form_id"]]];
                                                    }
                                                    $variables[$stepsIds]['FormId'][$form_ids[$val["form_id"]]] = $textarea;
                                                }
                                                    break;
                                                case 'select':{
                                                    $variables[$stepsIds]['name'][] = $val['label'];
                                                    if(isset($val["choises"])){
                                                        $options = array_filter($val["choises"]);
                                                    }else{
                                                        $options = array();
                                                    }
                                                    $select = '';
                                                    if(isset($options[$contract['Data'][$form_ids[$val["form_id"]]]]))
                                                    $select = $options[$contract['Data'][$form_ids[$val["form_id"]]]];
                                                    $variables[$stepsIds]['FormId'][$form_ids[$val["form_id"]]] = $select;
                                                }
                                                    break;
                                                case 'checkbox':{
                                                    $variables[$stepsIds]['name'][] = $val['label'];
                                                    if(($contract['Data'][$form_ids[$val["form_id"]]])){
                                                        $checkbox = 'Yes';
                                                    }else{
                                                        $checkbox = 'No';
                                                    }
                                                    $variables[$stepsIds]['FormId'][$form_ids[$val["form_id"]]] = $checkbox;
                                                }
                                                    break;
                                                case 'radiobatton':{
                                                    $variables[$stepsIds]['name'][] = $val['label'];
                                                    if(isset($val["radio"])){
                                                        $options = array_filter($val["radio"]);
                                                    }else{
                                                        $options = array();
                                                    }
                                                    $radiobatton = '';
                                                    if(isset($contract['Data'][$form_ids[$val["form_id"]]]))
                                                    $radiobatton = $options[$contract['Data'][$form_ids[$val["form_id"]]]];
                                                    $variables[$stepsIds]['FormId'][$form_ids[$val["form_id"]]] = $radiobatton;
                                                }
                                                    break;
                                                case 'date':{
                                                    $variables[$stepsIds]['name'][] = $val['label'];
                                                    $date = '';
                                                    if(isset($contract['Data'][$form_ids[$val["form_id"]]]))
                                                    $date = $contract['Data'][$form_ids[$val["form_id"]]];
                                                    $variables[$stepsIds]['FormId'][$form_ids[$val["form_id"]]] = $date;
                                                }
                                                    break;
                                                default:
                                                    break;
                                            }
                                        }
                                    }
                                }
                                //var_dump($variables);die;
                                $form_ids = $this->FormId->find('all');
                                $f_ids = array();
                                foreach ($form_ids as $key => $value) {
                                    $f_ids[$value ["FormId"]["id"]] = $value ["FormId"]["form_id"];
                                }
                                $this->viewData['form_ids'] = $f_ids;
                                $this->viewData['steps'] = json_decode($contract['Contract']['form'], TRUE);
                                $this->set('variables',$variables);
                                $this->viewData['contract'] = $contract;
                            }else{
                                $this->Session->setFlash(__( 'error'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                                $this->redirect('/');
                            }
                        }else{
                            $this->Session->setFlash(__( "You Can't modify this order!<br> Your modify limit is expired"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                            $this->redirect('/pages/orders');
                        }
                    }else{
                        $this->Session->setFlash(__( "You Can't modify this order!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                        $this->redirect('/pages/orders');
                    }
                }else{
                    $this->Session->setFlash(__( "Can't find order!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                    $this->redirect('/pages/orders');
                }

            }else{
                $this->Session->setFlash(__( 'error'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                $this->redirect('/');
            }
           
        }else{
            $this->Session->setFlash(__( "You must login for review order!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            $this->redirect('/'); 
        }
    }
    
    public function download_pdf($id = null){
        if($id){
            $this->loadModel('Order');
            $order = $this->Order->findById($id);
            if($order){
                $contract = $this->Contract->findById($order['Order']['contract_id']);
                $this->viewData['contract'] = $contract['Contract'];
                if($order['Order']['finished']){
                    $logData = array(
                        'id' => $order['Order']['log_id'],
                        'type' => 'download',
                        'user_ip' => $this->request->clientIp()
                    );
                    $this->Dashboard->saveLog($logData);
                    //$this->viewData['contract'] = $contract;
                    $this->viewData['orderId'] = $id;
                }else{
                    $this->Session->setFlash(__( "You must finalize this contract for download it!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                    $this->redirect('/pages/orders'); 
                }
            }else{
                $this->Session->setFlash(__( 'Cant find order!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                $this->redirect('/');
            }
        }else{
            $this->Session->setFlash(__( 'No Contract id!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            $this->redirect('/');
        }
    }


    public function download($id = null,$print = null){
        if($id){
            $this->loadModel('Order');
            $order = $this->Order->findById($id);
            if($order){
                $this->loadModel('Contract');
                $contract = $this->Contract->findById($order['Order']['contract_id']);
                if($contract){
                    $data = json_decode($order['Order']['data'],TRUE);
                    $this->loadModel('FormId');
                    $form_ids = $this->FormId->find('all');
                    $f_ids = array();
                    foreach ($form_ids as $key => $value) {
                        $f_ids[$value["FormId"]["id"]] = $value ["FormId"]["form_id"];
                    }
                    $variables = array();
                    $connectives = array();
                    if ($contract['Contract']['form'] && is_array(json_decode($contract['Contract']['form'], TRUE))) {
                        foreach (json_decode($contract['Contract']['form'], TRUE) as $key => $value) {
                            $stepsIds[$key] = $value['name'];

                            foreach ($value['data'] as $k => $val) {
                                if(isset($val['type'])){
                                    switch ($val['type']) {
                                        case 'select':
                                            $connectives[$key][$val['form_id']] = $val["choises"];
                                        break;
                                        case 'radiobatton':
                                            $connectives[$key][$val['form_id']] = $val["radio"];
                                        break;
                                        case 'checkbox':
                                            $connectives[$key][$val['form_id']] = array(0 => 'No',1 => 'Yes');
                                        break;
                                    }
                                }
                            }
                        }
                        foreach (json_decode($contract['Contract']['form'], TRUE) as $key => $value) {
                            $stepsIds[$key] = $value['name'];

                            foreach ($value['data'] as $k => $val) {
                                switch($val['type']){
                                    case 'text':
                                        $text = '';
                                        if(isset($data[$f_ids[$val["form_id"]]]))
                                        $text = $data[$f_ids[$val["form_id"]]];
                                        $variables[$f_ids[$val["form_id"]]] = $text;
                                        break;
                                    case 'textarea':
                                        $textarea = '';
                                        if(isset($data[$f_ids[$val["form_id"]]]))
                                        $textarea = $data[$f_ids[$val["form_id"]]];
                                        $variables[$f_ids[$val["form_id"]]] = $textarea;
                                        break;
                                    case 'select':
                                        if(isset($val["choises"])){
                                            $options = array_filter($val["choises"]);
                                        }else{
                                            $options = array();
                                        }
                                        $select = '';
                                        if(isset($data[$f_ids[$val["form_id"]]]))
                                        $select = $options[$data[$f_ids[$val["form_id"]]]];
                                        $variables[$f_ids[$val["form_id"]]] = $select;
                                        break;
                                    case 'checkbox':
                                        if($data[$f_ids[$val["form_id"]]]){
                                            $checkbox = 'Yes';
                                        }else{
                                            $checkbox = 'No';
                                        }
                                        $variables[$f_ids[$val["form_id"]]] = $checkbox;
                                        break;
                                    case 'radiobatton':
                                        if(isset($val["radio"])){
                                            $options = array_filter($val["radio"]);
                                        }else{
                                            $options = array();
                                        }
                                        $radiobatton = '';
                                        if(isset($data[$f_ids[$val["form_id"]]]))
                                        $radiobatton = $options[$data[$f_ids[$val["form_id"]]]];
                                        $variables[$f_ids[$val["form_id"]]] = $radiobatton;
                                    case 'date':
                                        $date = '';
                                        if(isset($data[$f_ids[$val["form_id"]]]))
                                        $date = $data[$f_ids[$val["form_id"]]];
                                        $variables[$f_ids[$val["form_id"]]] = $date;
                                    default:
                                        break;
                                }  
                                
                                
                            }

                        }
                        /*foreach (json_decode($contract['Contract']['form'], TRUE) as $key => $value) {
                            $stepsIds[$key] = $value['name'];

                            foreach ($value['data'] as $k => $val) {
                                if(isset($val['type'])){
                                    if($val['connective_element'] && $val['connective_element_value']){
                                        if($variables[$f_ids[$val['connective_element']]] != $val['connective_element_value']){
                                            $variables[$f_ids[$val["form_id"]]] = '';
                                        }
                                    }
                                }
                            }
                        }*/
                    }
                    
                    //var_dump($variables);die;
                    $name = $this->CreatePDF->replace($variables,$contract['Contract']['document']);
                    if($name){
                        $this->Order->save(array(
                            'id' =>  $id,
                            'finished' => 1
                        ));
                        if($print){
                            $name = $this->CreatePDF->download($name.'.docx',1);
                        }else{
                            $name = $this->CreatePDF->download($name.'.docx');
                        }
                        if($name){
                            @unlink('system/print_documents/'.$order['Order']['pdf']);
                            $this->Order->save(array(
                                'id' => $id,
                                'pdf' => $name
                            ));
                            $this->redirect('/system/print_documents/'.$name);
                        }else{
                            
                        }
                    }else{
                        $this->Session->setFlash(__( 'PDF create error!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                    }
                }else{
                    $this->Session->setFlash(__( 'Cant find contract'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                    $this->redirect('/pages/orders');
                }
            }else{
                $this->Session->setFlash(__( 'Cant find order'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                $this->redirect('/pages/orders');
            }
        }else{
            $this->Session->setFlash(__( 'Cant find contract'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            $this->redirect('/pages/orders');
        
        }
    }

    public function quick_register($id = null ){
        App::import('Vendor', 'facebook', array('file' => 'facebook/facebook.php'));
        $contractData = $this->Session->read('contract_'.$id);
        //var_dump($contractData);die;
        if($contractData){
            //facebook
            $facebook = new Facebook(
                array(
                    'appId' => Configure::read('Facebook.appId'),
                    'secret' => Configure::read('Facebook.appSecret'),
                )
            );
            //facebook registration
            $redirectUrl = Router::url(array('controller' => 'users', 'action' => 'registration',$id,$contractData['Membership']['id']), true); //FULL_BASE_URL_MINE . 'users/add';

            $params = array(
                'scope' => 'user_about_me,user_activities,user_birthday,user_checkins,user_education_history,user_events,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_online_presence,user_photo_video_tags,user_photos,user_relationships,user_relationship_details,user_religion_politics,user_status,user_videos,user_website,user_work_history,email,read_friendlists,read_insights,read_mailbox,read_requests,read_stream,xmpp_login,ads_management,create_event,manage_friendlists,manage_notifications,offline_access,publish_checkins,publish_stream,rsvp_event,sms,publish_actions,manage_pages',
                'redirect_uri' => $redirectUrl,
            );
            $this->viewData['fb_registration'] = $facebook->getLoginUrl($params);
            
            //facebook login
            $redirectUrl = Router::url(array('controller' => 'users', 'action' => 'login',$id,$contractData['Membership']['id']), true); //FULL_BASE_URL_MINE . 'users/add';
            $params = array(
                'scope' => 'user_about_me,user_activities,user_birthday,user_checkins,user_education_history,user_events,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_online_presence,user_photo_video_tags,user_photos,user_relationships,user_relationship_details,user_religion_politics,user_status,user_videos,user_website,user_work_history,email,read_friendlists,read_insights,read_mailbox,read_requests,read_stream,xmpp_login,ads_management,create_event,manage_friendlists,manage_notifications,offline_access,publish_checkins,publish_stream,rsvp_event,sms,publish_actions,manage_pages',
                'redirect_uri' => $redirectUrl,
            );
            $this->viewData['fb_login'] = $facebook->getLoginUrl($params);
            
            //google +
            App::import('Vendor', 'Google', array('file' => 'Google/Client.php'));

            $client = new Google_Client();
            $client->setApplicationName("Contracts"); // Set your applicatio name
            $client->setScopes(array(
                'https://www.googleapis.com/auth/userinfo.email',
                'https://www.googleapis.com/auth/plus.me')); // set scope during user login
            $client->setClientId('553428428643-5ipj37ilts3vlrcmp9je0r2js1fhf6a3.apps.googleusercontent.com'); // paste the client id which you get from google API Console
            $client->setClientSecret('AsphQQbbi38YkvmbWu1p6fnz'); // set the client secret
            
            // google+ login
            $client->setRedirectUri('http://contracts.codebnb.me/users/login/'.$id.'/'.$contractData['Membership']['id']); // paste the redirect URI where you given in APi Console. You will get the Access Token here during login success
            $client->setDeveloperKey('semiotic-method-691'); // Developer key
            $plus = new Google_Service_Plus($client);
            $authUrl = $client->createAuthUrl();
            $this->viewData['login_authUrl'] = $authUrl;
            
            
            // google+ registration
            $client->setRedirectUri('http://contracts.codebnb.me/users/registration/'.$id.'/'.$contractData['Membership']['id']); // paste the redirect URI where you given in APi Console. You will get the Access Token here during login success
            $client->setDeveloperKey('semiotic-method-691'); // Developer key
            $plus = new Google_Service_Plus($client);
            $this->viewData['registration_authUrl'] = $client->createAuthUrl();
            
            
            if(isset($id) && ($id == $contractData['id'])){
                $this->set('contract_id',$id);
                $this->set('membership_id',$contractData['Membership']['id']);
            }else{
                $this->Session->setFlash(__( "Can't find contract in session"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                $this->redirect('/');
            }
        }else{
            $this->Session->setFlash(__( "Can't find contract in session"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            $this->redirect('/');
        }
    }

    public function get_document(){
        $this->CreatePDF->test5();
        //$this->CreatePDF->doc();die;
        $this->CreatePDF->index();die;
        $this->CreatePDF->test();
        $this->CreatePDF->convertToPdf();
        die;
    }
   
    
    public function test11(){
        var_dump($_POST);die;
    }
    
    public function validateHash(){
        $mode = Configure::read('mode');
                
        $this->viewData['mode'] = $mode;

        $hashSecretWord = 'tango'; //2Checkout Secret Word
        $hashSid =  Configure::read($mode.'.sid'); //2Checkout account number
        $hashTotal = '1.00'; //Sale total to validate against
        if ($this->request->data['demo'] == 'Y') {
            $order_number = 1;
        }else{
            $order_number = $this->request->data['order_number'];
        }
        $StringToHash = strtoupper(md5($hashSecretWord . $hashSid . $order_number . $hashTotal));
//        var_dump($this->request->data, 'request<br /> ');
        if($this->request->data['order_id'] && $this->request->data['contract_id']){
            $order_id = $this->request->data['order_id'];
            $contract_id = $this->request->data['contract_id'];
            $this->loadModel('Order');
            $order = $this->Order->find('first',array(
                'conditions' => array(
                    'Order.id' => $order_id
                ),
                'fields' => array(
                    'Order.*','Membership.*'
                ),
                'joins' => array(
                    array(
                        'alias' => 'Membership',
                        'table' => 'memberships',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Membership.id = Order.membership_id'
                        )
                    )
                ),
            ));
//            var_dump($order, 'ordder');
            if($order['Membership']['type'] == 'package'){
                $count = $order['Membership']['month_count'];
            }else{
                $count = 1;
            }
            if($order){
                if($this->Session->check('contract_'.$contract_id)){
                    $contract = $this->Session->read('contract_'.$contract_id);
                }else{
                    $contract['Order'] = $order['Order'];
                    $contract['id'] = $order['Order']['contract_id'];
                    $contract['Data'] = $order['Order']['data'];
                    $contract['log_id'] = $order['Order']['log_id'];
                }

                if($order['Order']["paid"] == TRUE){
                    $this->Session->setFlash(__( "This order was already paid!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                    $this->redirect('/contracts/review_finalize/'.$order_id);
                }

                if ($StringToHash != $this->request->data['key']) {
                    $this->Session->setFlash(__( "Payment error.Hash Mismatch!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                    $this->redirect('/contracts/pay_contract/'.$order_id.'/'.$contract_id);
                } else {
                    $this->loadModel('Transaction');

                    $transaction = array(
                        'user_id' => $this->u_id,
                        'order_id' => $order_id,
                        'paymentstatus' => 'paid',
                        'type' => '2checkout',
                        'transactionId' => $this->request->data["key"],
                        'transactionData' => json_encode($this->request->data),
                        'transactionDate' => date("Y-m-d H:i:s")
                    );
                    $transactionSave = $this->Transaction->save($transaction);

                    $order = array(
                        'id' => $order_id,
                        'paid' => 1,
                        'finished' => 0,
                        'count' => $count
                    );

                    $save = $this->Order->save($order);
//                    var_dump($transaction, $save);die;
                    if($save){
                        if($contract['Order']['id'] == $save['Order']['id']){
                            $contract['Order']['paid'] = 1;
                            $this->Session->write('contract_'.$contract_id, $contract);
                        }
                        $this->redirect('/contracts/review_finalize/'.$order_id);
                    }else{
                        $this->Session->setFlash(__( 'error'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                        $this->redirect('/');
                    }
                }
            }else{
                $this->Session->setFlash(__( "Can't find order"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                $this->redirect('/');
            }
        }else{
            $this->Session->setFlash(__( "Can't find order or contract id!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            $this->redirect('/');
        }
    }
    
    public function deleteOrder($id = null){
        if($id){
            $this->loadModel('Order');
            $delete = $this->Order->delete($id);
            if($delete){
                $this->Session->setFlash(__("Order successfully deleted"), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
            }else{
                $this->Session->setFlash(__( "Some error iccured!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            }
        }else{
            $this->Session->setFlash(__( "Can't find order"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
        }
        $this->redirect('/pages/orders');
    }


    public function downloadInvoice($orderId = null){
        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        
        if($orderId){
            $this->loadModel('Order');
            $this->loadModel('MembershipContract');
            
            $order = $this->Order->find('first',array(
                'conditions' => array(
                    'Order.id' => $orderId
                ),
                'fields' => array('Order.*','Membership.*'),
                'joins' => array(
                    array(
                        'alias' => 'Membership',
                        'table' => 'memberships',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Membership.id = Order.membership_id'
                        )
                    )
                ),
            ));
            //var_dump($order);die;
            $data = array();
            if($order['Order']['membership_id']){
                $condition = array(
                    'MembershipContract.membership_id' => $order['Order']['membership_id']
                );
            }else{
                $condition = array(
                    'Contract.id' => $order['Order']['contract_id'],
                    'Membership.type' => 'individual'
                );
            }
            $contracts = $this->MembershipContract->find('all',array(
                'conditions' => $condition,
                'fields' => array(
                    'Contract.name',
                    'Contract.description',
                    'Contract.price',
                    'Membership.type',
                    'Membership.month_price',
                    'Membership.individual_price'
                ),
                'joins' => array(
                    array(
                        'alias' => 'Membership',
                        'table' => 'memberships',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Membership.id = MembershipContract.membership_id'
                        )
                    ),
                    array(
                        'alias' => 'Contract',
                        'table' => 'contracts',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Contract.id = MembershipContract.contract_id'
                        )
                    )
                )
            ));
            if($contracts){
                foreach ($contracts as $key => $value) {
                    if($value['Membership']['type'] == 'package'){
                        $price = (int)$value['Membership']['month_price'];
                    }else{
                        $price = (int)$value['Membership']['individual_price'];
                    }
                    $data[$key]['name'] = $value['Contract']['description'];
                    $data[$key]['amount'] = (int)$value['Contract']['price'];
                }
                $this->viewData['data'] = $data;
                $this->viewData['price'] = $price;

                $this->render(); 
            }
        }else{
            $this->redirect('pages/orders');
        }
    }
    
    public function download_file($id) {
        if($id){
            $this->loadModel('Librarie');
            $librarie = $this->Librarie->findById($id);
            $path = "../webroot/system/library/" . $librarie['Librarie']['lib_file'];
            if (file_exists($path)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($path));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                header('Content-Length: ' . filesize($path));
                ob_clean();
                flush();
                readfile($path);
            }
        }
        $this->redirect($this->referer());
    }
    
    public function sendtomail(){
        if($this->request->data){
            if($this->request->data['Contract']['order_id'] && $this->request->data['Contract']['email']){
                if(filter_var($this->request->data['Contract']['email'], FILTER_VALIDATE_EMAIL)) {
                    // valid address
                    $this->loadModel('Order');
                    $order = $this->Order->findById($this->request->data['Contract']['order_id']);
                    //var_dump($order["Order"]["pdf"]);
                    //var_dump(file_exists('system/print_documents/'.$order["Order"]["pdf"]));die;
                    if($order["Order"]["pdf"] && file_exists('system/print_documents/'.$order["Order"]["pdf"])){
                        $this->Mailer->SendDocument(array(
                            'email' => $this->request->data['Contract']['email'],
                            'file' => $order["Order"]["pdf"]
                        ));
                    }else{
                        //$this->download($order["Order"]["id"],1);
                        $this->Session->setFlash(__( "Can't find pdf file!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                    }
                }
                else {
                    $this->Session->setFlash(__( "Invalid email address!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                }
            }
        }
        $this->redirect('/pages/completed_orders');
        
    }
    
    public function test(){
        var_dump(json_decode('{"middle_initial":"","li_0_name":"Monthly Subscription","sid":"901256349","contract_id":"38","key":"F0B306383639AB88BF77C265E67831C7","state":"dfgdfgh","email":"shahen1988@list.ru","li_0_type":"product","li_0_duration":"Forever","order_number":"9093719027964","currency_code":"USD","lang":"en","invoice_id":"9093719027973","li_0_price":"1.00","total":"1.00","credit_card_processed":"Y","zip":"1234","li_0_quantity":"1","fixed":"Y","cart_weight":"0","submit":"Checkout","last_name":"Shopper","street_address":"dfgh","li_0_product_id":"","city":"dfgfgh","li_0_tangible":"","merchant_order_id":"","li_0_description":"","country":"AUS","ip_country":"United States","demo":"Y","pay_method":"CC","order_id":"194","cart_tangible":"N","phone":" ","li_0_recurrence":"1 Month","x_receipt_link_url":"http:\/\/contracts.dev\/contracts\/test1","street_address2":"","card_holder_name":"Checkout Shopper","first_name":"Checkout"}'));die;
    }
}
