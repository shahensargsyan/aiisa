<?php echo $this->Session->flash(); ?>
<div class="top50 span5 margauto">
    <h3 class="text-center">Admin Sign In</h3>
    <hr class="separator">
    <?php
    echo $this->Form->create(
            'Admin', array(
        'inputDefaults' => array(
            'label' => false,
            'div' => array('class' => 'controls')
        ),
        'class' => 'form form-horizontal'
            )
    );
    ?>
    <div class="control-group">
        <label class="control-label" >Username</label>
        <?php
        echo $this->Form->input(
                'username', array(
            //'label' => 'Username',
            'placeholder' => "Username"
                )
        );
        ?>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputPassword">Password</label>
        <?php
        echo $this->Form->input(
                'password', array(
            'type' => 'password',
            //'label' => 'Password',
            'placeholder' => 'Password'
                )
        );
        ?>
    </div>    
    <div class="control-group">
        <?php
        echo $this->Form->input(
                'Sign in', array(
            'type' => 'submit',
            //'label' => 'Password',
            'placeholder' => 'Password',
            'class' => 'btn btn-success'
                )
        );
        ?>
    </div>    
    <?php
    echo $this->Form->end();
    ?>

</div>                                                                                                                                                                                                                                                                                                               