<div class="timer hide zoom" style="display:none">
    <div class="timer_div_right">
        <!-- finished meditating tabs-->
        <div class="finish_container">
            <ul class="finish_meditation">
                <li class="finish_meditation_text">Meditation Ticker </li>
                <ul class="finish_meditation_cont" style="display:none;">
                    <li>
                        <div class="meditating_tab_container">
                            <div class="meditating_tab selected" id="meditating_now_tab">Meditating Now</div>
                            <div class="meditating_tab" id="meditating_near_me_tab">Meditators Near Me</div>
                            <div class="meditating_tab" id="finished_meditating_tab">Finished Meditating</div>
                        </div>
                        <div class="middle-midd-boxcont">

                            <div class="paggingOverlay" style="display:none" id="paging-indicator"><?php echo $this->Html->image('ajax-loader.gif'); ?></div>
                            <div class="" id="meditating_now_list">
                                <?php
                                if(is_array($meditating_now) &&!empty($meditating_now)):
                                foreach($meditating_now as $list):
                                ?>
                                <div class="middle-midd-box">
                                    <div class="middle-midd-boxinner">
                                        <div class="middle-midd-boxinner-imgleft">
                                            <?php
                                            $profile_picture = ($list['User']['profile_picture']!='')?'../profileimg/'.$list['User']['profile_picture']:'guest_avatar.jpg';
                                            echo $this->Html->image($profile_picture, array('style' => 'border:none;', 'width' => '80', 'height' => '88'));
                                            ?>
                                        </div>
                                        <div class="middle-midd-boxinner-right">
                                            <div class="middle-midd-boxinner-right-info">
                                                <h1><?php echo $list['Meditation']['user_type']; ?></h1>
                                                <h2><?php
                                                    if( (!empty($list['Meditationsmeta']['cityName']) && $list['Meditationsmeta']['cityName']!='--') && (!empty($list['Meditationsmeta']['countryName']) && $list['Meditationsmeta']['countryName']!='--') ):
                                                    $location = $list['Meditationsmeta']['cityName'].', '.$list['Meditationsmeta']['countryName'];
                                                    else:
                                                    $location = '--';
                                                    endif;
                                                    echo $location;
                                                    ?></h2>
                                                <div class="session_features">Selected session time:<span><?php echo $list['Meditation']['session_time'].'&nbsp;minutes'; ?></span></div>
                                                <div class="session_features">Meditation Date & Time:<span><?php echo date($list['Meditationsmeta']['submitDate']); ?></span></div>
                                            </div>	

                                        </div>	
                                        <div class="session_features userCommentsList">
                                            <div class="wrap_buttons">	
                                                <?php if($list['Meditation']['user_type'] == "Registered" && $this->Session->check('userId')): ?>
                                                <div class="button showCommntForm" id="commentMeForm-<?php echo $list['Meditation']['id'] ?>">Comment Here</div>	
                                                <?php endif; ?>
<?php if(!empty($list['Comment'])): ?>
                                                <div id="showCommentNow-<?php echo $list["Meditation"]["id"]; ?>" class="showCommnt button">Show Comments</div>
                                                <?php endif; ?>


<?php echo $this->Form->create('Comment'); ?>
                                                <div class="session_features inlineText commentMeFormSection" id="commentMeFormSection-<?php echo $list['Meditation']['id'] ?>" style="display:none;">
                                                    <div style="float:left;">
                                                        <div class="img">
                                                            <?php $profile_picture = ($userMeta['User']['profile_picture']!='')?'../profileimg/'.$userMeta['User']['profile_picture']:'guest_avatar.jpg';
                                                            echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;', 'width' => '33', 'height' => '28')); ?> 
                                                        </div>
                                                        <div class="session_features_fields">
                                                            <?php
                                                            echo $this->Form->input('Comment.MeditationId', array('type' => 'hidden', 'value' => $list['Meditation']['id']));
                                                            echo $this->Form->input('Comment.UserId', array('type' => 'hidden', 'value' => $list['Meditation']['user_id']));
                                                            echo $this->Form->input('Comment.UserComment', array('label' => false, 'class' => 'makeComment', 'placeholder' => 'Write a Comment'));

                                                            echo $this->Js->submit('Submit', array('update' => '#commentSectionNow_'.$list['Meditation']['id'],
                                                            'complete' => 'commentSubmit();',
                                                            //  'success' => $this->Js->get('#commentSectionNear_'.$list['Meditation']['id'])->effect('show', array('buffer' => false)),
                                                            'class' => 'button',
                                                            'style' => 'float:left;',
                                                            'url' => array('controller' => 'comments', 'action' => 'submitComment')
                                                            ));
                                                            ?>		
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                echo $this->Form->end();
                                                echo $this->Js->writeBuffer();
                                                ?>
                                                <noscript>
                                                <style>.tse-scrollable {overflow-y: scroll;}
                                                    .tse-scrollable.horizontal {overflow-x: scroll;overflow-y: hidden;}
                                                </style>
                                                </noscript>
                                                <div class = "userComments" id="hide-show-commentNow_<?php echo $list["Meditation"]["id"]; ?>" style="display:none;">						    										<div class="tse-scrollable demo1">
                                                        <div class="tse-content">
                                                                    <?php foreach($list['Comment'] as $comment): ?>
                                                            <div class="commentBox">
                                                                <div id="img">
<?php
$profile_picture = ($comment['User']['profile_picture']!='')?'../profileimg/'.$comment['User']['profile_picture']:'../profileimg/guest_avatar.jpg';
echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;margin: 7px 0 0 1px;', 'width' => '33', 'height' => '28'));
?>
                                                                </div>
                                                                <div id="personCommented"><?php echo $comment['User']['first_name']." ".$comment['User']['last_name']; ?></div>
                                                                <div class="comment"><?php echo $comment['comment']; ?></div>
                                                                <div class="clear"></div>
                                                            </div>

<?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clear"></div>	
                                            </div>
                                            <!--Comment Section Ends here-->
                                            <!--end-->
                                            <!--Make Comment Her-->
                                            <?php
                                            if($list['Meditation']['user_type'] == "Registered" && $this->Session->check('userId')):
                                            echo $this->Form->create('Comment');
                                            ?>

<?php
echo $this->Form->end();
echo $this->Js->writeBuffer();
//endif;
endif;
?>
                                            <!--mAKE cOMMENT eND hwere-->
                                            <!--End Here-->			
                                        </div>
                                    </div>
                                </div>
<?php
endforeach;
else:
?>
                                <div class="middle-midd-box">
                                    <div class="middle-midd-boxinner">
                                        <div class="no-records">Currently there is 0 result for meditating online!!!</div>
                                    </div>
                                </div>	
                                    <?php
                                    endif;
                                    ?>

                                <div class="middle-midd-bottolink">
                                    <?php
                                    $this->Paginator->options(array('update' => '#meditating_now_list',
                                    'evalScripts' => true,
                                    'url' => array('action' => 'mnpagination'),
                                    'before' => $this->Js->get('#paging-indicator')->effect('fadeIn', array('buffer' => false)),
                                    'complete' => $this->Js->get('#paging-indicator')->effect('fadeOut', array('buffer' => false)),
                                    ));
                                    ?>
                                    <div class="middle-midd-bottolink-left">
                                    <?php echo $this->Paginator->prev(__('< Previous'), array('tag' => false, 'model' => 'meditationPaging')); ?>
                                    </div>

                                    <div class="middle-midd-bottolink-right">
                                <?php echo $this->Paginator->next(__('Next >'), array('tag' => false, 'model' => 'meditationPaging')); ?>
                                    </div>
                                <?php echo $this->Js->writeBuffer(); ?>
                                </div>
                            </div>

                            <div class="hidden" id="meditating_near_me_list">
<?php
if(is_array($meditating_near_me) &&!empty($meditating_near_me)):
foreach($meditating_near_me as $list):
?>
                                <script type="text/javascript">
                                    /** WHY COMMENT OUT **/
                                    $(document).ready(function() {
                                        $("#showCommentNear-<?php echo $list["Meditation"]["id"]; ?>").click(function() {
                                            htm = $(this).text().trim();
                                            $(this).text(htm == "Show Comments" ? "Hide Comments" : "Show Comments");
                                            $("#hide-show-commentNear_<?php echo $list["Meditation"]["id"]; ?>").slideToggle();
                                        });

                                        $("#commentMeForm-<?php echo $list["Meditation"]["id"]; ?>").click(function() {
                                            console.log("Mediting near me list");
                                            $("#commentMeFormSection-<?php echo $list["Meditation"]["id"]; ?>").slideToggle();
                                        });
                                    })
                                </script>
                                <div class="middle-midd-box">
                                    <div class="middle-midd-boxinner">
                                        <div class="middle-midd-boxinner-imgleft">
                                                    <?php $profile_picture = ($list['User']['profile_picture']!='')?'../profileimg/'.$list['User']['profile_picture']:'guest_avatar.jpg';
                                                    echo $this->Html->image($profile_picture, array('style' => 'border:none;', 'width' => '80', 'height' => '88'));
                                                    ?>
                                        </div>
                                        <div class="middle-midd-boxinner-right">
                                            <div class="middle-midd-boxinner-right-info">
                                                <h1><?php echo $list['Meditation']['user_type']; ?></h1>
                                                <h2><?php
                                                    if( (!empty($list['Meditationsmeta']['cityName']) && $list['Meditationsmeta']['cityName']!='--') && (!empty($list['Meditationsmeta']['countryName']) && $list['Meditationsmeta']['countryName']!='--') ):
                                                    $location = $list['Meditationsmeta']['cityName'].', '.$list['Meditationsmeta']['countryName'];
                                                    else:
                                                    $location = '--';
                                                    endif;
                                                    echo $location;
                                                    ?></h2>
                                                <div class="session_features">Meditation session time:<span><?php echo $list['Meditation']['session_time'].'&nbsp;minutes'; ?></span></div>
                                                <div class="session_features">Meditation session rating:<span><?php echo isset($list['Feedback']['rating'])?$list['Feedback']['rating'].'/5':'<span class="not_available">Not Available</span>'; ?></span></div>
                                                <div class="session_features">Comments:<span><?php echo isset($list['Feedback']['feedback'])?$list['Feedback']['feedback']:'<span class="not_available">Not Available</span>'; ?></span>
                                                </div>
                                            </div>

                                        </div>	
                                        <div class="session_features userCommentsList">
                                            <div class="wrap_buttons">	
<?php if($list['Meditation']['user_type'] == "Registered" && $this->Session->check('userId')): ?>
                                                <div class="button showCommntForm" id="commentMeForm-<?php echo $list['Meditation']['id'] ?>">Comment Here</div>	
                                                            <?php endif; ?>
                                                            <?php if(!empty($list['Comment'])): ?>
                                                <div id="showCommentNear-<?php echo $list["Meditation"]["id"]; ?>" class="showCommnt button">Show Comments</div>
<?php endif; ?>

                                                            <?php echo $this->Form->create('Comment'); ?>
                                                <div class="session_features inlineText commentMeFormSection" id="commentMeFormSection-<?php echo $list['Meditation']['id'] ?>" style="display:none;">
                                                    <div style="float:left;">
                                                        <div class="img">
                                                            <?php $profile_picture = ($userMeta['User']['profile_picture']!='')?'../profileimg/'.$userMeta['User']['profile_picture']:'guest_avatar.jpg';
                                                            echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;', 'width' => '33', 'height' => '30'));
                                                            ?> 
                                                        </div>
                                                        <div class="session_features_fields">
                                                            <?php
                                                            echo $this->Form->input('Comment.MeditationId', array('type' => 'hidden', 'value' => $list['Meditation']['id']));
                                                            echo $this->Form->input('Comment.UserId', array('type' => 'hidden', 'value' => $list['Meditation']['user_id']));
                                                            echo $this->Form->input('Comment.UserComment', array('label' => false, 'class' => 'makeComment', 'placeholder' => 'Write a Comment'));

                                                            echo $this->Js->submit('Submit', array('update' => '#commentSectionNear_'.$list['Meditation']['id'],
                                                            'complete' => 'commentSubmit();',
                                                            //'success' => $this->Js->get('#commentSectionNear_'.$list['Meditation']['id'])->effect('show', array('buffer' => false)),
                                                            'class' => 'button',
                                                            'style' => 'float:left;',
                                                            'url' => array('controller' => 'comments', 'action' => 'submitComment')
                                                            ));
                                                            ?>		
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                echo $this->Form->end();
                                                echo $this->Js->writeBuffer();
                                                //endif;
                                                ?>
                                            </div>

                                                        <?php if(!empty($list['Comment'])): ?>
                                            <div class = "userComments" id="hide-show-commentNear_<?php echo $list["Meditation"]["id"]; ?>" style="display:none;">						

<?php foreach($list['Comment'] as $comment): ?>
                                                <div class="session_features commentBox">

                                                    <div id="img">
                                                <?php
                                                $profile_picture = ($comment['User']['profile_picture']!='')?'../profileimg/'.$comment['User']['profile_picture']:'../profileimg/guest_avatar.jpg';
                                                echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;margin: 7px 0 0 1px;', 'width' => '33', 'height' => '28'));
                                                ?>
                                                    </div>
                                                    <div id="personCommented"><?php echo $comment['User']['first_name']." ".$comment['User']['last_name']; ?></div>
                                                    <div class="comment"><?php echo $comment['comment']; ?></div>
                                                    <div class="clear"></div>

                                                </div>

<?php endforeach; ?></div>	
<?php else: ?>
                                            <div class = "userComments" style="width:60%;height:auto;float:right;display:none;color:#fff;" id="hide-show-comment_<?php echo $list["Meditation"]["id"]; ?>">
                                                No Comments Available</div>

                                            <?
                                            endif;?>	
                                        </div>	
                                        <!--Comment Section Ends here-->

                                        <!--End Here-->															
                                    </div>
                                </div>
                                <?php
                                endforeach;
                                else:
                                ?>
                                <div class="middle-midd-box">
                                    <div class="middle-midd-boxinner">
                                        <div class="no-records">Currently there is 0 result for meditators near me!!!</div>
                                    </div>
                                </div>	
                                    <?php
                                    endif;
                                    ?>

                                <div class="middle-midd-bottolink">
<?php
$this->Paginator->options(array('update' => '#meditating_near_me_list',
 'evalScripts' => true,
 'url' => array('action' => 'mnmpagination'),
 'before' => $this->Js->get('#paging-indicator')->effect('fadeIn', array('buffer' => false)),
 'complete' => $this->Js->get('#paging-indicator')->effect('fadeOut', array('buffer' => false)),
));
?>
                                    <div class="middle-midd-bottolink-left">
                                <?php echo $this->Paginator->prev(__('< Previous'), array('tag' => false, 'model' => 'meditating_near_mePaging')); ?>
                                    </div>

                                    <div class="middle-midd-bottolink-right">
                                <?php echo $this->Paginator->next(__('Next >'), array('tag' => false, 'model' => 'meditating_near_mePaging')); ?>
                                    </div>
<?php echo $this->Js->writeBuffer(); ?>
                                </div>
                            </div>

                            <div class="hidden" id="finished_meditating_list">
<?php
/* echo '<pre>'; print_r($finished_meditations); */
if(is_array($finished_meditations) &&!empty($finished_meditations)):
foreach($finished_meditations as $list):
?>
                                <script type="text/javascript">
                                    /** WHY COMMENT OUT **/
                                    $(document).ready(function() {
                                        $("#showCommentFinish-<?php echo $list["Meditation"]["id"]; ?>").click(function() {
                                            htm = $(this).text().trim();
                                            $(this).text(htm == "Show Comments" ? "Hide Comments" : "Show Comments");
                                            $("#hide-show-commentFinish_<?php echo $list["Meditation"]["id"]; ?>").slideToggle();
                                        });

                                        $("#commentMeForm-<?php echo $list["Meditation"]["id"]; ?>").click(function() {
                                            console.log("Mediting finish list");
                                            $("#commentMeFormSection-<?php echo $list["Meditation"]["id"]; ?>").slideToggle();
                                        });
                                    })
                                </script>
                                <div class="middle-midd-box">
                                    <div class="middle-midd-boxinner">
                                        <div class="middle-midd-boxinner-imgleft"><?php
                                                    $profile_picture = ($list['User']['profile_picture']!='')?'../profileimg/'.$list['User']['profile_picture']:'guest_avatar.jpg';
                                                    echo $this->Html->image($profile_picture, array('style' => 'border:none;', 'width' => '80', 'height' => '88'));
                                                    ?>
                                                    <?php
                                                    if($list['Meditation']['user_type'] == "Registered" && $this->Session->check('userId')):
                                                    $userId = $this->Session->read('userId');
                                                    if($userId != $list['Meditation']['user_id']):
                                                    ?>
                                            <div id="followSectionFinish_<?php echo $list['Meditation']['id']; ?>" class="session_features" style="padding: 7px 0 0 4px;">
                                                <div class="innerFollow">
<?php
echo $this->Form->create('UsersNetworks');
echo $this->Form->input('personToFollow', array('label' => false, 'type' => 'hidden', 'value' => $list['Meditation']['user_id']));
echo $this->Form->input('meditationId', array('label' => false, 'type' => 'hidden', 'value' => $list['Meditation']['id']));
echo $this->Js->submit('Follow', array('id' => 'followButtonFinish_'.$list['Meditation']['id'],
 'update' => '#followSectionFinish_'.$list['Meditation']['id'],
 // 'complete'	  => 'commentSubmit();',	
//  'success' => $this->Js->get('#commentSectionNear_'.$list['Meditation']['id'])->effect('show', array('buffer' => false)),
'class' => 'button followButton',
 'url' => array('controller' => 'UsersNetworks', 'action' => 'followUserFinish')
));
echo $this->Form->end();
echo $this->Js->writeBuffer();
?> 
                                                </div>

                                            </div>
<?php endif;
endif;
?>	
                                        </div>
                                        <div class="middle-midd-boxinner-right">
                                            <div class="middle-midd-boxinner-right-info">
                                                <h1><?php echo $list['Meditation']['user_type']; ?></h1>
                                                <h2><?php
                                                if( (!empty($list['Meditationsmeta']['cityName']) && $list['Meditationsmeta']['cityName']!='--') && (!empty($list['Meditationsmeta']['countryName']) && $list['Meditationsmeta']['countryName']!='--') ):
                                                $location = $list['Meditationsmeta']['cityName'].', '.$list['Meditationsmeta']['countryName'];
                                                else:
                                                $location = '--';
                                                endif;
                                                echo $location;
?>
                                                </h2>
                                                <div class="session_features">Meditation session time:<span><?php echo $list['Meditation']['session_time'].'&nbsp;minutes'; ?></span></div>
                                                <div class="session_features">Meditation session rating:<span><?php echo isset($list['Feedback']['rating'])?$list['Feedback']['rating'].'/5':'<span class="not_available">Not Available</span>'; ?></span></div>
                                                <?php if($this->Session->check('userId')) {//Show Comments if Users is not Guest ?>
                                                <div class="session_features">Comments:<span><?php echo isset($list['Feedback']['feedback'])?$list['Feedback']['feedback']:'<span class="not_available">Not Available</span>'; ?></span>
                                                </div>
                                                <?php } ?>
                                                <div class="session_features">Meditation Date & Time:<span><?php echo date($list['Meditationsmeta']['submitDate']); ?></span>
                                                </div>


                                            </div>




                                        </div>	
                                        <div class="session_features userCommentsList">
                                            <div class="wrap_buttons">	
<?php if($list['Meditation']['user_type'] == "Registered" && $this->Session->check('userId')): ?>
                                                <div class="button showCommntForm" id="commentMeForm-<?php echo $list['Meditation']['id'] ?>">Comment Here</div>	
                                                            <?php endif; ?>
                                                            <?php if(!empty($list['Comment'])): ?>
                                                <div id="showCommentFinish-<?php echo $list["Meditation"]["id"]; ?>" class="showCommnt button">Show Comments</div>
                                                            <?php endif; ?>
                                                <!-- comment box-->

                                                            <?php echo $this->Form->create('Comment'); ?>
                                                <div class="session_features inlineText commentMeFormSection" id="commentMeFormSection-<?php echo $list['Meditation']['id'] ?>" style="display:none;">
                                                    <div style="float:left;">
                                                        <div class="img">
                                                            <?php $profile_picture = ($userProfile[0]['User']['profile_picture']!='')?'../profileimg/'.$userProfile[0]['User']['profile_picture']:'guest_avatar.jpg';

                                                            echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;', 'width' => '33', 'height' => '30'));
                                                            ?> 
                                                        </div>
                                                        <div class="session_features_fields">
                                                <?php
                                                echo $this->Form->input('Comment.MeditationId', array('type' => 'hidden', 'value' => $list['Meditation']['id']));
                                                echo $this->Form->input('Comment.UserId', array('type' => 'hidden', 'value' => $list['Meditation']['user_id']));
                                                echo $this->Form->input('Comment.UserComment', array('label' => false, 'class' => 'makeComment', 'id' => 'makeCommentFinish_'.$list['Meditation']['id'], 'placeholder' => 'Write a Comment'));

                                                echo $this->Js->submit('Submit', array('id' => 'submitCommentButtonFinish_'.$list['Meditation']['id'],
                                                'update' => '#hide-show-commentFinish_'.$list['Meditation']['id'],
                                                'complete' => 'commentSubmit();',
                                                //'success' => $this->Js->get('#hide-show-commentFinish_'.$list['Meditation']['id'])->effect('show', array('buffer' => false)),
                                                'class' => 'button',
                                                'url' => array('controller' => 'comments', 'action' => 'submitComment')
                                                ));
                                                ?>		
                                                        </div>
                                                    </div>
                                                </div>

<?php
echo $this->Form->end();
echo $this->Js->writeBuffer();
?>


                                                <!--add scroller here-->
                                                <noscript>
                                                <style>
                                                    /**
                                                    * Reinstate scrolling for non-JS clients
                                                    * 
                                                    * You coud do this in a regular stylesheet, but be aware that
                                                    * even in JS-enabled clients the browser scrollbars may be visible
                                                    * briefly until JS kicks in. This is especially noticeable in IE.
                                                    * Wrapping these rules in a noscript tag ensures that never happens.
                                                    */
                                                    .tse-scrollable {overflow-y: scroll;}
                                                    .tse-scrollable.horizontal {overflow-x: scroll;overflow-y: hidden;}
                                                </style>
                                                </noscript>
                                                <div class = "userComments" id="hide-show-commentFinish_<?php echo $list["Meditation"]["id"]; ?>" style="display:none;">						                    <div class="tse-scrollable demo1">
                                                        <div class="tse-content">
<?php foreach($list['Comment'] as $comment): ?>
                                                            <div class="commentBox">
                                                                <div id="img">
<?php
$profile_picture = ($comment['User']['profile_picture']!='')?'../profileimg/'.$comment['User']['profile_picture']:'guest_avatar.jpg';
echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;margin: 7px 0 0 1px;', 'width' => '33', 'height' => '28'));
?>
                                                                </div>
                                                                <div id="personCommented"><?php echo $comment['User']['first_name']." ".$comment['User']['last_name']; ?></div>
                                                                <div class="comment"><?php echo $comment['comment']; ?></div>
                                                                <div class="clear"></div>
                                                            </div>
                                <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>	<!--Hide Show Comment Section end here-->

                                                <div class="clear"></div>	
                                            </div>





                                            <!--Comment Input End Box-->
                                        </div><!--Session Features END hERE-->
                                    </div><!--Middle Midd Box Inner End Here-->

                                </div>
                                    <?php
                                    endforeach;
                                    else:
                                    ?>
                                <div class="middle-midd-box">
                                    <div class="middle-midd-boxinner">
                                        <div class="no-records">Currently there is 0 result for finished meditating!!!</div>
                                    </div>
                                </div>	
                                        <?php
                                        endif;
                                        ?>

                                <div class="middle-midd-bottolink">
<?php
$this->Paginator->options(array('update' => '#finished_meditating_list',
 'evalScripts' => true,
 'url' => array('action' => 'fmpagination'),
 'before' => $this->Js->get('#paging-indicator')->effect('fadeIn', array('buffer' => false)),
 'complete' => $this->Js->get('#paging-indicator')->effect('fadeOut', array('buffer' => false)),
));
?>
                                    <div class="middle-midd-bottolink-left">
<?php echo $this->Paginator->prev(__('< Previous'), array('tag' => false, 'model' => 'finished_meditationsPaging')); ?>
                                    </div>

                                    <div class="middle-midd-bottolink-right">
<?php echo $this->Paginator->next(__('Next >'), array('tag' => false, 'model' => 'finished_meditationsPaging')); ?>
                                    </div>
<?php echo $this->Js->writeBuffer(); ?>
                                </div>		  
                            </div>
                        </div>
                    </li>
                </ul>
            </ul>
        </div>
        <!-- @finished meditating tabs-->
    </div>
</div>