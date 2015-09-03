<div class="row">
    <header class="page-content-level page-content-header">
        <div class="breadcrumb"><span class="breadcrumb-link breadcrumb-depth-0 breadcrumb-even breadcrumb-first breadcrumb-last"><a href="/">Home</a></span></div>
    </header>
    <section class="page-content-level column page-content-main " id="page-content-main">
        <header class="page-content-container main-title" id="main-title">
            <h1> Login</h1>
        </header>
        <section class="page-content-container drupal-messages" id="drupal-messages">
        </section>
        <section class="page-content-container main-content" id="main-content">
            <div class="block block-block block-block-23 ">
                <h2 class="title">Forgot your password?</h2>
                <p><a href="/users/passwordReminder">Password reminder<i class="fa fa-external-link"></i></a></p>
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
                        'email', array(
                            'label' => __('Email') . '*',
                            'div' => false,
                            'class' => 'form-control',
                            'size' => "30",
                            'maxlength' => "128",
                            'autocomplete' => "off"
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
                            'size' => "30",
                            'maxlength' => "128",
                            'autocomplete' => "off"
                        )
                );
                ?>
            </div> 

            <div class='clearfix'></div>

   
                <?php
                echo $this->Form->input(
                        __('Sign in'), array(
                            'type' => 'submit',
                            'placeholder' => 'Password',
                            'div' => false,
                            'id' => "edit-submit"
                        )
                );
                ?>
            
                <?php
                echo $this->Form->end();
                ?>
            
        </section>
    </section>
</div>