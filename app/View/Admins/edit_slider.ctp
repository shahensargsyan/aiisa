<div class="span5 ">
    <h3 class="text-center">Edit Slider</h3>
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
            'Slider', array(
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
                    'placeholder' => "Title"
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Description</label>
        <?php
        echo $this->Form->input(
                'description', array(
                    'type' => 'text',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Event Title"
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Link</label>
        <?php
        echo $this->Form->input(
                'link', array(
                    'type' => 'text',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Text link"
                )
        );
        ?>
    </div>
        <?php if('Category.active' == 1){ ?>
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
    <?php }else if('Category.active' == 0){ ?>
        <div class="control-group mtop20">
            <label class="control-label">Active</label>
            <?php
            echo $this->Form->input(
                    'active', array(
                'label' => FALSE,
                'options' => array(
                    0 => 'inactive',
                    1 => 'active'
                )
                    )
            );
            ?>
        </div>
    <?php } ?>
        <?php
        echo $this->Form->input(
                'photo', array(
                    'type' => 'hidden',
                    'id' => 'image',
                )
        );
        ?>

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
        <img src="/system/slider/<?php echo $photo; ?>" id="imgrounded" />
    </div>
    
    <div class="control-group btnSection">
        <label class="control-label"></label>
        <div class="controls">
        <?php
        echo $this->Form->submit(
            'Edit', array(
                'label' => false,
                'div' => FALSE,
                'class' => 'btn btn-success'
            )
        );
        ?>
        <?php echo $this->Html->link('Cancel', array('controller' => 'admons', 'action' => 'sliders'), array('class' => 'btn'));
        ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    var WIDTH,HEIGHT,tmpFileName;
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
            $('.example').html('<div class="example"><div class="default"><div class="cropMain" style="width:1200px; height:660px;"></div> <div class="cropSlider"></div> <button class="cropButton cropInCustomer">Crop and Save</button></div></div>').show();
            
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
                               path:'system/slider/'
                           }
                   })
                   .done(function(responseJSON) {
                        if(responseJSON.success){
                            $('.loadIconSml').remove;
                            $('#imgrounded').attr('src', '/system/slider/' + responseJSON.fileName);
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