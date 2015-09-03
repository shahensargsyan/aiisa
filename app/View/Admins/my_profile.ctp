<div class="lightModalOverlay"></div>		
<? 
	if(isset($profile)):
		$username 	= $profile['Admin']['username'];
		$firstName 	= $profile['Admin']['firstName'];
		$lastName 	= $profile['Admin']['lastName'];
		$email 		= $profile['Admin']['email'];
		$password 	= $profile['Admin']['passwords'];
		$managerType= $profile['Admin']['previleges'];		
	endif;	
	if(isset($error)):
	echo '<div class="error_box">'.$error.'</div>';
	endif;
?>
 <div id="validateMessage"></div>
<h2>My Profile</h2>
 <div class="form">
        <?php 
		echo $this->Form->create("Admin",array('url'=>array('action' =>'myProfile'),
											  'class' => 'niceform',
											   'id' => 'adminSettingForm'));
		?>
		
                <fieldset>
					<dl>
						<dt><label for="username">Username:</label></dt></dt>
						<dd><?php echo $this->Form->input('Admin.username',array('value' => $username,'label' => false,'size' => 54));?></dd>
						</dl>
                    <dl>
						<dt><label for="firstName">First Name:</label></dt></dt>
						<dd><?php echo $this->Form->input('FirstName',array('value' => $firstName,'label' => false,'size' => 54));?></dd>
					</dl>
                    <dl>
						<dt><label for="lastName">Last Name:</label></dt></dt>
						<dd><?php echo $this->Form->input('LastName',array('value' => $lastName,'label' => false,'size' => 54));?></dd>
					</dl>
					<dl>
                        <dt><label for="email">Email Address:</label></dt>
                        <dd><?php echo $this->Form->input('Admin.Email',array('value' => $email,'label' => false,'size' => 54));?>
						<!--<input type="text" name="" id="" size="54" />--></dd>
                    </dl>
                  <!--  <dl>
                        <dt><label for="password">Change Password:</label></dt>
                        <dd><!--<input type="text" name="" id="" size="54" />-->
						<?php //echo $this->Form->input('Password',array('value' => $password,'label' => false,'size' => 54,'type' =>'password'));?><!--</dd>
                    </dl>
                    -->
                    
                    <dl>
                        <dt><label for="userPreviliges">Select User Previliges:</label></dt>
                        <dd>
							<?php echo $this->Form->input('ManagerType',array('type'=>'select','options'=>array('Admin','Moderate','Editor'),
																			'label'=>false,'size' => 1,'default' => $managerType,'class' => 'mySelect')); 
								  echo '<span>'.$this->Html->image('admin/img/tooltip.png',array('class' => 'question-mark')).'</span>';
											
                            	/*<select size="1" name="userType" id="">
                                <option value="Admin">Admin</option>
                                <option value="Moderate">Moderate</option>
                                <option value="Editor">Editor</option>
                            </select>*/?>
                       		<div id="text-help" style="display:none;"><b>Admin:</b> Full Access <b>Moderator:</b> Limited Access <b>&nbsp;&nbsp;&nbsp;Editor:</b>&nbsp;Very Limited</div>
					    </dd>
                    </dl>
					<!--
					<dl>
				    	<div class="newPasswordLink" style="text-decoration:underline;cursor:pointer;">Click Here to Set New Password</div>
						<div id="closelink"style="display:none;text-decoration:underline;cursor:pointer;">Close</div>
					</dl>
					<div id="password-cont">
					<dl>
						<dt>New Password:</dt>
						<dd><?php //echo $this->Form->input('NewPassword',array('id' =>'newPassword','label' =>false,'size' =>54));?></dd>
					</dl>
					<dl>
						<dt>Confirm Password:</dt>
						<dd><?php //echo $this->Form->input('ConfirmPassword',array('id' =>'cnfPassword','label' =>false,'size' =>54));?></dd>
					</dl>
						</div>-->			
					<dl class="submit">
					 <?php echo $this->Form->submit('Save',array('id' => 'submit','class' => 'update button-action-active updateManager'));
                    	//<input type="submit" name="submit" id="submit" value="Submit" />
					?> </dl>
                     
                     
                    
                </fieldset>
                    <?php echo $this->Form->end();?>
	</div>					