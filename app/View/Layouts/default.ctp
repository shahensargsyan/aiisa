<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <!-- set the encoding of your site -->
        <meta charset="utf-8">
        <?php //var_dump(!$index_search_engine);die; ?>
        <?php if(isset($index_search_engine) && !$index_search_engine){ ?>
            <meta name="robots" content="noindex, nofollow">
        <?php } ?>
        <!-- set the viewport width and initial-scale on mobile devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='http://fonts.googleapis.com/css?family=Muli:400,300|Open+Sans:400,400italic,600,600italic,700,700italic|Alfa+Slab+One' rel='stylesheet' type='text/css'>
	<?php
        echo $this->Html->meta('icon');
        
        if(isset($scripts_for_layout_include) && is_array($scripts_for_layout_include))
            echo $this->Html->script($scripts_for_layout_include);
        
        if(isset($css_for_layout_include) && is_array($css_for_layout_include))
            echo $this->Html->css($css_for_layout_include);
        echo $this->fetch('meta');
        echo $this->fetch('css');
        ?>
        <!-- include HTML5 IE enabling script and stylesheet for IE -->
        <!--[if lt IE 9]>
                <link rel="stylesheet" type="text/css" href="/css/ie.css" media="screen"/>
                <script type="text/javascript" src="/js/ie.js"></script>
        <![endif]-->
        <script type="text/javascript">
            if(navigator.userAgent.match(/IEMobile\/10\.0/) || navigator.userAgent.match(/MSIE 10.*Touch/)){
                var msViewportStyle = document.createElement('style')
                msViewportStyle.appendChild(
                        document.createTextNode(
                        '@-ms-viewport{width:auto !important}'
                        )
                        )
                document.querySelector('head').appendChild(msViewportStyle)
            }
        </script>
    </head>
    <body class="home">   
        <div id="wrapper">
            <?php echo $this->element('header'); ?>
            
            <main id="main">
                <div class="container">
                    <?php if($this->here ==  "/pages/legal_documents"){?>
                        <section class="documents allDocsList"> 
                    <?php } ?>
                        <?php echo $this->Session->flash(); ?>
                        <?php echo $this->fetch('content'); ?>
                    <?php if($this->here ==  "/pages/legal_documents"){?>
                        </section>    
                    <?php } ?>
                </div>
            </main>
            <?php
            if($this->params['controller'] != 'admins'){
                echo $this->element('footer');
            }
            ?>
        </div>
        <?php
        if(isset($scripts_for_layout_include) && is_array($scripts_for_layout_include))
            echo $this->Html->script($scripts_for_layout_include);
        echo $this->fetch('script');
        ?>
    </body>
</html>
