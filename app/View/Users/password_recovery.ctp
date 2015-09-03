<div class="steps-area">    
    <div class="forgotPswTl">
        <h1><?php echo __('Recover Password'); ?></h1>        
    </div>
    <div class="col-md-5 pad0">
        <?php
        echo $this->Form->Create(
                'User', array(
            'inputDefaults' => array(
                'label' => array('class' => 'control-label'),
                'div' => array('class' => 'controls')
            ),
            'class' => 'recPassForm'
                )
        );
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo $this->Form->input('token', array('type' => 'hidden'));
        ?>    
        <div class="form-group">  
            <?php
            echo $this->Form->input(
                    'new_password', array(
                'label' => __('Password') . '*',
                'type' => 'password',
                'class' => 'form-control'
                    )
            );
            ?>
        </div>
        <div class="form-group">  
            <?php
            echo $this->Form->input(
                    'confirm_password', array(
                'label' => __('Confirm Password') . '*',
                'type' => 'password',
                'class' => 'form-control'
                    )
            );
            ?>
        </div>
        <?php echo $this->Form->input('provider_id', array('type' => 'hidden')); ?>
        <div class="form-group">  
            <?php
            echo $this->Form->input(
                    'Save', array(
                'type' => 'submit',
                'label' => false,
                'class' => 'btn',
                'div' => false
                    )
            );
            ?>            
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

