<div class="regform span5 margauto">
    <h3 class="text-center">Add Custom Page</h3>
    <hr class="separator">
    <h4>
        <?php
            if(isset($error)){?>
                <div class="libErrorBox">
                <?php echo $error; ?>
                </div>
                <?php }
        ?>
    </h4>
    <?php
    echo $this->Form->Create(
        'CustomPage', 
        array(
            'inputDefaults' => array(
                'label' => false,
                'div' => array('class' => 'controls')
            ),
            'class' => 'form-horizontal'
        )
    );
    ?>

    <div class="control-group">
        <label class="control-label">Title</label>
        <?php
        echo $this->Form->input(
            'title', 
            array(
                'type' => 'text',
                'error' => false,        
                'placeholder' => "Title"
            )
        );
        ?>
    </div>
    
    <div class="control-group">
        <label class="control-label">Url</label>
        <?php
        echo $this->Form->input(
            'url', 
            array(
                'type' => 'text',
                'error' => false,        
                'placeholder' => "Url"
            )
        );
        ?>
        <p style="margin-left: 38%">Will be generated if left empty</p>
    </div>
    <div class="control-group">
        <label class="control-label">Content</label>
        <?php
        echo $this->Form->input(
            'content', 
            array(
                'type' => 'textarea',
                'error' => false,
            )
        );
        ?>
    </div>
    
    
    <div class="control-group mtop20">
        <label class="control-label">Index?</label>
        <?php
        echo $this->Form->input(
            'index', 
            array(
                'label' => FALSE,
                'options' => array(
                    1 => 'Yes',
                    0 => 'no'
                )
            )
        );
        ?>
    </div>
    
    <div class="control-group mtop20">
        <label class="control-label">Active</label>
        <?php
        echo $this->Form->input(
            'active', 
            array(
                'label' => FALSE,
                'options' => array(
                    1 => 'active',
                    0 => 'inactive'
                )
            )
        );
        ?>
    </div>
    <div class="control-group btnSection">  
        <label class="control-label"></label>
        <div class="controls">
            <?php
            echo $this->Form->submit(
                    'Add', array(
                'label' => false,
                'div' => FALSE,
                'class' => 'btn btn-success'
                    )
            );
            ?>
            <?php echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'customPages'), array('class' => 'btn'));
            ?>
        </div>
    </div>
</div>
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