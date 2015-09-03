<?php
$cakeDescription = __d('cake_dev', 'Satorio Meditation');
?>
<!DOCTYPE html>
<html>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# meditation_music: http://ogp.me/ns/fb/meditation_music#">
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<!----======Fcebook META======---->
	<meta property="fb:app_id" content="764734903557567" /> 
	<meta property="og:type" content="meditation_music:meditation"> 
	<meta property="og:url"    content="http://meditationmusic.net" /> 
	<meta property="og:description"  content="Feel the connection of meditating with people from around the world. If you are new to meditating, press on the 2 minute button and try to concentrate on your breathe."/> 
	<meta property="og:image"  content="http://thepandathinks.files.wordpress.com/2013/01/meditation.jpg" /> 
	<!----====----->
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<!--[if IE]>
	<?php echo $this->Html->css('all-ie-only.css');?>
	<![endif]-->
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
	<?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		echo $this->Html->meta('icon');
		
		echo $this->Html->script(array(
                    'jquery.min',
                    'jplayer/jquery.jplayer.min',
                    //'datetimepicker',
                    //'jquery.countdown',
                    'map/map',
                    //'map/jquery-jvectormap-1',
                    //'map/jquery-jvectormap-world-mill-en',
                ));
		echo $this->Html->script('custom.js');
		
		/*echo $this->Html->script('jquery-1.10.2.min');*/
		//echo $this->Html->script('datepick.js');
		//echo $this->Html->css(array('jquery-jvectormap-1','datetimepicker.css'));
                
		
		/*echo $this->Html->script('jquery-1.10.2.min');*/
		//echo $this->Html->script('datepick.js');
		//echo $this->Html->css(array('jquery-jvectormap-1','datetimepicker.css'));
		//echo $this->Html->css('style');
		
		
	?>
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/common.css">
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
        <!--Google analytics-->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-62972002-1', 'auto');
          ga('send', 'pageview');

        </script>
        
	<!-- End of Woopra Code -->
    </head>
    <body class="cbp-spmenu-push">
        
    <?php $baseUrl = Router::url('/',true);
    $purl = explode('/',$this->here); 
    echo $this->Form->hidden('baseUrl',array('label' => false, 'value'=> $baseUrl, 'id' => 'baseUrl','name' => 'baseUrl'));
    ?>
    <!--<div class="bgimg"><?php //echo $this->Html->image('bg2.jpg') ?></div>-->
    <!--<div class="lightModalOverlaydefault">&nbsp;</div>-->
            <?php $purl = explode('/',$this->here); ?>
    <div id="container">
                <div class="content-wrap">
                    <div id="header_wrapper">
                        <div id="header">
                            <div id="logo">
                                <a href="/"><img src="/img/logo.png" /></a>
                            </div>
                            <div id="navigation">
                                <nav class="main-nav overlay clearfix">
                                        <a id="menuButton"  class="menu-button openMenu" href="#">
                                            <span class="burger">☰</span>
                                            <span class="word">Menu</span>
                                        </a>
                                </nav>
                                <div class="clearfix"></div>

                                <nav id="navigationItems" class="nav nav_closed">
                                    <ul class=navList>
                                    <?php 
                                            if($this->Session->check('userId')):
                                                    if( in_array('account',$purl)) $class = 'link active cmn-t-underline'; else $class = 'link cmn-t-underline';
                                                    echo $this->Html->link('<li>My Account</li>', '/users/account', array('class' => $class, 'escape'=>false));
                                                    echo $this->Html->link('<li>Log Out</li>', '/logout', array('class' => 'link','id' => 'logOut', 'escape'=>false));
                                            else:
                                                    if( in_array('/',$purl)) $class = 'link active cmn-t-underline'; else $class = 'link cmn-t-underline';
                                                    echo $this->Html->link('<li>Home</li>', '/', array('class' => $class, 'escape'=>false));

                                                    if( in_array('login',$purl)) $class = 'link active cmn-t-underline'; else $class = 'link cmn-t-underline';
                                                            echo $this->Html->link('<li>Log In</li>', '/login', array('class' => $class, 'escape'=>false));
                                                    //echo '<li>'.$this->Html->link('Register', '/register', array('class' => 'link')).'</li>';
                                            endif;	 
                                            $baseUrl = Router::url('/',true);
                                            if( in_array('aboutus',$purl)) $class = 'link active cmn-t-underline'; else $class = 'link cmn-t-underline';
                                                    echo $this->Html->link('<li>About Us</li>', $baseUrl.'aboutus', array('class' => $class, 'escape'=>false));

                                            if( in_array('contactus',$purl)) $class = 'link active cmn-t-underline'; else $class = 'link cmn-t-underline';
                                                    echo $this->Html->link('<li>Contact Us</li>', $baseUrl.'contactus', array('class' => $class, 'escape'=>false));
                                            if( in_array('store',$purl)) $class = 'link active cmn-t-underline'; else $class = 'link cmn-t-underline';
                                                    echo $this->Html->link('<li>Store</li>', $baseUrl.'store', array('class' => $class, 'escape'=>false));
                                    ?>
                                    </ul>
                                </nav>

                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="banner_wrapper">
                        <?php  echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>

            <script src="/js/classie.js"></script>
            <script type="text/javascript">
                var menu = document.getElementById('navigationItems');
                var button = document.getElementById('menuButton');
                var content = document.getElementById('banner_wrapper');


                button.onclick = function () {
                    classie.toggle(menu, 'nav_closed');
                    classie.toggle(content, 'move_banner');
                }
            </script>
    <!--#-->


            <?php //echo $this->element('sql_dump'); ?>
    <!--    <div id="footer-wrap">
            <div class="footer-inner">
                <p>Copyright &copy; 2013 <a href="#">MEDITATION MUSIC </a> - All Rights Reserved - <a href="#">Terms of Use</a></p>
            </div>
         </div>-->
    </body>
</html>