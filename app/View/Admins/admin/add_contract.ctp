<?php
echo $this->Html->script('fineuploader-4.0.3.min');
echo $this->Html->script('jquery.cropzoom');
echo $this->Html->script('jquery.validate.min');
echo $this->Html->css('fineuploader-4.0.3.min');
?>

<div class="span5 margauto">    
    <?php
    if(isset($error)){ ?>
    <div class="libErrorBox">
    <?php
        echo $error; ?>
    </div>
    <?php
    }
    ?>
    
    <h3 class="text-center">Add Contract</h3>
    <hr class="separator">
    <?php
    echo $this->Form->create(
            'Contract', array(
        'inputDefaults' => array(
            'label' => false,
            'div' => false
        ),
        'class' => 'form form-horizontal addContractForm',
        'enctype' => "multipart/form-data"
            )
    );
    ?>


    <?php if (isset($error)) { ?>
        <h4 class="libErrorBox">
            <?php echo $error; ?>
        </h4>
        <?php
    }
    ?>       

    <div class="control-group">
        <label class="control-label" >Contract name</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'name', array(
                'type' => 'text',
                'div' => false,
                'error' => false,
                'placeholder' => 'Contract name'
                    )
            );
            ?>
        </div>
    </div>       

    <div class="control-group">
        <label class="control-label">Description</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'description', array(
                'type' => 'textarea',
                'error' => false,
                'placeholder' => 'Description',
                    )
            );
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
            <?php
            $options = array();
            foreach ($data as $category) {
                $options[$category['Category']['id']] = $category['Category']['name'];
            }
            echo $this->Form->input('category_id', array('multiple' => 'checkbox', 'options' => $options));
            ?>
        </div>
    </div>      

    <div class="control-group">
        <label class="control-label" for="">Contract</label>   
        <div class="controls">
            <div class="tagsDiv">
                <div class="tagBox">
                    <div class="tagFld">
                        <?php
                        echo $this->Form->input('tagValue', array('div' => false, 'label' => false, 'placeholder' => __('add highlights'), "class" => "addTag"));
                        echo $this->Form->input('tag', array('type' => 'hidden'));
                        ?>
                    </div>

                </div>
                <div class="addTagAct top10">
                    <?php
                    echo $this->Form->button(__('Add'), array(
                        'type' => 'button',
                        'id' => 'addTag',
                        'class' => 'loginBtn unactiveBtn btn btn-small pull-left btn-primary'
                    ));
                    ?>   
                    <span class="tagText pull-left">  <?php echo __('maximum 5 highlights'); ?></span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="tagsDiv" id="tagsDiv"></div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"for="exampleInputFile">Featured Contract document</label>   
        <div class="controls">
            <div id="profPic2" class="addFileSec"></div>
            <?php
            echo $this->Form->input('document', array(
                "type" => "hidden",
                "value" => "",
                "id" => "document"
            ));
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"for="exampleInputFile">Featured Contract image</label>   
        <div class="controls">
            <div id="profPic"></div>
            <?php
            echo $this->Form->input('file', array(
                "type" => "hidden",
                "value" => "",
                "id" => "attachedFile"
            ));
            ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"for="exampleInputFile">Contract screenshot</label>   
        <div class="controls">
            <div id="profPic1"></div>
            <?php
            echo $this->Form->input('contract_image', array(
                "type" => "hidden",
                "value" => "",
                "id" => "attachedFile1"
            ));
            ?>
        </div>
    </div>      

    <div class="controls btnSection">
        <?php
        echo $this->Form->submit(
                'Add', array(
            'label' => false,
            'div' => false,
            'class' => 'btn btn-success'
                )
        );
        echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'all_contract'), array('class' => 'btn'));
        ?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
    $('#ContractTag').val('');
    $('#CompanyBackgroundImageId').val('');
    $('#CompanyLogoId').val('');

    $('#addTag').attr('disabled', true);
    $('#ContractTagValue').keyup(function(){
        if($(this).val().length != 0){
            $('#addTag').attr('disabled', false);
            $('#addTag').removeClass('unactiveBtn');
        }else{
            $('#addTag').attr('disabled', true);
            $('#addTag').addClass('unactiveBtn');
        }
    })

    var tagsArray = [];
    $(document).on("click", "#addTag", function(e){
        if($('#ContractTagValue').val() != ""){
            if(tagsArray.length < 5){
                var tag = $('#ContractTagValue').val();
                $("#tagsDiv").append('<span class="tagList"><span>' + tag + '</span><img src="/img/del_black.png"></span>');
                tagsArray.push(tag);
                $('#ContractTag').val(tagsArray.join());

            }else{
                alert('<?php echo __('Can not add more than 5 highlights'); ?>');
            }
        }else{
            alert('Cant add empty highlight');
        }
        if(tagsArray.length == 1){
            $('#ContractTag').nextAll(".text-danger:first").css("display", "none");
        }
        $('#ContractTagValue').val("");
        $('#addTag').attr('disabled', true);
        $('#addTag').addClass('unactiveBtn');
    });

    $(document).on("click", ".tagList", function(e){
        keyword = $(this).text();

        var i = tagsArray.indexOf(keyword);
        if(i != -1){
            tagsArray.splice(i, 1);
        }

        $('#ContractTag').val(tagsArray.join());
        $(this).remove();
        if(tagsArray.length == 0){
            $('#ContractTag').nextAll(".text-danger:first").css("display", "block");
        }
    });










    var imageArray = [];

    (function(){
        var folder_name = "contracts";
        var thumbnailuploader = new qq.FineUploader({
            element: document.getElementById("profPic"),
            template: "simple-previews-template",
            request: {
                endpoint: '/image/imageUpload',
                params: {
                    path: '<?php echo APP_DIR . ',' . WEBROOT_DIR . ',' . 'system' . ',' . 'contracts'; ?>'
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


    var imageContract = [];

    (function(){
        var folder_name = "contracts";
        var thumbnailuploader = new qq.FineUploader({
            element: document.getElementById("profPic1"),
            template: "simple-previews-template",
            request: {
                endpoint: '/image/imageUpload',
                params: {
                    path: '<?php echo APP_DIR . ',' . WEBROOT_DIR . ',' . 'system' . ',' . 'contracts'; ?>'
                }
            },
            validation: {
                allowedExtensions: ['png', 'jpg', 'jpeg'],
                itemLimit: 1
            },
            callbacks: {
                onComplete: function(id, fileName, responseJSON){
                    $('.newImg').remove();
                    if(responseJSON.success){
                        imageContract.push(responseJSON.file);
                        $('#attachedFile1').val(imageContract.join());
                    }else{
                        alert('error')
                    }
                }
            }
        });
    }());
    var documentContract = [];
    
    (function(){
        var folder_name = "contracts";
        var thumbnailuploader = new qq.FineUploader({
            element: document.getElementById("profPic2"),
            template: "simple-previews-template",
            request: {
                endpoint: '/image/documentUpload',
                params: {
                    path: '<?php echo APP_DIR . ',' . WEBROOT_DIR . ',' . 'system' . ',' . 'documents'; ?>'
                    //contract_id: '<?php //echo $contract_id;   ?>'
                }
            },
            validation: {
                allowedExtensions: ['docx','doc'],
                itemLimit: 1
            },
            callbacks: {
                onComplete: function(id, fileName, responseJSON){
                    $('.newImg').remove();
                    if(responseJSON.success){
                        documentContract.push(responseJSON.file);
                        $('#document').val(documentContract.join());
                        //imageContract.push(responseJSON.file);
                        //$('#attachedFile1').val(imageContract.join());
                    }else{
                        alert('error')
                    }
                }
            }
        });
    }());
</script>