<!--<div class="steps-area">
    <div class="quickReg">
   <span> In order to continue please </span>
<?php 
    echo $this->Form->create('User',array(
        'url'=>array('controller'=>'Users','action'=>'registration')
    ));
    echo $this->Form->input('id',array('type'=>'hidden','value'=>$contract_id,'name'=>$membership_id));
    echo $this->Form->submit('Sign Up', array('class' => 'btn', 'div' => false));
    echo $this->Form->end();
//    echo $this->Form->end('Sign Up');
    ?>
    <div class="orBox">or</div>
    <?php
    echo $this->Form->create('User',array(
        'url'=>array('controller'=>'Users','action'=>'login')
    ));
    echo $this->Form->input('id',array('type'=>'hidden','value'=>$contract_id,'name'=>$membership_id));
    echo $this->Form->submit('Log In', array('class' => 'btn', 'div' => false));
    echo $this->Form->end();
?>
</div>

</div>-->

<div class="quickRegBox col-md-6">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="active"><a href="#login" role="tab" data-toggle="tab">Sign In</a></li>
      <li><a href="#signup" role="tab" data-toggle="tab">Sign Up</a></li>  
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="login">
          <div class="loginForm">
                <div class="fbLogin">
                    <span></span>
                    <a href="<?php echo $fb_login; ?>"><?php echo __('Log In with Facebook'); ?></a>                
                </div>
                <div class="googleplusLogin">
                    <span></span>
                    <a class='login' href="<?php echo $login_authUrl; ?>"><?php echo __('Log In with Google'); ?></a>
                </div>
                <div class="text-center loginWithEmail"> 
                    <div></div>
                    <span>or</span> 
                    <div></div>
                </div>

                <?php
                echo $this->Form->create(
                    'User', array(
                        'inputDefaults' => array(
                            'label' => false
                        ),
                        'controller' => 'users',
                        'action' => 'login/'.$contract_id.'/'.$membership_id,
                    )
                );
                ?>
                <div class="form-group"> 
                    <?php
                    echo $this->Form->input(
                            'email', array(
                        'label' => __('Email') . '*',
                        'div' => false,
                        'class' => 'form-control'
                            )
                    );
                    ?>
                </div>
                <div class="form-group"> 
                    <?php
                    echo $this->Form->input(
                            'password', array(
                        'type' => 'password',
                        'label' => __('Password') . '*',
                        'div' => false,
                        'class' => 'form-control'
                            )
                    );
                    ?>
                </div> 


                <div class="rememberMeBox pull-right">
                    <?php
                    echo $this->Form->input(
                            'remember', array(
                        'type' => 'checkbox',
                        'div' => false,
                            )
                    );
                    ?>
                    <?php echo __('Keep me logged in'); ?>                
                </div>
              <?php
                    echo $this->Form->input(
                        'contract_id',array(
                            'type'=>'hidden',
                            'value'=> $contract_id,
                            'name'=> 'contract_id'
                            )
                        );
                    echo $this->Form->input(
                        'membership_id',array(
                            'type'=>'hidden',
                            'value'=> $membership_id,
                            'name'=> 'membership_id'
                            )
                        );
                ?>
                <div class='clearfix'></div>

                <div class="signinBtns">
                    <?php
                    echo $this->Html->link(
                            __('Trouble logging in?'), array(
                        'controller' => 'users',
                        'action' => 'forgotPassword'
                            ), array('class' => 'pull-left')
                    );
                    ?>
                    <?php
                    echo $this->Form->input(
                            __('Sign in'), array(
                        'type' => 'submit',
                        'placeholder' => 'Password',
                        'div' => false,
                        'class' => 'btn pull-right'
                            )
                    );
                    ?>
                </div>
                
                <div class="notMemberBox top30">
                    <span><?php echo __('Not a member?'); ?></span>
                    <?php
                    echo $this->Html->link(
                            __('Sign Up'), array(
                        'controller' => 'users',
                        'action' => 'registration'
                            )
                    );
                    ?>  
                </div>
                <?php
                echo $this->Form->end();
                ?>
            </div>
      </div>
      <div class="tab-pane" id="signup">
          <div class="loginForm">
                <div class="fbLogin">
                    <span></span>
                    <a href="<?php echo $fb_registration; ?>">Sign Up with Facebook</a>
                </div>
                <div class="googleplusLogin">
                    <span></span>
                    <a class="login" href="<?php echo $registration_authUrl; ?>">Sign up with Google</a>
                </div>
                <div class="text-center loginWithEmail"> 
                    <div></div>
                    <span>or</span> 
                    <div></div>
                </div>


                <?php
            echo $this->Form->create(
                'User', array(
                    'inputDefaults' => array(
                        'label' => false,
                        'div' => false
                    ),
                    'controller' => 'users',
                    'action' => 'registration'
                )
            );
            ?>
            <div class="form-group">                                
                <?php
                echo $this->Form->input(
                    'first_name', array(
                        'type' => 'text',
                        'label' => __('First Name') . '*',
                        'div' => false,
                        'class' => 'form-control'
                    )
                );
                ?>
            </div>
            <div class="form-group">     
                <?php
                echo $this->Form->input(
                        'last_name', array(
                    'type' => 'text',
                    'div' => false,
                    'label' => __('Last Name') . '*',
                    'class' => 'form-control'
                        )
                );
                ?>
            </div>
            <div class="form-group"> 
                <?php
                echo $this->Form->input(
                        'email', array(
                    'type' => 'text',
                    'id' => "inputEmail",
                    'div' => false,
                    'label' => __('Email') . '*',
                    'class' => 'form-control'
                        )
                );
                ?> 
            </div>
              
            <div class="form-group"> 
                <?php
                echo $this->Form->input(
                        'password', array(
                    'type' => 'password',
                    'id' => "inputPassword",
                    'div' => false,
                    'label' => __('Password') . '*',
                    'class' => 'form-control'
                        )
                );
                ?>
            </div>
            <div class="form-group"> 
                <?php
                echo $this->Form->input(
                        'confirm_password', array(
                    'type' => 'password',
                    'id' => "inputPassword",
                    'div' => false,
                    'label' => __('Confirm Password') . '*',
                    'class' => 'form-control'
                        )
                );
                ?>
            </div>           
            <?php
                echo $this->Form->input(
                    'contract_id',array(
                        'type'=>'hidden',
                        'value'=> $contract_id,
                        'name'=> 'contract_id'
                        )
                    );
                echo $this->Form->input(
                    'membership_id',array(
                        'type'=>'hidden',
                        'value'=> $membership_id,
                        'name'=> 'membership_id'
                        )
                    );
            ?>

            <div class="signinBtns">
                <?php
                echo $this->Form->input(
                        __('Sign up'), array(
                    'type' => 'submit',
                    'label' => false,
                    'div' => false,
                    'class' => 'btn pull-right'
                        )
                );
                ?>
            </div>
                <?php
                echo $this->Form->end();
                ?>           
                <div class="notMemberBox width201">
                      <span class="pull-left">Already a member?</span>
                      <a href="/users/login" class="forgotLinks">Login here</a>            
                </div>   
            </div>
      </div>
    </div>
</div>
