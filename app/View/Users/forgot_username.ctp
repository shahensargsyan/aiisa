<div class="regform span5 margauto">
    <h3 class="text-center">Send me my username</h3>
    <hr class="separator">
    <?php
    echo $this->Form->create(
            'User', array(
        'inputDefaults' => array(
            'label' => false,
            'div' => array('class' => 'controls')
        ),
        'class' => 'form form-horizontal'
            )
    );
    ?>
    <div class="control-group">
        <label class="control-label">E-Mail</label>
        <?php
        echo $this->Form->input(
                'email', array(
            'label' => FALSE,
            'placeholder' => "email",
            'type' => 'text'
                )
        );
        ?>
    </div>

    <div class="control-group">
        <?php
        echo $this->Form->input(
                'Send', array(
            'type' => 'submit',
            //'label' => 'Password',
            'placeholder' => 'Password',
            'class' => 'btn btn-inverse'
                )
        );
        ?>
    </div>    
    <?php
    echo $this->Form->end();
    ?>
</div>                                                                                                                                                            