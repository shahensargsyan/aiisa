<?php 
if(is_array($meditating_now) && !empty($meditating_now)):
	foreach($meditating_now as $list):?>
		<script type="text/javascript">
		$(document).ready(function(){
			$("#submitCommentButton_<?php echo $list['Meditation']['id'];?>").attr("disabled", "disabled");
			$("#submitCommentButton_<?php echo $list['Meditation']['id'];?>").css('opacity',0.6);
			$("#showCommentNow-<?php echo $list["Meditation"]["id"];?>").click(function(){
				htm = $(this).text().trim();
				$(this).text(htm == "Show Comments"? "Hide Comments": "Show Comments"); 
				$("#hide-show-commentNow_<?php echo $list["Meditation"]["id"];?>").slideToggle();
			});
			$("#makeComment_<?php echo $list['Meditation']['id'];?>").keyup(function(){
				if($(this).val().length == 0){
					$("#submitCommentButton_<?php echo $list['Meditation']['id'];?>").attr("disabled", "disabled");
					$("#submitCommentButton_<?php echo $list['Meditation']['id'];?>").css('opacity',0.6);
				}	
				else{
					$("#submitCommentButton_<?php echo $list['Meditation']['id'];?>").removeAttr("disabled");
					$("#submitCommentButton_<?php echo $list['Meditation']['id'];?>").css('opacity',1);
				}
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
							<div id="followSection_<?php echo $list['Meditation']['id'];?>" class="session_features" style="padding: 7px 0 0 4px;">
								<div class="innerFollow">
							<?php   echo $this->Form->create('UsersNetworks');
									echo $this->Form->input('personToFollow',array('label'=> false,'type'=>'hidden','value'=>$list['Meditation']['user_id']));
									echo $this->Form->input('meditationId',array('label'=> false,'type'=>'hidden','value'=>$list['Meditation']['id']));
									echo $this->Js->submit('Follow',array('id'   	 => 'followButton_'.$list['Meditation']['id'],
																		  'update'    => '#followSection_'.$list['Meditation']['id'],
																		// 'complete'	  => 'commentSubmit();',	
																		//  'success' => $this->Js->get('#commentSectionNear_'.$list['Meditation']['id'])->effect('show', array('buffer' => false)),
																		  'class' 	  => 'button-action-active',
																		  'style'     => 'float:left;height: 19px;width: 70px;font-size:13px !important;font-weight:normal !important;',
																		  'url'       => array('controller'=>'UsersNetworks', 'action' => 'followUser')
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
						<div class="session_features">Meditation Date & Time:<span><?php echo date($list['Meditationsmeta']['submitDate']);?></span>
															</div>
					</div>	
					<div class="session_features">
						<div id="commentSectionNow_<?php echo $list["Meditation"]["id"];?>">
							<!-- comment box-->
							
							<?php if(!empty($list['Comment'])):?>
								<div id="showCommentNow-<?php echo $list["Meditation"]["id"];?>" class="showCommnt">Show Comments</div>
								<div class = "userComments" id="hide-show-commentNow_<?php echo $list["Meditation"]["id"];?>" style="height:auto;width:100%;float:left;display:none;">						
								<?php foreach($list['Comment'] as $comment): ?>
									<div class="commentBox" style="width:98%;">
										<div style="float:left;">
											<div id="img">
												<?php 
												$profile_picture 	= ($comment['User']['profile_picture']!='')?'../profileimg/'.$comment['User']['profile_picture']:'guest_avatar.jpg';
												echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;margin: 7px 0 0 1px;','width'=>'33','height'=>'28')); ?>
											</div>
											<div id="personCommented"><?php echo $comment['User']['first_name']." ".$comment['User']['last_name'];?></div>
											<div class="comment"><?php echo $comment['comment'];?></div>
										</div>
									</div>
								<?php endforeach;?>
								</div>	<!--Hide Show Comment Section end here-->
							<? endif;?>	
						</div><!--Comment Section End Here-->
					
			<!--Comment Input Box--->
			<?php if($list['Meditation']['user_type'] == "Registered" && $this->Session->check('userId')):
							echo $this->Form->create('Comment');
							?>
							
						<div class="session_features inlineText">
							<div style="float:left;">
								<div class="img">
								<?php		$profile_picture 	= ($userProfile[0]['User']['profile_picture']!='')?'../profileimg/'.$userProfile[0]['User']['profile_picture']:'guest_avatar.jpg';

								echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;','width'=>'33','height'=>'29')); ?> 
								</div>
							<div style="float:left;width:347px;">
							<?php 
							echo $this->Form->input('Comment.MeditationId',array('type'=>'hidden','value' => $list['Meditation']['id']));
							echo $this->Form->input('Comment.UserId',array('type'=>'hidden','value' => $list['Meditation']['user_id']));
							echo $this->Form->input('Comment.UserComment',array('label' => false,'class'=>'makeComment','id'=>'makeComment_'.$list['Meditation']['id'],'placeholder' => 'Write a Comment','style' => 'float:left;width:258px;padding: 0 0 0 5px;border-radius: 3px;margin-right:5px;height: 26px;'));
					
							echo $this->Js->submit('Submit',array('id'		 => 'submitCommentButton_'.$list['Meditation']['id'],
																 'update'    => '#commentSectionNow_'.$list['Meditation']['id'],
																 'complete'	  => 'commentSubmit();',	
																//  'success' => $this->Js->get('#commentSectionNear_'.$list['Meditation']['id'])->effect('show', array('buffer' => false)),
																  'class' 	  => 'button-action-active',
																  'style'     => 'float:left;height: 29px;',
																  'url'       => array('controller'=>'comments', 'action' => 'submitNowComment')
																));
							?>		
							</div>
							</div>
							</div>
							<?php 
							echo $this->Form->end();
							echo $this->Js->writeBuffer();
								//endif;
							endif;?>
			<!--Comment Input End Box-->
			</div><!--Session Features END hERE-->
			</div><!--Middle Midd Box Inner End Here-->

		</div><!--Middle Midd Box End-->
	<?php endforeach; 
			else:
		?>
		<div class="middle-midd-box">
				<div class="middle-midd-boxinner">
				 <div class="no-records">Currently there is 0 result for meditators now !!!</div>
				</div>
		</div>	
		<?php
	endif; ?>	
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
</div>	<!--Bottom Link Ends Here-->	