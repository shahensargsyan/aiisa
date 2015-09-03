<div id="div_popup" class="StartPopup timer_form_container popupContainer timer_form_container" style="display: none">
    <div id="fb-root"></div>
        <div class="popupHeader">
            <h2 class="popupH timerH">Feedback</h2>
            <button class="cls_button"  onclick= 'window.location.replace("/");'>X</button>
        </div>

        <div class="sepAU"></div>

        <div id="sendFeedback">
            <p class="feedbackMessageP">Share your meditation session and inspire others:</p>

            <div id="sfIcons">
                
                                    
                <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fmeditationmusic.net%2F&t=Meditation Music"
                onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                target="_blank" title="Share on Facebook"></a>
                <a class="share_button" data-mins="" data-img="/img/feedback_facebook.png" data-name="<?php //echo $name ?>"><? echo $this->Html->image('/img/feedback_facebook.png'); ?></a>

                 <!--<a href="#"><img src="/img/feedback_facebook.png" alt=""></a>-->
                    <a class="tweet" data-mins=""  href="http://satorio.org/" target="_blank"><img src="/img/feedback_twitter.png" alt=""></a>
                    <!--<a data-mins=""  href="http://satorio.org/" target="_blank">><img src="/img/feedback_twitter.png" alt=""></a>-->
                    <div class="tweetShare" style="display:none;">
                            <iframe id="tweet-button" allowtransparency="true" frameborder="0" scrolling="no"
                            src="http://platform.twitter.com/widgets/tweet_button.html?url=http://meditationmusic.net&amp;text=Replace%20Me&amp;count=none"
                            style="width:110px; height:20px;" data-count="none"></iframe>
                    </div> 
                

            </div>

        </div>
        
        <?php echo $this->Form->create('Feedback', array('url' => array('controller' => 'feedbacks'),'id'=>'FeedbackForm','class' => 'feedback_form'));
            echo $this->Form->hidden('Feedback.rating', array('value'=>'5', 'id'=>'rating'));
            echo $this->Form->hidden('Feedback.sessionId2', array('value'=>'', 'id'=>'sessionId2'));
            echo $this->Form->hidden('GuestId', array('value'=> '', 'id'=>'GuestId'));
            ?>
        <?php echo $this->Form->textarea('Feedback.comments', array('class' => 'mInputWhite mTextarea ta maMessage','rows'=>'6','cols'=>'20'));?>
        <!--<textarea class="mInput mTextarea ta maMessage"></textarea>-->
        <div id="sfButtons">
            <?php 
                echo $this->Js->submit( 'SEND', array(
                        'before'	=> 'hideFeedbackButtons()',
                        'update'    => '.feedbackMessageP',
                        'success' 	=> 'submitFeedbackSuccess();',
                        'id'		=> 'submitfeedback',
                        'class' 	=> 'white_btn feedbackButton',
                        'div' => false,
                        'url'       => array('controller'=>'feedbacks','action' => 'submitFeedback')
                    )
                );
                echo $this->Form->submit('CANCEL',array(
                        'class' 	=> 'white_btn feedbackButton', 
                        'id' 		=> 'cancelfeedback', 
                        'title' 	=> 'Cancel',
                        'div' => false,
                    )
                );	 
            ?>
<!--        <button class="white_btn feedbackButton">SEND</button>
            <button class="white_btn feedbackButton">CANCEL</button>-->
        
            <div class='hidden' id='removefeedbacklayer'>
                    <?php echo $this->Form->submit('Close',array('class' => 'white_btn feedbackButton','id' => 'closeFeedbackForm','title' => 'Close','div'	=> array('style' => 'width:100%'))); ?>
            </div>
        </div>
        <?php
        
            echo $this->Form->end();
            echo $this->Js->writeBuffer();
        ?>
</div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
        appId  : '641912699246752',
        status : true, // check login status
        cookie : true, // enable cookies to allow the server to access the session
        xfbml  : true  // parse XFBML
        });
    };

    (function() {
            var e = document.createElement('script');
            e.src = 'http://connect.facebook.net/en_US/all.js';
            e.async = true;
            document.getElementById('fb-root').appendChild(e);

    }());
</script>



<div id="div_popup" class="StartPopup timer_form_container popupContainer timer_form_container" style="display: none">
     <div id="fb-root"></div>
    <div id="StartPopup">
        <div class="timer_container">
                <div id="comment_message" class="timer_text">Feedback</div>
        </div>	
        <div class="timer_counter_container">
                <div id="guest" class="hidden">0</div>
                <?php echo $this->Form->create('Feedback', array('url' => array('controller' => 'feedbacks'),'id'=>'FeedbackForm'));?>
                --Sharing Buttons-------
                <div class="shareMeditation">
                        <div class="sharingbox">
                                Share your meditation session and inspire others:
                        </div>
                        <div class="buttonsSharing">
                                <div class="faceShare">
                                    <script>
                                    window.fbAsyncInit = function() {
                                                                            FB.init({
                                                                            appId  : '641912699246752',
                                                                            status : true, // check login status
                                                                            cookie : true, // enable cookies to allow the server to access the session
                                                                            xfbml  : true  // parse XFBML
                                                                            });
                                    };

                                    (function() {
                                            var e = document.createElement('script');
                                            e.src = 'http://connect.facebook.net/en_US/all.js';
                                            e.async = true;
                                            document.getElementById('fb-root').appendChild(e);

                                    }());
                                    </script>
                                    <?php 
                                    //$name  ="Meditation Music :Join me for a  minute relaxation break";
                                    //$meditation_image ="http://thepandathinks.files.wordpress.com/2013/01/meditation.jpg";
                                    //$meditation_image ="http://satorio.org/img/meditation.jpg";
                                    ?>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fmeditationmusic.net%2F&t=Meditation Music"
                                    onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                    target="_blank" title="Share on Facebook">
                                    <a class="share_button" data-mins="" data-img="<?php echo $meditation_image ?>" data-name="<?php //echo $name ?>"><? echo $this->Html->image('fb.png'); ?></a>
                                </div>
                                <a class="tweet" data-mins=""  href="http://satorio.org/" target="_blank"></a>
                                <div class="tweetShare" style="display:none;">
                                        <iframe id="tweet-button" allowtransparency="true" frameborder="0" scrolling="no"
                                        src="http://platform.twitter.com/widgets/tweet_button.html?url=http://meditationmusic.net&amp;text=Replace%20Me&amp;count=none"
                                        style="width:110px; height:20px;" data-count="none"></iframe>
                                </div> 
                        </div>	--Sharing Buttons-------
                </div>  --Sharing Meditation-------
                -End HERe--
                
                
                
                <?php echo $this->Form->textarea('Feedback.comments', array('rows'=>'6','cols'=>'20'));?>
                <div class="smiles_container">
                        <?php
                        echo $this->Html->link($this->Html->image('smile_big.gif', array('style' => 'margin-top:0px;')), 'javascript:void(0);', array('id'=>'5', 'alt'=>'Big Smile', 'title'=>'Big Smile', 'style'=>'border:2px solid black;', 'onClick'=>'meditationRating(5);', 'escape' => false));
                        echo $this->Html->link($this->Html->image('smile_normal.gif'), 'javascript:void(0);', array('width' => '19px','height' => '19px','id'=>'4', 'alt'=>'Normal Smile', 'title'=>'Normal Smile', 'border'=>'0', 'onClick'=>'meditationRating(4);', 'escape' => false));
                        echo $this->Html->link($this->Html->image('smile_indifferent.gif'), 'javascript:void(0);', array('width' => '19px','height' => '19px','id'=>'3', 'alt'=>'Indifferent', 'title'=>'Indifferent', 'border'=>'0', 'onClick'=>'meditationRating(3);', 'escape' => false));
                        echo $this->Html->link($this->Html->image('smile_confused.gif'), 'javascript:void(0);', array('width' => '19px','height' => '19px','id'=>'2', 'alt'=>'Not Happy', 'title'=>'Not Happy', 'border'=>'0', 'onClick'=>'meditationRating(2);', 'escape' => false));
                        echo $this->Html->link($this->Html->image('smile_frown.gif'), 'javascript:void(0);', array('width' => '19px','height' => '19px','id'=>'1', 'alt'=>'Frown', 'title'=>'Frown', 'border'=>'0', 'onClick'=>'meditationRating(1);', 'escape' => false));	
                        ?>
                </div> 
                <?php if(!$this->Session->check('userId')):?>
                        <div id="registerText">
                                Would you Like to Register? <span class="registerLink link">Click Here</span><br>Don't worry about feedback it will be saved.
                        </div>
                <?php endif;
                echo $this->Form->hidden('Feedback.rating', array('value'=>'5', 'id'=>'rating'));
                echo $this->Form->hidden('Feedback.sessionId2', array('value'=>'', 'id'=>'sessionId2'));
                echo $this->Form->hidden('GuestId', array('value'=> '', 'id'=>'GuestId'));
                ?>
                <div class="submit-container">
                        <?php echo $this->Js->submit( 'Submit', array(
                        'before'	=> 'hideFeedbackButtons()',
                        'update'    => '#comment_message',
                        'success' 	=> 'submitFeedbackSuccess();',
                        'id'		=> 'submitfeedback',
                        'class' 	=> 'button',
                        'url'       => array('controller'=>'feedbacks','action' => 'submitFeedback')
                        ));
                        echo $this->Form->submit('Cancel',array('class' 	=> 'button', 
                        'id' 		=> 'cancelfeedback', 
                        'title' 	=> 'Cancel'));	 
                        ?>
                </div>
                <div class='hidden' id='removefeedbacklayer'>
                <?php echo $this->Form->submit('Close',array('class' => 'button','id' => 'closeFeedbackForm','title' => 'Close','div'	=> array('style' => 'width:100%'))); ?>
                </div>
                <?php	 	 
                echo $this->Form->end();
                echo $this->Js->writeBuffer();
                if(!$this->Session->check('userId')):?>	
                        Start Here
                        <div class="registerbox" style="display:none;">
                        <?php echo $this->Form->create('User',array('action' => 'registerUser')); ?>	
                        <div class="packet_combo">
                        <div class="packet_left">
                        <div class="field_label">Email Address<span class="star">*</span></div>
                        <div class="field"><?php echo $this->Form->input('email', array('label' => false,'class'=>'input_text','required' => true)); ?></div>
                        <span id="emailError" style="color:red;font-size: 12px;"></span>
                        </div>			

                        <div class="packet_right">
                        <div class="field_label">Username<span class="star">*</span></div>
                        <div class="field"><?php echo $this->Form->input('username', array('class'=>'input_text','label' => false)); ?></div>
                        <span id="userError" style="color:red;font-size: 12px;"></span>
                        </div>
                        </div>

                        <div class="packet_combo">
                        <div class="packet_left">
                        <div class="field_label">Password<span class="star">*</span></div>
                        <div class="field"><?php echo $this->Form->input('password', array('class'=>'input_text','label' => false)); ?></div>
                        <span id="passwordError" style="color:red;font-size: 12px;"></span>
                        </div>			

                        <div class="packet_right">
                        <div class="field_label">Confirm Password<span class="star">*</span></div>
                        <div class="field"><?php echo $this->Form->input('password_confirm', array('class'=>'input_text','label' => false,'id'=>'password_confirm','type' => 'password')); ?></div>
                        <span id="cnfPasswordError" style="color:red;font-size: 12px;"></span>
                        </div>
                        </div>
                        <div class="packet_combo">
                        <div class="packet_left">
                        <div class="field_label">City<span class="star">*</span></div>
                        <div class="field"><?php echo $this->Form->input('city', array('class'=>'input_text','label' => false,'id'=>'city')); ?></div>
                        <span id="cityError" style="color:red;font-size: 12px;"></span>
                        </div>		
                        <div class="packet_right">
                        <div class="field_label">Country<span class="star">*</span></div>
                        <div class="field">
                        <?php echo $this->CountryList->select1('User.country',' ',array('class' => 'input_text countryList'),array());
                        ?></div>
                        </div>
                        </div>
                        <div class="packet_combo">
                        <div class="field packet_left" >
                        <?php echo $this->Form->input('term_conditions', array('type'=>'checkbox', 'label'=>__('<span class="terms_condition">Yes, I am agree to the <a href="#">Term & Conditions</a></span>', true), 'hiddenField' => true, 'value' => '0')); ?>
                        </div>
                        <span class="terms_error" style="postion:relative;margin-top:-14px;float:left;color:red;"></span>				
                        </div>
                        <div class="submit-container">
                        <div class="submit">
                        <?php 
                        echo $this->Js->submit( 'Submit', array(
                        'before'	=> 'return submitRegisterValidate();',
                        'update'    => '#comment_message',
                        'success' 	=> 'successRegister();hideFeedbackButtons();',
                        'id'		=> 'submitRegister',
                        'class' 	=> 'button',
                        'div'       =>  false,
                        'url'       => array('controller'=>'users','action' => 'registerUser')
                        ));?>	
                        </div>	
                        <div class="submit">	 	
                        <?php
                        echo $this->Form->button('Cancel',array('class' 	=> 'button',
                         //'before'   => 'removeValidation();',
                         'onClick'	=> 'hideRegisterBox();removeValidation();',
                         'type'     => 'button',
                         'div'       =>  false ));
                        echo $this->Js->writeBuffer();
                        echo $this->Form->end();

                        ?>
                        </div>	
                        </div>	
                        </div>	
                <?php endif;	?>
        </div>
        <div class="clear"></div>
    </div>
</div>