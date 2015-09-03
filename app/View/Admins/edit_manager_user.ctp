<?
	if(isset($managerUserDetail)):
		$username 	= $managerUserDetail['Admin']['username'];
		$firstName 	= $managerUserDetail['Admin']['firstName'];
		$lastName 	= $managerUserDetail['Admin']['lastName'];
		$email 		= $managerUserDetail['Admin']['email'];
		$password 	= $managerUserDetail['Admin']['passwords'];
		$managerType= $managerUserDetail['Admin']['previleges'];		
	endif;	
	if(isset($error)):
	echo '<div class="error_box">'.$error.'</div>';
	endif;
?>
<h2 style="background:rgb(48,172,216) !important;color:#ffffff !important;padding:6px 0px 8px 16px !important;border-radius: 6px;opacity:0.84;">Manager Profile</h2>
 <div id="validateMessage"></div>
 <div class="form">
        <?php 
		echo $this->Form->create("Admin",array('url'=>array('action' =>'editManagerUser',$managerUserDetail['Admin']['id']),
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
                        <dt><label for="userPreviliges">User Previliges:</label></dt>
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
					 <?php echo $this->Form->submit('Update Manager',array('id' => 'submit','class' => 'button-action-active updateManager','style' => 'width:143px !important;'));
                    	//<input type="submit" name="submit" id="submit" value="Submit" />
					?> </dl>
                     
                     
                    
                </fieldset>
                    <?php echo $this->Form->end();?>
</div>					