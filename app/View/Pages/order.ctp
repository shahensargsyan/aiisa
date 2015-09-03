<!--<a class="chooseTextColorBtn fancybox" href="#payment_type" id="buyButton">Buy</a>-->
<section class="steps-area">
    <h1>Lorem Ipsum</h1>
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
                    <?php
                    $control = 'paypalspro';
                    include_once APP . "Vendor/countries.php";
                    echo $this->Form->create(
                            'Checkout', array(
                        'url' => array('controller' => $control,
                            'action' => 'express_checkout'),
                        'class' => 'checkout',
                        'id' => 'checkoutForm',
                        'fieldset' => false,
                        'type' => 'post'
                            )
                    );
                    ?>
                    <div class="paymentMethod">
                        <?php
                        echo $this->Form->radio('Choose payment methode', array(
                            'paypalpro' => 'Pay via Card',
                            'paypal' => 'Pay via Paypal',
                                ), array(
                            'class' => 'payment_methode',
                            'fieldset' => false,
                            'legend' => false,
                            'value' => 'paypalpro',
                            'name' => 'r_payment_methode'
                        ));
                        ?>
                    </div>

                    <div id="hidePayForm">
                        <div class="field-area">
                            <strong class="label"><label>First Name</label></strong>
                            <div class="field-holder">
                                <div class="field firstNameFld">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'label' => false,
                                        'required' => true,
                                        'div' => false,
                                        'class' => 'form-control'
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="field-area">
                            <strong class="label"><label>Last Name</label></strong>
                            <div class="field-holder">
                                <div class="field firstNameFld">                
                                    <?php
                                    echo $this->Form->input(
                                            'last_name', array(
                                        'label' => false,
                                        'class' => 'form-control',
                                        'required' => true,
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="field-area">
                            <strong class="label"><label>Credit Card Number</label></strong>
                            <div class="field-holder">
                                <div class="field creditCardFld">                
                                    <?php
                                    echo $this->Form->input(
                                            'card_number', array(
                                        'label' => false,
                                        'class' => 'form-control',
                                        'required' => true,
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?php
//    echo $this->Form->input(
//            'first_name', array(
//        'label' => 'First Name',
//        'required' => true,
//                
//    ));
                        ?>


                        <?php
//    echo $this->Form->input(
//            'last_name', array(
//        'label' => 'Last Name',                
//        'class' => 'form-control',
//        'required' => true,        
//    ));
                        ?>  

                        <?php
//    echo $this->Form->input(
//            'card_number', array(
//        'label' => false,                
//        'class' => 'form-control',
//        'required' => true,        
//    ));
                        ?>

                        <div class="creditCardType field-area">
                            <label>Credit Card Type</label>
                            <div>
                                <a href="#" value='Visa' class="visa"></a>
                                <a href="#" value='MasterCard' class="master"></a>
                                <a href="#" value='Amex' class="amex"></a>
                                <a href="#" value='Discover' class="discover"></a>
                            </div>
                        </div>
                        <!--    
                            <div class="field-area state">
                                            
                                            <div class="field-holder">												
                                                    <div class="field">
                                                            <select id="state">
                                                                    <option>Alabama</option>
                                                                    <option>Alaska</option>
                                                                    <option>Arizona</option>
                                                                    <option>Arkansas</option>
                                                                    <option>California</option>
                                                            </select>
                                                    </div>
                                            </div>
                                    </div>-->

                        <div class="field-area state">
                            <strong class="label"><label>Expiration Date</label></strong>
                            <div class="field-holder">
                                <div class="field expDateSize pull-left">
                                    <?php
                                    $month_options = array(
                                        '01' => '01',
                                        '02' => '02',
                                        '03' => '03',
                                        '04' => '04',
                                        '05' => '05',
                                        '06' => '06',
                                        '07' => '07',
                                        '08' => '08',
                                        '09' => '09',
                                        '10' => '10',
                                        '11' => '11',
                                        '12' => '12',
                                    );
                                    echo $this->Form->input(
                                            'month', array(
                                        'type' => 'select',
                                        'label' => false,
                                        'options' => $month_options,
                                        'value' => '01',
                                        'required' => true,
                                    ));
                                    ?>
                                </div>
                                <div class="field expDateSize pull-left">
                                    <?php
                                    $year = date("Y");
                                    $year_options = array();
                                    for($i = 0; $i < 10; $i++){
                                        $year_options[$year + $i] = $year + $i;
                                    }

                                    echo $this->Form->input(
                                            'year', array(
                                        'type' => 'select',
                                        'label' => false,
                                        'class' => 'year country',
                                        'options' => $year_options,
                                        'value' => $year,
                                        'required' => true,
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>


                        <!--    <div class="form-group">
                            <label>Expiration Date</label>
                            
                        <?php
//    $month_options = array(
//        '01' => '01',
//        '02' => '02',
//        '03' => '03',
//        '04' => '04',
//        '05' => '05',
//        '06' => '06',
//        '07' => '07',
//        '08' => '08',
//        '09' => '09',
//        '10' => '10',
//        '11' => '11',
//        '12' => '12',
//    );
//    echo $this->Form->input(
//            'month', array(
//        'type' => 'select',                
//        'label' => false,                
//        'class' => '',
//        'options'=>$month_options,        
//        'value' => '01',
//        'required' => true,        
//    ));
                        ?>
                            </div>-->
                        <div class="form-group">
                            <?php
//    $year = date("Y");
//    $year_options = array();
//    for($i = 0; $i < 10; $i++){
//        $year_options[$year + $i] =  $year + $i;
//    }
//    
//    echo $this->Form->input(
//            'year', array(
//        'type' => 'select',                
//        'label' => false,                
//        'class' => 'year country',
//        'options' => $year_options,        
//        'value' => $year,
//        'required' => true,        
//    ));
                            ?>

                        </div>


                        <div class="field-area">
                            <strong class="label"><label>CSC Code</label></strong>
                            <div class="field-holder">
                                <div class="field cscCode">                
                                    <?php
                                    echo $this->Form->input(
                                            'cvv', array(
                                        'label' => false,
                                        'class' => 'form-control',
                                        'required' => true,
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>


                        <?php
//    echo $this->Form->input(
//            'cvv', array(
//        'label' => 'CSC Code:',                
//        'class' => 'form-control',
//        'required' => true,        
//    ));
                        ?>

                        <div class="field-area add">
                            <strong class="label"><label>Address</label></strong>
                            <div class="field-holder">
                                <div class="field">                
                                    <?php
                                    echo $this->Form->input(
                                            'address', array(
                                        'label' => false,
                                        'class' => 'form-control',
                                        'required' => true,
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="field-area city">
                            <strong class="label"><label>City</label></strong>
                            <div class="field-holder">
                                <div class="field">                
                                    <?php
                                    echo $this->Form->input(
                                            'city', array(
                                        'label' => false,
                                        'class' => 'form-control',
                                        'required' => true,
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="field-area state">
                            <strong class="label"><label>State</label></strong>
                            <div class="field-holder">
                                <div class="field">                
                                    <?php
                                    echo $this->Form->input(
                                            'state', array(
                                        'label' => false,
                                        'class' => 'form-control',
                                        'required' => true,
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="field-area zip-code">
                            <strong class="label"><label>Zip</label></strong>
                            <div class="field-holder">
                                <div class="field">                
                                    <?php
                                    echo $this->Form->input(
                                            'zip', array(
                                        'label' => false,
                                        'class' => 'form-control',
                                        'required' => true,
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>


                        <?php
//    echo $this->Form->input(
//            'address', array(
//        'label' => 'Address',                
//        'class' => 'form-control',
//        'required' => true,        
//    ));
                        ?>


                        <?php
//    echo $this->Form->input(
//            'city', array(
//        'label' => 'City',                
//        'class' => 'form-control',
//        'required' => true,        
//    )); 
                        ?>


                        <?php
//    echo $this->Form->input(
//            'state', array(
//        'label' => 'State',                
//        'class' => 'form-control',
//        'required' => true,        
//    ));
                        ?>


                        <?php
//    echo $this->Form->input(
//            'zip', array(
//        'label' => 'Zip',                
//        'class' => 'form-control',
//        'required' => true,        
//    ));      
                        ?>

                        <div class="form-group">
                            <div class="field-area city">
                                <strong class="label"><label>Country</label></strong>
                                <div class="field-holder">												
                                    <div class="field">
                                        <?php
                                        echo $this->Form->input(
                                                'country', array(
                                            'type' => 'select',
                                            'label' => false,
                                            'class' => 'country countryFld',
                                            'options' => $country_options,
                                            'value' => 'Choose country',
                                            'required' => true,
                                        ));
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fancy_footer">
                        <?php
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
            $(".checkout input").attr("readonly", false);
            $('.country').attr("disabled", false);
            $(".field-area").removeClass('read_only');
            $("#hidePayForm").css("display", "block");
            var r_checked;
            r_checked = $("input[name='r_payment_methode']:checked").val();
            if(r_checked == 'paypal'){
                $("#hidePayForm").css("display", "none");
                $(".checkout input").attr("readonly", true);
                $('.country').attr("disabled", true);
                $("#checkoutForm").attr("action", '/paypals/express_checkout');
                $(".field-area").addClass('read_only');

            }
            if(r_checked == 'paypalpro'){
                $("#checkoutForm").attr("action", '/paypalspro/express_checkout');
            }
        });


    });
</script>