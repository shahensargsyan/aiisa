<div class="steps-area">
    <h1>Help</h1>
    <div class="quickLinksBox">
        <p>QUICK LINKS</p>
        <ul>
            <li class="col-md-3">
                <div>
                    <!--<a href="<?php // echo $this->Html->url(array('controller' => 'pages', 'action' => 'contactUs')); ?>">-->
                    <a href="/pages/contactUs">
                        <img src="/img/newImgs/contact_support.png" />
                        <!--<br>-->
                        <span>Contact support</span>
                    </a>
                </div>
            </li>
            <li class="col-md-3">
                <div>
                    <a id="start_live_chat" href="<?php echo $this->Html->url('#'); ?>">
                        <img src="/img/newImgs/live_chat.png" />
                        <!--<br>-->
                        <span>Start Live Chat</span></div>
                </a>
            </li>
            <li class="col-md-3">  
                <div>
                    <?php if($is_user){?> 
                    <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit_profile')); ?>">
                        <img src="/img/newImgs/manage_account1.png" />                        
                        <span>Manage Your Account</span>
                    </a>
                    <?php }else {?>
                    <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'login')); ?>">
                        <img src="/img/newImgs/manage_account1.png" />                       
                        <span>Manage Your Account</span>
                    </a>
                    <?php } ?>
                </div>
            </li>
            <li class="col-md-3">  
                <div>
                    <?php // echo $this->Html->url(array('controller' => 'pages', 'action' => 'contactUs')); ?>
                    <a href="/pages/contactUs">
                        <img src="/img/newImgs/feedback2_green.png" />
                        <!--<br>-->
                        <span>Feedback</span>
                    </a>
                </div>
            </li>
            <?php
            //    echo $this->Html->link('Contact Support',array('controller' => 'pages','action' => 'Help'));
            //    echo $this->Html->link('Start Live Chat',array('controller' => 'pages','action' => 'Help'));
            //    echo $this->Html->link('Manage Your Account',array('controller' => 'pages','action' => 'Help'));
            //    echo $this->Html->link('Feedback',array('controller' => 'pages','action' => 'Help'));
            ?>
        </ul>
    </div>

    <div class="faqSection">
        <!--<p>F.A.Q.</p>-->
        <!--Search-->
        <form action="#" class="searchForm col-md-5 padLeft0">
            <input type="text" placeholder="Search...">
            <input type="submit" value="">
        </form>

        <p class="topQuestTl">Top Questions</p>
        
            <div class="topQuestList">
                <?php
                if(isset($questions) && $questions){
                    foreach($questions as $key => $value){
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
        
        <a href="/pages/Faq" class="viewAllFaqs">View all FAQs</a>
    </div>

<div class="otherInfo">
    <!--<p>Other Info</p>-->
    <div>
        <?php echo $other_info?>
    </div>
    </div>
</div>
<?php
if(isset($questions) && $questions){
    foreach($questions as $key => $value){
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

<div class="modal fade questionAnswerBox" id="questionModalNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $question['Question']['question']; ?>?</h4>
            </div>
            <div class="modal-body">
                <?php echo $questionn['Question']['answer']; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#start_live_chat').click(function(){
            $('#live_chat_link').trigger('click');
            return false;
        })
    })
</script>