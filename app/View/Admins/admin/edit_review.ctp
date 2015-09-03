<div class="span5 margauto">
    <h3 class="text-center" >Edit Review</h3>
    <hr class="separator">
    <?php
        if(isset($error)){ ?>
        <div class="libErrorBox">
            <?php   echo $error; ?>
        </div>
        <?php }?>
    <?php
    echo $this->Form->create(
            'Review', array(
        'inputDefaults' => array(
            'label' => false,
            'div' => false
        ),
        'class' => 'form form-horizontal',
            )
    );
    ?>
    <div class="control-group">
        <label class="control-label" >First name</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'first_name', array(
                'type' => 'text',
                'div' => false,
                'error' => false,        
                'placeholder' => 'First Name'
                    )
            );
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" >Last name</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'last_name', array(
                'type' => 'text',
                'div' => false,
                'error' => false,        
                'placeholder' => 'Last Name'
                    )
            );
            ?>            
        </div>
    </div>
<!--    <div class="control-group">
        <label class="control-label" for="inputEmail">Email</label>   
        <div class="controls">
            <?php
            /*echo $this->Form->input(
                    'email', array(
                'type' => 'text',
                'id' => "inputEmail",
                'div' => false,
                'error' => false,        
                'placeholder' => 'Email'
                    )
            );*/
            ?>        
        </div>
    </div>       -->
    <div class="control-group">
        <label class="control-label" >Review</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'review', array(
                'type' => 'textarea',
                'div' => false,
                'error' => false,        
                'placeholder' => 'Review'
                    )
            );
            ?>
        </div>
    </div>       

    <div class="regMainSec control-group" >
        <label class="control-label" >Contracts</label>  
        <div class="controls">
            <?php
            $options = array();
            foreach ($data as $category) {
                $options[$category['Contract']['id']] = $category['Contract']['name'];
            }
            echo $this->Form->input('contract_id', array('multiple' => 'radio', 'options' => $options));
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
        echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'all_reviews'), array('class' => 'btn'));
        ?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>