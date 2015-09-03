<h2>User Profile</h2>
<div class = "form" style="float:left;margin:22px 0px 0px 7px;padding: 0px 0px 0px 0px !important;">	
	<?php
		echo $this->Form->create('Admin',array('type' => 'file','class' => 'niceform'),array('url' => array('controller' =>'admins','action' => 'editUserProfile')));
		if(isset($userDetail)): 
			$email 					= ($userDetail['User']['email']!='') ? $userDetail['User']['email']:'N/A';
			$username 				= ($userDetail['User']['username']!='')?$userDetail['User']['username']:'N/A';
			$first_name 			= ($userDetail['User']['first_name']!='')?$userDetail['User']['first_name']:'N/A';
			$last_name 				= ($userDetail['User']['last_name']!='')?$userDetail['User']['last_name']:'N/A';
			$profile_picture 		= ($userDetail['User']['profile_picture']!='')?'../profileimg/'.$userDetail['User']['profile_picture']:'guest_avatar.jpg';
			$gender 				= ($userDetail['User']['gender']!='')?$userDetail['User']['gender']:'N/A';
			$date_of_birth 			= ($userDetail['User']['date_of_birth']!='')?$userDetail['User']['date_of_birth']:'N/A';
			$state 					= ($userDetail['User']['state']!='')?$userDetail['User']['state']:'N/A';
			$country 				= ($userDetail['User']['country']!='')?$userDetail['User']['country']:'N/A';
			$registerDate			= explode(" ",$userDetail['User']['submit_date']);
		endif;	
		?>
		
		<div class="imgSection registerUser">
		<div class="leftSide">User Image</div>
		<div class="rightSide">
			<?php echo $this->Html->image($profile_picture, array('style' => 'box-shadow: 1px 1px 17px 2px #C4CFD4;border:none; margin: 7px 0 0 -3px;','width'=>'100','height'=>'100')); ?></div>	  
		</div>	
		<div class="Username registerUser">
		<div class="leftSide">Username</div>
		<div class="rightSide">
			<?php echo $username; ?></div>	  
		</div>	
		<div class="Gender registerUser">
		<div class="leftSide">Gender</div>
		<div class="rightSide">
			<?php echo $gender; ?></div>	  
		</div>	
		<div class="State registerUser">
		<div class="leftSide">State</div>
		<div class="rightSide">
			<?php echo $state; ?></div>	  
		</div>	
		<div class="State registerUser">
		<div class="leftSide">Country</div>
		<div class="rightSide">
			<?php echo $country; ?></div>	  
		</div>
		<div class="registered registerUser">
		<div class="leftSide">Register Date</div>
		<div class="rightSide">
			<?php echo  $registerDate[0];?></div>	  
		</div>		
		<div class="totalMed registerUser">
		<div class="leftSide">Total Meditation</div>
		<div class="rightSide">
			<?php echo $totalSession." (HH:MM:SS)"; ?></div>	  
		</div>	
		<div class="lastMed registerUser">
		<div class="leftSide">Last Meditation</div>
		<div class="rightSide">
			<?php
				if($last!="N/A"): 
				echo $last." (HH:MM:SS)"; 
				else:
				echo $last;
				endif;?></div>	  
		</div>	
		
</div>