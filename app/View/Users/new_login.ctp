<div class="hidden" style="display: none" id="baseUrl"><?php echo Router::url('/',true);?></div>
<div id="banner">
    <div id="taglines">
        <h2 class="taglineTop">Meditate With Others Around the Globe.</h2>
        <h3 class="taglineBot">Using Our Free Meditiaton Timer</h3>
    </div>

    <div class="popup loginPopup">

        <div class="popupHeader">

            <h2 class="popupH">Login</h2>
            <div class="sepAU"></div>

            <a href="/" class="cls_button">X</a>
            <?php echo $this->Form->create('User', array('action' => 'index')); ?>	
            <div id="loginForm">
                <!--<form>-->
                <label>Username:</label>
                <?php echo $this->Form->input('username', array('label' => false, 'class' => 'input login', 'div' => false, 'value' => $username)); ?>
                <!--<input type=text class="input login">-->
                <label>Password:</label>
                <?php echo $this->Form->input('password', array('label' => false, 'class' => 'input login', 'value' => $password, 'id' => 'enterPassword')); ?>
                <!--<input type=text class="input login">-->
                <!--</form>-->
            </div>

            <div id="loginButtons">
                <!--<button class="lButton white bfirst">LOGIN</button>-->
                <?php echo $this->Form->submit('Login', array('formnovalidate' => true, 'div' => false, 'class' => 'lButton white bfirst', 'id' => 'enterLogin')); ?>
                <a href="/" class="lButton">CANCEL</a>
                <div class="clearfix"></div>
            </div>
            <div class="sepAU"></div>
            <div id="lFooter">
                <div id="lLinks">
                    <p>Do not have an account? <?php echo $this->Html->link('Sign up here', array('controller' => 'users','action' => 'newRegister'), array('class' => 'green aboutUsLink', 'id' => 'signUp')); ?>
                    </p>
                    <p>Forgot Password  <?php echo $this->Html->link('Click Here ', 'forgetpassword', array('class' => 'green aboutUsLink', 'id' => 'forgetPassword')); ?>
                    </p>

                </div>

                <div id="lIcons">
                    <div class="iconsContainer">
                        <a class="fl" href="#">
                            <?php echo $this->Html->image('facebook.png',array('onclick' => "FBLogin();",'id' => 'fb','class'=>'fb_icon','style' => 'cursor:pointer;'));?>
                             </a>
                        <a class="fl" href="#"><?php echo $this->Html->image('twitter.png',array('url' => $auth_url,'id' => 'twitter','class'=>'twitter_icon'));?>
                        <div class="clearfix"></div>
                    </div>

                </div>

                <div class="clearfix"></div>

            </div>




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
	