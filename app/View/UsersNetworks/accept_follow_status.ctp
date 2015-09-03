<?php 
	if(!empty($followRequest)):?>				
	<div class = "innerFollow">
		Friend Requests
	</div>
<?php		foreach($followRequest as $request):?>	
	<div class="personDetailSection">
		<div class='userSection'>
			<div class="leftSection">
			<?php 
				$profile_picture = ($request['User']['profile_picture']!='')?'../profileimg/'.$request['User']['profile_picture']:'guest_avatar.jpg';
				echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;5px 2px 4px 3px','width'=>'50','height'=>'42')); 
			?>
			</div>
			<div class="rightSection">
				<div class="details" style="font-weight:bold;">
				<?php	
				echo $request['User']['first_name']." ".$request['User']['last_name'];
				?></div>
				<div class="details">
				<?php 
				$city = (empty($request['User']['city']))?'-':$request['User']['city'];
				$country = (empty($request['User']['state']))?'-':$request['User']['country'];
				echo $city.",".$country;
				?>
				</div>
			</div>
			<div class="followButtons">
				<div class="accept userButton">
				<?php
					echo $this->Form->create('UsersNetworks',array('action' => 'setFollowStatus','id' => 'form_'.$request['UsersNetwork']['request_by']));
					echo $this->Form->input('Id',array('label' => false,'type' => 'hidden','value'=>$request['UsersNetwork']['id']));
					echo $this->Form->input('RequestId',array('label' => false,'type' => 'hidden','value'=>$request['UsersNetwork']['request_by']));
					echo $this->Js->submit('Accept',array('id'   	 => 'statusButtonAccept_'.$request['UsersNetwork']['request_by'],
														  'update'    => '#FollowSection',
														  'name'		 =>	'accept_'.$request['UsersNetwork']['request_by'],	
														  'class' 	  => 'button-action-active',
														   'url'       => array('controller'=>'UsersNetworks', 'action' => 'acceptFollowStatus')
															));
					echo $this->Js->writeBuffer();
					echo $this->Form->end();									
				?>
				</div>
				<div class="ignore userButton">
				<?php
					echo $this->Form->create('UsersNetworks',array('action' => 'setFollowStatus','id' => 'form_'.$request['UsersNetwork']['request_by']));
					echo $this->Form->input('RequestId',array('label' => false,'type' => 'hidden','value'=>$request['UsersNetwork']['request_by']));
					echo $this->Form->input('Id',array('label' => false,'type' => 'hidden','value'=>$request['UsersNetwork']['id']));
					echo $this->Js->submit('Decline',array('id'   	 => 'statusButtonDelete_'.$request['UsersNetwork']['request_by'],
														 'update'    => '#FollowSection',
														 'name'		 =>	'delete_'.$request['UsersNetwork']['request_by'],	
														  'class' 	  => 'button-action-active',
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
<div class="markline" style="padding:0px;margin-top:10px;"><div class="staticcontrol"><div class="hrcenter-white"></div></div></div>
<?php endif;?>