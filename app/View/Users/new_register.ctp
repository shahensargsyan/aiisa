<div id="banner">
    <div id="taglines">
        <h2 class="taglineTop">Meditate With Others Around the Globe.</h2>
        <h3 class="taglineBot">Using Our Free Meditiaton Timer</h3>
    </div>

    <div class="popup registerPopup">

        <div class="popupHeader">

            <h2 class="popupH">Register</h2>
            <div class="sepAU"></div>

            <button class="cls_button">X</button>

        </div>

        <div id="registerForm">
            <?php echo $this->Form->create('User', array('action' => 'register')); ?>	
                <div class="leftControls">
                    <label>Email Address*:</label>
                    <!--<input type="text" class="login">-->
                    <?php echo $this->Form->input('email', array('label' => false,'class'=>'login','required' => true)); ?>
                    <label>Password*:</label>
                    <!--<input type="text" class="login">-->
                    <?php echo $this->Form->input('password', array('label' => false,'class'=>'login','type' => 'password')); ?>
                </div>

                <div class="rightControls">
                    <label>Username*:</label>
                    <!--<input type="text" class="login">-->
                    <?php echo $this->Form->input('username', array('label' => false,'class'=>'login')); ?>

                    <label>Confirm Password*:</label>
                    <!--<input type="text" class="login">-->
                    <?php echo $this->Form->input('password_confirm', array('label' => false,'class'=>'login','type' => 'password','id'=>'password_confirm')); ?>
                </div>
                <div class="clearfix"></div>


                <div class="sepAU"></div>

                <div class="leftControls">
                    <label>Name:</label>
                    <!--<input type="text" class="login">-->
                    <?php echo $this->Form->input('first_name', array('label' => false,'class'=>'login')); ?>

                    <label>Date of Birth:</label>
                    <div class="DateSelect">
                      <?php
                            echo $this->Form->input('date_of_birth', array('label' => false,'maxlength' => '200', 'div' => false, 'id' => 'date_of_birth', 'type' => 'hidden','placeholder' => "GG-MM-AAAA")); 
                            echo $this->Form->error('date_of_birth');
                    ?>
                        <div class="YearSelect">
                            <?php
                            echo $this->Form->input('day',array('type'=>'select','options'=>$day,'label'=>false,'class' => 'sel selRegister')); 
                            ?>
                        </div>
                        <div class="YearSelect">
                            <?php
                            echo $this->Form->input('month',array('type'=>'select','options'=>$month,'label'=>false,'class' => 'sel selRegister')); 
                            ?>
                        </div>
                        <div class="YearSelect">
                            <?php 
                            echo $this->Form->input('year',array('type'=>'select','options'=>$year,'label'=>false,'class'=>'sel selRegister')); 
                            ?>
                        </div>

                        

                        <div class="clearfix"></div>

                    </div>

                </div>

                <div class="rightControls">
                    <label>Gender:</label>
                    <div class="genderRadios">
                        <div class="genderRadio">
                            <!--<input type="radio" id="ownHomeYes" name="ownHome" value="Yes">-->
                            <?php 
                            $options = array('M' => '');
                            $attributes = array('hiddenField' => false,'value' => "",'id' => "Male",'legend' => false, 'label' => false,'div' => FALSE);
                            echo $this->Form->radio('gender', $options, $attributes); 
                            ?>
                            
                            <label for="MaleM"><span></span>Male</label>
                        </div>
                        <div class="genderRadio">
                            <!--<input type="radio" id="ownHomeNo" name="ownHome">-->
                            <?php
                            $options = array('F' => '');
                            $attributes = array('hiddenField' => false,'value' => "",'id' => "Female",'legend' => false, 'label' => false,'div' => FALSE);
                            echo $this->Form->radio('gender', $options, $attributes); 
                            ?>
                            <label for="FemaleF"><span></span>Female</label>
                            <br>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
                <div class="clearfix"></div>

                <div class="sepAU"></div>

                <h3 class="subhead">Location</h3>
                <p class="lDescription"> ( Note: 1.Zoom your location on map. 2.Right click on your locatoin for marker. 3.Drag marker to your location. )</p>

                <div id="rMap">
                    	<script type="text/javascript">
                            //Onload handler to fire off the app.
                            google.maps.event.addDomListener(window, 'load', initialize);
                        </script>
                        <div id="mapCanvas" style=" width:936px; height:500px; border:1px solid #333333; margin:10px 0px;"></div>

                </div>




                <div class="leftControls">
                    <label>City:</label>
                    <!--<input type="text" class="login">-->
                    <?php echo $this->Form->input('city', array('label' => false,'id'=>'city','class'=>'login')); ?>
                    <label>Location Coordinates*:</label>
                    <!--<input type="text" class="disabled login ">-->
                    <?php echo $this->Form->input('location_coordinates', array('label' => false,'id'=>'location_coordinates','readonly'=>'readonly login','class'=>'disabled login')); ?>

                </div>

                <div class="rightControls">
                    <label>State*:</label>
                    <!--<input type="text" class="login">-->
                    <?php echo $this->Form->input('state', array('label' => false,'id'=>'state','class'=>'login')); ?>

                    <label>Country:</label>
                    <!--<input type="text" class="disabled login ">-->
                    <?php echo $this->Form->input('country', array('label' => false,'id'=>'country','readonly'=>'readonly','class'=>'disabled login')); ?>
                </div>
                <div class="clearfix"></div>


                <div class="sepAU"></div>

                <div id="terms">
                    <div class="term">
                        <!--<input type='checkbox' name='thing' value='valuable' id="thing" />-->
                        <?php echo $this->Form->input('term_conditions', array('div' => false,'type'=>'checkbox','id' => 'thing', 'label'=> false, 'hiddenField' => true, 'value' => '0')); ?>
                        <label for="thing"></label>
                        <label for="thing">Yes, I am agree to the <a href="#" class="green"> Term & Conditions</a></label>


                    </div>

                    <div class="term">
                        <input type='checkbox' name='thing2' value='valuable' id="thing2" />
                        <label for="thing2"></label>
                        <label for="thing2" class="tLabel">We will under NO circumstances pass on your details to third parties unless required by law. If you do not wish to receive further emails from Satorio.org then untick this box</a>
                        </label>


                    </div>


                    <div class="register_button">
                        <!--<a href="#" class="btn greenbtn regBtn">REGISTER</a>-->
                        <?php echo $this->Form->submit('Register', array('formnovalidate' => true, 'class'=>' greenbtn regBtn')); ?>
                    </div>


            <?php echo $this->Form->end(); ?>

            </div>
        </div>
    </div>

</div>



<!--
<div class="container_bg">
	<div class="register_frame">
		<div class="register_frame_heading">You don't need to register to use our Meditation timer, you'll get a lot more out of it if you do. By registering you will have a log of all your meditation sessions and be able to specify where you are meditating from.</div>
		<?php echo $this->Form->create('User', array('action' => 'register')); ?>	
		
		<div class="markline"><div class="staticcontrol"><div class="hrcenter"></div></div></div>
		
		<div class="register_frame_content">	
			
			<div class="packet_combo">
				<div class="packet_left">
					<div class="field_label">Email Address<span class="star">*</span></div>
					<div class="field"><?php echo $this->Form->input('email', array('label' => false,'class'=>'input_text','required' => true)); ?></div>
				</div>			
				
				<div class="packet_right">
					<div class="field_label">Username<span class="star">*</span></div>
					<div class="field"><?php echo $this->Form->input('username', array('label' => false,'class'=>'input_text')); ?></div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="packet_combo">
				<div class="packet_left">
					<div class="field_label">Password<span class="star">*</span></div>
					<div class="field"><?php echo $this->Form->input('password', array('label' => false,'class'=>'input_text')); ?></div>
				</div>			
				
				<div class="packet_right">
					<div class="field_label">Confirm Password<span class="star">*</span></div>
					<div class="field"><?php echo $this->Form->input('password_confirm', array('label' => false,'class'=>'input_text','id'=>'password_confirm','type' => 'password')); ?></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="markline"><div class="staticcontrol"><div class="hrcenter"></div></div></div>
			
			<div class="packet_combo">
				<div class="packet_left">
					<div class="field_label">Name</div>
					<div class="field"><?php echo $this->Form->input('first_name', array('label' => false,'class'=>'input_text')); ?></div>
				</div>			
				
				<div class="packet_right">
					<div class="field_label">Last Name</div>
					<div class="field"><?php //echo $this->Form->input('last_name', array('label' => false,'class'=>'input_text')); ?></div>
				</div>
				<div class="packet_right">
					<div class="field_label">Gender</div>
					<div class="field">
						<?php 
						$options = array('M' => 'Male', 'F' => 'Female');
						$attributes = array('legend' => false);
						echo $this->Form->radio('gender', $options,$attributes); ?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="packet_combo">			
				<div class="packet_left">
					<div class="field_label">Age<span class="star">*</span></div>
					<div class="field">
						<?php 
							echo $this->Form->input('year',array('type'=>'select','options'=>$year,'label'=>false,'style'=>'margin-left:0px;')); 
							echo $this->Form->input('month',array('type'=>'select','options'=>$month,'label'=>false)); 
							echo $this->Form->input('day',array('type'=>'select','options'=>$day,'label'=>false)); 
							echo $this->Form->input('date_of_birth', array('label' => false,'maxlength' => '200', 'div' => false, 'id' => 'date_of_birth', 'type' => 'hidden','placeholder' => "GG-MM-AAAA")); 
							echo $this->Form->error('date_of_birth');
						?>
							
					</div>
				</div>
			</div>
			<div class="markline"><div class="staticcontrol"><div class="hrcenter"></div></div></div>
			
			<div class="packet_combo" style="height:auto;">
				<div class="field_label">Location<span class="note">(Note: 1.Zoom your location on map. &nbsp;&nbsp;2.Right click on your locatoin for marker. &nbsp;&nbsp;3.Drag marker to your location.)</span></div>
				<div class="field">
					<script type="text/javascript">
						//Onload handler to fire off the app.
						//google.maps.event.addDomListener(window, 'load', initialize);
					</script>
					<div id="mapCanvas" style=" width:936px; height:500px; border:1px solid #333333; margin:10px 0px;"></div>
				</div>
			</div>
			<div class="packet_combo" style="float: left; width: 100%; margin: 14px 0px 0px;">
							
				
				<div class="packet_right">
					<div class="field_label">Street Address<span class="star">*</span></div>
					<div class="field"><?php //echo $this->Form->input('street_address', array('label' => false,'id'=>'street_address','class'=>'input_text')); ?></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="packet_combo">
				<div class="packet_left">
					<div class="field_label">City<span class="star">*</span></div>
					<div class="field"><?php echo $this->Form->input('city', array('label' => false,'id'=>'city','class'=>'input_text')); ?></div>
				</div>			
				
				<div class="packet_right">
					<div class="field_label">State<span class="star">*</span></div>
					<div class="field"><?php echo $this->Form->input('state', array('label' => false,'id'=>'state','class'=>'input_text')); ?></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="packet_combo">
				<div class="packet_left">
					<div class="field_label">Location Coordinates<span class="star">*</span></div>
					<div class="field"><?php echo $this->Form->input('location_coordinates', array('label' => false,'class'=>'input_text','id'=>'location_coordinates','readonly'=>'readonly','style'=>'background-color:#CCCCCC; border:0; border-top:1px solid #999999; height:21px;')); ?></div>
				</div>
				<div class="packet_left">
					<div class="field_label">ZipCode/PostCode<span class="star">*</span></div>
					<div class="field"><?php //echo $this->Form->input('zip_code', array('label' => false,'class'=>'input_text','id'=>'zip_code','readonly'=>'readonly','style'=>'background-color:#CCCCCC; border:0; border-top:1px solid #999999; height:21px;')); ?></div>
				</div>			
				
				<div class="packet_right">
					<div class="field_label">Country<span class="star">*</span></div>
					<div class="field"><?php echo $this->Form->input('country', array('label' => false,'id'=>'country','class'=>'input_text','readonly'=>'readonly','style'=>'background-color:#CCCCCC; border:0; border-top:1px solid #999999; height:21px;')); ?></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="markline"><div class="staticcontrol"><div class="hrcenter"></div></div></div>
			
			<div class="packet_combo" style="width:100%">
				<div class="field packet_left" style="width:auto;">
					<?php echo $this->Form->input('term_conditions', array('type'=>'checkbox', 'label'=>__('<span class="terms_condition">Yes, I am agree to the <a href="#">Term & Conditions</a></span>', true), 'hiddenField' => true, 'value' => '0')); ?>
				</div>
				<div class="register_frame_heading packet_right">
					<?php echo $this->Form->submit('Register', array('formnovalidate' => true, 'class'=>'button')); ?>
				</div>
			</div>
				
				
		</div>
		<?php echo $this->Form->end(); ?>	
	</div>
</div>-->