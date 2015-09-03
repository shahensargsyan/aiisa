<div class="span5 margauto">
    <h3 class="text-center">Edit Expert</h3>
    <hr class="separator">
    
        <?php
        if (isset($error)) { ?>
            <div class="libErrorBox">
            <?php
            echo $error; ?>
            </div>
        <?php
        }
        ?>
    
    <?php
    echo $this->Form->create(
        'Expert', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            ),
            'class' => 'form form-horizontal',
            'enctype' => "multipart/form-data",
        )
    );
    ?>
    <div class="control-group">
        <label class="control-label" ><?php echo __('First name'); ?></label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'first_name', array(
                        'type' => 'text',
                        'div' => false,
                        'error' => false,
                    )
            );
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" ><?php echo __('Last name'); ?></label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'last_name', array(
                        'type' => 'text',
                        'error' => false,
                        'div' => false
                    )
            );
            ?>            
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputEmail"><?php echo __('Email'); ?></label>   
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'email', array(
                        'type' => 'text',
                        'id' => "inputEmail",
                        'error' => false,
                        'div' => false
                    )
            );
            ?>        
        </div>
    </div>
    <div class="control-group"> 
        <label class="control-label"><?php echo __('Summary'); ?></label>   
        <div class="controls">
        <?php
        echo $this->Form->input(
                'summary', array(
                    'type' => 'textarea',
                    'div' => false,
                    'error' => false,
                    'label' => false            
                )
        );
        ?> 
        </div>
    </div>
    <div class="control-group"> 
        <label class="control-label"><?php echo __('Job Title'); ?></label>   
        <div class="controls">
        <?php
        echo $this->Form->input(
                'job_title', array(
                    'type' => 'textarea',
                    'div' => false,
                    'error' => false,
                    'label' => false            
                )
        );
        ?> 
        </div>
    </div>
    <div class="control-group"> 
        <label class="control-label"><?php echo __('Gender'); ?></label>
        <div class="controls">
        <?php
        echo $this->Form->input(
            'gender', array(
                  'options' => array(
                    'male' => 'male',
                    'famae' => 'famae'
                ),
                'div' => false,
                'error' => false,        
                'label' => false,
            )
        );
        ?> 
        </div>
    </div>
    <div class="control-group"> 
        <label class="control-label"><?php echo __('State'); ?></label>
        <div class="controls">
        <?php
        echo $this->Form->input(
            'state', array(
                'type' => 'text',
                'div' => false,
                'error' => false,        
                'label' => false            
            )
        );
        ?> 
        </div>
    </div>
    
    <div class="control-group"> 
        <label class="control-label"><?php echo __('Phone Number'); ?></label>
        <div class="controls">
        <?php
        echo $this->Form->input(
                'phone_number', array(
            'type' => 'text',
            'div' => false,
            'error' => false,        
            'label' => false
                )
        );
        ?> 
        </div>     
    </div>
    <div class="control-group btnSection">  
        <label class="control-label"></label>
        <div class="controls">
            <?php
            echo $this->Form->submit(
                    'Edit', array(
                        'label' => false,
                        'class' => 'btn btn-success',
                        'div' => false
                    )
            );

            echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'users'), array('class' => 'btn'));
            ?>
        </div> 
    </div>    
    <?php
        echo $this->Form->input(
                'photo', array(
                    'type' => 'hidden',
                    'id' => 'image',
                )
        );
        ?>
    <?php echo $this->Form->end(); ?>
    
    
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
        <img src="/system/experts/<?php echo $expert['Expert']['photo']; ?>" id="imgrounded" />
    </div>
<!--    <div class="control-group"> 
        <label class="control-label"><?php echo __('Zip/Postal'); ?></label>
        <div class="controls">
        <?php
        echo $this->Form->input(
                'postal', array(
            'type' => 'text',
            'div' => false,
            'error' => false,        
            'label' => false
                )
        );
        ?> 
        </div>     
    </div>
    <div class="control-group">
        <label class="control-label"><?php echo __('Company Name'); ?></label>
        <div class="controls">
            <?php
                echo $this->Form->input(
                        'company', array(
                    'type' => 'text',
                    'div' => false,
                    'label' => false,
                    'class' => 'form-control'
                        )
                );
            ?> 
        </div>
    </div> -->

    <?php
    echo $this->Form->create(
        'ExpertPassword', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            ),
            'class' => 'form form-horizontal',
            'enctype' => "multipart/form-data",
        )
    );
    ?>
    <div class="control-group mtop20">
        <label class="control-label" for="inputPassword">Old Password</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'old_password', array(
                        'type' => 'password',
                        'error' => false,
                        'id' => "inputPassword",
                        'div' => false,
                        'placeholder' => 'Password'
                    )
            );
            ?>
        </div>
    </div>
    <div class="control-group mtop20">
        <label class="control-label" for="inputPassword">Password</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'password', array(
                        'type' => 'password',
                        'error' => false,
                        'id' => "inputPassword",
                        'div' => false,
                        'placeholder' => 'Password'
                    )
            );
            ?>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="inputPassword">Confirm password</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'confirm_password', array(
                        'type' => 'password',
                        'error' => false,
                        'id' => "inputPassword",
                        'div' => false,
                        'placeholder' => 'Confirm Password'
                    )
            );
            ?>
        </div>        
    </div> 
    <div class="control-group btnSection">  
        <label class="control-label"></label>
        <div class="controls">
            <?php
            echo $this->Form->submit(
                    'Change Password', array(
                        'label' => false,
                        'class' => 'btn btn-success',
                        'div' => false
                    )
                );

            //echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'users'), array('class' => 'btn'));
            ?>
        </div> 
    </div>    
    <?php echo $this->Form->end(); ?>
    <!-- <div class="uploadPhotoSec">            
         <div id="file-uploader">Photo</div>
         <div id="cont" class="uploadedImg"></div>             
     </div>
    -->
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var uploader = new qq.FileUploader({
            element: document.getElementById("file-uploader"),
            'action': '/experts/uploadTempPhoto',
            'debug': false,
            multiple: false,
            sizeLimit: 2 * 1024 * 1024, // max size   
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
            $('.example').html('<div class="example"><div class="default"><div class="cropMain" style="width:240px; height:340px;"></div> <div class="cropSlider"></div> <button class="cropButton cropInCustomer">Crop and Save</button></div></div>').show();
            
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
                           url:'/experts/uploadPhoto/',
                           data: { 
                                image: canvas.toDataURL(),
                                path:'system/experts/'
                           }
                   })
                   .done(function(responseJSON) {
                        if(responseJSON.success){
                            $('.loadIconSml').remove;
                            $('#imgrounded').attr('src', '/system/experts/' + responseJSON.fileName);
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
                           url:'/experts/deleteTempFile/',
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