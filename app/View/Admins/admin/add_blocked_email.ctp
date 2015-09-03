<div class="regform span5 margauto">
    <h3 class="text-center">Add email</h3>
    <hr class="separator">
    <?php
    echo $this->Form->Create(
            'BlockedEmail', array(
        'inputDefaults' => array(
            'label' => array('class' => 'control-label'),
            'div' => array('class' => 'controls')),
        'class' => 'form-horizontal'
            )
    );
    ?>
    
     <div class="control-group">
        <label class="control-label">Email</label>
        <?php
        echo $this->Form->input(
                'email_address', array(
            'type' => 'text',
            'label' => FALSE,
            'placeholder' => "Email"
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
            'class' => 'btn btn-inverse'
                )
        );
        ?>
        <?php echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'blockedEmails'), array('class' => 'btn'));
        ?>
        </div>
    </div>
</div>