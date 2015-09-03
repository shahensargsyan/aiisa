<div class="span5 ">
    <h3 class="text-center">Select Submenu</h3>
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
            'Submenu', array(
                'inputDefaults' => array(
                    'label' => array('class' => 'control-label'),
                    'div' => array('class' => 'controls')),
                'class' => 'form-horizontal'
            )
    );
    ?>

    <div class="control-group">
        <label class="control-label">Select Submenu</label>
        <?php
        echo $this->Form->input(
                'submenus', array(
                    'options' => $data,
                    'multiple' => 'multiple',
                    'label' => FALSE,
                    'selected' => $selected,
                     'size' => "15"
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
        <?php echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'pages'), array('class' => 'btn'));
        ?>
        </div>
    </div>
</div>