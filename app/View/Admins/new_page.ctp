<h3 class="text-center">Add New Page</h3>
<hr class="separator">
<div class="span5 margauto">    
    <form method="post" class="form-horizontal addMenu">
        <div class="control-group">
            <label class="control-label" >Menu title</label>
            <div class="controls">
                <input type="text" name="name">
                <?php if (isset($error_msg)) { ?>
                    <div class="errorMsg"><?php echo $error_msg ?></div>
                <?php } ?>
            </div>
        </div>   
        <div class="control-group">
            <label class="control-label" >Navigation</label>
            <div class="controls navBox">
                <div>                    
                    <input type="radio" name="navigation" value="top" checked>
                    <span>Top</span>
                </div>
                <div>
                    <input type="radio" name="navigation" value="bottom">
                    <span>Bottom</span>                    
                </div>
                <div>
                    <input type="radio" name="navigation" value="publication">
                    <span>Publication</span>                    
                </div>
                <div>
                    <input type="radio" name="navigation" value="submenu">
                    <span>Submenu</span>                    
                </div>
                <div>
                    <input type="radio" name="navigation" value="not">
                    <span>Do not publish</span>                    
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" >Content</label>
            <div class="controls">
                <textarea name="text"></textarea>
            </div>
        </div>
        <div class="controls btnSection">
            <input type="submit" class="btn btn-success" value="Add">
            <input type="submit" class="btn btn-inverse" value="Apply" name="apply">
            <?php echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'pages'), array('class' => 'btn')); ?>
        </div>
    </form>
</div>
<?php echo $this->Html->script('jquery.cropzoom'); ?>
<?php echo $this->Html->script('tinymce/jscripts/tiny_mce/tiny_mce'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        tinyMCE.init({
            // General options
            file_browser_callback : 'elFinderBrowser',
            mode : "textareas",
            theme : "advanced",
            plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

            // Theme options
            theme_advanced_buttons1 : "save,link,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull | hr,removeformat,|,sub,sup,|,iespell,advhr,|,print,|,ltr,rtl,|,fullscreen |,image,code",
            theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,insertdate,inserttime,preview,|,forecolor,backcolor ",
            theme_advanced_buttons3 : "",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,

            // Example content CSS (should be your site CSS)
            //content_css : "css/main.css",

            // Drop lists for link/image/media/template dialogs

            template_external_list_url : "<?php echo $this->webroot; ?>js/tinymce/examples/lists/template_list.js",
            external_link_list_url : "<?php echo $this->webroot; ?>js/tinymce/examples/lists/link_list.js",
            external_image_list_url : "<?php echo $this->webroot; ?>js/tinymce/examples/lists/image_list.js",
            media_external_list_url : "<?php echo $this->webroot; ?>js/tinymce/examples/lists/media_list.js",

            // Style formats
            style_formats : [
                {title : 'Bold text', inline : 'b'},
                {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
                {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
                {title : 'Example 1', inline : 'span', classes : 'example1'},
                {title : 'Example 2', inline : 'span', classes : 'example2'},
                {title : 'Table styles'},
                {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
            ],

            // Replace values for the template plugin
            template_replace_values : {
                username : "Some User",
                staffid : "991234"
            }
        });
    });
            
    function elFinderBrowser (field_name, url, type, win) {
        var elfinder_url = "<?php echo $this->webroot; ?>js/tinymce/elfinder/elfinder.html";    // use an absolute path!
        tinyMCE.activeEditor.windowManager.open({
            file: elfinder_url,
            title: 'elFinder 2.0',
            width: 900,  
            height: 450,
            resizable: 'yes',
            inline: 'yes', // This parameter only has an effect if you use the inlinepopups plugin!
            popup_css: false, // Disable TinyMCE's default popup CSS
            close_previous: 'no'
        }, 
        {
            window: win,
            input: field_name
        });
        return false;
    }
</script>