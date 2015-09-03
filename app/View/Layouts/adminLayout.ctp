<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Satorio Meditation:');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription;?>
		IN ADMIN PANEL
	</title>
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
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('admin/style.css');
		
		
		//echo $this->Html->css('style.css');
		echo $this->Html->css('admin/niceforms-default.css');
		echo $this->Html->script('admin/jquery.min.js');
		//echo $this->Html->script('admin/ddaccordion.js');
		//echo $this->Html->script('custom.js');
		echo $this->Html->script('admin/adminCustom.js');
		//echo $this->Html->script('admin/js/clockp.js');
		//echo $this->Html->script('admin/clockh.js');
		//echo $this->Html->script('admin/niceforms.js');
		//echo $this->Html->script(array('jquery.min'));
		//echo $this->Html->script('jplayer/jquery.jplayer.min');
		//echo $this->Html->script('jquery-1.10.2.min');
		
		//echo $this->Html->script('jquery.countdown');	
		//echo $this->Html->script('googlemap/map');
		//echo $this->Html->script(array('jquery-jvectormap-1', 'jquery-jvectormap-world-mill-en'));
		//echo $this->Html->css(array('jquery-jvectormap-1'));
		//echo $this->Html->script('custom');
		?>
<script type="text/javascript">/*
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	//revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	//mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	//collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	//defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	//onemustopen: true, //Specify whether at least one header should be open always (so never all headers closed)
	//animatedefault: false, //Should contents open by default be animated into view?
	//persiststate: true, //persist state of opened contents within browser session?
	//toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	//togglehtml: ["suffix", "<img src='http://meditationmusic.net/img/admin/images/plus.gif' class='statusicon' />", "<img src='http://meditationmusic.net/img/admin/images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "normal", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})*/
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
<?php
		echo $this->Html->script('admin/jconfirmaction.jquery.js');?>
	<script type="text/javascript">	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
</script>
<?php //echo $this->Html->script('admin/jquery.jclock-1.2.0.js.txt');?>
<script type="text/javascript">
/*$(function($) {
    $('.jclock').jclock();
});*/
</script>

<?php 
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		$purl = explode('/',$this->here);
?>
</head>
<body>
<div id="main_container">
	<div class="hidden" id="baseurl" style="display:none;"><?php echo Router::url('/', true); ?></div>
	<div class="header">
    
    <div class="right_header">Welcome Admin | <?php echo $this->Html->link('Log Out',array('controller' => 'admins', 'action' => 'logOut','class'=> 'logout'))?></div>
    <div class="jclock"></div>
    </div>

    <div class="main_content">
    
                    <div class="menu">
                    <ul>
                    <li><?php if(in_array('settings',$purl) || in_array('adminSetting',$purl)) $class='current';else $class ='';
								echo $this->Html->link('Dashboard',Router::url('/', true).'admins/adminSetting',array('class' => $class));?>
					</li>
                    <li>
					<?php if( in_array('meditationUsers',$purl) || in_array('managerUser',$purl)) $class = 'current'; else $class = ''; ?>
					<?php echo $this->Html->link('MangeUsers', Router::url('/', true).'admins/meditationUsers', array('class' => $class)); ?>
					<!--<a href="login.html">Manage Users<!--[if IE 7]><!--><!--</a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                       <ul>
                        <li><? echo $this->Html->link('Registered Users',  Router::url('/', true).'admins/meditationUsers', array('class' => $class)); ?></li>
                      <!--  <li><? //echo $this->Html->link('Manager Users',  Router::url('/', true).'admins/managerUser', array('class' => $class)); ?></li>-->
                       </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
                    <li>
					<?php if( in_array('myProfile',$purl)) $class = 'current'; else $class = ''; ?>
					<?php echo $this->Html->link('My Account',  Router::url('/', true).'admins/myProfile', array('class' => $class)); ?>
					<!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <ul>
                        <li><? echo $this->Html->link('My Profile',  Router::url('/', true).'admins/myProfile', array('class' => $class)); ?></li>
                        <li><? echo $this->Html->link('Change Password',  Router::url('/', true).'admins/changePassword', array('class' => $class)); ?></li>
                        </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
                    <li> <?php if( in_array('inbox',$purl)) $class = 'current'; else $class = ''; 
							echo $this->Html->link('Messages',  Router::url('/', true).'admins/inbox', array('class' => $class)); ?>
					</li>
					<li class="notify">
					 <?php
					        
							echo $this->Html->link('Notification',  Router::url('/', true).'admins/notifications', array('class' => 'notify')); ?>
						    <span><?php 
							if($noti!=0):
								echo $noti; 
							endif;
							?></span>
					</li>
					
					
					<!--[if IE 7]><!--><!--</a><!--<![endif]-->
                    <!--[if lte IE 6]><table><tr><td><![endif]-->
                        <!--<ul>
                        <li><a href="" title="">Lorem ipsum dolor sit amet</a></li>
                        <li><a href="" title="">Lorem ipsum dolor sit amet</a></li>
                        <li><a href="" title="">Lorem ipsum dolor sit amet</a></li>
                        <li><a class="sub1" href="" title="">sublevel2<!--[if IE 7]><!--></a><!--<![endif]-->
                        <!--[if lte IE 6]><table><tr><td><![endif]-->
                            <!--<ul>
                                <li><a href="" title="">sublevel link</a></li>
                                <li><a href="" title="">sulevel link</a></li>
                                <li><a class="sub2" href="#nogo">sublevel3<!--[if IE 7]><!--></a><!--<![endif]-->
                        
                                <!--[if lte IE 6]><table><tr><td><![endif]-->
                               <!--     <ul>
                                        <li><a href="#nogo">Third level-1</a></li>
                                        <li><a href="#nogo">Third level-2</a></li>
                                        <li><a href="#nogo">Third level-3</a></li>
                                        <li><a href="#nogo">Third level-4</a></li>
                                    </ul>
                        
                                <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                                <!--</li>
                                <li><a href="" title="">sulevel link</a></li>
                            </ul>
                        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                        <!--</li>
                    
                         <li><a href="" title="">Lorem ipsum dolor sit amet</a></li>
                        </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    <!--</li>
                    <li><a href="">Templates</a></li>
                    <li><a href="">Contact</a></li>
                    --></ul>
                    </div> 
                    
                    
                    
                    
    <div class="center_content">  
    
    
    
    <div class="left_content">
            <div class="sidebarmenu">
            	<?php 
				if(in_array('adminSetting',$purl) || in_array('settings',$purl)){$class = 'current';$style="display:block;";} else {$class = '';$style="display:none;";}
				echo $this->Html->link('Dashboard', Router::url('/', true).'admins/adminSetting',array('class' => "menuitem submenuheader ". $class."",'style'=>$style));?>
                <!--<a class="menuitem submenuheader" href="/">Dashboard</a>-->
                <?php echo '<div class="submenu" style='.$style.'>';?>
				   <ul>
				   <style>
				   .active{
				   background : rgb(226,240,255);       
				   }
				   </style>
                   <?php if(in_array('adminSetting',$purl))$class="active";else $class='';?> 
					<li class = "<? echo $class;?>"><?php echo $this->Html->link('My Dashboard', Router::url('/', true).'admins/adminSetting',array('class' => 'submenuLink'));?></li>					
					<?php if(in_array('settings',$purl))$class="active";else $class='';?>
					<li class = "<? echo $class;?>"><?php echo $this->Html->link('Site Dashboard', Router::url('/', true).'settings',array('class' => "submenuLink"));?></li>	
				    <li><?php echo $this->Html->link('Visit Site',Router::url('/', true),array('class' => 'submenuLink','target' =>'_blank'));?></li>
                    <!--<li><a href="">Sidebar submenu</a></li>
                    <li><a href="">Sidebar submenu</a></li>
                    <li><a href="">Sidebar submenu</a></li>
                    --></ul>
                </div>
               <?php 
			   if(in_array('managerUser',$purl) || in_array('meditationUsers',$purl) || in_array('editUserProfile',$purl) || in_array('editManagerUser',$purl) || in_array('viewDetail',$purl)){$class = 'current'; $style="display:block;";}else {$class = '';$style="display:none;";}
			   echo $this->Html->link('Manage Users',Router::url('/', true).'admins/manageUser',array('class' => 'menuitem submenuheader '.$class.'','style'=>$style));  
			   ?>
			   <?php echo '<div class="submenu" style='.$style.'>';?>
                    <ul><?
					if(in_array('meditationUsers',$purl) || in_array('editUserProfile',$purl))$class="active";else $class='';?>
                    <li class = "<? echo $class;?>"><?php echo $this->Html->link('Registered User',Router::url('/', true).'admins/meditationUsers',array('class' => 'submenuLink'));?></li>
					<?php /*
					  if(in_array('managerUser',$purl) || in_array('editManagerUser',$purl))$class="active";else $class='';
                    <li class = "<? echo $class;?>"><?php echo $this->Html->link('Manager User',Router::url('/', true).'admins/managerUser',array('class' => 'submenuLink'));</li>
                   	 	*/
					 ?>
                    </ul>
                </div>
                <?php 
				if(in_array('myProfile',$purl) || in_array('changePassword',$purl)){$class = 'current'; $style="display:block;";}else {$class = '';$style="display:none;";}
				echo $this->Html->link('Account',Router::url('/', true).'admins/myProfile',array('class' => 'menuitem submenuheader '.$class.'','style'=>$style));?>
                
				<?php echo '<div class="submenu" style='.$style.'>';?>
                    <ul><?
					if(in_array('myProfile',$purl))$class="active";else $class='';?>
                    <li class = "<? echo $class;?>"><?php echo $this->Html->link('My Profile',Router::url('/', true).'admins/myProfile',array('class' => 'submenuLink'));?></li>
                    <? if(in_array('changePassword',$purl))$class="active";else $class='';?>
					<li class = "<? echo $class;?>"><?php echo $this->Html->link('Change Password',Router::url('/', true).'admins/changePassword',array('class' => 'submenuLink'));?></li>
                    <!--<li><a href="">Sidebar submenu</a></li>
                    <li><a href="">Sidebar submenu</a></li>
                    <li><a href="">Sidebar submenu</a></li>-->
                    </ul>
                </div>
				  <?php 
				if(in_array('inbox',$purl) || in_array('viewMail',$purl) || in_array('createMail',$purl) || in_array('sentMail',$purl) || in_array('viewSentMail',$purl)){$class = 'current'; $style="display:block;";}else {$class = '';$style="display:none;";}
				echo $this->Html->link('Messages',Router::url('/', true).'admins/inbox',array('class' => 'menuitem submenuheader '.$class.'','style'=>$style));?>
                
				<?php echo '<div class="submenu" style='.$style.'>';?>
                    <ul><?
					if(in_array('inbox',$purl) || in_array('viewMail',$purl) )$class="active";else $class='';?>
                    <li class = "<? echo $class;?>"><?php echo $this->Html->link('Inbox',Router::url('/', true).'admins/inbox',array('class' => 'submenuLink'));?></li>
                    <? if(in_array('createMail',$purl))$class="active";else $class='';?>
					<li class = "<? echo $class;?>"><?php echo $this->Html->link('Compose',Router::url('/', true).'admins/createMail',array('class' => 'submenuLink'));?></li>
					<? if(in_array('sentMail',$purl) || in_array('viewSentMail',$purl))$class="active";else $class='';?>
					<li class = "<? echo $class;?>"><?php echo $this->Html->link('Sent',Router::url('/', true).'admins/sentMail',array('class' => 'submenuLink'));?></li>
                    <!--<li><a href="">Sidebar submenu</a></li>
                    <li><a href="">Sidebar submenu</a></li>
                    <li><a href="">Sidebar submenu</a></li>-->
                    </ul>
                </div>
				<!--
                <a class="menuitem" href="">User Reference</a>
                <a class="menuitem" href="">Blue button</a>
                 -->   
            </div>
            
            
              
    
    </div>  
        <div class="right_content">      
		<?php echo $this->fetch('content');?> 
		 </div><!-- end of right content--> 
		 </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
    <div class="footer">
    
    	<div class="left_footer">IN ADMIN PANEL</div>
    	
    
    </div>
<? // echo $this->Element('sql_dump');?>
</div>	
