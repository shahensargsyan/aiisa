<?php 
$userData = $this->Session->check('userId');
//BY DEFAULT USER TYPE IS GUEST SHOWPOPUP NO
$userType='Guest';
$showpopup='No';

// GET LOGGED IN USER ID 
if(!empty( $userData)){
	$rg_userId               = $userMeta['User']['id'];
	
	if($rg_userId!=0):
		$userType='Registered';//change user type if user logged in
	endif;
	
	//USER REGISTERED COOORDINATES
	$rg_location_coordinates = $userMeta['User']['location_coordinates'];
	$rg_location_coordinates = explode(',',$rg_location_coordinates);
	$rg_latitude             = explode('.',$rg_location_coordinates[0]); 
	$rg_latitude             = $rg_latitude [0]; 
	$rg_longitude            = explode('.',$rg_location_coordinates[1]);    
	$rg_longitude            = $rg_longitude[0]; 	 
	$rg_city                 = $userMeta['User']['city'];
	$rg_state                = $userMeta['User']['state'];
	$rg_country              = $userMeta['User']['country'];
	$rg_zipcode              = $userMeta['User']['zip_code'];
	
	
	//USER CURRENT COORDINATES
	$current_latitude         = explode('.',$data['lat']);
	$current_latitude         = $current_latitude[0];  
	$current_logitude         = explode('.',$data['lon']);
	$current_logitude         = $current_logitude[0];
	
	if( $rg_latitude == $current_latitude && $rg_longitude == $current_logitude){
	   $showpopup ="NO";
	}else{
		$showpopup ="YES";
	}
}							
?>	
<script type="text/javascript">
$(document).ready(function(){

	$('.demo1').TrackpadScrollEmulator();
	$('.demo2').TrackpadScrollEmulator();
	 
});
</script>	

<?php 
//check if shared meditation is numric or not .pop up should be appear for numeric value
//echo"<pre>";print_r($_REQUEST);
if(!empty($_REQUEST['mn'])){
	$mn = $_GET['mn'];
	if($mn == '11328618a16d4e24b3fabe30587c4714'){ 
	//show timer?>
	<script type="text/javascript">
	$(document).ready(function(){
	$(".popup_0_container" ).fadeOut("slow",function(){
				//$(".blank_wrapper1").attr("id","popup");
				$(".popup_2_container").fadeIn("slow");	
				$(".popup_0_container").fadeOut("slow");	
			});	
	
	});
	</script>
<?php }
else{
//nothing here
}
}



if(is_numeric($fbshareMinutes)){
  $value = $fbshareMinutes;
}
else{
$value = " ";
}?>
					
<div id="fbshareMins" style="display:none;"><?php  echo $value;?></div>						
<div class="timer">
  <div class="timer_div_left">
  	<div class="minute_wrapper">
		<span class="meditation_now_btn">Meditating Now</span>
		<span class="med_now_image"><?php echo $this->Html->image('map/currentshow.png'); ?></span>
	</div>
    <?php if($num_online_users > 1){?>
		<div class="minute_wrapper">
			Users Online: <?php echo $num_online_users; ?>
		</div>
	<?php }
	else{ ?>
			<div class="minute_wrapper">
			Users Online: <?php echo $num_online_users; ?>
		</div>
	<?php }
	?>
	<div class="minute_wrapper">Total Meditation sessions: <?php echo $total_med_logged; ?> </div>
	<div class="minute_wrapper">Total Meditation Minutes: <?php echo  $total_med_session;?></div>
  </div>
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
						if(is_array($meditating_now) && !empty($meditating_now)):
						foreach($meditating_now as $list):?>
 							<div class="middle-midd-box">
								<div class="middle-midd-boxinner">
									 <div class="middle-midd-boxinner-imgleft">
									<?php 
											$profile_picture 	= ($list['User']['profile_picture']!='')?'../profileimg/'.$list['User']['profile_picture']:'guest_avatar.jpg';
											echo $this->Html->image($profile_picture, array('style' => 'border:none;','width'=>'80','height'=>'88')); ?>
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
										<div class="session_features">Meditation Date & Time:<span><?php echo date($list['Meditationsmeta']['submitDate']);?></span></div>
										</div>	
										
									</div>	
									<div class="session_features userCommentsList">
										<div class="wrap_buttons">	
										<?php if($list['Meditation']['user_type'] == "Registered" && $this->Session->check('userId')):?>
										<div class="button showCommntForm" id="commentMeForm-<?php echo $list['Meditation']['id']?>">Comment Here</div>	
										<?php endif;?>
										<?php if(!empty($list['Comment'])):?>
										<div id="showCommentNow-<?php echo $list["Meditation"]["id"];?>" class="showCommnt button">Show Comments</div>
										<?php endif;?>
										
										
										<?php 
										echo $this->Form->create('Comment'); ?>
										<div class="session_features inlineText commentMeFormSection" id="commentMeFormSection-<?php echo $list['Meditation']['id']?>" style="display:none;">
										<div style="float:left;">
										<div class="img">
										<?php $profile_picture 	= ($userMeta['User']['profile_picture']!='')?'../profileimg/'.$userMeta['User']['profile_picture']:'guest_avatar.jpg'; echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;','width'=>'33','height'=>'28')); ?> 
										</div>
										<div class="session_features_fields">
										<?php 
										echo $this->Form->input('Comment.MeditationId',array('type'=>'hidden','value' => $list['Meditation']['id']));
										echo $this->Form->input('Comment.UserId',array('type'=>'hidden','value' => $list['Meditation']['user_id']));
										echo $this->Form->input('Comment.UserComment',array('label' => false,'class'=>'makeComment','placeholder' => 'Write a Comment'));
										
										echo $this->Js->submit('Submit',array('update'    => '#commentSectionNow_'.$list['Meditation']['id'],
										'complete'	  => 'commentSubmit();',	
										//  'success' => $this->Js->get('#commentSectionNear_'.$list['Meditation']['id'])->effect('show', array('buffer' => false)),
										'class' 	  => 'button',
										'style'     => 'float:left;',
										'url'       => array('controller'=>'comments', 'action' => 'submitComment')
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
										<div class = "userComments" id="hide-show-commentNow_<?php echo $list["Meditation"]["id"];?>" style="display:none;">						    										<div class="tse-scrollable demo1">
										<div class="tse-content">
										<?php foreach($list['Comment'] as $comment): ?>
										<div class="commentBox">
										<div id="img">
										<?php 
										$profile_picture 	= ($comment['User']['profile_picture']!='')?'../profileimg/'.$comment['User']['profile_picture']:'../profileimg/guest_avatar.jpg';
										echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;margin: 7px 0 0 1px;','width'=>'33','height'=>'28')); ?>
										</div>
										<div id="personCommented"><?php echo $comment['User']['first_name']." ".$comment['User']['last_name'];?></div>
										<div class="comment"><?php echo $comment['comment'];?></div>
										<div class="clear"></div>
										</div>
										
										<?php endforeach;?>
										</div>
										</div>
										</div>
										<div class="clear"></div>	
										</div>
										<!--Comment Section Ends here-->
										<!--end-->
										<!--Make Comment Her-->
										<?php if($list['Meditation']['user_type'] == "Registered" && $this->Session->check('userId')):
										echo $this->Form->create('Comment');
										?>
										
										<?php 
										echo $this->Form->end();
										echo $this->Js->writeBuffer();
										//endif;
										endif;?>
										<!--mAKE cOMMENT eND hwere-->
										<!--End Here-->			
										</div>
									</div>
							</div>
						<?php endforeach; 
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
													'url'=> array('action' => 'mnpagination'),
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
						if(is_array($meditating_near_me) && !empty($meditating_near_me)):
						foreach($meditating_near_me as $list):?>
						<script type="text/javascript">
						/** WHY COMMENT OUT **/
						$(document).ready(function(){
							$("#showCommentNear-<?php echo $list["Meditation"]["id"];?>").click(function(){
							htm = $(this).text().trim();
							$(this).text(htm == "Show Comments"? "Hide Comments": "Show Comments"); 
							$("#hide-show-commentNear_<?php echo $list["Meditation"]["id"];?>").slideToggle();
							});
							
							$("#commentMeForm-<?php echo $list["Meditation"]["id"];?>").click(function(){
									console.log("Mediting near me list");
									$("#commentMeFormSection-<?php echo $list["Meditation"]["id"];?>").slideToggle();
								});
						})
						</script>
						<div class="middle-midd-box">
						<div class="middle-midd-boxinner">
						<div class="middle-midd-boxinner-imgleft">
							<?php $profile_picture 	= ($list['User']['profile_picture']!='')?'../profileimg/'.$list['User']['profile_picture']:'guest_avatar.jpg';
								echo $this->Html->image($profile_picture, array('style' => 'border:none;','width'=>'80','height'=>'88')); ?>
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
								<?php if($list['Meditation']['user_type'] == "Registered" && $this->Session->check('userId')):?>
								<div class="button showCommntForm" id="commentMeForm-<?php echo $list['Meditation']['id']?>">Comment Here</div>	
								<?php endif;?>
								<?php if(!empty($list['Comment'])):?>
								<div id="showCommentNear-<?php echo $list["Meditation"]["id"];?>" class="showCommnt button">Show Comments</div>
								<?php endif;?>
						
						<?php echo $this->Form->create('Comment');?>
						<div class="session_features inlineText commentMeFormSection" id="commentMeFormSection-<?php echo $list['Meditation']['id']?>" style="display:none;">
						<div style="float:left;">
						<div class="img">
						<?php $profile_picture 	= ($userMeta['User']['profile_picture']!='')?'../profileimg/'.$userMeta['User']['profile_picture']:'guest_avatar.jpg';
						echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;','width'=>'33','height'=>'30')); ?> 
						</div>
						<div class="session_features_fields">
						<?php 
						echo $this->Form->input('Comment.MeditationId',array('type'=>'hidden','value' => $list['Meditation']['id']));
						echo $this->Form->input('Comment.UserId',array('type'=>'hidden','value' => $list['Meditation']['user_id']));
						echo $this->Form->input('Comment.UserComment',array('label' => false,'class'=>'makeComment','placeholder' => 'Write a Comment'));
						
						echo $this->Js->submit('Submit',array('update'    => '#commentSectionNear_'.$list['Meditation']['id'],
									  'complete'	  => 'commentSubmit();',	
									  //'success' => $this->Js->get('#commentSectionNear_'.$list['Meditation']['id'])->effect('show', array('buffer' => false)),
									  'class' 	  => 'button',
									  'style'     => 'float:left;',
									  'url'       => array('controller'=>'comments', 'action' => 'submitComment')
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
						
						<?php if(!empty($list['Comment'])):?>
						<div class = "userComments" id="hide-show-commentNear_<?php echo $list["Meditation"]["id"];?>" style="display:none;">						
						
						<?php foreach($list['Comment'] as $comment):?>
						<div class="session_features commentBox">
					
						<div id="img">
						<?php 
						$profile_picture 	= ($comment['User']['profile_picture']!='')?'../profileimg/'.$comment['User']['profile_picture']:'../profileimg/guest_avatar.jpg';
						echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;margin: 7px 0 0 1px;','width'=>'33','height'=>'28')); ?>
						</div>
						<div id="personCommented"><?php echo $comment['User']['first_name']." ".$comment['User']['last_name'];?></div>
						<div class="comment"><?php echo $comment['comment'];?></div>
						<div class="clear"></div>
						
						</div>
						
						<?php endforeach;?></div>	
						<?php	else:?>
						<div class = "userComments" style="width:60%;height:auto;float:right;display:none;color:#fff;" id="hide-show-comment_<?php echo $list["Meditation"]["id"];?>">
						No Comments Available</div>
						
						<?
						endif;?>	
						</div>	
						<!--Comment Section Ends here-->
						
						<!--End Here-->															
						</div>
						</div>
						<?php endforeach; 
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
						'url'=> array('action' => 'mnmpagination'),
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
					/*echo '<pre>'; print_r($finished_meditations); */
					if(is_array($finished_meditations) && !empty($finished_meditations)): 
					foreach($finished_meditations as $list):
					?>
					<script type="text/javascript">
						/** WHY COMMENT OUT **/
						$(document).ready(function(){
							$("#showCommentFinish-<?php echo $list["Meditation"]["id"];?>").click(function(){
							htm = $(this).text().trim();
							$(this).text(htm == "Show Comments"? "Hide Comments": "Show Comments"); 
							$("#hide-show-commentFinish_<?php echo $list["Meditation"]["id"];?>").slideToggle();
							});
							
							$("#commentMeForm-<?php echo $list["Meditation"]["id"];?>").click(function(){
									console.log("Mediting finish list");
									$("#commentMeFormSection-<?php echo $list["Meditation"]["id"];?>").slideToggle();
								});
						})
						</script>
					<div class="middle-midd-box">
					<div class="middle-midd-boxinner">
					<div class="middle-midd-boxinner-imgleft"><?php 
					$profile_picture 	= ($list['User']['profile_picture']!='')?'../profileimg/'.$list['User']['profile_picture']:'guest_avatar.jpg';
					echo $this->Html->image($profile_picture, array('style' => 'border:none;','width'=>'80','height'=>'88')); ?>
					<?php if($list['Meditation']['user_type'] == "Registered"  && $this->Session->check('userId')):
					$userId = $this->Session->read('userId');
					if($userId != $list['Meditation']['user_id']):	?>
					<div id="followSectionFinish_<?php echo $list['Meditation']['id'];?>" class="session_features" style="padding: 7px 0 0 4px;">
					<div class="innerFollow">
					<?php   echo $this->Form->create('UsersNetworks');
					echo $this->Form->input('personToFollow',array('label'=> false,'type'=>'hidden','value'=>$list['Meditation']['user_id']));
					echo $this->Form->input('meditationId',array('label'=> false,'type'=>'hidden','value'=>$list['Meditation']['id']));
					echo $this->Js->submit('Follow',array('id'   	 => 'followButtonFinish_'.$list['Meditation']['id'],
								  'update'    => '#followSectionFinish_'.$list['Meditation']['id'],
								// 'complete'	  => 'commentSubmit();',	
								//  'success' => $this->Js->get('#commentSectionNear_'.$list['Meditation']['id'])->effect('show', array('buffer' => false)),
								  'class' 	  => 'button followButton',
								  'url'       => array('controller'=>'UsersNetworks', 'action' => 'followUserFinish')
					));
					echo $this->Form->end();
					echo $this->Js->writeBuffer();
					?> 
					</div>
					
					</div>
					<?php	endif; 
					endif;?>	
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
					<?php if($this->Session->check('userId')) {//Show Comments if Users is not Guest?>
					<div class="session_features">Comments:<span><?php echo isset($list['Feedback']['feedback'])?$list['Feedback']['feedback']:'<span class="not_available">Not Available</span>'; ?></span>
					</div>
					<?php }?>
					<div class="session_features">Meditation Date & Time:<span><?php echo date($list['Meditationsmeta']['submitDate']);?></span>
					</div>
					
					
					</div>
					
					
						
					
					</div>	
					<div class="session_features userCommentsList">
					<div class="wrap_buttons">	
					<?php if($list['Meditation']['user_type'] == "Registered" && $this->Session->check('userId')):?>
					<div class="button showCommntForm" id="commentMeForm-<?php echo $list['Meditation']['id']?>">Comment Here</div>	
					<?php endif;?>
					<?php if(!empty($list['Comment'])):?>
					<div id="showCommentFinish-<?php echo $list["Meditation"]["id"];?>" class="showCommnt button">Show Comments</div>
					<?php endif;?>
							<!-- comment box-->
					
					<?php echo $this->Form->create('Comment');?>
					<div class="session_features inlineText commentMeFormSection" id="commentMeFormSection-<?php echo $list['Meditation']['id']?>" style="display:none;">
					<div style="float:left;">
					<div class="img">
					<?php		$profile_picture 	= ($userProfile[0]['User']['profile_picture']!='')?'../profileimg/'.$userProfile[0]['User']['profile_picture']:'guest_avatar.jpg';
					
					echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;','width'=>'33','height'=>'30')); ?> 
					</div>
					<div class="session_features_fields">
					<?php 
					echo $this->Form->input('Comment.MeditationId',array('type'=>'hidden','value' => $list['Meditation']['id']));
					echo $this->Form->input('Comment.UserId',array('type'=>'hidden','value' => $list['Meditation']['user_id']));
					echo $this->Form->input('Comment.UserComment',array('label' => false,'class'=>'makeComment','id'=>'makeCommentFinish_'.$list['Meditation']['id'],'placeholder' => 'Write a Comment'));
					
					echo $this->Js->submit('Submit',array('id'   	 => 'submitCommentButtonFinish_'.$list['Meditation']['id'],
							 'update'    => '#hide-show-commentFinish_'.$list['Meditation']['id'],
							 'complete'	  => 'commentSubmit();',	
							  //'success' => $this->Js->get('#hide-show-commentFinish_'.$list['Meditation']['id'])->effect('show', array('buffer' => false)),
							  'class' 	  => 'button',
							  'url'       => array('controller'=>'comments', 'action' => 'submitComment')
							));
					?>		
					</div>
					</div>
					</div>
					
					<?php
					echo $this->Form->end();
					echo $this->Js->writeBuffer();?>
					
					
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
					<div class = "userComments" id="hide-show-commentFinish_<?php echo $list["Meditation"]["id"];?>" style="display:none;">						                    <div class="tse-scrollable demo1">
					<div class="tse-content">
					<?php  foreach($list['Comment'] as $comment): ?>
					<div class="commentBox">
					<div id="img">
					<?php 
					$profile_picture 	= ($comment['User']['profile_picture']!='')?'../profileimg/'.$comment['User']['profile_picture']:'guest_avatar.jpg';
					echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;margin: 7px 0 0 1px;','width'=>'33','height'=>'28')); ?>
					</div>
					<div id="personCommented"><?php echo $comment['User']['first_name']." ".$comment['User']['last_name'];?></div>
					<div class="comment"><?php echo $comment['comment'];?></div>
					<div class="clear"></div>
					</div>
					<?php endforeach;?>
					</div>
					</div>
					</div>	<!--Hide Show Comment Section end here-->
				
					<div class="clear"></div>	
					</div>
					
			
					
					
				
					<!--Comment Input End Box-->
					</div><!--Session Features END hERE-->
					</div><!--Middle Midd Box Inner End Here-->
					
					</div>
					<?php endforeach; 
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
					'url'=> array('action' => 'fmpagination'),
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
<!-- TIMER CLOSE -->

<!-- FLASH MESSAGE-->
<?php if( $this->Session->check('Message.flash') ): ?>
<div id="registration_message">
	<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
</div>		 
<?php endif; ?>
<script type="text/javascript">hideFlash('registration_message');</script>
<!-- END @ FLASH MESSAGE-->
<?php //echo"</br>";echo"<br>";echo $total_count;?>
<div id="popup_1" class="blank_wrapper1">
	<div class="map" id="map_container">
		<div id="map1" style="width:100%; height: 500px; margin-top: -30px;"></div>
	</div>
	 <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<script type="text/javascript">
		 //jQuery.noConflict();
		 jQuery(function(){
      	//var $ = jQuery;
			var palette = ['#C1D895'];//57767E//85B6DE#68B9DE
			generateColors = function(){
			   // alert("hi");
				var colors = {},key;
				for (key in map1.regions) {
					colors[key] = palette[Math.floor(Math.random()*palette.length)];
				}
				return colors;
			},map1;
       var markers =  [
				<?php 
					//FOR LAST 10 MEDITATING USER 
					foreach($show_default_loc_array as $locat){ 
					$latLong = 	$locat['latLong'];
					$cities = 	$locat['city'];
					?>{latLng: [<?php echo $latLong ;?>], name: '<?php echo $cities; ?>'},
					<?php
				}
				//SHOW WHO DOING MEDITATING
				foreach($result_loc_array as $locat){
					$lats	=	$locat['latitude'];
					$longs	=	$locat['longitude'];
					$cities = 	$locat['city'];
					$remote_addr = $locat['remote_addr'];
					
					?>{latLng: [<?php echo $lats;?>,<?php echo $longs;?>], name: '<?php echo $cities; ?>'},
					<?php
				}
				?>		
		
								
			],
         values3 = {
			// 0: 'current',
			<?php 
		     for($i=0;$i<=99;$i++){ 
				echo "{$i}".':'.'"medfinish"'.',' ;
				
			}
			for($i=100;$i<=$total_count;$i++){
				
					echo "{$i}".':'.'"mednow"'.',' ;
			
			}
			
			?>
			
			
			
          };
			var map1 =new jvm.Map({
			
							map: 'world_mill_en',
							container: $('#map1'),
							markers: markers,
							series: {
									markers: [{
									attribute: 'image',
									scale: {
										mednow: 'http://satorio.org/img/map/current.png',//new_red.gif
										medfinish: 'http://satorio.org/img/map/blue1.png',
										current: 'http://satorio.org/img/map/current.gif'
										
									},
									values: values3,
									/*legend: {
										horizontal: true,
										cssClass: 'jvectormap-legend-icons',
										title: 'Business type'
									}*/
									}],
							     regions: [{
									attribute: 'fill'
											}]
											
							},
							
							     scaleColors: ['#C8EEFF', '#0071A4'],
									normalizeFunction: 'polynomial',
									hoverOpacity: 0.7,
									hoverColor: false,
									backgroundColor: false,
									zoom:true,
									zoomOnScroll:false,
									focusOn:{ x: 0.6,
											  y: 0.5,
											  scale: 1
									},
									regionStyle:{
										hover: {
											fill: '#D5E4B8',
											"fill-opacity": 1
										}
									},		
							
			
			
			});
		map1.series.regions[0].setValues(generateColors());

		
		});
	</script>
	<div class="lightModalOverlay">&nbsp;</div>

	
	<!--------- POP_UP-1 ------------->
	<div class="popup_0_container">
		<a  href="javascript:void(0);">
		<div class="start_popup">
			<div class="start_link">START</div>
		</div>
		</a>
	</div>
	<div class="popup_1_container">
		<div class="login_popup">
			<div style="padding:5px 20px 20px"><div id="back_to_popup_first" class="close_button"><?php echo $this->Html->image('close.gif',array('width' => '21', 'height' => '21')) ?></div></div>
			<div class="popup_container">
				<div class="popup_content">
					<div class="meditation_header">
						<a>Meditate to End World Hunger</a>
						<span>For each minute you meditate we will donate 10 grains of rice through Oxfam </span>
					</div>
					<div class="step_wrapper">
						<div class="step_post">
							<div class="step_icon">
								<?php echo $this->Html->image('seeds.png') ?>
							</div>
							<div class="step_detail">
							1. For every minute you mediate, 10 grains of rice will be donated to a starving person
							</div>
							<div class="clear"></div>
						</div>
						<div class="step_post">
							<div class="step_icon">
								<?php echo $this->Html->image('bowl.png') ?>
							</div>
							<div class="step_detail">
								2. As your meditation minutes accumulate you help to feed hungry people in need.
							</div>
							<div class="clear"></div>
						</div>
						<div class="step_post">
							<div class="step_icon">
								<?php echo $this->Html->image('rice.png') ?>
							</div>
							<div class="step_detail">
								3. You can track your progress. See how many Rice you directly donated and help to end world hunger.
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<?php if(!$this->Session->check('userId')):?>
						<div class="login_register_wrapper">
							<?php echo $this->Html->link('Log In', '/login', array('class' => 'button login_btn'));?>
							<?php echo $this->Html->link('Register', '/register', array('class' => 'button register_btn'));?>
							<div class="clear"></div>
						</div>
						<div class="without_login">
							<div class="login_link"><a class="link" href="javascript:void(0);">Meditate without logging in</a></div>
						</div>
					<?php else:?>
						<div class="without_login">
							<div class="login_link"><a class="link" href="javascript:void(0);">Meditate Now</a></div>
						</div>
					<?php endif;?>
				</div>
			</div>			
		</div>  
	</div>
	<!--------- END @ POP_UP-1 ------->
	
	<!---------- POP_UP-2 ------------>
	<div class="popup_2_container" style="display:none;">
		<div class="timer_wrapper">
			<div class="timer_wrapper_inner">
			<?php if(!empty($userMeta['Usersmeta']['setsessions'])){ ?>
				<div class="timer_container">
					<div id="custom-med-button">Meditation Stop Watch</div>
					<div id="back_to_popup1" class="close_button"><?php echo $this->Html->image('close.gif',array('width' => '21', 'height' => '21')) ?></div>
					<div class="timer_text">Your Meditation Session</div>
				</div>
				<div class="timer_counter_container">
					<?php 
					$userSession = explode(',',str_replace('{','',str_replace('}','',$userMeta['Usersmeta']['setsessions']))); 
					$totalUserSession = count($userSession);
					if($totalUserSession >=1){
						for($i=0;$i<$totalUserSession;$i++){
							$explode_session = explode(':',str_replace("'",'',$userSession[$i]));
							$userSessionValue = $explode_session[1].':'.$explode_session[2].':'.$explode_session[3];
							$convertMinutes   = $explode_session[1]*60 + $explode_session[2] + floor($explode_session[3]/60);
							$setSpan		  = ($convertMinutes == 0)?'secs':'mins';	
							$convertMinutes	  = ($convertMinutes == 0)?$explode_session[3]:$convertMinutes;?>
							<div class="time_counter counter_margin setSession"  value="<?php echo $userSessionValue?>">
								<div class="counter_number">
								<?php echo $convertMinutes;?>
								</div>
							<div class="counter_text">Mints</div>
							</div>
						<?php }
					}?>
					<div class="clear"></div>
				</div>
			<?php } else { ?>
				<div class="timer_container">
					<div id="custom-med-button">Meditation Stop Watch</div>
					<div id="back_to_popup1" class="close_button"><?php echo $this->Html->image('close.gif',array('width' => '21', 'height' => '21')) ?></div>
					<div class="timer_text">Set time for</div>
					<div class="timer_text">your Meditation Session</div>
				</div>
				<div class="timer_counter_container">
					<div class="time_counter counter_margin setSession setFBMIN<?php echo $userDefaultSession[0]?>" data-medmin="<?php echo $userDefaultSession[0]?>" value="<?php echo $defaultSession[0]?>">
						<div class="counter_number">
						<?php echo $userDefaultSession[0];?>
						</div>
						<div class="counter_text">Mints</div>
					</div>
					<div class="time_counter counter_margin setSession setFBMIN<?php echo $userDefaultSession[1]?>" data-medmin="<?php echo $userDefaultSession[0]?>" value="<?php echo $defaultSession[1]?>">
						<div class="counter_number">
						<?php echo $userDefaultSession[1];?>
						</div>
						<div class="counter_text">Mints</div>
					</div>
					<div class="time_counter counter_margin setSession setFBMIN<?php echo $userDefaultSession[2]?>" data-medmin="<?php echo $userDefaultSession[2]?>" value="<?php echo $defaultSession[2]?>">
						<div class="counter_number">
						<?php echo $userDefaultSession[2];?>
						</div>
						<div class="counter_text">Mints</div>
					</div>
					<div class="time_counter counter_margin setSession setFBMIN<?php echo $userDefaultSession[3]?>" data-medmin="<?php echo $userDefaultSession[3]?>" value="<?php echo $defaultSession[3]?>">
						<div class="counter_number">
						<?php echo $userDefaultSession[3];?>
						</div>
						<div class="counter_text">Mints</div>
					</div>
					<div class="time_counter counter_margin setSession setFBMIN<?php echo $userDefaultSession[4]?>" data-medmin="<?php echo $userDefaultSession[4]?>" value="<?php echo $defaultSession[4]?>">
						<div class="counter_number">
						<?php echo $userDefaultSession[4];?>
						</div>
						<div class="counter_text">Mints</div>
					</div>
					<div class="time_counter counter_margin setSession setFBMIN<?php echo $userDefaultSession[5]?>" data-medmin="<?php echo $userDefaultSession[5]?>" value="<?php echo $defaultSession[5]?>">
						<div class="counter_number">
						<?php echo $userDefaultSession[5];?>
						</div>
						<div class="counter_text">Mints</div>
					</div>
					<div class="time_counter">
						<div class="counter_number setSession" data-medmin="<?php echo $userDefaultSession[6]?>" value="<?php echo $defaultSession[6]?>">
						<?php echo $userDefaultSession[6];?>
						</div>
						<div class="counter_text">Mints</div>
					</div>
					<div class="clear"></div>
				</div>
			<?php }?>
			</div>
		</div>
	</div>	
	<!--------- END @ POP_UP-2 ------->

	<!----------BANNER_DATE_HOLDER --->
	<div class="popup_3_container" style="display:none;">
		<div id="fb-root"></div>
		<div id="div_popup" class="timer_form_container">
			<div class="timer_container">
				<div id="comment_message" class="timer_text">Feedback</div>
			</div>	
			<div class="timer_counter_container">
				<div id="guest" class="hidden">0</div>
				<?php echo $this->Form->create('Feedback', array('url' => array('controller' => 'feedbacks'),'id'=>'FeedbackForm'));?>
				<!----Sharing Buttons--------->
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
						$meditation_image ="http://satorio.org/img/meditation.jpg";
						?>
						<!--<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fmeditationmusic.net%2F&t=Meditation Music"
						onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
						target="_blank" title="Share on Facebook">-->
						<a class="share_button" data-mins="" data-img="<?php echo $meditation_image ?>" data-name="<?php //echo $name ?>"><? echo $this->Html->image('fb.png'); ?></a>
						</div>
						<a class="tweet" data-mins=""  href="http://satorio.org/" target="_blank"></a>
						<div class="tweetShare" style="display:none;">
							<iframe id="tweet-button" allowtransparency="true" frameborder="0" scrolling="no"
							src="http://platform.twitter.com/widgets/tweet_button.html?url=http://meditationmusic.net&amp;text=Replace%20Me&amp;count=none"
							style="width:110px; height:20px;" data-count="none"></iframe>
						</div> 
					</div>	<!----Sharing Buttons--------->
				</div>  <!----Sharing Meditation--------->
				<!---End HERe---->
				<?php echo $this->Form->textarea('Feedback.comments', array('rows'=>'6','cols'=>'20'));?>
				<div class="smiles_container">
					<?php
					echo $this->Html->link($this->Html->image('smile_big.gif', array('style' => 'margin-top:0px;')), 'javascript:void(0);', array('id'=>'5', 'alt'=>'Big Smile', 'title'=>'Big Smile', 'style'=>'border:2px solid black;', 'onClick'=>'meditationRating(5);', 'escape' => false));
					echo $this->Html->link($this->Html->image('smile_normal.gif'), 'javascript:void(0);', array('width' => '19px','height' => '19px','id'=>'4', 'alt'=>'Normal Smile', 'title'=>'Normal Smile', 'border'=>'0', 'onClick'=>'meditationRating(4);', 'escape' => false));
					echo $this->Html->link($this->Html->image('smile_indifferent.gif'), 'javascript:void(0);', array('width' => '19px','height' => '19px','id'=>'3', 'alt'=>'Indifferent', 'title'=>'Indifferent', 'border'=>'0', 'onClick'=>'meditationRating(3);', 'escape' => false));
					echo $this->Html->link($this->Html->image('smile_confused.gif'), 'javascript:void(0);', array('width' => '19px','height' => '19px','id'=>'2', 'alt'=>'Not Happy', 'title'=>'Not Happy', 'border'=>'0', 'onClick'=>'meditationRating(2);', 'escape' => false));
					echo $this->Html->link($this->Html->image('smile_frown.gif'), 'javascript:void(0);', array('width' => '19px','height' => '19px','id'=>'1', 'alt'=>'Frown', 'title'=>'Frown', 'border'=>'0', 'onClick'=>'meditationRating(1);', 'escape' => false));	
					?>
				</div><!-- smiles_container-->
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
					<?php
						echo $this->Form->submit('Close',array('class' => 'button','id' => 'closeFeedbackForm','title' => 'Close','div'	=> array('style' => 'width:100%')));
					?>
				</div>
				<?php	 	 
				echo $this->Form->end();
				echo $this->Js->writeBuffer();
				if(!$this->Session->check('userId')):?>	
					<!--Start Here-->
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
		</div><!-- end div_popup -->

		<!-- CUSTOM MEDITATION TIMER -->
			<div class="meditation-stop-watch timer_form_container">
			
				<div class="timer_container">
					<span id="back_to_popup1" class="close_button"><?php echo $this->Html->image('close.gif',array('width' => '21', 'height' => '21')) ?></span>
					<div class="timer_text">Set custom time upto 60 Minutes</div>
					<div class="timer_text">for your Meditation Session</div>
				</div>
				<div class="timer_counter_container">
					<div id="custom_session">
						<div id="custom-med-timer" data-timer="0" class="time_circles" style="padding-left:122px;width:300px;height:75px;"></div>
					</div>
					<?php
					echo $this->Form->create('Meditation', array('id' => 'timerform'));
					// hidden fields containing user location info
					echo $this->Form->hidden('modeTType', array('value'=>'play', 'id'=>'modeTType'));
					echo $this->Form->hidden('countryCode', array('value'=> $data['country_code'], 'id'=>'countryCode'));
					echo $this->Form->hidden('latitude', array('value'=> $data['lat'], 'id'=>'latitude'));
					echo $this->Form->hidden('longitude', array('value'=> $data['lon'], 'id'=>'longitude'));
					echo $this->Form->hidden('city', array('value'=> $data['city'], 'id'=>'city'));
					echo $this->Form->hidden('zipCode', array('value'=> $data['zip_code'], 'id'=>'zipCode'));
					echo $this->Form->hidden('regionName', array('value'=> $data['region_name'], 'id'=>'regionName'));	
					echo $this->Form->hidden('countryName', array('value'=> $data['country_name'], 'id'=>'countryName'));
					echo $this->Form->hidden('ipAddress', array('value'=> $data['ip_address'], 'id'=>'ipAddress'));
					echo $this->Form->hidden('status', array('value'=> 0, 'id'=>'status'));
					echo $this->Form->hidden('active', array('value'=> 4, 'id'=>'active'));
					echo $this->Form->hidden('sessionId', array('value'=>'', 'id'=>'sessionId1'));
					echo $this->Form->hidden('showPopup', array('value'=>$showpopup, 'id'=>'showPopup'));
					echo $this->Form->hidden('userType', array('value'=>$userType, 'id'=>'userType'));
					/******************** Notification will display if and only for BUTTONTYPE = play 
					suppose user first time click on "play" if its pause then again play 
					locationa notification pop up will not display at thnat time 
					********************/
					echo $this->Form->hidden('buttonType', array('value'=>'play', 'id'=>'buttonType'));
					echo $this->Form->hidden('selLocation', array('value'=>'', 'id'=>'selLocation'));
					echo $this->Form->hidden('customTotalMedTime', array('value'=>'', 'id'=>'customTotalMedTime'));
					echo $this->Js->submit('Play', array(
					'before'    => 'customTimer("play");',
					'success' 	=> 'timersoundPlay();',
					'class' 	=> 'button btn btn-med-success playTimer',
					'complete'	=> 'setsessionid();',
					'id'        => 'play',
					'div'       => false
					
					));
					
					//pause stop watch medtation
					echo $this->Js->submit('Pause', array(
					'before'    => 'customTimer("pause");',
					'class' 	=> 'button btn btn-med-success btn-danger pauseTimer',
					'id'        => 'pausew',
					'div'       => false
					));
					
					?>
				<!-- <button class="btn btn-med-success btn-danger pauseTimer" id="pausew">Pause</button>-->
					<button class="button btn btn-med-success resetTimer" id="reset" disabled="disabled">Reset</button>
					<?php
					echo $this->Js->submit('Stop', array(
					'before'    => 'customTimer("stop");',
					'class' 	=> 'button btn btn-med-success stopTimer',
					'success'   => 'completeCountdown("customtimerwatch");',
					'complete'	=> 'setsessionid();',
					'id'        => 'stop',
					'div'       => false
					));
					echo $this->Form->hidden('mp3Sound', array('value'=>'ring_v3.mp3', 'id'=>'mp3Sound'));
					echo $this->Form->hidden('ogaSound', array('value'=>'ring_v3.ogg', 'id'=>'ogaSound'));
					
					echo $this->Form->end();
					echo $this->Js->writeBuffer();
				
				   ?>
				</div>	
				<div class="clear"></div>		
			</div>
		<!-- end CUSTOM MEDITATION TIMER -->

		<div id="jquery_jplayer_1" class="jp-jplayer"></div>
	
		<div id="timer_frame" class="timer_form_container">
			<div class="timer_headline timer_container">
				<span id="back_to_popup1" class="close_button"><?php echo $this->Html->image('close.gif',array('width' => '21', 'height' => '21')) ?></span>
				<div class="timer_text">Please ensure your speakers are on</div>
				<div class="timer_text">and the volume is turned up</div>
			</div>
			<div class="timer_counter_container">
				<div id="countdown" class="timer-clock">00:00</div>
				<?php
					echo $this->Form->create('Meditation', array('style' => 'margin-top:5px;', 'id' => 'example2form'));
					// hidden fields containing user location info
					echo $this->Form->hidden('countryCode', array('value'=> $data['country_code'], 'id'=>'countryCode'));
					echo $this->Form->hidden('latitude', array('value'=> $data['lat'], 'id'=>'latitude'));
					echo $this->Form->hidden('longitude', array('value'=> $data['lon'], 'id'=>'longitude'));
					echo $this->Form->hidden('city', array('value'=> $data['city'], 'id'=>'city'));
					echo $this->Form->hidden('zipCode', array('value'=> $data['zip_code'], 'id'=>'zipCode'));
					echo $this->Form->hidden('regionName', array('value'=> $data['region_name'], 'id'=>'regionName'));	
					echo $this->Form->hidden('countryName', array('value'=> $data['country_name'], 'id'=>'countryName'));
					echo $this->Form->hidden('ipAddress', array('value'=> $data['ip_address'], 'id'=>'ipAddress'));
					echo $this->Form->hidden('showPopup', array('value'=>$showpopup, 'id'=>'showPopup'));
					echo $this->Form->hidden('status', array('value'=> $data['status'], 'id'=>'status'));
					echo $this->Form->hidden('userType', array('value'=>$userType, 'id'=>'userType'));
					echo $this->Form->hidden('modeType', array('value'=>'play', 'id'=>'modeType'));
					echo $this->Form->hidden('settimeLoc', array('value'=>'', 'id'=>'settimeLoc'));
				   //echo $this->Form->hidden('setTimethroughmail', array('value'=> $setTime, 'id'=>'setTimethroughmail'));
				
					echo $this->Js->submit( 'Play', array(
					'before'	=> 'play();addOnlineUser();',
					'update'    => '#map_container',
					'complete'	=> 'setsessionid();',	
					'success' 	=> 'soundPlay();resume();',
					'id'		=> 'start',
					'class' 	=> 'button',
					'url'       => array('action' => 'updateDuo')
					));
					echo $this->Js->submit( 'Pause', array(
					'before'	=> 'pause();deleteOnlineUser();',
					'update'    => '#map_container',
					'complete'	=> 'setsessionid();',	
					'success' 	=> 'pause_indicator_fadeOut();',
					'id'		=> 'pause',
					'class' 	=> 'button',
					'style'		=> 'display:none;',
					'url'       => array('action' => 'updateDuo')
					));
					echo $this->Js->submit( 'Stop', array(
					'before'	=> 'deleteOnlineUser();',
					'update'    => '#map_container',
					'complete'	=> 'setsessionid();',	
					'success' 	=> 'pause_indicator_fadeOut();',
					'id'		=> 'stopid',
					'class' 	=> 'button',
					'style'		=> 'display:none;',
					'url'       => array('action' => 'updateDuo')
					));
					
				if($this->Session->check('userId')):
					if(!empty($userMeta)):
						$bell = ($userMeta['Usersmeta']['filepath']!='')?$userMeta['Usersmeta']['filepath']:'ring_v3.mp3';
						echo $this->Form->hidden('mp3Sound', array('value'=> $bell, 'id'=>'mp3Sound'));
						echo $this->Form->hidden('ogaSound', array('value'=>'ring_v3.ogg', 'id'=>'ogaSound'));
					else:
						echo $this->Form->hidden('mp3Sound', array('value'=> 'ring_v3.mp3', 'id'=>'mp3Sound'));
						echo $this->Form->hidden('ogaSound', array('value'=>'ring_v3.ogg', 'id'=>'ogaSound'));
					endif;
				else:
					echo $this->Form->hidden('mp3Sound', array('value'=>'ring_v3.mp3', 'id'=>'mp3Sound'));
					echo $this->Form->hidden('ogaSound', array('value'=>'ring_v3.ogg', 'id'=>'ogaSound'));
				endif;
					echo $this->Form->hidden('mode', array('value'=>'pause', 'id'=>'mode'));
					
					echo $this->Form->hidden('setSeconds', array('value'=>'0', 'id'=>'setSeconds'));
					echo $this->Form->hidden('Hours', array('value'=>'0', 'id'=>'hours'));
					echo $this->Form->hidden('Minutes', array('value'=>'0', 'id'=>'minutes'));
					echo $this->Form->hidden('Seconds', array('value'=>'0', 'id'=>'seconds'));
					echo $this->Form->hidden('sessionId', array('value'=>'', 'id'=>'sessionId'));
					echo $this->Form->end();
					echo $this->Js->writeBuffer();									
				?>
				</div><!-- timer_counter_container-->
			<div class="clear"></div>
			</div><!-- timer frame -->
	</div>	

	<!-- location notification -->
	<div class="popup_4_container" style="display:none;">			  
		<div id="locationNotificationPopup">
			<div class="timer_container">
				<span id="back_to_popup1" class="close_button"><?php echo $this->Html->image('close.gif',array('width' => '21', 'height' => '21')) ?></span>
				<div class="timer_text">
				Would you like to use your current location or registered location ?
				</div>	
			</div>
			<div class="timer_text2 timer_counter_container">
				<input type="radio" name="location-notification" value="current" class=""> Current Location
				<input type="radio" name="location-notification" value="register-location"  class=""> Registered Location
				<input type="hidden"  name="select_timer" id="select_timer" value="timer_frame" />
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<!--------- END @ BANNER_DATE_HOLDER ------->
</div><!-- blank wrapper 1-->
