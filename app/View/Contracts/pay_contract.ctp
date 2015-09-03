<!--<a class="chooseTextColorBtn fancybox" href="#payment_type" id="buyButton">Buy</a>-->
<section class="steps-area">
    <h1><?php echo __($contract['name']); ?></h1>
    <?php echo $this->element('document_menu'); ?>

    <div class="block paymentBox">
        <!-- text block style -->
        <div class="text-block">
            <div class="textbox">
                <div class="text">
                    <span class="ico-help">?</span>
                    <h2>Payment</h2>
                </div>

                <div id="payment_type"> <!--style="display: none;"-->
                    <div class="paymentMethod">
                        <?php
                        echo $this->Form->radio(
                            'Choose payment methode', 
                            array(
                                'paypalpro' => 'Pay via Card',
                                'paypal' => 'Pay via Paypal',
                            ),
                            array(
                                'class' => 'payment_methode',
                                'fieldset' => false,
                                'legend' => false,
                                'value' => 'paypalpro',
                                'name' => 'r_payment_methode'
                            ));
                        ?>
                    </div>
                    <?php //var_dump($sid);die; ?>
                    <div id="hidePayForm">
                        <form action='https://sandbox.2checkout.com/checkout/purchase' method='post'>
                            <input type='hidden' name='sid' value='<?php echo $sid; ?>' />
                            <input type='hidden' name='mode' value='2CO' />
                            <input type='hidden' name='li_0_type' value='product' />
                            <input type='hidden' name='li_0_name' value='Monthly Subscription' />
                            <input type='hidden' name='li_0_price' value='1.00' />
                            <input type='hidden' name='order_id' value='<?php echo $order_id; ?>' />
                            <input type='hidden' name='contract_id' value='<?php echo $contract_id; ?>' />
                            <?php if($reccuring){ ?>
                                <input type='hidden' name='li_0_recurrence' value='1 Month' />
                            <?php } ?>
                            <?php if($mode == 'demo'){ ?>
                                <input type='hidden' name='demo' value='Y' />
                            <?php } ?>
                            <input type='hidden' name='x_receipt_link_url' value='http://contracts.dev/contracts/test1' />
                            <input name='submit' type='submit' class="btn" value='Checkout' />
                        </form>
                    </div>
                    <div id="paypall_submit" style="display: none">
                        <div class="fancy_footer">
                            <?php
                            echo $this->Form->create(
                                    'Checkout', array(
                                'url' => array('controller' => 'paypals',
                                    'action' => 'express_checkout/'.$order_id.'/'. $contract_id),
                                'class' => 'checkout',
                                'id' => 'checkoutForm',
                                'fieldset' => false,
                                'type' => 'post'
                                    )
                            );
                            echo $this->Form->input(
                                    'Complete Purchase', array(
                                'type' => 'button',
                                'label' => false,
                                'class' => 'btn',
                                'div' => false,
                            ));
                            ?>
                        </div>
                        <?php
                        echo $this->Form->input(
                                'card_type', array(
                            'type' => 'hidden',
                            'class' => 'card_type',
                            'id' => 'card_type',
                            'required' => true,
                        ));

                        echo $this->Form->end();
                        ?>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
    <?php
//    echo $this->Html->script('jquery-2.1.0.min');
//    echo $this->Html->script('jquery.fancybox');
//    echo $this->Html->css('jquery.fancybox');
    ?>
</section>
<script type="text/javascript">

    $(document).ready(function(){

//        $('.fancybox').fancybox();
        $('#payment_type').show();

        $(".visa").addClass("selectedMethod");
        $('.card_type').val('Visa');
        $('.creditCardType a').click(function(){
            $('.selectedMethod').removeClass('selectedMethod');
            $(this).addClass('selectedMethod');
            $('#card_type').val($(this).attr('value'));
            return false;
        });

        $(".payment_methode").change(function(){
            //$(".checkout input").attr("readonly", false);
            //$('.country').attr("disabled", false);
            //$(".field-area").removeClass('read_only');
            //$("#hidePayForm").css("display", "block");
            //var r_checked;
            r_checked = $("input[name='r_payment_methode']:checked").val();
            if(r_checked == 'paypal'){
                $("#paypall_submit").css("display", "block");
                $("#hidePayForm").css("display", "none");
                //$(".checkout input").attr("readonly", true);
                //$('.country').attr("disabled", true);
                //$("#checkoutForm").attr("action", '/paypals/express_checkout');
                //$(".field-area").addClass('read_only');

            }else{
                $("#paypall_submit").css("display", "none");
                $("#hidePayForm").css("display", "block");
            }
            /*if(r_checked == 'paypalpro'){
                $("#checkoutForm").attr("action", '/paypalspro/express_checkout');
            }*/
        });


    });
</script>


<script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>

<script>
    // Called when token created successfully.
    var successCallback = function(data) {
        var myForm = document.getElementById('myCCForm');

        // Set the token as the value for the token input
        myForm.token.value = data.response.token.token;

        // IMPORTANT: Here we call `submit()` on the form element directly instead of using jQuery to prevent and infinite token request loop.
        myForm.submit();
    };

    // Called when token creation fails.
    var errorCallback = function(data) {
        if (data.errorCode === 200) {
            tokenRequest();
        } else {
            alert(data.errorMsg);
        }
    };

    var tokenRequest = function() {
        // Setup token request arguments
        var args = {
            sellerId: "901255149",
            publishableKey: "19F9627B-52E3-48BA-851E-55BAE38955E6",
            ccNo: $("#ccNo").val(),
            cvv: $("#cvv").val(),
            expMonth: $("#expMonth").val(),
            expYear: $("#expYear").val()
        };

        // Make the token request
        TCO.requestToken(successCallback, errorCallback, args);
    };

    $(function() {
        // Pull in the public encryption key for our environment
        TCO.loadPubKey('sandbox');

        $("#myCCForm").submit(function(e) {
            // Call our token request function
            tokenRequest();

            // Prevent form from submitting
            return false;
        });
    });
</script>