<!--Contact us page-->
<?php
//$this->Html->scriptStart(array('inline' => false));
?>
<!--$(document).ready(function($){
    $.jGrowl("<?php //echo 'another'   ?>",{theme:"<?php // echo 'class';   ?>"});
})-->
<?php
//$this->Html->scriptEnd();
?>


<div class="steps-area contactUsBox">      
    <div class="col-md-5 pad0">
        <h1><?php echo __('Contact us'); ?></h1>          
        <?php
        echo $this->Form->create(
                'Contact', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            ),
            'class' => 'recPassForm contactUs'
                )
        );
        ?>
        <div class="form-group">                                
            <?php
            echo $this->Form->input(
                    'first_name', array(
                'type' => 'text',
                'label' => __('Name') . '*',
                'div' => false,
                'error' => false,
                'class' => 'form-control'
                    )
            );
            ?>
        </div>
        <div class="form-group"> 
            <?php
            echo $this->Form->input(
                    'email', array(
                'type' => 'text',
                'id' => "inputEmail",
                'div' => false,
                'error' => false,
                'label' => __('Email') . '*',
                'class' => 'form-control'
                    )
            );
            ?> 
        </div>
        <div class="form-group">
            <div class="field-area">
                <label><?php echo __('Subject') . '*'; ?></label>
                <div class="field-holder">
                    <div class="field">
                        <?php
                        $options = array(
                            'Sales' => 'Sales',
                            'TechnicalSupport' => 'Technical Support',
                            'BillingSupport' => 'Billing Support',
                            'LegalSupport' => 'Legal Support',
                            'Feedback' => 'Feedback',
                            'BugRreport' =>'Bug Report'
                        );
                        echo $this->Form->input('subject', array(
                            'type' => 'select',
                            'options' => $options,
                            'label' => false,
                            'error' => false,
                            'div' => false,
                            'class' => 'form-control'
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>        
        <div class="form-group"> 
            <?php
            echo $this->Form->input(
                    'phone_number', array(
                'type' => 'text',
                'div' => false,
                'error' => false,
                'label' => __('Phone'),
                'class' => 'form-control'
                    )
            );
            ?> 
        </div>  
        <div class="form-group"> 
            <?php
            echo $this->Form->input(
                    'text', array(
                'type' => 'textarea',
                'div' => false,
                'error' => false,
                'label' => __('Message') . '*',
                'class' => 'form-control'
                    )
            );
            ?> 
        </div>
        <?php echo $this->element("captcha"); ?>
        <?php
        echo $this->Form->input(
                __('Send'), array(
            'type' => 'submit',
            'label' => false,
            'div' => false,
            'class' => 'btn'
                )
        );
        echo $this->Form->end();
        ?>    
    </div>
    
    
    <div class="col-md-7 padRight0 padLeft50">
        <div class="contactInfoBox">
        <?php 
            if(isset($contact_us)){
                echo $contact_us;
            }
        ?>
        </div>
    </div>
</div>
