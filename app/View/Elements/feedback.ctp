<div id="div_popup" class="StartPopup timer_form_container popupContainer timer_form_container zoom" style="display: none">
    <?php if($this->Session->check('userId')){ ?>
        <div class="popupHeader">
            <h2 class="popupH timerHead">Inspire Others</h2>
            <button class="cls_button"  onclick= 'window.location.replace("/");'></button>
        </div>

        <div class="sepAU"></div>

        <div id="sendFeedback">
            <p class="feedbackMessageP">Share your meditation with others and inspire them to meditate and help end world hunger:</p>
             <div id="fb-root"></div>
            <div id="sfIcons">                    
                <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fmeditationmusic.net%2F&t=Meditation Music"
                onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                target="_blank" title="Share on Facebook"></a>
                <a class="share_button" data-mins="" data-img="/img/feedback_facebook.png" data-name="<?php //echo $name ?>"><?php echo $this->Html->image('/img/feedback_facebook.png'); ?></a>

                 <!--<a href="#"><img src="/img/feedback_facebook.png" alt=""></a>-->
                    <a class="tweet" data-mins=""  href="http://satorio.org/" target="_blank"><img src="/img/feedback_twitter.png" alt=""></a>
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
            echo $this->Form->hidden('customTotalMedTime', array('value'=>'', 'id'=>'customTotalMedTime'));
            echo $this->Form->end();
            echo $this->Js->writeBuffer();
    }else{ ?>
        <div class="popupHeader">
            <h2 class="popupH timerHead">Ready To Sign Up Now?</h2>
            <p class="center">...and start feeding the world as you meditate</p>
            <button class="cls_button"  onclick= 'window.location.replace("/");'></button>
        </div>

        <div class="sepAU"></div> 

        <div id="smButtons">
            <div class="submit want-register">
                <a href="/users/register" class="login_green">Sign Up</a>
            </div>
        </div>
            
    <?php } ?>
        
</div>
<script>
(function() {
    window.fbAsyncInit = function() {
        FB.init({
        appId  : '641912699246752',
        status : true, // check login status
        cookie : true, // enable cookies to allow the server to access the session
        xfbml  : true  // parse XFBML
        });
    };

    var e = document.createElement('script');
    e.src = 'http://connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);

}());
</script>