<div class="row">
    <header class="page-content-level page-content-header">
        <div class="breadcrumb"><span class="breadcrumb-link breadcrumb-depth-0 breadcrumb-even breadcrumb-first"><a href="/">Home</a></span><i class="fa fa-angle-right"></i><span class="breadcrumb-link breadcrumb-depth-1 breadcrumb-odd breadcrumb-last">E-newsletter subscriptions</span></div>
        <div class="tabs">
        </div>
    </header>
    <section class="page-content-level column page-content-main " id="page-content-main">
        <header class="page-content-container main-title" id="main-title">
            <h1> E-newsletter subscriptions</h1>
        </header>
        <section class="page-content-container drupal-messages" id="drupal-messages">
        </section>
        <section class="page-content-container main-content" id="main-content">
            <div class="ds-1col node node-webform view-mode-full clearfix">
                <div class="field field-name-field-intro"><p>Sign up for AIISA email newsletters:</p></div>
                <!--<form class="webform-client-form" enctype="multipart/form-data" action="/forms/e-newsletter-subscriptions" method="post" id="webform-client-form-9075" accept-charset="UTF-8" role="form">-->
                    <?php
                    echo $this->Form->create(
                            'EmailSubscription', array(
                                'inputDefaults' => array(
                                    'label' => false
                                ),
                                'id' => "user-login"
                            )
                        );
                    ?>
                    <div class="form-item webform-component webform-component-email" id="webform-component-email-address">
                        <label for="edit-submitted-email-address"><?php echo __('Email address:') ?>
                            <span class="form-required" title="This field is required.">*</span>
                        </label>
<!--                        <input class="email form-text form-email required" type="email" id="edit-submitted-email-address" name="submitted[email_address]" size="60" autocomplete="off">-->
                        <?php
                            echo $this->Form->input(
                                    'email', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'form-control',
                                        'size' => "30",
                                        'maxlength' => "128",
                                        'autocomplete' => "off"
                                    )
                            );
                            ?>
                    </div>
                    <div class="form-item webform-component webform-component-textfield" id="webform-component-first-name">
                        <label for="edit-submitted-first-name">
                            <?php echo __('First Name:') ?> <span class="form-required" title="This field is required.">*</span>
                        </label>
                        <!--<input type="text" id="edit-submitted-first-name" name="submitted[first_name]" value="" size="30" maxlength="128" required="" autocomplete="off">-->
                        <?php
                            echo $this->Form->input(
                                    'first_name', array(
                                        'type' => 'text',
                                        'label' => FALSE,
                                        'div' => false,
                                        'class' => 'form-control'
                                    )
                            );
                            ?>
                    </div>
                    <div class="form-item webform-component webform-component-textfield" id="webform-component-surname">
                        <label for="edit-submitted-surname">
                            <?php echo __('Last Name:') ?> <span class="form-required" title="This field is required.">*</span>
                        </label>
                        <!--<input type="text" id="edit-submitted-surname" name="submitted[surname]" value="" size="30" maxlength="128" required="" autocomplete="off">-->
                        <?php
                            echo $this->Form->input(
                                    'last_name', array(
                                        'type' => 'text',
                                        'div' => false,
                                        'label' => FALSE,
                                        'class' => 'form-control'
                                    )
                            );
                            ?>
                    </div>
                        

                        
                    <div class="form-actions form-wrapper" id="edit-actions">
                       <?php
                        echo $this->Form->input(
                                __('Submit'), array(
                                    'type' => 'submit',
                                    'div' => false,
                                )
                        );
                        ?>
                    </div>
                <?php
                    echo $this->Form->end();
                ?>
<!--                    <div class="form-item webform-component webform-component-checkboxes" id="webform-component-newsletters">
                        <label>Newsletters <span class="form-required" title="This field is required.">*</span></label>
                        <div id="edit-submitted-newsletters" class="form-checkboxes">
                            <div>
                                <input type="checkbox" id="edit-submitted-newsletters-1" name="submitted[newsletters][1]" value="1" autocomplete="off"> <label class="option" for="edit-submitted-newsletters-1">Chatham House Newsletter (weekly) </label>
                            </div>
                            <div>
                                <input type="checkbox" id="edit-submitted-newsletters-2" name="submitted[newsletters][2]" value="2" autocomplete="off"> <label class="option" for="edit-submitted-newsletters-2">Africa Programme </label>
                            </div>
                            <div>
                                <input type="checkbox" id="edit-submitted-newsletters-3" name="submitted[newsletters][3]" value="3" autocomplete="off"> <label class="option" for="edit-submitted-newsletters-3">Asia Programme </label>
                            </div>
                            <div>
                                <input type="checkbox" id="edit-submitted-newsletters-4" name="submitted[newsletters][4]" value="4" autocomplete="off"> <label class="option" for="edit-submitted-newsletters-4">Energy, Environment and Resources </label>
                            </div>
                            <div>
                                <input type="checkbox" id="edit-submitted-newsletters-5" name="submitted[newsletters][11]" value="11" autocomplete="off"> <label class="option" for="edit-submitted-newsletters-5">Forest Governance Project </label>
                            </div>
                            <div>
                                <input type="checkbox" id="edit-submitted-newsletters-6" name="submitted[newsletters][5]" value="5" autocomplete="off"> <label class="option" for="edit-submitted-newsletters-6">Global Health Security </label>
                            </div>
                            <div>
                                <input type="checkbox" id="edit-submitted-newsletters-7" name="submitted[newsletters][6]" value="6" autocomplete="off"> <label class="option" for="edit-submitted-newsletters-7">International Law </label>
                            </div>
                            <div>
                                <input type="checkbox" id="edit-submitted-newsletters-8" name="submitted[newsletters][7]" value="7" autocomplete="off"> <label class="option" for="edit-submitted-newsletters-8">International Security </label>
                            </div>
                            <div>
                                <input type="checkbox" id="edit-submitted-newsletters-9" name="submitted[newsletters][8]" value="8" autocomplete="off"> <label class="option" for="edit-submitted-newsletters-9">Middle East and North Africa Programme </label>
                            </div>
                            <div>
                                <input type="checkbox" id="edit-submitted-newsletters-10" name="submitted[newsletters][9]" value="9" autocomplete="off"> <label class="option" for="edit-submitted-newsletters-10">Russia and Eurasia Programme </label>
                            </div>
                            <div>
                                <input type="checkbox" id="edit-submitted-newsletters-11" name="submitted[newsletters][12]" value="12" autocomplete="off"> <label class="option" for="edit-submitted-newsletters-11">US Project </label>
                            </div>
                            <div>
                                <input type="checkbox" id="edit-submitted-newsletters-12" name="submitted[newsletters][10]" value="10" autocomplete="off"> <label class="option" for="edit-submitted-newsletters-12">Yemen Forum </label>
                            </div>
                            <div>
                                <input type="checkbox" id="edit-submitted-newsletters-13" name="submitted[newsletters][13]" value="13" autocomplete="off"> <label class="option" for="edit-submitted-newsletters-13">Academy for Leadership in International Affairs </label>
                            </div>
                            <div>
                                <input type="checkbox" id="edit-submitted-newsletters-14" name="submitted[newsletters][14]" value="14" autocomplete="off"> <label class="option" for="edit-submitted-newsletters-14">International Affairs journal </label>
                            </div>
                        </div>
                    </div>-->
            </div>
        </section>
    </section>
</div>