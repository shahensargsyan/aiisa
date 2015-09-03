<div class="hidden" id="baseUrl"><?php echo Router::url('/',true);?></div>
<div id="banner" style="margin-bottom:-10px;">
	
	<div class="main-wrap">
	<!--<div class="lightModalOverlay" style="display:block;"></div>-->
		<div class="login_container_bg">
			<div class="closeLogin" style="float: right; font-size: 19px; color: rgb(255, 255, 255); margin-top: -80px;">
			<?php echo $this->Html->image('close.gif',array('width' => '21', 'height' => '21','id'=>'','style' => 'height:16px;cursor:pointer;','url' => array('controller' => 'meditations')));?>
			
			</div>
			<div class="register_frame">
				<div class="frame_heading">LOGIN</div>
				
			
				<?php echo $this->Form->create('User', array('action' => 'index')); ?>	
				<div class="register_frame_content" style="width:100% !important; padding:0px !important;">	
					
					<div class="packet_combo">
						<div class="packet_mid">
							<div class="field_label" style="color:#FFFFFF; text-align:left;">Username</div>
							<div class="field">
								
								<div class="input text required">
								<div class="user-icon"></div>
									<?php echo $this->Form->input('username', array('label' => false,'class'=>'input_text username','div'=>false,'value'=>$username)); ?>
								</div>
							</div>
						</div> 
						
						<div class="packet_mid">
							<div class="field_label" style="color:#FFFFFF; text-align:left;">Password</div>
							<div class="field">
								
								<div class="input text required">
									<div class="pass-icon"></div>
										<?php echo $this->Form->input('password', array('label' => false,'class'=>'input_text password','value'=>$password,'id'=>'enterPassword')); ?>
								</div>		
										
							</div>
						   <div class="packet_combo" style="height: auto;">
						<div class="register_frame_heading" >
							<div class="thirdPartyButtons social_icons">
							<ul>
							<li><?php echo $this->Html->image('newfb.png',array('onclick' => "FBLogin();",'id' => 'fb','class'=>'fb_icon','style' => 'cursor:pointer;'));?></li>
							<li><?php echo $this->Html->image('twitter-icon.png',array('url' => $auth_url,'id' => 'twitter','class'=>'twitter_icon'));?></li>
							
							<li><div id="signin-button" class="show">
     							<div class="g-signin"
      					 		data-width = "iconOnly"
								data-callback="loginFinishedCallback"
								data-approvalprompt="force"
								data-clientid="334284561819.apps.googleusercontent.com"
								data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read"
								data-cookiepolicy="single_host_origin">
							 </div>
							 </div>
							</li>
							<div class="clear"></div>
							</ul> 
						 </div> 
						 <div class="button_wrapper">
						  <div class="login_me">
							<div class="login_buttons">
							<?php 
						    echo $this->Form->submit('Login', array('formnovalidate' => true,'div'=>false,'class'=>'button','id'=>'enterLogin'));
							?>
							</div>
							 <div class="account">
							  <span>Don't have an account?</span>
							  <?php echo $this->Html->link('Sign Up Here','register', array('class'=>'signUp','id'=>'signUp'));?>
							 </div>
						  </div>
						  <div class ="cancelLogin">
						    <div class="login_buttons">
							<?php echo $this->Form->button('Cancel', array('id'=>'cancelLogin','class'=>'button'));?>
							
							 <?php 
								//echo $this->Html->link('Cancel', '/', array('label'=>false,'type' =>'button','id'=>'cancelLogin','class'=>'button'));
							 ?>
							 </div>
							 <div class="account">
							 <span>Forget Password!</span>
							 <?php 
							echo $this->Html->link('Click Here ','forgetpassword', array('class'=>'forget_pass','id'=>'forgetPassword'));
						?>
							
							 </div>	 
						  </div>
						  	
						 
						 </div>
						 <div class="clear"></div> 	 
					</div>	
					     
					    		
				</div>
				       </div><!-- PACKET RIGHT-->			
					 
					</div>
					<!--<div class="markline"><div class="staticcontrol"><div class="hrcenter" style="border-color:#FFFFFF;"></div></div></div>-->
					
					
				<?php 
				echo $this->Form->end();  ?>

    <!-- In most cases, you don't want to use approvalprompt=force. Specified
    here to facilitate the demo.-->
  		</div>
		</div>
		<div class="clear"></div>
		</div>
        </div>
</div>

<div id="fb-root"></div>
 <style type="text/css">
  .hide { display: none;}
  .show {
    display: block;
    float: right;
    margin: 0;
}
[id^=oauth2relay] { position:fixed !important; }
</style>
 <!-- <script src="https://apis.google.com/js/client.js"></script>-->
  <script type="text/javascript">
  var baseUrl = $('#baseUrl').html();
  //Redirect the User to home page if he click out of login container
  $(document).ready(function(){
  	$('div .banner-slider').click(function(){
		window.location = baseUrl;
	});
	
  })
  // Function to redirect the user to login page
  function redirect(){
  	window.location = baseUrl+"users/googleLogin";
  }
  /**
   * Global variables to hold the profile and email data.
   */
   var profile, email;
  /*
   * Triggered when the user accepts the sign in, cancels, or closes the
   * authorization dialog.
   */
  function loginFinishedCallback(authResult) {
    if (authResult) {
      if (authResult['error'] == undefined){
        toggleElement('signin-button'); // Hide the sign-in button after successfully signing in the user.
        gapi.client.load('plus','v1', loadProfile);  // Trigger request to get the email address.
      } else {
        console.log('An error occurred');
      }
    } else {
      console.log('Empty authResult');  // Something went wrong
    }
  }

  /**
   * Uses the JavaScript API to request the user's profile, which includes
   * their basic information. When the plus.profile.emails.read scope is
   * requested, the response will also include the user's primary email address
   * and any other email addresses that the user made public.
   */
  function loadProfile(){
    var request = gapi.client.plus.people.get( {'userId' : 'me'} );
    request.execute(loadProfileCallback);
  }

  /**
   * Callback for the asynchronous request to the people.get method. The profile
   * and email are set to global variables. Triggers the user's basic profile
   * to display when called.
   */

  function loadProfileCallback(obj) {
    profile = obj;
	var jsonData = JSON.stringify(obj);//JSON.stringify(eval(obj));
	console.log(jsonData);
    // Filter the emails object to find the user's primary account, which might
    // not always be the first in the array. The filter() method supports IE9+.
    email = obj['emails'].filter(function(v) {
        return v.type === 'account'; // Filter out the primary email
    })[0].value; // get the email from the filtered results, should always be defined.
    $.ajax({
	type: 'POST',
	data : jsonData,
	url :  baseUrl+'users/googleLogin',
	contentType: 'application/json; charset=utf-8',
	//dataType: 'json',
	async:false,
	success: function (response) {
				window.location.href= baseUrl+'users/profile';
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(errorThrown);
	}
	});
	//displayProfile(profile);
  }

  /**
   * Utility function to show or hide elements by their IDs.
   */
  function toggleElement(id) {
    var el = document.getElementById(id);
    if (el.getAttribute('class') == 'hide') {
      el.setAttribute('class', 'show');
    } else {
      el.setAttribute('class', 'hide');
    }
  }
  </script>
  <script src="https://apis.google.com/js/client:plusone.js" type="text/javascript"></script>


	<script type="text/javascript">
	
	<!--Code for Facebook Login-->
		window.fbAsyncInit = function() {
    	FB.init({
    	appId      : '641912699246752', // replace your app id here
   		channelUrl : baseUrl+'login',
    	status     : true,
    	cookie     : true,
    	xfbml      : true 
    	});
		};
		(function(d){
    		var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    		if (d.getElementById(id)) {return;}
    		js = d.createElement('script'); js.id = id; js.async = true;
    		js.src = "//connect.facebook.net/en_US/all.js";
    		ref.parentNode.insertBefore(js, ref);
		}(document));
 
		function FBLogin(){
    		FB.login(function(response){
        	if(response.authResponse){
			console.log(response);
            window.location.href = baseUrl+"users/fblogin";
        }
    	}, {scope: 'email,user_likes'});
		}
	<!--Code for Google Login-->	
	function auth() {
       var config = {
      				'client_id': '334284561819.apps.googleusercontent.com',
          			'cookie'    : true,
					'scope': 'https://www.googleapis.com/auth/plus.profile.emails.read'
        			};
          gapi.auth.authorize(config, function(authResult) {
          //console.log('login complete');
         // console.log(gapi.auth.getToken());
		  gapi.auth.setToken(authResult.token);
 		  redirect();
        });
      }
	<!--Code for twitter login-->
	</script>
	