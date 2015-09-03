 <!--
     <h2>Warning Box examples</h2>
      
     <div class="warning_box">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.
     </div>
     <div class="valid_box">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.
     </div>
     <div class="error_box">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.
     </div>  
     -->    
	 <h2 style="background:none !important;color:#256C89 !important;border-radius:0px !important;">Welcome Admin</h2><hr width=625>
	 <!--New Section started here-->
	 <div id="userListContainer" style="padding: 4px 0 39px 17px;float:left;">
	 	<div id="onlineUsers" class = "adminDash">
			<div id="innerHead"><h2 style = "border-radius:0px !important;">Total Number of Online Users</h2><span style="float: left;font-size: 45px;font-style: italic;font-weight: normal;padding: 5px 0 0;text-align: center;width: 100%;color:#256C89;"><?=$total_online_users?></span></div>
		</div>
		
		<div id="meditationUsers" class = "adminDash">
			<div id="innerHead"><h2 style = "border-radius:0px !important;">Total Number of Registered Users</h2><span style="float: left;font-size: 45px;font-style: italic;font-weight: normal;padding: 5px 0 0;text-align: center;width: 100%;color:#256C89;"><?=$totalMeditationUser?></span></div>
		</div>
		
		<div id="timerUsers" class = "adminDash" style="margin-right:0px;">
			<div id="innerHead"><h2 style = "border-radius:0px !important;">Total Number of Meditated Users</h2><span style="float: left;font-size: 45px;font-style: italic;font-weight: normal;padding: 5px 0 0;text-align: center;width: 100%;color:#256C89;"><?=$totalTimerUser?></span></div>
		</div>
		
		<div id="managerUsers" class = "adminDash">
			<div id="innerHead"><h2 style = "border-radius:0px !important;">Total Meditation Sessions on Site</h2><span style="float: left;font-size: 45px;font-style: italic;font-weight: normal;padding: 5px 0 0;text-align: center;width: 100%;color:#256C89;"><?=$total_med_logged?></span></div>
		</div>
		
		<div id="managerUsers" class = "adminDash">
			<div id="innerHead"><h2 style = "border-radius:0px !important;">Total Meditation Minutes on Site</h2><span style="float: left;font-size: 45px;font-style: italic;font-weight: normal;padding: 5px 0 0;text-align: center;width: 100%;color:#256C89;"><?=$total_med_session?></span></div>
		</div>
		
		
	 </div> 
	 
	 <!--New Section Ended Here-->
	<?php /*
	 <div id="display-message"></div>
	 <div id="validateMessage"></div>
     <h2 style="background:rgb(48,172,216) !important;color:#ffffff !important;padding:6px 0px 8px 16px !important;border-radius: 6px;opacity:0.84;">Add Manager User</h2>
		     
         <div class="form">
        <?php 
		echo $this->Form->create("Admins",array(//'url'=>array('action' =>'addUser'),
											  'class' => 'niceform',
											   'id' => 'adminSettingForm'));
		?>
		
                <fieldset>
					<dl>
						<dt><label for="username">Username:</label></dt>
						<dd><?php echo $this->Form->input('username',array('label' => false,'size' => 54,'placeholder' => 'Username'));?></dd>
						</dl>
                    <dl>
						<dt><label for="firstName">First Name:</label></dt>
						<dd><?php echo $this->Form->input('FirstName',array('label' => false,'size' => 54,'placeholder' => 'First Name'));?></dd>
					</dl>
                    <dl>
						<dt><label for="lastName">Last Name:</label></dt>
						<dd><?php echo $this->Form->input('LastName',array('label' => false,'size' => 54,'placeholder' => 'Last Name'));?></dd>
					</dl>
					<dl>
                        <dt><label for="email">Email Address:</label></dt>
                        <dd><?php echo $this->Form->input('Email',array('label' => false,'size' => 54,'placeholder' => 'Email'));?>
						<!--<input type="text" name="" id="" size="54" />--></dd>
                    </dl>
                    <dl>
                        <dt><label for="password">Password:</label></dt>
                        <dd><!--<input type="text" name="" id="" size="54" />-->
						<?php echo $this->Form->input('Password',array('label' => false,'size' => 54,'type' =>'password','placeholder' => 'Password'));?></dd>
                    </dl>
                    
                    
                    <dl>
                        <dt><label for="userPreviliges">Select User Previliges:</label></dt>
                        <dd>
							<?php echo $this->Form->input('ManagerType',array('type'=>'select','options'=>array('Admin','Moderate','Editor'),
																			'label'=>false,'size' => 1,'class' => 'mySelect')); 
								  echo '<span>'.$this->Html->image('admin/img/tooltip.png',array('class' => 'question-mark')).'</span>';
											
                            	/*<select size="1" name="userType" id="">
                                <option value="Admin">Admin</option>
                                <option value="Moderate">Moderate</option>
                                <option value="Editor">Editor</option>
                            </select>*/?>
							<?php /*
                       		<div id="text-help" style="display:none;"><b>Admin:</b> Full Access <b>Moderator:</b> Limited Access <b>&nbsp;&nbsp;&nbsp;Editor:</b>&nbsp;Very Limited</div>
					    </dd>
                    </dl>
					<dl class="submit">
					 <?php //echo $this->Form->submit('Add User',array('id' => 'submit'));
                    	echo $this->Js->submit('Add Manager',array(
																	'before' =>'return managerValidate();',
																	'update' => '#display-message',
																	'class'	 =>	'button-action-active updateManager',
																	'url'=>array('controller' => 'admins','action' => 'addUser')));
						echo $this->Js->writeBuffer();
						//<input type="submit" name="submit" id="submit" value="Submit" />
					?> </dl>
                     
                     
                    
                </fieldset>
                   <?php echo $this->Form->end();?>
                     
               
         </div>  */?>
      
     