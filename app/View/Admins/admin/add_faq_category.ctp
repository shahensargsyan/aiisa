<div class="span5 margauto">
        <h3 class="text-center" >Add FAQ Category</h3>
        <hr class="separator">
        <?php
        echo $this->Form->create(
                'FaqCategorie', array(
                    'inputDefaults' => array(
                        'label' => false,
                        'div' => false
                    ),
                'class' => 'form form-horizontal', 
                )
        );
        ?>
        <div class="control-group">
            <label class="control-label" >Category</label>
            <div class="controls">
            <?php
            echo $this->Form->input(
                    'category', array(
                        'type' => 'text',
                        'div' => false,
                        'placeholder' => 'Faq Category'
                    )
            );
            ?>
            </div>
        </div>       
           
       <div class="controls btnSection">
            <?php
                echo $this->Form->input(
                    'Add', array(
                        'type' => 'submit',
                        'label' => false, 
                        'div' => false,
                        'class' => 'btn btn-success'
                    )
                );
                echo $this->Html->link('Cancel',array('controller'=>'admins','action'=>'faq_categories'),array('class'=>'btn'));
              ?>
      </div>
      <?php echo $this->Form->end(); ?>
</div>