<?php
echo $this->Html->script('jquery.validate.min');
echo $this->Html->script('jquery-ui.min');
?>
<section class="visual">
        <div class="visual-holder">
            <img src="/img/img.png" alt="image description">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-5">
                    <!-- tabs area style -->
                    <div class="tabs-area">
                        <div class="head">
                            <h1><?php echo __('Choose a contract');?></h1>
                        </div>
                        <div class="tabs-holder">
                            <header class="tabHeader"><?php echo __('FEATURED CONTRACTS');?></header>
                            <ul class="tabset">
                                <?php for($i = 0 ;$i < 5 ;$i++){?>
                                <?php
                                    if(!isset($featured_contract[$i])){
                                        continue;
                                    }
                                ?>
                                    <li>
                                        <a href="#tab<?php echo $i+1?>">
                                            <?php
                                              
                                                echo $featured_contract[$i]['Contract']['name'];
                                            ?>
                                        </a>
                                    </li>
                               <?php }?>     
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-7 content-box homeCreateContract">
                    <!--<strong class="text">Create and print <br>your contract in<span>15 minutes</span></strong>-->
                    <!-- tab content style -->
                    <div class="tab-content newTabCont">
                        <?php for($i = 0 ;$i < 5 ;$i++){
                            if(!isset($featured_contract[$i])){
                                continue;
                            }
                        ?>
                        <div id="tab<?php echo $i+1?>" class="tab">
                            <header><?php 
                                        if(!isset($featured_contract[$i])){
                                            break;
                                        }
                                        echo $featured_contract[$i]['Contract']['name'];
                                    ?>
                            </header>
                            <div class="tab-holder">
                                <div class="frame">
                                    <div class="icon">
                                        <div class="box">
                                            <div class="holder">
                                                <img src="/system/contracts/<?php echo $featured_contract[$i]['Contract']['file'];?>" alt="image description">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="textbox">
                                        <!--<p><?php // echo $featured_contract[$i]['Contract']['description'];?></p>-->
                                        <p><?php echo __(substr($featured_contract[$i]['Contract']['description'],0,315));
                                            if(strlen($featured_contract[$i]['Contract']['description']) >= 315){
                                                echo '...';
                                            }      
                                        ?>                                            
                                        </p>
                                    </div>
                                </div>
                                <?php if($featured_contract[$i]['Membership']['individual_price']){?>
                                <div class="footer">
                                    <?php if($featured_contract[$i]['Membership']['individual_price'] == 0.00){?>
                                    <span class="freePrice">Free</span>
                                    <?php }else{?>
                                    <span class="price">Only <strong>AED<em>
                                        <?php 
                                            $price = explode('.', $featured_contract[$i]['Membership']['individual_price']);
                                            echo $price[0];
                                        ?>
                                       <sup>.<?php echo $price[1];?></sup></em></strong>(one time) fee</span>
<!--                                    <button class="btn">Get Started!</button>
                                    <button class="btn">
                                        <a href="<?php echo $this->Html->url(array(
                                            'controller' =>'pages',
                                            'action' => 'view_contract',
                                            $featured_contract[$i]['Contract']['id']
                                            )); ?>">
                                            Learn more
                                        </a>
                                    </button>-->
                                    <?php }?>
                                </div>
                                    <?php }?>
                                <div class="footerBtns">                                   
                                    <?php echo $this->Html->link(__('Get Started!'), array(
                                        'controller' =>'contracts',
                                        'action' => 'fill_information/'.preg_replace('/\s+/', '_', strtolower($featured_contract[$i]['Contract']['name'])),
                                    ), array(
                                        "class"=>"btn btn-warning getStartBtn"
                                    ));
                                    ?>
                                    
                                    <!--<button class="btn btn-warning">-->
                                    <a class="btn getStartBtn" href="/<?php echo  preg_replace('/\s+/', '_', strtolower($featured_contract[$i]['Contract']['name']));?>">
                                        Learn more
                                    </a>
                                    <!--</button>-->
                                </div>
                            </div>
                        </div>
                        <?php }?>  
                    </div>
                </div>
            </div>
        </div>
    </section>

<div class="steps-area">      
    <div class="col-md-5 pad0">
        <h1><?php echo __('Registration'); ?></h1>  
        <div class="loginForm">
            <div class="fbLogin">
                <span></span>
                <a href="<?php echo $fb_login; ?>"><?php echo __('Sign Up with Facebook'); ?></a>
            </div>
            <div class="googleplusLogin">
                <span></span>
                <a class='login' href='<?php echo $authUrl; ?>'><?php echo __('Sign up with Google'); ?></a>
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
                    )
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
                        'postal', array(
                    'type' => 'text',
                    'div' => false,
                    'error' => false,        
                    'label' => __('Zip/Postal'),
                    'class' => 'form-control'       
                        )
                );
                ?> 
            </div>
            <div class="form-group"> 
                <?php
                echo $this->Form->input(
                        'company', array(
                    'type' => 'text',
                    'div' => false,
                    'label' => __('Company Name'),
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
            if (isset($contract_id) && isset($membership_id)) {?>         
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
            }
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
                <span class="pull-left"><?php echo __('Already a member?'); ?></span>
                <?php
                echo $this->Html->link(
                        __('Login here'), array(
                    'controller' => 'users',
                    'action' => 'login'
                        ), array('class' => 'forgotLinks')
                );
                ?>
            </div>   
        </div>

<!--        <a href="<?php echo $fb_login; ?>"><?php echo __('Register with Facebook'); ?></a>
<br/>
<a class='login' href='<?php echo $authUrl; ?>'><?php echo __('Register with Google Plus'); ?></a>-->
    </div>
    <div class="col-md-7">
        <div class="questInLogin">
            <h4>Frequently Asked Questions when logging in:</h4>
<?php
if (isset($questions) && $questions) {
    foreach ($questions as $key => $value) {
        ?>
                    <div>
                        <a data-toggle="modal" data-target="#questionModal<?php echo $value['Question']['id']; ?>">
                    <?php echo $value['Question']['question']; ?>
                        </a>
                    </div>
        <?php
    }
}
?>
        </div>
    </div>
    <div class="col-md-7 padRight0">        
        <div class="memberBenefits">
            <h4>Member benefits:</h4>
            <p>It's FREE and easy to sign-up and sign-in.</p>
            <p>Enjoy full access to the website and its features.</p>
            <p>Your work is saved - you can finish it later.</p>
            <p>It's secure and private.</p>
        </div>
    </div>
</div>
<?php
if (isset($questions) && $questions) {
    foreach ($questions as $key => $value) {
        ?>
        <div class="modal fade questionAnswerBox" id="questionModal<?php echo $value['Question']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><!--<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>--></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $value['Question']['question']; ?></h4>
                    </div>
                    <div class="modal-body">
                        <p>
        <?php echo $value['Question']['answer']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<script>
    $(document).ready(function() {
        $("#UserRegistrationForm").validate({
            rules: {
                "data[User][email]": {
                    required: true,
                    email: true
                },
                "data[User][password]": {
                    required: true,
                    minlength: 6,
                },
            },
            messages: {
                "data[User][email]": {
                    email: "Please enter a valid email address"
                },
                "data[User][password]": {
                    minlength: "Password must be minimum 6x characters"
                },
            }
        });

    });

    $(function(){
    //$("body").scrollTop(700);
    $("html, body").animate({ scrollTop: 710 }, 2000);
    });
</script>