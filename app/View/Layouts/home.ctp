<?php
$cakeDescription = __d('cake_dev', 'Satorio Meditation');
?>
<!DOCTYPE html>
<html>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# meditation_music: http://ogp.me/ns/fb/meditation_music#">
<meta name="viewport" content="user-scalable=no" />
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<!-----=============----------->
	<meta property="fb:app_id" content="764734903557567" /> 
	<meta property="og:type" content="meditation_music:meditation"> 
	<meta property="og:url"    content="http://meditationmusic.net" /> 
	<meta property="og:description"  content="Feel the connection of meditating with people from around the world. If you are new to meditating, press on the 2 minute button and try to concentrate on your breathe."/> 
	<meta property="og:image" content="http://thepandathinks.files.wordpress.com/2013/01/meditation.jpg"/>
	<!---==========---------->
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $cakeDescription ?>:		<?php echo $title_for_layout; ?></title>
	
	<!--[if IE]>
	<?php echo $this->Html->css('all-ie-only.css');?>
	<![endif]-->
	
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false" defer="defer"></script>
	<?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		echo $this->Html->meta('icon');
		
		echo $this->Html->script(array('jquery.min', 
									   'jquery.countdown',
									   'jplayer/jquery.jplayer.min',
									   //'map/map',
									  // 'map/jquery-jvectormap-1',
									   'map/jquery-jvectormap.min',
									   //'map/lib/jquery-mousewheel',
									   'map/src/jvectormap.min',
									   'map/src/abstract-element.min',
									   'map/src/abstract-canvas-element.min',
									   'map/src/abstract-shape-element.min',
									   'map/src/svg-element',
									   'map/src/svg-group-element',
									   'map/src/svg-canvas-element.min',
									   'map/src/svg-shape-element',
									   'map/src/svg-path-element',
									   'map/src/svg-circle-element.min',
									   'map/src/svg-image-element',
									   'map/src/svg-text-element',
									   'map/src/map-object.min',
									   'map/src/region.min',
									   'map/src/marker.min',
									   'map/src/vector-canvas',
									   'map/src/simple-scale.min',
									   'map/src/ordinal-scale.min',
									   'map/src/legend.min',
									   'map/src/data-series.min',
									   'map/src/proj.min',
									   'map/src/map.min',
									   'map/jquery-jvectormap-world-mill-en',
									   'timer/TimeCircles.js',
									   'googlemap/map.js'
									   ));
									   
									   
									   
		echo $this->Html->script('jquery.trackpad-scroll-emulator.js');
		
		
		
		echo $this->Html->css(array(
		                            'jquery-jvectormap',
									//'jquery-jvectormap-1',
									'timer/TimeCircles'));
		echo $this->Html->css('style');
		echo $this->Html->script('custom');
		//Previous demo
		//echo $this->Html->script('timer/demo.js');
		//echo $this->Html->script('timer/jquery.timer.js');
		
	?>
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
$(document).ready(function(){

	$('.demo1').TrackpadScrollEmulator();
	$('.demo2').TrackpadScrollEmulator();
	 
});
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
<div id="loading_indicator" class="progress_updation" style="">
						<?php // echo $this->Html->image('loading.gif'); ?>
</div>
<div id="wrapper" class="outer_container">
	<div class="bgimg"><?php echo $this->Html->image('background.jpg') ?></div>
	<div class="banner_wrapper">
		 <div id="header-wrap" class="header_wrapper">
			   <div class="header">
			      <div class="content_level">
				  	<div class="logo_wrapper">
					<?php //echo $this->Html->image('new_logo1.png');?>
                     <?php echo $this->Html->link($this->Html->image('logo.png'), $baseUrl, array('escape' => false));?>
					</div>
					<div class="nav_wrapper">
						<div class="nav">
							<ul>
							<?php 
								if($this->Session->check('userId')):
									if( in_array('account',$purl)) $class = 'link active cmn-t-underline'; else $class = 'link cmn-t-underline';
								    	echo '<li>'.$this->Html->link('My Account', '/users/account', array('class' => $class)).'</li>';
									echo '<li>'.$this->Html->link('Log Out', '/logout', array('class' => 'link','id' => 'logOut')).'</li>';
								else:
									if( in_array('/',$purl)) $class = 'link active cmn-t-underline'; else $class = 'link cmn-t-underline';
								    	echo '<li>'.$this->Html->link('Home', '/', array('class' => $class)).'</li>';
									
									if( in_array('login',$purl)) $class = 'link active cmn-t-underline'; else $class = 'link cmn-t-underline';
										echo '<li>'.$this->Html->link('Log In', '/login', array('class' => $class)).'</li>';
									//echo '<li>'.$this->Html->link('Register', '/register', array('class' => 'link')).'</li>';
								endif;	 
								$baseUrl = Router::url('/',true);
								if( in_array('aboutus',$purl)) $class = 'link active cmn-t-underline'; else $class = 'link cmn-t-underline';
									echo '<li>'.$this->Html->link('About Us', $baseUrl.'aboutus', array('class' => $class)).'</li>';
								
								if( in_array('contactus',$purl)) $class = 'link active cmn-t-underline'; else $class = 'link cmn-t-underline';
									echo '<li>'.$this->Html->link('Contact Us', $baseUrl.'contactus', array('class' => $class)).'</li>';
								if( in_array('store',$purl)) $class = 'link active cmn-t-underline'; else $class = 'link cmn-t-underline';
									echo '<li>'.$this->Html->link('Store', $baseUrl.'store', array('class' => $class)).'</li>';
							?>
						</ul>
						</div>
					</div>
					<div class="clear"></div>
				  </div><!-- content_level -->
			      <div class="content_level headline_wrapper">
				  	<p class="subline"><?php echo $headerDetails['Setting']['heading']; ?></p>
				  </div><!-- content_level headline_wrapper -->
			   </div>
		 </div>
		 
		 <div class="page_content">
		  <?php  echo $this->fetch('content'); ?>
		 </div>
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