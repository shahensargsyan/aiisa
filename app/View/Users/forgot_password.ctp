<div class="steps-area">
    <div class="forgotPswTl">
        <h1><?php echo __('Forgot Password'); ?></h1>
        <!--<div><?php // echo __("Please enter your email address below to reset your password.") ?></div>-->
    </div>
    <div class="col-md-5 pad0">
        <?php
        echo $this->Form->create(
                'User', array(
            'inputDefaults' => array(
                'label' => false,                
                'div' => array('class' => 'controls')
            ),
            'class' => 'recPassForm',
                )
        );
        ?>
        <div class="form-group">        
            <?php
            echo $this->Form->input(
                    'email', array(
                'type' => 'text',
                'id' => "inputEmail",
                'label' => __('Your Email').'*',
                'class' => 'form-control',
//                'label' => false
                    )
            );
            ?>
        </div>
        <div class="form-group">        
            <?php
            echo $this->Form->input(
                    __('Send'), array(
                'type' => 'submit',
                'class' => 'btn',
                'div' => false
                    )
            );
            ?>          
        </div>    
        <?php
        echo $this->Form->end();
        ?>
    </div>                                                                                                                                                     
</div>                     

                                                                                                                         