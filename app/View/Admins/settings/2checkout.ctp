<div class="span5 margauto">
    <h3 class="text-center">2Checkout</h3>
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
            '2checkout', array(
        'inputDefaults' => array(
            'label' => false,
            'div' => false
        ),
        'class' => 'form form-horizontal',
            )
    );
    ?>
    <div class="control-group">
        <label class="control-label" >Sid</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'sid', array(
                'type' => 'text',
                'div' => false,
                'error' => false,
                'value' => $currentData['sid'],
                'placeholder' => 'Sid'
                    )
            );
            ?>
        </div>
    </div> 
    
    <div class="control-group">
        <label class="control-label" >Token</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'token', array(
                'type' => 'text',
                'div' => false,
                'error' => false,
                'value' => $currentData['token'],
                'placeholder' => 'Token'
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