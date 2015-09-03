<div class="row">
    <header class="page-content-level page-content-header">
        <div class="breadcrumb"><span class="breadcrumb-link breadcrumb-depth-0 breadcrumb-even breadcrumb-first breadcrumb-last"><a href="/">Home</a></span></div>
    </header>
    <section class="page-content-level column page-content-main " id="page-content-main">
        <header class="page-content-container main-title" id="main-title">
            <h1>Become a Member - Add Member Details</h1>
        </header>
        <section class="page-content-container drupal-messages" id="drupal-messages">
        </section>
        <section class="page-content-container main-content" id="main-content">
            <div class="block block-block block-block-23 ">
                <h2 class="title">Please enter the following account information. Required fields are marked with an asterisk.</h2>
                <!--<p><a href="/users/passwordReminder">Password reminder<i class="fa fa-external-link"></i></a></p>-->
            </div>
            <?php
            echo $this->Form->create(
                    'User', array(
                        'inputDefaults' => array(
                            'label' => false
                        ),
                        'id' => "user-login"
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
                        'gender', array(
                            'optopns' => array('female'=>'Female','male'=>'Male'),
                            'div' => false,
                            'label' => __('Gender') . '*',
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
                            'label' => __('Company'),
                            'class' => 'form-control'
                        )
                );
                ?>
            </div>
            <div class="form-group">
                <?php
                echo $this->Form->input(
                        'address1', array(
                            'type' => 'text',
                            'div' => false,
                            'label' => __('Address (Line 1)') . '*',
                            'class' => 'form-control'
                        )
                );
                ?>
            </div>
            <div class="form-group">
                <?php
                echo $this->Form->input(
                        'address2', array(
                            'type' => 'text',
                            'div' => false,
                            'label' => __('Address (Line 1)'),
                            'class' => 'form-control'
                        )
                );
                ?>
            </div>
            <div class="form-group">
                <?php
                echo $this->Form->input(
                        'city', array(
                            'type' => 'text',
                            'div' => false,
                            'label' => __('City') . '*',
                            'class' => 'form-control'
                        )
                );
                ?>
            </div>
            <div class="form-group">
                <?php
                echo $this->Form->input(
                        'country', array(
                            'options' => $countries,
                            'div' => false,
                            'label' => __('Country') . '*',
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
                            'label' => __('Postal Code') . '*',
                            'class' => 'form-control'
                        )
                );
                ?>
            </div>
            <div class="form-group">
                <?php
                echo $this->Form->input(
                        'bate_birth', array(
                            'type' => 'text',
                            'div' => false,
                            'label' => __('Date of Birth') . '*',
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
                            'div' => false,
                            'label' => __('Confirm Password') . '*',
                            'class' => 'form-control'
                        )
                );
                ?>
            </div>
            
            <div class="form-group">
                <?php
                echo $this->Form->input(
                        'phone_number', array(
                            'type' => 'text',
                            'div' => false,
                            'label' => __('Telephone') . '*',
                            'class' => 'form-control'
                        )
                );
                ?>
            </div>
            <div class="form-group">
                <?php
                echo $this->Form->input(
                        'mobile_phone', array(
                            'type' => 'text',
                            'div' => false,
                            'label' => __('Mobile Phone'),
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
                            'div' => false,
                            'label' => __('E-Mail') . '*',
                            'class' => 'form-control'
                        )
                );
                ?>
            </div>
            
            
            <div class='clearfix'></div>
                <?php
                echo $this->Form->input(
                        __('Sign in'), array(
                            'type' => 'submit',
                            'div' => false,
                        )
                );
                ?>
            
                <?php
                echo $this->Form->end();
                ?>
            
        </section>
    </section>
</div>