<?php

/**
 * Example usuage of Paypal Component
 *
 */
//App::uses('Paypal', 'Paypal.Lib');

class PaypalsproController extends AppController{

    // Include the Payapl component
    public $components = array('Paypal', 'Mailer'//,'Functions'
    );
    public $uses = array(
        'Transaction',
        'Cart',
        'Order'
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
    public function express_checkout(){
//        $userstats3 = $this->u_id;
        $userinfo = $this->userDb['User'];
        $ItemName = 'Contract'; // Item Name
        $ItemQty = 1;            // Item Quantity
        $Invoice = 'cont' . md5(microtime());
        
        $order_id = 1;
        $data = $this->Order->find(
                'first', 
                array(
                    'conditions' => array(
                      'Order.user_id' => $this->u_id,
                      'Order.id' => $order_id,
                      'Order.paid' => 0,
                    ),
                    'joins' => array(
                        array(
                            'table' => 'contracts',
                            'alias' => 'Contract',
                            'type' => 'left',
                            'conditions' => array(
                                'Contract.id = Order.contract_id'
                            )
                        ),
                    ),
                    'fields' => array(
                        'Contract.*',
                        'Order.*'
                    ),
                )
            );
        $ItemTotalPrice = $data['Contract']['price'];
        
        $expires = $this->request->data['Checkout']['month']. $this->request->data['Checkout']['year'];
        try{

            $this->Paypal->amount = $ItemTotalPrice;
            //$this->Paypal->amount = 400.00;
//            $this->Paypal->currencyCode = 'USD';
            $this->Paypal->returnUrl = Router::url(array('action' => 'confirmPaypal/' . $Invoice . '/' . $ItemTotalPrice), true);
            $this->Paypal->cancelUrl = Router::url(array('action' => 'cancelPaypal/' . $Invoice), true);
            $this->Paypal->notifyUrl = Router::url(array('action' => 'returnUrl'), true);
            $this->Paypal->creditCardType = $this->request->data['Checkout']['card_type'];
            $this->Paypal->creditCardNumber = $this->request->data['Checkout']['card_number'];
            $this->Paypal->creditCardCvv = $this->request->data['Checkout']['cvv'];
            $this->Paypal->creditCardExpires = $expires;
            $this->Paypal->customerFirstName = $this->request->data['Checkout']['first_name'];
            $this->Paypal->customerLastName = $this->request->data['Checkout']['last_name'];
            $this->Paypal->billingAddress1 = $this->request->data['Checkout']['address'];
            $this->Paypal->billingCity = $this->request->data['Checkout']['city'];
            $this->Paypal->billingState = $this->request->data['Checkout']['state'];
            $this->Paypal->billingCountryCode = $this->request->data['Checkout']['country'];
            $this->Paypal->billingZip = $this->request->data['Checkout']['zip'];
            $this->Paypal->ipAddress = $_SERVER['REMOTE_ADDR'];
            $this->Paypal->invoice = $Invoice;
            
            $test = $this->Paypal->doDirectPayment();
            $this->Mailer->paymentDetails($test,'after do direct');
            $newData = array();
            //save to db
            $this->Transaction->create();
            $this->Transaction->save(array(
                'user_id' => $userinfo['id'],
                'order_id' => $data['Order']['id'],
                'paymentstatus' => 'pending',
                'Invoice' => $Invoice,
                'ItemAmount' => $ItemTotalPrice,
                'ItemName' => $ItemName,
                'ItemQTY' => $ItemQty
            ));
            
            if(strtoupper($test['ACK']) === 'SUCCESS' || strtoupper($test['ACK']) === 'SUCCESSWITHWARNING '){
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
            $this->Session->setFlash(__('Payment was completed successfully!'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
        }catch(Exception $e){
            $this->Session->setFlash(__( $e->getMessage()), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));           
        }
        return $this->redirect('/pages/order');
    }

    public function confirmPaypal($Invoice = null, $ItemTotalPrice = null){
     $this->autoRender = false;
        if(!$Invoice){
            $this->redirect('/pages/cart');
            $this->Session->setFlash(__( 'Transaction not found'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
        }
        $userstats3 = $this->userDb['User'];
        //get the transaction
        try{
            $transaction = $this->Transaction->find('all', array(
                'conditions' => array(
                    'user_id' => $userstats3['id'],
                    'paymentstatus' => 'Pending',
                    'Invoice' => $Invoice
                )
            ));
        }catch(Exception $ex){
            $this->Session->setFlash(__( 'Transaction not found!'), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
            $this->redirect('/pages/cart');
        }

        // Token and PayerID will be present in URL
        $this->Paypal->token = $this->request->query['token'];
        $this->Paypal->payerId = $this->request->query['PayerID'];

        // At this point, you can let the customer review their order.
        // Use the "getExpressCheckoutDetails" method to fetch details...
        $customer_details = $this->Paypal->getExpressCheckoutDetails();

        // Then you must call "doExpressCheckoutPayment" to complete the payment
        $this->Paypal->amount = $ItemTotalPrice;
        $this->Paypal->currencyCode = 'USD';
        try{
            $response = $this->Paypal->doExpressCheckoutPayment();

            if(strtoupper($response['ACK']) === 'SUCCESS' || strtoupper($response['ACK']) === 'SUCCESSWITHWARNING '){
                foreach($transaction as $key => $transactiondatasave){
                    $transactiondatasave['Transaction']['paymentstatus'] = 'Paid';
                    $transactiondatasave['Transaction']['transactionDate'] = date('Y-m-d h:i:s');
                    $transactiondatasave['Transaction']['getDetails'] = json_encode($customer_details);
                    $savetransactions = $this->Transaction->save($transactiondatasave);
                }
                //payment was completed successfully
                $this->Session->setFlash(__('Thank you for your purchase! Check the data you entered. After finalizing you will not able to change the data.'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
                $this->Session->delete('Dashboard');
            }
        }catch(Exception $e){
            $this->Session->setFlash(__( $e->getMessage()), 'flash', array('class' => 'danger', 'noteType' => 'bootstrap'));
        }
        $this->redirect('/pages/cart');
    }

    public function cancelPaypal($Invoice = null){

        $userstats3 = $this->userDb['User'];
        try{
            $transaction = $this->Transaction->find('first', array(
                'conditions' => array(
                    'user_id' => $userstats3['id'],
                    'paymentstatus' => 'Pending',
                    'Invoice' => $Invoice
                )
            ));
            if(!is_null($transaction)){
		$transaction['Transaction']['paymentstatus'] = 'CANCELLED';
                $this->Transaction->save($transaction);
            }
            ///////////////////////////////////////////////////
            $user = $this->Transaction->find(
                'all', 
                array(
                    'conditions' => array(
                        'Transaction.Invoice' => $Invoice,
    //                  'Cart.status' => 'NotPaid',
                    ),
                    'joins' => array(
                        array(
                            'table' => 'carts',
                            'alias' => 'Cart',
                            'type' => 'left',
                            'conditions' => array(
                                'Cart.user_postcard_id = Transaction.user_postcard_id'
                            )
                        ),
                    ),
                    'fields' => array(
                        'Transaction.*',
                        'Cart.*'
                    ),
                )
            );
            foreach($user as $key => $paiditems){
		if(isset($paiditems['Cart']['id']) && $paiditems['Cart']['id']){
			$paiditems['Cart']['status'] = 'NotPaid';
		}
                $this->Cart->save($paiditems['Cart']);
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
        $this->Mailer->paymentDetails('Pro');
        $this->Mailer->paymentDetails($_REQUEST);
        $data = $_POST;
        $verify_url = 'https://www.paypal.com/cgi-bin/webscr?cmd=_notify-validate&' . http_build_query($_POST);
        $returned_data = file_get_contents( $verify_url );
        $this->Mailer->paymentDetails($returned_data );
        $this->Mailer->paymentDetails($verify_url);
        
        if($returned_data == "VERIFIED"){
            $user = $this->Transaction->find(
                'all', array(
                    'conditions' => array(
                        'Transaction.Invoice' => $data['invoice'],
                        'Transaction.paymentstatus' => 'Pending'
                        ),
                    'joins' => array(
                        array(
                            'table' => 'user_postcards',
                            'alias' => 'UserPostcard',
                            'type' => 'left',
                            'conditions' => array(
                                'UserPostcard.id = Transaction.user_postcard_id'
                            )
                        ),
                    ),
                    'fields' => array(
                        'Transaction.*',
                        'UserPostcard.*'),
                ));
                $this->Mailer->paymentDetails($user);

                foreach($user as $paiditems){
                    $savePaid['id'] = $paiditems['UserPostcard']['id'];
                    $savePaid['payed'] = 1;
                    $postcardpaid = $this->UserPostcard->save($savePaid);
                    if($postcardpaid){
                        $this->Cart->deleteAll(array('Cart.user_postcard_id' => $paiditems['Transaction']['user_postcard_id']), false);
                    }
                }
                
                if($postcardpaid){
                    $this->Session->setFlash(__('Thank you for your purchase! Check the data you entered. After finalizing you will not able to change the data.'), 'flash', array('class' => 'success', 'noteType' => 'bootstrap'));
                    $this->redirect(array('controller' => 'postcards', 'action' => 'saved'));
                }
        }
    }

}
