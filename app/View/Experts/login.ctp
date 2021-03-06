<section id="page-content" class="page-level page-content">
    <div class="wrapper">
        <div class="row">
            <header class="page-content-level page-content-header">
                <div class="breadcrumb">
                    <span class="breadcrumb-link breadcrumb-depth-0 breadcrumb-even breadcrumb-first breadcrumb-last">
                        <a href="/">Home</a>
                    </span>
                </div>
            </header>
            <section class="page-content-level column page-content-main " id="page-content-main">
                <header class="page-content-container main-title" id="main-title">
                    <h1>Expert Login</h1>
                </header>
                <section class="page-content-container drupal-messages" id="drupal-messages"></section>
                <section class="page-content-container main-content" id="main-content">
                    <div class="block block-block block-block-23 ">
                        <h2 class="title">Forgot your password?</h2>
                        <p>
                            <a href="/experts/passwordReminder">
                                Password reminder<i class="fa fa-external-link"></i>
                            </a>
                        </p>
                    </div>
                <?php //echo $this->Session->flash(); ?>
                <div class="top50 span5 margauto">
<!--                    <h3 class="text-center">Admin Sign In</h3>
                    <hr class="separator">-->
                    <?php
                    echo $this->Form->create(
                            'Expert', array(
                                'inputDefaults' => array(
                                    'label' => false,
                                    'div' => array('class' => 'controls')
                                ),
                                'class' => 'form form-horizontal'
                            )
                    );
                    ?>
                    <div class="control-group">
                        <label class="control-label" >E-mail address</label>
                        <?php
                        echo $this->Form->input(
                                'email', array(
                            //'label' => 'Username',
                            'placeholder' => "E-mail address"
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
<!--                    <form action="/user" method="post" id="user-login" accept-charset="UTF-8" role="form">
                        <div class="form-required">
                            <label for="edit-name">E-mail address <span class="form-required" title="This field is required.">*</span></label>
                            <input placeholder="Email address" type="text" id="edit-name" name="name" value="" size="30" maxlength="60" required="" autocomplete="off">
                        </div>
                        <div class="form-required">
                            <label for="edit-pass">Password <span class="form-required" title="This field is required.">*</span></label>
                            <input placeholder="Password" type="password" id="edit-pass" name="pass" size="30" maxlength="128" autocomplete="off">
                        </div>
                        <input type="hidden" name="form_build_id" value="form-7zLMP2_nYp3R2tjSOUHvPaE9RvGYmX_8JpMU842qvTk" autocomplete="off">
                        <input type="hidden" name="form_id" value="user_login" autocomplete="off">
                        <div class="form-actions form-wrapper" id="edit-actions">
                            <input type="submit" id="edit-submit" name="op" value="Log in" autocomplete="off">
                        </div>
                    </form>  -->
                </section>
            </section>
        </div>
    </div>
</section>