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
        
        <script type="text/template" id="simple-previews-template">
            <div class="qq-uploader-selector qq-uploader">
                <div class="qq-upload-button-selector btn btn-primary">
                    <div>Upload a file</div>
                </div>
                <ul class="qq-upload-list-selector qq-upload-list">
                    <li class="alert alert-success">
                        <div class="qq-progress-bar-container-selector">
                            <div class="qq-progress-bar-selector qq-progress-bar"></div>
                        </div>
                        <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                        <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                        <span class="qq-edit-filename-icon-selector qq-edit-filename-icon"></span>
                        <span class="qq-upload-file-selector qq-upload-file"></span>
                        <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    </li>
                </ul>
            </div>
        </script>
    </head>
    <body>


<?php echo $this->element('noteJg'); ?>
        <div id="container">            
            <div id="content">                
                <?php echo $this->element('header_admin'); ?>
                <div class="container padTop40">                    
                    <?php echo $this->fetch('content'); ?>        
                </div>
            </div>
        </div>
    </body>
</html>
