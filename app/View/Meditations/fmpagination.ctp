<script type="text/javascript">
$(document).ready(function(){

	$('.demo1').TrackpadScrollEmulator();
	$('.demo2').TrackpadScrollEmulator();
	 
});
</script>
<?php 

//echo"<pre>";print_r($finished_meditations);







								if(is_array($finished_meditations) && !empty($finished_meditations)): 
									foreach($finished_meditations as $list):?>
										<script type="text/javascript">
										$(document).ready(function(){
										
											$("#submitCommentButtonFinish_<?php echo $list['Meditation']['id'];?>").attr("disabled", "disabled");
											$("#submitCommentButtonFinish_<?php echo $list['Meditation']['id'];?>").css('opacity',0.6);
											$("#showCommentFinish-<?php echo $list["Meditation"]["id"];?>").click(function(){
												htm = $(this).text().trim();
												$(this).text(htm == "Show Comments"? "Hide Comments": "Show Comments"); 
												$("#hide-show-commentFinish_<?php echo $list["Meditation"]["id"];?>").slideToggle();
											});
											$("#makeCommentFinish_<?php echo $list['Meditation']['id'];?>").keyup(function(){
												if($(this).val().length == 0){
													$("#submitCommentButtonFinish_<?php echo $list['Meditation']['id'];?>").attr("disabled", "disabled");
													$("#submitCommentButtonFinish_<?php echo $list['Meditation']['id'];?>").css('opacity',0.6);
												}	
												else{
													$("#submitCommentButtonFinish_<?php echo $list['Meditation']['id'];?>").removeAttr("disabled");
													$("#submitCommentButtonFinish_<?php echo $list['Meditation']['id'];?>").css('opacity',1);
												}
											});
											
											$("#commentMeForm-<?php echo $list["Meditation"]["id"];?>").click(function(){
												//htm = $(this).text().trim();
												//$(this).text(htm == "Show Comments"? "Hide Comments": "Show Comments"); 
												console.log("hi");
												$("#commentMeFormSection-<?php echo $list["Meditation"]["id"];?>").slideToggle();
											});
										})
										</script>
										<div class="middle-midd-box">
											<div class="middle-midd-boxinner">
												 <div class="middle-midd-boxinner-imgleft"><?php 
												 		$profile_picture 	= ($list['User']['profile_picture']!='')?'../profileimg/'.$list['User']['profile_picture']:'guest_avatar.jpg';
												 		echo $this->Html->image($profile_picture, array('style' => 'border:none;','width'=>'80','height'=>'88')); ?>
												 	<?php if($list['Meditation']['user_type'] == "Registered" && $this->Session->check('userId')):
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
																									  'class' 	  => 'button',
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
															?></h2>
															<div class="session_features">Meditation session time:<span><?php echo $list['Meditation']['session_time'].'&nbsp;minutes'; ?></span></div>
															<div class="session_features">Meditation session rating:<span><?php echo isset($list['Feedback']['rating'])?$list['Feedback']['rating'].'/5':'<span class="not_available">Not Available</span>'; ?></span></div>
															<?php if($this->Session->check('userId')) {//Show Comments if Users is not Guest?>
																<div class="session_features">Comments:<span><?php echo isset($list['Feedback']['feedback'])?$list['Feedback']['feedback']:'<span class="not_available">Not Available</span>'; ?></span>
																</div>
															<?php }?>	
														<div class="session_features">Meditation Date & Time:<span><?php echo date($list['Meditationsmeta']['submitDate']);?></span>
														</div>	
														</div><!-- info div-->
														<div class="wrap_buttons">	
															<?php if($list['Meditation']['user_type'] == "Registered" && $this->Session->check('userId')):?>
															<div class="button showCommntForm" id="commentMeForm-<?php echo $list['Meditation']['id']?>">Comment Here</div>	
															<?php endif;?>
															<?php if(!empty($list['Comment'])):?>
															<div id="showCommentFinish-<?php echo $list["Meditation"]["id"];?>" class="showCommnt button">Show Comments</div>
															<?php endif;?>
															<div class="clear"></div>
														</div>		
													</div>	
													<div class="session_features">
													
													
														<div id="commentSectionFinish_<?php echo $list["Meditation"]["id"];?>">
															<!-- comment box-->
															
															<?php if(!empty($list['Comment'])):?>
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
																.tse-scrollable {
																overflow-y: scroll;
																}
																.tse-scrollable.horizontal {
																overflow-x: scroll;
																overflow-y: hidden;
																}
																</style>
																</noscript>
																<div class = "userComments" id="hide-show-commentFinish_<?php echo $list["Meditation"]["id"];?>" style="display:none;">						                                  		  <div class="tse-scrollable demo1">
																	<div class="tse-content">
																	<?php //echo"<pre>";print_r($list['Comment']);?>
																<?php foreach($list['Comment'] as $comment): ?>
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
																 </div>	 
																</div>	<!--Hide Show Comment Section end here-->
															<? endif;?>	
														</div><!--Comment Section End Here-->
													
											<!--Comment Input Box--->
											<?php if($list['Meditation']['user_type'] == "Registered" && $this->Session->check('userId')):
															echo $this->Form->create('Comment');
															?>
															
														<div class="session_features inlineText" id="commentMeFormSection-<?php echo $list['Meditation']['id']?>" style="display:none;">
															<div style="float:left;">
																<div class="img">
																<?php $profile_picture 	= ($userProfile[0]['User']['profile_picture']!='')?'../profileimg/'.$userProfile[0]['User']['profile_picture']:'guest_avatar.jpg';
							
																echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;','width'=>'33','height'=>'29')); ?> 
																</div>
															<div class="session_features_fields">
															<?php 
															echo $this->Form->input('Comment.MeditationId',array('type'=>'hidden','value' => $list['Meditation']['id']));
															echo $this->Form->input('Comment.UserId',array('type'=>'hidden','value' => $list['Meditation']['user_id']));
															echo $this->Form->input('Comment.UserComment',array('label' => false,'class'=>'makeComment','id'=>'makeCommentFinish_'.$list['Meditation']['id'],'placeholder' => 'Write a Comment'));
															echo $this->Js->submit('Submit',array('id'		 => 'submitCommentButtonFinish_'.$list['Meditation']['id'],
																								 'update'    => '#commentSectionFinish_'.$list['Meditation']['id'],
																								 'complete'	  => 'commentSubmit();',	
																								//  'success' => $this->Js->get('#commentSectionNear_'.$list['Meditation']['id'])->effect('show', array('buffer' => false)),
																								  'class' 	  => 'button',
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
											<div class="no-records">Currently there is 0 result for finished meditating!!!</div>
											</div>
										</div>	
									<?php
									 endif; ?>	
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
							</div>		<!--Bottom Link Ends Here-->