<html>
    <head>
        <link href="/css/all.css" rel="stylesheet" media="screen"/>
        <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
        <?php
        echo $this->Html->meta('icon');
        
        if(isset($scripts_for_layout_include) && is_array($scripts_for_layout_include))
            echo $this->Html->script($scripts_for_layout_include);
        
        if(isset($css_for_layout_include) && is_array($css_for_layout_include))
            echo $this->Html->css($css_for_layout_include);
        echo $this->fetch('meta');
        echo $this->fetch('css');
        ?>
    </head>
    <body>
        <?php echo $this->Session->flash(); ?>
        <div class="container">
            <div class="errorPageCont">
                <img src="/img/newImgs/404_img4.png" />
                <p class="notFoundText">Page not found</p>
                <?php if(isset($is_blocked_ip)){?>
                <p class="errorText">
                    This IP address has been blocked by the system/admin, please use this link to
                    <a href="/pages/contactUs">contact us</a>
                    if you feel it was done in error.
		</p>
                <?php }?>
            </div>
            <div style="display: none" id="content">

                    
<?php if(!isset($is_blocked_ip)){
    echo $this->fetch('content');
}?>
                    
            </div>
        </div>
    </body>
</hmtl>