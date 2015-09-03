<div class="span5 margauto">
    <h3 class="text-center">Add Expert</h3>
    <hr class="separator">
    
        <?php
        if (isset($error)) { ?>
            <div class="libErrorBox">
            <?php
            echo $error; ?>
            </div>
        <?php
        }
        ?>
    
    <?php
    echo $this->Form->create(
            'Expert', array(
        'inputDefaults' => array(
            'label' => false,
            'div' => false
        ),
        'class' => 'form form-horizontal',
        'enctype' => "multipart/form-data",
            )
    );
    ?>
    <div class="control-group">
        <label class="control-label" ><?php echo __('First name'); ?></label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'first_name', array(
                'type' => 'text',
                'div' => false,
                'error' => false,                
                    )
            );
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" ><?php echo __('Last name'); ?></label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'last_name', array(
                'type' => 'text',
                'error' => false,
                'div' => false
                    )
            );
            ?>            
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputEmail"><?php echo __('Email'); ?></label>   
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'email', array(
                'type' => 'text',
                'id' => "inputEmail",
                'error' => false,
                'div' => false
                    )
            );
            ?>        
        </div>
    </div>
    <div class="control-group"> 
        <label class="control-label"><?php echo __('Address'); ?></label>   
        <div class="controls">
        <?php
        echo $this->Form->input(
                'address', array(
            'type' => 'text',
            'div' => false,
            'error' => false,
            'label' => false            
                )
        );
        ?> 
        </div>
    </div>
    <div class="control-group"> 
        <label class="control-label"><?php echo __('Summary'); ?></label>
        <div class="controls">
        <?php
        echo $this->Form->input(
            'summary', array(
                'type' => 'textarea',
                'div' => false,
                'error' => false,        
                'label' => false,
            )
        );
        ?> 
        </div>
    </div>
    <div class="control-group"> 
        <label class="control-label"><?php echo __('Broadcast experience'); ?></label>
        <div class="controls">
        <?php
        echo $this->Form->input(
            'broadcast_experience', array(
                'type' => 'text',
                'div' => false,
                'error' => false,        
                'label' => false            
            )
        );
        ?> 
        </div>
    </div>
   
    <div class="control-group"> 
        <label class="control-label"><?php echo __('Phone Number'); ?></label>
        <div class="controls">
        <?php
        echo $this->Form->input(
            'phone_number', array(
                'type' => 'text',
                'div' => false,
                'error' => false,        
                'label' => false
            )
        );
        ?> 
        </div>     
    </div>
    <div class="control-group">
        <label class="control-label">Gender</label>
        <div class="controls">
        <?php
        echo $this->Form->input(
            'gender', array(
                'label' => FALSE,
                'options' => array(
                    'male' => 'male',
                    'famele' => 'famele'
                )
            )
        );
        ?>
        </div>
    </div>
<!--    <div class="control-group"> 
        <label class="control-label"><?php echo __('Zip/Postal'); ?></label>
        <div class="controls">
        <?php
        echo $this->Form->input(
                'postal', array(
            'type' => 'text',
            'div' => false,
            'error' => false,        
            'label' => false
                )
        );
        ?> 
        </div>     
    </div>
    <div class="control-group">
        <label class="control-label"><?php echo __('Company Name'); ?></label>
        <div class="controls">
            <?php
                echo $this->Form->input(
                    'summary', array(
                        'type' => 'text',
                        'div' => false,
                        'label' => false,
                        'class' => 'form-control'
                    )
                );
            ?> 
        </div>
    </div> -->
    <div class="control-group mtop20">
        <label class="control-label" for="inputPassword">Password</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'password', array(
                'type' => 'password',
                'error' => false,
                'id' => "inputPassword",
                'div' => false,
                'placeholder' => 'Password'
                    )
            );
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">Confirm password</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'confirm_password', array(
                'type' => 'password',
                'error' => false,
                'id' => "inputPassword",
                'div' => false,
                'placeholder' => 'Confirm Password'
                    )
            );
            ?>
        </div>        
    </div> 
    <div class="control-group btnSection">  
        <label class="control-label"></label>
        <div class="controls">
            <?php
            echo $this->Form->submit(
                    'Add', array(
                'label' => false,
                'class' => 'btn btn-success',
                'div' => false
                    )
            );

            echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'experts'), array('class' => 'btn'));
            ?>
        </div> 
    </div>    
    <?php echo $this->Form->end(); ?>
    <!-- <div class="uploadPhotoSec">            
         <div id="file-uploader">Photo</div>
         <div id="cont" class="uploadedImg"></div>             
     </div>
    -->
</div>