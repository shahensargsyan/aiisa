<?php
echo $this->Html->script('fineuploader-4.0.3.min');
echo $this->Html->script('jquery.cropzoom');
echo $this->Html->css('fineuploader-4.0.3.min');
?>
<div class="span5 margauto">
    <h3 class="text-center">Add language</h3>
    <hr class="separator">
    <?php
    echo $this->Form->create('Language', array('class' => 'form-horizontal addLang'));
    ?>
    <div class="control-group">
        <label class="control-label">Language</label>
        <div class="controls">
            <?php
            include_once APP . "Vendor/languages.php";
            echo $this->Form->input(
                    'lang_code', array(
                'type' => 'select',
                'label' => false,
                'options' => $language_options,
                'value' => 'Choose Language',
                'required' => true,
                'id' => 'languages',
            ));
            ?>
        </div>         
    </div>         
    <div class="control-group">
        <label class="control-label">Code</label>
        <div class="controls">
            <?php
            echo $this->Form->input('code', array('type' => 'text', 'id' => 'code', 'DISABLED', 'label' => FALSE));
            echo $this->Form->input('name', array('type' => 'hidden', 'id' => 'name'));
            ?>
        </div>
    </div>
    <div class="control-group attachedFiles">
        <label for="exampleInputFile" class="control-label">Attached files</label>
        <div id="profPic" class="controls"></div>

        <?php
        echo $this->Form->input('file_path', array(
            "type" => "hidden",
        ));
        ?>
        <?php
        echo $this->Form->input('attached_file', array(
            "type" => "hidden",
            "value" => "",
            "id" => "attachedFile"
        ));
        ?>
    </div>
    <div class="control-group">
        <label for="exampleInputFile" class="control-label">Flag</label>
        <div id="flagPic" class="controls"></div>
        <?php
        echo $this->Form->input('flag_path', array(
            "type" => "hidden",
            "value" => 'app\webroot\img',
            "id" => "flag_path"
        ));

        echo $this->Form->input('flag', array(
            "type" => "hidden",
            "value" => "",
            "id" => "flag"
        ));
        ?>
    </div>
    <div class="control-group">
        <label class="control-label">Active</label>
        <div class="controls">
            <?php
            echo $this->Form->input('active', array('type' => 'checkbox', 'label' => false));
            ?>
        </div>
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
            <?php echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'languages'), array('class' => 'btn')); ?>
        </div>
    </div>    
</div>    
<script type="text/javascript">

    $("#LanguageAddLanguageForm").validate({
        ignore: '',
        rules: {
            'data[Language][lang_code]': "required",
            'data[Language][attached_file]': "required",
            'data[Language][flag]': "required",
        },
        messages: {
            'data[Language][lang_code]': '<?php echo __('Please select language'); ?>',
            'data[Language][attached_file]': '<?php echo __('Please upload po and mo files'); ?>',
            'data[Language][flag]': '<?php echo __('Please upload flag'); ?>',
        }
    });
    var imageArray = [];
    var path = '';
    $("#languages").change(function(){
        var text = $('option:selected').text();
        $("#name").val(text);
    });
    $("#languages").change(function(){
        var text = $(this).val();
        $("#code").val(text);
        path = '<?php echo APP_DIR . ',' . 'Locale' . ','; ?>' + text + ',LC_MESSAGES';
        //   $('#LanguageFilePath').val(path)
        (function(){
            var folder_name = "translations";
            var thumbnailuploader = new qq.FineUploader({
                element: document.getElementById("profPic"),
                template: "simple-previews-template",
                request: {
                    endpoint: '/image/imageUpload',
                    params: {
                        file_name: 'default',
                        path: path
                    }
                },
                multiple: true,
                // optional feature
                deleteFile: {
                    enabled: true,
                    method: "POST",
                    endpoint: "/image/deleteUpload"
                },
                // optional feature
                validation: {
                    allowedExtensions: ['po', 'mo'],
                    itemLimit: 2
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
    });
//    $("#languages").change(function(){
//        var text = $('option:selected').text();
//        $("#name").val(text);
//    });





    (function(){
        var thumbnailuploader = new qq.FineUploader({
            element: document.getElementById("flagPic"),
            template: "simple-previews-template",
            request: {
                endpoint: '/image/imageUpload',
                params: {
                    path: '<?php echo APP_DIR . ',' . WEBROOT_DIR . ',' . 'img'; ?>'
                }
            },
            multiple: false,
            // optional feature
            deleteFile: {
                enabled: true,
                method: "POST",
                endpoint: "/image/deleteUpload"
            },
            // optional feature
            validation: {
                allowedExtensions: ['jpg', 'jpeg', 'png'],
            },
            callbacks: {
                onComplete: function(id, fileName, responseJSON){
                    $('.newImg').remove();
                    if(responseJSON.success){
                        $('#flag').val(responseJSON.file);
//                        $('.qq-upload-success').prepend('<img src="/img/file_icons/' + responseJSON.file.split('.').pop().toLowerCase() + '.png" />');
                    }else{
                        alert('error')
                    }
                }
            }
        });
    }());

</script>