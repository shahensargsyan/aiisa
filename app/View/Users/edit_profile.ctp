<div class="row">
    <header class="page-content-level page-content-header">
    </header>
    <section class="page-content-level column page-content-main " id="page-content-main">
        <header class="page-content-container main-title" id="main-title">
              <h1>Edit Profile</h1>
        </header>
        <div class="steps-area">
            <div class="col-md-5 pad0">    
              
                <?php
                echo $this->Form->Create(
                        'User', array(
                    'inputDefaults' => array(
                        'div' => false
                    ),
                    'class' => 'recPassForm'
                        )
                );
                echo $this->Form->input('id', array('type' => 'hidden'));
                ?>
                <?php
                echo $this->Form->input(
                    'image', array(
                        'type' => 'hidden',
                        'id' => 'userImage'
                    )
                );
                ?>

                <div class="form-group">                
                    <?php
                    echo $this->Form->input(
                            'first_name', array(
                        'type' => 'text',
                        'label' => 'First Name',
                        'class' => 'form-control'
                            )
                    );
                    ?>
                </div>
                <div class="form-group">                
                    <?php
                    echo $this->Form->input(
                            'last_name', array(
                        'label' => 'Last Name',
                        'type' => 'text',
                        'class' => 'form-control'
                    ));
                    ?>
                </div>

                <div class="form-group">                
                    <?php
                    echo $this->Form->input(
                            'email', array(
                        'label' => "Email",
                        'type' => 'text',
                        'readonly' => 'readonly',
                        'class' => 'form-control'
                    ));
                    ?>
                </div>
                <div class="form-group"> 
                    <?php
                    echo $this->Form->input(
                            'address1', array(
                        'type' => 'text',
                        'div' => false,
                        'label' => __('Address 1'),
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
                        'label' => __('Address 2'),
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
                            'city', array(
                        'type' => 'text',
                        'div' => false,
                        'label' => __('City'),
                        'class' => 'form-control'
                            )
                    );
                    ?> 
                </div>

                <div class="form-group"> 
                    <?php
                    echo $this->Form->input(
                            'state', array(
                        'type' => 'text',
                        'div' => false,
                        'label' => __('State'),
                        'class' => 'form-control'
                            )
                    );
                    ?> 
                </div>
                <div class="form-group countryFld"> 
                    <div class="field-area">
                        <label><?php echo __('Country'); ?></label>
                        <div class="field">
                        <?php
                        echo $this->Form->input(
                                'country', array(
                            'options' => $countries,
                            'div' => false,
                            'label' => false,
                            'class' => 'form-control'
                                )
                        );
                        ?> 
                        </div>
                    </div>
                </div>
                <div class="form-group"> 
                    <?php
                    echo $this->Form->input(
                            'phone_number', array(
                        'type' => 'text',
                        'div' => false,
                        'label' => __('Phone Number'),
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
                    'new_password', array(
                        'label' => __('New Password'),
                        'type' => 'password',
                        'class' => 'form-control'
                    ));
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo $this->Form->input(
                            'confirm_password', array(
                        'label' => __('Confirm New Password'),
                        'type' => 'password',
                        'class' => 'form-control'
                    ));
                    ?>
                </div>

                <div class="form-group">            
                    <?php
                    echo $this->Form->input(
                            'Save', array(
                        'type' => 'submit',
                        'label' => false,
                        'div' => false,
                        'class' => 'btn'
                    ));
                    ?>
                </div>            
                <?php echo $this->Form->end(); ?>       
            </div>
        </div>
    </section>
</div>
    

