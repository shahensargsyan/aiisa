<div class="span5 ">
    <h3 class="text-center">Add Image</h3>
    <hr class="separator">
    
        <?php
        
        echo $this->Form->input(
                'main_image', array(
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
                <div class="cropGallery"></div>
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

        <table class="table table-bordered table-striped allContractsTbl">
        <thead>
<!--            <tr>
                <th style="width: 80%;"></th>                
                <th style="width: 20%;"></th>
            </tr>-->
        </thead>    
        <?php
        $dir = 'gallery/'.$gallery['Gallery']['folder'].'/';
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) { ?>
        <?php  if(!in_array($file, array('.','..'))){  ?>
                    <tr> 
                        <td class="text-center selectAll">
                            <img src="/<?php echo  $dir.$file; ?>" width="100px" /> 
                        </td>
                        <td class="text-center"><?php echo $this->Html->link('Delete', array('controller' => 'admins', 'action' => 'deleteImage', $gallery['Gallery']['folder'],$file,$gallery['Gallery']['id']), array('class' => 'btn btn-success')); ?></td>
                    </tr>
                <?php } }
                closedir($dh);
            }
        }
        ?>
        </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    var WIDTH,HEIGHT,tmpFileName;
    var folder = '<?php echo $gallery['Gallery']['folder']; ?>';
    $(document).ready(function(){
        var uploader = new qq.FileUploader({
            element: document.getElementById("file-uploader"),
            'action': '/admins/uploadMultiplePhoto/'+folder,
            'debug': false,
            multiple: true,
            sizeLimit: 10 * 1024 * 1024, // max size   
            minSizeLimit: 0, // min size
            allowedExtensions: ['jpg', 'jpeg', 'gif', 'png', 'GPG'],
            onSubmit: function(id, fileName){
                //$('#load').html('<img src="/img/loading.gif" style="margin-left:109px;margin-top:-34px;position:absolute;"/>')
            },
            onProgress: function(id, fileName, responseJSON){
            },
            onComplete: function(id, fileName, responseJSON){
                if(responseJSON.success == true){
                    location.reload();
                }else{
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
    });
</script>