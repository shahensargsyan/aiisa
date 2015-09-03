<div id="banner">
    <?php echo $this->element('top'); ?> 

    <div class="popup registerPopup">

        <div class="popupHeader">

            <h2 class="popupH">Register</h2>
            <div class="sepAU"></div>

            <a href="/" class="cls_button"></a>

        </div>

        <div id="registerForm">
            <?php echo $this->Form->create('User', array('action' => 'register')); ?>	
                <div class="leftControls">
                    <label>Email Address*</label>
                    <?php echo $this->Form->input('email', array('label' => false,'class'=>'login','required' => true)); ?>
                    <label>Username*</label>
                    <?php echo $this->Form->input('username', array('label' => false,'class'=>'login')); ?>

                </div>

                <div class="rightControls">
                    <label>Password*</label>
                    <?php echo $this->Form->input('password', array('label' => false,'class'=>'login','type' => 'password')); ?>

                    <label>Confirm Password*</label>
                    <?php echo $this->Form->input('password_confirm', array('label' => false,'class'=>'login','type' => 'password','id'=>'password_confirm')); ?>
                </div>
                <div class="clearfix"></div>


                <div class="sepAU"></div>

                <div class="leftControls">
                    <label>Name</label>
                    <?php echo $this->Form->input('first_name', array('label' => false,'class'=>'login')); ?>

                    

                        

                        <div class="clearfix"></div>

                    </div>

                </div>
        <div class="rightControls">
            <label>Date of Birth</label>
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
            </div>
         </div>
<!--                <div class="rightControls">
                    <label>Gender:</label>
                    <div class="genderRadios">
                        <div class="genderRadio">
                            <input type="radio" id="ownHomeYes" name="ownHome" value="Yes">
                            <?php 
                            $options = array('M' => '');
                            $attributes = array('hiddenField' => false,'value' => "",'id' => "Male",'legend' => false, 'label' => false,'div' => FALSE);
                            echo $this->Form->radio('gender', $options, $attributes); 
                            ?>
                            
                            <label for="MaleM"><span></span>Male</label>
                        </div>
                        <div class="genderRadio">
                            <input type="radio" id="ownHomeNo" name="ownHome">
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

                </div>-->
                <div class="clearfix"></div>

                <div class="sepAU"></div>
                <?php if(isset($maperror)){ ?>
                    <div class="error-message">You must select your location on map .</div>
                <?php } ?>
                <h3 class="subhead">Location</h3>
                <p class="lDescription">Simply <span class="underline">right click</span> on your location. You can then zoom in or drag the marker to get closer to home</p>

                <div id="rMap">
                    	<script type="text/javascript">
                            //Onload handler to fire off the app.
                            google.maps.event.addDomListener(window, 'load', initialize);
                        </script>
                        <div id="mapCanvas" style=" width:936px; height:500px; border:1px solid #333333; margin:10px 0px;"></div>

                </div>


                    <?php echo $this->Form->input('location_coordinates', array('type' => 'hidden','label' => false,'id'=>'location_coordinates','readonly'=>'readonly','class'=>'disabled login')); ?>
                    <?php echo $this->Form->input('country', array('type' => 'hidden','label' => false,'id'=>'country','readonly'=>'readonly','class'=>'disabled login')); ?>
                    <?php echo $this->Form->input('city', array('type' => 'hidden','label' => false,'id'=>'city','class'=>'login')); ?>


<!--                <div class="leftControls">
                    <label>City:</label>
                    <input type="text" class="login">
                    <label>Location Coordinates*:</label>
                    <input type="text" class="disabled login ">

                </div>-->

                <!--<div class="rightControls" >-->
                    <!--<label>State*:</label>-->
                    <!--<input type="text" class="login">-->
                    <?php // echo $this->Form->input('state', array('type' => 'hidden', 'label' => false,'id'=>'state','class'=>'login')); ?>

                    <!--<label>Country:</label>-->
                    <!--<input type="text" class="disabled login ">-->
                <!--</div>-->
                <div class="clearfix"></div>


                <div class="sepAU"></div>

                <div id="terms">
                    <div class="term checkbox-term">
                        <!--<input type='checkbox' name='thing' value='valuable' id="thing" />-->
                        <?php echo $this->Form->input(
                                'term_conditions', 
                                array(
                                    'div' => false,
                                    'type'=>'checkbox',
                                    'checked' => "checked",
                                    'id' => 'thing', 
                                    'label'=> false, 
                                    'hiddenField' => true, 'value' => '0'
                                    )
                                );
                        ?>
                        <label for="thing"></label>
                        <label for="thing">Yes, I agree to the <a href="/aboutus/termsAndConditions" class="green"> Term & Conditions</a></label>


                    </div>

                    <div class="term">
                        <input type='checkbox' checked= "checked" name='thing2' value='valuable' id="thing2" />
                        <label for="thing2"></label>
                        <label for="thing2" class="tLabel">If you do not wish to receive further emails from Satorio.org then untick this box</a>
                        </label>


                    </div>


                    <div class="register_button">
                        <?php echo $this->Form->submit('Register', array('formnovalidate' => true, 'class'=>' greenbtn regBtn')); ?>
                    </div>

            <?php echo $this->Form->end(); ?>

            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    if($('.checkbox-term .error-message').html()){
        var  error = $('.checkbox-term .error-message').html();
        $('.checkbox-term .error-message').remove();
        $('.checkbox-term').append('<div class="error-message" style="">'+error+'<div>');
    }

</script>
