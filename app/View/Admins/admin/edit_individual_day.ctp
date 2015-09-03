<div class="span5 margauto">
    <?php 
        if($input_name == 'day'){?>
            <h3 class="text-center" >Individual contracts modification days allowed</h3>
        <?php }elseif($input_name == 'finished_document'){ ?>
            <h3 class="text-center" >Finished documents will be deleted</h3>
        <?php }elseif($input_name == 'unfinished_document'){ ?>
            <h3 class="text-center" >Unfinished documents will be deleted</h3>
       <?php }?>
        <hr class="separator">
        <?php
        echo $this->Form->create(
                'IndividualDay', array(
                    'inputDefaults' => array(
                        'label' => false,
                        'div' => false
                    ),
                'class' => 'form form-horizontal', 
                )
        );
        ?>
        <div class="control-group">
            <label class="control-label" >Day</label>
            <div class="controls">
            <?php
            echo $this->Form->input(
                    $input_name, array(
                        'type' => 'text',
                        'div' => false,
                        'placeholder' => 'Day'
                    )
            );
            ?>
            </div>
        </div>       
      
       <div class="controls btnSection">
            <?php
                echo $this->Form->input(
                    'Save', array(
                        'type' => 'submit',
                        'label' => false, 
                        'div' => false,
                        'class' => 'btn btn-success'
                    )
                );
                echo $this->Html->link('Cancel',array('controller'=>'admins','action'=>'IndividualDay'),array('class'=>'btn'));
              ?>
      </div>
      <?php echo $this->Form->end(); ?>
</div>