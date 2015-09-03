<div class="span5 margauto">
    <h3 class="text-center">Blocked IP or Email</h3>
    <hr class="separator">
    <?php
    echo $this->Form->Create(
            'block', array(
        'inputDefaults' => array(
            'label' => array('class' => 'control-label'),
            'div' => array('class' => 'controls')),
        'class' => 'form-horizontal'
            )
    );
    ?>
    <div class="control-group">
        <label class="control-label">IP Address</label>
        <?php 
            $options = array('ip'=>'IP address','email'=>'email address');
            echo $this->Form->input('type',array('multiple' => 'radio', 'options' => $options,'label'=>false));
        ?>
    </div>
    
     <div class="control-group">
        <label class="control-label">Blocked IP or Email</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'blocked_params', array(
                'type' => 'text',
                'label' => FALSE,  
                'div' => false
                    )
            );
            ?>
            <div class="errorIP">        
            <?php
                if(isset($errors)){
                    echo $errors;
                }
            ?>
            </div>
        </div>
    </div>
     <div class="control-group">
        <label class="control-label">Reason</label>
        <?php
        echo $this->Form->input(
                'reason', array(
            'type' => 'textarea',
            'label' => FALSE,  
                )
        );
        ?>
    </div>       
    <div class="control-group btnSection">  
        <label class="control-label"></label>
        <div class="controls">
        <?php
        echo $this->Form->submit(
                'Add', array(
            'label' => false,
            'div' => FALSE,
            'class' => 'btn btn-success'
                )
        );
        ?>
        <?php echo $this->Html->link('Cancel',  Controller::referer(), array('class' => 'btn'));
        ?>
        </div>
    </div>
</div>