<?php
$cakeDescription = __d('cake_dev', 'Satorio Meditation');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<script src='https://www.google.com/jsapi'></script>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<!--[if IE]>
		<?php echo $this->Html->css('all-ie-only.css');?>
		<![endif]-->
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		echo $this->Html->meta('icon');
		
		echo $this->Html->script(array('jquery.min', 
									   'jquery.countdown',
									   'jplayer/jquery.jplayer.min',
									   'map/map',
									   'map/jquery-jvectormap-1',
									   'map/jquery-jvectormap-world-mill-en',
									   'timer/TimeCircles.js'
									   ));
		echo $this->Html->script('custom');
		
		echo $this->Html->css(array(
									//'jquery-jvectormap-1',
									'timer/TimeCircles'));
		echo $this->Html->css('style');
		
	?>
	<script>
function fbLogout() {
        FB.logout(function (response) {
            //Do what ever you want here when logged out like reloading the page
            window.location.reload();
        });
    }
</script>

<!-- Start of Woopra Code -->
<script>
(function(){
var t,i,e,n=window,o=document,a=arguments,s="script",r=["config","track","identify","visit","push","call"],c=function(){var t,i=this;for(i._e=[],t=0;r.length>t;t++)(function(t){i[t]=function(){return i._e.push([t].concat(Array.prototype.slice.call(arguments,0))),i}})(r[t])};for(n._w=n._w||{},t=0;a.length>t;t++)n._w[a[t]]=n[a[t]]=n[a[t]]||new c;i=o.createElement(s),i.async=1,i.src="//static.woopra.com/js/w.js",e=o.getElementsByTagName(s)[0],e.parentNode.insertBefore(i,e)
})("woopra");

woopra.config({
    domain: 'meditationmusic.net',
    idle_timeout: 1800000
});
woopra.track();
</script>
<!-- End of Woopra Code -->
</head>
<body>
<?php 
$baseUrl = Router::url('/',true);
$purl = explode('/',$this->here); 
?>
<!--<div class="bgimg"><?php //echo $this->Html->image('bg2.jpg') ?></div>-->
<div class="lightModalOverlaydefault">&nbsp;</div>
	<?php $purl = explode('/',$this->here); ?>
	<div id="wrapper" class="outer_container">
	<div class="bgimg"><?php echo $this->Html->image('background.jpg') ?></div>
			<div class="banner_wrapper">
			
			  <div id="header-wrap" class="header_wrapper">
					   <div class="header">
						  <div class="content_level">
							<div class="logo_wrapper">
							  
								<?php echo $this->Html->link($this->Html->image('logo.png'), $baseUrl, array('escape' => false));?>
							</div>
							<div class="nav_wrapper">
								<div class="nav">
									<ul>
									<?php 
										if($this->Session->check('userId')):
											if( in_array('account',$purl)) $class = 'link active'; else $class = 'link';
												echo '<li>'.$this->Html->link('My Account', '/users/account', array('class' => $class)).'</li>';
											echo '<li>'.$this->Html->link('Log Out', '/logout', array('class' => 'link','id' => 'logOut')).'</li>';
										else:
										    echo '<li>'.$this->Html->link('Home', '/', array('class' => 'link')).'</li>';
											echo '<li>'.$this->Html->link('Log In', '/login', array('class' => 'link')).'</li>';
											//echo '<li>'.$this->Html->link('Register', '/register', array('class' => 'link')).'</li>';
										endif;	 
										$baseUrl = Router::url('/',true);
										if( in_array('aboutus',$purl)) $class = 'link active'; else $class = 'link';
											echo '<li>'.$this->Html->link('About Us', $baseUrl.'aboutus', array('class' => $class)).'</li>';
										
										if( in_array('contactus',$purl)) $class = 'link active'; else $class = 'link';
											echo '<li>'.$this->Html->link('Contact Us', $baseUrl.'contactus', array('class' => $class)).'</li>';
										if( in_array('store',$purl)) $class = 'link active'; else $class = 'link';
									echo '<li>'.$this->Html->link('Store', $baseUrl.'store', array('class' => $class)).'</li>';
									?>
									</ul>
								</div>
							</div>
							<div class="clear"></div>
						  </div><!-- content_level -->
						  <div class="content_level headline_wrapper">
							<p class="subline">
							<?php echo $headerDetails['Setting']['heading']; ?>
							</p>
						  </div><!-- content_level headline_wrapper -->
					   </div>
			   </div>
			
			 
			 <div class="page_content">
			  <div class="container_bg">
			  		<div class="contact_frame">
						<?php echo $this->fetch('content'); ?>
					</div>	
			  </div>	
			 </div>
			 
		  
			 </div><!-- banner wrapper-->
    </div>
	
    <div id="footer-wrap">
     	  <div class="inner">
          	   <div class="footer-inner">
               		<p>Copyright &copy; 2013 <?php echo $this->Html->link('MEDITATION MUSIC', '/', array('class' => 'link')); ?> - All Rights Reserved - <a href="#">Terms of Use</a></p>
               </div>
          </div>
     </div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>

