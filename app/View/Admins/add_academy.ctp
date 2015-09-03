<div class="span5 ">
    <h3 class="text-center">Add Academy Page</h3>
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
            'Academy', array(
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
                    'placeholder' => "Title"
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Title</label>
        <?php
        echo $this->Form->input(
                'title', array(
                    'type' => 'text',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Title"
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Intro text</label>
        <?php
        echo $this->Form->input(
                'intro_text', array(
                    'type' => 'textarea',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Intro text",
                    'required' => FALSE
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Content</label>
        <?php
        echo $this->Form->input(
                'content', array(
                    'type' => 'textarea',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Title",
                    'required' => FALSE
                 )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Photo title</label>
        <?php
        echo $this->Form->input(
                'photo_title', array(
                    'type' => 'text',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Photo by"
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
        <?php
        echo $this->Form->input(
                'photo', array(
                    'type' => 'hidden',
                    'id' => 'image',
                )
        );
        ?>
<!--    <div class="control-group">
        <label class="control-label">Document</label>
        <?php

        ?>
    </div>-->
    <div class="control-group">
        <div class="uploadPhotoSec">            
            <div id="file-uploader">Photo</div>
            <div id="cont" class="uploadedImg"></div>             
        </div>

        <div class="example" style="display:none">
            <div class="default">
                <div class="cropMain"></div>
                <div class="cropSlider"></div>
                <button class="cropButton cropInCustomer">Crop and Save</button>
            </div>
        </div>
    </div>
    <div>
        <img src="" id="imgrounded" />
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
        <?php echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'academies'), array('class' => 'btn'));
        ?>
        </div>
    </div>
</div>

<?php echo $this->Html->script('tinymce/jscripts/tiny_mce/tiny_mce'); ?>
<script type="text/javascript">
    var WIDTH,HEIGHT,tmpFileName;
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
    
    $(document).ready(function(){
        var uploader = new qq.FileUploader({
            element: document.getElementById("file-uploader"),
            'action': '/admins/uploadTempPhoto',
            'debug': false,
            multiple: false,
            sizeLimit: 10 * 1024 * 1024, // max size   
            minSizeLimit: 0, // min size
            allowedExtensions: ['jpg', 'jpeg', 'gif', 'png', 'GPG'],
            onSubmit: function(id, fileName){
                //$('#load').html('<img src="/img/loading.gif" style="margin-left:109px;margin-top:-34px;position:absolute;"/>')
            },
            onProgress: function(id, fileName, responseJSON){
            },
            onComplete: function(id, fileName, responseJSON){
                console.log(responseJSON);
                if(responseJSON.success == true){
                    WIDTH = responseJSON.width;
                    HEIGHT = responseJSON.height;
                    console.log('/temp/'+responseJSON.fileName);
                    tmpFileName = responseJSON.fileName;
                    initCrop('/temp/'+responseJSON.fileName)
                    $('.qq-upload-list').remove();
                    height = responseJSON.height
                    width = responseJSON.width
                }else{
                    console.log(responseJSON.message)
                    $.jGrowl(responseJSON.message,{position:'center'});
                    $('#load').empty();
                    $('.qq-upload-list').remove();
                }
            },
            onCancel: function(id, fileName){$('.qq-upload-button').removeClass('.qq-upload-button-visited')},
            messages: {
                sizeError: "Please upload images not bigger than 2MB",
                typeError: "File Not Permitted,!",
            },
            showMessage: function(message){
                $.jGrowl(message,{theme: 'jGrowlError'});
            }
        });
        
        $('.qq-upload-button').addClass('btn btn-small btn-default');
        var one = new CROP();
        function initCrop(fileName){
            $('.example').html('<div class="example"><div class="default"><div class="cropMain" style="width:800px; height:460px;"></div> <div class="cropSlider"></div> <button class="cropButton cropInCustomer">Crop and Save</button></div></div>').show();
            
            // link the .default class to the crop function
            one.init('.default');
            // load image into crop
            one.loadImg(fileName);
            // on click of button, crop the image
            $(".changeprofilephoto").show();
        }
        $('body').on("click", ".cropButton", function(e) {
            e.preventDefault();
           if (e.handled === true)
                       return false;
                   e.handled = true;
                
           // grab width and height of .crop-img for canvas
           var width = $('.crop-container').width(),  // new image width
               height = $('.crop-container').height();  // new image height
           
           $('canvas').remove();
           $('.default').after('<canvas width="'+width+'" height="'+height+'" id="canvas"/>');

           var ctx = document.getElementById('canvas').getContext('2d'),
               img = new Image,
               w = coordinates(one).w,
               h = coordinates(one).h,
               x = coordinates(one).x,
               y = coordinates(one).y;

           img.src = coordinates(one).image;
           console.log(height,width);
           //console.log(h,w);
           console.log(h > height || w > width);
           if(h > HEIGHT || w > WIDTH){
                alert('You must zoom in to select the part of image to crop.');
                return false;
            }
            $('.example').hide();
            $('.imgrounded').toggle();
            $('.imgrounded').after('<img src="/img/loading.gif" class="loadIconSml" />');
           img.onload = function() {
               console.log(img, x, y, w, h, 0, 0, width, height)
                   // draw image
               ctx.drawImage(img, x, y, w, h-1.1, 0, 0, width, height);

               // display canvas image
                   $('canvas').addClass('output').show();
                   
                   // save the image to server
                   $.ajax({
                           type: "post",
                           dataType: "json",
                           url:'/admins/uploadPhoto/',
                           data: { 
                               image: canvas.toDataURL(),
                               path:'system/academy/'
                           }
                   })
                   .done(function(responseJSON) {
                        if(responseJSON.success){
                            $('.loadIconSml').remove;
                            $('#imgrounded').attr('src', '/system/academy/' + responseJSON.fileName);
                            $('#image').val(responseJSON.fileName);
                            //$('.imgrounded').toggle();
                           $('#imgDeleteArea').html('<a href="" class="removeImage delImg"></a>');
                           $('.qq-upload-list').remove();
                       }else{
                          alert(responseJSON.message);
                           $('#load').empty();
                       }
                       $('.example').hide();
                       console.log(img.src.substr(20,36));
                       $.ajax({
                           type: "post",
                           dataType: "json",
                           url:'/admins/deleteTempFile/',
                           data: { image: tmpFileName}
                       })
                       .done(function(responseJSON) {
                            if(responseJSON.success){
                                $('.userImgDiv').append('<div id="imgDeleteArea"><a class="removeImage delImg" href=""></a>');                                
                            }
                        });
                       return false;
                   });

           };
           return false;
       })
    });
    function picture(count, img, alt){ ///////////////////<img width="672" height="480" src="/system/users/' + img + '" alt=""/>
        //$('#cont').html('<div class="cropedDesc"><input type="hidden" name="pic" value="' + img + '" /><input type="hidden" name="default" value="' + count + '"></div>');
    }
</script>