<div class="span5 margauto">
    <h3 class="text-center">Paypal</h3>
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
            'Paypal', array(
        'inputDefaults' => array(
            'label' => false,
            'div' => false
        ),
        'class' => 'form form-horizontal',
            )
    );
    ?>
    <div class="control-group">
        <label class="control-label" >Webscr</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'webscr', array(
                'type' => 'text',
                'div' => false,
                'error' => false,
                        'value' => $currentData['webscr'],
                'placeholder' => 'https://www.paypal.com/webscr/'
                    )
            );
            ?>
        </div>
    </div> 
    
    <div class="control-group">
        <label class="control-label" >Endpoint</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'endpoint', array(
                'type' => 'text',
                'div' => false,
                'error' => false,
                'value' => $currentData['endpoint'],
                'placeholder' => 'https://api-3t.paypal.com/nvp/'
                    )
            );
            ?>
        </div>
    </div>  
    
    <div class="control-group">
        <label class="control-label" >Email</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'email', array(
                'type' => 'text',
                'div' => false,
                'error' => false,
                'value' => $currentData['email'],
                'placeholder' => 'Email'
                    )
            );
            ?>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" >Password</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'password', array(
                'type' => 'text',
                'div' => false,
                'error' => false,
                'value' => $currentData['password'],
                'placeholder' => 'Password'
                    )
            );
            ?>
        </div>
    </div>   
    
    <div class="control-group">
        <label class="control-label" >Signature</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'signature', array(
                'type' => 'text',
                'div' => false,
                'error' => false,
                'value' => $currentData['signature'],
                'placeholder' => 'Signature'
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
        echo $this->Html->link('Back', array('controller' => 'admins', 'action' => 'payments'), array('class' => 'btn'));
        ?>
    </div>    
</div>