<h2>Change Password</h2>
      <div class="form">
	    <?php 
		echo $this->Form->create("Admin",array('url'=>array('action' =>'changePassword'),
											  'class' => 'niceform',
											   'id' => 'adminSettingForm'));
		?>
		
                <fieldset>
					<dl>
						<dt><label for="username">New Password:</label></dt></dt>
						<dd><?php echo $this->Form->input('newPassword',array('type'=> 'password','label' => false,'size' => 54));?></dd>
						</dl>
                    <dl>
						<dt><label for="firstName">Verify Password:</label></dt></dt>
						<dd><?php echo $this->Form->input('verifyPassword',array('type'=> 'password','label' => false,'size' => 54));?></dd>
					</dl>
					<dl class="submit">
					 <?php echo $this->Form->submit('Change Password',array('id' => 'submit','class' => ' button-action-active updateManager','style'=>'width:144px !important;'));
                    	//<input type="submit" name="submit" id="submit" value="Submit" />
					?> </dl>                    
                </fieldset>
                    <?php echo $this->Form->end();?>
</div>					
