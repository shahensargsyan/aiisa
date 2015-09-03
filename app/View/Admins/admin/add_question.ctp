<div class="span5 margauto">
    <h3 class="text-center" >Add Question</h3>
    <hr class="separator">
    <?php
    echo $this->Form->create(
            'Question', array(
        'inputDefaults' => array(
            'label' => false,
            'div' => false
        ),
        'class' => 'form form-horizontal',
            )
    );
    ?>
    <div class="control-group">
        <label class="control-label" >Question</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'question', array(
                'type' => 'textarea',
                'div' => false,
                'placeholder' => 'Question'
                    )
            );
            ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" >Answer</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'answer', array(
                'type' => 'textarea',
                'div' => false,
                'placeholder' => 'Answer'
                    )
            );
            ?>
        </div>            
    </div>            

    <div class="regMainSec control-group" >
        <label class="control-label" >Contracts</label>
        <div class="controls contractsList">           
            <?php
            $options = array();
            foreach ($data as $category) {
                $options[$category['Contract']['id']] = $category['Contract']['name'];
            }
            echo $this->Form->input('contract_id', array('multiple' => 'checkbox', 'options' => $options));
            ?>          
        </div>
    </div>

    <div class="regMainSec control-group" >
        <label class="control-label" >Faq Category</label>  
        <div class="controls">
            <?php
            $options = array();
            $options[] = '';
            foreach ($faq_categories as $faq_category) {
                $options[$faq_category['FaqCategorie']['id']] = $faq_category['FaqCategorie']['category'];
            }
            echo $this->Form->input('faq_id', array('multiple' => 'radio', 'options' => $options));
            ?>          
        </div>    
    </div>    

    <div class="regMainSec control-group" >
        <label class="control-label">Pages</label>  
        <div class="controls">
            <div class="questSec">
                <?php echo $this->Form->input('help', array('type' => 'checkbox','label' => 'Help'));?>
            </div>
            <div class="questSec">
                <?php echo $this->Form->input('login', array('type' => 'checkbox','label' => 'Log In'));?>
            </div>
            <div class="questSec">
                <?php echo $this->Form->input('sign_up', array('type' => 'checkbox','label' => 'Sign Up'));?>
            </div>
            <?php
//            $options = array('help' =>'Help','login' => 'Log In','sign_up'=>'Sign Up');
//            echo $this->Form->input('pages', array('multiple' => 'checkbox', 'options' => $options));
            ?>          
        </div>    
    </div>
    
    <div class="control-group">
        <label class="control-label" >Status</label>
        <div class="controls">
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
        echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'all_questions'), array('class' => 'btn'));
        ?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>