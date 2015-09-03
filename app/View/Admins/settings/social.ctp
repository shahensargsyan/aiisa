<div class="span5 margauto">
    <h3 class="text-center">Social Settings</h3>
    <hr class="separator">
    <?php
        if(isset($error)){ ?>
            <div class="libErrorBox">
                <?php echo $error; ?>
            </div>
        <?php } 
    ?>
    <?php
    $currentData = json_decode($data['Setting']['data'], true);
    echo $this->Form->create(
            'Social', array(
        'inputDefaults' => array(
            'label' => false,
            'div' => false
        ),
        'class' => 'form form-horizontal',
            )
    );
    ?>
    <div class="control-group">
        <label class="control-label" >Facebook</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'facebook', array(
                'type' => 'text',
                'div' => false,
                'error' => false,
                        'value' => $currentData['facebook'],
                'placeholder' => 'https://facebook.com/'
                    )
            );
            ?>
        </div>
    </div> 
    
    <div class="control-group">
        <label class="control-label" >Linked-in</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'linked_in', array(
                'type' => 'text',
                'div' => false,
                'error' => false,
                'value' => $currentData['linked_in'],
                'placeholder' => 'https://linkedin.com/'
                    )
            );
            ?>
        </div>
    </div>  
    
    <div class="control-group">
        <label class="control-label" >Twitter</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'twitter', array(
                'type' => 'text',
                'div' => false,
                'error' => false,
                'value' => $currentData['twitter'],
                'placeholder' => 'https://twitter.com'
                    )
            );
            ?>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" >Google Plus</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'google_plus', array(
                'type' => 'text',
                'div' => false,
                'error' => false,
                'value' => $currentData['google_plus'],
                'placeholder' => 'https://google.com/'
                    )
            );
            ?>
        </div>
    </div>   
    <div class="controls btnSection">
        <?php
        echo $this->Form->submit(
                'Save', array(
            'label' => false,
            'div' => false,
            'class' => 'btn btn-success'
                )
        );
        echo $this->Html->link('Back', array('controller' => 'admins', 'action' => 'SocialSettings'), array('class' => 'btn'));
        ?>
    </div>    
</div>