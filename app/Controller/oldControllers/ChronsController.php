<?php
class ChronsController extends AppController {
     public $name = 'Chrons';
     public $uses = array('User','BlockedIp');
     
     public function ChekUserCreated() {
         $day = 48 * 60 * 60;
         $time = date("Y-m-d H:i:s", (time() - $day));
         $user_data = $this->User->find('all',array(
             'conditions' => array(
                 'active' => false,
                 'created <' => $time
                 ),
             'fields' => array('id')
         ));
         foreach($user_data as $user){
                 $delete_user[] = $user["User"]['id']; 
         }
         if(!empty($delete_user)){
            $conditions = array('id' => $delete_user);
            $this->User->deleteAll($conditions,false);
         }
         die;             
     }
     
     public function WrongRegister(){
         $time = 15 * 60;
         $date = date("Y-m-d H:i:s", (time() - $time));
         $blocked_user = $this->BlockedIp->find('all',array(
             'conditions' => array(
                 'wrong_login' => true,
                 'created  <' => $date
             )
         ));
         if(!empty($blocked_user)){
            foreach($blocked_user as $user){
                $delete_ip[] = $user["BlockedIp"]['id']; 
            }
         }
         if(!empty($delete_ip)){
             $conditions = array('id' => $delete_ip);
             $this->BlockedIp->deleteAll($conditions,false);
         }
         die;
     }
}