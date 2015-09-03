<div class="hidden" id="baseurl" style="display:none;"><?php echo Router::url('/', true); ?></div>
	<?php if(isset($message)):?>
		<div class="valid_box">
  	<?php echo $message;?>
 		 </div>
  	<?php endif;?>
  	<?php if(isset($errors)):?>
		<div class="error_box">
  	<?php echo $errors;?>
 		 </div>
  	<?php endif;
		  echo '<script>$(".valid_box").fadeOut(2000);
		  				$(".error_box").fadeOut(2000);
		  </script>'?>
<h2>User Profile</h2>
<div class = "form" style="float:left;margin:22px 0px 0px 7px;padding: 0px 0px 0px 0px !important;">	
	<?php
		echo $this->Form->create('Admin',array('type' => 'file','class' => 'niceform'),array('url' => array('controller' =>'admins','action' => 'editUserProfile')));
		if(isset($userDetail)):
			$email 					= ($userDetail['User']['email']!='') ? $userDetail['User']['email']:'';
			$username 				= ($userDetail['User']['username']!='')?$userDetail['User']['username']:'';
			$first_name 			= ($userDetail['User']['first_name']!='')?$userDetail['User']['first_name']:'';
			$last_name 				= ($userDetail['User']['last_name']!='')?$userDetail['User']['last_name']:'';
			$profile_picture 		= ($userDetail['User']['profile_picture']!='')?'../profileimg/'.$userDetail['User']['profile_picture']:'guest_avatar.jpg';
			$gender 				= ($userDetail['User']['gender']!='')?$userDetail['User']['gender']:'';
			$date_of_birth 			= ($userDetail['User']['date_of_birth']!='')?$userDetail['User']['date_of_birth']:'';
			$location_coordinates 	= ($userDetail['User']['location_coordinates']!='')?$userDetail['User']['location_coordinates']:'';
			$street_address 		= ($userDetail['User']['street_address']!='')?$userDetail['User']['street_address']:'';
			$city 					= ($userDetail['User']['city']!='')?$userDetail['User']['city']:'';
			$state 					= ($userDetail['User']['state']!='')?$userDetail['User']['state']:'';
			$zip_code 				= ($userDetail['User']['zip_code']!='')?$userDetail['User']['zip_code']:'';
			$user_status 			= ($userDetail['User']['user_status']!='')?$userDetail['User']['user_status']:'';
			$country 				= ($userDetail['User']['country']!='')?$userDetail['User']['country']:'';
		endif;
		?>
                <fieldset>
                       <dl>
					   <div id="display_img_section">
                          <dt><label for="userImage">User Image</label></dt>
                          <dd><?php echo $this->Html->image($profile_picture, array('style' => 'box-shadow: 1px 1px 17px 2px #C4CFD4;border:none; margin: 7px 0 0 -3px;','width'=>'100','height'=>'100')); ?>
							</dd>
						</div>	
                       </dl>

					  <dl>
					  	<dt><label for="username">Username:<span class="star">*</span></label></dt>
					  	<dd><?php echo $this->Form->input('username', array('value'=>$username,'label' => false,'size'=>54, 'disabled' => true)); ?></dd>
					  </dl>
					  <dl>
					  	<dt><label for="firstName">First Name</label></dt>
					  	<dd><?php echo $this->Form->input('first_name', array('value'=>$first_name, 'size'=>54,'label' => false)); ?></dd>			
					   </dl>
					  <dl>
					  	<dt><label for="lastName">Last Name</label></dt>
					  	<dd><?php echo $this->Form->input('last_name', array('value'=>$last_name, 'label' => false,'size'=>54)); ?></dd>
					  </dl>
					   <dl>
						<dt><label for="email">Email Address:<span class="star">*</span></label></dt>
						<dd><?php echo $this->Form->input('email', array('value'=>$email,'label' => false,'size'=>54)); ?></dd>
					  </dl>	
					  <dl>
					  	<dt><label for="gender">Gender</label></dt>
					  	<dd>
                        <div class="radio-button" style="margin:14px 0px 0px 0px;">
						<?php  
							$options = array('M' => 'Male', 'F' => 'Female');
							$attributes = array('legend' => false, 'value' => $gender);
							echo $this->Form->radio('gender',$options,$attributes); ?>
					  	</div></dd>
					  </dl>
					  <dl>
					  	<dt><label for="date_of_birth">Date Of Birth<span class="star">*</span></label></dt>
						<dd><?php
							$brkDate =array();
							if(!empty($date_of_birth)):
							$brkDate  =  explode('-',$date_of_birth);
							$brkMonth = ($brkDate != '')?$brkDate[1]:0000;
							$brkDay   = ($brkDate != '')?$brkDate[2]:0000;
							$brkYear  = ($brkDate != '')?$brkDate[0]:0000;
						else:
							$brkMonth = '00';
							$brkDay   = '00';
							$brkYear  = '0000';
						endif;
						echo $this->Form->input('year',array('type'=>'select','options'=>$year,'label'=>false,
															 'style'=>'margin-left:0px;width:97px;float:left;','default' => $brkYear)); 
						echo $this->Form->input('month',array('type'=>'select','options'=>$month,'label'=>false,
															  'style' => 'width:97px;float:left;','default' => $brkMonth)); 
						echo $this->Form->input('day',array('type'=>'select','options'=>$day,'label'=>false,
												'style' => 'width:97px;float:left;','default' => $brkDay)); 
						echo $this->Form->input('date_of_birth', array('label' => false,'maxlength' => '200', 
												'div' => false, 'id' => 'date_of_birth', 'type' => 'hidden','placeholder' => "GG-MM-AAAA",'value'=>$date_of_birth)); 
						echo $this->Form->error('date_of_birth');
					?>
						</dd>
					  </dl>
					  
					  <dl><dt>
					  <label for="loc">Location</label>
					<?php if(!empty($location_coordinates)):?>
					<script type="text/javascript">
						
						function initialize2() {
							//var latLng = new google.maps.LatLng(33.431441,9.477537);
							var latLng = new google.maps.LatLng(<?php echo $location_coordinates; ?>);
							var map = new google.maps.Map(document.getElementById('mapCanvas'), {
								zoom: 12,
								center: latLng,
								mapTypeId: google.maps.MapTypeId.ROADMAP
							});
							placeMarker(latLng, newmarker);
							google.maps.event.addListener(map, "rightclick", function(event) {
								if(markers==''){
									var newmarker;
								} else {
									var newmarker = markers;
								}
								placeMarker(event.latLng, newmarker);
							});
						
							function placeMarker(location, newmarker) {
								if (newmarker) {
									//if marker already was created change positon
									newmarker.setPosition(location);
								} else {
									//create a marker
									newmarker = new google.maps.Marker({
										position: location,
										map: map,
										draggable: true
									});
								}
								markers = newmarker;
								var lat2 = newmarker.position.lat();
								var lng2 = newmarker.position.lng();
								var latLng2 = new google.maps.LatLng(lat2,lng2);
								geocodePosition(newmarker.getPosition(latLng2));
								
								google.maps.event.addListener(newmarker, 'click', function() {});
								google.maps.event.addListener(newmarker, 'dragend', function() {
									geocodePosition(newmarker.getPosition());
								});
							}
						}
	
						//Onload handler to fire off the app.
						google.maps.event.addDomListener(window, 'load', initialize2);
					</script>
					<?php else:?>
					<script type="text/javascript">
							//Onload handler to fire off the app.
							google.maps.event.addDomListener(window, 'load', initialize);
					</script>
					<?php endif;?>
				</dt>
				<dd><em>(Note: 1.Zoom your location on map. &nbsp;&nbsp;2.Right click on your locatoin for marker. &nbsp;&nbsp;3.Drag marker to your location.)</em>
					<div id="mapCanvas" style=" width:500px; height:366px; border:1px solid #333333;margin:19px 0px;"></div></dd>
				</dl>
				<dl>
					  <dt><label for="location">Location Coordinates<span class="star">*</span></dt>
					  <dd>
		<?php echo $this->Form->input('location_coordinates', array('value'=>$location_coordinates, 'label' => false,'disabled' => true,'readonly'=>'readonly','size'=>54));?></dd>
					  </dl>
				 <dl>
					  <dt><label for="streetAddress">Street Address<span class="star">*</span></dt>
					  <dd><?php echo $this->Form->input('street_address', array('value'=>$street_address, 'label' => false,'id'=>'street_address','size'=>54)); ?></dd>
				 </dl>
				 <dl>
					  <dt><label for="city">City<span class="star">*</span></label></dt>
					  <dd><?php echo $this->Form->input('city', array('value'=>$city, 'label' => false,'id'=>'city','size'=>54)); ?></dd>
				 </dl>	  
				 <dl>
				 	  <dt><label for= "state">State<span class="star">*</span></dt>
				 	  <dd><?php echo $this->Form->input('state', array('value'=>$state, 'label' => false,'id'=>'state','size'=>54)); ?></dd>
				 </dl>
				  <dl>
					  <dt><label for="zip">Zip Code<span class="star">*</span></dt>
					  <dd><?php echo $this->Form->input('zip_code', array('value'=>$zip_code, 'label' => false,'id'=>'zip_code','readonly'=>'readonly','size'=>54,'disabled' => true)); ?></dd>
				  </dl>	  
				  <dl>
					  <dt><label for="country">Country<span class="star">*</span></dt>
					  <dd>			
					  <?php echo $this->Form->input('country', array('value'=>$country, 'label' => false,'id'=>'country','readonly'=>'readonly','size'=>54,'disabled' => true)); ?>
				    	 <dd> </dl>
				  <dl>
					  <dt><label for="setMode">Set Mode<span class="star">*</span></dt>
					  <dd>
					   <?php
							echo $this->Form->input('Access',array('type'=>'select','options'=>array('0'=>'Not Verified','1'=>'Enable','2'=>'Incomplete Profile','3'=>'Disable'),
																   'label'=>false,'size' => 1,'default' => $user_status,'class' =>'mySelect'));?></dd>	
				  </dl>		
				  <dl class="submit">
				  <?php 
				  echo $this->Form->submit('Update User',array('id' => 'submit','class' =>'updateProfile button-action-active updateManager'));?>
				  </dd>
			</fieldset>	  	  
  	<?php 
			
			echo $this->Form->end(); ?>	
	<!--<div class="middle-midd-boxcont">
		<div class="paggingOverlay" id="paging-indicator"><?php echo $this->Html->image('ajax-loader.gif'); ?></div>-->
	</div>