<?php

/**
 * Example usuage of Paypal Component
 *
 */
App::uses('AppController', 'Controller');

class PaypalsController extends AppController{

    // Include the Payapl component
    public $components = array('Paypal', 'Mailer'//,'Functions'
    );
    public $uses = array(
        'Transaction',
        'Cart',
        'Order',
    );

    function beforeFilter(){
        parent::beforeFilter();
        //$this->layout = false;
        if($this->action != 'returnUrl'){
            $this->Auth->getUser();
        }
    }

    // Example usuage
    public function index(){
        $this->redirect($this->webroot);
        if($this->Session->check('Note')){
            $this->set('Note', $this->Session->read('Note'));
            $this->Session->delete('Note');
        }
    }

    // Set the values and begin paypal process
    public function express_checkout($id = null,$contract_id = null,$reccuring = null){
        if($contract_id && $id){
            //$contract = $this->Session->read('contract_'.$contract_id);
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
            if($order){
                if($order['Order']["paid"] == TRUE){
                    $this->redirect('/contracts/review_finalize/'.$id);
                }
                $userinfo = $this->userDb['User'];
                $ItemName = 'Contract'; // Item Name
                $ItemQty = 1;            // Item Quantity
                $Invoice = 'cont' . md5(microtime());
                if($order['Membership']['type'] == 'package'){
                    $reccuring = TRUE;
                    $ItemTotalPrice = (int)$order['Membership']['month_price'];
                }else{
                    $ItemTotalPrice = (int)$order['Membership']['individual_price'];
                }
                try{

                    $this->Paypal->amount = $ItemTotalPrice;
                    $this->Paypal->currencyCode = 'USD';
                    if($reccuring){
                       $this->Paypal->returnUrl = Router::url(array('action' => 'confirmPaypal/' . $Invoice . '/' . $id.'/'.$contract_id.'/recuringPayment'), true);
                    }else{
                       $this->Paypal->returnUrl = Router::url(array('action' => 'confirmPaypal/' . $Invoice . '/' . $id.'/'.$contract_id), true);
                    }
                    $this->Paypal->cancelUrl = Router::url(array('action' => 'cancelPaypal/' . $Invoice), true);
                    $this->Paypal->notifyUrl = Router::url(array('action' => 'returnUrl'), true);
                    $this->Paypal->orderDesc = "$ItemName buy";
                    $this->Paypal->invoice = $Invoice;
                    $this->Paypal->itemName = $ItemName;
                    $this->Paypal->quantity = 1;

                    //save to transactions
                    $this->Transaction->create();
                    $this->Transaction->save(array(
                        'user_id' => $userinfo['id'],
                        'order_id' => $order['Order']['id'],
                        'paymentstatus' => 'pending',
                        'Invoice' => $Invoice,
                        'ItemAmount' => $ItemTotalPrice,
                        'ItemName' => $ItemName,
                        'ItemQTY' => $ItemQty
                    ));
//                    var_dump($this->Paypal);die;
                    $this->Paypal->expressCheckout();
                }catch(Exception $e){
                    $this->Session->setFlash(__( $e->getMessage()), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                    return $this->redirect('/pages/orders');
                }
            }else{
                $this->Session->setFlash(__( 'Cant find contract session!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            }
        }else{
            $this->Session->setFlash(__( 'Error. No contract or order id!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            $this->redirect('/');
        }
    }
    
    public function cancelRecurringPayment($profileId = null){
        if($profileId){
            $checkProfileId = $this->Transaction->find('first',array(
                'conditions'=>array(
                    'Transaction.paypalProfileId' =>$profileId
                 ),
                'fields'=>array('Transaction.adminId')
            ));
            if(!$checkProfileId || $checkProfileId['Transaction']['adminId'] != $this->adminDb['Admin']['id']){
                $this->redirect($this->referer());
            }
            $this->Paypal->manageRecurringPaymentProfile($profileId); 
        }
        $this->redirect($this->referer());
    }
    
    public function confirmPaypal($Invoice = null, $id = null,$contract_id = null, $reccuring = null){
        $this->autoRender = false;
        //$contract = $this->Session->read('contract_'.$contract_id);
        
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
        
        if($order){
            if($order['Membership']['type'] == 'package'){
                $count = $order['Membership']['month_count'];
            }else{
                $count = 1;
            }
            if($order['Order']["paid"] == TRUE){
                $this->redirect('/contracts/review_finalize/'.$id);
            }
            if(!$Invoice){
                $this->Session->setFlash(__('Tramsaction not found!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                $this->redirect('/contracts/pay/');
            }
            $userinfo = $this->userDb['User'];
            //get the transaction
            try{
                $transaction = $this->Transaction->find('all', array(
                    'conditions' => array(
                        'user_id' => $userinfo['id'],
                        'paymentstatus' => 'pending',
                        'Invoice' => $Invoice
                    )
                ));
                
            }catch(Exception $ex){
                $this->Session->setFlash(__('Transaction not found!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                $this->redirect('/');
            }

            // and PayerID will be present in URL
            $this->Paypal->token = $this->request->query['token'];
            $this->Paypal->payerId = $this->request->query['PayerID'];
            // At this point, you can let the customer review their order.
            // Use the "getExpressCheckoutDetails" method to fetch details...
            $customer_details = $this->Paypal->getExpressCheckoutDetails();

            // Then you must call "doExpressCheckoutPayment" to complete the payment
            $this->Paypal->amount = $order['Membership']['month_price'];
            $this->Paypal->currencyCode = 'USD';
            //var_dump($reccuring);die;
            if($reccuring){
                try {
                    $response = $this->Paypal->createRecurringPaymentProfile();
                    var_dump($response);die;
                    if(strtoupper($response['ACK']) === 'SUCCESS' || strtoupper($response['ACK']) === 'SUCCESSWITHWARNING '){
                        //payment was completed successfully
                        $details['paypalProfileId'] = $response['PROFILEID'];
                        $details['id'] = $tr['Transaction']['id'];
                        $details['getDetails'] = json_encode($customer_details);
                        $this->Transaction->save($details);
                        foreach($transaction as $key => $transactiondatasave){
                            $transactiondatasave['Transaction']['paypalProfileId'] = $response['PROFILEID'];
                            $transactiondatasave['Transaction']['paymentstatus'] = 'paid';
                            $transactiondatasave['Transaction']['id'] = $transactiondatasave['Transaction']['id'];
                            $transactiondatasave['Transaction']['transactionDate'] = date('Y-m-d h:i:s');
                            $transactiondatasave['Transaction']['getDetails'] = json_encode($customer_details);
                            $savetransactions = $this->Transaction->save($transactiondatasave);
                        }
                        $order = array(
                            'id' => $id,
                            'paid' => 1,
                            'finished' => 0,
                            'count' => $count
                        );

                        $save = $this->Order->save($order);
                        $this->Session->setFlash(__('Thank you for your purchase! Check the data you entered. After finalizing you will not able to change the data.'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
                        $this->redirect('/contracts/review_finalize/'.$id);
                    }
                }catch(Exception $e){
                    $this->Session->write('Note.error',$e->getMessage());
                }
            }else{ 
                try{
                    $response = $this->Paypal->doExpressCheckoutPayment();
                    var_dump($response);die;
                    if(strtoupper($response['ACK']) === 'SUCCESS' || strtoupper($response['ACK']) === 'SUCCESSWITHWARNING '){
                        foreach($transaction as $key => $transactiondatasave){
                            $transactiondatasave['Transaction']['paymentstatus'] = 'paid';
                            $transactiondatasave['Transaction']['transactionDate'] = date('Y-m-d h:i:s');
                            $transactiondatasave['Transaction']['getDetails'] = json_encode($customer_details);
                            $savetransactions = $this->Transaction->save($transactiondatasave);
                        }
                        $order = array(
                            'id' => $id,
                            'paid' => 1,
                            'finished' => 0,
                            'count' => $count
                        );

                        $save = $this->Order->save($order);
                        if($save){
                            $order = $this->Order->findById($save["Order"]["id"]);
                            $contractData = $this->Session->read('contract_'.$order["Order"]["contract_id"]);
                            $contractData['Order'] = $order["Order"];
                            $this->Session->write('contract_'.$order["Order"]["contract_id"], $contractData);
                             $this->redirect('/contracts/review_finalize/'.$id);
                        }else{
                            $this->Session->setFlash(__( "Error, Can't save order!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                            $this->redirect('/');
                        }
                        if($contract['Order']['id'] == $save['Order']['id']){

                            $contract['Order'] = $save['Order'];
                            $this->Session->write('contract_'.$id, $contract);
                        }
                        $this->redirect('/contracts/review_finalize/'.$id);
                        //payment was completed successfully
                        $this->Session->setFlash(__('Thank you for your purchase! Check the data you entered. After finalizing you will not able to change the data.'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
                        $this->Session->delete('Dashboard');
                    }
                }catch(Exception $e){
                    $this->Session->setFlash(__( $e->getMessage()), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
                }
            }
        }else{
            $this->Session->setFlash(__( "Can't find order!"), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
        }
        //$this->redirect('/');
    }

    public function cancelPaypal($Invoice = null){

        $userinfo = $this->userDb['User'];
        try{
            $transaction = $this->Transaction->find('first', array(
                'conditions' => array(
                    'user_id' => $userinfo['id'],
                    'paymentstatus' => 'pending',
                    'Invoice' => $Invoice
                )
            ));
            if(!is_null($transaction)){
		$transaction['Transaction']['paymentstatus'] = 'canceled';
                $this->Transaction->save($transaction);
            }
            ///////////////////////////////////////////////
            $this->Session->setFlash(__('You have cancelled the payment!'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
        }catch(Exception $ex){
            echo $ex->getMessage();
            $this->Session->setFlash(__( $ex->getMessage()), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
        }
        $this->redirect('/pages/cart');
    }

    function returnUrl(){
        set_time_limit(60);
        $this->autoRender = false;
        $this->Mailer->paymentDetails($_REQUEST, 'return request');
        $data = $_POST;
        $verify_url = 'https://www.paypal.com/cgi-bin/webscr?cmd=_notify-validate&' . http_build_query($_POST);
        $returned_data = file_get_contents( $verify_url );
        $this->Mailer->paymentDetails($returned_data );
        $this->Mailer->paymentDetails($verify_url);
        
        if($returned_data == "VERIFIED"){
            $order = $this->Transaction->find(
                'all', array(
                    'conditions' => array(
                        'Transaction.Invoice' => $data['invoice'],
                        'Transaction.paymentstatus' => 'paid'
                        ),                        
                    'joins' => array(
                        array(
                            'table' => 'orders',
                            'alias' => 'Order',
                            'type' => 'left',
                            'conditions' => array(
                                'Order.id = Transaction.order_id'
                            )
                        ),
                    ),
                    'fields' => array(
                        'Transaction.*',
                        'Order.*'),
                ));
            if($order){           
                foreach($order as $paiditems){
                    $savePaid['id'] = $paiditems['Order']['id'];
                    $savePaid['paid'] = 1;
                    $orderpaid = $this->Order->save($savePaid);
                }
                
                if($orderpaid){
                    $this->Session->setFlash(__('Thank you for your purchase! Check the data you entered. After finalizing you will not able to change the data.'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));                
                    $this->redirect(array('controller' => 'pages', 'action' => 'order'));
                }
            }
        }
    }

}