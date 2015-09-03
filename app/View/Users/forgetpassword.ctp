<div class="hidden" id="baseUrl"><?php echo Router::url('/',true);?></div>
<div id="banner">
    <?php echo $this->element('top'); ?> 
    <div class="popup loginPopup ">

        <div class="popupHeader">

            <p class="popupForgot">One More Step To Retrieve Your Password</p>
            <div class="sepAU"></div>

            <a href="/" class="cls_button"></a>
            <?php echo $this->Form->create('User', array('action' => 'forgetpassword')); ?>	
            <div id="loginForm">
                <!--<form>-->
                <label>Enter your username or email address</label>
                <?php echo $this->Form->input('email', array('label' => false,'class'=>'input login','value'=>'', 'div' => false, )); ?>
            </div>

            <div id="loginButtons">
                <?php echo $this->Form->submit('RESET', array('formnovalidate' => true, 'div' => false, 'class' => 'lButton white bfirst', 'id' => 'enterLogin')); ?>
                <a href="/" class="lButton">CANCEL</a>
                <div class="clearfix"></div>
            </div>
            <div class="sepAU"></div>
            <?php echo $this->Form->end();  ?>
        </div>
    </div>
</div>