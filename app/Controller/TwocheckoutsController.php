<?php

App::uses('AppController', 'Controller');
App::import('Vendor', 'Twocheckout', array('file' => '2checkout-php-master'.DS.'lib'.DS.'Twocheckout.php'));
/**
 * Static content controller
 *
 * @package       app.Controller
 */

class TwocheckoutsController extends AppController{
    
    public function checkout(){
        
    }
    
    public function payment($id = null,$contract_id = null){
        Twocheckout::privateKey('5DAC98FE-EF3E-4A2D-B42E-36DE611EE4B7');
        Twocheckout::sellerId('901255149');
        Twocheckout::sandbox(true);  #Uncomment to use Sandbox
        var_dump($contract_id);
        $contract = $this->Session->read('contract_'.$contract_id);
        if($contract){
            $this->loadModel('Order');
            $order = $this->Order->find('first',array(
                'conditions' => array(
                    'Order.id='.$id
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


            if($order['Order']["paid"] == TRUE){
                 $this->redirect('/contracts/review_finalize/'.$id);
            }
            try {
                $charge = Twocheckout_Charge::auth(array(
                        "merchantOrderId" => $this->userDb["User"]["id"],
                    "token"      => $_POST['token'],
                    "currency"   => 'USD',
                        "total"      => $order['Membership']['month_price'],
                    "billingAddr" => array(
                        "name" => 'Testing Tester',
                        "addrLine1" => '123 Test St',
                        "city" => 'Columbus',
                        "state" => 'OH',
                        "zipCode" => '43123',
                        "country" => 'USA',
                            "email" => $this->userDb["User"]["email"],
                        "phoneNumber" => '555-555-5555'
                    )
                ));

                if ($charge['response']['responseCode'] == 'APPROVED') {
                    $this->loadModel('Transaction');

                    $transaction = array(
                        'user_id' => $this->u_id,
                        'paymentstatus' => 'paid',
                        'type' => '2checkout',
                        'transactionId' => $charge['response']['transactionId'],
                        'transactionData' => json_encode($charge)
                    );
                    $this->Transaction->save($transaction);

                    $order = array(
                        'id' => $id,
                        'paid' => 1
                    );

                    $save = $this->Order->save($order);

                    if($save){
                            if($contract['Order']['id'] == $save['Order']['id']){
                                $contract['Order'] = $save['Order'];
                                $this->Session->write('contract_'.$id, $contract);
                            }
                        $this->redirect('/contracts/review_finalize/'.$id);
                    }else{
                        $this->Session->setFlash(__( 'error'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                        $this->redirect('/');
                    }
                }else{
                         $this->Session->setFlash(__( 'Transaction error!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                    $this->redirect('/');
                }
            } catch (Twocheckout_Error $e) {
                    $this->Session->setFlash(__( $e->getMessage()), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            }
        //$this->Session->setFlash(__( 'Error. No order Id!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
        }else{
            $this->Session->setFlash(__( 'Cant find contract session!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
        }
        $this->redirect('/');
    }
    
}
