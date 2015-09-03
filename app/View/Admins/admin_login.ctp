  	 <div class="login_form">
         
         <h3>Admin Panel Login <hr width="549px;"></h3>
         <!--<a href="#" class="forgot_pass">Forgot password</a> -->
         
         <?php //<form action="" method="post" class="niceform">
		 echo $this->Form->create('Admin',array('class' => 'niceform'),array('url' =>array('controller' => 'admins','action' => 'adminLogin'))); ?>
                <fieldset>
                    <dl>
                        <dt><label for="email" style="margin:0px 0px 0px 49px;">Username:</label></dt>
                        <dd>
						<?php echo $this->Form->input('username', array('label' => false, 'value'=>$username, 'size' => 54,'placeholder' => 'Username')); ?>
						<!--<input type="text" name="" id="" size="54" />--></dd>
                    </dl>
                    <dl>
                        <dt><label for="password" style="margin:0px 0px 0px 49px;">Password:</label></dt>
                        <dd>
						<?php echo $this->Form->input('password', array('label' => false, 'value'=>$password, 'size' => 54,'placeholder' => 'Password')); ?>
						<!--<input type="text" name="" id="" size="54" />--></dd>
                    </dl>
                    
                    <dl>
                        <dt><label></label></dt>
                        <dd>
					<!--	
                    <input type="checkbox" name="interests[]" id="" value="" /><label class="check_label">Remember me</label>-->
                        </dd>
                    </dl>
                    
                     <dl class="submit">
					 <?php 
							echo $this->Form->submit('Login', array('formnovalidate' => true, 'class'=>'button-action-active login','style' => '  background: #FFFFFF;
																																			border-radius: 5px;
																																			box-shadow: 1px 2px #57767E;
																																			border: 1px solid;
																																			color: #57767E;
																																			cursor: pointer;
																																			font-family: "century Gothic",arial;
																																			font-size: 16px;
																																			font-weight: bold;
																																			height: 25px;
																																			width: 75px;'));?>
                     </dl>
                    
                </fieldset>
                
         </form>
         </div>  	