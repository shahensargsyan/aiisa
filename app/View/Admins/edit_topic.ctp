
<div class="span5 margauto">
    <h3 class="text-center">Edit Topic</h3>
    <hr class="separator">
    <?php
    echo $this->Form->Create(
        'Topic', array(
            'inputDefaults' => array(
                'label' => array('class' => 'control-label'),
                'div' => array('class' => 'controls')
            ),
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
                'placeholder' => "Description"
            )
        );
        ?>
    </div>
    
    
    <?php if('Category.active' == 1){ ?>
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
    <?php }else if('Category.active' == 0){ ?>
        <div class="control-group mtop20">
            <label class="control-label">Active</label>
            <?php
            echo $this->Form->input(
                    'active', array(
                'label' => FALSE,
                'options' => array(
                    0 => 'inactive',
                    1 => 'active'
                )
                    )
            );
            ?>
        </div>
    <?php } ?>
    <div class="control-group btnSection"> 
        <label class="control-label"></label>
        <div class="controls">
            <?php
            echo $this->Form->submit(
                'Save', array(
                    'label' => false,
                    'class' => 'btn btn-success',
                    'div' => false
                )
            );
            ?>
            <?php echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'topicTypes'), array('class' => 'btn'));
            ?>
        </div>
    </div>
</div>    

