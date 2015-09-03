<div class="regform span5 margauto">
    <h3 class="text-center">Add form input name</h3>
    <hr class="separator">
    <?php if(isset($error)){ ?>
        <div class="libErrorBox">
            <?php   echo $error; ?>
        </div> <?php }?>
    <?php
    echo $this->Form->Create(
            'FormId', array(
        'inputDefaults' => array(
            'label' => array('class' => 'control-label'),
            'div' => array('class' => 'controls')),
        'class' => 'form-horizontal'
            )
    );
    ?>
     <div class="control-group">
        <label class="control-label">Form input name</label>
        <div class="controls">
        <?php
        echo $this->Form->input(
                'form_id', array(
            'type' => 'text',
            'label' => FALSE,
            'error' => false,       
                    'div' => false
//            'placeholder'=>'Add form id'        
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
            'div' => FALSE,
            'class' => 'btn btn-success'
                )
        );
        echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'all_forms'), array('class' => 'btn'));
        ?>
        </div>
    </div>
</div>