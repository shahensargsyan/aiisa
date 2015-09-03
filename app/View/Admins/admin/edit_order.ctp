<div class="span5 margauto">
    <h3 class="text-center" >Edit Order</h3>
    <hr class="separator">
    <?php
        echo $this->Form->create('Transaction', array('class' => 'form form-horizontal'));
    
        $options = array('paid'=>'paid','pending'=>'pending','canceled'=>'canceled');
        $options1 = array('1'=>'finished','0'=>'pending');
     ?>   
    <div class="control-group">
         <label class="control-label">Status</label>
         <div class="controls">
    <?php
        echo $this->Form->input('paymentstatus' ,array(
            'type' => 'select',
            'label' => false,
            'options' => $options
    ));?>
    </div>
    </div>
    <div class="control-group">
         <label class="control-label">Finished</label>
         <div class="controls">
    <?php
        echo $this->Form->input('finished' ,array(
            'type' => 'select',
            'label' => false,
            'options' => $options1
    ));?>
    </div>
    </div>
    <div class="controls btnSection">        
        <?php
            echo $this->Form->input('Save',
                array(
                    'type'=>'submit',
                    'label'=>false,
                    'controller'=>'admins',
                    'action'=>'edit_order',
                    'class'=>'btn btn-success',
                    'div' => false
                    ));
        
            echo $this->Html->link('Cancel',array('controller'=>'admins','action'=>'orders'),array('class'=>'btn'));
        ?>
    </div>
    <?php        
        echo $this->form->end();
    ?>
</div>