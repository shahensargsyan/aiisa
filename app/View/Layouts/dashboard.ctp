<?php
$cakeDescription = __d('cake_dev', 'Satorio Meditation');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Satorio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'>

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="/css/common.css">

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
        <?php echo $this->Html->css('all-ie-only.css'); ?>
        <![endif]-->

        <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');

        echo $this->Html->meta('icon');

        echo $this->Html->script(array(
            'jquery.min',
            'jquery-ui',
            'highcharts',
            'map/map',
            'custom',
            'jquery.jgrowl'
        ));

        echo $this->Html->script('jquery.trackpad-scroll-emulator.js');

        echo $this->Html->css(array(
            'jquery-jvectormap',
            'timer/TimeCircles',
            'layout',
            'dashboard',
            'progress-bar',
            'msg',
            'jquery.jgrowl'
            ));

        ?>
        <!-- Start of Woopra Code -->
        <script>
            
            (function() {
                var t, i, e, n = window, o = document, a = arguments, s = "script", r = ["config", "track", "identify", "visit", "push", "call"], c = function() {
                    var t, i = this;
                    for (i._e = [], t = 0; r.length > t; t++)
                        (function(t) {
                            i[t] = function() {
                                return i._e.push([t].concat(Array.prototype.slice.call(arguments, 0))), i
                            }
                        })(r[t])
                };
                for (n._w = n._w || {}, t = 0; a.length > t; t++)
                    n._w[a[t]] = n[a[t]] = n[a[t]] || new c;
                i = o.createElement(s), i.async = 1, i.src = "//static.woopra.com/js/w.js", e = o.getElementsByTagName(s)[0], e.parentNode.insertBefore(i, e)
            })("woopra");

            woopra.config({
                domain: 'meditationmusic.net',
                idle_timeout: 1800000
            });
            woopra.track();
            $(document).ready(function() {

                $('.demo1').TrackpadScrollEmulator();
                $('.demo2').TrackpadScrollEmulator();

            });
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

    <body>
<div class="hidden" id="baseurl"><?php echo Router::url('/', true); ?></div>
        <div id="container">
            <div class="content-wrap">
                    <?php echo $this->element('header');  ?>
                    
                <?php echo $this->element('noteJg'); ?>
                <div id="banner_wrapper">
                    <?php  echo $this->fetch('content'); ?>
                </div>
            </div>
            <?php
            if($this->params['controller'] == 'meditations'){
            echo $this->element('home_footer'); 
            }?> 
        </div>
            <script src="/js/classie.js"></script>
            <script type="text/javascript">
            var menu = document.getElementById('navigationItems');
            var button = document.getElementById('menuButton');
            var content = document.getElementById('banner_wrapper');


            button.onclick = function() {
                classie.toggle(menu, 'nav_closed');
                classie.toggle(content, 'move_banner');
            }
            </script>
            <!-- FLASH MESSAGE-->
            <?php if( $this->Session->check('Message.flash') ): ?>
                <div id="registration_message">
                    <div class="flash-message"><?php echo $this->Session->flash(); ?></div>
                </div>		 
            <?php endif; ?>
            <script type="text/javascript">hideFlash('registration_message');</script>
            <!-- END @ FLASH MESSAGE-->
    </body>

</html>