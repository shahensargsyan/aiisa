<script type="text/javascript">
    $(document).ready(function(){
        var selected = $("#category_id").val()
        $("#select").val(selected);
        $('#select').change(function(){
            var id = $(this).val();
            $('#category_id').val(id);
        });

    });
</script>  
<div class="regform span5 margauto">
    <h3 class="text-center">Edit Sub Category</h3>
    <hr class="separator">
    <?php
    echo $this->Form->Create(
            'Category', array(
        'inputDefaults' => array(
            'label' => array('class' => 'control-label'),
            'div' => array('class' => 'controls')),
        'class' => 'form-horizontal'
            )
    );/*
    ?>
    
    <div class="uploadPhotoSec text-center">            
        <div id="file-uploader">Photo</div>
        <div id="cont" class="uploadedImg"></div>             
    </div>
    <div class="maskDiv  text-center"> 
        <?php
        if($Category['image'] != NULL && file_exists(WWW_ROOT . 'system/site/' . $Category['image'])){
            echo '<img style="width:232px;" src="/system/site/' . $Category['image'] . '" id="defaultBackground" class="mainimg">';
        }else{
            echo '<img style="width:232px;" src="/system/site/nocategory.png" id="defaultBackground" class="mainimg">';
        }
        ?>
    </div>
    <?php
    echo $this->Form->input(
            'image', array(
        'type' => 'hidden',
        'id' => 'userImage'
            )
    );*/
    ?>

    <div class="control-group">
        <label class="control-label">Name</label>
        <?php
        echo $this->Form->input(
                'name', array(
            'type' => 'text',
            'label' => FALSE,
            'placeholder' => "Subcategory name"
                )
        );
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Categories</label>
        <?php
        echo $this->Form->input(
                'category', array(
            'type' => 'select',
            'id' => 'select',
            'name' => 'select',
            'label' => FALSE,
            'options' => $category
                )
        );
        ?>
    </div>
    
    <!--<div class="control-group">-->
        <?php
        echo $this->Form->input(
                'parent_id', array(
            'type' => 'hidden',
            'label' => FALSE,
            'id' => 'category_id'
                )
        );
        ?>
    <!--</div>-->
    
    <?php if('Subcategory.active' == 1){ ?>
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
    <?php }else if('Subcategory.active' == 0){ ?>
        <div class="control-group">
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
    <div class="control-group btnSection">   
        <div class="controls">
            <?php
            echo $this->Form->submit(
                    'Save', array(
                'label' => false,
                'class' => 'btn btn-success',
                'div' => false
                    )
            );
            ?>
            <?php echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'subcategories'), array('class' => 'btn'));
            ?>
        </div>
    </div>
</div>    
<?php echo $this->Html->css('jquery-ui-1.8.23.custom');    ?>
<?php echo $this->Html->script('jquery-1.7.2.min');    ?>
<?php echo $this->Html->script('jquery-ui-1.8.23.custom.min');    ?>
<?php echo $this->Html->script('jquery.cropzoom');    ?>
<?php echo $this->Html->script('fileuploader');    ?>
<script>
    $(document).ready(function(){
//        $('#userImage').val('noImage.png');
        var count = 0;
        var img;
        var alt;
        var check;
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader'),
            action: '<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'uploadUsersPic')); ?>',
            multiple: false,
            sizeLimit: 15728640, // max size  2097152    //15mb
            minSizeLimit: 1024, // min size
            allowedExtensions: ['jpg', 'jpeg'], //'png',
            onSubmit: function(id, fileName){
                $('#load').html('<img src="/img/loading.gif" style="margin-left:109px;margin-top:-34px;position:absolute;"/>');
                $('.qq-upload-list').remove();
            },
            onProgress: function(id, fileName, responseJSON){
                $('#load').html('<img src="/img/loading.gif" style="margin-left:109px;margin-top:-34px;position:absolute;"/>');
                //$('.qq-upload-list').remove();
                $('#imageLoading').show();
            },
            onComplete: function(id, fileName, responseJSON){
                count = count + 1;
                $('#imageLoading').hide();
                if(responseJSON.success == true){
                    $('#cont').html('<div id="img' + count + '"></div>');
                    //$('#load').html('<img src="/img/correct.png" style="margin-left:109px;margin-top:-32px;position:absolute;"/>');
                    //$('#img'+count).html(' <div id="crop_container'+count+'"></div><div id="crop'+count+'" class="cropSave">Crop And Save</div><input type="hidden" name="pic[picture'+count+']" value="'+responseJSON.fileName+'" />');
                    $('#img' + count).html('<div class="forCropArea"><div class="forCropPlugin" id="crop_container' + count + '"></div></br><div id="crop' + count + '" class="upbtn cropSave">Crop And Save</div><input type="hidden" name="pic[picture' + count + ']" value="' + responseJSON.fileName + '" /></div>');
                    // $('.hiddenCount').val(count);
                    check = 0;
                    //////////////////////////////////crop///////////////////////////////////////////
                    
                    var height = responseJSON.size[1];
                    var width = responseJSON.size[0];
//                    var start_zoom = 80;
//                    if(height > 1000){
//                        start_zoom = 10;
//                    }

                    var cropzoom = $('#crop_container' + count + '').cropzoom({
                        width: 600, ////232w h 227
                        height: 600,
                        bgColor: '#CCC',
                        enableRotation: true,
                        enableZoom: true,
                        zoomSteps: 10,
                        rotationSteps: 10,
                        setSizeLimit: 15728640, //15mb
                        selector: {
                            x: 0,
                            y: 0,
                            w: 600,
                            h: 600,
                            aspectRatio: false,
                            centered: true,
                            borderColor: 'yellow',
                            borderColorHover: 'red',
                            bgInfoLayer: '#FFF',
                            infoFontSize: 10,
                            infoFontColor: 'blue',
                            showPositionsOnDrag: false,
                            showDimetionsOnDrag: false,
                            maxWidth: 600,
                            maxHeight: 600,
                            startWithOverlay: true,
                            hideOverlayOnDragAndResize: true,
                            onSelectorDrag: null,
                            onSelectorDragStop: null,
                            onSelectorResize: null,
                            onSelectorResizeStop: null
                        },
                        image: {
                            source: "/system/site/" + responseJSON.fileName,                            
                            width:600,
                            height: (600*height)/width,
                            centered : true,
                            minZoom:10,
                            maxZoom:250,
                            startZoom : 100,
                            x : 0,
                            y : 0,
                            useStartZoomAsMinZoom : false,
                            snapToContainer : false
                        },
                        cache: false
                    });
                    img = responseJSON.fileName;
                    $('#crop_container' + count + '_selector').remove();

                    $('#crop' + count + '').click(function(){
                        alt = $('#alt').val();
                        cropzoom.send('<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'resizeCrop')); ?>/user' + responseJSON.fileName + '', 'POST', {}, function(rta){
                            picture(count, 'user' + responseJSON.fileName, alt);
                            $('#userImage').val('user'+responseJSON.fileName);
                            parent.$('#defaultBackground').attr("src", '/system/site/user' + responseJSON.fileName);
                        });
                        return false;
                    });

                    /////////////////////////////// end crop/////////////////////////////////////////////

                    $('#blah' + count).attr('src', '/system/site/' + responseJSON.fileName);
                    $('#ManualEntryManualFile').val(responseJSON.fileName);
                    $('.qq-upload-list').remove();
                    if($('#2').length !== 0 && $('#3').length !== 0){
                        $('#file-uploader3').removeClass('hid');
                    }
                }else{
                    $('.qq-upload-list').remove();
                    alert('Please upload images, with  JPG or JPEG extensions and max size of less than 15MB!');
                    $('#load').empty();
                }
            },
            onCancel: function(id, fileName){
                $('.qq-upload-button').removeClass('.qq-upload-button-visited')
            },
            /*messages: {
             // error messages, see qq.FileUploaderBasic for content            
             },*/
            showMessage: function(message){
                alert(message);
            }
        });
        $('.qq-upload-drop-area').remove();
    });
    function picture(count, img, alt){ ///////////////////<img width="672" height="480" src="/system/site/' + img + '" alt=""/>
        $('#cont').html('<div class="cropedDesc"><input type="hidden" name="pic" value="' + img + '" /><input type="hidden" name="default" value="' + count + '"></div>');
    }
</script>
<style>    
    .forCropPlugin
    {
        -webkit-transform: scale(0.38);
        -moz-transform: scale(0.38);
        -o-transform: scale(0.38);
        transform: scale(0.38);
/*        margin-left: -556px;
        margin-top: -345px;*/
    }
</style>




