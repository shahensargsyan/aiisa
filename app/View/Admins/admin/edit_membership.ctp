<div class="regform span5 margauto">
    <h3 class="text-center">Edit Membership</h3>
    <hr class="separator">
    
    <?php
        if(isset($error)){
            ?>
            <div class="libErrorBox">
                <?php echo $error; ?>
            </div>
            <?php
        }
    ?>

    <?php
    echo $this->Form->Create(
            'Membership', array(
        'inputDefaults' => array(
            'label' => array('class' => 'control-label'),
            'div' => array('class' => 'controls')),
        'class' => 'form-horizontal'
            )
    );
    ?>

    <div class="control-group">
        <label class="control-label">Name</label>
        <?php
        echo $this->Form->input(
                'name', array(
            'type' => 'text',
            'label' => FALSE,
            'error' => false,
            'placeholder' => "Name"
                )
        );
        ?>
    </div>

    <div class="control-group">
        <label class="control-label">Type</label>
        <?php
        $package_options = array(
            'package' => 'Package',
            'individual' => 'Individual',
        );
        echo $this->Form->input('type', array(
            'type' => 'select',
            'options' => $package_options,
            'label' => FALSE,
            'id' => 'type'
        ));
        ?>
    </div>


    <div id="Package" hidden>
        <div class="control-group twoFlds">
            <label class="control-label">Month</label>
            <?php
            echo $this->Form->input(
                    'month_price', array(
                'type' => 'text',
                'label' => FALSE,
                'error' => false,        
                'placeholder' => "Price",
                'class' => 'price'
                    )
            );
            echo $this->Form->input(
                    'month_count', array(
                'type' => 'text',
                'label' => FALSE,
                'error' => false,        
                'placeholder' => "Count",
                'class' => 'count'
                    )
            );
            ?>
        </div>
    </div>
    <div class="control-group" id="Individual" hidden>
        <label class="control-label">Individual</label>
        <?php
        echo $this->Form->input(
                'individual_price', array(
            'type' => 'text',
            'label' => FALSE,
            'error' => false,        
            'placeholder' => "Price",
            'class' => 'price',
                )
        );
        ?><br>
       
    </div>
    <label class="control-label" >Description 1</label>
    <?php echo $this->Form->input('description',array('type'=>'textarea','label'=>FALSE));?>
    <label class="control-label" >Description 2</label>
    <?php echo $this->Form->input('description2',array('type'=>'textarea','label'=>FALSE));?>
    <div class="control-group contractsBox">
        <label class="control-label" >Contracts</label>
        <?php
        $options = array();
        foreach ($contracts as $contract) {
            $options[$contract['Contract']['id']] = $contract['Contract']['name'];
        }
        echo $this->Form->input('contract_id', array('multiple' => 'checkbox', 'options' => $options, 'label' => false));
        ?>          
        <!--        </div>-->
    </div>

    <div class="control-group mtop20">
        <label class="control-label">Active</label>
        <div class="controls navFieldset">
            <?php
            $options = array('1' => 'active', '0' => 'inactive');
            echo $this->Form->radio('active', $options);
            ?>   
        </div>   
    </div>

    <div class="control-group btnSection">  
        <label class="control-label"></label>
        <div class="controls">
            <?php
            echo $this->Form->submit(
                    'Save', array(
                'label' => false,
                'div' => FALSE,
                'class' => 'btn btn-success'
                    )
            );
            ?>
            <?php echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'memberships'), array('class' => 'btn'));
            ?>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function(){
        $(function() {
            type = $( "#type" ).val();
            if(type == 'package'){
                $('#Package').show();
                $('#Individual').hide();
            }
            else{
                    $('.checkbox').children('input').on('click',function(){
                        $('.checkbox').children('input').prop('checked',false);
                        $(this).prop('checked',true);
                    });   
                 $('#Individual').show();
                 $('#Package').hide();
            }
            $( "#type" ).change(function() {
                type = $( "#type" ).val();
                $('.checkbox').children('input').removeAttr('disabled');
                if(type == 'package'){
                    $('.checkbox').children('input').prop('checked',false);                    
                    $('#Package').show();
                    $('#Individual').hide();
                }
                if(type == 'individual'){
                    $('.checkbox').children('input').prop('checked',false);
                    $('.checkbox').children('input').on('click',function(){
                        $('.checkbox').children('input').prop('checked',false);
                        $(this).prop('checked',true);
                    });                                
                    $('#Individual').show();
                    $('#Package').hide();
                }
            });
        });
    });
</script>

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