<div class="span10 margauto">
    <h3 class="text-center">Add Event</h3>
    <hr class="separator">
    
    <div class="control-group">
        <label class="control-label"></label>
        <?php
            if(isset($error)){
                echo $error;
            }
        ?>
    </div>
    
    <?php
    echo $this->Form->Create(
            'Event', array(
                'inputDefaults' => array(
                    'label' => array('class' => 'control-label'),
                    'div' => array('class' => 'controls')),
                'class' => 'form-horizontal'
            )
    );
    ?>
    
     <div class="control-group">
        <label class="control-label">Title</label>
        <?php
        echo $this->Form->input(
                'title', array(
                    'type' => 'text',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Event Title"
                )
        );
        ?>
    </div> 
     <div class="control-group">
        <label class="control-label">Event type</label>
        <?php
        echo $this->Form->input(
                'event_type', array(
                    'options' => $eventTypes,
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Event type"
                )
        );
        ?>
    </div> 
    <div class="control-group">
        <label class="control-label">Event Date</label>
        <?php
        echo $this->Form->input(
                'event_date', array(
                    'type' => 'text',
                    'id' => 'event_date',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Event Date"
                )
        );
        ?>
    </div> 
    <div class="control-group">
        <label class="control-label">From Time</label>
        <?php
        echo $this->Form->input(
                'from_time', array(
                    'type' => 'text',
                    'id' => 'from_time',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "From Time"
                )
        );
        ?>
    </div> 
    <div class="control-group">
        <label class="control-label">To Time</label>
        <?php
        echo $this->Form->input(
                'to_time', array(
                    'type' => 'text',
                    'id' => 'to_time',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "To Time"
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Location</label>
        <?php
        echo $this->Form->input(
                'location', array(
                    'type' => 'text',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Location"
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Participants</label>
        <?php
        echo $this->Form->input(
                'participants', array(
                    'type' => 'textarea',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Participants",
                    'required' => false,
                    'novalidate' => true
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Overview</label>
        <?php
        echo $this->Form->input(
                'overview', array(
                    'type' => 'textarea',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Overview",
                    'required' => false,
                    'novalidate' => true
                )
        );
        ?>
    </div>
        <div class="control-group">
        <label class="control-label">Select Topic</label>
        <?php
        echo $this->Form->input(
                'topic_id', array(
                    'options' => $topics,
                    'label' => FALSE,
                    'empty' => "Select Topic"
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Select Region</label>
        <?php
        echo $this->Form->input(
                'region_id', array(
                    'options' => $regions,
                    'label' => FALSE,
                    'empty' => "Select Region"
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Select Program</label>
        <?php
        echo $this->Form->input(
                'program_id', array(
                    'options' => $programs,
                    'label' => FALSE,
                    'empty' => "Select Program"
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Select Project</label>
        <?php
        echo $this->Form->input(
                'project_id', array(
                    'options' => $projecrs,
                    'label' => FALSE,
                    'empty' => "Select Project"
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Email</label>
        <?php
        echo $this->Form->input(
                'email', array(
                    'type' => 'text',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Email"
                )
        );
        ?>
    </div>
    
    
     <div class="control-group">
        <label class="control-label">Active</label>
        <?php
        echo $this->Form->input(
            'active', array(
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
        <?php echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'events'), array('class' => 'btn'));
        ?>
        </div>
    </div>
</div>
<?php echo $this->Html->script('tinymce/jscripts/tiny_mce/tiny_mce'); ?>
<script type="text/javascript">
    var WIDTH,HEIGHT,tmpFileName;
    $( "#event_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $('#to_time').timepicker({ 'scrollDefault': 'now' });
    $('#from_time').timepicker({ 'scrollDefault': 'now' });
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