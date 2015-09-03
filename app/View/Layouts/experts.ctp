<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        if (isset($css_for_layout_include) && is_array($css_for_layout_include))
            echo $this->Html->css($css_for_layout_include);
        echo $this->Html->meta('icon');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        
        echo $this->Html->css('adminbootstrap.min');
        echo $this->Html->css('admin');
        ?>
        <?php
        if (isset($scripts_for_layout_include) && is_array($scripts_for_layout_include))
            echo $this->Html->script($scripts_for_layout_include);
        
        echo $this->fetch('script');
        ?>
        

    </head>
    <body>


<?php echo $this->element('noteJg'); ?>
        <div id="container">            
            <div id="content">                
                <?php echo $this->element('header_exp'); ?>
                <div class="container padTop40">                    
                    <?php echo $this->fetch('content'); ?>        
                </div>
            </div>
        </div>
    </body>
</html>
