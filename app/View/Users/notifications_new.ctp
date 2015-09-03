<div class="page_heading"><h1>Notifications</h1></div>	
<div id="div_popup1" style="display:none;"></div>
<div class="page_container">
	<!--FriendRequest Section-->	
	<?php if(!empty($followRequest)): ?>
		<div class = "followRequestSection" id="FollowSection">
				<div class="innerFollow">Friend Requests</div>
				<?php foreach($followRequest as $request):?>	
					<div class="personDetailSection">
						<div class='userSection'>
							<div class="leftSection">
								<?php 
								$profile_picture = ($request['users']['profile_picture']!='')?'../profileimg/'.$request['users']['profile_picture']:'guest_avatar.jpg';
								echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;5px 2px 4px 3px','width'=>'50','height'=>'50')); 
								?>
							</div>
							<div class="rightSection">
								<div class="details" style="font-weight:bold;">
									<?php echo $request['users']['first_name']." ".$request['users']['last_name']; ?>
								</div>
								<div class="details">
									<?php 
									$city = (empty($request['users']['city']))?'-':$request['users']['city'];
									$country = (empty($request['users']['state']))?'-':$request['users']['country'];
									echo $city.",".$country;
									?>
								</div>
							</div>
							<div class="followButtons">
								<div class="accept userButton">
									<?php
									echo $this->Form->create('UsersNetworks',array('action' => 'setFollowStatus','id' => 'form_'.$request['users_networks']['request_by']));
									echo $this->Form->input('Id',array('label' => false,'type' => 'hidden','value'=>$request['users_networks']['id']));
									echo $this->Form->input('RequestId',array('label' => false,'type' => 'hidden','value'=>$request['users_networks']['request_by']));
									echo $this->Js->submit('Accept',array('id'   	 => 'statusButtonAccept_'.$request['users_networks']['request_by'],
																		  'update'    => '#FollowSection',
																		  'name'		 =>	'accept_'.$request['users_networks']['request_by'],	
																		  'class' 	  => 'button',
																		   'url'       => array('controller'=>'UsersNetworks', 'action' => 'acceptFollowStatus')
																			));
									echo $this->Js->writeBuffer();
									echo $this->Form->end();									
									?>
								</div>
								<div class="ignore userButton">
									<?php
									echo $this->Form->create('UsersNetworks',array('action' => 'setFollowStatus','id' => 'form_'.$request['users_networks']['request_by']));
									echo $this->Form->input('RequestId',array('label' => false,'type' => 'hidden','value'=>$request['users_networks']['request_by']));
									echo $this->Form->input('Id',array('label' => false,'type' => 'hidden','value'=>$request['users_networks']['id']));
									echo $this->Js->submit('Decline',array('id'   	 => 'statusButtonDelete_'.$request['users_networks']['request_by'],
																		 'update'    => '#FollowSection',
																		 'name'		 =>	'delete_'.$request['users_networks']['request_by'],	
																		  'class' 	  => 'button',
																		  'url'       => array('controller'=>'UsersNetworks', 'action' => 'declineFollowStatus')
																		));
									
									echo $this->Js->writeBuffer();
									echo $this->Form->end();
									?>
								</div>
							</div>	
						</div>
					</div>	
				<?php endforeach;?>
				<div class="markline"><div class="staticcontrol"><div class="hrcenter-white"></div></div></div>	
			</div><!--FollowRequestSection Ends Here-->	
	<?php endif; ?>	
	<!--<div class="packet_combo">Updates</div>-->
	<div class="liveUpdates">
	
	<?php //echo"<pre>";print_r($updates1);?>
		<?php if(!empty($updates1)):?>
			<div class="userUpdates">
				<?php foreach($updates1 as $val):?>
					<div class="userTab">
						<?php if(isset($val['meditations'])):
							echo '<div style="background:#000;padding: 5px;"><span style="font-weight:bold; padding: 4px 0 5px;">'.$val['users']['first_name']." ".$val['users']['last_name']."</span> has Started Meditation</div><hr>"; 
							echo '<div style="color:#0952a0;float:left; background:#ccc;width:100%;font-weight:bold"><span style="padding: 5px 0 5px 5px;float:left;">Meditation Time:	'.$val['meditations']['session_time'].'</span></div>';
						else:
							echo '<div style="background:#000;padding: 5px;"><span style="font-weight:bold;padding: 4px 0 5px;">'.$val['users']['first_name']." ".$val['users']['last_name']." </span>has updated his Profile Status</div><hr>";
							echo '<div style="color:#0952a0;float:left; background:#ccc;width:100%;font-weight:bold"><span style="padding: 5px 0 5px 5px;float:left;">'.$val['users']['profile_message'].'</span></div>';
						endif;
						?>
					</div>
				<?php endforeach;?>
			</div>
		<?php else: ?>
			<div class="userUpdates">
				<div class="userTab" style="margin:7px 0 8px;">
					<?php echo "<div style='padding:6px;'>No updates available.</div>";?>
				</div>  
			</div>  	   
		<?php endif; ?>
	</div>
</div>