<div class="span5 margauto">
    <h3 class="text-center">Edit Experience</h3>
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
            'Experience', array(
                'inputDefaults' => array(
                    'label' => array('class' => 'control-label'),
                    'div' => array('class' => 'controls')),
                'class' => 'form-horizontal'
            )
    );
    ?>
    
     <div class="control-group">
        <label class="control-label">Title</label>
        <?php
        echo $this->Form->input(
                'title', array(
                    'type' => 'text',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Title"
                )
        );
        ?>
    </div>
    
    <div class="control-group">
        <label class="control-label">From Date</label>
        <?php
        echo $this->Form->input(
                'from_date', array(
                    'options' => $years,
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "From Date",
                    'id' => "from_date"
                )
        );
        ?>
    </div>
    
    <div class="control-group">
        <label class="control-label">To Date</label>
        <?php
        echo $this->Form->input(
                'to_date', array(
                    'options' => $years,
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "To Date",
                    'id' => "to_date"
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
        <?php echo $this->Html->link('Cancel', array('controller' => 'experts', 'action' => 'experiences'), array('class' => 'btn'));
        ?>
        </div>
    </div>
</div>

