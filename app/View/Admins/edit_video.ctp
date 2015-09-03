<div class="span10 margauto">
    <h3 class="text-center">Edit Video</h3>
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
            'Video', array(
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
                'content', array(
                    'type' => 'textarea',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Video content"
                )
        );
        ?>
    </div>
   
    <div class="control-group">
        <label class="control-label">Link</label>
        <?php
        echo $this->Form->input(
                'link', array(
                    'type' => 'text',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Link"
                )
        );
        ?>
    </div>
    
    <div class="control-group">
        <label class="control-label">Select Topic</label>
        <?php
        echo $this->Form->input(
                'topic_id', array(
                    'options' => $topics,
                    'label' => FALSE,
                    'empty' => "Select Topic"
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Select Region</label>
        <?php
        echo $this->Form->input(
                'region_id', array(
                    'options' => $regions,
                    'label' => FALSE,
                    'empty' => "Select Region"
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Select Program</label>
        <?php
        echo $this->Form->input(
                'program_id', array(
                    'options' => $programs,
                    'label' => FALSE,
                    'empty' => "Select Program"
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Select Project</label>
        <?php
        echo $this->Form->input(
                'project_id', array(
                    'options' => $projecrs,
                    'label' => FALSE,
                    'empty' => "Select Project"
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
            'Edit', array(
                'label' => false,
                'div' => FALSE,
                'class' => 'btn btn-success'
            )
        );
        ?>
        <?php echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'videos'), array('class' => 'btn'));
        ?>
        </div>
    </div>
</div>
