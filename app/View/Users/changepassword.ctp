<?php echo $this->Form->create('User',array('action' => 'changepassword'));?>
<div class="page_heading"><h1>Change Password</h1></div>
<div class="page_container">
	<div class="packet_combo">
		<div class="packet_left">	
			<div class="field_label">New Password</div>
			<div class="field">
				<?php echo $this->Form->input('newPassword',array('label' => false, 'class'=>'input_text','value'=>$newPassword, 'type' => 'password'));?>				
			</div>
		</div>	
		<div class="packet_right">		
			<div class="field_label">Confirm Password</div>
			<div class="field">
				<?php echo $this->Form->input('verifyPassword',array('label' => false, 'class'=>'input_text','value'=>$verifyPassword, 'type' => 'password'));?>				
			</div>
		</div>
	</div>
	
	<div class="packet_combo">	
		<div class="packet_left"><?php echo $this->Form->button('Cancel',array('class'=>'button edit_profile_btn','div'=>false,'id'=>'cancel-change-password'));?></div>
		<div class="packet_right"><?php echo $this->Form->submit('Change Password',array('class'=>'button edit_profile_btn','style'=>'float:left;','div'=>false));?></div>		
	</div>
</div>
<?php echo $this->Form->end(); ?>