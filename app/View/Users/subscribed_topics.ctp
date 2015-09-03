<div class="row">
    <header class="page-content-level page-content-header">
    </header>
    <section class="page-content-level column page-content-main " id="page-content-main">
        <header class="page-content-container main-title" id="main-title">
            <h1>Subscribed Topics</h1>
        </header>
        <div class="steps-area">
            <div class="col-md-5 pad0">    
                <?php
                echo $this->Form->Create(
                    'UserTopics', array(
                        'inputDefaults' => array(
                            'div' => false
                        ),
                        'class' => 'recPassForm'
                    )
                );

                echo $this->Form->input('Topics', array(
                        'multiple' => 'checkbox', 
                        'options' => $options, 
                        'selected' => $selected
                    )
                );
                ?>
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
    
