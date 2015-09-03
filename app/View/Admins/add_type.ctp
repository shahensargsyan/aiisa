<div class="span5 margauto">
    <h3 class="text-center">Add Type</h3>
    <hr class="separator">
    
    <div class="control-group">
        <label class="control-label"></label>
        <?php
            if(isset($error)){
                echo $error;
            }
        ?>
    </div>
    
    <?php
    echo $this->Form->Create(
            'Type', array(
                'inputDefaults' => array(
                    'label' => array('class' => 'control-label'),
                    'div' => array('class' => 'controls')),
                'class' => 'form-horizontal'
            )
    );
    ?>
    
     <div class="control-group">
        <label class="control-label">Name</label>
        <?php
        echo $this->Form->input(
                'name', array(
                    'type' => 'text',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Category name"
                )
        );
        ?>
    </div> 
     <div class="control-group">
        <label class="control-label">Description</label>
        <?php
        echo $this->Form->input(
                'description', array(
                    'type' => 'textarea',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Type description"
                )
        );
        ?>
    </div> 
    
     <div class="control-group">
        <label class="control-label">Active</label>
        <?php
        echo $this->Form->input(
            'active', array(
                'label' => FALSE,
                'options' => array(
                    1 => 'active',
                    0 => 'inactive'
                )
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
        <?php echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'types'), array('class' => 'btn'));
        ?>
        </div>
    </div>
</div>