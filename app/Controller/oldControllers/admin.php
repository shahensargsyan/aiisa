<?php

class AdminsController extends AppController {

    public $components = array('FileUploader');
    public $name = 'Admins';
    public $uses = array(
        'Admin'
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'admin';
        if ($this->Session->check('Admin.id')) {
            $this->viewData['admin_id'] = $this->Session->read('Admin.id');
        }
        $this->viewData['active_menu'] = $this->action;
        //var_dump($this->action);die;
        if($this->action != 'login' || $this->action != 'save_form'){
            
        }else{
            $this->Auth->getAdmin();
        }
    }
    

    public function index() {
        
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

    public function all_contract() {
        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'Contract.created DESC'
        );
        $data = $this->Paginator->paginate('Contract');
        $this->set('data', $data);
        $featured_contracts = $this->Contract->find('all', array(
            'conditions' => array(
                'featured' => true
            ),
            'fields' => array(
                'name', 'file', 'id', 'featured', 'contract_image'
            )
                ));
        $count = count($featured_contracts);
        $this->set('count', $count);
        $this->set('contracts', $featured_contracts);
    }

    public function add_contract_featured($id) {
        $featured_contracts = $this->Contract->find('all', array(
            'conditions' => array(
                'featured' => true
                )));
        $count = count($featured_contracts);
        if ($count >= 5) {
            $this->redirect($this->referer());
        } else {
            $this->Contract->id = $id;
            $data['Contract']['featured'] = true;
            $this->Contract->save($data);
            $this->redirect($this->referer());
        }
    }

    public function delete_featured_contract($id) {
        $this->Contract->id = $id;
        $data['Contract']['featured'] = FALSE;
        $this->Contract->save($data);
        $this->redirect($this->referer());
    }

    public function add_contract() {
        if (!empty($this->request->data)) {
            $data = $this->request->data;

            $category_id = $data['Contract']['category_id'];
//            if (empty($category_id)) {
//                $errors = 'you must select the contract';
//                $this->set('error', $errors);
//                
//            }
            $data['Contract']['highlights'] = $data["Contract"]["tag"];
            unset($data['Contract']['category_id']);
            unset($data['Contract']['tag']);
            unset($data['Contract']['tagValue']);
            $this->Contract->set($data);
            if (!$this->Contract->validates()) {
                $errors = reset($this->Contract->validationErrors);
                $this->set('error', reset($errors));
            }
            $this->Contract->create();
            $chek_save = $this->Contract->save($data);
            $contract = $this->Contract->find('first', array(
                'order' => 'id DESC',
                'fields' => array('id')
                    ));
            if (!empty($category_id)) {
                $contract_id = $contract['Contract']['id'];
                $data_id = $this->ContractCategorie->category($category_id, $contract_id);
                $this->ContractCategorie->create();
                $chek = $this->ContractCategorie->saveAll($data_id);
            }
            if (isset($chek_save)) {
                $this->redirect(array('controller' => 'admins', 'action' => 'all_contract'));
            }
        }
        $data = $this->Category->find('all', array(
            'fields' => array('id', 'name')
                ));
        $this->set('data', $data);
        $contract = $this->Contract->find('first', array(
            'order' => 'id DESC'
                ));
        $this->set('contract_id', $contract['Contract']['id'] + 1);
    }

    public function edit_contract($id) {
        $this->set('contract_id', $id);
        $data = $this->Category->find('all', array(
            'fields' => array('id', 'name'),
            'group' => 'id'
                ));
        $this->set('data', $data);
        $contractData = $this->Contract->findById($id);
        $this->viewData['contractData'] = $contractData;
        $data_categories = $this->ContractCategorie->find('all', array(
            'conditions' => array(
                'ContractCategorie.contract_id' => $id
            ),
            'fields' => array('ContractCategorie.category_id'),
                ));
        foreach ($data_categories as $category) {
            $contractData['Contract']['category_id'][] = $category['ContractCategorie']['category_id'];
        }
        if (isset($this->request->data['Contract']) && $this->request->data['Contract']) {
            $data = $this->request->data;
            $category_id = $data['Contract']['category_id'];
            $data['Contract']['highlights'] = $data['Contract']['tag'];
            unset($data['Contract']['category_id']);
            unset($data['Contract']['tag']);
            unset($data['Contract']['tagValue']);
            $old_file = $this->Contract->find('first', array(
                'conditions' => array('Contract.id' => $id),
                'fields' => array('file', 'contract_image', 'document')
            ));
            $file = $old_file['Contract']['file'];
            $contract_image = $old_file['Contract']['contract_image'];
            $document = $old_file['Contract']['document'];
            $this->Contract->set($data);
            if (!$this->Contract->validates()) {
                $errors = reset($this->Contract->validationErrors);
                $this->set('error', reset($errors));
                $this->request->data = $contractData;
                return;
            }
            if (!empty($data['Contract']['file'])) {
                if(!empty($file)){
                    $path_file = 'system/contracts/' . $file;
                    @unlink($path_file);
                }
                
            }else{
                $data['Contract']['file'] = $file;
            }
            if (!empty($data['Contract']['contract_image'])) {
                if(!empty($contract_image)){
                    $path_file = 'system/contracts/' . $contract_image;
                    @unlink($path_file);
                }
                $oldName = $data['Contract']['contract_image'];
                $ext = pathinfo('system/contracts/'.$oldName, PATHINFO_EXTENSION);
                $data['Contract']['contract_image'] = preg_replace('/\s+/', '_', strtolower($data['Contract']['name'])).'.'.$ext;
                rename('system/contracts/'.$oldName , 'system/contracts/'.preg_replace('/\s+/', '_', strtolower($data['Contract']['name'])).'.'.$ext);
                
            }else{
                $data['Contract']['contract_image'] = $contract_image;
            }
            if (!empty($data['Contract']['document'])) {
                if(!empty($document)){
                    $path_file = 'system/documents/' . $document;
                    unlink($path_file);
                }
            }else{
                $data['Contract']['document'] = $document;
            }
            $this->Contract->id = $id;
            $bool = $this->Contract->save($data);
            $condition = array('ContractCategorie.contract_id' => $id);
            $this->ContractCategorie->deleteAll($condition, false);
            if (!empty($category_id)) {
                $data_id = $this->ContractCategorie->category($category_id, $id);
                $this->ContractCategorie->create();
                $this->ContractCategorie->saveAll($data_id);
            }

            if ($bool) {
                $this->redirect(array('controller' => 'admins', 'action' => 'all_contract'));
            }
        }
        $this->request->data = $contractData;
        $this->set('contract_id', $contractData['Contract']['id']);
    }

    public function delete_contract($id) {
        $contract = $this->Contract->findById($id);
        if ($contract['Contract']['file']) {
            $file = 'system/contracts/' . $contract['Contract']['file'];
            $image = 'system/contracts/' . $contract['Contract']['contract_image'];
            $document = 'system/documents' . $contract['Contract']['document'];
            @unlink($file);
            @unlink($image);
            @unlink($document);
        }
        $this->Contract->delete($id);
        $condition = array('ContractCategorie.contract_id' => $id);
        $this->ContractCategorie->deleteAll($condition, false);
        $this->redirect(array('controller' => 'admins', 'action' => 'all_contract'));
    }

    public function all_forms() {
        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'id DESC',
        );
        $data = $this->Paginator->paginate('FormId');
        $this->set('data', $data);
    }

    public function add_form_id() {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->FormId->set($data);
            if (!$this->FormId->validates()) {
                $errors = reset($this->FormId->validationErrors);
                $this->set('error',reset($errors));
                return;
            }            
            if($this->FormId->chekFormId($data['FormId']['form_id'])){
                $error = 'Please supply a valid FormId';
                $this->set('error',$error);
                return;
            }
            $this->FormId->create();
            $chek_save = $this->FormId->save($data);
            if ($chek_save) {
                $this->redirect(array('controller' => 'admins', 'action' => 'all_forms'));
            }
        }
    }

    public function edit_form($id) {
        if (empty($this->request->data)) {
            $this->request->data = $this->FormId->findById($id);
        } else {
            $this->FormId->id = $id;
            $data = $this->request->data;
            $this->FormId->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'all_forms'));
        }
    }

    
    
    public function reorder_form(){
        
        $tatus = FALSE;
        if($this->request->data){
            $data = $this->request->data;
            $this->loadModel('Contract');
            $contract = $this->Contract->findById($data['contract_id']);
            if($contract){
                $form = json_decode($contract['Contract']['form'],true);
                $step = $data['stepId'];
                $array = array();
                foreach ($form[$step]["data"] as $key => $value) {
                    $array[$value["form_id"]] = $value;
                }
                $sortedArray = array();
                foreach ($data["forms"] as $key => $value) {
                    $sortedArray[$key] = $array[$value];
                }
                
                $form[$step]["data"] = $sortedArray;
                $save = $this->Contract->save(array(
                    'id' => $data['contract_id'],
                    'form' => json_encode($form)
                ));
                if($save){
                    $tatus = TRUE;
                    $message = __("Form succsessull reordered");
                }else{
                    $message = __("Can't save contract");
                }
            }else{
                $message = __("Can't find contract");
            }
        }else{
            $message = __("Can't find data");
        }
        $this->_sendResponse($tatus, $message, array());
    }

    public function SummaryPage($model = null, $date = null) {
        if (isset($model) && isset($date)) {
            $this->set('model', $model);
            if ($model == 'User') {
                $fields = array('first_name', 'last_name', 'email');
            } elseif ($model == 'EmailSubscription') {
                $fields = array('email');
            }
            if($model != 'Order'){
                $data_model = $this->$model->find('all', array(
                    'conditions' => array(
                        'created LIKE' => "$date%"
                    ),
                    'fields' => $fields
                        ));
                $this->set('data_model', $data_model);
            }else{
                $this->Paginator->settings = array(
                   'joins' => array(
                       array(
                           'alias' => 'User',
                           'table' => 'users',
                           'type' => 'LEFT',
                           'conditions' => array(
                               'User.id = Order.user_id'
                           ),
                       ),
                       array(
                           'alias' => 'Contract',
                           'table' => 'contracts',
                           'type' => 'LEFT',
                           'conditions' => array(
                               'Contract.id = Order.contract_id'
                           ),
                       ),                    
                   ),
                   'conditions' => array(
                       'Order.created LIKE' => "$date%",
                   ),
                   'limit' => 10,
                   'fields' => array(
                       'User.first_name','User.last_name','User.email',
                       'Contract.name'
                   )
               );
               $data_model = $this->Paginator->paginate('Order');
               $this->set('data_model', $data_model);
            }
        } else {
            $date = date('Y-m');
            $this->set('data_month', $date);
            $user_data = $this->User->find('all', array(
                'conditions' => array(
                    'created LIKE' => "$date%",
                ),
                'fields' => array('id', 'first_name', 'last_name', 'created')
                    ));
            $this->set('user_data', $user_data);
            $date = date('Y-m-d');
            $this->set('data_todey', $date);
            $count = 0;
            foreach ($user_data as $data) {
                $date_todey = explode(' ', $data['User']['created']);
                if ($date_todey [0] == $date) {
                    $count++;
                }
            }
            $this->set('data_count', $count);
            $date = date('Y-m-d');
            $email_subscription = $this->EmailSubscription->find('all', array(
                'conditions' => array(
                    'created LIKE' => "$date%",
                ),
                    ));
            $this->set('email_subscription', $email_subscription);
            $contract_data = $this->Order->find('all', array(
                'conditions' => array(
                    'created LIKE' => "$date%",
                ),
                'fields' => array('id', 'created')
                    ));
            $this->set('contract_data', $contract_data);
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
                $this->redirect(array('controller' => 'admins', 'action' => 'SummaryPage'));
            }
        }
    }

    
     public function export_file1($model = null,$action = null){
        if(!empty($this->request->data)){
            $data = $this->request->data;
            $action = reset($data);
            $model = reset(array_keys($data,reset($data)));
            unset($data[$model]);
            if(isset($data['delete'])){//delete select data
                unset($data['delete']);
                $conditions = array('id' => $data);
                $this->$model->deleteAll($conditions, false);
                $this->redirect(array('controller'=>'admins','action' => $action));
            }
        }
        if(isset($model)){
            if($model == 'Transaction'){
                $this->redirect(array('controller'=>'admins','action' => $action ,$action));
            }
            $dir = dirname(__FILE__);
            $file = fopen($dir . "/../../vendors/userdata/user.csv", "w");
            $data = $this->$model->find('all',array(
//                'order' => array('created DESC'),
                'conditions' => array(
                    'id' => $data
                )
            ));
            switch ($model) {
                case 'User':
                    $fields = array('id','First Name','Last Name','Email','Address','Siti','State','Country','Phone Number','postal','Active','Token','Created','Modified','Ip Address');
                    break;
                case 'BlockedIp':
                    $fields = array('id','User Ip','Reason','Created','Modified');
                    break;
                case 'BlockedEmail':
                    $fields = array('id','User email','Reason','Created','Modified');
                    break;
                case 'EmailSubscription':
                    $fields = array('id','User email','Created','Modified');
                    break;
                case 'Logs':
                    $fields = array('');
                    break;
                case 'Transaction':
                    $fields = array('');
                    break;
                break;
            }
            if(isset($fields)){
                fputcsv($file,$fields);          
                foreach ($data as $user){
                    fputcsv($file,$user[$model]);
                }
            }
            fclose($file);
            $this->redirect(array('controller' => 'admins','action' =>'download_filecsv',$action));
        }
    }
    
    public function export_file($model = null,$action = null){
        if(!empty($this->request->data)){
            $data = $this->request->data;
            $action = reset($data);
            $model = reset(array_keys($data,reset($data)));
            unset($data[$model]);
            if(isset($data['delete'])){//delete select data
                unset($data['delete']);
                $conditions = array('id' => $data);
                $this->$model->deleteAll($conditions, false);
                $this->redirect(array('controller'=>'admins','action' => $action));
            }
        }
        
        if(isset($model)){
            if($model == 'Transaction'){
                $this->redirect(array('controller'=>'admins','action' => $action ,$action));
            }
            $dir = dirname(__FILE__);
            $file = fopen($dir . "/../../vendors/userdata/user.csv", "w");

            switch ($model) {
                case 'User':
                    $fields = array('id','First Name','Last Name','Email','Address','Siti','State','Country','Phone Number','postal','Active','Token','Created','Modified','Ip Address');
                    break;
                case 'BlockedIp':
                    $fields = array('id','User Ip','Reason','Created','Modified');
                    break;
                case 'BlockedEmail':
                    $fields = array('id','User email','Reason','Created','Modified');
                    break;
                case 'EmailSubscription':
                    $fields = array('id','User email','created','modified');
                    break;
                case 'Log':
                    $fields = array('id','email','type','created','modified');
                    break;
                case 'Transaction':
                    $fields = array('');
                    break;
                case 'Order':
                    $fields = array('id','contract_id','membership_id','paid','finished','Created','Modified');
                    break;
                case 'Contact':
                    $fields = array('id','first_name','email','subject','phone_number','text','created','modified');
                    break;
                default :
                break;
            }
            
            foreach ($data as $key => $value) {
                if(!$value)
                    unset ($data[$key]);
            }
            //var_dump($data);die;
            $export_data = $this->$model->find('all',array(
                'conditions' => array(
                    'id' => $data
                ),
                'fields' => $fields
            ));
            //var_dump($export_data);die;
            if(isset($fields)){
                fputcsv($file,$fields);          
                foreach ($export_data as $user){
                    //var_dump($user[$model]);
                    fputcsv($file,$user[$model]);
                }
            }
            fclose($file);
            $this->redirect(array('controller' => 'admins','action' =>'download_filecsv',$action));
        }
    }
    
    public function download_filecsv($action = null){
        $path = dirname(__FILE__) . "/../../vendors/userdata/user.csv";
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
        $this->redirect(array('controller' => 'admins','action' => $action));
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

    

    public function delete_image($id) {
        $is_data = $this->User->findById($id);
        if ($is_data) {
            $image = WWW_ROOT . 'system/users/' . $is_data['User']['image'];
            unlink($image);
            $this->User->id = $id;
            $data['User']['image'] = 'noImage.png';
            $this->User->save($data);
        }
        $this->redirect($this->referer());
    }

    public function orders($all = null) {
        $this->viewData['all'] = $all;
        if($all){
             $data = $this->Order->find('all',array(
                'joins' => array(
                    array(
                        'alias' => 'User',
                        'table' => 'users',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'User.id = Order.user_id')
                    ),
                    array(
                        'alias' => 'Contract',
                        'table' => 'contracts',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Contract.id = Order.contract_id'
                        )
                    )
                ),
                'fields' => array(
                    'User.first_name',
                    'User.last_name',
                    'User.email',
                    'Contract.name',
                    'Contract.file',
                    'Order.paid',
                    'Order.finished',
                    'Order.id'
                ),
                'conditions' => array('Order.user_id = User.id'),
            ));
        }else{
            $this->Paginator->settings = array(
                'joins' => array(
                    array(
                        'alias' => 'User',
                        'table' => 'users',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'User.id = Order.user_id')
                    ),
                    array(
                        'alias' => 'Contract',
                        'table' => 'contracts',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Contract.id = Order.contract_id'
                        )
                    )
                ),
                'fields' => array(
                    'User.first_name',
                    'User.last_name',
                    'User.email',
                    'Contract.name',
                    'Contract.file',
                    'Order.paid',
                    'Order.finished',
                    'Order.id'
                ),
                'conditions' => array('Order.user_id = User.id'),
                'limit' => 10
            );
            $data = $this->Paginator->paginate('Order');
        }
        $this->set('data', $data);
    }

    public function edit_order($id) {
        if (empty($this->request->data)) {
            $this->request->data = $this->Transaction->find('first', array(
                'conditions' => array(
                    'Transaction.order_id' => $id
                )
            ));
            
            $order = $this->Order->findById($id);
            if($order['Order']['finished']){
                $this->request->data["Transaction"]['finished'] = 1;
            }else{
                $this->request->data["Transaction"]['finished'] = 0;
            }
        } else {
            $data = $this->request->data;
            $this->Order->id = $id;
            if ($data['Transaction']['paymentstatus'] == 'paid') {
                $order['Order']['paid'] = 1;
            } else {
                $order['Order']['paid'] = 0;
            }
            $order = $this->Order->findById($id);
            if($order['Order']['finished'] == 1 && $data['Transaction']['finished'] == 0){
                $order['Order']['count'] = 1;
            }
            $order['Order']['finished'] = $data['Transaction']['finished'];
            
            $this->Order->save($order);
            $transaction = $this->Transaction->find('first', array(
                'conditions' => array(
                    'Transaction.order_id' => $id
                ),
                'fields' => array('Transaction.id')
            ));
            if (!empty($transaction)) {
                $this->Transaction->id = $transaction['Transaction']['id'];
                $paymentstatus['Transaction']['paymentstatus'] = $data['Transaction']['paymentstatus'];
                $this->Transaction->save($paymentstatus);
            }
            $this->redirect(array('controller' => 'admins', 'action' => 'orders'));
        }
    }

    public function slider() {
        $slider = $this->SiteImage->find(
                'all', array(
            'conditions' => array(
                'type' => "slider"
            ),
            'order' => array('order' => 'ASC'),
                )
        );
        $this->viewData['slider'] = $slider;
    }

    public function categories() {
        $this->paginate = array(
            'conditions' => array(
                'parent_id' => null,
            ),
            'limit' => 10,
            'order' => array('created' => 'Desc'),
        );
        $data = $this->paginate('Category');
        $this->viewData['data'] = $data;
    }

    public function addCategory() {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->Category->set($data);
            if (!$this->Category->validates()) {
                $errors = reset($this->Category->validationErrors);
                $this->set('error', reset($errors));
                return;
            }
            $this->Category->create();
            $this->Category->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'categories'));
        }

//        if ($this->request->is('post')) {
//            try {
//                if (empty($this->request->data))
//                    throw new Exception('Data is empty');
//                $data = $this->request->data;
//                $savedData = $this->Category->save($data);
//                if ($savedData) {
//                    $this->Session->write('Note.ok', 'The category was added');
//                    $this->redirect(array('controller' => 'admins', 'action' => 'categories'));
//                } else {
//                    $this->Session->write('Note.error', 'Unable to save your data , please try again later');
//                }
//            } catch (Exception $e) {
//                $this->Session->write('Note.error', $e->getMessage());
//            }
//        }
    }

    public function editCategory($id = NULL) {
        $data = $this->Category->findById($id);
        if (!$data)
            $this->redirect('/admins/categories');

        if (!empty($this->request->data)) {
            try {
                $data = $this->request->data;
                $this->Category->id = $id;

                $category = $this->Category->find('first', array('conditions' => array('id' => $id)));
//                $oldimage = $category['Category']['image'];

                if ($this->Category->save($data)) {
                    $this->Session->write('Note.ok', 'The category has been updated.');
//                    if($data['Category']['image'] != $oldimage && file_exists(WWW_ROOT . 'system/site/' . $oldimage)){
//                        $file = WWW_ROOT . 'system/site/' . $oldimage;
//                        unlink($file);
//                    }
                } else {
                    $this->Session->write('Note.error', 'Unable to save changes.');
                }//////redirect
                $this->redirect(array('controller' => 'admins', 'action' => 'categories'));
            } catch (Exception $e) {
                $this->Session->write('Note.error', $e->getMessage());
            }
        }
        if (!$this->request->data) {
            $this->request->data['Category'] = $data['Category'];
            $this->viewData['Category'] = $data['Category'];
        }
    }

    public function subcategories() {
        $this->paginate = array(
            'conditions' => array(
                'parent_id !=' => null,
            ),
            'limit' => 10,
            'order' => array('Category.created' => 'Desc'),
        );
        $data = $this->paginate('Category');
        $this->viewData['data'] = $data;
    }

    public function addSubcategory() {
        $allcategories = $this->Category->find(
                'all', array(
            'conditions' => array(
                'parent_id' => null,
            ),
            'order' => array('Category.name' => 'ASC'),
                )
        );
        $category[] = "Choose category";
        foreach ($allcategories as $data) {
            $category[$data['Category']['id']] = $data['Category']['name'];
        }
        $this->viewData['category'] = $category;
        if ($this->request->is('post')) {
            try {
                if (empty($this->request->data))
                    throw new Exception('Data is empty');
                $data = $this->request->data;
                $savedData = $this->Category->save($data);
                if ($savedData) {
                    $this->Session->write('Note.ok', 'The subcategory was added');
                    $this->redirect(array('controller' => 'admins', 'action' => 'subcategories'));
                } else {
                    $this->Session->write('Note.error', 'Unable to save your data , please try again later');
                }
            } catch (Exception $e) {
                $this->Session->write('Note.error', $e->getMessage());
            }
        }
    }

    public function editSubcategory($id = NULL) {
        $allcategories = $this->Category->find(
                'all', array(
            'conditions' => array(
                'parent_id' => null,
            ),
            'order' => array('Category.name' => 'ASC'),
                )
        );
        foreach ($allcategories as $data) {
            $category[$data['Category']['id']] = $data['Category']['name'];
        }
        $this->viewData['category'] = $category;

        $data = $this->Category->findById($id);
        if (!$data)
            $this->redirect('/admins/categories');

        if (!empty($this->request->data)) {
            try {
                $data = $this->request->data;
                $category = $this->Category->find('first', array('conditions' => array('id' => $id)));
//                $oldimage = $category['Category']['image'];
                $this->Category->id = $id;
                if ($this->Category->save($data)) {
                    $this->Session->write('Note.ok', 'The subcategory has been updated.');
//                    if($data['Category']['image'] != $oldimage && file_exists(WWW_ROOT . 'system/site/' . $oldimage)){
//                        $file = WWW_ROOT . 'system/site/' . $oldimage;
//                        unlink($file);
//                    }
                } else {
                    $this->Session->write('Note.error', 'Unable to save changes.');
                }//////redirect
                $this->redirect(array('controller' => 'admins', 'action' => 'subcategories'));
            } catch (Exception $e) {
                $this->Session->write('Note.error', $e->getMessage());
            }
        }
        if (!$this->request->data) {
            $this->request->data['Category'] = $data['Category'];
            $this->viewData['Category'] = $data['Category'];
        }
    }

    public function noCategory() {
        $this->paginate = array(
            'conditions' => array(
            ),
            'order' => array('Postcard.id' => 'ASC'),
            'limit' => 10
        );
        $data = $this->paginate('Postcard');
        $this->viewData['data'] = $data;
    }

    public function getSubcategory() {
        if ($this->request->is('post')) {
            $subcategory = $this->Category->find(
                    'all', array(
                'conditions' => array(
                    'parent_id' => $_POST['categoryId']
                ),
                'order' => array('Category.name' => 'ASC'),
                    )
            );
            $this->_sendResponse(true, '', $subcategory);
        }
    }

    public function blocked() {
        if (!empty($this->request->data)) {
            $block_data = $this->request->data;
            if (trim($block_data['block']['blocked_params'])) {
                if ($block_data['block']['type'][0] == 'email') {
                    $data['BlockedEmail']['email_address'] = $this->request->data['block']['blocked_params'];
                    $data['BlockedEmail']['reason'] = $this->request->data['block']['reason'];
                    $this->BlockedEmail->set($data);
                    if (!$this->BlockedEmail->validates()) {
                        $errors = $this->BlockedEmail->validationErrors;
                        $this->set('errors', $errors['email_address'][0]);
                    }
                    $this->BlockedEmail->create();
                    $bool = $this->BlockedEmail->save($data);
                    if ($bool) {
                        $this->redirect(array('controller' => 'admins', 'action' => 'blockedEmails'));
                    }
                } elseif ($block_data['block']['type'][0] == 'ip') {
                    $data['BlockedIp']['ip_address'] = $this->request->data['block']['blocked_params'];
                    $data['BlockedIp']['reason'] = $this->request->data['block']['reason'];
                    $this->BlockedIp->set($data);
                    if (!$this->BlockedIp->validates()) {
                        $errors = $this->BlockedIp->validationErrors;
                        $this->set('errors', $errors['ip_address'][0]);
                    }
                    $this->BlockedIp->create();
                    $bool = $this->BlockedIp->save($data);
                    if ($bool) {
                        $this->redirect(array('controller' => 'admins', 'action' => 'blockedIp'));
                    }
                }
            } else {
                $this->redirect($this->referer());
            }
        }
    }

    public function blockedIp() {
        $this->paginate = array(
            'limit' => 10,
            'order'=>'FIELD(reason, "Wrong email\/password specified") DESC'
        );
        $data = $this->paginate('BlockedIp');
        $this->viewData['data'] = $data;
    }

    public function blockedEmails() {
        $this->paginate = array(
            'limit' => 10,
            'order' => array('created' => 'Desc'),
        );
        $data = $this->paginate('BlockedEmail');
        $this->viewData['data'] = $data;
    }

    public function memberships() {
        $this->paginate = array(
            'limit' => 10,
            'order' => array('created' => 'Desc'),
        );
        $data = $this->paginate('Membership');
        $this->viewData['data'] = $data;
    }

    public function addMembership() {
        $contracts = $this->Contract->find('all', array(
            'fields' => array('Contract.id', 'Contract.name')
                ));
        $this->set('contracts', $contracts);
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $data['Membership']['description'] = $data['description'];
            unset($data['description']);
            $contract_id = $data['Membership']['contract_id'];
            unset($data['Membership']['contract_id']);
            $this->Membership->set($data);
            if (!$this->Membership->validates()) {
                $error = reset($this->Membership->validationErrors);
                $this->set('error', reset($error));
                return;
            }
            $chek = $this->Membership->create();
            $this->Membership->save($data);
            if (!empty($contract_id)) {
                $membership_id = $this->Membership->id;
                $data_id = $this->MembershipContract->contract($contract_id, $membership_id);
                $this->MembershipContract->create();
                $this->MembershipContract->saveAll($data_id);
            }
            if ($chek) {
                $this->redirect(array('controller' => 'admins', 'action' => 'memberships'));
            }
        }
    }

    public function editMembership($id = NULL) {
        $data = $this->Membership->findById($id);
        if (!$data)
            $this->redirect('/admins/blocked');
        $contracts = $this->Contract->find('all', array(
            'joins' => array(
                array(
                    'alias' => 'MembershipContract',
                    'table' => 'membership_contracts',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'MembershipContract.contract_id = Contract.id'
                    )
                )
            ),
            'fields' => array('Contract.id', 'Contract.name', 'MembershipContract.membership_id'),
        ));

        $this->set('contracts', $contracts);

        if (!empty($this->request->data)) {
            $data = $this->request->data;
            if ($data['Membership']['type'] == 'individual') {
                $data['Membership']['month_price'] = null;
                $data['Membership']['month_count'] = null;
            }
            if ($data['Membership']['type'] == 'package') {
                $data['Membership']['individual_price'] = null;
            }
            $this->Membership->id = $id;

            $this->Membership->set($data);
            if (!$this->Membership->validates()) {
                $error = reset($this->Membership->validationErrors);
                $this->set('error', reset($error));
            }
            $chek = $this->Membership->save($data);
            if ($data['Membership']['contract_id']) {
                $contract_id = $data['Membership']['contract_id'];
                $condition = array('MembershipContract.membership_id' => $id);
                $this->MembershipContract->deleteAll($condition, false);
                $data_id = $this->MembershipContract->contract($contract_id, $id);
                $this->MembershipContract->id = $id;
                $this->MembershipContract->saveAll($data_id);
            }
            if ($chek) {
                $this->redirect(array('controller' => 'admins', 'action' => 'memberships'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $data;
            $contract_id = array();
            foreach ($contracts as $contract) {
                if ($contract['MembershipContract']['membership_id'] == $id) {
                    $contract_id[] = $contract['Contract']['id'];
                }
            }
            $this->request->data['Membership']['contract_id'] = $contract_id;
        }
    }

    public function deleteMembership($id) {
        $this->Membership->delete($id);
        $condition = array('MembershipContract.membership_id' => $id);
        $this->MembershipContract->deleteAll($condition, false);
        $this->redirect(array('controller' => 'admins', 'action' => 'memberships'));
    }

    public function payments() {
        $this->loadModel('Setting');
        $data = $this->Setting->find('all', array('conditions' => array('name' => array('paypal', '2checkout'))));
        $this->viewData['data'] = $data;
    }

    public function editSetting($name = null){
        try {
            $this->loadModel('Setting');
            if(!$name)
                throw new Exception('Wrong parameter');
            
            $data = $this->Setting->find('first', array('conditions' => array('name' => array($name))));
            
            if(!$data)
                throw new Exception('Wrong parameter');
            
            
            
            if($this->request->is('post')){
                $action = '_edit_'.$name;
                if (!method_exists($this, $action))
                    throw new Exception('Wrong parameter action');
                
                $data = $this->$action($data);
                $this->Session->setFlash(__('Changes Saved'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
            }
            $this->viewData['data'] = $data;
        } catch (Exception $ex) {
            $this->viewData['error'] = $ex->getMessage();
//            $this->Session->setFlash($ex->getMessage(), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
        }
        $this->render('settings/'.$name);
    }
    
    protected function _edit_paypal($old) {
        $data = $this->request->data['Paypal'];
        $required = array(
            'password','endpoint','webscr', 'signature', 'email'
        );
        $this->_validateInputData($required, $data);
        $old['Setting']['data'] = json_encode($data);
        unset($old['Setting']['modified']);
        return $this->Setting->save($old);
    }
    
    protected function _edit_2checkout($old) {
        $data = $this->request->data['2checkout'];
        $required = array(
            'sid','token'
        );
        $this->_validateInputData($required, $data);
        $old['Setting']['data'] = json_encode($data);
        unset($old['Setting']['modified']);
        return $this->Setting->save($old);
    }
    
    protected function _edit_social($old) {
        $data = $this->request->data['Social'];
        $required = array(
            'facebook', 'twitter', 'linked_in', 'google_plus'
        );
        $this->_validateInputData($required, $data);
        $old['Setting']['data'] = json_encode($data);
        unset($old['Setting']['modified']);
        return $this->Setting->save($old);
    }
    
    protected function _edit_trust($old) {
        $data = $this->request->data['Trust'];
        $required = array(
            'url','width', 'height'
        );
        $this->_validateInputData($required, $data);
        
        if($this->request->data['Trust']['image_name']){
            $decoded = json_encode($old['Setting']['data'],true);
            @unlink(WWW_ROOT . "system/trust/{$decoded['image_name']}");
        }else{
            $data['Trust']['image_name'] = $img_name['Trust']['image_name'];
        }
            
        $old['Setting']['data'] = json_encode($data);
        unset($old['Setting']['modified']);
        return $this->Setting->save($old);
    }

    public function SocialSettings() {
        $this->loadModel('Setting');
        $data = $this->Setting->find('all', array('conditions' => array('name' => array('trust', 'social'))));
        $this->viewData['data'] = $data;
    }
    
    public function Info($activity = null,$position = null){
        if(isset($activity) && isset($position)){
            $info['Info'][$position] = $activity;
            $this->Info->id = 1;
            $this->Info->save($info);
        }
        $data = $this->Info->find('first');
        $this->set('data', $data);
    }
    
    public function IndividualDay() {
        $data = $this->IndividualDay->find('first');
        $this->set('data', $data);
    }

    public function EditIndividualDay($type = null) {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->IndividualDay->id = 1;
            $this->IndividualDay->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'IndividualDay'));
        }else
            if(isset($type)){
                if($type == 'Day'){
                    $this->set('input_name','day');
                }elseif($type == 'Finished'){
                    $this->set('input_name','finished_document');
                }elseif($type == 'Unfinished'){
                     $this->set('input_name','unfinished_document');
                }
            }
            $this->request->data = $this->IndividualDay->findById(1);
    }
    
    public function logs($type = null,$order_type = null,$all = null){
        $order = 'created DESC';
        if(isset($type)){
            switch ($type) {
                case 'email':
                    $order = "email $order_type";
                    break;
                case 'ip':
                   $order = "user_ip $order_type";
                    break;
                case 'status':
                     $order = "subscription_type $order_type";
                    break;
                case 'created':
                     $order = "created $order_type";
                    break;
                default:
                    return;
                    break;
            }
            $this->set('order_type',$order_type);
        }
        if(isset($all) && $all == 'all'){
            
            $data = $this->Log->find('all',array(
                 'order' => $order
            ));
            $this->set('data', $data);
        }else{
            $this->Paginator->settings = array(
                'limit' => 50,
                'order' => $order
            );
            $data = $this->Paginator->paginate('Log');
            $this->set('data', $data);
        }
        $this->set('all',$all);
    }
    
    public function TransactionLogs($export = null){
        $transaction_date = $this->Paginator->settings = array(
            'joins' => array(
                array(
                    'alias' => 'User',
                    'table' => 'users',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'User.id = Transaction.user_id'
                    ),
                ),
                array(
                    'alias' => 'Order',
                    'table' => 'orders',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Order.id = Transaction.order_id'
                    ),
                ),
                array(
                    'alias' => 'Contract',
                    'table' => 'contracts',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Contract.id = Order.contract_id'
                    ),
                ),                  
            ),
            'group' => array('Transaction.id'),
            'limit' => 10,
            'order' => 'Transaction.transactionDate DESC',
            'fields' => array(
                'User.email','Contract.name','User.id',
                'Transaction.transactionId', 'Transaction.type', 'Transaction.transactionDate',
                'Transaction.paymentstatus','Transaction.id','Transaction.created'
            )
        );
                
        $data = $this->Paginator->paginate('Transaction');
        $this->set('data',$data);
        if($export){
            $dir = dirname(__FILE__);
            $file = fopen($dir . "/../../vendors/userdata/user.csv", "w");
            $fields = array('Email','Contract Title','Transaction Id','Type','Payment Status','Transaction Date');
            fputcsv($file,$fields);          
            foreach ($data as $user){
                $logs = array($user['User']['email'],$user['Contract']['name'],$user['Transaction']['transactionId'],
                    $user['Transaction']['type'],$user['Transaction']['paymentstatus'],$user['Transaction']['transactionDate']);
                fputcsv($file,$logs);
            }
            fclose($file);
            $this->redirect(array('controller' => 'admins','action' =>'download_filecsv','TransactionLogs'));
        }
    }

    public function Chat($active = null){
        $chat = $this->Chat->find('first');
        $this->set('data',$chat);
        if(isset($active)){
            $this->Chat->id = 1;
            $data['Chat']['active'] = $active;
            $this->Chat->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'Chat'));
        }
    }

    public function languages() {
        $this->Paginator->settings = array(
            'limit' => 5,
            'order' => 'Language.id DESC'
        );
        $data = $this->Paginator->paginate('Language');
        $this->set('data', $data);
    }

    public function add_language() {
        $this->scripts_for_layout_include[] = 'jquery.validate.min';
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->Language->create();
            $this->Language->save($data);

            $this->redirect(array('controller' => 'admins', 'action' => 'languages'));
        }
    }

    public function activateLanguage($id = null) {
        $check = $this->Language->find('first', array('conditions' => array('id' => $id)));
        if ($check) {
            $coupon = $this->Language->updateAll(array('Language.active' => 1), array('Language.id' => $id));
            if ($coupon) {
                $this->Session->write('Note.ok', 'The Language was updated');
            } else {
                $this->Session->write('Note.error', 'The Language was not updated');
            }
        }
        $this->redirect(array('controller' => 'admins', 'action' => 'languages'));
    }

    public function deactivateLanguage($id = null) {
        $check = $this->Language->find('first', array('conditions' => array('id' => $id)));
        if ($check) {
            $coupon = $this->Language->updateAll(array('Language.active' => 0), array('Language.id' => $id));
            if ($coupon) {
                $this->Session->write('Note.ok', 'The Language was updated');
            } else {
                $this->Session->write('Note.error', 'The Language was not updated');
            }
        }
        $this->redirect(array('controller' => 'admins', 'action' => 'languages'));
    }

    public function edit_language($id = NULL) {
        if (empty($this->request->data) && isset($id)) {
            $this->request->data = $this->Language->findById($id);
        } else {
            $this->Language->id = $id;
            $this->Language->save($this->request->data);
            $this->redirect(array('controller' => 'admins', 'action' => 'languages'));
        }
    }

    public function law_library() {
        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'created DESC'
        );
        $data = $this->Paginator->paginate('Librarie');
        $this->set('data', $data);
    }

    public function add_library() {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->Librarie->set($data);
            if (!$this->Librarie->validates()) {
                $error = reset($this->Librarie->validationErrors);
                $this->set('error', reset($error));
            }
            $this->Librarie->create();
            $bool = $this->Librarie->save($data);
            if ($bool) {
                $this->redirect(array('controller' => 'admins', 'action' => 'law_library'));
            }
        }
    }

    public function edit_library($id) {
        if (empty($this->request->data)) {
            $this->request->data = $this->Librarie->findById($id);
        } else {
            $data = $this->request->data;
            $this->Librarie->id = $id;
            if ($data['Librarie']['lib_file']) {
                $old_file = $this->Librarie->find('first', array(
                    'conditions' => array('Librarie.id' => $id),
                    'fields' => array('Librarie.lib_file')
                        ));
                $file = 'system/library/' . $old_file['Librarie']['lib_file'];
                unlink($file);
            } else {
                $old_file = $this->Librarie->find('first', array(
                    'conditions' => array('Librarie.id' => $id),
                    'fields' => array('Librarie.lib_file')
                        ));
                $data['Librarie']['lib_file'] = $old_file['Librarie']['lib_file'];
            }
            $this->Librarie->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'law_library'));
        }
    }

    public function delete_library($id) {
        $library = $this->Librarie->findById($id);
        if ($library['Librarie']['lib_file']) {
            $file = 'system/library/' . $library['Librarie']['lib_file'];
            unlink($file);
        }
        $this->Librarie->delete($id);
        $this->redirect(array('controller' => 'admins', 'action' => 'law_library'));
    }

    public function all_questions() {
        $this->Paginator->settings = array(
            'joins' => array(
                array(
                    'alias' => 'QuestionContract',
                    'table' => 'question_contracts',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Question.id = QuestionContract.question_id'
                    ),
                ),
                array(
                    'alias' => 'Contract',
                    'table' => 'contracts',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'QuestionContract.contract_id = Contract.id'
                    ),
                ),
                array(
                    'alias' => 'FaqCategorie',
                    'table' => 'faq_categories',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'FaqCategorie.id = Question.faq_category_id'
                    ),
                ),
            ),
            'group' => array('Question.id'),
            'limit' => 10,
            'order' => 'Question.created DESC',
            'fields' => array(
                'GROUP_CONCAT(Contract.name) AS name',
                'Question.*', 'FaqCategorie.category'
            )
        );
        $data = $this->Paginator->paginate('Question');
        $this->set('data', $data);
    }

    public function add_question() {
        if (empty($this->request->data)) {
            $data = $this->Contract->find('all', array(
                'fields' => array('id', 'name')
                    ));
            $this->set('data', $data);
            $faq_categories = $this->FaqCategorie->find('all');
            $this->set('faq_categories', $faq_categories);
        } else {
            $data = $this->request->data;
            $contract_id = $data['Question']['contract_id'];
            $faq_id = $data['Question']['faq_id'][0];
            unset($data['Question']['contract_id']);
            $this->Question->create();
            $this->Question->save($data);
            if (!empty($contract_id)) {
                $question_id = $this->Question->id;
                $data_id = $this->Question->category($contract_id, $question_id);
                $this->QuestionContract->create();
                $this->QuestionContract->saveAll($data_id);
            }
            if (!empty($faq_id)) {
                $faq['Question']['faq_category_id'] = $faq_id;
                $this->Question->save($faq);
            }
            $this->redirect(array('controller' => 'admins', 'action' => 'all_questions'));
        }
    }

    public function edit_question($id) {
        if (empty($this->request->data)) {
            $data = $this->Contract->find('all', array(
                'fields' => array('id', 'name'),
                'group' => 'id'
                    ));
            $this->request->data = $this->Question->findById($id);
            $data_contract = $this->QuestionContract->find('all', array(
                'conditions' => array(
                    'QuestionContract.question_id' => $id
                ),
                'fields' => array('contract_id'),
                    ));
            foreach ($data_contract as $contract) {
                $this->request->data['Question']['contract_id'][] = $contract['QuestionContract']['contract_id'];
            }
            $this->set('data', $data);
            $faq_id = $this->request->data['Question']['faq_category_id'];
            if (!empty($faq_id)) {
                $this->request->data['Question']['faq_id'][0] = $faq_id;
            }
            $faq_categories = $this->FaqCategorie->find('all');
            $this->set('faq_categories', $faq_categories);
        } else {
            $data = $this->request->data;
            $this->Question->id = $id;
            $this->Question->save($data);
                $condition = array('QuestionContract.question_id' => $id);
                $this->QuestionContract->deleteAll($condition, false);
                $contract_id = $data['Question']['contract_id'];
            if (!empty($data['Question']['contract_id'])) {   
                $data_id = $this->Question->category($contract_id, $id);
                $this->QuestionContract->create();
                $this->QuestionContract->saveAll($data_id);
            }
            $faq_id = $data['Question']['faq_id'][0];
            $faq['Question']['faq_category_id'] = $faq_id;
            $this->Question->save($faq);
            $this->redirect(array('controller' => 'admins', 'action' => 'all_questions'));
        }
    }

    public function delete_question($id) {
        $this->Question->delete($id);
        $condition = array('QuestionContract.question_id' => $id);
        $this->QuestionContract->deleteAll($condition, false);
        $this->redirect(array('controller' => 'admins', 'action' => 'all_questions'));
    }

    public function faq_categories() {
        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'created DESC'
        );
        $data = $this->Paginator->paginate('FaqCategorie');
        $this->set('data', $data);
    }

    public function add_faq_category() {
        if (!empty($this->request->data)) {
            $this->FaqCategorie->create();
            $this->FaqCategorie->save($this->request->data);
            $this->redirect(array('controller' => 'admins', 'action' => 'faq_categories'));
        }
    }

    public function edit_faq_category($id = null) {
        if (isset($id)) {
            if (empty($this->request->data)) {
                $this->request->data = $this->FaqCategorie->findById($id);
            } else {
                $this->FaqCategorie->id = $id;
                $this->FaqCategorie->save($this->request->data);
                $this->redirect(array('controller' => 'admins', 'action' => 'faq_categories'));
            }
        }
    }

    public function delete_faq_category($id = null) {
        if (isset($id)) {
            $this->FaqCategorie->delete($id);
            $this->Question->updateAll(array('Question.faq_category_id' => null), array('Question.faq_category_id' => $id));
            $this->redirect($this->referer());
        }
    }

    public function all_reviews() {
        $this->Paginator->settings = array(
            'joins' => array(
                array(
                    'alias' => 'Contract',
                    'table' => 'contracts',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Contract.id = Review.contract_id'
                    ),
            )),
            'order' => 'Review.id DESC',
            'limit' => 10,
            'fields' => array('Review.*', 'Contract.name'),
        );
        $data = $this->Paginator->paginate('Review');
        $this->set('data', $data);
    }

    public function add_review() {
        $data = $this->Contract->find('all', array(
            'fields' => array('id', 'name')
                ));
        $this->set('data', $data);
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $this->Review->set($data);
            if (!$this->Review->validates()) {
                $error = reset($this->Review->validationErrors);
                $this->set('error', reset($error));
                //unset($this->request->data);
                return;
            }
            $data['Review']['contract_id'] = $data['Review']['contract_id'][0];
            $this->Review->create();
            $this->Review->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'all_reviews'));
        }
    }

    public function edit_review($id) {
        $data = $this->Contract->find('all', array(
            'fields' => array('id', 'name')
                ));
        $this->set('data', $data);
        if (empty($this->request->data)) {
            $this->request->data = $this->Review->findById($id);
            $contract_id = $this->request->data['Review']['contract_id'];
            unset($this->request->data['Review']['contract_id']);
            $this->request->data['Review']['contract_id'][0] = $contract_id;
        } else {
            $data = $this->request->data;
            $this->Review->set($data);
            if (!$this->Review->validates()) {
                $error = reset($this->Review->validationErrors);
                $this->set('error', reset($error));
                return;
            }
            $data['Review']['contract_id'] = $data['Review']['contract_id'][0];
            $this->Review->id = $id;
            $this->Review->save($data);
            $this->redirect(array('controller' => 'admins', 'action' => 'all_reviews'));
        }
    }


    public function user_inquires() {
        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'created DESC'
        );
        $data = $this->Paginator->paginate('Contact');
        $this->set('data', $data);
    }

    public function editTypeAjax() {
        $params = array();
        $status = true;
        $message = '';
        try {
            if (empty($this->data))
                throw new Exception('Empty Post');
            if (isset($this->data['type'])) {
                $type = $this->Type->find(
                        'first', array(
                    'conditions' => array(
                        'Type.id' => $this->data['catId']
                    )
                        )
                );
                if (!$type)
                    throw new Exception('No type found for edit');

                $params['type'] = $type['Type'];
            }else {
                if (empty($this->data['EditType']['title']))
                    throw new Exception('Please insert category title');

                $save = $this->Type->save($this->data['EditType']);
                if (!$save)
                    throw new Exception("Can't save category");

                $this->Session->write('Note.ok', 'Successfully updated');
            }
        } catch (Exception $e) {
            $status = false;
            $message = $e->getMessage();
        }
        $this->_sendResponse($status, $message, $params);
    }

    public function logout() {
        $this->Session->destroy();
        $this->redirect(array('controller' => 'admins', 'action' => 'login'));
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

    public function uploadUsersPic() {
        if (isset($_GET['qqfile'])) {
            $imgName = $_GET['qqfile'];
        } elseif (isset($_FILES['qqfile'])) {
            $imgName = $_FILES['qqfile']['name'];
        }
        $explode = explode('.', $imgName);
        $ext = end($explode);
        $name = md5(microtime()) . '.' . $ext;
        $ext = strtolower($ext);
        if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif') {
            // if (!is_dir(WWW_ROOT . 'system' . DS . 'bulletinPic' . DS.$this->u_id)){
            // mkdir(WWW_ROOT . 'system' . DS . 'bulletinPic' . DS.$this->u_id,true);}
            $this->FileUploader->upload(WWW_ROOT . 'system' . DS . 'site' . DS);
            $response['fileName'] = $name;
            $response['success'] = true;
            @rename(WWW_ROOT . 'system' . DS . 'site' . DS . $imgName, WWW_ROOT . 'system' . DS . 'site' . DS . $name);
            $response['size'] = getimagesize(WWW_ROOT . 'system' . DS . 'site' . DS . $name);
//            $img = array();
//            $img = $this->Session->read('img');
//            $img[$name] = $name;
//            $this->Session->write('img', $name);
            $echo = json_encode($response);
            echo $echo;
            die;
        } else {
            $response['success'] = false;
            $echo = json_encode($response);
            echo $echo;
            die;
        }
    }

    //////////////////////////////////// Crop image ////////////////////////////////////////
    protected function parseImage($ext, $img, $file = null) {
        switch ($ext) {
            case "png":
                imagepng($img, ($file != null ? $file : ''));
                break;
            case "jpeg":
                imagejpeg($img, ($file ? $file : ''), 90);
                break;
            case "jpg":
                imagejpeg($img, ($file ? $file : ''), 90);
                break;
            case "gif":
                imagegif($img, ($file ? $file : ''));
                break;
        }
    }

    protected function setTransparency($imgSrc, $imgDest, $ext) {
        if ($ext == "png" || $ext == "gif") {
            $trnprt_indx = imagecolortransparent($imgSrc);
            // If we have a specific transparent color
            if ($trnprt_indx >= 0) {
                // Get the original image's transparent color's RGB values
                $trnprt_color = imagecolorsforindex($imgSrc, $trnprt_indx);
                // Allocate the same color in the new image resource
                $trnprt_indx = imagecolorallocate($imgDest, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                // Completely fill the background of the new image with allocated color.
                imagefill($imgDest, 0, 0, $trnprt_indx);
                // Set the background color for new image to transparent
                imagecolortransparent($imgDest, $trnprt_indx);
            }
            // Always make a transparent background color for PNGs that don't have one allocated already
            elseif ($ext == "png") {
                // Turn off transparency blending (temporarily)
                imagealphablending($imgDest, true);
                // Create a new transparent color for image
                $color = imagecolorallocatealpha($imgDest, 0, 0, 0, 127);
                // Completely fill the background of the new image with allocated color.
                imagefill($imgDest, 0, 0, $color);
                // Restore transparency blending
                imagesavealpha($imgDest, true);
            }
        }
    }

    protected function returnCorrectFunction($ext) {
        $function = "";
        switch ($ext) {
            case "png":
                $function = "imagecreatefrompng";
                break;
            case "jpeg":
                $function = "imagecreatefromjpeg";
                break;
            case "jpg":
                $function = "imagecreatefromjpeg";
                break;
            case "gif":
                $function = "imagecreatefromgif";
                break;
        }
        return $function;
    }

    public function resizeCrop($name) {
        // var_dump($name, $_POST["imageSource"]);die;
        set_time_limit(6000);
        ini_set('memory_limit', '1024M');
        $imageToDel = WWW_ROOT . $_POST["imageSource"];
        list($width, $height) = getimagesize(WWW_ROOT . $_POST["imageSource"]);
        $viewPortW = $_POST["viewPortW"];
        $viewPortH = $_POST["viewPortH"];
        $pWidth = $_POST["imageW"];
        $pHeight = $_POST["imageH"];
        $ext = end(explode(".", $_POST["imageSource"]));
        $ext = strtolower($ext);
        $function = $this->returnCorrectFunction($ext);
        $image = $function(ROOT . '/app/webroot' . $_POST["imageSource"]);

        if (!$image) {
            //Not valid image
        }
        $width = imagesx($image);
        $height = imagesy($image);
        // Resample
        $image_p = imagecreatetruecolor($pWidth, $pHeight);
        $this->setTransparency($image, $image_p, $ext);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $pWidth, $pHeight, $width, $height);
        imagedestroy($image);
        $widthR = imagesx($image_p);
        $hegihtR = imagesy($image_p);
        $selectorX = $_POST["selectorX"];
        $selectorY = $_POST["selectorY"];
        if ($_POST["imageRotate"]) {
            $angle = 360 - $_POST["imageRotate"];
            $image_p = imagerotate($image_p, $angle, 0);

            $pWidth = imagesx($image_p);
            $pHeight = imagesy($image_p);

            //print $pWidth."---".$pHeight;

            $diffW = abs($pWidth - $widthR) / 2;
            $diffH = abs($pHeight - $hegihtR) / 2;

            $_POST["imageX"] = ($pWidth > $widthR ? $_POST["imageX"] - $diffW : $_POST["imageX"] + $diffW);
            $_POST["imageY"] = ($pHeight > $hegihtR ? $_POST["imageY"] - $diffH : $_POST["imageY"] + $diffH);
        }
        $dst_x = $src_x = $dst_y = $src_y = 0;

        if ($_POST["imageX"] > 0) {
            $dst_x = abs($_POST["imageX"]);
        } else {
            $src_x = abs($_POST["imageX"]);
        }
        if ($_POST["imageY"] > 0) {
            $dst_y = abs($_POST["imageY"]);
        } else {
            $src_y = abs($_POST["imageY"]);
        }


        $viewport = imagecreatetruecolor($_POST["viewPortW"], $_POST["viewPortH"]);
        $this->setTransparency($image_p, $viewport, $ext);

        imagecopy($viewport, $image_p, $dst_x, $dst_y, $src_x, $src_y, $pWidth, $pHeight);
        imagedestroy($image_p);


        $selector = imagecreatetruecolor($_POST["selectorW"], $_POST["selectorH"]);
        $this->setTransparency($viewport, $selector, $ext);
        imagecopy($selector, $viewport, 0, 0, $selectorX, $selectorY, $_POST["viewPortW"], $_POST["viewPortH"]);
        $filname = $name . '.' . $ext;
        $file = WWW_ROOT . 'system' . DS . 'site' . DS . $name;
        $this->parseImage($ext, $selector, $file);
        //  unlink($f_unlink);
        imagedestroy($viewport);
        $user = '5';
//        if(file_exists(WWW_ROOT . 'system' . DS . 'site' . DS . $user['User']['image'])){
//            @unlink(WWW_ROOT . 'system' . DS . 'site' . DS . $user['User']['image']);
//        }
        if (file_exists($imageToDel) && !strpos($imageToDel, 'default.jpg')) {
            @unlink($imageToDel);
        }
        exit;
    }

    public function edit_contract_form($id) {
        if ($id) {
            $this->scripts_for_layout_include[] = 'jquery-ui-1.10.4.custom.min';
            $this->css_for_layout_include[] = 'jquery-ui-1.10.4.custom.min';
            $contract = $this->Contract->findById($id);
            if ($contract) {
                $stepsIds = array();
                $form = array();
                $elements = array();
                if ($contract['Contract']['form'] && is_array(json_decode($contract['Contract']['form'], TRUE))) {
                    $j = 1;
                    $form = json_decode($contract['Contract']['form'], TRUE);
                    //var_dump($form);die;
                    foreach ($form as $key => $value) {
                        
                        $stepsIds[$key] = $value['name'];
                        foreach ($value['data'] as $k => $val) {
                            $form[$j] = $val;
                            $j++;
                            $elements[$val["form_id"]] = $val;
                        }
                    }
                }
                if (is_array(json_decode($contract['Contract']['form'], TRUE))) {
                    $steps = json_decode($contract['Contract']['form'], TRUE);
                } else {
                    $steps = array();
                }
                //var_dump($steps);die;  
                $this->viewData['steps'] = $steps;
                $this->viewData['stepsIds'] = $stepsIds;
                $this->viewData['contract'] = $contract['Contract'];
                $this->viewData['form'] = $form;
                $this->viewData['elements'] = $elements;
                $form_ids = $this->FormId->find('all');
                $f_ids = array();
                foreach ($form_ids as $key => $value) {
                    $f_ids[$value ["FormId"]["id"]] = $value ["FormId"]["form_id"];
                }
                $this->viewData['form_ids'] = $f_ids;
            } else {
                $this->redirect('/admins/users');
            }
        } else {
            $this->redirect('/admins/users');
        }
    }

    public function save_form() {
        //var_dump($expression)
        if($this->Auth->checkAdmin()){
            if (isset($this->request->data) && $this->request->data['id']) {

                if (isset($this->request->data['stepsIds'])) {
                    if (isset($this->request->data['form'])) {
                        $form = ($this->request->data['form']);
                    } else {
                        $form = array();
                    }

                    $array = array();
                    foreach (($this->request->data['stepsIds']) as $k => $val) {

                        if ($val) {
                            $step = array();
                            foreach ($form as $key => $value) {

                                if ($key) {
                                    $steps[$value['step']][$key] = $value;
                                    if ((int)$k == (int)$value['step']) {

                                        if ($value["type"] == 'select') {
                                            if(!isset($value["choises"])){
                                                $value["choises"] = array();
                                            }else{
                                                $choises = array();
                                                foreach ($value["choises"] as $ck => $ch) {
                                                    if($ch){
                                                        $choises[] = $ch;
                                                    }
                                                }
                                                $value["choises"] = $choises;
                                            }
                                        }
                                        if ($value["type"] == 'radiobatton') {
                                            if(!isset($value["radio"])){
                                                $value["radio"] = array();
                                            }else{
                                                $radio = array();
                                                foreach ($value["radio"] as $ck => $ch) {
                                                    if($ch){
                                                        $radio[] = $ch;
                                                    }
                                                }
                                                $value["radio"] = $radio;
                                            }

                                        }
                                        /*var_dump($value);
                                        foreach ($value as $k => $v) {
                                            $value[$k] = mysql_escape_string($v);
                                        }
                                        var_dump($value);die;*/
                                        $step[$key] = $value;
                                    }
                                }
                            }
                            $array[$k]['name'] = $val;
                            $array[$k]['data'] = $step;
                        }
                    }
                } else {
                    $form = array();
                    $array = array();
                }

                $contract = array(
                    'id' => $this->request->data['id'],
                    'form' => json_encode($array)
                );
                $save = $this->Contract->save($contract);
                if ($save) {
                    $this->_sendResponse(true);
                } else {
                    $this->_sendResponse(FALSE);
                }
            } else {
                $this->_sendResponse(FALSE);
            } 
        }else{
            $this->_sendResponse(FALSE,'Please login for edit form');
        }
    }

    public function upload_contract() {
        
    }
    
    public function customPages(){
        $this->loadModel('CustomPage');
        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'created DESC'
        );
        $data = $this->Paginator->paginate('CustomPage');
        $this->viewData['data'] = $data;
    }
    
    public function addCustomPage(){
        $this->loadModel('CustomPage');
        try {
            if(!empty($this->request->data)){
                $data = $this->request->data['CustomPage'];
                $data['url'] = ($data['url'])?$data['url']:$this->_generateUrl('CustomPage', $data['title']);
                $saveData['CustomPage'] = $data;
                $save = $this->CustomPage->save($saveData);
                if(!$save){
                    throw new Exception('Cant save');
                }
                $this->redirect(array('controller' => 'admins', 'action' => 'customPages'));
            }
        } catch (Exception $ex) {
            
        }
    }
    
    public function editCustomPage($pageId = null){
        $this->loadModel('CustomPage');
        try {
            if(!$pageId){
                throw new Exception('Cant find page specified');
                $url = array('controller' => 'admins', 'action' => 'customPages');
            }
            $pageData = $this->CustomPage->find('first', array('conditions' => array('CustomPage.id' => $pageId)));
            if(!$pageData){
                throw new Exception('Cant find page specified');
                $url = array('controller' => 'admins', 'action' => 'customPages');
            }
            
            if(!empty($this->request->data)){
                $data = $this->request->data['CustomPage'];
                if($data['url']){
                    if($this->CustomPage->find('count', array('conditions' => array('url' => $data['url'], 'id !=' => $pageId)))){
                        throw new Exception('This url already in use');
                    }
                }else{
                    $data['url'] = $this->_generateUrl('CustomPage', $data['title']);
                }
                $saveData['CustomPage'] = $data;
                $saveData['CustomPage']['id'] = $pageData['CustomPage']['id'];
                $save = $this->CustomPage->save($saveData);
                if(!$save){
                    throw new Exception('Cant save');
                }
                $this->redirect(array('controller' => 'admins', 'action' => 'customPages'));
            }else{
                $this->request->data['CustomPage'] = $pageData['CustomPage'];
            }
        } catch (Exception $ex) {
            $this->viewData['error'] = $ex->getMessage();
            if(isset($url)){
                $this->redirect($url);
            }
        }
    }
    
    public function deleteCustomPage($pageId = null){
        $this->loadModel('CustomPage');
        try {
            if(!$pageId){
                throw new Exception('Cant find page specified');
                $url = array('controller' => 'admins', 'action' => 'customPages');
            }
            $pageData = $this->CustomPage->find('first', array('confitions' => array('CustomPage.id' => $pageId)));
            
            if(!$pageData){
                throw new Exception('Cant find page specified');
                $url = array('controller' => 'admins', 'action' => 'customPages');
            }
            
            $save = $this->CustomPage->delete($pageData['CustomPage']['id']);
            if(!$save){
                throw new Exception('Cant delete');
            }
            $this->redirect(array('controller' => 'admins', 'action' => 'customPages'));
            
        } catch (Exception $ex) {
            $this->viewData['error'] = $ex->getMessage();
            if(isset($url)){
                $this->redirect($url);
            }
        }
    }
    
    protected function _generateUrl($model = null, $title = null){
        if(!$model || !$title)
            return false;
        
        $title = preg_replace('/\s\s+/', '_', $title);
        $url = $title;
        $count = 0;
        while($this->$model->find(
            'count', 
            array(
                'conditions' => array(
                    'url' => $url
                )
            )
        )){
            $count++;
            $url = $title . '_' . $count;
        }
        return $url;
    }
    
    protected function _validateInputData($required = array() , $data = array()){
        
        if(empty($required))
            throw new Exception('No field is required');

        if(empty($data))
            throw new Exception('No Data submited');

        foreach ($required as $key => $value){
            if(is_numeric($key)){
                if(!isset($data[$value]) || !trim($data[$value]))
                    throw new Exception($value.' is required');
            }else{
                //to do
            }
        }         
        return true;
    }
    
    public function site_map(){
        $this->loadModel('SiteMap');
        $siteMap = $this->SiteMap->find('all');
        $this->Paginator->settings = $this->Paginator->settings = array(
            'limit' => 50,
            'order' => 'created DESC',
            'conditions' => array(
                'type' => 'dynamic'
            )
        );
        $siteMap = $this->Paginator->paginate('SiteMap');
        if($siteMap){
            $this->viewData['siteMap'] = $siteMap;
        }
    }
    
    public function add_url(){
        $this->Auth->getAdmin();
        if (!empty($this->request->data)) {
            $this->loadModel('siteMap');
            $data = $this->request->data;
            //var_dump($data);die;
            $this->siteMap->set($data);
            if (!$this->siteMap->validates()) {
                $errors = reset($this->siteMap->validationErrors);
                $this->set('error',reset($errors));
                return;
            }
            $this->siteMap->create();
            $data['siteMap']['type'] = 'dynamic';
            $chek_save = $this->siteMap->save($data);
            if ($chek_save) {
                $this->redirect(array('controller' => 'admins', 'action' => 'site_map'));
            }
        }
    }
    
    public function edit_url($id = null){
        $this->Auth->getAdmin();
        $this->loadModel('siteMap');
        if (!empty($this->request->data)) {
            
            $data = $this->request->data;
            //var_dump($data);die;
            $this->siteMap->set($data);
            if (!$this->siteMap->validates()) {
                $errors = reset($this->siteMap->validationErrors);
                $this->set('error',reset($errors));
                return;
            }
            $this->siteMap->create();
            $data['siteMap']['type'] = 'dynamic';
            $this->siteMap->id = $id;
            $chek_save = $this->siteMap->save($data);
            if ($chek_save) {
                $this->Session->write('Note.ok', 'URL successfully edited.');
                $this->redirect(array('controller' => 'admins', 'action' => 'site_map'));
            }
        }else{
            $this->request->data = $this->siteMap->findById($id);
        }
    }
    
    public function delete_url($id = null){
        $this->loadModel('siteMap');
        if($id){
            $this->siteMap->delete($id);
            $this->Session->write('Note.ok', 'URL successfully deleted.');
        }else{
            $this->Session->write('Note.error', 'No id to delete');
        }
        $this->redirect(array('controller' => 'admins', 'action' => 'site_map'));
    }
    
    public function generate_site_map(){
        App::uses('Xml', 'Utility');
        
        /*$data =  "<?xml version='1.0' encoding='UTF-8'?><?xml-stylesheet type='text/xsl' href='http://www.didyouknow.it/wp-content/plugins/google-sitemap-generator/sitemap.xsl' ?>";*/

        //$data.='<!-- generated-on="'.date('F d, Y g:i a ').'" -->';//March 31, 2014 11:08 am
        $this->loadModel('SiteMap');
        $siteMap = $this->SiteMap->find('all');
        
        
        $data = "<urlset xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd' xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>";
        
        $this->loadModel('Contract');
        
        
        $footers = $this->Footer->find('all');
        if($footers){
            foreach ($footers as $key => $value) {
                $data.= 
                "<url>". 
                    "<loc>".FULL_BASE_URL.'/pages/'.preg_replace('/\s+/', '_', strtolower($value['Footer']['name']))."</loc> ".
                    "<lastmod>".date('DATE_ATOM',  strtotime($value['Footer']['modified']))."</lastmod>". 
                "</url>";
}
        }

        $contracts = $this->Contract->find('all');
        if($contracts){
            foreach ($contracts as $key => $value) {
                $data.= 
                "<url>". 
                    "<loc>".FULL_BASE_URL.'/'.preg_replace('/\s+/', '_', strtolower($value['Contract']['name']))."</loc> ".
                    "<lastmod>".date('DATE_ATOM',  strtotime($value['Contract']['modified']))."</lastmod>". 
                "</url>";
            }
        }
        if($siteMap){
            foreach ($siteMap as $key => $value) {
                $data.= 
                "<url>". 
                    "<loc>".$value['SiteMap']['url']."</loc> ".
                    "<lastmod>".date('DATE_ATOM',  strtotime($value['SiteMap']['modified']))."</lastmod>". 
                "</url>";
            }
        }
        $data.='</urlset>';
        //var_dump($data);die;
        //$xml = new Xml('site_map');
        //$xml = Xml::build($data);
        //var_dump($xml);
        file_put_contents('site_map.xml',$data);
        die;
    }

    
}