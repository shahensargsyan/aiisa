<?php
echo $this->Html->script('fineuploader-4.0.3.min');
//echo $this->Html->script('jquery.cropzoom');
echo $this->Html->css('fineuploader-4.0.3.min');
?>
<div class="span5 margauto">
    <h3 class="text-center">Trust Logo</h3>
    <hr class="separator">
    <?php
        if(isset($error)){ ?>
            <div class="libErrorBox">
                <?php echo $error; ?>
            </div>
        <?php } 
    ?>
    <?php
    $currentData = json_decode($data['Setting']['data'], true);
    echo $this->Form->create(
        'Trust', 
        array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            ),
            'class' => 'form form-horizontal',
        )
    );
    ?>
    <div class="control-group">
        <label class="control-label" >Url</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                'url', 
                array(
                    'type' => 'text',
                    'div' => false,
                    'error' => false,
                    'value' => $currentData['url'],
                    'placeholder' => 'url'
                )
            );
            ?>
        </div>
    </div> 
    
    <div class="control-group">
        <label class="control-label" >Width</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                'width', 
                array(
                    'type' => 'text',
                    'div' => false,
                    'error' => false,
                    'value' => $currentData['width'],
                    'placeholder' => '150'
                )
            );
            ?>
        </div>
    </div>  
    
    <div class="control-group">
        <label class="control-label" >Height</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                'height', array(
                    'type' => 'text',
                    'div' => false,
                    'error' => false,
                    'value' => $currentData['height'],
                    'placeholder' => '150'
                )
            );
            ?>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="exampleInputFile">Attached files</label>            
        <div class="controls">
            <div id="profPic"></div>
            <?php
            echo $this->Form->input('image_name', array(
                "type" => "hidden",
                "value" => "",
                "id" => "attachedFile"
            ));
            ?>
        </div>
        <div>
            <?php 
            if($currentData['image_name']){
            ?>
            <img src="/system/trust/<?php echo $currentData['image_name']; ?>" />
            <?php } ?>
        </div>
    </div>
    <div class="controls btnSection">
        <?php
        echo $this->Form->submit(
                'Save', array(
            'label' => false,
            'div' => false,
            'class' => 'btn btn-success'
                )
        );
        echo $this->Html->link('Back', array('controller' => 'admins', 'action' => 'SocialSettings'), array('class' => 'btn'));
        ?>
    </div>    
</div>

<script type="text/javascript">
    var imageArray = [];
    
    (function(){
        var folder_name = "trust";
        var thumbnailuploader = new qq.FineUploader({
            element: document.getElementById("profPic"),
            template: "simple-previews-template",
            request: {
                endpoint: '/image/imageUpload',
                params: {
                    path: '<?php echo APP_DIR . ',' . WEBROOT_DIR . ',' . 'system' . ',' . 'trust'; ?>'
                }
            },
            // optional feature
            validation: {
                allowedExtensions: ['png', 'jpg', 'jpeg'],
                itemLimit: 1
            },
            callbacks: {
                onComplete: function(id, fileName, responseJSON){                
                    $('.newImg').remove();
                    if(responseJSON.success){
                        imageArray.push(responseJSON.file);
                        $('#attachedFile').val(imageArray.join());
//                        $('.qq-upload-success').prepend('<img src="/img/file_icons/' + responseJSON.file.split('.').pop().toLowerCase() + '.png" />');
                    }else{
                        alert('error')
                    }
                }
            }
        });
    }());   
  
</script>